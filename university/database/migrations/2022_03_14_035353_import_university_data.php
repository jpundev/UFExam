<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use App\Models\University;
use App\Models\Pages;
use App\Models\Domains;
use App\Models\TotalUni;


// The goal of the this migration is to pull the data from the university api and put them into the MySQL db using models
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Table to put all data into one to match mockup
        Schema::create('total_uni', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('state_province')->nullable();
            $table->string('country')->nullable();
            $table->string('alpha_two_code')->nullable();
            $table->string('domains')->nullable();
            $table->string('web_pages')->nullable();
            $table->tinyInteger('multi')->nullable();
        });

        Schema::create('university', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('state_province')->nullable();
            $table->string('country')->nullable();
            $table->string('alpha_two_code')->nullable();
        });

        Schema::create('web_pages', function (Blueprint $table) {
            $table->id();
            $table->integer('id_university')->nullable();
            $table->string('url')->nullable();
        });

        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->integer('id_university')->nullable();
            $table->string('domain_name')->nullable();
        });
        //Endpoint for retrieving all universities that are from Canada and US. Consume one time??
        //Seems like the API wont accept multiple params into country
        // If 2 times then set up one search for country canada and 1 for US combine array
        // Req asks to consume once so retrieve all Data and filter by country
        $end_point = "http://universities.hipolabs.com/search?";
        //Use Laravel's Guzzle to help fetch our Data
        $client = new GuzzleHttp\Client();
        $res = $client->request("GET",$end_point);
        //Check if theres any problems getting our data. AKA not 200
        if (!($res->getStatusCode() == "200")){
            dd("Failed to get data"); 
        } else {
            //data is in JSON convert to Array to iterate
            $data = json_decode($res->getBody(), true);
            //If data isnt empty
            if ($data){
                foreach($data as $row){
                    //If canada or US.. Note dont need this step if consuming twice
                    if(in_array($row['country'],['Canada','United States'])){
                        //Insert into Universities model
                        //Return the unviveristy model instance so we can take its ID to use later
                        $university = University::create([
                        'country' => $row['country'],
                        'alpha_two_code' => $row['alpha_two_code'],
                        'name' => $row['name'],
                        'state_province' => $row['state-province']
                        ]);
                    
                        //If web_pages isnt empty
                        if ($row['web_pages']){
                            foreach($row['web_pages'] as $pages){
                                Pages::create([
                                    'id_university' => $university->id,
                                    'url' => $pages
                                ]);
                            }
                        }
                        $total = TotalUni::create([
                            'country' => $row['country'],
                            'alpha_two_code' => $row['alpha_two_code'],
                            'name' => $row['name'],
                            'state_province' => $row['state-province'],
                            'domains' => implode(",",$row["domains"]),
                            'web_pages' => implode(",",$row["web_pages"])
                        ]);

                        //If Domains isnt empty
                        if ($row['domains']){
                            if(count($row['domains'])>1){
                                $total->multi = 1;
                                $total->save();
                            }
                            foreach($row['domains'] as $domain){
                                Domains::create([
                                    'id_university' => $university->id,
                                    'domain_name' => $domain
                                ]);
                            }
                        }

                    }
                    
                }
            }
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //On revert delete all data to restore back to empty states.
        Universities::truncate();
        Domains::truncate();
        Pages::truncate();
        Schema::dropIfExists('total_uni');
    }
};
