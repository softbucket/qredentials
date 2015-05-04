<?php

function default_data($table_name, $extra_parameters)
{
	if (!is_null($extra_parameters))
	{
		$data = DB::table($table_name);
		foreach($extra_parameters as $key => $value)
		{
			$data = $data->where($key, $value);
		} 
		return $data->get(); 
	}
	else
		return DB::table($table_name)->where('id', Auth::user()->id)->get(); 
}

function default_create($table_name, $array, $extra_parameters)
{
		$param_array = array();
		for ($x = 0; $x < count($array); $x++) 
		{
			$param = $array[$x];
			$param_array[$param] = Input::get($param);
		} 
		foreach($extra_parameters as $key => $value)
		{
			$param_array[$key] = $value;
		} 
		
		return DB::table($table_name)->insertGetId($param_array);
}

function default_update($table_name, $array)
{
		$param_array = array();
		for ($x = 0; $x < count($array); $x++) 
		{
			$param = $array[$x];
			$param_array[$param] = Input::get($param);
		} 
		
		return DB::table($table_name)->update($param_array);
}

function default_delete($table_name, $id)
{
		$item = DB::table($table_name)->where('id', '=', $id);
		
		return $item->delete();
}

function request_info_session_relation()
{
	$query_unique_key = DB::table('user_info_sessions')
		->where('unique_key', '=', Input::get('unique_key'));
	$unique_key = $query_unique_key->lockForUpdate()->get();

	if (!$unique_key[0]->active)
		return -1;

	$unique_key_id = $unique_key[0]->id;
	$query_unique_key->update(array("active" => false));
	return DB::table('info_session_relation')
		->insertGetId(array('fk_user_id' => Auth::user()->id, 'fk_user_info_sessions_id' => $unique_key_id));
}

function get_all_active_info_sessions()
{
	return DB::table('user_info_sessions')
		->join('user_access_profiles', 'user_access_profiles.id', '=', 'user_info_sessions.fk_user_access_profiles')
		->where('user_access_profiles.fk_user', '=', Auth::user()->id)
		->where('user_info_sessions.active', '=', true)
		->get(array('unique_key', 'fk_user_access_profiles'));
}

function info_sessions_x_access_profiles()
{
	return DB::table('user_info_sessions')
		->join('user_access_profiles', 'user_access_profiles.id', '=', 'user_info_sessions.fk_user_access_profiles')
		->where('user_access_profiles.fk_user', '=', Auth::user()->id)
		->get(array('unique_key', 'fk_user_access_profiles', 'show_email', 'show_name', 'stock', 'user_info_sessions.active'));
}

function get_all_info_sessions()
{
	return DB::table('user_info_sessions')
		->join('user_access_profiles', 'user_access_profiles.id', '=', 'user_info_sessions.fk_user_access_profiles')
		->where('user_access_profiles.fk_user', '=', Auth::user()->id)
		->get(array('unique_key', 'fk_user_access_profiles'));
}

function delete_info_session()
{
	return DB::table('user_info_sessions')
		->where('unique_key', '=', Input::get('unique_key'))
		->join('user_access_profiles', 'user_access_profiles.id', '=', 'user_info_sessions.fk_user_access_profiles')
		->where('user_access_profiles.fk_user', '=', Auth::user()->id)
		->delete();
}

function deactivate_info_session()
{
	return DB::table('user_info_sessions')
		->where('unique_key', '=', Input::get('unique_key'))
		->join('user_access_profiles', 'user_access_profiles.id', '=', 'user_info_sessions.fk_user_access_profiles')
		->where('user_access_profiles.fk_user', '=', Auth::user()->id)
		->update(array('active' => false));
}

function get_all_info_session_relation()
{
	return DB::table('info_session_relation')
		->where('info_session_relation.fk_user_id', '=', Auth::user()->id)
		->join('user_info_sessions', 'user_info_sessions.id', '=', 'info_session_relation.fk_user_info_sessions_id')
		->join('user_access_profiles', 'user_access_profiles.id', '=', 'user_info_sessions.fk_user_access_profiles')
		->join('users', 'users.id', '=', 'user_access_profiles.fk_user')
		->get(array('show_name', 'show_email', 'email', 'name'));
}

function insert_feedback()
{
	DB::table('contact_us')->insertGetId(array('email' => Input::get('email'), 'feedback' =>Input::get('feedback')));
}


function generateRandomString($length) 
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) 
	{
		$randomString .= $characters[mt_rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

?>