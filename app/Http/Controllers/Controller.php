<?php namespace App\Http\Controllers;

use Request;
use Response;
use Theme;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
    
    /**
     * 
     */
    public function __construct()
    {
        // set the default layout (can be overwritten in controllers)
        Theme::setLayout('app');
    }
    
    /**
     * This is used to determine whether to render with view script, or json
     * @param string $view View script
     * @param string $data Data to pass to view or render json
     * @return string Generated view html or json
     */
    protected function render($view, $data=array())
    {
        // check if this is an ajax request, or ajax has been requested via GET (format=json)
        if (Request::ajax() or Request::get('format') == 'json') {
            return Response::json($data);
        } else {
            return Theme::view($view, $data);
        }
    }
}
