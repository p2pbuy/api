<?php
/**
 * 展示会员信息接口
 * @author liang
 * @version 2014-11-19
 */
class Api_User_ShowuserController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::get('source');
		$this->_context['count'] = Comm_Context::get('count');
		$this->_context['page'] = Comm_Context::get('page');
		$this->_context['sign'] = Comm_Context::get('sign');
		
		$this->_checkFields = array();
		return true;
	}
	public function doAction(){
		$info['count'] = $this->_context['count'];
		$info['page'] = $this->_context['page'];
		
		$re = Dr_User::getUserInfos($info);
		$this->renderAjax(Tools_Conf::get('Show_Code.api.succ'),'',$re);
		return true;
	}
}