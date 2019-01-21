<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    protected $credentials = [
        'main' => [
            'email' => 'admin@soa.re',
            'password' => 'Admin123',
        ],
    ];

    /** @test */
    public function an_admin_can_login_to_the_admin_panel()
    {
        $response = $this->post(route('admin.login'), $this->credentials['main']);
        
        $this->assertAuthenticated('admin');
    }
}