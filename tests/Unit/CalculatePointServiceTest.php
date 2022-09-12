<?php

namespace Tests\Unit;

use App\Exceptions\PreconditionException;
use App\Services\CalculatePointService;
use PHPUnit\Framework\TestCase;

class CalculatePointServiceTest extends TestCase
{
    public function dataProvider_for_calcPoint(): array
    {
        return [
            '구매금액이 0원이면 0포인트' => [0, 0],
            '구매금액이 9,999원이면 0포인트' => [0, 9999],
            '구매금액이 10,000원이면 10포인트' => [10, 10000],
            '구매금액이 99,999원이면 99포인트' => [99, 99999],
            '구매금액이 100,000원이면 200포인트' => [200, 100000],
        ];
    }

    /**
     * @test
     */
    public function 구매금액이_0원이면_0을_반환()
    {
        $result = CalculatePointService::calcPoint(0);
        $this->assertSame(0, $result);
    }

    /**
     * @test
     * @dataProvider dataProvider_for_calcPoint
     */
    public function calcPoint(int $expected, $amount)
    {
        $result = CalculatePointService::calcPoint($amount);

        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function exception_try_catch()
    {
        try {
            throw new \InvalidArgumentException('message', 200);
            $this->fail();
        } catch (\Throwable $e) {
            // 지정한 예외 클래스가 던져졌는가
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
            //던져진 예외 코드 검증
            $this->assertSame(200, $e->getCode());
            //던져진 예회 메시지 검증
            $this->assertSame('message', $e->getMessage());
        }
    }

    /**
     * @test
     */
    public function exception_expectException_method()
    {
        // 지정한 예외 클래스가 던져졌는가
        $this->expectException(\InvalidArgumentException::class);
        //던져진 예외 코드 검증
        $this->expectExceptionCode(200);
        //던져진 예회 메시지 검증
        $this->expectExceptionMessage('message');
        throw new \InvalidArgumentException('message', 200);
    }

    /**
     * @test
     */
    public function 구매금액이_음수면_예외처리()
    {
        $this->expectException(PreconditionException::class);
        $this->expectExceptionMessage('구매 금액이 음수입니다.');
        CalculatePointService::calcPoint(-1);
    }
}
