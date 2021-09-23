<?php
// REST-API from https://github.com/bencentra/php-rest-api
// http://coreymaynard.com/blog/creating-a-restful-api-with-php/

abstract class API
{
    protected $baseUrl = '../';  // MB added 
    protected $method = '';
    protected $endpoint = '';
    protected $verb = '';
    protected $args = array();
    protected $file = null;

    public function __construct($request)
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        //        header("Content-Encoding: gzip");
        header("Content-Type: application/json");

        $this->args = explode('/', rtrim($request, '/'));
        // The following line would shift out the name of the actual endpoint. Probably meant for use with .htaccess file where you rewrite the url. 
        //        $this->endpoint = array_shift($this->args);
        $this->endpoint = $this->args[0];
        if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
            $this->verb = array_shift($this->args);
        }

        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
    }

    public function processAPI()
    {
        switch ($this->method) {
            case 'DELETE':
            case 'POST':
                $this->request = $this->_cleanInputs($_POST);
                break;
            case 'GET':
                $this->request = $this->_cleanInputs($_GET);
                break;
            case 'PUT':
                $this->request = $this->_cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
                break;
            default:
                return $this->_response('Invalid Method', 405);
                break;
        }

        if ((int)method_exists($this, $this->endpoint) > 0) {
            return $this->_response($this->{$this->endpoint}($this->args));
        }

        return $this->_response("No Endpoint: $this->endpoint", 404);
    }

    private function _response($data, $status = 200)
    {
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));

        // Change required to re-write empty elements {} (objects) to "" (strings)
        //        return json_encode($data, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT only works in PHP >= 5.4

        // Tried compressing but little benefit :-(
        //        if(function_exists('ob_gzhandler')) ob_start('ob_gzhandler');
        //        else ob_start();
        //        $json_data = str_replace(': {}',': ""',json_encode($data, JSON_PRETTY_PRINT));
        //        ob_end_flush();
        //		return $json_data;

        return str_replace(': {}', ': ""', json_encode($data, JSON_PRETTY_PRINT));
    }

    private function _cleanInputs($data)
    {
        $clean_input = array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

    private function _requestStatus($code)
    {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code]) ? $status[$code] : $status[500];
    }
}
