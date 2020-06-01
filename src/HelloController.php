<?php

namespace Asorasoft\Location;

use App\Http\Controllers\Controller;

class HelloController extends Controller
{
    public function getAsoradev()
    {
        return response()->json([
            'website' => 'https://asorasoft.com',
        ]);
    }
}
