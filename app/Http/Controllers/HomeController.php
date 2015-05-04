<?php namespace App\Http\Controllers;

use Auth;
use View;
use Response;
use Input;

include(app_path().'/Helpers/ControllerFunctions.php');

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check())
		{
			return view('home_page');
		}
		else
		{	
			return view('splash');
		}
	}

	public function site_map()
	{
		return view('site_map');
	}

	public function site_map_xml()
	{
		$content = View::make('site_map_xml');

		return Response::make($content, '200')->header('Content-Type', 'text/xml');
	}
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function about()
	{
		return view('about');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function contact()
	{
		if (!is_null(Input::get('feedback')))
		{
			insert_feedback();
			return view('contact', array('response' => "Feedback Received!"));
		}
		return view('contact', array('response' => ""));
	}

	public function no_sql()
	{
		return "Laravel is working if you see this.";
	}

}
