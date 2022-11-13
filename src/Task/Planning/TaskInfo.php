<?php declare(strict_types=1);

namespace App\Task\Planning;

use App\Entity\Task;

class TaskInfo
{
    public Task $task;

    public int $points;

    /**
     * @param Task $task
     * @param int $points
     */
    public function __construct(Task $task, int $points)
    {
        $this->task = $task;
        $this->points = $points;
    }
}