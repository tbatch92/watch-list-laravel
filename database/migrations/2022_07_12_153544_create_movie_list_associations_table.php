<?php

use App\Models\Movie;
use App\Models\MovieList;
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
        Schema::create('movie_list_associations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MovieList::class);
            $table->foreignIdFor(Movie::class);
            $table->date("watched_at")->nullable();
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
        Schema::dropIfExists('movie_list_associations');
    }
};
