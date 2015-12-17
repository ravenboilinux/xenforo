<?php
class autocraft_Model_Game_Profile extends autocraft_Model_Base{
public $tableName;
	public $tableScript;

	
	
	
	public function getProfilesByGameId($gameId){
	
		return $this->_getDb()->fetchAll('select gameprofile.* 
										  from `'.$this->getPrefixedTableName().'` AS gameprofile
										 ORDER BY gameprofile.display_order DESC');
	}
	protected function getTableName(){
		return "games_profiles";
	}
	
	public function GetTableScript(){
		return 'CREATE TABLE IF NOT EXISTS `'.$this->getPrefixedTableName().'` (
  `profile_id` varbinary(25) NOT NULL,
  `game_id` int NOT NULL,
  `display_order` int NOT NULL,
  PRIMARY KEY (`profile_id`,`game_id`),
  KEY `profile_id` (`profile_id`)
)  ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;';
		
	}
	
	
	
}
?>