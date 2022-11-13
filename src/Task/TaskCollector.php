<?php declare(strict_types=1);

namespace App\Task;

use App\Task\Provider\TaskProviderInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class TaskCollector
{
    /**
     * @var iterable<TaskProviderInterface>
     */
    private iterable $taskProviders;

    public function __construct(
        #[TaggedIterator('app.task_provider')] iterable $taskProviders
    )
    {
        $this->taskProviders = $taskProviders;
    }

    /**
     * @return Task[]
     */
    public function getAllTasks(): array
    {
        $taskLists = [];
        foreach ($this->taskProviders as $taskProvider) {
            if ($taskProvider->isEnabled()) {
                $taskLists[] = $taskProvider->getTasks();
            }
        }

        return array_merge(...$taskLists);
    }
}