<?php

namespace App\Http\Controllers\API\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferenceWorkUnit as Model;
use App\Models\ReferenceVillage as Village;
use App\Models\ReferenceDistrict as District;
use App\Models\ReferenceCity as City;
use App\Models\ReferenceProvince as Province;
use Validator;
class WorkUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $models = Model::select('id', 'name')->orderBy('name')->get();
        return $this->sendResponse($models, 'Success');
    }

    public function index(Request $request)
    {
        $models = Model::query();
        if($request->search) {
            $models = $models->where('name', 'ilike', '%'.$request->search.'%');
        }

        $models = $models->orderBy('name')->paginate(10);

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
            'name' => ['required'],
            'registration_number' => ['required'],
            'address' => ['required'],
            'village_id' => ['required'],
            'unit_form' => ['required'],
            'zip_code' => ['required'],
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = new Model();
        $model->name = $request->name;
        $model->registration_number = $request->registration_number;
        $model->address = $request->address;
        $model->accreditation = $request->accreditation;
        $model->email = $request->email;
        $model->website = $request->website;
        $model->unit_form = $request->unit_form;
        $model->phone_number = $request->phone_number;
        $model->zip_code = $request->zip_code;
        
        $village = Village::where('id', $request->get('village_id'))->first();
        $district = District::where('code', $village->district_code)->first();
        $city = City::where('code', $district->city_code)->first();
        $province = Province::where('code', $city->province_code)->first();
        $model->village = $village->name;
        $model->district = $district->name;
        $model->city = $city->name;
        $model->province = $province->name;

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
        $model = Model::findOrFail($id);
        return $this->sendResponse($model, 'Success');
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
        $model = Model::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'registration_number' => ['required'],
            'address' => ['required'],
            // 'village_id' => ['required'],
            'unit_form' => ['required'],
            'zip_code' => ['required'],
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model->name = $request->name;
        $model->registration_number = $request->registration_number;
        $model->address = $request->address;
        $model->accreditation = $request->accreditation;
        $model->email = $request->email;
        $model->website = $request->website;
        $model->unit_form = $request->unit_form;
        $model->phone_number = $request->phone_number;
        $model->zip_code = $request->zip_code;
        
        if($request->village_id) {
            $village = Village::where('id', $request->get('village_id'))->first();
            $district = District::where('code', $village->district_code)->first();
            $city = City::where('code', $district->city_code)->first();
            $province = Province::where('code', $city->province_code)->first();
            $model->village = $village->name;
            $model->district = $district->name;
            $model->city = $city->name;
            $model->province = $province->name;
        }
        
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
        $model->delete();
        return $this->sendResponse($model->id, 'Delete Success');
    }
}
