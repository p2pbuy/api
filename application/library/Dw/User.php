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
	
	//注册us-ex用户
	public static function regUsExByApi($info = array()){
		try{
			$info['para'] = json_encode($info);
			$info['Pid'] = 10000;
			$info['vcode'] = '0a570082e76c4c1aa4d0c6b4defc72b5';
			$info['hashCode'] = 'HADR00029';
			$re = Api_User::regUsEx($info);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//写入us-ex信息
	public static function setUsExInfoByDb($info){
		try{
			$data[] = $info['uid'];
			$data[] = $info['memberid'];
			$data[] = $info['codenum'];
			$db = new Db_User();
			$re = $db->setUsExInfo($data);
		}catch(Exception $e){
			return false;
		}
		return $result;
	}
}