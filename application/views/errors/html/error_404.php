<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>404 HTML Tempate by Colorlib</title>

        <!-- Google font -->
        <style id="" media="all">
        @font-face {
            font-family: 'Maven Pro';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/mavenpro/v22/7Auup_AqnyWWAxW2Wk3swUz56MS91Eww8SX21nejpA.woff) format('woff');
        }

        @font-face {
            font-family: 'Maven Pro';
            font-style: normal;
            font-weight: 900;
            src: url(/fonts.gstatic.com/s/mavenpro/v22/7Auup_AqnyWWAxW2Wk3swUz56MS91Eww8Yzx1nejpA.woff) format('woff');
        }
        </style>

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="http://localhost/myvoqu/assets_404/css/css-style.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>

    <body>

        <div id="notfound">
            <div class="notfound">
                <div class="notfound-404">
                    <h1>404</h1>
                </div>
                <h2>We are sorry, Page not found!</h2>
                <p>The page you are looking for might have been removed had its name changed or is temporarily
                    unavailable.</p>
                <a href="">Back To Homepage</a>

                <p id="demo"></p>

                <script>
                document.getElementById("demo").innerHTML =
                    "Page path is: " + window.location.pathname;
                </script>

            </div>
        </div>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
        <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
        </script>
    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>