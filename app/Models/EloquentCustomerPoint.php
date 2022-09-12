<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $customer_id
 * @property int $point
 * @mixin Builder
 */
class EloquentCustomerPoint extends Model
{
    use HasFactory;

    protected $table = 'customer_points';
    public $timestamps = false;

    public function addPoint(int $customerId, int $point): bool
    {
        return $this->newQuery()
            ->where('customer_id', $customerId)
            ->increment('point', $point) === 1;
    }

    public function findPoint(int $customer_id): int
    {
        return $this->newQuery()
            ->where('customer_id', $customer_id)
            ->value('point');
    }
}
