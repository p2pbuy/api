<?php
/**
 * 根据id获取收获地址
 * @author liang
 * @version 2014-10-23
 */
class Api_Order_GetaddressbyidsController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['ids'] = Comm_Context::post('ids');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('ids' => $this->_context['ids']);
		return true;
	}
	public function doAction(){
		$re = Dr_Order::getAddressByIdByDb($this->_context['ids']);
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