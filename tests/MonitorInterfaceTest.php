<?php

use Illuminate\Support\Arr;
use Orchestra\Testbench\TestCase;
use Ontherocksoftware\LaravelRedAmberGreen\LaravelRedAmberGreen;
use Ontherocksoftware\LaravelRedAmberGreen\Exceptions\RagException;

class MonitorInterfaceTest extends TestCase
{
    public const TEST_TOKEN = 'M7KhX3bYarF816O4mJSquVaJfjW7uq21z5VlRKgW';

    /** @test */
    public function can_list_monitors()
    {
        config()->set('laravelredambergreen.token', static::TEST_TOKEN);
        $monitors = LaravelRedAmberGreen::monitors();
        $this->assertEquals(Arr::get($monitors, 'current_page', -1), 1);
    }

    /** @test */
    public function can_set_existing_monitor_red()
    {
        config()->set('laravelredambergreen.token', static::TEST_TOKEN);
        $name = 'Test';
        $url = 'https://www.google.com/search?q=red';
        $message = 'Updated from test '. now() .' case testing status should be green';
        $monitor = [];

        try {
            $monitor = LaravelRedAmberGreen::red($name, $message, $url);
        } catch (RagException $rag) {
            $error = $rag->getMessage();
        }
        $this->assertEquals(Arr::get($monitor, 'status', 'unknown'), 'red');
    }

    /** @test */
    public function can_set_existing_monitor_green()
    {
        config()->set('laravelredambergreen.token', static::TEST_TOKEN);
        $name = 'Test';
        $url = 'https://www.google.com/search?q=green';
        $message = 'Updated from test '. now() .' case testing status should be green';
        $monitor = [];

        try {
            $monitor = LaravelRedAmberGreen::green($name, $message, $url);
        } catch (RagException $rag) {
            $error = $rag->getMessage();
        }
        $this->assertEquals(Arr::get($monitor, 'status', 'unknown'), 'green');
    }

    /** @test */
    public function can_set_existing_monitor_amber()
    {
        config()->set('laravelredambergreen.token', static::TEST_TOKEN);
        $name = 'Test';
        $url = 'https://www.google.com/search?q=amber';
        $message = 'Updated from test '. now() .' case testing status should be green';
        $monitor = [];

        try {
            $monitor = LaravelRedAmberGreen::amber($name, $message, $url);
        } catch (RagException $rag) {
            $error = $rag->getMessage();
        }

        $this->assertEquals(Arr::get($monitor, 'status', 'unknown'), 'amber');
    }
    
    /** @test */
    public function prevents_access_without_token()
    {
        $error = 'Unknown';
        config()->set('laravelredambergreen.token', 'FUBAR');
        try {
            $monitors = LaravelRedAmberGreen::monitors();
        } catch (RagException $rag) {
            $error = $rag->getMessage();
        }

        $this->assertEquals($error, 'Unauthenticated.');
    }
}
