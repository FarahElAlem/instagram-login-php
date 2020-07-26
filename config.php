<?php 
/* 
 * Basic Site Settings and API Configuration 
 */ 
 
// Database configuration 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'instagram'); 
define('DB_USER_TBL', 'users'); 
 
// Instagram API configuration 
define('INSTAGRAM_CLIENT_ID', '291296452292996'); 
define('INSTAGRAM_CLIENT_SECRET', 'dd97361982fb4f5e505d3023b338791d'); 
define('INSTAGRAM_REDIRECT_URI', 'https://floating-peak-73723.herokuapp.com/auth/'); 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
/* 
 * For the internal purposes only  
 * changes not required 
 */ 
 
// Include Instagram OAuth library 
require_once 'InstagramAuth.class.php'; 
 
// Initiate Instagram Auth class 
$instagram = new InstagramAuth(array( 
    'client_id' => INSTAGRAM_CLIENT_ID, 
    'client_secret' => INSTAGRAM_CLIENT_SECRET, 
    'redirect_url' => INSTAGRAM_REDIRECT_URI 
)); 