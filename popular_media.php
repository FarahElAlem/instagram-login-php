<?php

require 'instagram.class.php';

// Initialize class for public requests
$instagram = new Instagram('Client_ID');

// Get popular media
//$popular = $instagram->getMedia(3047388)
$popular = $instagram->getPopularMedia();

// Display results
foreach ($popular->data as $data) {
  echo "<img src=\"{$data->images->thumbnail->url}\">";
}

?>