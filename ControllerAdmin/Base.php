<?php 
abstract  class autocraft_ControllerAdmin_Base extends XenForo_ControllerAdmin_Abstract{
	
	public function _getModel(){
		
		return $this->getModelFromCache($this->_getModelName());
		
	}
	public function _getDataWriter(){
		
		
		return XenForo_DataWriter::create($this->_getDataWriterName());
	
	}
	
	abstract function _getDataWriterName();
	abstract function _getModelName();
}
?>