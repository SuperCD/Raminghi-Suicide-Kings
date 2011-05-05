<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
class SKManagersViewRaids extends JView {
	function display($tpl = null)
    {
        JToolBarHelper::title( JText::_( 'Suicide Kings Manager - Raid da importare' ), 'generic.png' );
        JToolBarHelper :: custom( 'ignoreraid', 'generic.png', 'generic.png', 'Ignora Raids', false, false );         
 

        $raidModel =& JModel::getInstance('raid','SKManagersModel');
 		
        $importList = $raidModel->getToImportRaidData();
        
        $this->assignRef( 'importraids', $importList);        
 
        parent::display($tpl);
    }
	
}