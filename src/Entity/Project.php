<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

//Test pour github

#[ApiResource]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $sold_hours = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?ContractualCompany $contractualCompany = null;

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

    public function getSoldHours(): ?int
    {
        return $this->sold_hours;
    }

    public function setSoldHours(?int $sold_hours): self
    {
        $this->sold_hours = $sold_hours;

        return $this;
    }

    public function getContractualCompany(): ?ContractualCompany
    {
        return $this->contractualCompany;
    }

    public function setContractualCompany(?ContractualCompany $contractualCompany): self
    {
        $this->contractualCompany = $contractualCompany;

        return $this;
    }
}
