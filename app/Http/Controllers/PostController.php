<?php

namespace App\Http\Controllers;

use App\Enums\PostCurrencySalaryEnum;
use App\Models\Post;


class PostController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        $this->model = Post::query();

    }
    public function index()
    {
        $data = $this->model
            ->Paginate();
        foreach ($data as $each)
        {
            $each->current_salary = $each->currency_salary_code;
            $each->status = $each->status_name;
        }
        return $this->successResponse($data->getCollection());
    }
}
