<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public object $service;

    public function __construct()
    {
        if(!empty(Route::getCurrentRoute())){
            $method = explode('\\', Route::getCurrentRoute()->getControllerClass());
            $controller = $method[count($method) -1];
            if($controller !== "AuthController"){
                $service = str_replace("Controller", "Service", $controller);
                $pathToService = "\App\Services\\{$method[3]}\\{$service}";
                $this->service = new $pathToService();
            }
        }
    }
}
