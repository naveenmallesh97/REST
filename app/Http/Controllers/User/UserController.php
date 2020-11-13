<?php

namespace App\Http\Controllers\User;//Api;
use App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\User;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(User $user)
    {
      //dd('test');
        $users = User::all();

        //return response()->json(['data' => $users], 200);
       return $this->showAll($users);
    }

    public function store(Request $request)
    {

        $rules = [
            'username' => 'required', 
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

            $this->validate($request, $rules);

            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $data['verified'] = User::UNVERIFIED_USER;
            $data['verification_token'] = User::generateVerificationCode();
            $data['admin'] = User::REGULAR_USER;


            $user = User::create($data);
            //return response()->json(['data' => $user], 201);
           return $this->showOne($user, 201);
         
    }

    
    public function show(User $user)
    {

       //$user = User::findOrFail($id);
        //return response()->json(['data' => $user], 200);
       return $this->showOne($user);
    }

    
    public function update(Request $request, User $user)
    {
       
        //$user = User::findOrFail($id);

        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
        if (!$user->isVerified()) {
        //return response()->json(['error' => 'only verified users can  modify the admin field' ,'code' =>409], 409);
      }
  }
         return $this->errorResponse('only verified users can modify the admin field', 409);

        $user->admin = $request->admin;
     /*if (!$user->isDinse()->json(['error' => 'you need to specify a different value to update',' code' => 422], 422);*/

      //return respo
        return $this->errorResponse('you need to specify a different value to update', 422);
   

    $User->save();

    //return response()->json(['data' => $user], 200);
    return $this ->showOne($user);
}
    
    public function destroy(User $user)
    {
        //$user = User::findOrFail($id);
        $user->delete();
         //return response()->json(['data' => $user], 200);
        return $this->showOne($user);
    }

    public function Verify($token)
    {
      $user = User::where('verification_token', $token)->firstOrFail();

      $user->verified = User::VERIFIED_USER;
      $user->verification_token = null;

      $user ->save();

      return $this->showMessage('the account has been verified successfully');
    }
    public function resend(User $user)
    {
      if($user->isVerified()) {
         return $this->errorResponse('this user is already verified', 409);
      }
      retry(5, function() use ($user) { 
                Mail::to($user)->send(new UserCreated($user));
            }, 100);

      return $this->showMessage('the verification email has been resend');
    }

    }


