<?php declare(strict_types=1);

namespace App\Task\Provider;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class AbstractTaskProvider
{
    public function __construct(protected readonly HttpClientInterface $httpClient)
    {
    }
}