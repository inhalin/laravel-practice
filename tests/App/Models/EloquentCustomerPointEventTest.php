<?php

namespace Tests\App\Models;

use App\Models\EloquentCustomer;
use App\Models\EloquentCustomerPointEvent;
use App\Models\PointEvent;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentCustomerPointEventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function register()
    {
        // 테스트에 필요한 레코드 등록
        $customerId = 1;
        EloquentCustomer::factory()->create([
            'id' => $customerId,
        ]);

        // 테스트 대상 메서드 실행
        $event = new PointEvent(
            $customerId,
            '추가 이벤트',
            100,
            CarbonImmutable::create(Carbon::now()),
        );
        $sut = new EloquentCustomerPointEvent();
        $sut->register($event);

        // 테스트 결과 확인
        $this->assertDatabaseHas(
            'customer_point_events',
            [
                'customer_id' => $customerId,
                'event' => $event->getEvent(),
                'point' => $event->getPoint(),
                'created_at' => $event->getCreatedAt(),
            ]
        );
    }
}
