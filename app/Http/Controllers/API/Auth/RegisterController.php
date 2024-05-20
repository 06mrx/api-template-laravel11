<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reference_work_unit_id' => 'required',
            'personal_data_id' => 'required',
            'registration_number' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_verification' => 'required|same:password',
            'role_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        $user = User::create($input);
        
        $success["name"] = $user->name;
        $success["email"] = $user->email;
        $success["role_id"] = $user->role_id;
        $success["token"] = $user->createToken("clien_secret")->plainTextToken;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
}
