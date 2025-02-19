<?php // -*- mode: web -*-
header("X-Powered-By: ");
require('utils.php');
$version = version();
?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>Documentation for jQuery Terminal, Web Based Terminal</title>
    <link rel="canonical" href="https://terminal.jcubic.pl/examples.php"/>
    <meta name="author" content="Jakub T. Jankiewicz - jcubic&#64;onet.pl"/>
    <meta name="Description" content="This is list of resources about jQuery Termial. API reference, Wiki, Tutorials, and Articles."/>
    <meta name="keywords" content="jquery,terminal,interpreter,console,bash,history,authentication,ajax,server,client"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="alternate" type="application/rss+xml" title="Notification RSS" href="https://terminal.jcubic.pl/notification.rss"/>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono&display=swap"
          rel="stylesheet" type="text/css" media="print"
          onload="this.media='all'" />
    <link rel="stylesheet" href="css/style.css?<?= md5(file_get_contents('css/style.css')) ?>"/>
    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    <script src="js/code.js"></script>
    <!-- Terminal Files -->
    <!--[if IE]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Examples for jQuery Terminal plugin"/>
    <meta property="og:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta property="og:url" content="https://terminal.jcubic.pl/examples.php"/>
    <meta property="og:site_name" content="JQuery Terminal Emulator Plugin"/>
    <meta property="og:image" content="https://terminal.jcubic.pl/signature.png"/>

    <meta name="twitter:image" content="https://terminal.jcubic.pl/signature.png"/>
    <meta name="twitter:image:alt" content="Main ASCII Art for jQuery Terminal"/>
    <meta name="twitter:title" content="Examples for jQuery Terminal plugin"/>
    <meta name="twitter:description" content="jQuery plugin for Command Line applications. Automatic JSON-RPC, custom object or a function. History, Authentication, Bash Shortcuts. Tab completion."/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@jcubic"/>
    <meta name="twitter:creator" content="@jcubic"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>
    <header id="main" role="presentation" aria-hidden="true"x><h1>jQuery Terminal Emulator Plugin</h1>
    <a href="/"><pre id="sig">
<div class="big">
      __ _____                     ________                              __
     / // _  /__ __ _____ ___ __ _/__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // // // // _  // _// // / / // _  // _//     // //  \/ // _ \/ /
/  / // // // // // ___// / / // / / // ___// / / / / // // /\  // // / /__
\___//____ \\___//____//_/ _\_  / /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/              /____/                                     <?=$version?>
</div>
<div class="medium">
      __ ____ ________                              __
     / // _  /__  ___/__ ___ ______ __ __  __ ___  / /
 __ / // // /  / // _  // _//     // //  \/ // _ \/ /
/  / // // /  / // ___// / / / / // // /\  // // / /__
\___//____ \ /_//____//_/ /_/ /_//_//_/ /_/ \__\_\___/
          \/                                  <?=$version?>
</div>
<div class="small">
      __ ____ ________
     / // _  /__  ___/__ ___ ______
 __ / // // /  / // _  // _//     /
/  / // // /  / // ___// / / / / /
\___//____ \ /_//____//_/ /_/ /_/
          \/              <?=$version?>

