<?php
/**
 * 订单类
 * @author liang
 * @version 2014-5-25
 */
class Dr_Order extends Dr_Abstract{
	
	public static function showBuyOrder($info = array()){
		$info['count'] = (is_numeric($info['count'])) ? $info['count'] : 0;
		$info['page'] = (is_numeric($info['page'])) ? $info['page'] : 0;
		$info['start'] = (is_numeric($info['start'])) ? $info['start'] : 0;
		
		$info['count'] = ($info['count']) ? intval($info['count']) : 5;
		$info['page'] = ($info['page']) ? intval($info['page']) : 1;
		$info['start'] = ($info['page'] - 1) * $info['count'];
		try{
			$db = new Db_Order();
			$buyOrderInfo = $db->getBuyOrderInfo($info);
		}catch(Exception $e){
			return false;
		}
		return $buyOrderInfo;
	}
	
	public static function showBuyOrderByUid($info = array()){
		$info['count'] = (is_numeric($info['count'])) ? $info['count'] : 0;
		$info['page'] = (is_numeric($info['page'])) ? $info['page'] : 0;
		$info['start'] = (is_numeric($info['start'])) ? $info['start'] : 0;
		
		$info['count'] = ($info['count']) ? intval($info['count']) : 5;
		$info['page'] = ($info['page']) ? intval($info['page']) : 1;
		$info['start'] = ($info['page'] - 1) * $info['count'];
		try{
			$db = new Db_Order();
			$buyOrderInfo = $db->getBuyOrderInfoByUid($info);
		}catch(Exception $e){
			return false;
		}
		return $buyOrderInfo;
	}
	
	public static function showBuyOrderByBoids($boids){
		if(empty($boids)){
			return false;
		}
		
		$info['boids'] = $boids;
		try{
			$db = new Db_Order();
			$buyOrderInfo = $db->getBuyOrderInfoByBoids($info);
		}catch(Exception $e){
			return false;
		}
		return $buyOrderInfo;
	}
	
	public static function showTakeOrderByUid($info = array()){
		$info['count'] = (is_numeric($info['count'])) ? $info['count'] : 0;
		$info['page'] = (is_numeric($info['page'])) ? $info['page'] : 0;
		$info['start'] = (is_numeric($info['start'])) ? $info['start'] : 0;
		
		$info['count'] = ($info['count']) ? intval($info['count']) : 5;
		$info['page'] = ($info['page']) ? intval($info['page']) : 1;
		$info['start'] = ($info['page'] - 1) * $info['count'];
		try{
			$db = new Db_Order();
			$takeOrderInfo = $db->getTakeOrderInfoByUid($info);
		}catch(Exception $e){
			return false;
		}
		return $takeOrderInfo;
	}
}