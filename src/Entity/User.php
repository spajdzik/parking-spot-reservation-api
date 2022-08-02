<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: ParkingSpot::class, mappedBy: 'owner')]
    private Collection $parkingSpots;

    public function __construct()
    {
        $this->parkingSpots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, ParkingSpot>
     */
    public function getParkingSpots(): Collection
    {
        return $this->parkingSpots;
    }

    public function addParkingSpot(ParkingSpot $parkingSpot): self
    {
        if (!$this->parkingSpots->contains($parkingSpot)) {
            $this->parkingSpots->add($parkingSpot);
            $parkingSpot->addOwner($this);
        }

        return $this;
    }

    public function removeParkingSpot(ParkingSpot $parkingSpot): self
    {
        if ($this->parkingSpots->removeElement($parkingSpot)) {
            $parkingSpot->removeOwner($this);
        }

        return $this;
    }
}
