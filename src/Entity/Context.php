<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContextRepository")
 * @UniqueEntity(
 *     fields={"context_level_id","instance"},
 *     errorPath="instance",
 *     message="This instance is already existed in the context"
 *     )
 */
class Context
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer")
     */
    private $intance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RoleAssignment", mappedBy="context_id", orphanRemoval=true)
     */
    private $roleAssigments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContextLevels", inversedBy="contexts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $context_level_id;

    public function __construct()
    {
        $this->roleAssigments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

  

    public function getIntance(): ?int
    {
        return $this->intance;
    }

    public function setIntance(int $intance): self
    {
        $this->intance = $intance;

        return $this;
    }

    /**
     * @return Collection|RoleAssignment[]
     */
    public function getRoleAssigments(): Collection
    {
        return $this->roleAssigments;
    }

    public function addRoleAssigment(RoleAssignment $roleAssigment): self
    {
        if (!$this->roleAssigments->contains($roleAssigment)) {
            $this->roleAssigments[] = $roleAssigment;
            $roleAssigment->setContextId($this);
        }

        return $this;
    }

    public function removeRoleAssigment(RoleAssignment $roleAssigment): self
    {
        if ($this->roleAssigments->contains($roleAssigment)) {
            $this->roleAssigments->removeElement($roleAssigment);
            // set the owning side to null (unless already changed)
            if ($roleAssigment->getContextId() === $this) {
                $roleAssigment->setContextId(null);
            }
        }

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
}
