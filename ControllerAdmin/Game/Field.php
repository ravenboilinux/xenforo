<?php 
class autocraft_ControllerAdmin_Game_Field extends autocraft_ControllerAdmin_Base {
	public function _getDataWriterName(){
		return 'autocraft_DataWriter_Game_Field';
	}
	public function _getModelName(){
		return 'autocraft_Model_Game_Field';
	}
}

?>