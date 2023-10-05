<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\FactoryRequest;

use App\Models\Factory;

class FactoryController extends Controller
{
    public function index(Request $request) {
        $factories = DB::table('factories')->paginate(10);

        return view('pages.factories', [
            'factories' => $factories,
        ]);
    }

    public function store(FactoryRequest $request) {

    }
}
