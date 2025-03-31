<?php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'email', 'items', 'file_path'];
    protected $casts = ['items' => 'array'];
}
