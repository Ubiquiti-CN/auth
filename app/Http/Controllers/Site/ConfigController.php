<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Libraries\UniFiControllerApiException;
use App\Models\SiteConfig;
use Illuminate\Http\Request;

use App\Libraries\UniFiControllerApiFactory;
use App\Models\GlobalConfig;
use Auth;
use Notification;


class ConfigController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Auth::user();
        $user_id = $user->id;

        $model = new GlobalConfig();
        $config = $model::where('user_id', '=', $user_id)->first();
        $global_config = is_object($config) ? json_decode($config->data, true) : array();

        $unifi_version = $global_config['controllerVersion'];
        $unifi_host = $global_config['controllerHost'];
        $unifi_user = $global_config['controllerUsername'];
        $unifi_password = $global_config['controllerPassword'];

        $api_factory = UniFiControllerApiFactory::get_instance($unifi_version);
        try {
            $sites = $api_factory->get_all_sites($unifi_host, $unifi_user, $unifi_password);
        } catch (UniFiControllerApiException $exception) {
            Notification::error('Controller连接失败，请检查Controller部分的配置！');
            return redirect('config/global');
        }

        return view('site/list', ['sites' => $sites]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{

        $user = Auth::user();
        $user_id = $user->id;

        $input = $request->all();
        $site_id = $input['site_id'];

        $this->validate($request, [
            'authTime' => 'required|integer',
            'redirectUrl' => 'required|url',
            'waitTime' => 'required|integer',
            'auth_type' => 'required',
            'site_id' => 'required',
        ]);

        if (isset($input['waitPic'])) {
            $this->validate($request, [
                'waitPic' => 'required|image|max:1024',
            ]);

            $destination_path = public_path() . '/images/sites/';
            $ext = $request->file('waitPic')->getClientOriginalExtension();
            $file_name = 'wait_' . md5($user_id . $site_id) . '.' . $ext;
            $request->file('waitPic')->move($destination_path, $file_name);

            $upload_status = $request->File('waitPic')->getError();

            if ($upload_status !== UPLOAD_ERR_OK) {
                $error_message = $request->file('waitPic')->getErrorMessage();
                Notification::error($error_message);
                return redirect('site/detail/' . $site_id);
            }

            $input['waitPic'] = $file_name;
        } else if (isset($input['_waitPic'])) {
            $input['waitPic'] = $input['_waitPic'];
            unset($input['_waitPic']);
        } else {
            $this->validate($request, [
                'waitPic' => 'required|image|max:1024',
            ]);
        }

        $config = new SiteConfig();

        $config::where('user_id', '=', $user_id)->where('site', '=', $site_id)->delete();

        $config->data = json_encode($input);
        $config->user_id = $user_id;
        $config->site = $site_id;
        $config->save();

        Notification::success('保存成功');

        return redirect('site/detail/' . $site_id);//site参数
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
	 * @param  string  $id
	 * @return Response
	 */
	public function show($site_id, Request $request)
	{
        $auth_type = $request->input('auth_type');

        $user = Auth::user();
        $user_id = $user->id;

        $model = new SiteConfig();
        $config = $model::where('user_id', '=', $user_id)->where('site', '=', $site_id)->first();

        $site_config = is_object($config) ? json_decode($config->data, true) : array();

        $auth_type = $auth_type ? $auth_type : (isset($site_config['auth_type']) ? $site_config['auth_type'] : 'nopassword');

        return view('site/detail', ['config' => $site_config, 'site_id' => $site_id, 'auth_type' => $auth_type]);
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
