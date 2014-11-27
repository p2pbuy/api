<?php
/**
 * 展示买家订单接口
 * @author liang
 * @version 2014-5-25
 */
class Api_Order_ShowbuyorderController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::get('source');
		$this->_context['count'] = Comm_Context::get('count');
		$this->_context['page'] = Comm_Context::get('page');
		$this->_context['isshow'] = Comm_Context::get('isshow');
		$this->_context['lock'] = Comm_Context::get('lock');
		$this->_context['sign'] = Comm_Context::get('sign');
		
		$this->_checkFields = array();
		return true;
	}
	public function doAction(){
		$info['count'] = $this->_context['count'];
		$info['page'] = $this->_context['page'];
		$info['isshow'] = $this->_context['isshow'];
		$info['lock'] = $this->_context['lock'];
		
		$re = Dr_Order::showBuyOrder($info);
		$this->renderAjax(Tools_Conf::get('Show_Code.api.succ'),'',$re);
		return true;
	}
}