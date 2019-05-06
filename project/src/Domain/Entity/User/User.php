<?php


namespace App\Domain\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\Group\UsersGroup;
use App\Domain\Entity\Role\RoleAssignment;

use DateTimeInterface;

/**
 * Class User
 * @ORM\Entity
 * @package App\Domain\Entity\User
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $username;


    /**
     * @ORM\Column(type="string", length=191)
     */
    private $password_hash;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $password_salt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $time_modified;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Role\RoleAssignment", mappedBy="user_id", orphanRemoval=true)
     */
    private $roleAssignments;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Entity\Group\UsersGroup", mappedBy="user_id", orphanRemoval=true)
     */
    private $usersGroups;



    public function __construct()
    {
        $this->roleAssignments = new ArrayCollection();
        $this->usersGroups = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): self
    {
        $this->password_hash = $password_hash;

        return $this;
    }

    public function getPasswordSalt(): ?string
    {
        return $this->password_salt;
    }

    public function setPasswordSalt(string $password_salt): self
    {
        $this->password_salt = $password_salt;

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
            $roleAssignment->setUserId($this);
        }

        return $this;
    }

    public function removeRoleAssignment(RoleAssignment $roleAssignment): self
    {
        if ($this->roleAssignments->contains($roleAssignment)) {
            $this->roleAssignments->removeElement($roleAssignment);
            // set the owning side to null (unless already changed)
            if ($roleAssignment->getUserId() === $this) {
                $roleAssignment->setUserId(null);
            }
        }

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
            $usersGroup->setUserId($this);
        }

        return $this;
    }

    public function removeUsersGroup(UsersGroup $usersGroup): self
    {
        if ($this->usersGroups->contains($usersGroup)) {
            $this->usersGroups->removeElement($usersGroup);
            // set the owning side to null (unless already changed)
            if ($usersGroup->getUserId() === $this) {
                $usersGroup->setUserId(null);
            }
        }

        return $this;
    }

    public function getTimeModified(): ?\DateTimeInterface
    {
        return $this->time_modified;
    }

    public function setTimeModified( $time_modified): self
    {
        $this->time_modified = $time_modified;

        return $this;
    }

}
