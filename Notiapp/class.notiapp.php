<?php
/**
 * Notiapp Class to send Desktop notifications via Notiapp
 *
 * @author Karan s. Sisodia
 * @link http://www.karansinghsisodia.com author website
 * @link https://github.com/sisodiakaran/notiapp-api-php-client Documentation
 */
class Notiapp {

    public $api_url = 'https://www.notiapp.com/api/v1/';
    public $app_token = 'your-application-token';
    
    /**
     * Function to get request token
     * @param string $redirect_url
     * @return mixed
     */
    public function get_request_token($redirect_url){
        $params = array(
            'app' => $this->app_token,
            'redirect_url' => $redirect_url
        );
        
        $response = $this->_request('request_access', $params);
        if($response['status'] != 'not-found'){
            $output = $response;
        } else {
            $output = 'error';
        }
        return $output;
    }
    
    /**
     * Function to get access token
     * @param string $request_token
     * @return mixed
     */
    public function get_access_token($request_token){
        $params = array(
            'app' => $this->app_token,
            'request_token' => $request_token
        );
        
        $response = $this->_request('get_access_token', $params);
        if($response['status'] != 'not-found'){
            $output = $response['access_token'];
        } else {
            $output = 'error';
        }
        return $output;
    }
    
    /**
     * Function to send notification to a user
     * @param array $notification
     * @return string
     */
    public function send_notification($notification){
        
        if(is_array($notification['user'])){
            $user = implode(',', $notification['user']);
            $operation = 'bulk';
        } else {
            $user = $notification['user'];
            $operation = 'add';
        }
        
        $params = array(
            'app'                   => $this->app_token,
            'user'                  => $notification['user'],
            'notification[title]'   => $notification['title'],
            'notification[url]'     => $notification['url'],
            'notification[sound]'   => $notification['sound'],
            'notification[image]'   => $notification['image']
        );
        
        $response = $this->_request($operation, $params);
        if($response['status'] != 'not-found'){
            $output = $response;
        } else {
            $output = 'error';
        }
        return $output;
    }
    
    /**
     * Function to send curl request
     * @param string $url
     * @param array $params
     * @return array
     */
    private function _request($url, $params){
        // Get cURL resource
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->api_url . $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        
        return json_decode($resp, TRUE);
    }
}

function pr($arg){
    echo '<pre>';
    print_r($arg);
    echo '</pre>';
}
