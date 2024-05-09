<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use http\Env\Request;

class UserController extends  Controller
{
    public function index(Request $request)
    {
        $res = $this->service->index($request);
        echo 'using commands for generate code to service';
    }
}
