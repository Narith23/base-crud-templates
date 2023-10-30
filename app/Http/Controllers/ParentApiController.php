<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ParentApiController extends Controller
{
    use ApiResponse;

    protected $service;
    protected $model;
    protected $route;
    protected $nameStrings;

    public function dataTable(Request $request, $query = null): JsonResponse
    {
        $attributes = $request->all();
        return $this->success($this->service->getData($attributes, $query));
    }

    public function all(): JsonResponse
    {
        return $this->success($this->service->getList());
    }

    public function allRequest(Request $request, $query = null): JsonResponse
    {
        return $this->success($this->service->getList());
    }
}
