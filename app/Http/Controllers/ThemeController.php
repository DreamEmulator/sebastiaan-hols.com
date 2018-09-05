<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Change theme
     *
     * @param  string $request
     *
     */
    public function changeTheme(Request $request)
    {
        $dream_theme = $request->input('dream_theme');

        $contrast = $dream_theme == 'dark' ? 'light' : 'dark';

        session(['dream_theme' => $dream_theme]);
        session(['contrast' => $contrast]);

        $redirect = request()->headers->get('referer');
        return redirect("$redirect");
    }
}