</div>
</pre><img src="signature.png"/><!-- for FB bigger then gihub ribbon --></a>
<pre class="separator">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</pre>
    </header>
    <nav>
      <ul>
        <li><a href="/#demo">Demo</a></li>
        <li><a href="/documentation.php">Documentation</a></li>
        <li><a href="/examples.php">Examples</a></li>
        <li><a href="https://stackoverflow.com/questions/tagged/jquery-terminal">Q&A</a></li>
        <li><a href="/#download">Download</a></li>
        <li><a href="/#comments">Comments</a></li>
        <li><a class="chat" href="https://gitter.im/jcubic/jquery.terminal">Chat</a></li>
      </ul>
    </nav>
    <a class="support-ribbon" href="https://support.jcubic.pl/"
       style="position: fixed; top: 0; right: 0; z-index:1000">
      <img style="border: 0;" src="https://terminal.jcubic.pl/support.svg"
           alt="Get Paid Support">
    </a>
    <a class="github-ribbon" href="https://github.com/jcubic/jquery.terminal"
       style="position: fixed; top: 0; left: 0; z-index:1000">
      <img style="border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png"
           alt="Fork jQuery Terminal Emulator on GitHub">
    </a>
    <section>
      <article>
        <header id="doc"><h1>Documentation</h1></header>
        <p>Below is the list of resources that you can use to learn about jQuery Terminal</p>
        <ul>
          <li><a href="https://github.com/jcubic/jquery.terminal/wiki/Getting-Started">Getting Started Guide</a></li>
          <li><a href="api_reference.php">API Reference</a></li>
          <li><a href="https://github.com/jcubic/jquery.terminal/wiki/Advanced-jQuery-Terminal-Tutorial">Advanced jQuery Terminal Tutorial</a></li>
        </ul>
        <p>Tutorials</p>
        <ul>
          <li><a href="https://itnext.io/how-to-create-interactive-terminal-like-website-888bb0972288">How to create interactive terminal like website in JavaScript?</a></li>
          <li><a href="https://www.geeksforgeeks.org/how-to-build-simple-terminal-like-website-using-jquery/">How to Build Simple Terminal like Website using jQuery?</a></li>
          <li><a href="https://www.learnsteps.com/making-a-javascript-terminal-in-browser/">Terminal in browser: Building a Javascript Terminal in your website</a></li>
        </ul>
        <p>Blog Posts</p>
        <ul>
          <li><a href="https://guido-muehlwitz.de/2011/08/jquery-terminal-emulator/">Article in German</a></li>
          <li><a href="https://sumygg.com/2015/12/10/install-jquery-terminal-emulator-plugin-in-my-blog/">体验JQuery Terminal Emulator插件</a></li>
          <li><a href="https://www.moongift.jp/2016/07/jquery-terminal-emulator-plugin-jquery%E3%82%82%E4%BD%BF%E3%81%88%E3%82%8Bjquery%E8%A3%BD%E3%81%AE%E3%82%BF%E3%83%BC%E3%83%9F%E3%83%8A%E3%83%AB%E3%82%A8%E3%83%9F%E3%83%A5%E3%83%AC%E3%83%BC%E3%82%BF/">JQuery Terminal Emulator Plugin - jQueryも使えるjQuery製のターミナルエミュレータ</a></li>
        </ul>
      </article>
    </section>
    <footer>
      <p id="copy">Copyright (c) 2010-<?php  echo date('Y'); ?> <a href="https://jakub.jankiewicz.org/">Jakub T. Jankiewicz</a> Website: <a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a> <span style="display:none"><a href="https://plus.google.com/104010221373218601154?rel=author">g+</a></span> <span>source on <a href="https://github.com/jcubic/jquery.terminal-www">github</a></p>
    </footer>
    <? if ($_SERVER["HTTP_HOST"] != "localhost" && !isset($_GET['track'])): ?>
    <!-- Start Open Web Analytics Tracker -->
    <script type="text/javascript">
    //<![CDATA[
    var owa_baseUrl = 'https://stats.jcubic.pl/';
    var owa_cmds = owa_cmds || [];
    owa_cmds.push(['setSiteId', '9b6210e220f27093109ddf895e626f1a']);
    owa_cmds.push(['trackPageView']);
    owa_cmds.push(['trackClicks']);
    (function() {
        var _owa = document.createElement('script'); _owa.type = 'text/javascript'; _owa.async = true;
        owa_baseUrl = ('https:' == document.location.protocol ? window.owa_baseSecUrl || owa_baseUrl.replace(/http:/, 'https:') : owa_baseUrl );
        _owa.src = owa_baseUrl + 'modules/base/js/owa.tracker-combined-min.js';
        var _owa_s = document.getElementsByTagName('script')[0]; _owa_s.parentNode.insertBefore(_owa, _owa_s);
    }());
    //]]>
    </script>
    <!-- End Open Web Analytics Code -->
    <? endif; ?>
  </body>
</html>
