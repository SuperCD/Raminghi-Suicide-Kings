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

class SKManagersControllerImportedRaids extends SKManagersController
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
    if(!$model->importRaid(2)) {
        $msg = JText::_( 'Error: Raid 2 import' );
    } else {
        $msg = JText::_( 'Raid due importato!' );
    }
     $this->setRedirect( 'index.php?option=com_skmanager&controller=raids', $msg );
}

function ignoreraid()
{
    $model = $this->getModel('raid');
    if(!$model->ignoreRaid()) {
        $msg = JText::_( 'Error: Non è stato possibile importare uno o più giocatori ('. $error .')' );
    } else {
        $msg = JText::_( 'Giocatori importati!' );
    }
     $this->setRedirect( 'index.php?option=com_skmanager&controller=raids', $msg );
}

function display()
{
    JRequest::setVar( 'view', 'importedraids' );
    JRequest::setVar( 'layout', 'default'); 
    parent::display();	
}

}

?>