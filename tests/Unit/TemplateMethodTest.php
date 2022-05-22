<?php

namespace Tests\Unit;

use Tests\TestCase;

/**
 * 테스트 전처리 및 후처리
 *
 * 테스트 클래스별로 호출되는 메서드
 *   - setUpBeforeClass
 *   - tearDownAfterClass
 * 테스트 메서드 실행 동작 순서
 *   - setUp 메서드 -> 테스트 메서드 -> tearDown 메서드
 */
class TemplateMethodTest extends TestCase
{
    public static function setUpBeforeClass():void
    {
        parent::setUpBeforeClass();
        echo __METHOD__, PHP_EOL;
    }

    // 전처리: 테스트 메서드 실행 전 호출
    protected function setUp(): void
    {
        echo __METHOD__, PHP_EOL;
    }

    /**
     * @test
     */
    public function method1_test()
    {
        echo __METHOD__, PHP_EOL;
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function method2_test()
    {
        echo __METHOD__, PHP_EOL;
        $this->assertTrue(true);
    }

    // 후처리: 테스트 메서드 실행 후 호출
    protected function tearDown(): void
    {
        parent::tearDown();
        echo __METHOD__, PHP_EOL;
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        echo __METHOD__, PHP_EOL;
    }
}
