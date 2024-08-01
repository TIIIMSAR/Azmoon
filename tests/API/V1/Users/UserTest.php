<?php

namespace API\V1\Users;

use Tests\TestCase;

class UserTest extends TestCase
{
            // create
    public function test_should_create_a_new_users()
    {
        $response = $this->call('POST', 'api/v1/users', [
            'full_name' => 'hossein mohammadi',
            'email' => 'hossein_mohammadi@gmail.com',
            'mobile' => '0930098723',
            'password' => '123456',
        ]);    

        $this->assertEquals(201, $response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',
                'password',
            ]
        ]);
    }
            // test validation requset
    public function test_it_must_throw_a_exception_if_we_dont_send_properties()
    {
        $response = $this->call('POST', 'api/v1/users',[]); 
        
        $this->assertEquals(422, $response->status());
    }

            // update
    public function test_should_update_a_user()
    {
        $response = $this->call('PUT', 'api/v1/users', [
            'id' => '882',
            'full_name' => 'خمینی',
            'email' => 'cosKIR@gmail.com',
            'mobile' => '0930098723',
        ]);    

        $this->assertEquals(200, $response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',   
            ]
        ]);
    }

    
    public function test_it_must_throw_a_exception_if_we_dont_send_properties_to_update_info()
    {
        $response = $this->call('PUT', 'api/v1/users',[]); 
        
        $this->assertEquals(422, $response->status());
    }

            // update password
    public function test_should_update_password()
    {
        $response = $this->call('PUT', 'api/v1/users/change-password', [
            'id' => '717',
            'password' => '1234567890',
            'password_repeat' => '1234567890',
        ]);

        $this->assertEquals(200, $response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'full_name',
                'email',
                'mobile',   
            ],   
        ]);
    }

        
    public function test_it_must_throw_a_exception_if_we_dont_send_properties_to_update_update()
    {
        $response = $this->call('PUT', 'api/v1/users/change-password',[]); 
        
        $this->assertEquals(422, $response->status());
    }
            // delete password
    public function test_should_delete_a_user()
    {
        $response = $this->call('DELETE', 'api/v1/users/', [
            'id' => '111111111111'
        ]);

        $this->assertEquals('200', $response->status());

        $this->seeJsonStructure([
            'success',  
            'message',
            'data',
        ]);
    }
    
    public function test_should_get_users()
    {
        $pagesize = 3;
        $response = $this->call('GET', 'api/v1/users', [
            'page' => 1,
            'pagesize' => $pagesize,
        ]);

        $data = json_decode($response->getContent(), true);

        $this->assertEquals($pagesize, count($data['data']));
        $this->assertEquals(200, $response->status());
        
        $this->seeJsonStructure([
            'success',  
            'message',
            'data',
        ]);
    }


    public function test_should_get_filtered_users()
    {
        $pagesize = 3;
        $userEmail = 'cosKIR@gmail.com';   
        $response = $this->call('GET', 'api/v1/users', [
            'search' => $userEmail,
            'page' => 1,
            'pagesize' => $pagesize,
        ]);

        $data = json_decode($response->getContent(), true);
            $this->assertEquals($data['data']['email'], $userEmail);

        $this->assertEquals(200, $response->status());
        
        $this->seeJsonStructure([
            'success',  
            'message',
            'data',
        ]);
    }

}