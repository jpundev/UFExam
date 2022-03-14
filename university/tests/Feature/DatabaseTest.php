<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\University;
use App\Models\Pages;
use App\Models\Domains;
use App\Models\TotalUni;
class DatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
     //Test table inserts

    public function test_insert_university()
    {
        University::create([
            'country' => 'TestCountry',
            'alpha_two_code' => 'testAlpha',
            'name' => 'Test',
            'state_province' => 'testProvince'
        ]);

        $this->assertDatabaseHas('university', [
            'name' => 'Test'
        ]);

    }
    public function test_insert_domains()
    {
        Domains::create([
            'id_university' => 60861,
            'domain_name' => 'Test'
        ]);

        $this->assertDatabaseHas('domains', [
            'domain_name' => 'Test'
        ]);

    }

    public function test_insert_pages()
    {
        Pages::create([
            'id_university' => 60861,
            'url' => "test.ca"
        ]);

        $this->assertDatabaseHas('web_pages', [
            'url' => 'test.ca'
        ]);

    }

    public function test_insert_total()
    {
        TotalUni::create([
            'country' => 'Canada',
            'alpha_two_code' => 'CA',
            'name' => 'test',
            'state_province' => 'AB',
            'domains' => 'test.ca, hello.com',
            'web_pages' => 'test.test',
            'multi_domain' => 0,
            'multi_page' => 0
        ]);

        $this->assertDatabaseHas('total_uni', [
            'name' => 'test'
        ]);

    }
}
