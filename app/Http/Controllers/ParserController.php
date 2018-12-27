<?php

namespace App\Http\Controllers;

use App\Films;
use Illuminate\Http\Request;
use HtmlDom;

class ParserController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        $title = 'Данные';
        $search = $request->input('s');
        if (isset($search))
            $films = Films::search($search)->orderBy('release_date', 'desc')->paginate(10);
        else
            $films = Films::orderBy('release_date', 'desc')->paginate(10);
        return view('index', compact('films', 'title', 'search'));
    }
}
