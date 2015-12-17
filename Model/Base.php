<?php
abstract class autocraft_Model_Base extends XenForo_Model{

	abstract protected function getTableName();
	abstract public function GetTableScript();
	
	public function getPrefixedTableName(){
		
		return 'xf_ac_'.$this->getTableName();
	}
   
}

?>