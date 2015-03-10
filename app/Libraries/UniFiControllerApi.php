<?php namespace App\Libraries;
/**
 * Author: Sid Wu
 * Date: 15/3/10
 * Time: 上午10:52
 */

class UniFiControllerApi {

    private $_cookie_file_path='';
    public function __construct() {
        $this->_cookie_file_path = Config::get('unifi.cookie_file_path');
    }

    public function login($server, $user, $password) {
        // Start Curl for login
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookie_file_path);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookie_file_path);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Login to the UniFi controller
        curl_setopt($ch, CURLOPT_URL, $server . "/login");
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "login=login&username=" . $user . "&password=" . $password);
        curl_exec($ch);
        curl_close($ch);
    }

    public function logout($server) {
        // Logout of the connection
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookie_file_path);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookie_file_path);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, $server . '/logout');
        curl_exec($ch);
        curl_close($ch);
    }

    public function authorize($server, $user, $password, $site, $mac, $expire_mins) {
        $this->login($server, $user, $password);

        // Send user to authorize and the time allowed
        $data = json_encode(
            array(
                'cmd' => 'authorize-guest',
                'mac' => $mac,
                'minutes' => $expire_mins,
            )
        );
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookie_file_path);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookie_file_path);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, $server . '/api/s/' . $site . '/cmd/stamgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json=' . $data);
        curl_exec($ch);
        curl_close($ch);

        $this->logout($server);
    }

    public function unauthorize($server, $user, $password, $mac) {
        $this->login($server, $user, $password);

        // Send user to unauthorize and the time allowed
        $data = json_encode(
            array(
                'cmd' => 'unauthorize-guest',
                'mac' => $mac,
            )
        );
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookie_file_path);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookie_file_path);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, $server . '/api/cmd/stamgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json=' . $data);
        curl_exec($ch);
        curl_close($ch);

        $this->logout($server);
    }

}