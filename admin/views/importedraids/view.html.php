<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
class SKManagersViewImportedRaids extends JView {
	function display($tpl = null)
    {
        JToolBarHelper::title( JText::_( 'Suicide Kings Manager - Raid importati' ), 'generic.png' );      

        $raidModel =& JModel::getInstance('raid','SKManagersModel');
 		
        $importList = $raidModel->getImportedRaidData();
        
        $this->assignRef( 'importraids', $importList);        
 
        parent::display($tpl);
    }
	
}