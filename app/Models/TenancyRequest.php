<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenancyRequest extends Model
{
    use HasFactory;
    public $table = 'tenancy_request';
    protected $primaryKey = 'request_id';
    protected $guarded = [];
}
