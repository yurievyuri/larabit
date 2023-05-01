<?php

namespace Dev\Larabit\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Dev\Larabit\Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
