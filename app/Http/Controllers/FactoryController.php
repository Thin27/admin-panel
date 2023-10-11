<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\FactoryRequest;

use App\Events;
use App\Models\Factory;

class FactoryController extends Controller
{
    public function index() {
        $factories = Factory::orderBy('created_at', 'DESC')->paginate(10);

        return view('pages.factories', [
            'factories' => $factories,
        ]);
    }

    public function store(FactoryRequest $request) {
        $factoryName = $request->get('factory_name');
        $location = $request->get('location');
        $email = $request->get('email');
        $website = $request->get('website');

        $factory = Factory::create([
            'factory_name' => $factoryName,
            'location' => $location,
            'email' => $email,
            'website' => $website
        ]);

        event(new Events\CreatingFactory($factory));
        return Redirect::route('factory.index')->with('status', 'New factory saved!');
    }

    public function update(FactoryRequest $request, $id) {
        $factoryName = $request->get('factory_name');
        $location = $request->get('location');
        $email = $request->get('email');
        $website = $request->get('website');

        $factory = Factory::where('id', $id)->first();
        $oldFactory = clone $factory;
        $factory->update([
            'factory_name' => $factoryName,
            'location' => $location,
            'email' => $email,
            'website' => $website
        ]);

        event(new Events\UpdatingFactory($factory, $oldFactory));
        return Redirect::route('factory.index')->with('status', $factoryName . ' factory updated!');
    }

    public function destroy($id) {
        $factory = Factory::where('id', $id)->first();

        if (!$factory) {
            return Redirect::route('factory.index')->with('error', "Selected factory doesn't exist.");
        }
        
        $factoryName = $factory->factory_name;
        $factory->delete();

        event(new Events\DeletingFactory($factory));
        return Redirect::route('factory.index')->with('status', $factoryName . ' factory deleted!');
    }
}
