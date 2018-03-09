<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table -> integer( 'user_id' );
            $table -> integer( 'timeline_id' );
            $table -> text( 'comment');
            $table -> char( 'likes', 100 ) -> nullable();
           

          /*  $table -> float( 'avg_speed', 4, 2 );
            $table -> float( 'max_speed', 4, 2 );
            $table -> date( 'start_time');
            $table -> date( 'end_time');
            $table -> text( 'track');*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
