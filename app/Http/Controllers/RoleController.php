<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
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
            Role::create([
                'name' => $request->name
            ]);
            return redirect()->route('homepage');
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
}
