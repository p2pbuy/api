<?php
class Dw_User extends Dw_Abstract{
	
	//注册用户入库
	public static function regByDb($info){
		try{
			$dataSetUser = array();
			$dataSetUserInfo = array();
			foreach($info as $value){
				$dataSetUser[] = $value;
			}
			$dataSetUserInfo[] = $info['uid'];
			$dataSetUserInfo[] = 1;
			$db = new Db_User();
			$reSetUser = $db->setUser($dataSetUser);
			$reSetUserInfo = $db->setUserInfo($dataSetUserInfo);
		}catch(Exception $e){
			return false;
		}
		return $reSetUser && $reSetUserInfo;
	}
}