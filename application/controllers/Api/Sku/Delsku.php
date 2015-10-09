<?php
/**
 * 删除SKU信息
 * @author liang
 * @version 2015-10-9
 */
class Api_Sku_DelskuController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['sign'] = Comm_Context::post('sign');
		$this->_context['id'] = Comm_Context::post('id');
		
		$this->_checkFields = array('id'=>$this->_context['id']);
		return true;
	}
	public function doAction(){
		$info['id'] = $this->_context['id'];
		$re = Dw_Sku::delSkuByDb($info);
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