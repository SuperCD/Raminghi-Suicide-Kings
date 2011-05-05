<?php
// No direct access
 defined( '_JEXEC' ) or die( 'Restricted access' );
 
 class SKManagerUtilities {
 	function getRaiderDB () {
		$option = array(); //prevenire problemi

		$option['driver']   = 'mysql';            // Nome del driver del Database
		$option['host']     = 'localhost';    // Nome host del Database
		$option['user']     = 'root';       // Utente per l'autenticazione al Database
		$option['password'] = '';   // Password
		$option['database'] = 'phpraider';      // Nome del Database
		$option['prefix']   = 'phpraider_';             // Prefisso per le tabelle del Database (può essere vuoto)
		return JDatabase::getInstance( $option );
	}
 }