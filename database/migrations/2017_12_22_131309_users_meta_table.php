<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_meta', function (Blueprint $table) { 
            $table -> increments( 'umeta_id' );
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references( 'id' )->on('users')->onDelete('cascade');
            $table->string('meta_key')->default( 'null' );
            $table->text('meta_value')->nullable();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
