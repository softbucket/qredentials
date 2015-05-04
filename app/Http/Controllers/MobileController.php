<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Input;

include(app_path().'/Helpers/ControllerFunctions.php');

class MobileController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	public function login()
	{
		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
			return "1";
		else
			return "0";
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function userName()
	{
		return Auth::user()->name;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function logout()
	{
		Auth::logout();
		return "1";
	}

	public function submit_unique_key()
	{
		$id = request_info_session_relation();
		return $id;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function submit_profile()
	{
		$tname = "user_access_profiles";
		$input_name = true;
		$input_email = true;
		if (Input::get('show_name') == false)
			$input_name = false;
		if (Input::get('show_email') == false)
			$input_email = false;
		$id = default_create($tname, array(), array('fk_user' => Auth::user()->id, 'show_name' => $input_name, 'show_email' => $input_email));

		//create a blank record
		$tname = "user_info_sessions";
		$unique_key = generateRandomString(100);
		default_create($tname, array('expiry'), array('fk_user_access_profiles' => $id, 'stock' => 0, 'unique_key' => $unique_key, 'active' => true));
		
		return $id;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function get_all_active_info_sessions()
	{		
		return json_encode(info_sessions_x_access_profiles());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function get_all_info_session_relation()
	{
		$all_session_relations = get_all_info_session_relation();

		foreach($all_session_relations as $key => $value)
		{
				if ($value->show_name == 0)
					$value->name = "";
				if ($value->show_email == 0)
					$value->email = "";
		}
		return json_encode($all_session_relations);
	} 

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete_info_session()
	{
		return deactivate_info_session();
	}

}
