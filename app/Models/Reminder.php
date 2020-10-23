<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    public $table = 'reminder';
    protected $primaryKey = 'reminder_id';
    protected $guarded = [];
}
