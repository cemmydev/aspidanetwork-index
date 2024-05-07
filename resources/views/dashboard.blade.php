<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require 'config.php'; 
// require 'database.php';
// require 'functions_new.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Aspida Private Servers: Ultimate Strategy Gaming</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Experience the thrill of strategy and conquest on Aspida Private Servers. Engage in epic battles and build your empire in our immersive MMO world.">
    <meta name="keywords" content="Aspida Private Servers, Online Strategy Games, MMO Gaming, Free Multiplayer Games, Travian Server Clone, multiple speeds, high speed servers, Free Gold, ">
    <!-- Consolidated Content-Security-Policy header -->
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.aspidanetwork.com https://static.cloudflareinsights.com https://www.googletagmanager.com https://static.getclicky.com https://cdn.matomo.cloud https://statcounter.com https://www.google-analytics.com https://in.getclicky.com;">
    <!-- Referrer Policy -->
    <meta name="referrer" content="no-referrer">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amaranth:ital,wght@0,400;0,700;1,400;1,700&family=Protest+Riot&family=Rubik+Burned&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" >
    <!-- Favicons and Manifest -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Canonical Link -->
    <link rel="canonical" href="https://www.aspidanetwork.com">
    <!-- Additional Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <!-- JavaScript -->
    <script src="{{asset('js/script.js')}}"></script>
</head>

<body>
       <div class="top-bar">
        <button id="play-now-button" class="button">Play now</button>
        <div class="server-info">
            {{-- <span id="servertime" title="Server Time"><?php echo getServerTime(); ?></span> --}}
        </div>
        <button id="right-button" class="button">Services</button>
    </div>
    <div class="svg-container">
  <svg viewBox="0 0 1320 300">
  <defs>
    <linearGradient id="metallicGradient" gradientTransform="rotate(45)">
      <stop offset="0%" stop-color="#929292" />
      <stop offset="50%" stop-color="#e9e9e9" />
      <stop offset="100%" stop-color="#929292" />
    </linearGradient>
  </defs>
  <text x="50%" y="90%" dy=".35em" text-anchor="middle">
    Aspida
  </text>
  <text x="50%" y="120%" dy=".35em" text-anchor="middle" class="small-text">
    Private Servers
  </text>
</svg>
</div>
    
    <!-- Left popup modal -->
<div id="left-popup" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="select-server-header">Select Server to Play</h2>
		<div class="header-line"></div>
        <ul class="server-list" id="server-list"></ul>
<div id="server-info-popup" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
		<h1 id="server-info-title">Server Info</h1>
		<div class="header-line"></div>
		<h2 class="h2-info" >Round Progress</h2>        
        <div class="progress-bar-and-text">
            <div class="progress-container">
                <div class="progress-bar-background" title="Round progress">
                    <div id="progress-bar" class="progress-bar-fill" style="width: 0%;"></div>
                    <div class="divider divider-1"></div>
                    <div class="divider divider-2"></div>
                </div>
                <div class="stage-labels">
                    <div class="stage-label">Artifacts</div>
                    <div class="stage-label">Building Plans</div>
                </div>
            </div>
            <p id="progress-text">0%</p>
			
        </div>
		<p class="info-line"><span class="material-symbols-outlined round-start-time" title="Round since started or time to start"></span><span id="round-start-time" ></span></p>
        <p class="info-line"><span class="material-symbols-outlined" title="Total registered players"><span class="material-symbols-outlined">group</span></span> Register Players:&nbsp; <span id="total-registered-value"></span></p>
		<p class="info-line"><span class="material-symbols-outlined total-players-symbols" title="Online players">group</span> Online Players:&nbsp; <span id="online-players-value"></span></p>
		<p class="info-line"><span class="material-symbols-outlined gold-dollar" title="Free gold you will receive when your account reaches 1.000 population"></span>Free Gold:&nbsp;<span id="free-gold-value">Loading...</span></p>

		
        <div class="action-buttons">
            <a id="login-button" class="server-button">Login</a>
            <a id="register-button" class="server-button">Register</a>
        </div>
    </div>
</div>

</div>

    </div>
	
<!-- Right popup modal -->
<div id="right-popup" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="select-server-header">More Services</h2>
        <div class="header-line"></div>
        <!-- Buttons -->
        <button class="server-button" title="Enter your email to check for any unredeemed coupons">Coupons</button>
        <button class="server-button" data-button="webmail" title="Are you tired of not receiving your registration emails? Use our free webmail services for the game or personal purposes and stay on top of your emails.">Free email</button>
        <button class="server-button" data-button="news" title="Stay ahead with the latest news! Click here for updates, exclusive game news, announcements, and highlights. Whether you're looking for recent changes, new features, or just want to stay in the loop, everything you need to know is just a click away">News</button>
		<button class="server-button" data-button="rules" title="Understand the rules to play fair and enjoy the game to its fullest. Click here to review the essential guidelines, terms of service, and policies to ensure a positive and respectful community experience for all players">Rules</button>
		<button class="server-button" data-button="our-network" title="Step into our world of diverse digital experiences! From secure webmail services and thrilling casino games to expert betting predictions, discover a wide range of services designed to entertain, assist, and enhance your online journey. Click to explore and take advantage of what our network has to offer">Our Network</button>
	</div>
