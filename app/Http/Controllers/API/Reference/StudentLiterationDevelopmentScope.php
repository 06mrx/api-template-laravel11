<?php

namespace App\Http\Controllers\API\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferenceStudentLiterationDevelopmentScope as Model;
use Validator;
class StudentLiterationDevelopmentScope extends Controller
{
  public function index()
  {
      $models = Model::orderBy('id')->get();
      return $this->sendResponse($models, 'Success');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'scope' => ['required'],
      'code' => ['required'],
    ]);
    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());
    }

    $model = new Model();
    $model->scope = $request->scope;
    $model->code = $request->code;

    if($model->save()) {
        return $this->sendResponse($model->id, 'Success');
    }
    return $this->sendError('error.',['error'=>'Error']);
  }

  public function update(Request $request, $id)
  {
    $model = Model::findOrFail($id);
    $validator = Validator::make($request->all(), [
      'scope' => ['required'],
      'code' => ['required'],
    ]);
    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());
    }
    $model->scope = $request->scope;
    $model->code = $request->code;
  
    if($model->save()) {
        return $this->sendResponse($model->id, 'Success');
    }
    return $this->sendError('error.',['error'=>'Error']);

  }

  // public function destroy($id)
  // {
  //   $model = Model::findOrFail($id);
  // }
}
