<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMovieToListRequest;
use App\Http\Requests\CreateMovieListRequest;
use App\Http\Requests\MarkMovieAsWatchedRequest;
use App\Models\Movie;
use App\Models\MovieList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieListController extends Controller
{

    public function getListsPage(Request $request)
    {
        return view("home", [
            "lists" => $request->user()->movieLists
        ]);
    }
    
    public function getListPage(Request $request, $slug)
    {
        $list = $request->user()->movieLists()->whereSlug($slug)->firstOrFail();

        return view("list", [
            "list" => $list
        ]);
    }

    public function createMovieList(CreateMovieListRequest $request)
    {
        $list = new MovieList;
        $list->name = $request->name;
        $list->slug = MovieList::createUniqueSlug($request->name);
        $list->user_id = $request->user()->id;
        $list->save();

        return redirect()->back()->with("message", "List successfully created.");
    }

    public function addMovieToList(AddMovieToListRequest $request, MovieList $movieList)
    {
        $movie = Movie::firstOrNew(["movie_db_id" => $request->movie_db_id]);
        $movie->save();

        $movieList->movies()->attach($movie);

        return $movieList;
    }

    public function markMovieAsWatched(MarkMovieAsWatchedRequest $request, MovieList $movieList, Movie $movie)
    {
        $movieList->movies()->updateExistingPivot($movie->id, ["watched_at" => Carbon::now()]);

        return $movieList;
    }
}
