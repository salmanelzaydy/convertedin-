<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'assigned_to_id', 'assigned_by_id'];

    // Relationship with the user assigned to the task
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    // Relationship with the admin who assigned the task
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }
}