</div>
<div id="coupon-check-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-coupon-modal">&times;</span>
        <h2 class="select-server-header">Check for coupons</h2>
        <div class="header-line"></div>
        <form id="couponRedeemForm" class="submitCouponRedeem" action="api.php" method="POST">
            <input type="hidden" name="coupon_reminder" value="1">
            <div>
                
                <input type="email" id="email-input" name="email" class="textField" placeholder="Enter your email">
            </div>
            <div class="messages" style="display:none">
                <ul></ul>
            </div>
            <div>
                <button class="server-button" type="submit" id="submit-coupon-check">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Free Webmail Services Modal -->
<div id="webmail-services-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-webmail-modal">&times;</span>
        <h2 class="select-server-header">Free Webmail Services</h2>
        <div class="header-line"></div>
        <p class="webmail-description">
            Don’t let your epic gaming adventure be hindered by lost emails. Major email providers might mistakenly flag important game emails like registration verifications as spam, causing you to miss out on crucial updates. Our dedicated webmail service ensures that every piece of your game communication lands directly in your inbox, not in the spam folder.

But that's not all - our webmail isn't just for gaming. It's a full-featured personal email service that you can use for all your online activities. With our reliable and secure webmail, manage your personal emails with ease and confidence. Register now to elevate your gaming experience and take control of your digital communication.
        </p>
        <div class="action-buttons">
            <a href="https://eazyinbox.com/" target="_blank" class="server-button" id="login-webmail-button">Login</a>
            <a href="https://eazyinbox.com/index.php?page=user/registration" target="_blank" class="server-button" id="signup-webmail-button">Register</a>
        </div>
    </div>
</div>
<!-- News Modal -->
<div id="news-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-news-modal">&times;</span>
        <h2 class="select-server-header">Our News</h2>
        <div class="header-line"></div>
        <div class="news-container">
            <!-- News items will be appended here -->
        </div>
    </div>
</div>
<!-- Rules Modal -->
<div id="rules-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-rules-modal">&times;</span>
        <h2 class="select-server-header">Game Rules</h2>
        <div class="header-line"></div>
        <div class="rules-container">
            <!-- Rules items will be appended here -->
        </div>
    </div>
</div>
<!-- Our Network Modal -->
<div id="our-network-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-our-network-modal">&times;</span>
        <h2 class="select-server-header">Our Network</h2>
        <div class="header-line"></div>
        <div class="network-container">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>
</div>


<div class="bottom-bar">
    <div class="social-links">
        <!-- Social media links -->
        <a href="https://www.facebook.com/aspidanetwork" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/aspidagames" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com/p/CxO5RyqS6rm/?igshid=MzRlODBiNWFlZA==" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://discord.gg/RR7nqxgF" target="_blank" title="Discord"><i class="fab fa-discord"></i></a>
        <a href="https://www.youtube.com/channel/UCb7wcPQMaLC-Z8H3uYvG94Q" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
        <a href="https://www.linkedin.com/profile/guided?trk=uno-choose-ge-no-intent&dl=no" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
        <a href="https://api.whatsapp.com/send?phone=%2B61403334250&data=AWCaYSFeA_FXOJ_sfA0UrZDI_wKOT7CVGmgKJ8t4OFfAW6ZJbgASg1irf5UXquK_ssPKlbJrJhvbr4AFtXJwIHHAihHRTIAYGp0-u3agTXfw9STtYwn23sSwWbl27J_SQfP1iA8J5U_XDX2xnKhBUXHXvqDD-xk3Huukx-TyoljInMu6-oBJ_cighiP22W1zagQaA_xc7_u_ClkAnnidTROqSD0vIhZ_nKdINnG1h5C9SEloKofk6BZsozoFLnSCfS1Mr8JNh7da3V5Xjgb98m0g-9bggNK2ebiGQcgz_mLw-Y8&source=FB_Page&app=facebook&entry_point=page_cta&fbclid=IwAR0HpW-sTetbqeTD_sN6bzG-PJ2mPsvP2NSl4cA7edi6GXrUeJ1o4qaEBcg" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
    </div>
    <div class="copy-text">© 2014-<span id="current-year"></span> Aspida Private Servers. All Rights Reserved.</div>

</div>

		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110012133-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110012133-1');
</script>
<!-- Default Statcounter code for Aspidanetwork
aspidanetwork.com -->
<script>
var sc_project=10596847; 
var sc_invisible=0; 
var sc_security="c534044a"; 
var scJsHost = "https://";
var scScript = document.createElement("script");
scScript.src = scJsHost + "statcounter.com/counter/counter.js";
document.head.appendChild(scScript);
</script>


<noscript><div class="statcounter"><a title="Web Analytics
Made Easy - Statcounter" href="https://statcounter.com/"
target="_blank"><img class="statcounter"
src="https://c.statcounter.com/10596847/0/c534044a/0/"
alt="Web Analytics Made Easy - Statcounter"
referrerPolicy="no-referrer-when-downgrade"></a></div></noscript>
<!-- End of Statcounter Code -->
</body>
</html>
