<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
   
    public function testRegister()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/register', factory(\App\User::class)->create()->toArray());

        $response->assertOk();

    }
}
