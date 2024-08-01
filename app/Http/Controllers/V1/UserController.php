<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Contract\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositorieInterface;
use Illuminate\Http\Request;

class UserController extends ApiController
{   
    public function __construct(private UserRepositorieInterface $userRepository)
    {  
    }

        
    public function store(Request $request)
    {

         $this->validate($request, [
            'full_name' => ['required', 'string', 'min:3', 'max:256'],
            'email' => ['required', 'email'],
            'mobile' => ['required', 'string'],
            'password' => ['required'],
         ]);

         $this->userRepository->create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => app('hash')->make($request->password) 
         ]);


            return $this->respondCreated('کاربر ایجاد شد ', [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => $request->password,
            ]);
    }


    public function updateInfo(Request $request)
    {
        
        $this->validate($request, [
            'id' => ['required'],
            'full_name' => ['required', 'string', 'min:3', 'max:256'],
            'email' => ['required', 'email'],
            'mobile' => ['required', 'string'],
         ]);

         $this->userRepository->update($request->id, [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
         ]);


         return $this->respondSuccess('کابر با موفقیت بروز رسانی شد', [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
         ]);
    }

}