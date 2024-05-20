<?php

namespace App\Http\Controllers\API\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferenceStudentLiterationDevelopmentIndicator as Model;
use Validator;
class StudentLiterationDevelopmentIndicator extends Controller
{
  public function index(Request $request)
  {
      // $models = Model::where('reference_student_literation_development_scope_id', $request->scope_id)->get();
      if($request->month) {
        $models = Model::where('reference_student_literation_development_scope_id', $request->scope_id)->where('start_age_group' , '<=', $request->month)
        ->where('end_age_group', '>', $request->month)->get();
      } else {
        $models = Model::orderBy('id')->with('ReferenceStudentLIterationDevelopmentScope:id,scope')->get();
      }
      
      return $this->sendResponse($models, 'Success');
  }
  public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'scope_id' => ['required'],
        'indicator' => ['required'],
        'age' => ['required'],
        'code' => ['required']
      ]);
      if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());
      }
  
      $model = new Model();
      $model->reference_student_literation_development_scope_id = $request->scope_id;
      $model->achievement = $request->indicator;
      $model->code = $request->code;
      if($request->age == 1) {
        $model->start_age_group = 24;
        $model->end_age_group = 36;
      } else if($request->age == 2) {
        $model->start_age_group = 36;
        $model->end_age_group = 48;
      } else if($request->age == 3) {
        $model->start_age_group = 48;
        $model->end_age_group = 60;
      } else if($request->age == 4) {
        $model->start_age_group = 60;
        $model->end_age_group = 72;
      }
  
      if($model->save()) {
          return $this->sendResponse($model->id, 'Success');
      }
      return $this->sendError('error.',['error'=>'Error']);
    }

    public function update(Request $request, $id)
    {
      $model = Model::findOrFail($id);
      $validator = Validator::make($request->all(), [
        'scope_id' => ['required'],
        'indicator' => ['required'],
        // 'age' => ['required'],
        'code' => ['required']
      ]);
      if($validator->fails()){
          return $this->sendError('Validation Error.', $validator->errors());
      }
  
      
      $model->reference_student_literation_development_scope_id = $request->scope_id;
      $model->achievement = $request->indicator;
      $model->code = $request->code;
      
      if($request->age == 1) {
        $model->start_age_group = 24;
        $model->end_age_group = 36;
      } else if($request->age == 2) {
        $model->start_age_group = 36;
        $model->end_age_group = 48;
      } else if($request->age == 3) {
        $model->start_age_group = 48;
        $model->end_age_group = 60;
      } else if($request->age == 4) {
        $model->start_age_group = 60;
        $model->end_age_group = 72;
      }
  
      if($model->save()) {
          return $this->sendResponse($model->id, 'Success');
      }
      return $this->sendError('error.',['error'=>'Error']);
    }

    public function destroy($id)
    {
      $model = Model::findOrFail($id);
      $model->delete();
      return $this->sendResponse($model->id, 'Success');
    }
}
