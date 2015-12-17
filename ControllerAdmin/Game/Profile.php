<?php 
class autocraft_ControllerAdmin_Game_Profile extends autocraft_ControllerAdmin_Base {
	public function _getDataWriterName(){
		return 'autocraft_DataWriter_Game_Profile';
	}
	public function _getModelName(){
		return 'autocraft_Model_Game_Profile';
	}
	
	public function actionIndex(){
	
		$model=$this->_getModel();
		if ($gameId = $this->_input->filterSingle('game_id', XenForo_Input::UINT)){
			$profiles=$model->getProfilesByGameId($gameId);
		}else{
			$profiles=$model->getProfiles();
		}
		$viewParams=array(
			'profiles'=>$profiles,
			'game_id'=>$gameId
		);
		return $this->responseView('autocraft_ViewAdmin_Game_Profile_List', 'autocraft_game_profile_list', $viewParams);
	}
	
	
	public function actionAdd(){
	
	}
	
	public function actionEdit(){
	
	}
}

?>