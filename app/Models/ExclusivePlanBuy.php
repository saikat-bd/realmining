<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExclusivePlanBuy extends Model
{
    use HasFactory;
    protected $table = 'exclusive_plan_buys';
    protected $primarykey = 'id';
}
