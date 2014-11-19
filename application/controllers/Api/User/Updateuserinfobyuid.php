<?php
/**
 * 根据boid展示买家订单接口
 * @author liang
 * @version 2014-5-25
 */
class Api_User_UpdateuserinfobyuidController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['uid'] = Comm_Context::post('uid');
		$this->_context['age'] = Comm_Context::post('age');
		$this->_context['country'] = Comm_Context::post('country');
		$this->_context['type'] = Comm_Context::post('type');
		$this->_context['alipayusername'] = Comm_Context::post('alipayusername');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('uid' => $this->_context['uid']);
		return true;
	}
	public function doAction(){
		$info['uid'] = $this->_context['uid'];
		$info['age'] = $this->_context['age'];
		$info['country'] = $this->_context['country'];
		$info['type'] = $this->_context['type'];
		$info['alipayusername'] = $this->_context['alipayusername'];

		$re = Dw_User::updateUserInfoByUidByDb($info);
		
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'update userinfo fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
		}
		$this->renderAjax($code,$msg,$re);
		return true;
	}
}