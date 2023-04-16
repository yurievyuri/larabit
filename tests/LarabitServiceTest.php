<?php

namespace Yuraplohov\LaravelExample\Test;

use PHPUnit\Framework\TestCase;
use Larabit\LarabitService;

class ExampleServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_some_result()
    {
        $sut = new LarabitService();
        $this->assertEquals('bar', $sut->getSomeResult());
    }
}
