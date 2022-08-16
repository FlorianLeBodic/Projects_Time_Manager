<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContractualCompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;

#[ApiResource(normalizationContext: ['groups' => ['read:collection']],
    security: 'is_granted("ROLE_USER")'
)]
#[ORM\Entity(repositoryClass: ContractualCompanyRepository::class)]
class ContractualCompany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?int $id = null;

    #[Groups(['read:collection'])]
    #[ORM\Column(length: 50)]
    #[Length(min:3)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'contractualCompany', targetEntity: Project::class)]
    private Collection $projects;

    #[ORM\OneToMany(mappedBy: 'contractualCompany', targetEntity: Coworker::class, cascade:["persist"])]
    private Collection $coworkers;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->coworkers = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setContractualCompany($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getContractualCompany() === $this) {
                $project->setContractualCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Coworker>
     */
    public function getCoworkers(): Collection
    {
        return $this->coworkers;
    }

    public function addCoworker(Coworker $coworker): self
    {
        if (!$this->coworkers->contains($coworker)) {
            $this->coworkers->add($coworker);
            $coworker->setContractualCompany($this);
        }

        return $this;
    }

    public function removeCoworker(Coworker $coworker): self
    {
        if ($this->coworkers->removeElement($coworker)) {
            // set the owning side to null (unless already changed)
            if ($coworker->getContractualCompany() === $this) {
                $coworker->setContractualCompany(null);
            }
        }

        return $this;
    }
}
