<?php
/**
 * 订单类
 * @author liang
 * @version 2014-5-25
 */
class Dw_Order extends Dw_Abstract{
	
	//将买家订单写入数据库
	public static function createBuyOrderByDb($info){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Order();
			$re = $db->setBuyOrderInfo($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//走私者认领订单写入数据库
	public static function smugglerTakeOrderByDb($info){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Order();
			$re = $db->setTakeOrderInfo($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//更新订单属性
	public static function updateBuyOrderByBoidByDb($info){
		try{
			$data['where'] = '`boid` = ?';
			foreach($info as $key => $value){
				if($key != 'boid'){
					if(empty($value) && !is_numeric($value)){
						continue;
					}
					$data['set'] .= "`{$key}` = ?,";
					$data['upddata'][] = $value;
				}
			}

			if(empty($data['set'])){
				return false;
			}
			$data['set'] = substr($data['set'], 0, -1);
			$data['upddata'][] = $info['boid'];
			$db = new Db_Order();
			$re = $db->updOrderInfo($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//设置收获地址
	public static function setAddressByDb($info){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Order();
			$re = $db->setAddress($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//删除订单
	public static function delBuyOrderByBoidByDb($info = array()){
		$data[] = $info['boid'];
		try{
			$db = new Db_Order();
			$re = $db->delBuyOrder($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//写入物流信息
	public static function addLogisticsInfoByDb($info = array()){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Order();
			$re = $db->addLogisticsInfo($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
	
	//根据id删除物流信息
	public static function delLogisticsInfoByIdByDb($info = array()){
		try{
			$data = array();
			foreach($info as $value){
				$data[] = $value;
			}
			$db = new Db_Order();
			$re = $db->delLogisticsInfoById($data);
		}catch(Exception $e){
			return false;
		}
		return $re;
	}
}