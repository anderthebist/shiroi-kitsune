<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TeamProcessrRquest;
use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamUpdateRequest;
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
        /*
        $count = 20;
        $voice = null;
        if(empty($id)) {
            $voicers = Voice:: orderBy('name')->get();
            $voice = $voicers[0];
        } else {
            $voice = Voice:: where('id', $id)->first();
            $voicers = $voicers = $voiceService->both($voice, $count);
        }
        $new_serias = $voice->animes()->orderBy('created_at', 'desc')->paginate(6);*/
        $voicers = Voice:: orderBy('name')->get();
        $voice = empty($id) ? $voicers[0] : Voice:: where('id', $id)->first();
        $new_serias = $voice->animes()->orderBy('created_at', 'desc')->paginate(6);

        return view("comand", [
            "voicers" => $voicers,
            "name" => $voice->name,
            "new_serias" => $new_serias
        ]);
    }

    public function team_process(TeamProcessrRquest $request) {
        $voice = Voice:: where('id', $request->id)->first();
        $pagin = $voice->animes()->orderBy('created_at', 'desc')->paginate(6);
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

    public function admin() {
        $voicers = Voice:: orderBy('created_at','desc')->paginate(8);

        return view("admin.team.index", [
            "voicers" => $voicers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.team.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamCreateRequest $request, VoiceService $voiceService)
    {
        $this->authorize('admin', User::class);
        $voice = $voiceService->create($request);

        return redirect()->route('team.index', ['id'=> $voice->id]);
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
        $voice = Voice:: where('id', $id)->first();

        return view("admin.team.edit", [
            "voice" => $voice
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamUpdateRequest $request, $id, VoiceService $voiceService)
    {
        $this->authorize('admin', User::class);
        $voice = $voiceService->update($request, $id);
        return redirect()->route('team.index', ['id'=> $voice->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, VoiceService $voiceService)
    {
        $this->authorize('admin', User::class);
        $voiceService->delete($id);
        return redirect()->back();
    }
}
