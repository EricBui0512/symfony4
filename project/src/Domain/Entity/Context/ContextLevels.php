<?php

namespace App\Domain\Entity\Context;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Context Levels
 * @ORM\Entity
 * @package App\Domain\Entity\ContextLevels
 */
class ContextLevels
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $database_table;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Context\Context", mappedBy="context_level_id", orphanRemoval=true)
     */
    private $contexts;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Role\RoleCapabilities", mappedBy="context_level_id", orphanRemoval=true)
     */
    private $roleCapabilities;

    public function __construct()
    {
        $this->contexts = new ArrayCollection();
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

    public function getDatabaseTable(): ?string
    {
        return $this->database_table;
    }

    public function setDatabaseTable(?string $database_table): self
    {
        $this->database_table = $database_table;

        return $this;
    }

    /**
     * @return Collection|Context[]
     */
    public function getContexts(): Collection
    {
        return $this->contexts;
    }

    public function addContext(Context $context): self
    {
        if (!$this->contexts->contains($context)) {
            $this->contexts[] = $context;
            $context->setContextLevelId($this);
        }

        return $this;
    }

    public function removeContext(Context $context): self
    {
        if ($this->contexts->contains($context)) {
            $this->contexts->removeElement($context);
            // set the owning side to null (unless already changed)
            if ($context->getContextLevelId() === $this) {
                $context->setContextLevelId(null);
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
            $roleCapability->setContextLevelId($this);
        }

        return $this;
    }

    public function removeRoleCapability(RoleCapabilities $roleCapability): self
    {
        if ($this->roleCapabilities->contains($roleCapability)) {
            $this->roleCapabilities->removeElement($roleCapability);
            // set the owning side to null (unless already changed)
            if ($roleCapability->getContextLevelId() === $this) {
                $roleCapability->setContextLevelId(null);
            }
        }

        return $this;
    }
}
