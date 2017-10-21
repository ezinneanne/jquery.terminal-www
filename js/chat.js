/**@license
 * JQuery Terminal Chat using firebase
 *
 * Copyright (C) 2017 Jakub Jankiewicz <http://jcubic.pl/me>
 * Released under the MIT license
 *
 */
/* global jQuery, firebase, Audio, sysend, Favico */

jQuery(function($) {
    // change this if you want to reuse
    var config = {
        apiKey: "AIzaSyBJguGFPPZXozdkPVpBZNbGMVJ_LTOYuQA",
        authDomain: "jcubic-1500107003772.firebaseapp.com",
        databaseURL: "https://jcubic-1500107003772.firebaseio.com",
        projectId: "jcubic-1500107003772"
    };
    firebase.initializeApp(config);
    var database = firebase.database();
    var messages = database.ref('messages');
    var last_messages = messages.limitToLast(100);
    $.terminal.defaults.formatters.push(function(string) {
        return string.replace(/([^`]|^)`([^`]+)`([^`]|$)/g, '$1[[b;#fff;]$2]$3');
    });
    $.terminal.defaults.formatters.push(function(string) {
        return string.replace(/\b\/me\b/g, username);
    });
    var focus = true;
    $(window).focus(function() {
        focus = true;
    }).blur(function() {
        focus = false;
    });
    function format(string, username) {
        return string.split(/(```[\s\S]+```)/).map(function(string) {
            var m = string.match(/```(.*)\n([\s\S]+?)\n```/);
            if (!m) {
                return string;
            } else {
                var node = $('<pre>' + m[2] + '</pre>')
                    .appendTo('body').hide().snippet(m[1], {
                        style: '',
                        showNum: false
                    });
                var html = node.html();
                node.closest('.snippet-wrap').remove();
                var re = /<span class="([^"]+)">([^<]*)<\/span>/g;
                string = html.replace(re, '[[;;;$1]$2]')
                    .replace(/<\/li>/g, '\n')
                    .replace(/<\/?[^>]+>/g, '').replace(/\n$/, '');
            }
            if (username) {
                return string.split(/\n/).map(function(line) {
                    return username + '> ' + line;
                }).join('\n');
            } else {
                return string;
            }
        }).join('');
    }
    // formatter is for when you type command and when you echo, messages are handled in show_message
    // before echo
    $.terminal.defaults.formatters.push(function(string) {
        if (username) {
            return format(string);
        } else {
            return string;
        }
    });
    var username;
    $('#chat').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var terminal = $('.chat.ui-dialog-content');
        if (terminal.length) {
            $('html,body').animate({
                scrollTop: terminal.offset().top - 50
            }, 500);
            return;
        }
        var favicon = new Favico({
            animation: 'none'
        });
        var newItems = false;
        var random_value = Math.random();
        var sound = new Audio('button-9.mp3');
        var silent = false;
        function logout_other(term) {
            var terminals = $('.chat.ui-dialog-content');
            terminals.each(function() {
                var other = $(this).terminal();
                if (other != term) {
                    // exec would execute firebase signOut
                    // we only need echo and pop
                    other.echo(username + '> logout');
                }
                other.echo('You\'ve beed sign out from jQuery Terminal Chat');
                other.pop();
            });
        }
        var new_messages = 0;
        function show_message(data) {
            var message = format(data.message, data.user);
            term.echo(message);
            if (!focus) {
                if (!silent) {
                    sound.play();
                }
                if (!document.hasFocus()) {
                    new_messages += 1;
                    favicon.badge(new_messages);
                }
            }
        }
        last_messages.on('child_added', function(snapshot) {
            var data = snapshot.val();
            if (data.random != random_value) {
                show_message(data);
            }
        });
        last_messages.once('value', function() {
            term.echo('type [[;#fff;]/help] for help');
        });
        function init(user, options) {
            if (options.clear) {
                term.clear();
            }
            options = $.extend({clear: false}, options || {});
            username = user.displayName;
            if (!username) {
                term.echo('Coun\'t acquire username, you need to set one');
                term.read('username: ').then(function(user) {
                    username = user;
                });
            } else {
                push();
            }
            function push() {
                term.resume().push(function(message) {
                    var cmd = $.terminal.parse_command(message);
                    if (cmd.name == '/sound') {
                        var flag = message.replace(/^\s*\/sound\s*/, '').toLowerCase();
                        if (flag == 'true') {
                            silent = false;
                        } else if (flag == 'false') {
                            silent = true;
                        } else {
                            term.error('wrong flag, only [[;#fff;]true] or [[;#fff;]false]' +
                                       ' are accepted');
                        }
                    } else if (cmd.name == '/user') {
                        username = cmd.args[0];
                    } else if (cmd.name == '/logout') {
                        firebase.auth().signOut();
                        last_messages.off();
                        sysend.broadcast('logout');
                        logout_other(term);
                        username = null;
                    } else if (cmd.name == '/help') {
                        term.echo([
                            '',
                            '[[b;#fff;]/logout] - logout from the app',
                            '[[b;#fff;]/help] - this screen',
                            '[[b;#fff;]/sound true|false] - turn on/off sound notifications',
                            '[[b;#fff;]/user <name>] - set new username',
                            'everything else is a message',
                            'use &#96;code&#96; or &#96;&#96;&#96;language',
                            'code snippet',
                            '&#96;&#96;&#96;',
                            'markdown don\'t work, only code snippets',
                            ''
                        ].join('\n'));
                    } else if (message !== '') {
                        var newMessageRef = messages.push();
                        newMessageRef.setWithPriority({
                            user: username,
                            message: message,
                            random: random_value
                        }, firebase.database.ServerValue.TIMESTAMP);
                    }
                }, {
                    prompt: function(callback) {
                        callback(username + '> ');
                    }
                });
            }
        }
        var auth = firebase.auth();
        var login = false;
        function login_handler() {
            login = false;
        }
        function logout_handler() {
            messages.off();
            logout_other(null);
        }
        function resetNotifications() {
            new_messages = 0;
            favicon.reset();
        }
        sysend.on('login', login_handler);
        sysend.on('logout', logout_handler);
        var unsubscribe = auth.onAuthStateChanged(function(user) {
            if (user) {
                if (username != (user.displayName || 'Anonymous')) {
                    init(user, {clear: !login});
                }
            }
        });
        window.favicon = favicon;
        var $win = $(window);
        var height = $win.height();
        var width = $win.width();
        var dterm = $('<div/>').addClass('chat').dterm({
            login: function(type) {
                type = type.toLowerCase();
                if (type.match(/^(twitter|github|facebook)$/)) {
                    term.pause();
                    var provider;
                    if (type == 'twitter') {
                        provider = new firebase.auth.TwitterAuthProvider();
                    } else if (type == 'github') {
                        provider = new firebase.auth.GithubAuthProvider();
                    } else {
                        provider = new firebase.auth.FacebookAuthProvider();
                    }
                    login = true;
                    sysend.broadcast('login');
                    auth.signInWithPopup(provider).then(function(result) {
                        if (result) {
                            var user = result.user;
                            //init(user);
                        }
                    }).catch(function(error) {
                        term.error(error.message).resume();
                        term.error('try again');
                    });
                } else {
                    this.error('wrong login type');
                }
            }
        }, {
            onFocus: resetNotifications,
            greetings: 'Type [[;#fff;]login \[twitter|github|facebook\]] ' +
                'to post messages',
            width: width < 800 ? width - 100 : 800,
            height: height < 600 ? height - 100 : 600,
            title: 'jQuery Terminal Chat',
            close: function() {
                dterm.dialog("destroy");
                term.destroy().remove();
                last_messages.off();
                username = null;
                unsubscribe();
                sysend.off('login', login_handler);
                sysend.off('logout', logout_handler);
            }
        });
        var term = dterm.terminal;
        term.addClass('sh_sourceCode'); // so snippets work in terminal
        return false;
    });
});
