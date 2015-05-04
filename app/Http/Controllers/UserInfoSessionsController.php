<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

include(app_path().'/Helpers/ControllerFunctions.php');

class UserInfoSessionsController extends Controller 
{

	private $tname = 'user_info_sessions';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return default_index($tname);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$unique_key = generateRandomString(100);
		$id = default_create($this->tname, array('stock', 'fk_user_access_profiles', 'expiry'), array('unique_key' => $unique_key, 'active' => true, 'stock' => 1));
		
		return $unique_key;
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

	public function scan_unique_key()
	{
		return request_info_session_relation();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return json_encode(get_all_active_info_sessions());
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
		$rows_affected = default_create($tname, $id, array('json_access', 'fk_user'));
		
		return $rows_affected;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return deactivate_info_session($id);
	}
}