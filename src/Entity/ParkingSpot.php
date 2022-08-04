<?php

namespace App\Entity;

use App\Repository\ParkingSpotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParkingSpotRepository::class)]
class ParkingSpot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?int $stage = null;

    #[ORM\Column(length: 255)]
    private ?string $garage = null;

    #[ORM\Column]
    private ?int $spot = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nearestStaircase = null;

    #[ORM\Column]
    private ?bool $available = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'parkingSpots')]
    private Collection $owners;

    public function __construct()
    {
        $this->owners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getStage(): ?int
    {
        return $this->stage;
    }

    public function setStage(int $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getGarage(): ?string
    {
        return $this->garage;
    }

    public function setGarage(string $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getSpot(): ?int
    {
        return $this->spot;
    }

    public function setSpot(int $spot): self
    {
        $this->spot = $spot;

        return $this;
    }

    public function getNearestStaircase(): ?string
    {
        return $this->nearestStaircase;
    }

    public function setNearestStaircase(?string $nearestStaircase): self
    {
        $this->nearestStaircase = $nearestStaircase;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOwners(): Collection
    {
        return $this->owners;
    }

    public function addOwner(User $owner): self
    {
        if (!$this->owners->contains($owner)) {
            $this->owners->add($owner);
        }

        return $this;
    }

    public function removeOwner(User $owner): self
    {
        $this->owners->removeElement($owner);

        return $this;
    }
}
