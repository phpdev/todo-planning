<?php

namespace App\Controller;

use App\Task\TaskManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private readonly TaskManager $taskManager)
    {
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/planning-result', name: 'app_get_planning_result')]
    public function getPlanningResult(): JsonResponse
    {
        $planningResult = $this->taskManager->assignTasks();

        return $this->json($planningResult);
    }
}
