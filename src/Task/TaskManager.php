<?php declare(strict_types=1);

namespace App\Task;

use App\Entity\Task;
use App\Repository\DeveloperRepository;
use App\Repository\TaskRepository;
use App\Task\Planning\DeveloperInfo;
use App\Task\Strategy\StrategyInterface;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager
{
    public function __construct(
        private readonly TaskCollector $taskCollector,
        private readonly EntityManagerInterface $em,
        private readonly TaskRepository $taskRepository,
        private readonly DeveloperRepository $developerRepository,
        private readonly StrategyInterface $strategy
    )
    {
    }

    public function collectTasks(): void
    {
        foreach ($this->taskCollector->getAllTasks() as $taskData) {
            $task = new Task();
            $task
                ->setName($taskData->name)
                ->setEstimatedDuration($taskData->estimatedDuration)
                ->setLevel($taskData->level);

            $this->em->persist($task);
        }

        $this->em->flush();
    }

    /**
     * @return DeveloperInfo[]
     */
    public function assignTasks(): array
    {
        $developers = $this->developerRepository->findAll();
        $tasks = $this->taskRepository->findAll();

        return $this->strategy->assignTasks($developers, $tasks);
    }
}