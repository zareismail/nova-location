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
            $table->string('iso')->nullable();
            $table->naming();   
            $table->string('resource')
                  ->default("Zareismail\\\\Location\\\\Nova\\\\Country"); 
            $table->foreignId('location_id')->constrained(); 
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
