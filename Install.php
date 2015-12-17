<?php
// folder/file
// Following the directories structure
class autocraft_Install
{
	
 
		//Create the database
	public static function install($previous) {
		//We get here the instance of the XenForo db
		$db = XenForo_Application::get('db');
	 	if (XenForo_Application::$versionId < 1050070)
		{
			// note: this can't be phrased
			throw new XenForo_Exception('This add-on requires XenForo 1.5.0 or higher.', true);
		}
		$tables = self::getTables();
		
		foreach($tables as &$table){
			//Tell the db to query our 'createQuery', remember?
			$db->query($table);
		}
		

	}
	
		//Drop the database
	public static function uninstall() {
		$db = XenForo_Application::get('db');

		foreach (self::getTables() AS $tableName => $tableSql)
		{
			try
			{
				$db->query("DROP TABLE IF EXISTS `$tableName`");
			}
			catch (Zend_Db_Exception $e) {}
		}
	}

	
	
	public static function getTables()
	{
		$tables = array();
		$models=array();
		array_push($models,XenForo_Model::create('autocraft_Model_Game'));
		array_push($models,XenForo_Model::create('autocraft_Model_Game_Profile'));
		foreach($models as $model){
			
			$tables[$model->getPrefixedTableName()]=$model->GetTableScript();
		}
		return $tables;
	}
}

?>