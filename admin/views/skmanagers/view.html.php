<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
class SKManagersViewSKManagers extends JView {
	function display($tpl = null)
    {
        $playerModel =& JModel::getInstance('player','SKManagersModel');
 		
        $playerList = $playerModel->getStandingData();
        
        $this->assignRef( 'players', $playerList);
 
        parent::display($tpl);
    }
	
}
