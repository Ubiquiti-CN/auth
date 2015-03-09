<?php namespace App\Http\Controllers\Config;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\GlobalConfig;
use Auth;;

class GlobalController extends Controller {


	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

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
		$config = new GlobalConfig();

		$config::where('user_id', '=', $user_id)->delete();

		$config->data = json_encode($input);
		$config->user_id = $user_id;
		$config->save();
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
