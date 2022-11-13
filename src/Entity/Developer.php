<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
class Developer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Ignore]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column]
    private ?int $workingHours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getWorkingHours(): ?int
    {
        return $this->workingHours;
    }

    public function setWorkingHours(int $workingHours): self
    {
        $this->workingHours = $workingHours;

        return $this;
    }
}
