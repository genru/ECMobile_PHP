<?php

/*
 *                                                                          
 *       _/_/_/                      _/        _/_/_/_/_/                     
 *    _/          _/_/      _/_/    _/  _/          _/      _/_/      _/_/    
 *   _/  _/_/  _/_/_/_/  _/_/_/_/  _/_/          _/      _/    _/  _/    _/   
 *  _/    _/  _/        _/        _/  _/      _/        _/    _/  _/    _/    
 *   _/_/_/    _/_/_/    _/_/_/  _/    _/  _/_/_/_/_/    _/_/      _/_/       
 *                                                                          
 *
 *  Copyright 2013-2014, Geek Zoo Studio
 *  http://www.ecmobile.cn/license.html
 *
 *  HQ China:
 *    2319 Est.Tower Van Palace 
 *    No.2 Guandongdian South Street 
 *    Beijing , China
 *
 *  U.S. Office:
 *    One Park Place, Elmira College, NY, 14901, USA
 *
 *  QQ Group:   329673575
 *  BBS:        bbs.ecmobile.cn
 *  Fax:        +86-10-6561-5510
 *  Mail:       info@geek-zoo.com
 */

require(EC_PATH . '/includes/init.php');
include_once(EC_PATH . '/includes/lib_order.php');

if (empty($tmp[0])) {
	GZ_Api::outPut(101);
}

switch ($tmp[0]) {
	case 'reset':
		$name = _POST('name');
		$password = _POST('password');

		if (empty($name) || empty($password)) {
			GZ_Api::outPut(13);
		}

		$user_info = $user->get_user_info($name);

		if ($user->edit_user(array('username'=> $name,'old_password'=>NULL, 'password'=>$password), 0)) {
			$user->logout();
			$user_id = $user_info['user_id'];
			$sql="UPDATE ".$ecs->table('users'). "SET `ec_salt`='0' WHERE user_id= '".$user_id."'";
			$db->query($sql);
		    GZ_Api::outPut(array());
		} else {
			GZ_Api::outPut(8);
		}
		break;
	default:
		break;
}