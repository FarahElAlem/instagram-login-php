<?php 
// Include configuration file 
require_once 'config.php'; 
 
// Include User class 
require_once 'User.class.php'; 
 
// If URL contains 'code' parameter that passed by Instagram in the Redirect URL 
if(isset($_GET['code'])){ 
    try { 
        // Get the access token  
        $access_token = $instagram->getAccessToken($_GET['code']); 
 
        // Get user profile info 
        $userData = $instagram->getUserProfileInfo($access_token); 
    } catch (Exception $e) { 
        $authErr = $e->getMessage(); 
    } 
     
    if(!empty($userData)){ 
        $username = $userData['username']; 
        $full_name = $userData['full_name']; 
        $full_name_arr = explode(' ',$full_name); 
        $first_name = !empty($full_name_arr[0])?$full_name_arr[0]:''; 
        $last_name = !empty($full_name_arr[1])?$full_name_arr[1]:''; 
        $link = 'https://www.instagram.com/'.$username; 
         
        // Initialize User class 
        $user = new User(); 
         
        // Getting user's profile data 
        $intUserData = array(); 
        $intUserData['oauth_uid']     = $userData['id']; 
        $intUserData['username']      = $username; 
        $intUserData['first_name']     = $first_name; 
        $intUserData['last_name']      = $last_name; 
        $intUserData['picture']    = !empty($userData['profile_picture'])?$userData['profile_picture']:''; 
        $intUserData['link']       = $link; 
        $intUserData['email']      = ''; 
        $intUserData['gender']     = ''; 
 
        // Insert or update user data to the database 
        $intUserData['oauth_provider'] = 'instagram'; 
        $userData = $user->checkUser($intUserData); 
         
        // Storing user data in the session 
        $_SESSION['userData'] = $userData; 
         
        // Get logout url 
        $logoutURL = INSTAGRAM_REDIRECT_URI.'logout.php'; 
         
        // Render Instagram profile data 
        $output  = '<h2>Instagram Profile Details</h2>'; 
        $output .= '<div class="ac-data">'; 
        $output .= '<img src="'.$userData['picture'].'"/>'; 
        $output .= '<p><b>Account ID:</b> '.$userData['oauth_uid'].'</p>'; 
        $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>'; 
        $output .= '<p><b>Logged in with:</b> Instagram</p>'; 
        $output .= '<p><b>Profile Link:</b> <a href="'.$userData['link'].'" target="_blank">Click to visit Instagram page</a></p>'; 
        $output .= '<p><b>Logout from <a href="'.$logoutURL.'">Instagram</a></p>'; 
        $output .= '</div>'; 
    }else{ 
        $output = '<h3 style="color:red">Instagram authentication has failed!</h3>'; 
        if(!empty($authErr)){ 
            $output = '<p style="color:red">'.$authErr.'</p>'; 
        } 
    } 
}else{ 
    // Get login url 
    $authURL = $instagram->getAuthURL(); 
     
    // Render Instagram login button 
    $output = '<a href="'.htmlspecialchars($authURL).'" class="instagram-btn"><span class="btn-icon"></span><span class="btn-text">Login with Instagram</span></a>'; 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Login with Instagram using PHP by CodexWorld</title>
<meta charset="utf-8">

<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="inst-box">
        <!-- Display login button / Instagram profile information -->
        <?php echo $output; ?>
    </div>
</div>
</body>
</html>