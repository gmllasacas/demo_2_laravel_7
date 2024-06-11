<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Embassador extends Model
{
    public function department()
    {
        return $this->hasMany(Department::class, 'embassador_id');
    }
}
