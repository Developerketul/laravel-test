<?php

namespace App\Http\Controllers;

class LocaleController extends Controller
{
    public function switch(
        string $locale
    ) {

        abort_unless(
            in_array($locale, [
                'en',
                'ar'
            ]),
            404
        );

        session([
            'locale' => $locale
        ]);

        return back();
    }
}