<?php
class Settings
{
/**
 * @AI-MODEL: Data Dictionary & API Schema Mapping
 * Source Table: PAR (System/Tournament Parameters)
 * These user settings determine which content to display, tournament information, etc.
 * There are also settings for font color, hyperlink color, etc., that should be reflected in the layout.
 */

// Long Text / Code Injections ('memo' fields in PAR table)
// -----------------------------------------------------------------------------
// $memo1     -> Header/Top image caption
// $memo5     -> Tournament website "History" menu content (links to previous tournaments)

// Boolean Flags ('bool' fields)
// -----------------------------------------------------------------------------
// $bool1     -> Mode: "Participant Registration"
// $bool2     -> Mode: Racket sports / E-sports (Hides jersey #, position, "Shots", and Fairplay)
// $bool3     -> Navbar inverse style
// $bool4     -> Show team map
// $bool5     -> Disable tournament site updates
// $bool6     -> Show overview map
// $bool7     -> Show "Referee Expression of Interest" link
// $bool8     -> Show "History" menu
// $bool11    -> Crop overflow header images
// $bool12    -> Transparent background/bottom
// $bool13    -> Allow teams to submit match results
// $bool14    -> Allow teams to edit match details
// $bool15    -> Hide kit/jersey colors
// $bool18    -> Allow team logins
// $bool21    -> Display country flags on public website
// $bool23    -> Display payment status on public website
// $bool24    -> Display reserve/standby teams on website
// $bool25    -> Enable DiscGolf support (1. +/- Goal fields used for auto-calculated Hole Points; 2. Hides goals/shots/fairplay in match protocol; 3. Custom player stats view)
// $bool27    -> Enable "Man of the Match" field (System setting)

// Numeric & Configuration Values ('value' fields where 0 = disable, 1= enable)
// -----------------------------------------------------------------------------
// $value1    -> Team presentation view
// $value4    -> Player presentation view
// $value5    -> Schedule / Results view
// $value6    -> Player statistics view
// $value7    -> Team statistics view
// $value8    -> Venues / Playing fields  view
// $value9    -> Standings table / Bracket display mode
// $value11   -> Fairplay statistics view
// $value12   -> Referee schedule display view
// $value14   -> Group stage division display view
// $value15   -> Show "Admin / Login" link
// $value24   -> Number of news items on front page
// $value27   -> Display link to registration form
// $value30   -> Match protocol view
// $value31   -> News publishing view
// $value34   -> Match protocol variant
// $value37   -> Header/Top image height in pixels

// Path & String Settings ('string' fields)
// -----------------------------------------------------------------------------
// $string6   -> Hyperlink hover color
// $string12  -> General font color
// $string13  -> Header/Top image font color
// $string14  -> Unvisited hyperlink color
// $string16  -> Visited hyperlink color
// $string18  -> Font family
// $string20  -> Font size
// $string24  -> Tables background color
// $string26  -> Bottom/Footer background color

// Image File Names & Asset Mapping ('pic_name' / 'pic_url' fields in PAR)
// -----------------------------------------------------------------------------
// $pic_name_1               -> Header image 1 filename
// $pic_name_2 .. 15         -> Advertisement image filenames (2 through 16)
// $pic_name_16              -> Wallpaper image optionally shown in all views except the landing page.
// $pic_name_17 .. 19        -> Header image filenames (2 through 4)
// $pic_url_2 .. 16          -> Target URLs for advertisements (2 through 16)

	public static function getSettings($folder)
	{
		global $baseUrl;

		$restCmd = "rest/settings/$folder";
		$url = $baseUrl . rawurlencode($restCmd);
		$content = getContent($restCmd, $url);

		return json_decode($content, false) ?? [];  // null coalescing operator (??) to handle empty arrays (PHP 7.0+)

		//		return simplexml_load_file ( $baseUrl . $folder . '/installn.xml', "SimpleXMLElement", LIBXML_NOWARNING | LIBXML_NOERROR );
	}
}
