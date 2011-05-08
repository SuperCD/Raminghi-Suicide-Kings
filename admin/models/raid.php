<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
 
jimport( 'joomla.application.component.model' );

require_once( JPATH_COMPONENT.DS.'utility.php' );

class SKManagersModelRaid extends JModel
{

	function _buildRaidsQuery()
	{
		$query = ' SELECT * '
		. ' FROM #__sk_raid ORDER BY date DESC'
		;
		return $query;
	}


	function getImportedRaidData($limitStart = 0, $limit = 0)
	{
		$query = $this->_buildRaidsQuery();
		return $this->_getList( $query, $limitStart, $limit);
	}
	
	
	function importRaid ($raidID) {
		$boolresult = True;
		$db =& JFactory::getDBO();
		$raiderdb =& SKManagerUtilities::getRaiderDB();
		$remoteQuery = 'SELECT * FROM #__raid WHERE raid_id = '. $raidID;
		$raiderdb->setQuery($remoteQuery);
		$result = $raiderdb->loadAssoc();
		// Insert the raid		
	  	$insertionQuery = 'INSERT INTO #__sk_raid (raid_id, date, name) VALUES ('. $result['raid_id'] .', '
	  	 . $result['start_time'] . ', "'. $result['location'] . '")';
		$db->setQuery($insertionQuery);
		if (!$db->query()) {
			Die($insertionQuery);
		}
		// Insert the attendance
		$remoteQuery = 'SELECT raid_id, profile_id, cancel, queue FROM #__signups WHERE raid_id = '. $raidID;
		$raiderdb->setQuery($remoteQuery);
		$result = $raiderdb->loadAssocList();
		foreach ($result as $row) {
		  $signedup = 1;
		  $attended = 0;
		  $cancelled = 0;
		  if (($row['queue'] == 0) && ($row['cancel'] == 0)) {
		  	$attended = 1;
		  } else if ($row['cancel'] == 1) {
		  	$cancelled = 1;
		    $signedup = 0;		  	
		  }
		  // Insert each player
	  	  $insertionQuery = 'INSERT INTO #__sk_attendance (raid_id, profile_id, signedup, attended, notavaiable) VALUES ('. $row['raid_id'] .', '
	  	   . $row['profile_id'] . ', '. $signedup . ', '. $attended . ', '. $cancelled . ')';
		  $db->setQuery($insertionQuery);
	  	  if (!$db->query()) {
	  	  	Die($insertionQuery);
	  	  }	
		}
		return $boolresult;
	}
	
	function ignoreRaid() {
        $cids = JRequest::getVar( 'rid', array(0), 'post', 'array' );		
		$db =& JFactory::getDBO();
		$raiderdb =& SKManagerUtilities::getRaiderDB();
		foreach ($cids as $cid) {
		$remoteQuery = 'SELECT * FROM #__raid WHERE raid_id = '. $cid;
		$raiderdb->setQuery($remoteQuery);
		$result = $raiderdb->loadAssoc();
	  	$insertionQuery = 'INSERT INTO #__sk_raid (raid_id, date, name, ignored) VALUES ('. $result['raid_id'] .', '
	  	 . $result['start_time'] . ', "'. $result['location'] . '", 1)';
		$db->setQuery($insertionQuery);
		$db->query();
		}
		return True;		
	}	
	
	function getToImportList() {
		
		$db =& JFactory::getDBO();
		$raiderdb =& SKManagerUtilities::getRaiderDB();
		
		$remoteQuery = 'SELECT raid_id FROM #__raid ORDER BY start_time DESC';
		$localQuery = 'SELECT raid_id FROM #__sk_raid ORDER BY date DESC';
		$raiderdb->setQuery($remoteQuery);
		$newValue = $raiderdb->loadResultArray();
		
		$db->setQuery($localQuery);
		$oldValue = $db->loadResultArray();
		
		return array_diff($newValue, $oldValue);
	}	

	function getToImportRaidData() {
		$raids = $this->getToImportList();
		$db =& JFactory::getDBO();
		$raiderdb =& SKManagerUtilities::getRaiderDB();
		$results = array();
		foreach ($raids as $raid) {
		  $remoteQuery = 'SELECT * FROM #__raid WHERE raid_id = '. $raid;
		  $raiderdb->setQuery($remoteQuery);
		  $results[] = $raiderdb->loadAssoc();		  	
		}
		return $results;
	}

	function getRaidDetails($raidid) {
		$db =& JFactory::getDBO();
		$localQuery = 'SELECT * FROM #__sk_raid WHERE raid_id = '. $raidid;
		$db->setQuery($localQuery);
		$result = $db->loadObject();	
		return $result;
	}		
	
	function getRaidPlayedList($raidid) {
		$db =& JFactory::getDBO();
		$localQuery = 'SELECT * FROM #__sk_attendance '.
		  'INNER JOIN #__sk_player ON #__sk_attendance.profile_id = #__sk_player.profile_id '.
		  'WHERE attended = 1 AND raid_id = '. $raidid .' ORDER BY name DESC';
		$db->setQuery($localQuery);
		$result = $db->loadObjectList();		
		return $result;
	}	

	function getRaidSignedList($raidid) {
		$db =& JFactory::getDBO();
		$localQuery = 'SELECT * FROM #__sk_attendance '.
		  'INNER JOIN #__sk_player ON #__sk_attendance.profile_id = #__sk_player.profile_id '.
		  'WHERE signedup = 1 AND attended = 0 AND raid_id = '. $raidid .' ORDER BY name DESC';
		$db->setQuery($localQuery);		
		return $db->loadAssocList();
	}

	function getRaidUnaviableList($raidid) {
		$db =& JFactory::getDBO();
		$localQuery = 'SELECT * FROM #__sk_attendance '.
		  'INNER JOIN #__sk_player ON #__sk_attendance.profile_id = #__sk_player.profile_id '.
		  'WHERE notavaiable = 1 AND attended = 0 AND raid_id = '. $raidid .' ORDER BY name DESC';
		$db->setQuery($localQuery);		
		return $db->loadAssocList();
	}

	function getRaidUnsignedList($raidid) {
		$db =& JFactory::getDBO();
		$localQuery = 'SELECT * FROM #__sk_player WHERE profile_id NOT IN (
		  SELECT profile_id FROM #__sk_attendance WHERE raid_id = '. $raidid .
		  ' AND attended = 1 OR signedup = 1 OR notavaiable = 1) ORDER BY name DESC';
		$db->setQuery($localQuery);		
		return $db->loadAssocList();
	}
	
	function addpartcipation($raidid, $playerid) {
    	$db =& JFactory::getDBO();
    	$existancequery = 'SELECT COUNT(profile_id) FROM #__sk_attendance WHERE raid_id = '. $raidid .' AND profile_id = '. $playerid;  
		$db->setQuery($existancequery);
		$db->LoadResult();	
        $numrows = $db->LoadResult();
        if ($numrows > 0) {
     		$query = 'UPDATE #__sk_attendance SET attended = 1 WHERE raid_id = '. $raidid .' AND profile_id = '. $playerid;       	
        } else {
        	$query = 'INSERT INTO #__sk_attendance(raid_id, profile_id, attended) VALUES ('. $raidid .', '. $playerid .', 1)';        	
        }
        $db->setQuery($query);
        return $db->query();		   	
	}
	function removepartcipation($raidid, $playerid) {
    	$db =& JFactory::getDBO();
     	$query = 'UPDATE #__sk_attendance SET attended = 0 WHERE raid_id = '. $raidid .' AND profile_id = '. $playerid;       	
        $db->setQuery($query);
        return $db->query();		   	
	}	
	
}
