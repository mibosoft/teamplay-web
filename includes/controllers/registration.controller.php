<?php

/* This controller renders the home page */
class RegistrationController
{

    public $msgtxt = "";

    public function handleRequest()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $folder = $_GET['home'];
                    $baseInfo = CupInfo::getBaseInfo($folder);
                    $settings = Settings::getSettings($folder);
                    $menuItems = UserPages::getMenuItems($folder);
                    $isHttps = isHttps();
                    if (isset($_GET['form'])) {
                        render('iframe', array(
                            'pageTitle' => "",
                            'url' => $settings[0]->string21 . '/' . $settings[0]->value21 . '/?anmalan!=' . $GLOBALS['lang'] . '&',
                            'height' => 1800,
                            'msgtxt' => $this->msgtxt,
                            'settings' => $settings,
                            'menuItems' => $menuItems,
                            'baseInfo' => $baseInfo
                        ));
                    } else {
                        render('registration', array(
                            'msgtxt' => $this->msgtxt,
                            'settings' => $settings,
                            'menuItems' => $menuItems,
                            'baseInfo' => $baseInfo,
                            'isHttps' => $isHttps
                        ));
                    }
                    break;
                default:
            }
        } catch (Exception $e) {
            // Display the error page using the "render()" helper function:
            render('error', array(
                'message' => $e->getMessage()
            ));
        }
    }
}

?>
	