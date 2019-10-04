<?php
if( !defined('DATALIFEENGINE') ) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}

function AjaxTpl(){
global $tpl, $config;
echo str_replace('{THEME}', '/templates/'.$config['skin'], $tpl->result['info'].$tpl->result['content']);
}

if( $is_logged ) {
	header( "Location: {$_SERVER['PHP_SELF']}" );
	die();
} else {
	$tpl->load_template( 'login_page.tpl' );
		
	$vk_url = false;
	$odnoklassniki_url = false;
	$facebook_url = false;
	$google_url = false;
	$mailru_url = false;
	$yandex_url = false;

if( $config['allow_social'] AND $config['allow_registration'] AND !$is_logged ) {

	include_once (ENGINE_DIR . '/data/socialconfig.php');

	if( !$_SESSION['state'] ) $_SESSION['state'] = md5(uniqid(rand(), TRUE));

	if (strpos($config['http_home_url'], "//") === 0) $return_domain = "http:".$config['http_home_url'];
	elseif (strpos($config['http_home_url'], "/") === 0) $return_domain = "http://".$_SERVER['HTTP_HOST'].$config['http_home_url'];
	else  $return_domain = $config['http_home_url'];
	
	if ( $social_config['vk'] ) {

		$social_params = array(
			'client_id'     => $social_config['vkid'],
			'redirect_uri'  => $return_domain . "index.php?do=auth-social&provider=vk",
			'scope' => 'offline,wall,email',
			'state' => $_SESSION['state'],
			'response_type' => 'code'
		);
		
		$vk_url = 'http://oauth.vk.com/authorize'.'?' . http_build_query($social_params, '', '&amp;');
		
		$tpl->set( '[vk]', "" );
		$tpl->set( '[/vk]', "" );
		$tpl->set( '{vk_url}', $vk_url );

	} else {

		$tpl->set_block( "'\\[vk\\](.*?)\\[/vk\\]'si", "" );
		$tpl->set( '{vk_url}', '' );
	}

	if ( $social_config['od'] ) {

		$social_params = array(
			'client_id'     => $social_config['odid'],
			'redirect_uri'  => $return_domain . "index.php?do=auth-social&provider=od",
			'state' => $_SESSION['state'],
			'response_type' => 'code'
		);

		$odnoklassniki_url = 'http://www.odnoklassniki.ru/oauth/authorize'.'?' . http_build_query($social_params, '', '&amp;');
		
		$tpl->set( '[odnoklassniki]', "" );
		$tpl->set( '[/odnoklassniki]', "" );
		$tpl->set( '{odnoklassniki_url}', $odnoklassniki_url );

	} else {

		$tpl->set_block( "'\\[odnoklassniki\\](.*?)\\[/odnoklassniki\\]'si", "" );
		$tpl->set( '{odnoklassniki_url}', '' );
	}

	if ( $social_config['fc'] ) {

		$social_params = array(
			'client_id'     => $social_config['fcid'],
			'redirect_uri'  => $return_domain . "index.php?do=auth-social&provider=fc",
			'scope' => 'public_profile,email',
			'display' => 'popup',
			'state' => $_SESSION['state'],
			'response_type' => 'code'
		);

		$facebook_url = 'https://www.facebook.com/dialog/oauth'.'?' . http_build_query($social_params, '', '&amp;');
		$tpl->set( '[facebook]', "" );
		$tpl->set( '[/facebook]', "" );
		$tpl->set( '{facebook_url}', $facebook_url );

	} else {

		$tpl->set_block( "'\\[facebook\\](.*?)\\[/facebook\\]'si", "" );
		$tpl->set( '{facebook_url}', '' );
	}


	if ( $social_config['google'] ) {

		$social_params = array(
			'client_id'     => $social_config['googleid'],
			'redirect_uri'  => $return_domain . "index.php?do=auth-social&provider=google",
			'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
			'state' => $_SESSION['state'],
			'response_type' => 'code'
		);

		$google_url = 'https://accounts.google.com/o/oauth2/auth'.'?' . http_build_query($social_params, '', '&amp;');
		$tpl->set( '[google]', "" );
		$tpl->set( '[/google]', "" );
		$tpl->set( '{google_url}', $google_url );

	} else {

		$tpl->set_block( "'\\[google\\](.*?)\\[/google\\]'si", "" );
		$tpl->set( '{google_url}', '' );
	}

	if ( $social_config['mailru'] ) {

		$social_params = array(
			'client_id'     => $social_config['mailruid'],
			'redirect_uri'  => $return_domain . "index.php?do=auth-social&provider=mailru",
			'state' => $_SESSION['state'],
			'response_type' => 'code'
		);

		$mailru_url = 'https://connect.mail.ru/oauth/authorize'.'?' . http_build_query($social_params, '', '&amp;');
		$tpl->set( '[mailru]', "" );
		$tpl->set( '[/mailru]', "" );
		$tpl->set( '{mailru_url}', $mailru_url );

	} else {

		$tpl->set_block( "'\\[mailru\\](.*?)\\[/mailru\\]'si", "" );
		$tpl->set( '{mailru_url}', '' );
	}

	if ( $social_config['yandex'] ) {

		$social_params = array(
			'client_id'     => $social_config['yandexid'],
			'redirect_uri'  => $return_domain . "index.php?do=auth-social&provider=yandex",
			'state' => $_SESSION['state'],
			'response_type' => 'code'
		);

		$yandex_url = 'https://oauth.yandex.ru/authorize'.'?' . http_build_query($social_params, '', '&amp;');
		$tpl->set( '[yandex]', "" );
		$tpl->set( '[/yandex]', "" );
		$tpl->set( '{yandex_url}', $yandex_url );

	} else {

		$tpl->set_block( "'\\[yandex\\](.*?)\\[/yandex\\]'si", "" );
		$tpl->set( '{yandex_url}', '' );
	}

} else {

	$_SESSION['state'] = false;

	$tpl->set_block( "'\\[vk\\](.*?)\\[/vk\\]'si", "" );
	$tpl->set( '{vk_url}', '' );
	$tpl->set_block( "'\\[odnoklassniki\\](.*?)\\[/odnoklassniki\\]'si", "" );
	$tpl->set( '{odnoklassniki_url}', '' );
	$tpl->set_block( "'\\[facebook\\](.*?)\\[/facebook\\]'si", "" );
	$tpl->set( '{facebook_url}', '' );
	$tpl->set_block( "'\\[google\\](.*?)\\[/google\\]'si", "" );
	$tpl->set( '{google_url}', '' );
	$tpl->set_block( "'\\[mailru\\](.*?)\\[/mailru\\]'si", "" );
	$tpl->set( '{mailru_url}', '' );
	$tpl->set_block( "'\\[yandex\\](.*?)\\[/yandex\\]'si", "" );
	$tpl->set( '{yandex_url}', '' );
}		
		
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		
		$tpl->set( '{class}', "ajax-login" );
		$tpl->set( '{formAction}', "/" );
		$tpl->set( '{btnClose}', "<button type=\"button\" class=\"mfp-close\">×</button>" );
		
    	} else {
		
		$tpl->set( '{class}', "" );
		if( $config['allow_alt_url'] ) $tpl->set( '{formAction}', '/login.html' );
		else $tpl->set( '{formAction}', '/?do=login' );
		$tpl->set( '{btnClose}', "" );
		
	}
	
	$tpl->set( '{registration-link}', $PHP_SELF . "?do=register" );
	$tpl->set( '{lostpassword-link}', $PHP_SELF . "?do=lostpassword" );
	$tpl->set( '{login-method}', $config['auth_metod'] ? "E-Mail:" : $lang['login_metod'] );
	$tpl->compile( 'content' );
	
	if( $_SERVER['REQUEST_METHOD'] == 'POST' AND ($_SERVER['HTTP_REFERER'] != $config['http_home_url'] . 'login.html' AND $_SERVER['HTTP_REFERER'] != $config['http_home_url'] . '?do=login') ) {
		
		AjaxTpl();
		exit;
		
	}
	
	$tpl->clear();

}
?>
