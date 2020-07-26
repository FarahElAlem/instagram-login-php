<html>
<head>
	<title>Login with Instagram 9lessons Demos</title>
	<style>
body
{
	
	font-family: "lucida grande",tahoma,verdana;
}

	span

	{

	color:#cc0000;

	}
	div
	{
		word-wrap: break-word;
		
	}
	</style>
	</head>
	<body>
<div>		
<h1>Login with Instagram - www.9lessons.info</h1><span style='float:right'><a href='?id=logout'>Logout</a></span>	
</div>		
<h2>User Details</h2>
<?php
session_start();
if($_GET['id']=='logout')
{
unset($_SESSION['userdetails']);
session_destroy();
	
	
}
require 'db.php';
require 'instagram.class.php';
require 'instagram.config.php';

if (!empty($_SESSION['userdetails'])) 
{
$data=$_SESSION['userdetails'];


echo "<div style='float:left;margin-right:10px'><img src=\"{$data->user->profile_picture}\" ></div><div style='float:left'>";  
echo '<b>Name:</b> '.$data->user->full_name.'</br>';
echo '<b>Username:</b> '.$data->user->username.'</br>';
echo '<b>User ID:</b> '.$data->user->id.'</br>';
echo '<b>Bio:</b> '.$data->user->bio.'</br>';
echo '<b>Website:</b> '.$data->user->website.'</br>';
echo '<b>Profile Pic:</b> '.$data->user->profile_picture.'</br>';
echo '<b>Access Token:</b> '.$data->access_token.'</br></div>';
  
  

// Store user access token
$instagram->setAccessToken($data);

  


}
else
{	
header('Location: index.php');
}

?>
<div style='clear:both'></div>
	<div height="125px" style='margin:10px'>
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
<h2>Data Insert SQL Statment</h2>
<div style='margin-bottom:20px'>
insert into <span><b>users</b></span><br/>(username,name,bio,website,instagram_id,instagram_access_token) <br/> values <br/> ("<span><?php echo $data->user->username;?></span>","<span><?php echo $data->user->full_name ;?></span>","<span><?php echo $data->user->bio ;?></span>","<span><?php echo $data->user->website ;?></span>","<span><?php echo $data->user->id ;?></span>","<span><?php echo $data->access_token ;?></span>");

</div>
<div height="125px" style='margin:10px 10px 10px 10px'>
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
<h2>Your Photos</h2>
<div>
<?php
$popular = $instagram->getUserMedia($data->user->id);

// Display results
foreach ($popular->data as $data) {
  echo "<img src=\"{$data->images->thumbnail->url}\">";
}

?>
</div>

<h2>Instagram Data Array</h2>
<div>
	<?php 
	echo '<pre>';
	   print_r($data);
	   echo '<pre>';
	
	?>
	</div>
	<iframe src="http://demos.9lessons.info/counter.html" frameborder="0" scrolling="no" height="0"></iframe>
	
</body>
</html>