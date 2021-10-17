<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TeamProcessrRquest;
use App\Models\Anime;
use App\Models\Voice;
use App\Services\VoiceService;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null, VoiceService $voiceService)
    {
        $count = 6;
        $voice = null;
        if(empty($id)) {
            $voicers = Voice:: orderBy('name')->take($count)->get();
            $voice = $voicers[0];
        } else {
            $voice = Voice:: where('id', $id)->first();
            $voicers = $voicers = $voiceService->both($voice, $count);;
        }
        $new_serias = $voice->animes()->paginate(6);

        return view("comand", [
            "voicers" => $voicers,
            "name" => $voice->name,
            "new_serias" => $new_serias
        ]);
    }

    public function team_process(TeamProcessrRquest $request) {
        $voice = Voice:: where('id', $request->id)->first();
        $pagin = $voice->animes()->paginate(6);
        $relizes = $pagin->items();
        $pagination = $pagin->links()->paginator;

        return response()->json(["resultCode"=> 0,'relizes' => $relizes,'pagination'=> $pagination]);
    }

    public function next(TeamProcessrRquest $request, VoiceService $voiceService) {
        $voice = Voice:: where('id', $request->id)->first();
        $voicers = $voiceService->next($voice, 3);

        return response()->json(["resultCode"=> 0,'voicers' => $voicers]);
    }

    public function prev(TeamProcessrRquest $request, VoiceService $voiceService) {
        $voice = Voice:: where('id', $request->id)->first();
        $voicers = $voiceService->prev($voice, 3);

        return response()->json(["resultCode"=> 0,'voicers' => $voicers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
