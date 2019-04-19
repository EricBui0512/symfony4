<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CapabilitiesRepository")
 */
class Capabilities
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RoleCapabilities", mappedBy="capability_id", orphanRemoval=true)
     */
    private $roleCapabilities;

    public function __construct()
    {
        $this->roleCapabilities = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|RoleCapabilities[]
     */
    public function getRoleCapabilities(): Collection
    {
        return $this->roleCapabilities;
    }

    public function addRoleCapability(RoleCapabilities $roleCapability): self
    {
        if (!$this->roleCapabilities->contains($roleCapability)) {
            $this->roleCapabilities[] = $roleCapability;
            $roleCapability->setCapabilityId($this);
        }

        return $this;
    }

    public function removeRoleCapability(RoleCapabilities $roleCapability): self
    {
        if ($this->roleCapabilities->contains($roleCapability)) {
            $this->roleCapabilities->removeElement($roleCapability);
            // set the owning side to null (unless already changed)
            if ($roleCapability->getCapabilityId() === $this) {
                $roleCapability->setCapabilityId(null);
            }
        }

        return $this;
    }
}
