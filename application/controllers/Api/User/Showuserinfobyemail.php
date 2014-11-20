<?php
/**
 * 根据email获取相关用户信息
 * @author liang
 * @version 2014-11-20
 */
class Api_User_ShowuserinfobyemailController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::get('source');
		$this->_context['email'] = Comm_Context::get('email');
		$this->_context['sign'] = Comm_Context::get('sign');
		
		$this->_checkFields = array('email' => $this->_context['email']);
		return true;
	}
	public function doAction(){
		$info['email'] = $this->_context['email'];
		
		if(empty($info['email'])){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'params error';
			
			$this->renderAjax($code,$msg);
			return true;
		}

		$result = array();
		$userInfos = Dr_User::getUidByEmail($info['email']);
		
		$code = Tools_Conf::get('Show_Code.api.succ');
		$msg = 'succ';
		$result = $userInfos;

		$this->renderAjax($code,$msg,$result);
		return true;
	}
}