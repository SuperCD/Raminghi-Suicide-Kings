<?php
/**
 * Controllo dei raid per Suicide Kings Manager
 * 
 * @package    SKManager.Admin
 * @subpackage Components
 * @license             GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class SKManagersControllerRaidEdit extends SKManagersController
{
	    function __construct()
        {
                parent::__construct();
 
                // Register Extra tasks
                $this->registerTask( 'add' , 'edit', 'importraid', 'ignoreraid');
        }

        /**
 * display the edit form
 * @return void
 */
function edit()
{
    JRequest::setVar( 'view', 'raid' );
    JRequest::setVar( 'layout', 'form'  );
    JRequest::setVar('hidemainmenu', 1);
 
    parent::display();
}


	function save()
	{

		$model = $this->getModel('raid');
		if ($model->store()) {
			$msg = 'Modifica effettuata con successo';
		} else {
			$msg = 'Non è stato possibile effettuare la modifica!';
		}
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_skmanager&controller=raids';
		$this->setRedirect($link, $msg);
	}
	
	/**
 * remove record(s)
 * @return void
 */
function remove()
{
    $model = $this->getModel('raid');
    if(!$model->delete()) {
        $msg = JText::_( 'Error: Non è stato possibile cancellare uno o più raid' );
    } else {
        $msg = JText::_( 'Raid Cancellati!' );
    }
 
    $this->setRedirect( 'index.php?option=com_skmanager?controller=raids&controller=raids', $msg );
}

function importraid()
{
    $model = $this->getModel('raid');
    $raid_id = JRequest::getVar( 'raidid');
    if(!$model->importRaid($raid_id)) {
        $msg = JText::_( 'Error: Raid 2 import' );
    } else {
        $msg = JText::_( 'Raid importato!' );
    }
    $this->setRedirect( 'index.php?option=com_skmanager&controller=raidedit&raidid=2', $msg );
}

function ignoreraid()
{
    $model = $this->getModel('raid');
    if(!$model->ignoreRaid()) {
        $msg = JText::_( 'Error: Non è stato possibile ignorare il raid');
    } else {
        $msg = JText::_( 'Raid ignorati!' );
    }
     $this->setRedirect( 'index.php?option=com_skmanager&controller=raids', $msg );
}

function addpartecipation()
{
    $model = $this->getModel('raid');
    $raid_id = JRequest::getVar( 'raidid');
    $player_id = JRequest::getVar( 'playerid');
    if (!$model->addpartcipation($raid_id, $player_id)) {
    	$msg = JText::_( 'Errore nello spostare il giocatore' ); 
    } else {
    	$msg = JText::_( 'Giocatori spostato con successo!' ); 
    }
    $this->setRedirect( 'index.php?option=com_skmanager&controller=raidedit&raidid=2', $msg );    
}

function removepartecipation()
{
    $model = $this->getModel('raid');
    $raid_id = JRequest::getVar( 'raidid');
    $player_id = JRequest::getVar( 'playerid');
    if (!$model->removepartcipation($raid_id, $player_id)) {
    	$msg = JText::_( 'Errore nello spostare il giocatore' ); 
    } else {
    	$msg = JText::_( 'Giocatori spostato con successo!' ); 
    }
    $this->setRedirect( 'index.php?option=com_skmanager&controller=raidedit&raidid=2', $msg );    
}

function display()
{
    JRequest::setVar( 'view', 'raidedit' );
    JRequest::setVar( 'layout', 'default'); 
    parent::display();	
}

}

?>