<?php declare(strict_types=1);

namespace App\Task\Strategy;

use App\Entity\Task;
use App\Task\Planning\DeveloperInfo;
use App\Task\Planning\TaskInfo;
use App\Task\Planning\WeekInfo;

class ShortestTimeStrategy implements StrategyInterface
{
    public function assignTasks(array $developers, array $tasks): array
    {
        $developerInfos = [];
        foreach ($developers as $developer) {
            $points = $developer->getLevel() * $developer->getWorkingHours();
            $developerInfos[] = new DeveloperInfo($developer, $points);
        }

        // Sort by points
        usort($tasks, static function (Task $a, Task $b) {
            return ($a->getLevel() * $a->getEstimatedDuration()) <=> ($b->getLevel() * $b->getEstimatedDuration());
        });

        $taskInfos = [];
        foreach ($tasks as $task) {
            $points = $task->getLevel() * $task->getEstimatedDuration();
            $taskInfos[] = new TaskInfo($task, $points);
        }

        $weekIndex = 0;
        while(0 !== count($taskInfos)) {
            $taskInfos = $this->handleWeek($weekIndex, $developerInfos, $taskInfos);
            $weekIndex++;
        }

        return $developerInfos;
    }

    /**
     * @param int $weekIndex
     * @param DeveloperInfo[] $developerInfos
     * @param TaskInfo[] $taskInfos
     * @return TaskInfo[]
     */
    private function handleWeek(int $weekIndex, array $developerInfos, array $taskInfos): array
    {
        foreach ($developerInfos as $developerInfo) {

            if (false === array_key_exists($weekIndex, $developerInfo->weekInfos)) {
                $developerInfo->weekInfos[$weekIndex] = new WeekInfo();
            }

            $weekInfo = $developerInfo->weekInfos[$weekIndex];

            foreach ($taskInfos as $index => $taskInfo) {

                $missingPoints = $developerInfo->points - $weekInfo->points;

                if (0 === $missingPoints) {
                    break;
                }

                if ($taskInfo->points <= $missingPoints) {
                    $weekInfo->taskInfos[] = $taskInfo;
                    $weekInfo->points += $taskInfo->points;
                } else {

                    // Part 1
                    $taskInfoPart1 = clone $taskInfo;
                    $taskInfoPart1->points = $missingPoints;

                    $weekInfo->taskInfos[] = $taskInfoPart1;
                    $weekInfo->points += $taskInfoPart1->points;

                    // Part 2
                    $taskInfoPart2 = clone $taskInfo;
                    $taskInfoPart2->points = $taskInfo->points - $missingPoints;

                    $this->handleWeek($weekIndex + 1, [$developerInfo], [$taskInfoPart2]);

                }
                unset($taskInfos[$index]);
            }

            // If the week info empty, delete it
            if (0 === $developerInfo->weekInfos[$weekIndex]->points) {
                unset($developerInfo->weekInfos[$weekIndex]);
            }

        }

        return $taskInfos;
    }
}