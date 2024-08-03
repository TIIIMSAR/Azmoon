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


    public function index(Request $request)
    {
        $this->validate($request, [
            'search' => ['nullable', 'string'],
            'page' => ['required', 'numeric'],
            'pagesize' => ['nullable', 'numeric'],
        ]);

        $users =  $this->userRepository->paginate($request->search, $request->page, $request->pagesize ?? 20, ['full_name', 'mobile', 'email']);
        
        return $this->respondSuccess('لیست کاربران', $users);
    }

        
    public function store(Request $request)
    {
         $this->validate($request, [
            'full_name' => ['required', 'string', 'min:3', 'max:256'],
            'email' => ['required', 'email'],
            'mobile' => ['required', 'string'],
            'password' => ['required'],
         ]);


        $newUser = $this->userRepository->create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => app('hash')->make($request->password) 
         ]);
       

        return $this->respondCreated('کاربر ایجاد شد ', [
            'full_name' => $newUser->getFullName(),
            'email' => $newUser->getEmail(),
            'mobile' => $newUser->getMobile(),
            'password' => $newUser->getPassword(),
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

        $user = $this->userRepository->update($request->id, [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
         ]);


         return $this->respondSuccess('کابر با موفقیت بروز رسانی شد', [
            'full_name' => $user->getFullName(),
            'email' => $user->getEmail(),
            'mobile' => $user->getMobile(),
         ]);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
            'password' => ['min:6', 'required_with:password_repeat', 'same:password_repeat'],
            'password_repeat ' => ['min:6'],
        ]);

        try 
        {   $user = $this->userRepository->update($request->id, [
                'password' => app('hash')->make($request->password),
            ]);
        } catch (\Exception $th) {
            return $this->respondInternalError('کاربر بروز رسانی نشد ');     
        }

        return $this->respondSuccess('رمز عبور شما با موفقیت بروز رسانی شد', [
            'full_name' => $user->getFullName(),
            'email' => $user->getEmail(),
            'mobile' => $user->getMobile(),
        ]);
    }


    public function delete(Request $request)
    {
        $this->validate($request, ['id' => 'required']);

         if(!$this->userRepository->find($request->id))
            return $this->respondNotFound('کاربری با این ID وجود ندارد');
        
        if(!$this->userRepository->delete($request->id))
            return $this->respondInternalError('خطایی وجود دارد مجدد تلاش نمایید');

        return $this->respondSuccess('کاربر با موفقیت حذف شد', []);

    }

    
}