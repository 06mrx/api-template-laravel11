<?php

namespace App\Http\Controllers\API\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalData as Model;
use App\Models\ReferenceVillage as Village;
use App\Models\ReferenceDistrict as District;
use App\Models\ReferenceCity as City;
use App\Models\ReferenceProvince as Province;
use Validator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Image; 
use File;

class PersonalDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        if($role->name == 'Guru') {
            $validator = Validator::make($request->all(), [
                'name' => ['required'],
                'tiered_training' => ['required'],
                'reference_work_unit_id' => ['required'],
                'email' => ['required', 'unique:users', 'email:rfc,dns'],
                'password' => ['required'],
                'password_verification' => ['required', 'same:password'],
                /*
                'gender' => ['required'],
                // 'registration_number' => ['required'],
                'id_number' => ['required', 'digits:16'],
                // 'educator_number' => ['required'],
                'birth_place' => ['required'],
                'birth_date' => ['required'],
                'gender' => ['required'],
                'reference_marital_status_id' => ['required'],
                'reference_religion_id' => ['required'],
                // 'reference_rank_id' => ['required'],
                
                'reference_position_id' => ['required'],
                'reference_status_id' => ['required'],
                'reference_education_id' => ['required'],
                // 'cs_year' => ['required'],
                // 'cs_candidate_year' => ['required'],
                // 'tax_number' => ['required'],
                'teacher_type' => ['required'],
                'address' => ['required'],
                'village_id' => ['required'],
                'zip_code' => ['required'],
                */
            ]);
        } elseif ($role->name == 'Kepala Sekolah' || $role->name == 'Dinas Pendidikan') {
            $validator = Validator::make($request->all(), [
                'name' => ['required'],
                'gender' => ['required'],
                'registration_number' => ['required'],
                'id_number' => ['required', 'digits:16'],
                'educator_number' => ['required'],
                'birth_place' => ['required'],
                'birth_date' => ['required'],
                'gender' => ['required'],
                'reference_marital_status_id' => ['required'],
                'reference_religion_id' => ['required'],
                // 'reference_rank_id' => ['required'],
                'reference_work_unit_id' => ['required'],
                'reference_position_id' => ['required'],
                'reference_status_id' => ['required'],
                'reference_education_id' => ['required'],
                'cs_year' => ['required'],
                'cs_candidate_year' => ['required'],
                'tax_number' => ['required'],
                'teacher_type' => ['required'],
                'address' => ['required'],
                'village_id' => ['required'],
                'zip_code' => ['required'],
                'email' => ['required', 'unique:users', 'email:rfc,dns'],
                'password' => ['required'],
                'password_verification' => ['required', 'same:password'],
            ]);
        } elseif ($role->name == 'Tenaga Kesehatan' || $role->name == 'Baznas' || $role->name == 'Disdukcapil' || $role->name == 'Ketua TPPS') {
            $validator = Validator::make($request->all(), [
                'name' => ['required'],
                'gender' => ['required'],
                'registration_number' => ['required'],
                'id_number' => ['required', 'digits:16'],
                // 'educator_number' => ['required'],
                'birth_place' => ['required'],
                'birth_date' => ['required'],
                'gender' => ['required'],
                'reference_marital_status_id' => ['required'],
                'reference_religion_id' => ['required'],
                // 'reference_rank_id' => ['required'],
                'reference_work_unit_id' => ['required'],
                'reference_position_id' => ['required'],
                'reference_status_id' => ['required'],
                'reference_education_id' => ['required'],
                // 'cs_year' => ['required'],
                // 'cs_candidate_year' => ['required'],
                // 'tax_number' => ['required'],
                'teacher_type' => ['required'],
                'address' => ['required'],
                'village_id' => ['required'],
                'zip_code' => ['required'],
                'email' => ['required', 'unique:users', 'email:rfc,dns'],
                'password' => ['required'],
                'password_verification' => ['required', 'same:password'],
            ]);
        }
        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $model = new Model();
        $model->name = $request->name;
        $model->reference_work_unit_id = $request->reference_work_unit_id;
        
        $model->gender = $request->gender;
        $model->tiered_training = $request->tiered_training;
        $model->phone_number = $request->phone_number;
        $model->registration_number = $request->registration_number;
        $model->id_number = $request->id_number;
        $model->educator_number = $request->educator_number;
        $model->birth_place = $request->birth_place;
        // $model->birth_date = $request->birth_date;
        $model->birth_date = $request->birth_date;
        $model->reference_marital_status_id = $request->reference_marital_status_id;
        $model->reference_religion_id = $request->reference_religion_id;
        $model->reference_rank_id = $request->reference_rank_id;
        
        $model->reference_position_id = $request->reference_position_id;
        $model->reference_status_id = $request->reference_status_id;
        // $model->reference_education_id = $request->reference_education_id;
        $model->reference_education_id = $request->reference_education_id;
        $model->cs_candidate_year = $request->cs_candidate_year;
        $model->tax_number = $request->tax_number;
        $model->teacher_type = $request->teacher_type;
        $model->address = $request->address;
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
        
        if($request->photo) {
            $storePath = "public/profile-photo/";
            $path = "storage/profile-photo";
            $file = $request->file('photo');
            $filename = $model->id_number .'-photo-'. $file->getClientOriginalName();
        }
        if($request->photo) {
            $model->photo = $path . '/' . $filename;
        }
        
        if($model->save()) {
            $user = new User();
            $user->email = $request->email;
            $user->registration_number = $request->registration_number;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            $user->personal_data_id = $model->id;
            $user->reference_work_unit_id = $request->reference_work_unit_id;
            if($user->save())
                if($request->photo) {
                    $image = Image::make($request->file('photo'))->resize(500, 500, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // $this->createThumbnail(storage_path('app/'.$individual->thumbnail_photo_dir), 100,100);
                    File::makeDirectory(storage_path('app/' . $storePath), $mode = 0777, true, true);

                    $image->save(storage_path('app/' . $storePath . $filename), 50);
                    // $file->storeAs($storePath, $filename);
                    return $this->sendResponse($model->id, 'Success');
                }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
