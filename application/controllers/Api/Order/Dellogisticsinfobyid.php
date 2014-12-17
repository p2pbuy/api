<?php
/**
 * 添加物流信息
 * @author liang
 * @version 2014-12-17
 */
class Api_Order_DellogisticsinfobyidController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['id'] = Comm_Context::post('id');
		$this->_context['boid'] = Comm_Context::post('boid');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('id' => $this->_context['id'],'boid' => $this->_context['boid']);
		return true;
	}
	public function doAction(){
		$info['id'] = $this->_context['id'];
		$info['boid'] = $this->_context['boid'];
		
		$re = Dw_Order::delLogisticsInfoByIdByDb($info);

		$code = Tools_Conf::get('Show_Code.api.succ');
		$addressid = $re;


		$this->renderAjax($code,$msg);
		return true;
	}
}