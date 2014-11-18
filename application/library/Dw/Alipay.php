<?php
/**
 * 支付宝付款类
 * @author liang
 * @version 2014-11-18
 */
class Dw_Alipay extends Dw_Abstract{
	//将竞价写入数据库
	public static function setPayInfo($info){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Alipay();
			$re = $db->setPayInfo($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}	
}