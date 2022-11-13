<?php declare(strict_types=1);

namespace App\Task\Provider;

use App\Task\Exception\UnexpectedProviderResponseException;
use App\Task\Task;

class TaskProviderOne extends AbstractTaskProvider implements TaskProviderInterface
{
    private const PROVIDER_BASE_URL = 'https://www.mocky.io/v2/';

    public function getTasks(): array
    {
        $response = $this->httpClient->request(
            'GET',
            self::PROVIDER_BASE_URL . '5d47f24c330000623fa3ebfa'
        );

        $statusCode = $response->getStatusCode();

        if (200 !== $statusCode) {
            throw new UnexpectedProviderResponseException('Unexpected statusCode');
        }

        $items = $response->toArray();

        $tasks = [];
        foreach ($items as $item) {
            $task = new Task();
            $task->name = $item['id'];
            $task->estimatedDuration = $item['sure'];
            $task->level = $item['zorluk'];
            $tasks[] = $task;
        }

        return $tasks;
    }

    public function isEnabled(): bool
    {
        return true;
    }
}