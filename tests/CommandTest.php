<?php

namespace Larabit\Test;

class CommandTest extends FeatureTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('larabit.param', 200);
    }

    /**
     * @test
     */
    public function it_executes_example_command()
    {
        $output = $this->artisan('larabit-command');

        $output->assertExitCode(0);

        $output->expectsOutput("Command executed with config param value 200");
    }
}
