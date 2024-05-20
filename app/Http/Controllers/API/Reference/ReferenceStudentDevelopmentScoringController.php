<?php

namespace App\Http\Controllers\API\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferenceStudentDevelopmentScoring as Model;
class ReferenceStudentDevelopmentScoringController extends Controller
{
    public function index()
    {
        $models = Model::select('id', 'name')->get();
        return $this->sendResponse($models, 'Success');
    }
}
