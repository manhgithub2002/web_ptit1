<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;


class ManagementAdminController extends Controller
{
    private object $model;
    private string $table;
    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index(Request $request){
        $query = $this->model
            ->where('role', 'ADMIN')
            ->with('company:id,name')
            ->latest();
        $data = $query->paginate(5);

        return view('admin.managements.index',[
            'data' => $data,
        ]);
    }
    public function create(){
        return view('admin.managements.create');
    }
    public function store(Request $request){
        $user = User::query()
            ->create([
                'name'     => $request->get('name'),
                'email'    => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'gender' => $request->get('gender'),
                'role'    =>'0',
            ]);
        $role = strtolower(UserRoleEnum::getKeys( (int)$request->get('role') )[0] );
        return redirect()->route("$role.index");
    }
}
