<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class SKManagersModelRaider extends JModel
{
	var $raiderdb;
	var $db;
	
	function __construct() {
		parent::__construct();
		getRaiderDB();
		$db =& JFactory::getDBO();
		
	}
	
	function getRaiderDB () {
		$option = array(); //prevenire problemi

		$option['driver']   = 'mysql';            // Nome del driver del Database
		$option['host']     = 'db.myhost.com';    // Nome host del Database
		$option['user']     = 'fredbloggs';       // Utente per l'autenticazione al Database
		$option['password'] = 's9(39s£h[%dkFd';   // Password
		$option['database'] = 'bigdatabase';      // Nome del Database
		$option['prefix']   = 'phpraider_';             // Prefisso per le tabelle del Database (può essere vuoto)
		$radierdb = & JDatabase::getInstance( $option );
	}

	function checkNewRaids () {
		$lastStart = 0;
		$query = 'SELECT MAX(date) FROM #__sk_raid';
		$db->setQuery( $query );
		$lastStart = $db->loadResult();
		
		$query = 'SELECT raid_id FROM #__raid WHERE start_time > '. $lastStart;
		$raiderdb->setQuery( $query );
		$raiderdb->query();
		$newRaids = $raiderdb->getNumRows();
		return ($newRaids > 0);
	}
	
	function syncPlayers () {
		$localQuery = 'SELECT profile_id FROM #__sk_player';
		$remoteQuery = 'SELECT profile_id FROM #__profile';
		
		$db->setQuery($localQuery);
		$oldValue = $db->loadResultArray();
		$raiderdb->setQuery($remoteQuery);
		$newValue = $raiderdb->loadResultArray();
		$toAdd = array_diff($newValue, $oldValue);
		$toDelete = array_diff($oldValue, $newValue);
		
		foreach ($toAdd as $addID) {
			$remoteQuery = 'SELECT char_name FROM #__character WHERE character_id IN (SELECT MIN(character_id) FROM #__character WHERE profile_id = '.$addID.')';
			$raiderdb->setQuery($remoteQuery);
			$charName = $raiderdb->loadResult();
			$insertionQuery = 'INSERT INTO #__sk_player (profile_id,name) VALUES ('. $addID .', '. $charName . ')';
			$db->setQuery($insertionQuery);
			$db->query();
		}
		
		foreach ($toDelete as $delID) {
			$deletionQuery = 'DELETE FROM #__sk_player WHERE profile_id = '.$delID;
			$db->setQuery($insertionQuery);
			$db->query();
		}
		
	}
	
	
}
