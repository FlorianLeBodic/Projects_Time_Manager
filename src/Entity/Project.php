<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Length;

//Test pour github

#[ApiResource(
    security: 'is_granted("ROLE_USER")'
)
]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Length(min:4)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $sold_hours = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?ContractualCompany $contractualCompany = null;

    #[ORM\ManyToMany(targetEntity: Coworker::class, mappedBy: 'projects')]
    private Collection $coworkers;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: HoursOnTheRoad::class)]
    private Collection $hoursOnTheRoads;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: HoursToCustomerCompany::class)]
    private Collection $hoursToCustomerCompany;

    public function __construct()
    {
        $this->coworkers = new ArrayCollection();
        $this->hoursOnTheRoads = new ArrayCollection();
        $this->hoursToCustomerCompany = new ArrayCollection();
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
            $coworker->addProject($this);
        }

        return $this;
    }

    public function removeCoworker(Coworker $coworker): self
    {
        if ($this->coworkers->removeElement($coworker)) {
            $coworker->removeProject($this);
        }

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
            $hoursOnTheRoad->setProject($this);
        }

        return $this;
    }

    public function removeHoursOnTheRoad(HoursOnTheRoad $hoursOnTheRoad): self
    {
        if ($this->hoursOnTheRoads->removeElement($hoursOnTheRoad)) {
            // set the owning side to null (unless already changed)
            if ($hoursOnTheRoad->getProject() === $this) {
                $hoursOnTheRoad->setProject(null);
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
            $hoursToCustomerCompany->setProject($this);
        }

        return $this;
    }

    public function removeHoursToCustomerCompany(HoursToCustomerCompany $hoursToCustomerCompany): self
    {
        if ($this->hoursToCustomerCompany->removeElement($hoursToCustomerCompany)) {
            // set the owning side to null (unless already changed)
            if ($hoursToCustomerCompany->getProject() === $this) {
                $hoursToCustomerCompany->setProject(null);
            }
        }

        return $this;
    }
}
