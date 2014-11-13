<?php
/**
 * 根据boid删除买家订单接口
 * @author liang
 * @version 2014-11-12
 */
class Api_Order_DelbuyorderbyboidController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['boid'] = Comm_Context::post('boid');
		$this->_context['uid'] = Comm_Context::post('uid');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('boid' => $this->_context['boid'],'uid' => $this->_context['uid']);
		return true;
	}
	public function doAction(){
		$info['boid'] = $this->_context['boid'];
		$info['uid'] = $this->_context['uid'];

		if(empty($info['boid']) || empty($info['uid'])){
			return false;
		}
		
		if($info['uid'] != Tools_Conf::get('Manager.uid')){
			return false;
		}
		
		Dw_Order::delBuyOrderByBoidByDb($info);
		
		$code = Tools_Conf::get('Show_Code.api.succ');

		$this->renderAjax($code);
		return true;
	}
}