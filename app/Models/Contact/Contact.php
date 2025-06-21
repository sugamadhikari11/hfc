<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'is_read' => 'boolean',
    ];
    
    public function getFullNameAttribute()
    {
        return $this->name; // For backward compatibility
    }
    
    public function markAsRead()
    {
        $this->is_read = true;
        $this->read_at = now();
        return $this->save();
    }
    
    public function markAsUnread()
    {
        $this->is_read = false;
        $this->read_at = null;
        return $this->save();
    }
}