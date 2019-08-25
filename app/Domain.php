<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    const STATUS_FIELD = 'status';

    const VALID_STATUS = 1;
    const INVALID_STATUS = 0;

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
