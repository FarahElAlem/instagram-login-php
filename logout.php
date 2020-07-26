<?php 
// Remove user data from session 
unset($_SESSION['userData']); 
 
// Redirect to the homepage 
header("Location:index.php"); 
?>