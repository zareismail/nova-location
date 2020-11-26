<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;  

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('locations', function (Blueprint $table) {
            $table->id();  
            $table->json('name');   
            $table->string('iso')->nullable(); 
            $table->string('resource')->default("Zareismail\\\\Location\\\\Nova\\\\Settlement"); 
            $table->foreignId('location_id')->nullable()->constrained();  
            $table->coordinates();  
            $table->detail();  
            $table->softDeletes();  
        });    
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
