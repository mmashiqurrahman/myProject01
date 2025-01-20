<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Events\RoleCreated;
use Exception;

class RoleController extends Controller
{

    public function index() {
        $roles = Role::all();
        return view('roles', ['roles' => $roles]);
    }
    
    public function create() {
        return view('addrole');
    }

    public function store(Request $request) {
        try {
            $role = Role::create([
                'name' => $request->name
            ]);
            RoleCreated::dispatch($role);
            return redirect()->route('homepage');
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
