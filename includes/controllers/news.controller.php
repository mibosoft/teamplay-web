<?php

/* This controller renders the home page */
class NewsController
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

					if (!empty($settings) and $settings[0]->value31 == 0) {
						render('message', array(
							'baseInfo' => $baseInfo,
							'settings' => $settings,
							'menuItems' => $menuItems,
							'message' => S_EJPUB
						));
						break;
					}

					$news = News::getNews($folder);
					render('news', array(
						'msgtxt' => $this->msgtxt,
						'baseInfo' => $baseInfo,
						'settings' => $settings,
						'menuItems' => $menuItems,
						'news' => $news
					));

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
