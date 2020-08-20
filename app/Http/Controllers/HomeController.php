<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $games = \App\Game::all();
        return view('home', ['games' => $games]);
    }

    public function viewGame(int $id)
    {
        $game = \App\Game::find($id);
        $updates = $game->updates;
        return view('game', ['game' => $game, 'updates' => $updates]);
    }

    public function startGame()
    {
        $game = \App\Game::create(request()->all());
        return redirect("/games/$game->id");
    }

    public function updateGame(int $id, \Pusher\Laravel\PusherManager $pusher)
    {
        $data = request()->all();
        $data['game_id'] = $id;
        $update = \App\Updates::create($data);
        $pusher->trigger("game-updates-$id", 'event', $update, request()->header('x-socket-id'));
        return response()->json($update);
    }

    public function updateScore(int $id, \Pusher\Laravel\PusherManager $pusher)
    {
        $data = request()->all();
        $game = \App\Game::find($id);
        $game->update($data);
        $pusher->trigger("game-updates-$id", 'score', $game, request()->header('x-socket-id'));
        return response()->json();
    }
}
