<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Event extends Model
{
    //
    protected $fillable = [
    'category_id', 'organizer_id', 'title', 'description', 'date',
    'location', 'price', 'stock', 'poster_path'
    ];


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function activeTier()
    {
        return $this->ticketTiers()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function ticketTiers()
    {
        return $this->hasMany(EventTicketTier::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }

    /**
     * Menghitung rata-rata rating dari semua transaksi yang sudah memberikan rating.
     */
    public function averageRating()
    {
        return $this->transactions()
            ->whereNotNull('rating')
            ->avg('rating');
    }

    /**
     * Menghitung jumlah transaksi yang sudah memberikan rating.
     */
    public function ratingCount()
    {
        return $this->transactions()
            ->whereNotNull('rating')
            ->count();
    }
}
