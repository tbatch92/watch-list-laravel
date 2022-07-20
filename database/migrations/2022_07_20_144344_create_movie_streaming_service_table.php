<?php

use App\Models\Movie;
use App\Models\StreamingService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_streaming_service', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Movie::class);
            $table->foreignIdFor(StreamingService::class);
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
        Schema::dropIfExists('movie_streaming_service');
    }
};
