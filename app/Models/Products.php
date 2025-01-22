<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'qty',
        'text',
        'user_id',
        'description'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }

    public function getProduct()
    {
        ucfirst($this->name);
        strtolower($this->description);
    }

    public function setProduct($name)
    {
        $this->Attribute['name'] = strtoupper($name);
    }

    public function webUsers()
    {
        return $this->belongsTo(Webuser::class);
    }

    public function isOwner($user)
    {
        return $this->user_id === $user->id;
    }

    public function deleteproduct()
    {
        return $this->hasOne(DeletedProduct::class);
    }
}
