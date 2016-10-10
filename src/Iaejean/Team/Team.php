<?php
declare(strict_types=1);

namespace Iaejean\Team;

use Iaejean\Member\Member;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Team
 * @package Iaejean\Team
 */
class Team
{
    /**
     * @var int
     * @Serializer\Type("integer")
     * @Serializer\Groups({"list", "get"})
     */
    private $id;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Groups({"list", "get"})
     * @Assert\NotBlank(message="The name field is required")
     */
    private $name;
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
     * @var Member[]
     * @Serializer\Type("array<Iaejean\Member\Member>")
     * @Serializer\Groups({"get"})
     */
    private $members;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Team
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
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Team
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
     * @return Team
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \Iaejean\Member\Member[]
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param \Iaejean\Member\Member[] $members
     * @return Team
     */
    public function setMembers($members)
    {
        $this->members = $members;
        return $this;
    }
}
