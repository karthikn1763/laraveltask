<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormItem extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'item_name', 'quantity', 'price'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
