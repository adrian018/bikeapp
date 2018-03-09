<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model {
    protected $table = 'users_meta';
    protected $fillable = [ 'user_id', 'meta_key', 'meta_value' ];
}
