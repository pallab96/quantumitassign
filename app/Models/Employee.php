<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'phone_no',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
