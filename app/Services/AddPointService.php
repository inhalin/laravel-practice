<?php

namespace App\Services;

use App\Models\EloquentCustomerPoint;
use App\Models\EloquentCustomerPointEvent;
use App\Models\PointEvent;
use Illuminate\Database\Connectors\ConnectorInterface;
use Throwable;

final class AddPointService
{
    /** @var EloquentCustomerPointEvent */
    private $eloquentCUstomerPointEvent;

    /** @var EloquentCustomerPoint */
    private $eloquentCustomerPoint;

    /** @var ConnectorInterface */
    private $db;

    public function __construct(
        EloquentCustomerPointEvent $eloquentCustomerPointEvent,
        EloquentCustomerPoint      $eloquentCustomerPoint
    )
    {
        $this->eloquentCUstomerPointEvent = $eloquentCustomerPointEvent;
        $this->eloquentCustomerPoint = $eloquentCustomerPoint;
        $this->db = $eloquentCustomerPointEvent->getConnection();
    }

    public function add(PointEvent $event)
    {
        $this->db->transaction(
            function () use ($event) {
                // 포인트 이벤트 보존
                $this->eloquentCUstomerPointEvent->register($event);
                // 보유 포인트 업데이트
                $this->eloquentCustomerPoint->addPoint(
                    $event->getCustomerId(),
                    $event->getPoint()
                );
            }
        );
    }
}
