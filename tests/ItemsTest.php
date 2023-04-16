<?php

namespace Larabit\Test;

use Larabit\Models\Item;

class ItemsTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_gets_all_items()
    {
        Item::forceCreate(['name' => 'Name 1']);
        Item::forceCreate(['name' => 'Name 2']);

        $response = $this->get('items');

        $response->assertStatus(200);

        $response->assertExactJson([
            'items' => [
                ['name' => 'Name 1'],
                ['name' => 'Name 2'],
            ]
        ]);
    }
}
