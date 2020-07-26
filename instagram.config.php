<?php
// Setup class
  $instagram = new Instagram(array(
    'apiKey'      => 'Client_ID',
    'apiSecret'   => 'Client_Secret',
    'apiCallback' => 'http://www.yoursite.com/success.php' // must point to success.php
  ));

?>