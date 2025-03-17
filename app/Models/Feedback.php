<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $primaryKey = 'feedback_id';

    protected $fillable = [
        'user_id',
        'feedback_comment',
        'rating',
        'date_submitted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}