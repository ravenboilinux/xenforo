<?php
class autocraft_Model_Game extends autocraft_Model_Base{
public $tableName;
	public $tableScript;

	
	
	public function getCurrentGames(){
		return $this->_getDb()->fetchAll('
			SELECT
				games.*,
				user.user_id, user.username
				FROM '.$this->getPrefixedTableName().' AS games
				INNER JOIN xf_user as user ON (user.user_id = games.created_user_id)
					ORDER BY games.created_date DESC
			'); 
		
	}
	/**
      * Prepare the array user in the notes
      */
    public function prepareGames(array $games)
    {
        foreach ($games as &$game){
			$game['user'] = XenForo_Application::arrayFilterKeys($game, array(
                    'user_id',
                    'username',
            ));
            unset($game['user_id'], $game['username']);
        }
        return $games;
    }
	
	public function getGameByGameId($gameId){
		 return $this->_getDb()->fetchRow('
        SELECT *
            FROM `'.$this->getPrefixedTableName().'` AS games
        WHERE game_id = ?
        ', $gameId);
		
	}
	protected function getTableName(){
		return "games";
	}
	
	public function GetTableScript(){
		return 'CREATE TABLE IF NOT EXISTS `'.$this->getPrefixedTableName().'` (
			  `game_id` int(11) NOT NULL AUTO_INCREMENT,
			  `title` varchar(50) NOT NULL,
			  `description` varchar(255) NOT NULL,
			  `created_user_id` int(11) NOT NULL,
			  `created_date` int,
			  PRIMARY KEY (`game_id`),
			  UNIQUE KEY `title` (`title`)
        ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;';
		
	}
	
	
	
}
?>