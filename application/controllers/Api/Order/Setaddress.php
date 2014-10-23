<?php
/**
 * 设置收获地址，如果相同则返回id
 * @author liang
 * @version 2014-10-22
 */
class Api_Order_SetaddressController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['uid'] = Comm_Context::post('uid');
		$this->_context['name'] = Comm_Context::post('name');
		$this->_context['country'] = Comm_Context::post('country');
		$this->_context['province'] = Comm_Context::post('province');
		$this->_context['city'] = Comm_Context::post('city');
		$this->_context['addrdetail'] = Comm_Context::post('addrdetail');
		$this->_context['mobile'] = Comm_Context::post('mobile');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('uid' => $this->_context['uid']);
		return true;
	}
	public function doAction(){
		$info['uid'] = $this->_context['uid'];
		$info['name'] = $this->_context['name'];
		$info['country'] = $this->_context['country'];
		$info['province'] = $this->_context['province'];
		$info['city'] = $this->_context['city'];
		$info['addrdetail'] = $this->_context['addrdetail'];
		$info['mobile'] = $this->_context['mobile'];
		
		$re = Dw_Order::setAddressByDb($info);
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'set address fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
			$addressid = $re;
		}

		$this->renderAjax($code,$msg,array('addressid'=>$addressid));
		return true;
	}
}