<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PostCurrencySalaryEnum;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    private object $model;
    private string $table;
    public function __construct()
    {
        $this->model = Post::query();
        $this->table = (new Post())->getTable();

        View::share('title', ucwords($this->table));
        View::share('table', $this->table);
    }

    public function index()
    {
        $data = $this->model->get();
        return view("admin.$this->table.index",[
            'data' => $data,
        ]);
    }

    public function create()
    {
        $currencies = PostCurrencySalaryEnum::asArray();
        return view("admin.$this->table.create",[
            'currencies' =>$currencies,
        ]);
    }

    public function store()
    {
        $this->model->get();
        $this->model->save();
    }
}
