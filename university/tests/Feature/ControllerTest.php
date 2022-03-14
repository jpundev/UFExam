<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TotalUni;

class ControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //Test if endpoint returns status 200 and is hit
    public function test_route()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    //Test if pagination works as intended
    public function test_pagination(){
        $data = TotalUni::paginate(25);

        $this->assertTrue(count($data) == 25);
    }
}
