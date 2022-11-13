<?php declare(strict_types=1);

namespace App\Task\Planning;

use App\Entity\Developer;

class DeveloperInfo
{
    public Developer $developer;

    public int $points;

    /**
     * @var WeekInfo[]
     */
    public array $weekInfos;

    /**
     * @param Developer $developer
     * @param int $points
     * @param WeekInfo[] $weekInfos
     */
    public function __construct(Developer $developer, int $points, array $weekInfos = [])
    {
        $this->developer = $developer;
        $this->points = $points;
        $this->weekInfos = $weekInfos;
    }
}