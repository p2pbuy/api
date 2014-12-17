<?php
/**
 * 根据boid获得物流信息
 * @author liang
 * @version 2014-12-17
 */
class Api_Order_GetlogisticsinfobyboidController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['boid'] = Comm_Context::post('boid');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('boid' => $this->_context['boid']);
		return true;
	}
	public function doAction(){
		$info['boid'] = $this->_context['boid'];
		
		$re = Dr_Order::getLogisticsInfoByBoidByDb($info);
		
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'get logistics info fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
		}

		$this->renderAjax($code,$msg,$re);
		return true;
	}
}