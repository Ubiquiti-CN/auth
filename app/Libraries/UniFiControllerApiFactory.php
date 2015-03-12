<?php namespace App\Libraries;
/**
 * Author: Sid Wu
 * Date: 15/3/10
 * Time: 上午10:52
 */

use Config;

class UniFiControllerApiFactory {

    private function __construct() {}

    /*
     * version 3.2.1&3.2.5 use ssl v3
     * version 3.2.7&3.2.10 use ssl v1
     */
    public static function get_instance($version) {
        switch ($version) {
            case '3.2.1':
            case '3.2.5':
                return new UniFiControllerApiV321();
                break;
            case '3.2.7':
            case '3.2.10':
                return new UniFiControllerApiV327();
                break;
            default:
                return new UniFiControllerApiV321();
                break;
        }
    }
}

abstract class UniFiControllerApi {

    abstract public function get_cookie_file_path();
    abstract public function get_ssl_version();

    public function login($server, $user, $password) {
        // Start Curl for login
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->get_cookie_file_path());
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->get_cookie_file_path());
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, $this->get_ssl_version());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Login to the UniFi controller
        curl_setopt($ch, CURLOPT_URL, $server . "/login");
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "login=login&username=" . $user . "&password=" . $password);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function logout($server) {
        // Logout of the connection
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->get_cookie_file_path());
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->get_cookie_file_path());
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, $this->get_ssl_version());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->get_cookie_file_path());
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->get_cookie_file_path());
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, $this->get_ssl_version());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->get_cookie_file_path());
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->get_cookie_file_path());
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, $this->get_ssl_version());
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, $server . '/api/cmd/stamgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json=' . $data);
        curl_exec($ch);
        curl_close($ch);

        $this->logout($server);
    }

    public function get_all_sites($server, $user, $password) {
        $this->login($server, $user, $password);

        // Send user to unauthorize and the time allowed
        $data = json_encode(
            array(
                'cmd' => 'get-sites',
            )
        );
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->get_cookie_file_path());
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->get_cookie_file_path());
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, $this->get_ssl_version());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, $server . '/api/s/default/cmd/sitemgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json=' . $data);
        $result = curl_exec($ch);
        curl_close($ch);

        $this->logout($server);

        $result = json_decode($result, TRUE);

        if ($result['meta']['rc'] == 'error') {
            throw new UniFiControllerApiException();
        }

        return $result['data'];
    }

}

class UniFiControllerApiException extends \Exception {

}

class UniFiControllerApiV321 extends UniFiControllerApi {

    public function get_cookie_file_path() {
        return Config::get('unifi.cookie_file_path');
    }

    public function get_ssl_version() {
        return 3;
    }

}

class UniFiControllerApiV327 extends UniFiControllerApi {

    public function get_cookie_file_path() {
        return Config::get('unifi.cookie_file_path');
    }

    public function get_ssl_version() {
        return 1;
    }

}
