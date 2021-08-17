<?php

function getContent($cachefile, $remotepath)
{
    $ch = curl_init();
    if (! $ch) {
        die("Couldn't initialize a cURL handle");
    }
    curl_setopt($ch, CURLOPT_URL, $remotepath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $contents = curl_exec($ch);
    curl_close($ch);
    return $contents;
}

/*
 * NOT USED SINCE CURL SOLVED THE PERFORMANCE PROBLEM
 * function getCacheContent($cachefile, $remotepath)
 * {
 * global $useCache, $cacheTime;
 *
 * if (! $useCache) {
 * $ch = curl_init();
 * curl_setopt($ch, CURLOPT_URL, $remotepath);
 * curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 * $contents = curl_exec($ch);
 * curl_close($ch);
 * return $contents;
 * // return file_get_contents($remotepath, false);
 * }
 *
 * $cachefile = "cache/" . preg_replace('/[^A-Za-z0-9\-]/', '', $cachefile);
 *
 * // Generate the cache version if it doesn't exist or it's too old!
 * $filemtime = @filemtime($cachefile); // returns FALSE if file does not exist
 * if (! $filemtime or (time() - $filemtime >= $cacheTime)) {
 *
 * $ch = curl_init();
 * curl_setopt($ch, CURLOPT_URL, $remotepath);
 * curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 * $contents = curl_exec($ch);
 * curl_close($ch);
 *
 * // $contents = file_get_contents($remotepath, false);
 * file_put_contents($cachefile, $contents, LOCK_EX);
 * return $contents;
 * } else {
 * return file_get_contents($cachefile);
 * }
 * }
 * function clearCache()
 * {
 * global $useCache, $cacheTime;
 *
 * if (! $useCache) {
 * return;
 * }
 *
 * $fileSystemIterator = new FilesystemIterator('cache');
 * // $clearTime = time() - (60 * 60 * 24);
 * $clearTime = time() - ($cacheTime);
 *
 * foreach ($fileSystemIterator as $file) {
 * if ($file->getCTime() <= $clearTime) {
 * unlink('cache/' . $file->getFilename());
 * }
 * }
 * }
 */
function isHttps()
{
    return (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443;
}

function mergeXML(&$base, $add)
{
    $new = $base->addChild($add->getName());
    foreach ($add->attributes() as $a => $b) {
        $new[$a] = $b;
    }
    foreach ($add->children() as $child) {
        mergeXML($new, $child);
        $this->mergeXML($new, $child);
    }
}

/* These are helper functions */
function render($template, $vars = array())
{
    
    // This function takes the name of a template and
    // a list of variables, and renders it.
    
    // This will create variables from the array:
    extract($vars);
    
    // It can also take an array of objects
    // instead of a template name.
    // if (is_array ( $template )) {
    // if ($template->asXML() != null){
    if (! is_string($template)) {
        
        // If an array was passed, it will loop
        // through it, and include a partial view
        if (is_array($template)) {
            foreach ($template as $k) {
                
                // This will create a local variable
                // with the name of the objects class
                
                // $children = $template->children();
                
                // $cl = array_shift(array_keys($template));
                
                // $cl = strtolower ( get_class ( $k ) );
                // $$cl = $k;
                
                include "views/$view.php";
            }
        }
    } else {
        include "views/$template.php";
    }
}

/* These are helper functions */
function renderGames($games)
{
    $previousDate = "init";
    $i = 0;
    if (is_array($games)) {
        foreach ($games as $k) {
            /*
             * if ($i == 0) { $previousDate = $k->datum; } else { $previousDate = $k->datum; }
             */
            if ($previousDate != "init" and (strtotime($previousDate) != strtotime($k->datum))) {
                include "views/__tablefootergames.php";
            }
            
            if ($i == 0 or (strtotime($previousDate) != strtotime($k->datum))) {
                include "views/__tableheadergames.php";
            }
            
            include "views/_games.php";
            
            $previousDate = $k->datum;
            $i ++;
        }
        if ($i > 0) {
            include "views/__tablefootergames.php";
        }
    }
}

function getGameStatus($status)
{
    switch ($status) {
        case 1:
            return "label label-warning";
            break;
        case 2:
            return "label label-lightgreen";
            break;
        default:
            return "label label-gray";
            break;
    }
}

function getGameStatusText($status)
{
    switch ($status) {
        case 1:
            return S_PAGAR;
            break;
        case 2:
            return S_SLUTFORD;
            break;
        default:
            return S_EJPABORJAD;
            break;
    }
}

// Helper function for title formatting:
function formatTitle($title = '')
{
    // if ($title) {
    // $title.= ' | ';
    // $title .= '';
    // }
    
    // $title .= $GLOBALS ['defaultTitle'];
    return $title;
}

function percentage($val1, $val2, $precision)
{
    if (@eval(" try{ \$res = round ( ($val1 / $val2) * 100, $precision ); } catch(Exception \$e){}") === FALSE) {
        $res = 0;
    }
    return $res;
}

/*
 * function percentage($val1, $val2, $precision) { $res = round ( ($val1 / $val2) * 100, $precision ); return $res; }
 */
function dow($arg1)
{
    // dow(date("N")); // Returns current weekday
    $dow = explode("|", S_MA . "|" . S_TI . "|" . S_ON . "|" . S_TO . "|" . S_FR . "|" . S_LO . "|" . S_SO);
    
    return $dow[$arg1 - 1];
}

// Return number of days between dates
function howManyDays($startDate, $endDate)
{
    $date1 = strtotime($startDate . " 0:00:00");
    $date2 = strtotime($endDate . " 23:59:59");
    $res = (int) (($date2 - $date1) / 86400);
    
    return $res;
}

// Return number of days between dates
function isObjectArray(&$objectString, &$iterator, $member)
{
    // parse_str($objectString, $object);
    if (is_array($objectString)) {
        // return $object->$iterator->eval($member);
        // return $objectString . '->' . $iterator . '->' . $member;
        return $objectString . '->' . $iterator . "->$member";
    } else {
        return $objectString . '->' . $member;
    }
}

?>
