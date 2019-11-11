<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Employee extends Eloquent
{
    protected $table = 'employee';
    public $timestamps = [];
    protected $fillable = [
        'name',
        'email',
        'password',
        'dept',
        'salary',
        'boss',
        'designation',
        'profile_pic'
    ];
}
