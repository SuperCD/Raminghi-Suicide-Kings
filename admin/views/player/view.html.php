<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.view' );
class SKManagersViewPlayer extends JView {
	function display($tpl = null)
    {

        // Get data from the model
        $playerModel =& $this->getModel();
 		$array = JRequest::getVar('cid',  0, '', 'array');
        $playerEdit = $playerModel->getPlayerData($array[0]);
                       
        $this->assignRef( 'player', $playerEdit); 
        $isNew		= ($playerEdit->profile_id < 1);
        
        $text = $isNew ? JText::_( 'Aggiungi' ) : JText::_( 'Modifica' );
        JToolBarHelper::title(   JText::_( 'Suicide Kings' ).': <small><small>[ ' . $text.' Giocatore ]</small></small>' );
		JToolBarHelper::save();
        
    	if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Annulla' );
		}
		
		
        parent::display($tpl);
    }
	
}