<?php

namespace Dev\Larabit\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function check_registration_token(): void
    {
        $this->assertNotEmpty(config('larabit.registration_token'));
    }

    /**
     * @test
     */
    public function user_create(): void
    {
        $payload = [
            'name' => $this->faker()->firstName,
            'email'      => $this->faker()->email,
            'password'   => $this->faker()->password(10),
            'registration_token' => config('larabit.registration_token')
        ];

        $this->post('/api/' . config('larabit.api.prefix') . config('larabit.routes.auth.register'), $payload)
            ->assertStatus(ResponseAlias::HTTP_OK);

        unset($payload['password']);
        unset($payload['registration_token']);

        $this->assertDatabaseHas('users', $payload);
    }

    /**
     * @test
     */
    public function user_create_without_token(): void
    {
        $payload = [
            'name' => $this->faker()->firstName,
            'email'      => $this->faker()->email,
            'password'   => $this->faker()->password(10)
        ];

        $this->post('/api/' . config('larabit.api.prefix') . config('larabit.routes.auth.register'), $payload)
            ->assertStatus(ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }


    /**
     * @test
     * @return void
     */
    public function user_register_auth_and_unregister(): void
    {
        $payload = [
            'name' => $this->faker()->firstName,
            'email'      => $this->faker()->email,
            'password'   => $this->faker()->password(10),
            'domain' => $this->faker()->domainName,
            'registration_token' => config('larabit.registration_token')
        ];

        $content = $this->post('/api/' . config('larabit.api.prefix') . config('larabit.routes.auth.register'), $payload)
            ->assertStatus(ResponseAlias::HTTP_OK)
            ->getContent();

        $content = json_decode($content, true);
        $this->assertNotEmpty($content['data']['token']);
        $this->assertIsInt($content['data']['user_id']);

        $code = $this->post('/api/' . config('larabit.api.prefix') . config('larabit.routes.auth.unregister'), $payload, [
            'AUTHORIZATION' => 'Bearer ' . $content['data']['token']
        ])
            //->assertStatus(ResponseAlias::HTTP_OK)
            ->getContent();
    }
}
