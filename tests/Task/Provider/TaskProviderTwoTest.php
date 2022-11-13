<?php

namespace App\Tests\Task\Provider;

use App\Task\Provider\TaskProviderTwo;
use App\Task\Task;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class TaskProviderTwoTest extends TestCase
{
    public function testIsEnabled(): void
    {
        $provider = $this->getTaskProvider();

        $this->assertTrue($provider->isEnabled());
    }

    public function testGetTasks(): void
    {
        $provider = $this->getTaskProvider();

        $tasks = $provider->getTasks();

        $this->assertCount(2, $tasks);

        $task1 = new Task();
        $task1->name = 'Business Task 0';
        $task1->level = 1;
        $task1->estimatedDuration = 7;

        $task2 = new Task();
        $task2->name = 'Business Task 1';
        $task2->level = 3;
        $task2->estimatedDuration = 4;

        $this->assertEquals($task1, $tasks[0]);
        $this->assertEquals($task2, $tasks[1]);
    }

    private function getTaskProvider(): TaskProviderTwo
    {
        $httpClient = new MockHttpClient(function ($method, $url) {
            if (
                'GET' !== $method
                || $url !== 'https://www.mocky.io/v2/5d47f235330000623fa3ebf7'
            ) {
                return new MockResponse('', ['http_code' => 404]);
            }

            return new MockResponse('[{"Business Task 0":{"level":1,"estimated_duration":7}},{"Business Task 1":{"level":3,"estimated_duration":4}}]');
        });

        return new TaskProviderTwo($httpClient);
    }
}
