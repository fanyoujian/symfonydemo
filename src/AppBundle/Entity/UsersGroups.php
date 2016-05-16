<?php

namespace AppBundle\Entity;

/**
 * UsersGroups
 */
class UsersGroups
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $usersId;

    /**
     * @var int
     */
    private $groupsId;

    /**
     * @var int
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $cretatedAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set usersId
     *
     * @param integer $usersId
     *
     * @return UsersGroups
     */
    public function setUsersId($usersId)
    {
        $this->usersId = $usersId;

        return $this;
    }

    /**
     * Get usersId
     *
     * @return int
     */
    public function getUsersId()
    {
        return $this->usersId;
    }

    /**
     * Set groupsId
     *
     * @param integer $groupsId
     *
     * @return UsersGroups
     */
    public function setGroupsId($groupsId)
    {
        $this->groupsId = $groupsId;

        return $this;
    }

    /**
     * Get groupsId
     *
     * @return int
     */
    public function getGroupsId()
    {
        return $this->groupsId;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return UsersGroups
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set cretatedAt
     *
     * @param \DateTime $cretatedAt
     *
     * @return UsersGroups
     */
    public function setCretatedAt($cretatedAt)
    {
        $this->cretatedAt = $cretatedAt;

        return $this;
    }

    /**
     * Get cretatedAt
     *
     * @return \DateTime
     */
    public function getCretatedAt()
    {
        return $this->cretatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return UsersGroups
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

