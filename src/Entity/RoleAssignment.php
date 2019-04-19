<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleAssignmentRepository")
 * @UniqueEntity(
 *     fields={"role_id","context_id","user_id"}
 *     )
 */
class RoleAssignment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\role", inversedBy="roleAssignments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\context", inversedBy="roleAssigments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $context_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="roleAssignments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $time_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $time_end;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $time_modified;

    /**
     * @ORM\Column(type="integer")
     */
    private $modifier_id;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleId(): ?role
    {
        return $this->role_id;
    }

    public function setRoleId(?role $role_id): self
    {
        $this->role_id = $role_id;

        return $this;
    }

    public function getContextId(): ?context
    {
        return $this->context_id;
    }

    public function setContextId(?context $context_id): self
    {
        $this->context_id = $context_id;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }




    public function getTimeStart(): ?\DateTimeInterface
    {
        return $this->time_start;
    }

    public function setTimeStart(\DateTimeInterface $time_start): self
    {
        $this->time_start = $time_start;

        return $this;
    }

    public function getTimeEnd(): ?\DateTimeInterface
    {
        return $this->time_end;
    }

    public function setTimeEnd(?\DateTimeInterface $time_end): self
    {
        $this->time_end = $time_end;

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

    public function getModifierId(): ?int
    {
        return $this->modifier_id;
    }

    public function setModifierId(int $modifier_id): self
    {
        $this->modifier_id = $modifier_id;

        return $this;
    }

}
