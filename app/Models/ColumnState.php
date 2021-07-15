<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColumnState extends Model
{
    use HasFactory;

    protected $fillable = [
        'column_state',
        'column_id',
    ];

    public function column() {
        return $this->belongsTo(Column::class);
    }
}
