<?php 
/* 
 * Instagram API Class 
 * This class helps to authenticate with Instagram API 
 * @author    CodexWorld.com 
 * @url        http://www.codexworld.com 
 * @license    http://www.codexworld.com/license 
 */ 
class InstagramAuth { 
    public $client_id         = ''; 
    public $client_secret     = ''; 
    public $redirect_url     = ''; 
    private $act_url         = 'https://api.instagram.com/oauth/access_token'; 
    private $ud_url         = 'https://api.instagram.com/v1/users/self/'; 
     
    public function __construct(array $config = array()){ 
        $this->initialize($config); 
    } 
     
    public function initialize(array $config = array()){ 
        foreach ($config as $key => $val){ 
            if (isset($this->$key)){ 
                $this->$key = $val; 
            } 
        } 
        return $this; 
    } 
     
    public function getAuthURL(){ 
        $authURL = "https://api.instagram.com/oauth/authorize/?client_id=" . $this->client_id . "&redirect_uri=" . urlencode($this->redirect_url) . "&response_type=code&scope=user_profile,user_media"; 
        return $authURL; 
    } 
     
    public function getAccessToken($code) {     
        $urlPost = 'client_id='. $this->client_id . '&client_secret=' . $this->client_secret . '&redirect_uri=' . $this->redirect_url . '&code='. $code . '&grant_type=authorization_code'; 
        $ch = curl_init();         
        curl_setopt($ch, CURLOPT_URL, $this->act_url);         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POST, 1);         
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlPost);             
        $data = json_decode(curl_exec($ch), true);     
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);     
        curl_close($ch); 
        if($http_code != '200'){     
            throw new Exception('Error : Failed to receive access token'.$http_code); 
        } 
        return $data['access_token'];     
    } 
 
    public function getUserProfileInfo($access_token) {  
        $url = $this->ud_url.'?access_token=' . $access_token;     
 
        $ch = curl_init();         
        curl_setopt($ch, CURLOPT_URL, $url);         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        $data = json_decode(curl_exec($ch), true); 
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);     
        curl_close($ch);  
        if($data['meta']['code'] != 200 || $http_code != 200){ 
            throw new Exception('Error : Failed to get user information'); 
        } 
        return $data['data']; 
    } 
}