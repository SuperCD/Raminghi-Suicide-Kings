<?php
/**
 * Default Controller
 * @package    SKManager.Admin
 * @subpackage Components
 * @license    GNU/GPL
 */
 
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.controller');

class SKManagersController extends JController
{
    /**
     * Method to display the view
     *
     * @access    public
     */
    function display()
    {
    	$this->addToolbar();
		parent::display();
    }
    
    protected function addToolbar()
    {
    	JToolBarHelper::title( JText::_( 'Suicide Kings Manager' ), 'generic.png' );
		JToolBarHelper::deleteList();
		JToolBarHelper::custom( 'suicide', 'iconname.png', 'iconname.png', 'Suicide', false, false );
		JToolBarHelper::custom( 'import', 'iconname.png', 'iconname.png', 'Importa giocatori', false, false );
		JToolBarHelper::custom( 'raids', 'iconname.png', 'iconname.png', 'Gestione Raid', false, false ); 
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::preferences('com_skmanager', 320);
    } 
 
}

?>