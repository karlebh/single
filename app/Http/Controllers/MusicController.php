<?php

namespace App\Http\Controllers;

use App\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musics = Cache::remember('musics', now()->addMinutes(3), function(){
            return Music::orderBy('created_at')->paginate(20); 
        });

        return $musics;
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
        $data =$request->validate([
            'artist' => 'required|string|min:3|max:50',
            'country' => 'string|nullable|min:3|max:50',
            'genre' => 'string|nullable|min:3|max:50',
            'latest_album' => 'string|nullable|min:3|max:50',
            'latest_hit' => 'required|string|min:3|max:50',
        ]);

        $slug = ['slug' => Str::slug($data['artist'])];

        $all = array_filter(array_merge($data, $slug));

        Music::firstOrCreate($all);

        return 'Entry added successfully!';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        return $music;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        
        return $music;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    {
         $data = $request->validate([
            'artist' => 'string|max:50|min:3',
            'country' => 'string|nullable|max:50|min:3',
            'genre' => 'string|nullable|max:50|min:3',
            'latest_album' => 'string|nullable|max:50|min:3',
            'latest_hit' => 'string|max:50|min:3',
        ]);

        $music->update(array_filter($data));

        return "Music Updated Successfully!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        try{
            $music->delete();

            return 'Item deleted Successfully!';
        } catch(\Exception $e) {
            return 'Item already deleted';
        }
    }
}
