<?php
// No direct access
 defined( '_JEXEC' ) or die( 'Restricted access' );
 
class SKManagerUtilities
{
	/**
	 * Recupera l'istanza di collegamento al database del phpRaider.
	 * @return mixed istanza di collegamento oppure <strong>JException</strong> se mancano dati/errore.
	 */
	function getRaiderDB ()
	{	
		$params = &JComponentHelper::getParams('com_skmanager');
		
		$option = array(); //prevenire problemi

		$option['driver']   = $params->get('phpraider_db_driver', NULL);		// Nome del driver del Database
		$option['host']     = $params->get('phpraider_db_host', NULL);			// Nome host del Database
		$option['user']     = $params->get('phpraider_db_username', NULL);		// Utente per l'autenticazione al Database
		$option['password'] = $params->get('phpraider_db_password', NULL);		// Password
		$option['database'] = $params->get('phpraider_db_dbname', NULL);		// Nome del Database
		$option['prefix']   = $params->get('phpraider_db_tablesprefix', NULL);	// Prefisso per le tabelle del Database (può essere vuoto)
		
		$res = TRUE;
		foreach($option as $myopt) if(empty($myopt)) $res = FALSE;
		
		if(!$res) return new JException(JTEXT::_('Parametri di connessione al database del phpRaider insufficienti.'));
		return JDatabase::getInstance( $option );
	}
}