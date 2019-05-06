<?php


namespace App\Domain\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Role
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
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $short_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Role\RoleAssignment", mappedBy="role_id", orphanRemoval=true)
     */
    private $roleAssignments;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Role\RoleCapabilities", mappedBy="role_id", orphanRemoval=true)
     */
    private $roleCapabilities;

    public function __construct()
    {
        $this->roleAssignments = new ArrayCollection();
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

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): self
    {
        $this->short_name = $short_name;

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
     * @return Collection|RoleAssignment[]
     */
    public function getRoleAssignments(): Collection
    {
        return $this->roleAssignments;
    }

    public function addRoleAssignment(RoleAssignment $roleAssignment): self
    {
        if (!$this->roleAssignments->contains($roleAssignment)) {
            $this->roleAssignments[] = $roleAssignment;
            $roleAssignment->setRoleId($this);
        }

        return $this;
    }

    public function removeRoleAssignment(RoleAssignment $roleAssignment): self
    {
        if ($this->roleAssignments->contains($roleAssignment)) {
            $this->roleAssignments->removeElement($roleAssignment);
            // set the owning side to null (unless already changed)
            if ($roleAssignment->getRoleId() === $this) {
                $roleAssignment->setRoleId(null);
            }
        }

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
            $roleCapability->setRoleId($this);
        }

        return $this;
    }

    public function removeRoleCapability(RoleCapabilities $roleCapability): self
    {
        if ($this->roleCapabilities->contains($roleCapability)) {
            $this->roleCapabilities->removeElement($roleCapability);
            // set the owning side to null (unless already changed)
            if ($roleCapability->getRoleId() === $this) {
                $roleCapability->setRoleId(null);
            }
        }

        return $this;
    }
}
