<?php
/**
 * SKU
 * @author liang
 * @version 2015-8-2
 */
class Dw_Sku extends Dw_Abstract{
	//写入sku信息
	public static function addSkuByDb($info = array()){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Sku();
			$re = $db->addSku($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//获取sku信息
	public static function getSkuByDb($info = array()){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Sku();
			$re = $db->getSku($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
}