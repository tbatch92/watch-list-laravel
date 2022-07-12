<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieListRequest;
use App\Models\MovieList;
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
}
