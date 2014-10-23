<?php
class Db_Order extends Db_Abstract{
	private $poolName = 'main';
	private $dbObj;
	
	public function __construct($poolName = null){
		$poolName = $poolName ? $poolName : $this->poolName;
		$this->dbObj = Db_Db::pool($poolName);
		return true;
	}
	
	/**
	 * 写入买家订单信息
	 * @param array $data
	 */
	public function setBuyOrderInfo($data = array()){
		$sql = "insert into `buyorder` (`uid`,`title`,`description`,`price`,`quantity`,`additional`,`img`,`thirdurl`) values (?,?,?,?,?,?,?,?);";
		$re = $this->dbObj->exec ( $sql, $data );
		if($re == true){
			$lastInsertId = $this->dbObj->__call('lastInsertId',array());
			$lastInsertId = str_pad($lastInsertId, 20, '0', STR_PAD_LEFT);
			$re = $lastInsertId;
		}
		return $re;
	}
	
	/**
	 * 读取买家订单信息
	 */
	public function getBuyOrderInfo($data = array()){
		$sql = "select * from `buyorder` order by createtime desc limit {$data['start']},{$data['count']}";
		return $this->dbObj->fetch_all ( $sql );
	}
	
	/**
	 * 根据boid读取买家订单信息
	 */
	public function getBuyOrderInfoByBoids($data = array()){
		$sql = "select * from `buyorder` where boid in ({$data['boids']})";
		return $this->dbObj->fetch_all ( $sql );
	}
	
	/**
	 * 根据uid读取买家订单信息
	 */
	public function getBuyOrderInfoByUid($data = array()){
		$sql = "select * from `buyorder` where uid = '{$data['uid']}' order by createtime desc limit {$data['start']},{$data['count']}";
		return $this->dbObj->fetch_all ( $sql );
	}
	
	/**
	 * 写入走私者认领订单信息
	 */
	public function setTakeOrderInfo($data = array()){
		$sql = "insert into `smugglertakeorder` (`boid`,`uid`) values (?,?);";
		return  $this->dbObj->exec ( $sql, $data );
	}
	
	/**
	 * 根据uid读取买手已经接到的订单
	 */
	public function getTakeOrderInfoByUid($data = array()){
		$sql = "select * from `smugglertakeorder` where uid = '{$data['uid']}' order by createtime desc limit {$data['start']},{$data['count']}";
		return $this->dbObj->fetch_all ( $sql );
	}
	
	/**
	 * 根据boid更新订单
	 */
	public function updOrderInfo($data = array()){
		$sql = "update `buyorder` set {$data['set']} where {$data['where']}";
		return  $this->dbObj->exec ( $sql, $data['upddata'] );
	}
	
	/**
	 * 设置收获地址
	 */
	public function setAddress($data = array()){
		$sql = "select id from `user_addr` where `uid` = ? && `name` = ? && `country` = ? && `province` = ? && `city` = ? && `address` = ? && `mobile` = ? limit 1";
		$re = $this->dbObj->fetch_row($sql , $data);
		if(!empty($re['id'])){
			return $re['id'];
		}
		
		$sql = "insert into `user_addr` (`uid`,`name`,`country`,`province`,`city`,`address`,`mobile`) values (?,?,?,?,?,?,?);";
		$re = $this->dbObj->exec ( $sql, $data );
		if($re == true){
			$lastInsertId = $this->dbObj->__call('lastInsertId',array());
			$lastInsertId = str_pad($lastInsertId, 20, '0', STR_PAD_LEFT);
			$re = $lastInsertId;
		}
		return $re;
	}
	
	/**
	 * 根据uid获得收获地址
	 */
	public function getAddressByUid($data = array()){
		$sql = "select * from `user_addr` where `uid` = ? order by id desc";
		return $this->dbObj->fetch_all ( $sql , $data);
	}
	
	/**
	 * 根据ids获得收获地址
	 */
	public function getAddressById($data = array()){
		$sql = "select * from `user_addr` where `id` in ({$data[0]}) order by id desc";
		return $this->dbObj->fetch_all ( $sql );
	}
}