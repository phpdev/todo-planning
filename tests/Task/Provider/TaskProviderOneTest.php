<?php

namespace App\Tests\Task\Provider;

use App\Task\Provider\TaskProviderOne;
use App\Task\Task;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class TaskProviderOneTest extends TestCase
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
        $task1->name = 'IT Task 0';
        $task1->level = 3;
        $task1->estimatedDuration = 6;

        $task2 = new Task();
        $task2->name = 'IT Task 1';
        $task2->level = 4;
        $task2->estimatedDuration = 6;

        $this->assertEquals($task1, $tasks[0]);
        $this->assertEquals($task2, $tasks[1]);
    }

    private function getTaskProvider(): TaskProviderOne
    {
        $httpClient = new MockHttpClient(function ($method, $url) {
            if (
                'GET' !== $method
                || $url !== 'https://www.mocky.io/v2/5d47f24c330000623fa3ebfa'
            ) {
                return new MockResponse('', ['http_code' => 404]);
            }

            return new MockResponse('[{"zorluk":3,"sure":6,"id":"IT Task 0"},{"zorluk":4,"sure":6,"id":"IT Task 1"}]');
        });

        return new TaskProviderOne($httpClient);
    }
}
