<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserLoginTest extends TestCase
{
    protected $credentials = [
        'main' => [
            'email' => 'user@soa.re',
            'password' => 'User123',
        ],
    ];

    /** @test */
    public function a_user_can_login_to_the_site()
    {
        $response = $this->post(route('login'), $this->credentials['main']);
        
        $this->assertAuthenticated();
    }
}