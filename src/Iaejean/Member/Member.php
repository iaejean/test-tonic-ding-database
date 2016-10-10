<?php
declare(strict_types=1);

namespace Iaejean\Member;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Member
 * @package Iaejean\Member
 */
class Member
{
    /**
     * @var int
     * @Serializer\Type("integer")
     * @Serializer\Groups({"get"})
     */
    private $id;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Groups({"get"})
     */
    private $name;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Groups({"get"})
     */
    private $email;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Groups({"get"})
     */
    private $image;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("team_id")
     * @Serializer\Groups({"get"})
     */
    private $teamId;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("created_at")
     */
    private $createdAt;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("updated_at")
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Member
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Member
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Member
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Member
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @param string $teamId
     * @return Member
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Member
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return Member
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
