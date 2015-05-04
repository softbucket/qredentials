<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Input;
use Auth;

include(app_path().'/Helpers/ControllerFunctions.php');

class UserAccessProfilesController extends Controller {

	private $tname = "user_access_profiles";
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
		$input_name = true;
		$input_email = true;
		if (Input::get('show_name') === null)
			$input_name = false;
		if (Input::get('show_email') === null)
			$input_email = false;
		$id = default_create($this->tname, array(), array('fk_user' => Auth::user()->id, 'show_name' => $input_name, 'show_email' => $input_email));

		//create a blank record
		$unique_key = generateRandomString(100);
		default_create("user_info_sessions", array('fk_user_access_profiles', 'expiry'), array('stock' => '0', 'unique_key' => $unique_key, 'active' => true));
		
		return redirect('view_profiles');
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
		return default_delete($tname, $id);
	}
}
