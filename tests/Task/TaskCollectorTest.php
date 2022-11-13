<?php declare(strict_types=1);

namespace App\Tests\Task;

use App\Task\Provider\TaskProviderOne;
use App\Task\Provider\TaskProviderTwo;
use App\Task\TaskCollector;
use ArrayIterator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class TaskCollectorTest extends TestCase
{
    public function testGetAllTasks(): void
    {
        $taskProviderOne = new TaskProviderOne(
            new MockHttpClient(new MockResponse('[{"zorluk":3,"sure":6,"id":"A"}]'))
        );
        $taskProviderTwo = new TaskProviderTwo(
            new MockHttpClient(new MockResponse('[{"B":{"level":1,"estimated_duration":7}}]'))
        );

        $taskCollector = new TaskCollector(
            new ArrayIterator([$taskProviderOne, $taskProviderTwo])
        );

        $this->assertCount(2, $taskCollector->getAllTasks());
    }
}