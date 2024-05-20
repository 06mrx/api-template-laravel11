<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        if(empty($request->email) && empty($request->password)) {
            return $this->sendError('Unauthorised.',['error'=>'Unauthorised']);   
        }
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $data["name"] = $user->personalData->name;
            $data["email"] = $user->email;
            $data["role_id"] = $user->role_id;
            $data["token"] = $user->createToken("clien_secret")->plainTextToken;
            return $this->sendResponse($data, 'Authenticated.');
        }

        return $this->sendError('Your credential does not match.',['error'=>'Unauthorised']);   

    }
  
}
