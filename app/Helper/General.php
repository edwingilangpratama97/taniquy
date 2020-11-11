<?php
namespace App\Helper;



if(!function_exists('msg')){
	function msg($type){
		if($type == 'create'){
			return __('Successfully created data.');
		}else if($type == 'edit'){
			return __('Successfully edited data.');
		}
		return __('Successfully deleted data.');
	}
}

if(!function_exists('nav')){
	function nav($route){
		return Route::is($route) ? 'active' : '';
	}
}
