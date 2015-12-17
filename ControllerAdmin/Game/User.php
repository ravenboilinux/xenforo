<?php 
class autocraft_ControllerAdmin_Game_User extends autocraft_ControllerAdmin_Base {
	public function _getDataWriterName(){
		return 'autocraft_DataWriter_Game_User';
	}
	public function _getModelName(){
		return 'autocraft_Model_Game_User';
	}
}

?>