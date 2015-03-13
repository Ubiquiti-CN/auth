<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Libraries\UniFiControllerApiFactory;
use App\Models\GlobalConfig;
use App\Models\SiteConfig;
use App\Models\NoPasswordLog;
use Auth;
use Notification;

class AuthController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index($site, Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $config = new SiteConfig();
        $config = $config::where('user_id', '=', $user_id)->where('site', '=', $site)->first();
        $site_config = is_object($config) ? json_decode($config->data, true) : array();
        $expired_time = isset($site_config['authTime']) ? $site_config['authTime'] : 3000;
        if (!isset($site_config['auth_type'])) {

        }

        $model = new GlobalConfig();
        $config = $model::where('user_id', '=', $user_id)->first();
        $global_config = is_object($config) ? json_decode($config->data, true) : array();

        $unifi_version = $global_config['controllerVersion'];
        $unifi_host = $global_config['controllerHost'];
        $unifi_user = $global_config['controllerUsername'];
        $unifi_password = $global_config['controllerPassword'];

        $api_factory = UniFiControllerApiFactory::get_instance($unifi_version);

        $input = $request->all();
        switch ($site_config['auth_type']) {
            case 'nopassword'://无需密码
                $client_mac = isset($input['id']) ? $input['id'] : '';
                $url = isset($input['url']) ? $input['url'] : 'http://www.ubnt.com.cn';
                $log = new NoPasswordLog();
                $log::where('user_id', '=', $user_id)->where('site', '=', $site)->where('client_mac', '=', $client_mac)->delete();
                $log->client_mac = $client_mac;
                $log->user_id = $user_id;
                $log->site = $site;
                $log->save();
                $api_factory->authorize($unifi_host, $unifi_user, $unifi_password, $site, $client_mac, $expired_time);
                // todo 跳转广告或默认页面
                echo "<pre>";var_dump($client_mac);
                break;
            case 'password'://密码
                break;
            case 'sms'://短信
                break;
            default:
                break;
        }
        echo "<pre>";print_r($site_config);exit;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
