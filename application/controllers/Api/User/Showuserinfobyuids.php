<?php
/**
 * 根据uids获取相关用户信息
 * @author liang
 * @version 2014-11-19
 */
class Api_User_ShowuserinfobyuidsController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::get('source');
		$this->_context['uids'] = Comm_Context::get('uids');
		$this->_context['sign'] = Comm_Context::get('sign');
		
		$this->_checkFields = array('uids' => $this->_context['uids']);
		return true;
	}
	public function doAction(){
		$info['uids'] = $this->_context['uids'];
		
		if(empty($info['uids'])){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'params error';
			
			$this->renderAjax($code,$msg);
			return true;
		}

		$result = array();
		$uidsArr = explode(',', $info['uids']);
		foreach($uidsArr as $uid){
			$userInfos[$uid] = Dr_User::show($uid);
		}
		
		$code = Tools_Conf::get('Show_Code.api.succ');
		$msg = 'succ';
		$result = $userInfos;

		$this->renderAjax($code,$msg,$result);
		return true;
	}
}