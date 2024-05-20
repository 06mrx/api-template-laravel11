<?php

namespace App\Http\Controllers\API\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferenceVillage as Model;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $models = DB::select(DB::raw("SELECT
        indonesia_villages.id as value,
        initcap(concat(indonesia_provinces.name, ' / ' , indonesia_cities.name, ' / ' , indonesia_districts.name, ' / ' , indonesia_villages.name)) as label
        FROM
            indonesia_villages
        INNER JOIN
            indonesia_districts
        ON 
            indonesia_villages.district_code = indonesia_districts.code
        INNER JOIN
            indonesia_cities
        ON 
            indonesia_districts.city_code = indonesia_cities.code
        INNER JOIN
            indonesia_provinces
        ON indonesia_cities.province_code = indonesia_provinces.code
          WHERE indonesia_cities.id = 369 
          LIMIT 50"));
    //   $models = Model::paginate();
      return $this->sendResponse($models, 'Success');

    }

    public function search(Request $request)
    {
        $models = DB::select(DB::raw("SELECT
        indonesia_villages.id as value,
        initcap(concat(indonesia_provinces.name, ' / ' , indonesia_cities.name, ' / ' , indonesia_districts.name, ' / ' , indonesia_villages.name)) as label
        FROM
            indonesia_villages
        INNER JOIN
            indonesia_districts
        ON 
            indonesia_villages.district_code = indonesia_districts.code
        INNER JOIN
            indonesia_cities
        ON 
            indonesia_districts.city_code = indonesia_cities.code
        INNER JOIN
            indonesia_provinces
        ON indonesia_cities.province_code = indonesia_provinces.code
            WHERE indonesia_cities.id = 369
            AND indonesia_villages.name ilike '%" . $request->terms .   "%' LIMIT 15"));
            //  $models = Model::paginate();
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
