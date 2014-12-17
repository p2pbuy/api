<?php
/**
 * 添加物流信息
 * @author liang
 * @version 2014-12-17
 */
class Api_Order_AddlogisticsinfoController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['boid'] = Comm_Context::post('boid');
		$this->_context['info'] = Comm_Context::post('info');
		$this->_context['createtime'] = Comm_Context::post('createtime');
		$this->_context['operator'] = Comm_Context::post('operator');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('boid' => $this->_context['boid']);
		return true;
	}
	public function doAction(){
		$info['boid'] = $this->_context['boid'];
		$info['info'] = $this->_context['info'];
		$info['operator'] = $this->_context['operator'];
		$info['createtime'] = $this->_context['createtime'];
		
		$re = Dw_Order::addLogisticsInfoByDb($info);
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'add logistics info fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
		}

		$this->renderAjax($code,$msg);
		return true;
	}
}