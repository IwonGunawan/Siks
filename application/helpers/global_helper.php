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

	function whoIsLogin()
	{
		$ci = get_instance();

		$result 			= "";
		$users_level 	= $ci->session->userdata("users_level");
		if ($users_level == config("LEVEL_ADMIN")) 
		{
			$result = config("LEVEL_ADMIN");
		}
		else if ($users_level == config("LEVEL_USTADZ")) 
		{
			$result = config("LEVEL_USTADZ");
		}
		else if ($users_level == config("LEVEL_SANTRI"))
		{
			$result = config("LEVEL_SANTRI");
		}

		return $result;
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

	function judul($id=0) {
		$ci = get_instance();

		$title = "";
		if ($id > 0) 
		{
			$ci->db->select("judul");
			$ci->db->from("bidang_ajar");
			$ci->db->where("id", $id);

			$result = $ci->db->get()->row_array();
			$title = $result['judul'];
		}

		return $title;
	}