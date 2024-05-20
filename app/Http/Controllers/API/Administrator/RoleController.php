<?php

namespace App\Http\Controllers\API\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role as Model;
class RoleController extends Controller
{
    public function index()
    {
        $models = Model::select('id', 'name')->get();
        return $this->sendResponse($models, 'Success');
    }

    public function list()
    {
        # code...
    }
}
