<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mark;
use App\Models\Anime;
use App\Services\MarkService;

class MarkController extends Controller
{
    public function create(Request $request, MarkService $markService) {
        $this->authorize('create', [Mark::class, $request->anime_id]);
        $resultMark = $markService->create($request);

        return [
            'resultMark'=> $resultMark
        ];
    }
}
