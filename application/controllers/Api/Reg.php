<?php
class Api_RegController extends Api_AbstractController{
	public function checkParams(){
		$this->_context['source'] = Comm_Context::post('source');
		$this->_context['email'] = Comm_Context::post('email');
		$this->_context['nick'] = Comm_Context::post('nick');
		$this->_context['passwd'] = Comm_Context::post('passwd');
		$this->_context['sign'] = Comm_Context::post('sign');
		
		$this->_checkFields = array('email' => $this->_context['email']);
		return true;
	}
	public function doAction(){
		$info['uid'] = Dr_User::createUid();
		$info['passwd'] = md5($this->_context['passwd']);
		$info['nick'] = $this->_context['nick'];
		$info['email'] = $this->_context['email'];
		
		$re = Dw_User::regByDb($info);
		if($re == false){
			$code = Tools_Conf::get('Show_Code.api.fail');
			$msg = 'reg fail';
		}else{
			$code = Tools_Conf::get('Show_Code.api.succ');
			$userInfo = Dr_User::getUidByEmail($info['email']);
			//通过接口注册转运账号
			$usExInfo['Uid'] = $userInfo['uid'];
			$usExInfo['Email'] = $info['email'];
			$regUsExResult = Dw_User::regUsExByApi($usExInfo);
			$regUsExResult = strip_tags($regUsExResult);
			$regUsExResult = str_replace('\\', '', $regUsExResult);
			$regUsExResult = str_replace('"[', '', $regUsExResult);
			$regUsExResult = str_replace(']"', '', $regUsExResult);
			$regUsExInfo = json_decode($regUsExResult,true);
			if($regUsExInfo['Success'] == true){
				//写入us-ex用户信息
				$setUsExInfo['uid'] = $userInfo['uid'];
				$setUsExInfo['memberid'] = $regUsExInfo['Content']['memberId'];
				$setUsExInfo['codenum'] = $regUsExInfo['Content']['Code_Num'];
				Dw_User::setUsExInfoByDb($setUsExInfo);
			}
		}

		$this->renderAjax($code,$msg);
		return true;
	}
}