<?php

namespace App\Http\Controllers;

use App\Models\Language;


class LanguageController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        $this->model = Language::query();

    }
    public function index()
    {
        $data = $this->model
            ->get();
        return $this->successResponse($data);
    }
}
