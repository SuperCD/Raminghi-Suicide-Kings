<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
class SKManagersViewRaidEdit extends JView {
	function display($tpl = null)
    {
        JToolBarHelper::title( JText::_( 'Suicide Kings Manager - Modifica dettagli Raid' ), 'generic.png' );

        $raidModel =& JModel::getInstance('raid','SKManagersModel');
        $raidid = JRequest::getVar( 'raidid'); 		
        $raidDetails = $raidModel->getRaidDetails($raidid);
        $PlayedList = $raidModel->getRaidPlayedList($raidid);
        $SignedList = $raidModel->getRaidSignedList($raidid);
        $UnAviableList = $raidModel->getRaidUnaviableList($raidid);
        $UnsignedList = $raidModel->getRaidUnsignedList($raidid);
        
        $this->assignRef( 'details', $raidDetails);
        $this->assignRef( 'played', $PlayedList); 
        $this->assignRef( 'signed', $SignedList); 
        $this->assignRef( 'unaviable', $UnAviableList); 
        $this->assignRef( 'unsigned', $UnsignedList); 
 
        parent::display($tpl);
    }
	
}