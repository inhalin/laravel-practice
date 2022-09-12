<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TemplateMethodTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        echo __METHOD__, PHP_EOL;
    }

    protected function setUp(): void
    {
        echo __METHOD__, PHP_EOL;
    }

    /**
     * @test
     */
    public function 테스트1()
    {
        echo __METHOD__, PHP_EOL;
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function 테스트2()
    {
        echo __METHOD__, PHP_EOL;
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        echo __METHOD__, PHP_EOL;
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        echo __METHOD__, PHP_EOL;
    }
}
