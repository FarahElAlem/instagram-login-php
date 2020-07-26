<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Instagram OAuth Login - 9lessons Demo</title>

<style type="text/css">
      * {
        margin: 0px;
        padding: 0px;
      }

      a.button {
        background: url(instagram-login-button.png) no-repeat transparent;
        cursor: pointer;
        display: block;
        height: 29px;
        margin: 50px auto;
        overflow: hidden;
        text-indent: -9999px;
        width: 200px;
      }

      a.button:hover {
        background-position: 0 -29px;
      }
    </style>


  </head>
  <body>
	<div style='text-align:center'>
		<div height="125px" style='padding-top:10px'>

			<div height="125px">
				<script type="text/javascript"><!--
				 google_ad_client = "pub-6904774409601870";
				 /* 728x90, created 2/8/10 */
				 google_ad_slot = "4242245788";
				 google_ad_width = 728;
				 google_ad_height = 90;
				 //-->
				 </script>
				 <script type="text/javascript"
				 src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				 </script>



			</div>

		</div>
<h1>Login with Instragram</h1>
OAuth using PHP <a href='http://www.9lessons.info'>9lessons.info</a>
    <?php
session_start();
if (!empty($_SESSION['userdetails'])) 
{
	header('Location: home.php');
}
      require 'instagram.class.php';
      require 'instagram.config.php';
      
      // Display the login button
      $loginUrl = $instagram->getLoginUrl();
      echo "<a class=\"button\" href=\"$loginUrl\">Sign in with Instagram</a>";
    ?>

  </body>
<iframe src="http://demos.9lessons.info/counter.html" frameborder="0" scrolling="no" height="0"></iframe>

</html>