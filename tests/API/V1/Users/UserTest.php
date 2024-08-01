<?php

namespace API\V1\Users;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
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

}