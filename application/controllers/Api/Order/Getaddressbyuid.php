<?php
/**
 * 根据uid获取收获地址
 * @author liang
 * @version 2014-10-22
 */
class Api_Order_GetaddressbyuidController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['uid'] = Comm_Context::post('uid');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('uid' => $this->_context['uid']);
		return true;
	}
	public function doAction(){
		$re = Dr_Order::getAddressByUidByDb($this->_context['uid']);
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'get address fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
			$addressInfo = $re;
		}

		$this->renderAjax($code,$msg,$addressInfo);
		return true;
	}
}