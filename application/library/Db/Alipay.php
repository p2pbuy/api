<?php
class Db_Alipay extends Db_Abstract{
	private $poolName = 'main';
	private $dbObj;
	
	public function __construct($poolName = null){
		$poolName = $poolName ? $poolName : $this->poolName;
		$this->dbObj = Db_Db::pool($poolName);
		return true;
	}
	
	/**
	 * 写入支付宝返回结果
	 */
	public function setPayInfo($data = array()){
		$sql = "insert into `alipayinfo` (`uid`,`boid`,`resultinfo`,`result`) values (?,?,?,?);";
		return  $this->dbObj->exec ( $sql, $data );
	}
}