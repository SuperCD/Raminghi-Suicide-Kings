<?php

// No direct access
defined('_JEXEC') or die('Restricted access');
 

class TablePlayer extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $profile_id = null;
 
    /**
     * @var string
     */
    var $name = null;

    /**
     * @var int
     */
    var $punteggio = null;
 
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    
    function TablePlayer( &$db ) {
        parent::__construct('#__sk_player', 'profile_id', $db);
    }
}
 