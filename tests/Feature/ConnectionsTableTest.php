<?php

namespace Dev\Larabit\Tests\Feature;

use Dev\Larabit\Models\Connection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConnectionsTableTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     */
    public function connection_table_create_item(): void
    {
        Connection::factory(3)->create();
        $this->assertDatabaseCount(Connection::class, 3);
        $this->assertTrue(true);
    }
}
