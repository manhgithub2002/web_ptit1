<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;


class UserController extends Controller
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
    public function index(Request $request)
    {
        $selectedRole    = $request->get('role');

        $query = $this->model
            ->with('company:id,name')
            ->latest();
        if(!is_null($selectedRole)){
            $query->where('role', $selectedRole);
        }
        $data = $query->paginate()
            ->appends($request->all());


        $roles = UserRoleEnum::asArray();

        return view("admin.$this->table.index",[
            'data' => $data,
            'roles' => $roles,
            'selectedRole' =>$selectedRole,
        ]);
    }

    public function edit($userId){
        $user = User::find($userId);
        return view("admin.managements.edit",[
            'user' => $user,
        ]);
    }
    public function update(Request $request,$userId)
    {
        $this->model
            ->where('id',$userId)
            ->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone' => $request->get('phone'),
            ]
        );
        return redirect()->back();
    }
    public function destroy($userId){
        User::destroy($userId);

        return redirect()->back();
    }
}
