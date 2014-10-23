<?php

class UniFi {

    private static $site=NULL;
    public static function set_site($site) {
        self::$site = $site;
    }

    public static function get_site() {
        return self::$site;
    }

    private function __construct() {}

    public static function sendAuthorization($id, $minutes) {
        self::login();
        self::authorize($id, $minutes);
        self::logout();
    }

    public static function sendUnauthorization($id) {
        self::login();
        self::unauthorize($id);
        self::logout();
    }

    private static function login() {
        // Start Curl for login
        $ch = curl_init();

        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
        curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Login to the UniFi controller
        curl_setopt($ch, CURLOPT_URL, UNIFI_SERVER . "/login");
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "login=login&username=" . UNIFI_USER . "&password=" . UNIFI_PASSWORD);

        curl_exec($ch);
        curl_close($ch);
    }

    private static function authorize($id, $minutes) {
        // Send user to authorize and the time allowed
        $data = json_encode(
            array(
                'cmd' => 'authorize-guest',
                'mac' => $id,
                'minutes' => $minutes,
            )
        );

        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
        curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, UNIFI_SERVER . '/api/s/' . self::get_site() . '/cmd/stamgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json=' . $data);

        curl_exec($ch);
        curl_close($ch);
    }

    private static function unauthorize($id) {
        // Send user to unauthorize and the time allowed
        $data = json_encode(
            array(
                'cmd' => 'unauthorize-guest',
                'mac' => $id,
            )
        );

        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
        curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, UNIFI_SERVER . '/api/cmd/stamgr');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'json=' . $data);

        curl_exec($ch);
        curl_close($ch);
    }

    private static function logout() {
        // Logout of the connection
        $ch = curl_init();
        // We are posting data
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // Set up cookies
        curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE_PATH);
        curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE_PATH);
        // Allow Self Signed Certs
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // Force SSL3 only
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        // Make the API Call
        curl_setopt($ch, CURLOPT_URL, UNIFI_SERVER . '/logout');

        curl_exec($ch);
        curl_close($ch);
    }

}
