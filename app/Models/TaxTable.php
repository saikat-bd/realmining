<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxTable extends Model
{
    use HasFactory;
    protected $table = 'tax_tables';
    protected $primaryKey = 'id';
}
