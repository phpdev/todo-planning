<?php

namespace App\Task\Strategy;

use App\Entity\Developer;
use App\Entity\Task;
use App\Task\Planning\DeveloperInfo;

interface StrategyInterface
{
    /**
     * @param Developer[] $developers
     * @param Task[] $tasks
     * @return DeveloperInfo[]
     */
    public function assignTasks(array $developers, array $tasks): array;
}