<?php
/**
 * 竞价类
 * @author liang
 * @version 2014-6-8
 */
class Dr_Bid extends Dw_Abstract{
	
	//根据boid获得竞价
	public static function getBidPriceByBoidsByDb($boids){
		if(empty($boids)){
			return false;
		}
		
		$info['boids'] = $boids;
		try{
			$db = new Db_Bid();
			$bidPriceInfos = $db->getBidPriceByBoids($info);
		}catch(Exception $e){
			return false;
		}
		return $bidPriceInfos;
	}
	
	//根据uid获得竞价信息
	public static function getBidInfoByUidByDb($uid){
		if(empty($uid)){
			return false;
		}
		
		$info['uid'] = $uid;
		try{
			$db = new Db_Bid();
			$bidInfo = $db->getBidInfoByUid($info);
		}catch(Exception $e){
			return false;
		}
		return $bidInfo;
	}
}