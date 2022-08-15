<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoworkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;

#[ApiResource]
#[ORM\Entity(repositoryClass: CoworkerRepository::class)]
class Coworker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Length(min:2)]
    private ?string $first_name = null;

    #[ORM\Column(length: 50)]
    #[Length(min:2)]
    private ?string $last_name = null;

    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'coworkers')]
    private Collection $projects;

    #[ORM\OneToMany(mappedBy: 'coworker', targetEntity: HoursOnTheRoad::class, orphanRemoval: true)]
    private Collection $hoursOnTheRoads;

    #[ORM\OneToMany(mappedBy: 'coworker', targetEntity: HoursToCustomerCompany::class)]
    private Collection $hoursToCustomerCompany;

    #[ORM\ManyToOne(inversedBy: 'coworkers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContractualCompany $contractualCompany = null;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->hoursOnTheRoads = new ArrayCollection();
        $this->hoursToCustomerCompany = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

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
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        $this->projects->removeElement($project);

        return $this;
    }

    /**
     * @return Collection<int, HoursOnTheRoad>
     */
    public function getHoursOnTheRoads(): Collection
    {
        return $this->hoursOnTheRoads;
    }

    public function addHoursOnTheRoad(HoursOnTheRoad $hoursOnTheRoad): self
    {
        if (!$this->hoursOnTheRoads->contains($hoursOnTheRoad)) {
            $this->hoursOnTheRoads->add($hoursOnTheRoad);
            $hoursOnTheRoad->setCoworker($this);
        }

        return $this;
    }

    public function removeHoursOnTheRoad(HoursOnTheRoad $hoursOnTheRoad): self
    {
        if ($this->hoursOnTheRoads->removeElement($hoursOnTheRoad)) {
            // set the owning side to null (unless already changed)
            if ($hoursOnTheRoad->getCoworker() === $this) {
                $hoursOnTheRoad->setCoworker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HoursToCustomerCompany>
     */
    public function getHoursToCustomerCompany(): Collection
    {
        return $this->hoursToCustomerCompany;
    }

    public function addHoursToCustomerCompany(HoursToCustomerCompany $hoursToCustomerCompany): self
    {
        if (!$this->hoursToCustomerCompany->contains($hoursToCustomerCompany)) {
            $this->hoursToCustomerCompany->add($hoursToCustomerCompany);
            $hoursToCustomerCompany->setCoworker($this);
        }

        return $this;
    }

    public function removeHoursToCustomerCompany(HoursToCustomerCompany $hoursToCustomerCompany): self
    {
        if ($this->hoursToCustomerCompany->removeElement($hoursToCustomerCompany)) {
            // set the owning side to null (unless already changed)
            if ($hoursToCustomerCompany->getCoworker() === $this) {
                $hoursToCustomerCompany->setCoworker(null);
            }
        }

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
