<?php
class Api_User extends Api_Abstract{
	const API_HOST = 'http://p2pbuy.net';
	public static $instance = null;
    public static function instance(){
    	if(self::$instance == null){
    		self::$instance = new Api_Httpclient();
    	}
    	return self::$instance;
    }
    public static function getApiUrl($url){
        return self::API_HOST.'/'.trim($url, '/');
    }
    
    /**
     * 注册用户信息
     */
    public static function reg($info){
    	$params = array(
            'email' => $info['email'],
            'nick' => $info['nick'],
    		'passwd' => $info['passwd'],
    		'sign' => $info['sign'],
    		'source' => $info['source'],
        );
        return self::instance()->post(self::getApiUrl('api/reg'), $params);
    }
    
	/**
     * 注册美国快递用户
     */
    public static function regUsEx($info){
    	$params = array(
    		'para' => json_encode($info),
    	);
    	$url = 'http://www.us-ex.com/api/usex.asmx/API';
    	$option['timeout'] = 6000;
    	$option['connect_timeout'] = 6000;
    	return self::instance()->get($url, $params, $option);
    }
}