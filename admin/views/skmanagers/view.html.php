<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
class SKManagersViewSKManagers extends JView {
	function display($tpl = null)
    {
        JToolBarHelper::title( JText::_( 'Suicide Kings Manager' ), 'generic.png' );
        JToolBarHelper::deleteList();
        JToolBarHelper :: custom( 'suicide', 'iconname.png', 'iconname.png', 'Suicide', false, false );
        JToolBarHelper :: custom( 'import', 'iconname.png', 'iconname.png', 'Importa giocatori', false, false );
        JToolBarHelper :: custom( 'raids', 'iconname.png', 'iconname.png', 'Gestione Raid', false, false ); 
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();
 

        $playerModel =& JModel::getInstance('player','SKManagersModel');
 		
        $playerList = $playerModel->getStandingData();
        
        $this->assignRef( 'players', $playerList);
 
        parent::display($tpl);
    }
	
}