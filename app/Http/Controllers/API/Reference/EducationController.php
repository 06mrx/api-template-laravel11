<?php

namespace App\Http\Controllers\API\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferenceEducation as Model;
use Validator;

class EducationController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function list()
    {
      $models = Model::select('id', 'name')->get();
      return $this->sendResponse($models, 'Success');

    }

    public function index()
    {
      $models = Model::select('id', 'name')->get();
      return $this->sendResponse($models, 'Success');

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => ['required']
      ]);
      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());
      }

      $model = new Model();
      $model->name = $request->name;
      if($model->save()) {
        return $this->sendResponse($model->id, 'Success');
      }

      return $this->sendError('error.',['error'=>'Error']);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
      //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'name' => ['required']
      ]);
      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());
      }
      $model = Model::findOrFail($id);
      $model->name = $request->name;

      if($model->save()) {
        return $this->sendResponse($model->id, 'Success');
      }
      return $this->sendError('error.',['error'=>'Error']);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      $model = Model::findOrFail($id);

      if($model->delete()) {
        return $this->sendResponse($model->id, 'Success');
      }
      return $this->sendError('error.',['error'=>'Error']);
    }
}
