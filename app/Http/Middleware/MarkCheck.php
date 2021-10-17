<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mark;

class MarkCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'mark'=> ['required', 'numeric', 'min:1', 'max:5'],
            'anime_id'=> ['required', 'exists:anime,id']
        ]);

        $validator->validate();

        $selectMarks = Mark:: where([
            ['anime_id', '=', $request->anime_id],
            ['user_id', '=', auth()->user()->id]
        ])->first();

        if($selectMarks) {
            return redirect('index');
        }
        return $next($request);
    }
}
