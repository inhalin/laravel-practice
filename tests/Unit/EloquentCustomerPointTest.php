<?php

namespace Tests\Unit;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EloquentCustomerPointTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function addPoint()
    {
        // 테스트에 필요한 레코드 등록
        $customerId = 1;
        EloquentCustomer::factory()->create([
            'id' => $customerId
        ]);
        EloquentCustomerPoint::unguard();
        EloquentCustomerPoint::create([
            'customer_id' => $customerId,
            'point' => 100,
        ]);
        EloquentCustomerPoint::reguard();

        // 테스트 대상 메서드 실행
        $eloquent = new EloquentCustomerPoint();
        $result = $eloquent->addPoint($customerId, 10);

        // 테스트 결과 확인
        $this->assertTrue($result);
        $this->assertDatabaseHas('customer_points', [
            'customer_id' => $customerId,
            'point' => 110,
        ]);
    }
}
