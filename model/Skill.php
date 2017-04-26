<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 3.0.3 (doctrine2-annotation) on 2017-04-26 08:43:03.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Entity\Skill
 *
 * @ORM\Entity(repositoryClass="SkillRepository")
 * @ORM\Table(name="Skills")
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $IdSkills;

    /**
     * @ORM\Column(name="`Name`", type="string", length=45, nullable=true)
     */
    protected $Name;

    /**
     * @ORM\Column(name="`Type`", type="smallint", nullable=true)
     */
    protected $Type;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $Skillscol;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="skills")
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Set the value of IdSkills.
     *
     * @param integer $IdSkills
     * @return \Entity\Skill
     */
    public function setIdSkills($IdSkills)
    {
        $this->IdSkills = $IdSkills;

        return $this;
    }

    /**
     * Get the value of IdSkills.
     *
     * @return integer
     */
    public function getIdSkills()
    {
        return $this->IdSkills;
    }

    /**
     * Set the value of Name.
     *
     * @param string $Name
     * @return \Entity\Skill
     */
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * Get the value of Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the value of Type.
     *
     * @param integer $Type
     * @return \Entity\Skill
     */
    public function setType($Type)
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * Get the value of Type.
     *
     * @return integer
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * Set the value of Skillscol.
     *
     * @param string $Skillscol
     * @return \Entity\Skill
     */
    public function setSkillscol($Skillscol)
    {
        $this->Skillscol = $Skillscol;

        return $this;
    }

    /**
     * Get the value of Skillscol.
     *
     * @return string
     */
    public function getSkillscol()
    {
        return $this->Skillscol;
    }

    /**
     * Add User entity to collection.
     *
     * @param \Entity\User $user
     * @return \Entity\Skill
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove User entity from collection.
     *
     * @param \Entity\User $user
     * @return \Entity\Skill
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * Get User entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function __sleep()
    {
        return array('IdSkills', 'Name', 'Type', 'Skillscol');
    }
}