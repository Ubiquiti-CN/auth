<?php namespace App\Http\Controllers\Config;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\GlobalConfig;
use Auth;
use Notification;
use Config;

class GlobalController extends Controller {


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

		return view('config/global', ['config'=>$global_config]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 *
	 * DB: host, username, password, db port, db name
	 * Controller: server address, uername, password, version
	 *
	 *
	 * @return Response
	 */
    public function create(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $input = $request->all();
        $input['dbHost'] = (isset($input['dbHost']) && $input['dbHost']) ? $input['dbHost'] : Config::get('unifi.default_db_host');
        $input['dbPort'] = (isset($input['dbPort']) && $input['dbPort']) ? $input['dbPort'] : Config::get('unifi.default_db_port');

        $this->validate($request, [
            'dbPort' => 'integer|between:1024,65535',
            'dbUsername' => 'required',
            'dbName' => 'required',
            'controllerHost' => 'required|url',
            'controllerUsername' => 'required',
            'controllerPassword' => 'required',
            'controllerVersion' => 'required',
        ]);

        $config = new GlobalConfig();
        $config::where('user_id', '=', $user_id)->delete();
        $config->data = json_encode($input);
        $config->user_id = $user_id;
        $config->save();

        Notification::success('保存成功');

        return redirect('config/global');
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
