<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\SiteConfig;
use Illuminate\Http\Request;

use App\Libraries\UniFiControllerApiFactory;
use App\Http\Controllers\Config\GlobalController;
use Auth;

class ConfigController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// todo unifi api get all sites (different version)
        $user = Auth::user();
        $user_id = $user->id;

        $model = new GlobalConfig();
        $config = $model::where('user_id', '=', $user_id)->first();
        $global_config = is_object($config) ? json_decode($config->data, true) : array();
        echo "<pre>";print_r($global_config);
        // todo judge global config
        $unifi_version = $global_config['controllerVersion'];
        $unifi_host = $global_config['controllerHost'];
        $unifi_user = $global_config['controllerUsername'];
        $unifi_password = $global_config['controllerPassword'];

        $api_factory = UniFiControllerApiFactory::get_instance($unifi_version);
        $sites = $api_factory->get_all_sites($unifi_host, $unifi_user, $unifi_password);
        print_r($sites);exit;
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
        $site = '';

        $config = new SiteConfig();

        $config::where('user_id', '=', $user_id)->where('site', '=', $site)->delete();

        $config->data = json_encode($input);
        $config->user_id = $user_id;
        $config->site = $site;
        $config->save();
        return redirect('site/detail');//site参数
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
        $user = Auth::user();
        $user_id = $user->id;

        $model = new SiteConfig();
        $config = $model::where('user_id', '=', $user_id)->where('site', '=', $id)->first();

        $site_config = is_object($config) ? json_decode($config->data, true) : array();

        return view('site/detail', ['config' => $site_config]);
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
