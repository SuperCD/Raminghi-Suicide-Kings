<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class SKManagersModelPlayer extends JModel
{

	
	function _buildStandingQuery()
	{
		$query = ' SELECT profile_id, name '
		. ' FROM #__sk_player ORDER BY name DESC'
		;
		return $query;
	}


	function getStandingData()
	{
		$query = $this->_buildStandingQuery();
		return $this->_getList( $query );
	}


	function store() {
		$row =& $this->getTable();
		$data = JRequest::get( 'post' );
		
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}
		
		return true;
		
	}
	
	/**
 * Method to delete record(s)
 *
 * @access    public
 * @return    boolean    True on success
 */
function delete()
{
    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
    $row =& $this->getTable();
 
    foreach($cids as $cid) {
    	echo $cid;
        if (!$row->delete( $cid )) {
            $this->setError( $row->getErrorMsg() );
            return false;
        }
    }
 
    return true;
}
	
function suicide()
{
    $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
    $row =& $this->getTable();

    
    foreach($cids as $cid) {
    	echo $cid;
        $from = array( 'profile_id' => $cid,
               'punteggio'  => 0,
             );
        $ignore = 'profile_id';
             
        if (!$row->bind($from)) {
            $this->setError( $row->getErrorMsg() );
            return false;
        }
        
    	if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		        
    	if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}        
    } 
    return true;
}	
	
	function importPlayer($pid, $points=0) {
		require_once( JPATH_COMPONENT.DS.'utility.php' );
		$db =& JFactory::getDBO();
		$raiderdb =& SKManagerUtilities::getRaiderDB();
		$remoteQuery = 'SELECT char_name FROM #__character WHERE character_id IN (SELECT MIN(character_id) FROM #__character WHERE profile_id = '.$pid.')';
		$raiderdb->setQuery($remoteQuery);
		$charName = $raiderdb->loadResult();
		if ($charName != '') {
  		  $insertionQuery = 'INSERT INTO #__sk_player (profile_id, name, punteggio) VALUES ('. $pid .', "'. $charName . '", '. $points.')';
		  $db->setQuery($insertionQuery);
		  return $db->query(); }
		else {
	      return true; }
	}
	
	function getToAddList() {
		require_once( JPATH_COMPONENT.DS.'utility.php' );
		$db =& JFactory::getDBO();
		$raiderdb =& SKManagerUtilities::getRaiderDB();
		
		$remoteQuery = 'SELECT profile_id FROM #__profile';
		$localQuery = 'SELECT profile_id FROM #__sk_player';
		$raiderdb->setQuery($remoteQuery);
		$newValue = $raiderdb->loadResultArray();
		
		$db->setQuery($localQuery);
		$oldValue = $db->loadResultArray();
		
		return array_diff($newValue, $oldValue);
	}
	
	function getToRemoveList() {
		require_once( JPATH_COMPONENT.DS.'utility.php' );
		$db =& JFactory::getDBO();
		$raiderdb =& SKManagerUtilities::getRaiderDB();
		
		$remoteQuery = 'SELECT profile_id FROM #__profile';
		$localQuery = 'SELECT profile_id FROM #__sk_player';
		$raiderdb->setQuery($remoteQuery);
		$newValue = $raiderdb->loadResultArray();
		
		$db->setQuery($localQuery);
		$oldValue = $db->loadResultArray();
		
		return array_diff($oldValue, $newValue);
	}	

    function ImportNewPlayers(&$error) {
    	$result = true;
    	$removes = SKManagersModelPlayer::getToRemoveList();
    	$error = implode (', ', $removes); 
        	foreach($removes as $remove) {
    		$result = $result && SKManagersModelPlayer::deletePlayer($remove); 		
    	}    	
    	$pids =& SKManagersModelPlayer::getToAddList();   	
    	foreach($pids as $pid) {
    		$result = $result && SKManagersModelPlayer::importPlayer($pid); 		
    	}
    	return $result;    	
    }	
	
	function deletePlayer($pid) {
		require_once( JPATH_COMPONENT.DS.'utility.php' );
		$db =& JFactory::getDBO();
		$deletionQuery = 'DELETE FROM #__sk_player WHERE profile_id = '.$pid;
		$db->setQuery($deletionQuery);
		$db->query();
		
	}
	
	function getPlayerData($pid) {
				$query = ' SELECT profile_id, name, punteggio '
		. ' FROM #__sk_player WHERE profile_id ='. $pid;
		;
		$this->_db->setQuery( $query );
		$data = $this->_db->loadObject();
		
		
		if (!$data) {
			$data = new stdClass();
			$data->id = 0;
			$data->nome = null;
			$data->punteggio = null;
		}
		return $data;
	}

}
