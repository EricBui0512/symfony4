<?php

namespace App\Domain\Entity\Role;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Domain\Entity\Context\ContextLevels;
use App\Domain\Entity\Capabilities\Capabilities;

/**
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"role_id","context_level_id","capability_id"}
 *     )
 */
class RoleCapabilities
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $time_modified;

    /**
     * @ORM\Column(type="integer")
     */
    private $modifier_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Entity\Context\ContextLevels", inversedBy="roleCapabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $context_level_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Entity\Role\Role", inversedBy="roleCapabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Entity\Capabilities\Capabilities", inversedBy="roleCapabilities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $capability_id;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getModifierId(): ?int
    {
        return $this->modifier_id;
    }

    public function setModifierId(int $modifier_id): self
    {
        $this->modifier_id = $modifier_id;

        return $this;
    }

    public function getContextLevelId(): ?ContextLevels
    {
        return $this->context_level_id;
    }

    public function setContextLevelId(?ContextLevels $context_level_id): self
    {
        $this->context_level_id = $context_level_id;

        return $this;
    }

    public function getRoleId(): ?Role
    {
        return $this->role_id;
    }

    public function setRoleId(?Role $role_id): self
    {
        $this->role_id = $role_id;

        return $this;
    }

    public function getCapabilityId(): ?Capabilities
    {
        return $this->capability_id;
    }

    public function setCapabilityId(?Capabilities $capability_id): self
    {
        $this->capability_id = $capability_id;

        return $this;
    }

    public function getTimeModified(): ?\DateTimeInterface
    {
        return $this->time_modified;
    }

    public function setTimeModified(\DateTimeInterface $time_modified): self
    {
        $this->time_modified = $time_modified;

        return $this;
    }
}
