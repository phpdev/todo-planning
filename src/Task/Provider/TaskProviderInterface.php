<?php

namespace App\Task\Provider;

use App\Task\Task;

interface TaskProviderInterface
{
    /**
     * @return Task[]
     */
    public function getTasks(): array;

    public function isEnabled(): bool;
}