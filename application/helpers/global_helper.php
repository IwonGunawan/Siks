<?php

	function is_login()
	{
		$ci 	= get_instance();

		$users_level 	= $ci->session->userdata("users_level");
		$menu_current = $ci->uri->segment(1);
		
		if ($users_level == "" || $users_level == null) 
		{
			$ci->session->set_flashdata("error", "login_no_access");
	    redirect(base_url("logout"));
		}
	}



	function get_session($type="")
	{
		$ci 	= get_instance();

		$result 	= array(
							'users_id'        => $ci->session->userdata("users_id"), 
		          'users_name'      => $ci->session->userdata("users_name"),
		          'users_email'     => $ci->session->userdata("users_email"), 
		          'users_level'     => $ci->session->userdata("users_level"),  
		          'users_status'    => $ci->session->userdata("users_status"), 
							);


		return $result[$type];
	}



	function menu_active($menu="")
	{
		$ci	= get_instance();

		if ($menu !== "") 
		{
			$uri1 	= $ci->uri->segment(1);
			$uri2 	= $ci->uri->segment(2);
			if ($uri1.'/'.$uri2 == $menu) 
			{
				return "active";
			}
			else if ($uri1 == $menu) 
			{
				return "active";
			}

		}

		return "";
	}