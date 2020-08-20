<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

        protected $appends = ['updates', 'score'];

        public function getUpdatesAttribute()
        {
            return Updates::orderBy('id desc')->where('game_id', '=', $this->id)->get();
        }

        // return the game score in the format "TeamA 1 - 0 TeamB"
        public function getScoreAttribute()
        {
            return "$this->first_team $this->first_team_score - $this->second_team_score $this->second_team";
        }
}
