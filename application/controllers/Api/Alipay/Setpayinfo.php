<?php
/**
 * 设置阿里交易结果接口
 * @author liang
 * @version 2014-11-18
 */
class Api_Alipay_SetpayinfoController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['uid'] = Comm_Context::post('uid');
		$this->_context['boid'] = Comm_Context::post('boid');
		$this->_context['resultinfo'] = Comm_Context::post('resultinfo');
		$this->_context['result'] = Comm_Context::post('result');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('uid' => $this->_context['uid'],'boid' => $this->_context['boid']);
		return true;
	}
	public function doAction(){
		$info['uid'] = $this->_context['uid'];
		$info['boid'] = $this->_context['boid'];
		$info['resultinfo'] = $this->_context['resultinfo'];
		$info['result'] = ($this->_context['result'] === 'T') ? 1 : 0;
		
		if(empty($info['boid']) || empty($info['resultinfo'])){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'params error';
		}
		
		$re = Dw_Alipay::setPayInfo($info);
		
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'error';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
			$msg = 'succ';
		}

		$this->renderAjax($code,$msg);
		return true;
	}
}