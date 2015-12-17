<?php
class autocraft_DataWriter_Game extends XenForo_DataWriter{
	protected function _getFields(){
		$model=$this->_getGamesModel();
		$tableName=$model->getPrefixedTableName();
		return array(
			 $tableName => array(
				'game_id' => array('type' => 'uint', 'autoIncrement' => true),
				'title' => array('type' => 'string', 'required' => true),
				'description' => array('type' => 'string', 'required' => true),
				'created_user_id' => array('type' => 'string', 'required' => true),
				'created_date' => array('type' => 'uint', 'default' => XenForo_Application::$time)
			)
		);
	}
	/**
    * @return newProfileTabs_Model_newProfileModel
    */
    protected function _getGamesModel()
    {
        return $this->getModelFromCache('autocraft_Model_Game');
    }
	
	
	protected function _getExistingData($data){
		if (!$id = $this->_getExistingPrimaryKey($data, 'game_id')) {
            return false;
        }
		$model=$this->_getGamesModel();
        return array($model->getPrefixedTableName() => $model->getGameByGameId($id));
	}
	protected function _getUpdateCondition($tableName){
		 return 'game_id = ' . $this->_db->quote($this->getExisting('game_id'));
	}
	
	
}

?>