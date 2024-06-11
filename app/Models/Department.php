<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'superior_id', 'parent_id', 'embassador_id'];

    public function superiorDepartment()
    {
        return $this->belongsTo(Department::class, 'superior_id');
    }

    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function subDepartments()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    public function embassador()
    {
        return $this->belongsTo(Embassador::class);
    }

    public function level()
    {
        return \mt_rand(1, 10);
    }

    public function employees()
    {
        return \mt_rand(1, 100);
    }
}
