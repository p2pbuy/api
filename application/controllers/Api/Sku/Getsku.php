<?php
/**
 * 获取SKU信息
 * @author liang
 * @version 2015-10-7
 */
class Api_Sku_GetskuController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array();
		return true;
	}
	public function doAction(){
		$re = Dw_Sku::getSkuByDb($info);
		var_dump($re);exit;
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'add sku fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
		}

		$this->renderAjax($code,$msg,$re);
		return true;
	}
}