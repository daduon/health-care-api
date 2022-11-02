<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'image',
        'email',
        'address',
        'position',
        'institution',
        'map',
        'first_name',
        'last_name',
        'date_of_birth',
        'graduation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
