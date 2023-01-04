<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{

    public function __invoke($locale, Request $request)
    {
        if (!in_array($locale, ['en', 'ar'])) {
            abort(400);
        }
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
