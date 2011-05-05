<?php
/**
 * Controllo dei giocatori per Suicide Kings Manager
 * 
 * @package    SKManager.Admin
 * @subpackage Components
 * @license             GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class SKManagersControllerPlayer extends SKManagersController
{
	    function __construct()
        {
                parent::__construct();
 
                // Register Extra tasks
                $this->registerTask( 'add' , 'edit' );
        }

        /**
 * display the edit form
 * @return void
 */
function edit()
{
    JRequest::setVar( 'view', 'player' );
    JRequest::setVar( 'layout', 'form'  );
    JRequest::setVar('hidemainmenu', 1);
 
    parent::display();
}

function raids()
{
	JRequest::setVar( 'controller', 'raids');
    JRequest::setVar( 'view', 'raids' );
    JRequest::setVar( 'layout', 'default'); 
    parent::display();
}

	function save()
	{

		$model = $this->getModel('player');
		if ($model->store()) {
			$msg = 'Modifica effettuata con successo';
		} else {
			$msg = 'Non è stato possibile effettuare la modifica!';
		}
		
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_skmanager';
		$this->setRedirect($link, $msg);
	}
	
	/**
 * remove record(s)
 * @return void
 */
function remove()
{
    $model = $this->getModel('player');
    if(!$model->delete()) {
        $msg = JText::_( 'Error: Non è stato possibile cancellare uno o più giocatori' );
    } else {
        $msg = JText::_( 'Giocatori Cancellati!' );
    }
 
    $this->setRedirect( 'index.php?option=com_skmanager', $msg );
}

function suicide()
{
    $model = $this->getModel('player');
    if(!$model->suicide()) {
        $msg = JText::_( 'Error: Non è stato possibile cancellare uno o più giocatori' );
    } else {
        $msg = JText::_( 'Giocatori suicidati!' );
    }
 
    $this->setRedirect( 'index.php?option=com_skmanager', $msg );
}

function import()
{
    $model = $this->getModel('player');
    if(!$model->ImportNewPlayers($error)) {
        $msg = JText::_( 'Error: Non è stato possibile importare uno o più giocatori ('. $error .')' );
    } else {
        $msg = JText::_( 'Giocatori importati!' );
    }
    $this->setRedirect( 'index.php?option=com_skmanager', $msg );
}
  

}

?>