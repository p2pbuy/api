<?php
class Db_Sku extends Db_Abstract{
	private $poolName = 'main';
	private $dbObj;
	
	public function __construct($poolName = null){
		$poolName = $poolName ? $poolName : $this->poolName;
		$this->dbObj = Db_Db::pool($poolName);
		return true;
	}
	
	/**
	 * 写入sku信息
	 * @param array $data
	 */
	public function addSku($data = array()){
		$sql = "insert into `sku` (`code`,`name`,`imgurl`,`price_unit`,`attr`,`remark`) values (?,?,?,?,?,?);";
		$re = $this->dbObj->exec ( $sql, $data );
		return $re;
	}
	
	/**
	 * 获取sku信息
	 * @param array $data
	 */
	public function getSku($data = array()){
		$sql = "select * from `sku`;";
		return $this->dbObj->fetch_all($sql , $data);
	}
	
	/**
	 * 删除sku信息
	 * @param array $data
	 */
	public function delSku($data = array()){
		$sql = "delete from `sku` where `id` = ? ";
		$this->dbObj->exec ( $sql, $data );
		return true;
	}
}