<?php

namespace App\Domain\Entity\Group;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\Group\UsersGroup;

/**
 * @ORM\Entity
 */
class ChatGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Group\UsersGroup", mappedBy="group_id", orphanRemoval=true)
     */
    private $usersGroups;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $time_modified;

    /**
     * @ORM\Column(type="integer")
     */
    private $modifier_id;

    public function __construct()
    {
        $this->usersGroups = new ArrayCollection();
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

    /**
     * @return Collection|UsersGroup[]
     */
    public function getUsersGroups(): Collection
    {
        return $this->usersGroups;
    }

    public function addUsersGroup(UsersGroup $usersGroup): self
    {
        if (!$this->usersGroups->contains($usersGroup)) {
            $this->usersGroups[] = $usersGroup;
            $usersGroup->setGroupId($this);
        }

        return $this;
    }

    public function removeUsersGroup(UsersGroup $usersGroup): self
    {
        if ($this->usersGroups->contains($usersGroup)) {
            $this->usersGroups->removeElement($usersGroup);
            // set the owning side to null (unless already changed)
            if ($usersGroup->getGroupId() === $this) {
                $usersGroup->setGroupId(null);
            }
        }

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
