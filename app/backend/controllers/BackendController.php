<?php

namespace Backend\Controllers;

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;

class BackendController extends Controller
{
    public static function sendJSON($obj)
    {
        if (count($obj) == 0) {
            $obj = [];
        }
        $response = new Response(json_encode($obj));
        $response->setContentType('application/json');
        $response->setStatusCode(200);
        $response->send();
    }
    public static function getJSONError(){
         switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return ' - No errors';
                break;
            case JSON_ERROR_DEPTH:
                return ' - Maximum stack depth exceeded';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                return ' - Underflow or the modes mismatch';
                break;
            case JSON_ERROR_CTRL_CHAR:
                return ' - Unexpected control character found';
                break;
            case JSON_ERROR_SYNTAX:
                return ' - Syntax error, malformed JSON';
                break;
            case JSON_ERROR_UTF8:
                return ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
            default:
                return ' - Unknown error';
                break;
        }
    }
}