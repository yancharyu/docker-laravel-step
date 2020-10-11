<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * カテゴリー一覧を取得して返す
 */

class ApiGetCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Http\Response カテゴリー一覧の配列
     */
    public function __invoke(): JsonResponse
    {
        $categories = Category::getAllCategories();
        return response()->json($categories);
    }
}
