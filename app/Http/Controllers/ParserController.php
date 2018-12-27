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
    public function index() {
        $title = 'Данные';
        $films = Films::orderBy('release_date', 'desc')->paginate(10);
        return view('index', compact('films', 'title'));
    }
}
