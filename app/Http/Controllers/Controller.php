<?php namespace App\Http\Controllers;

use Request;
use Response;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;
    
    /**
     * This is used to determine whether to render with view script, or json
     * @param string $view View script
     * @param string $data Data to pass to view or render json
     * @return string Generated view html or json
     */
    protected function render($view, $data)
    {
        if (Request::ajax()) {
            return Response::json($data);
        } else {
            return view($view, $data);
        }
    }
}
