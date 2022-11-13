<?php

namespace App\Command;

use App\Task\TaskManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:collect-tasks',
    description: 'Collect tasks from providers',
)]
class CollectTasksCommand extends Command
{
    public function __construct(private readonly TaskManager $taskManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->taskManager->collectTasks();

        $io = new SymfonyStyle($input, $output);
        $io->success('Success!');

        return Command::SUCCESS;
    }
}
