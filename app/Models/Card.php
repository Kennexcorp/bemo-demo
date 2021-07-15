<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'column_id',
        'description'
    ];

    public function column() {
        return $this->belongsTo(Column::class);
    }
}
