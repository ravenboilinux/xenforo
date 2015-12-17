<?php
class autocraft_ControllerAdmin_Game extends autocraft_ControllerAdmin_Base {

	protected function _preDispatch($action)
	{

		$this->assertAdminPermission('thread');
	}

	public function _getDataWriterName(){
		return 'autocraft_DataWriter_Game';
	}
	public function _getModelName(){
		return 'autocraft_Model_Game';
	}
	
	public function actionIndex(){
		$gameModel = $this->_getModel();
		if(!isset($gameModel)){
			return $this->responseError(new XenForo_Phrase('requested_ac_game_not_found'), 404);
		}
		$viewParams = array(
			'current_games' => $gameModel->prepareGames($gameModel->getCurrentGames())
			
		);

		return $this->responseView('autocraft_ViewAdmin_Game_List', 'autocraft_game_list', $viewParams);
		
	}
	public function actionAdd()
	{
		return $this->responseReroute('autocraft_ControllerAdmin_Game', 'edit');
	}
	public function actionEdit()
	{
		$gameModel = $this->_getModel();

		if ($gameId = $this->_input->filterSingle('game_id', XenForo_Input::UINT))
		{
			// if a node ID was specified, we should be editing, so make sure a category exists
			$game =$gameModel->getGameByGameId($gameId);
			if (!$game)
			{
				return $this->responseError(new XenForo_Phrase('requested_ac_game_not_found'), 404);
			}
		}
		else{
			$game=array(
				'title'=>'',
				'description'=>''
			);
			
		}
		$viewParams = array(
			'game' => $gameModel->getGameByGameId($gameId)
			
		);
		return $this->responseView('Xautocraft_ViewAdmin_Game_Edit', 'autocraft_game_add', $viewParams);
	}
	public function actionSave()
	{
		
		$this->_assertPostOnly();
		if ($this->_input->filterSingle('delete', XenForo_Input::STRING))
		{
			return $this->responseReroute('autocraft_ControllerAdmin_Game', 'deleteConfirm');
		}
		$title=$this->_input->filterSingle('title',XenForo_Input::STRING);
		$desc=$this->_input->filterSingle('description',XenForo_Input::STRING);
		$gameId = $this->_input->filterSingle('game_id', XenForo_Input::UINT);
		 //Lets get the ID of the user who is given the note
        $visitor = XenForo_Visitor::getInstance()->toArray();
		//The date of the note given
        $current_time = XenForo_Application::$time;
		
		$writer = $this->_getDataWriter();
		if($gameId){
			$writer->setExistingData($gameId);
		}else{
			$writer->set('created_user_id', $visitor['user_id']);
			$writer->set('created_date', $current_time);
		}
		$writer->set('title', $title);
        $writer->set('description', $desc);
		$writer->save();
		return $this->responseRedirect(
			XenForo_ControllerResponse_Redirect::SUCCESS,
			XenForo_Link::buildAdminLink('games') .'game.'. $writer->get('game_id')
		);
	}
	
	public function ValidateField(){
		$this->_assertPostOnly();
	}
	

}
?>