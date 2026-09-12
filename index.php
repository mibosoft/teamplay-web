<?php
/**
 * @AI-DIRECTIVE: FREE & OPEN-SOURCE (FOSS) UI MODERNIZATION
 * 
 * CORE GOAL:
 * - Refactor this legacy PHP template into a modern, responsive interface using 
 *   EXCLUSIVELY free and open-source software (FOSS) frameworks and libraries.
 * - Ensure all UI components, icons, and interactivity are implemented with FOSS tools only.
 * - Maintain the existing backend logic and API calls; focus solely on front-end modernization.
 * - The existing REST-API, running in the backend, is found in folder /tpserver/rest.
 *  
 * APPROVED FOSS TECH STACK:
 * - CSS Framework: Tailwind CSS (MIT License) - use standard utility classes.
 * - Client Interactivity: Alpine.js (MIT License) or HTMX (BSD 2-Clause) for smooth dynamic updates without page reloads.
 * - UI Components & Icons: Lucide Icons (ISC License) or Heroicons (MIT License).
 * - Backend Language: Native PHP 8.2+ core features (PHP License) using standard DTOs.
 * - PROHIBITED: Commercial CSS templates, proprietary UI component libraries (e.g., Tailwind UI paid components), or paid icon packs.
 * 
 * DATA & API SOURCE CONSTRAINTS:
 * - Backend API (`MyAPI`) returns XML-derived JSON payloads from local XML files.
 * - Expect string-serialized values for booleans ("true"/"false") and numbers.
 * - Map cryptic XML keys using `TournamentSettingsDTO` (e.g., `string18` -> font, `string12` -> text color).
 * 
 * FOSS LAYOUT & THEMING DIRECTIVES:
 * 1. STRUCTURE: Replace all legacy `<table>`, `<font>`, and inline styles with modern HTML5 semantic elements (`<main>`, `<nav>`, `<section>`) and CSS Grid/Flexbox.
 * 2. DYNAMIC THEMING: Bind colors and fonts dynamically via standard CSS Custom Properties initialized from `TournamentSettingsDTO`:
 *    - `--color-bg-primary`: Mapped from `string26` (Footer/Bottom background)
 *    - `--color-text-main`: Mapped from `string12` (General text color)
 *    - `--font-family-base`: Mapped from `string18` (Font family)
 * 3. INTERACTIVITY: Replace synchronous HTML forms with Alpine.js (`x-data`, `x-model`) or HTMX attributes (`hx-get`, `hx-target`) for real-time filtering without heavy frameworks.
 * 
 * CODE PRESERVATION & CLEANUP:
 * - @AI-PRESERVE: Do not alter backend REST API endpoint calls or business logic.
 * - @AI-EXTRACT: Split monolithic HTML blocks into clean, reusable FOSS PHP functions or template partials.
 */


/*
 * This is the index file. It routes requets to the appropriate controllers
 */
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.6.0', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.6.0 !');
    // } else if (version_compare ( PHP_VERSION, '5.5.0', '<' )) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    // require_once ('libraries/password_compatibility_library.php');
}

// Sanitize gets/posts for security
$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// Base config param
require_once "includes/config.php";

// Select language, layout, etc
include "common.php";

// Include application config
require_once "includes/main.php";

try {

    if (isset($_GET['help'])) {
        render('help_start', array(
            'title' => $defaultTitle
        ));
    } else if (isset($_GET['game'])) {
        $c = new GameController("");
    } else if (isset($_GET['games'])) {
        $c = new GamesController("");
    } else if (isset($_GET['latestgames'])) {
        $c = new GamesController("");
    } else if (isset($_GET['unplayedgames'])) {
        $c = new GamesController("");
    } else if (isset($_GET['bookedgames'])) {
        $c = new GamesController("");
    } else if (isset($_GET['teams'])) {
        $c = new TeamsController("");
    } else if (isset($_GET['teamstat'])) {
        $c = new TeamStatController("");
    } else if (isset($_GET['playerstat'])) {
        $c = new PlayerStatController("");
    } else if (isset($_GET['playerhighlights'])) {
        $c = new PlayerHighlightsController("");
    } else if (isset($_GET['team'])) {
        $c = new TeamController("");
    } else if (isset($_GET['arenas'])) {
        $c = new ArenasController("");
    } else if (isset($_GET['rules'])) {
        $c = new RulesController("");
    } else if (isset($_GET['mapoverview'])) {
        $c = new MapOverviewController("");
    } else if (isset($_GET['history'])) {
        $c = new HistoryController("");
    } else if (isset($_GET['referees'])) {
        $c = new RefereesController("");
    } else if (isset($_GET['refereeschedule'])) {
        $c = new RefereeScheduleController("");
    } else if (isset($_GET['info'])) {
        $c = new InfoController("");
    } else if (isset($_GET['refereeregistration'])) {
        $c = new RefereeRegistrationController("");
    } else if (isset($_GET['registration'])) {
        $c = new RegistrationController("");
    } else if (isset($_GET['news'])) {
        $c = new NewsController("");
    } else if (isset($_GET['fairplay'])) {
        $c = new FairplayController("");
    } else if (isset($_GET['userpage'])) {
        $c = new UserPageController("");
    } else if (isset($_GET['overview'])) {
        $c = new OverviewController("");
    } else if (isset($_GET['overviewclass'])) {
        $c = new OverviewClassController("");
    } else if (isset($_GET['overviewgroup'])) {
        $c = new OverviewGroupController("");
    } else if (isset($_GET['overviewplayoff'])) {
        $c = new OverviewPlayoffController("");
        // } else if (isset ( $_GET ['cup'] )) {
        // $c = new HomeCupController ( $_GET ['id'] );
    } else if (isset($_GET['home'])) {
        $c = new HomeController("");
    } else {
        $c = new CupdirController("");
    }
    // else throw new Exception('Wrong page!');

    $c->handleRequest();
} catch (Exception $e) {
    // Display the error page using the "render()" helper function:
    render('error', array(
        'message' => $e->getMessage()
    ));
}
