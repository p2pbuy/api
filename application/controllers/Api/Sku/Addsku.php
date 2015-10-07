<?php
/**
 * 添加SKU信息
 * @author liang
 * @version 2015-10-6
 */
class Api_Sku_AddskuController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['code'] = Comm_Context::post('code');
		$this->_context['title'] = Comm_Context::post('title');
		$this->_context['imgurl'] = Comm_Context::post('imgurl');
		$this->_context['price_unit'] = Comm_Context::post('price_unit');
		$this->_context['attr'] = Comm_Context::post('attr');
		$this->_context['remark'] = Comm_Context::post('remark');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('code' => $this->_context['code']);
		return true;
	}
	public function doAction(){
		$info['code'] = $this->_context['code'];
		$info['title'] = $this->_context['title'];
		$info['imgurl'] = $this->_context['imgurl'];
		$info['price_unit'] = $this->_context['price_unit'];
		$info['attr'] = $this->_context['attr'];
		$info['remark'] = $this->_context['remark'];
		
		$re = Dw_Sku::addSkuByDb($info);
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'add sku fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
		}

		$this->renderAjax($code,$msg);
		return true;
	}
}