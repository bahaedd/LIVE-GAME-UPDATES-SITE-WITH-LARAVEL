@extends('layouts.app')

    @section('content')
        <div class="container">
            <h2>Ongoing games</h2>
            @auth
                <form method="post" action="{{ url('/games') }}" class="form-inline">
                  @csrf
                  <input class="form-control" name="first_team" placeholder="First team" required>
                  <input class="form-control" name="second_team" placeholder="Second team" required>
                  <input type="hidden" name="first_team_score" value="0">
                  <input type="hidden" name="second_team_score" value="0">
                  <button type="submit" class="btn btn-primary">Start new game</button>
                </form>
            @endauth
            @forelse($games as $game)
                <a class="card bg-dark" href="/games/{{ $game->id }}">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>{{ $game->score }}</h4>
                        </div>
                    </div>
                </a>
            @empty
                No games in progress.
            @endforelse
        </div>
    @endsection
