<?php
class Dr_User extends Dr_Abstract{
	//生成uid
	public static function createUid(){
		//mt_getrandmax() 最大2147483647共10位 这里取9位
		$rand = mt_rand(0, 999999999);
		$uid = '1'.str_pad($rand,9,'0',STR_PAD_LEFT);
		//$uid = '1000000000000001';
		$userInfo = self::show($uid);
		if(!empty($userInfo['uid'])){
			return self::createUid();
		}
		return $uid;
	}
	
	//获得用户信息
	public static function show($uid){
		if(empty($uid)){
			return false;
		}
		try{
			$cache = new Cache_User();
			$userInfo = $cache->getUserInfo($uid);
			$userInfo = false;
			if($userInfo == false){
				$db = new Db_User();
				$re = $db->getUserByUid($uid);
				$userInfo = $re[0];
				$re = $db->getUserInfoByUid($uid); 
				$userInfo['extends'] = $re[0];
				if($re != false){
					$cache->setUserInfo($uid,$userInfo);
				}
			}
		}catch(Exception $e){
			return false;
		}
		
		return $userInfo;
	}
	
	//根据cookie获得uid
	public static function getUidByCookie(){
		if(empty($_COOKIE['PUCE'])){
			return false;
		}
		$PUCE = explode(',', $_COOKIE['PUCE']);
		return $PUCE[0];
	}
	
	//根据email获得uid
	public static function getUidByEmail($email){
		$db = new Db_User();
		$userinfo = $db->getUserInfoByEmail($email);
		
		return $userinfo;
	}
	
	//获得用户信息
	public static function getUserInfos($info = array()){
		$info['count'] = (is_numeric($info['count'])) ? $info['count'] : 0;
		$info['page'] = (is_numeric($info['page'])) ? $info['page'] : 0;
		$info['start'] = (is_numeric($info['start'])) ? $info['start'] : 0;
		
		$info['count'] = ($info['count']) ? intval($info['count']) : 5;
		$info['page'] = ($info['page']) ? intval($info['page']) : 1;
		$info['start'] = ($info['page'] - 1) * $info['count'];
		try{
			$db = new Db_User();
			$userInfos = $db->getUserInfos($info);
		}catch(Exception $e){
			return false;
		}
		return $userInfos;
	}
}