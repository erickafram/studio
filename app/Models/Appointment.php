<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'client_name',
        'client_phone',
        'client_email',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function cashflow()
    {
        return $this->hasOne(Cashflow::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pendente');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmado');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'concluido');
    }

    public function getFullDateTimeAttribute()
    {
        return $this->appointment_date->format('d/m/Y') . ' às ' . substr($this->appointment_time, 0, 5);
    }
}



