--
-- Struttura della tabella 'sk_adjustment'
--

DROP TABLE IF EXISTS #__sk_adjustment;
CREATE TABLE IF NOT EXISTS #__sk_adjustment (
  profile_id int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  adjustment int(11) NOT NULL,
  PRIMARY KEY (profile_id,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella 'sk_attendance'
--

DROP TABLE IF EXISTS #__sk_attendance;
CREATE TABLE IF NOT EXISTS #__sk_attendance (
  raid_id int(10) NOT NULL,
  profile_id int(11) NOT NULL,
  signedup tinyint(1) NOT NULL,
  attended tinyint(1) NOT NULL,
  notavaiable tinyint(1) NOT NULL,
  PRIMARY KEY (raid_id,profile_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella 'sk_player'
--

DROP TABLE IF EXISTS #__sk_player;
CREATE TABLE IF NOT EXISTS #__sk_player (
  profile_id int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (profile_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella 'sk_raid'
--

DROP TABLE IF EXISTS #__sk_raid;
CREATE TABLE IF NOT EXISTS #__sk_raid (
  raid_id int(10) NOT NULL,
  `date` varchar(45) NOT NULL,
  `name` varchar(35) DEFAULT NULL,
  ignored int(1) NOT NULL DEFAULT '0',
  confirmed int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (raid_id),
  UNIQUE KEY raid_id (raid_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella 'sk_reset'
--

DROP TABLE IF EXISTS #__sk_reset;
CREATE TABLE IF NOT EXISTS #__sk_reset (
  profile_id int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  points int(11) NOT NULL,
  PRIMARY KEY (profile_id,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella 'sk_suicide'
--

DROP TABLE IF EXISTS #__sk_suicide;
CREATE TABLE IF NOT EXISTS #__sk_suicide (
  raid_id int(10) NOT NULL,
  profile_id int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
