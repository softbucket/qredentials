<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Input;
use Auth;

include(app_path().'/Helpers/ControllerFunctions.php');

class UsersController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Auth::user()->id;
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$id = default_create('users', array('first_name', 'last_name', 'email', 'phone'));
		
		return $id;
	}

	/**
	 * Show the form for creating a new profile.
	 *
	 * @return Response
	 */
	public function create_profile()
	{
		return view('create_profile');
	}

	/**
	 * Show the form for creating a new profile.
	 *
	 * @return Response
	 */
	public function view_profiles()
	{
		$data = DB::table('user_access_profiles')->where('fk_user', Auth::user()->id)->get();;
		return view('view_profiles', array('data' => $data));
	}

	public function submit_unique_key()
	{
		$id = request_info_session_relation();
		if ($id == -1)
			return view('scan_qredentials', array('error' => "The qr code has been consumed"));
		return redirect('view_qredentials');
	}

	public function search()
	{
		return view('search', array('search_term' => Input::get('search_term')));
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

	public function view_qredentials()
	{
		$data = get_all_info_session_relation();
		return view('view_qredentials', array('data' => $data));
	}

	public function scan_qredentials()
	{
		return view('scan_qredentials', array('error' => null ));
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
		$rows_affected = default_create('users', $id, array('first_name', 'last_name', 'email', 'phone'));
		
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
		return "HI";
		return default_delete($id);
	}

}
