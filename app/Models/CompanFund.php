<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanFund extends Model
{
    use HasFactory;
    protected $table = 'compan_funds';
    protected $primaryKey = 'id';
}
