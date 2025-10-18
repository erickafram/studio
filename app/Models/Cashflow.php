<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;

    protected $table = 'cashflow';

    protected $fillable = [
        'type',
        'amount',
        'description',
        'transaction_date',
        'category',
        'appointment_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'date',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function scopeEntrada($query)
    {
        return $query->where('type', 'entrada');
    }

    public function scopeSaida($query)
    {
        return $query->where('type', 'saida');
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('transaction_date', $date);
    }

    public function scopeByMonth($query, $year, $month)
    {
        return $query->whereYear('transaction_date', $year)
                     ->whereMonth('transaction_date', $month);
    }

    public function scopeEntradaByMonth($query, $year, $month)
    {
        return $query->entrada()->byMonth($year, $month);
    }

    public function scopeSaidaByMonth($query, $year, $month)
    {
        return $query->saida()->byMonth($year, $month);
    }
}



