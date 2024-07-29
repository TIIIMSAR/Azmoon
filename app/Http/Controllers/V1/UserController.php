<?php
namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositorieInterface;

class UserController extends Controller
{
    public function __construct(private UserRepositorieInterface $userRepository)
    {
        
    }


    public function store()
    {
    //     $this->userRepository->create();
        
        return response()->json(
            [
                'success' => true,
                'message' => 'کاربر ایجاد شد ',
                'dats' => [
                    'full_name' => 'hossein mohammadi',
                    'email' => 'hossein_mohammadi@gmail.com',
                    'mobile' => '0930098723',
                    'password' => '123456',
                ],       
            ]
        )->setStatusCode(201) ;
    }



}