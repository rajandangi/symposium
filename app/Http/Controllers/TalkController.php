<?php

namespace App\Http\Controllers;

use App\Enums\TalkType;
use App\Http\Requests\StoreTalkRequest;
use App\Http\Requests\UpdateTalkRequest;
use App\Models\Talk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TalkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $talks = Auth::user()->talks()->with('author')->get();

        return view('talks.index', [
            'talks' => $talks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('talks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTalkRequest $request)
    {
        // $validated = $request->validate([
        //     'title' => 'required|max:255',
        //     'length' => '',
        //     'type' => ['required', Rule::enum(TalkType::class)],
        //     'abstract' => '',
        //     'organizer_notes' => '',
        // ]);

        // Create a new talk
        Auth::user()->talks()->create($request->validated());

        // Redirect to the talk
        return redirect()->route('talks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Talk $talk)
    {
        return view('talks.show', [
            'talk' => $talk,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talk $talk)
    {
        return view('talks.edit', [
            'talk' => $talk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTalkRequest $request, Talk $talk)
    {
        $talk->update($request->validated());

        return redirect()->route('talks.show', $talk);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talk $talk)
    {
        $talk->delete();

        return redirect()->route('talks.index');
    }
}
