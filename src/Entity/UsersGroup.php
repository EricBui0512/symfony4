<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersGroupRepository")
 * @UniqueEntity(
 *     fields={"groupd_id","user_id"},
 *     errorPath="user_id",
 *     message="This user is already existed in that group"
 *     )
 */
class UsersGroup
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
    private $time_start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $time_end;

    /**
     * @ORM\Column(type="integer")
     */
    private $modifier_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="usersGroups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $group_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="usersGroups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getTimeStart(): ?int
    {
        return $this->time_start;
    }

    public function setTimeStart(int $time_start): self
    {
        $this->time_start = $time_start;

        return $this;
    }

    public function getTimeEnd(): ?int
    {
        return $this->time_end;
    }

    public function setTimeEnd(?int $time_end): self
    {
        $this->time_end = $time_end;

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

    public function getGroupId(): ?Group
    {
        return $this->group_id;
    }

    public function setGroupId(?Group $group_id): self
    {
        $this->group_id = $group_id;

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
}
