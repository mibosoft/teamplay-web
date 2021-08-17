<?php

/* Set locale to */
//setlocale(LC_ALL, 'swedish');
//setlocale( LC_TIME, 'sv_SE.ISO_8859-1');
setlocale(LC_ALL, "sve");

date_default_timezone_set('Europe/Stockholm');

/*
	This is the main include file.
	It is only used in index.php and keeps it much cleaner.
*/

require_once "includes/helpers.php";

require_once "includes/models/cupdir.model.php";
//require_once "includes/models/cupdirremote.model.php";
require_once "includes/models/cupinfo.model.php";
require_once "includes/models/classes.model.php";
require_once "includes/models/games.model.php";
require_once "includes/models/standings.model.php";
require_once "includes/models/news.model.php";
require_once "includes/models/settings.model.php";
require_once "includes/models/teams.model.php";
require_once "includes/models/people.model.php";
require_once "includes/models/arenas.model.php";
require_once "includes/models/fairplay.model.php";
require_once "includes/models/teamstat.model.php";
require_once "includes/models/playerstat.model.php";
require_once "includes/models/occasions.model.php";
require_once "includes/models/lineups.model.php";
require_once "includes/models/userpages.model.php";
require_once "includes/models/places.model.php";
require_once "includes/models/refereeschedule.model.php";
require_once "includes/controllers/refereeschedule.controller.php";
require_once "includes/controllers/referees.controller.php";
require_once "includes/controllers/mapoverview.controller.php";
require_once "includes/controllers/history.controller.php";
require_once "includes/controllers/userpage.controller.php";
require_once "includes/controllers/arenas.controller.php";
require_once "includes/controllers/team.controller.php";
require_once "includes/controllers/teams.controller.php";
require_once "includes/controllers/fairplay.controller.php";
require_once "includes/controllers/teamstat.controller.php";
require_once "includes/controllers/playerstat.controller.php";
require_once "includes/controllers/news.controller.php";
require_once "includes/controllers/rules.controller.php";
require_once "includes/controllers/info.controller.php";
require_once "includes/controllers/refereeregistration.controller.php";
require_once "includes/controllers/registration.controller.php";
require_once "includes/controllers/game.controller.php";
require_once "includes/controllers/games.controller.php";
require_once "includes/controllers/overview.controller.php";
require_once "includes/controllers/overviewclass.controller.php";
require_once "includes/controllers/overviewgroup.controller.php";
require_once "includes/controllers/overviewplayoff.controller.php";
require_once "includes/controllers/cupdir.controller.php";
require_once "includes/controllers/home.controller.php";

// This will allow the browser to cache the pages of the store.

/*
header('Cache-Control: max-age=3600, public');
header('Pragma: cache');
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time())." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s",time()+3600)." GMT");
*/
?>