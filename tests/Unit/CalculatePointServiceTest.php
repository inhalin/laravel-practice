<?php

namespace Tests\Unit;

use App\Exceptions\PreconditionException;
use App\Services\CalculatePointService;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\InvalidArgumentException;

class CalculatePointServiceTest extends TestCase
{
    public function dataProvider_for_calcPoint(): array
    {
        return [
            '구메 금액이 0 이면 포인트는 0' => [0, 0],
            '구메 금액이 9,999 이면 포인트는 0' => [0, 9999],
            '구메 금액이 10,000 이면 포인트는 10' => [10, 10000],
            '구메 금액이 99,999 이면 포인트는 0' => [99, 99999],
            '구메 금액이 100,000 이면 포인트는 200' => [200, 100000],
        ];
    }

    /**
     * @test
     * @dataProvider dataProvider_for_calcPoint
     */
    public function calcPoint(int $expected, int $amount)
    {
        $result = CalculatePointService::calcPoint($amount);

        $this->assertSame($expected, $result);
    }

    /**
     * @test
     */
    public function calcPoint_return_0_when_amount_is_0()
    {
        $result = CalculatePointService::calcPoint(0);

        $this->assertSame(0, $result);
    }

    /**
     * @test
     */
    public function exception_try_catch()
    {
        try {
            throw new \InvalidArgumentException('message', 200);
            $this->fail();  // 예외 던져지지 않으면 테스트 실패
        } catch (\Throwable $e) {
            // 지정한 예외 클래스가 던져졌는가
            $this->assertInstanceOf(\InvalidArgumentException::class, $e);
            // 던져진 예외코드 검증
            $this->assertSame(200, $e->getCode());
            // 던져진 예외메시지 검증
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
        // 던져진 예외코드 검증
        $this->expectExceptionCode(200,);
        // 던져진 예외메시지 검증
        $this->expectExceptionMessage('message');
        throw new \InvalidArgumentException('message', 200);
    }

    /**
     * @test
     */
    public function calcPoint_throw_new_exception_when_amount_is_negative()
    {
        $this->expectException(PreconditionException::class);
        $this->expectExceptionMessage('구매 금액이 음수');
        CalculatePointService::calcPoint(-1);
    }
}
