<?php

namespace Tests\Unit;

use Tests\TestCase;
use Zerotoprod\Callspy\Callspy;

class CallspyTest extends TestCase
{
    /** @test */
    public function record(): void
    {
        Callspy::record('arbitrary', ['arg1', 'arg2']);

        $this->assertEquals(
            ['arg1', 'arg2'],
            Callspy::get('arbitrary')
        );
    }

    private function productionFunction($arg1, $arg2): void
    {
        Callspy::record(__METHOD__, func_get_args());
    }

    /** @test */
    public function recordMethod(): void
    {
        $this->productionFunction('arg1', 'arg2');

        $this->assertEquals(
            ['arg1', 'arg2'],
            Callspy::get([self::class, 'productionFunction'])
        );
    }
}