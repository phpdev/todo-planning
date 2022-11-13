<?php declare(strict_types=1);

namespace App\Task\Planning;

class WeekInfo
{
    /**
     * @var TaskInfo[]
     */
    public array $taskInfos;

    /**
     * @var int
     */
    public int $points = 0;
}