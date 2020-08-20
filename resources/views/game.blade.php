@extends('layouts.app')

    @section('content')
        <div id="main" class="container" xmlns:v-on="http://www.w3.org/1999/xhtml">
            <h2>@{{ game.first_team }}
                <span @auth contenteditable @endauth v-on:blur="updateFirstTeamScore">@{{ game.first_team_score }}</span>
                -
                <span @auth contenteditable @endauth v-on:blur="updateSecondTeamScore">@{{ game.second_team_score }}</span>
                @{{ game.second_team }}</h2>
            @auth
                <div class="card">
                    <div class="card-body">
                        <form v-on:submit="updateGame">
                            <h6>Post a new game update</h6>
                            <input class="form-control" type="number" id="minute" v-model="pendingUpdate.minute"
                                   placeholder="In what minute did this happen?">

                            <input class="form-control" id="type" placeholder="Event type (goal, foul, injury, booking...)"
                                   v-model="pendingUpdate.type">

                            <input class="form-control" id="description" placeholder="Add a description or comment..."
                                   v-model="pendingUpdate.description">

                            <button type="submit" class="btn btn-primary">Post update</button>
                        </form>
                    </div>
                </div>
            @endauth
            <br>
            <h4>Game updates</h4>
            <div class="card-body" v-for="update in updates">
                <div class="card-title">
                    <h5>@{{ update.type }} (@{{ update.minute }}')</h5>
                </div>
                <div class="card-text">
                    @{{ update.description }}
                </div>
            </div>
        </div>
        <script>
            window.updates = @json($updates);
            window.game = @json($game);
        </script>
    @endsection
