<?php

/* This controller renders the init page */
class CupdirController {
	public $msgtxt = "";
	public function handleRequest() {
		try {
			switch ($_SERVER ['REQUEST_METHOD']) {
				case 'GET' :
					
					$completedcups = isset($_GET ['completedcups']);
					
					if ($completedcups){
						$cups = Cupdir::findAll ("");
						$title = S_GEMOFORDATURN;
						
					}else{
						$cups = Cupdir::findAll ("active");
						$title = S_AKTUELLATURN;
					}
					
					render ( 'cupdir', array (
							'title' => $title,
							'msgtxt' => $this->msgtxt,
							'cups' => $cups 
					) );
					
					/*
					 * render ( 'home', array (
					 * 'title' => 'Hem',
					 * 'msgtxt' => $this->msgtxt) );
					 */
					break;
				case 'POST' :
					exit ();
					break;
				default :
			}
		} catch ( Exception $e ) {
			// Display the error page using the "render()" helper function:
			render ( 'error', array (
					'message' => $e->getMessage () 
			) );
		}
	}
}

?>
