<?php

namespace Dev\Larabit\Tests\Feature;

use Dev\Larabit\Models\Connection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class ConnectionsControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function user_and_connection_register(): void
    {
        $payload = [
            'name' => $this->faker()->firstName,
            'email'      => $this->faker()->email,
            'password'   => $this->faker()->password(10),
            'domain' => $this->faker()->domainName,
            'registration_token' => config('larabit.registration_token')
        ];

        $content = $this->post('/api/' . config('larabit.api.prefix') . config('larabit.routes.auth.register'), $payload)
            ->assertStatus(config('larabit.http.code.ok'))
            ->getContent();


        $content = json_decode($content, true);
        $this->assertNotEmpty($content['data']['token']);
        $this->assertIsInt($content['data']['user_id']);

        $connPayload = Connection::factory()->definition();
        $this->assertNotEmpty($connPayload);
        $connPayload['user_id'] = $content['data']['user_id'];
        $auth =  ['AUTHORIZATION' => 'Bearer ' . $content['data']['token']];

        $this
            ->post('/api/'. config('larabit.api.prefix') . config('larabit.routes.controller.connection') . '/register', $connPayload, $auth)
            ->assertStatus(config('larabit.http.code.ok'));

        $this->post('/api/' . config('larabit.api.prefix') . config('larabit.routes.auth.unregister'), $payload,$auth)
            ->assertStatus(config('larabit.http.code.ok'));

    }
}
