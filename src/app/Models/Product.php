<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id','name','price','stock'];

    // إضافة price_with_tax تلقائياً عند جلب المنتج
    protected $appends = ['price_with_tax'];

    // العلاقة مع التصنيف
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // العلاقة مع الوسوم (Many to Many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('notes');
    }

    // Accessor لحساب السعر مع الضريبة
    public function getPriceWithTaxAttribute()
    {
        return $this->price * 1.15;
    }

    // Local Scope لجلب المنتجات المتوفرة فقط
    public function scopeInStock($q)
    {
        return $q->where('stock','>',0);
    }
}


 
