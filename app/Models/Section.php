<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function parentBranches()
    {
        return $this->hasMany(Branch::class)->whereNull('parent_id');
    }

}
