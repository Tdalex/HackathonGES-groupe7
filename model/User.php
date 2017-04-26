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
 * Entity\User
 *
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="`User`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $IdUser;

    /**
     * @ORM\Column(name="`Name`", type="string", length=45)
     */
    protected $Name;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $Surname;

    /**
     * @ORM\Column(type="date")
     */
    protected $Birthdate;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $Email;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    protected $CV;

    /**
     * @ORM\Column(name="`Role`", type="string", length=45, nullable=true)
     */
    protected $Role;

    /**
     * @ORM\Column(name="`Password`", type="string", length=255)
     */
    protected $Password;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="user")
     * @ORM\JoinColumn(name="IdUser", referencedColumnName="IdUser", nullable=false)
     */
    protected $games;

    /**
     * @ORM\ManyToMany(targetEntity="Skill", inversedBy="users")
     * @ORM\JoinTable(name="User_Skills",
     *     joinColumns={@ORM\JoinColumn(name="IdUser", referencedColumnName="IdUser", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="IdSkills", referencedColumnName="IdSkills", nullable=false)}
     * )
     */
    protected $skills;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }

    /**
     * Set the value of IdUser.
     *
     * @param integer $IdUser
     * @return \Entity\User
     */
    public function setIdUser($IdUser)
    {
        $this->IdUser = $IdUser;

        return $this;
    }

    /**
     * Get the value of IdUser.
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->IdUser;
    }

    /**
     * Set the value of Name.
     *
     * @param string $Name
     * @return \Entity\User
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
     * Set the value of Surname.
     *
     * @param string $Surname
     * @return \Entity\User
     */
    public function setSurname($Surname)
    {
        $this->Surname = $Surname;

        return $this;
    }

    /**
     * Get the value of Surname.
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->Surname;
    }

    /**
     * Set the value of Birthdate.
     *
     * @param \DateTime $Birthdate
     * @return \Entity\User
     */
    public function setBirthdate($Birthdate)
    {
        $this->Birthdate = $Birthdate;

        return $this;
    }

    /**
     * Get the value of Birthdate.
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->Birthdate;
    }

    /**
     * Set the value of Email.
     *
     * @param string $Email
     * @return \Entity\User
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * Get the value of Email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Set the value of CV.
     *
     * @param string $CV
     * @return \Entity\User
     */
    public function setCV($CV)
    {
        $this->CV = $CV;

        return $this;
    }

    /**
     * Get the value of CV.
     *
     * @return string
     */
    public function getCV()
    {
        return $this->CV;
    }

    /**
     * Set the value of Role.
     *
     * @param string $Role
     * @return \Entity\User
     */
    public function setRole($Role)
    {
        $this->Role = $Role;

        return $this;
    }

    /**
     * Get the value of Role.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->Role;
    }

    /**
     * Set the value of Password.
     *
     * @param string $Password
     * @return \Entity\User
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * Get the value of Password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * Add Game entity to collection (one to many).
     *
     * @param \Entity\Game $game
     * @return \Entity\User
     */
    public function addGame(Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove Game entity from collection (one to many).
     *
     * @param \Entity\Game $game
     * @return \Entity\User
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);

        return $this;
    }

    /**
     * Get Game entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * Add Skill entity to collection.
     *
     * @param \Entity\Skill $skill
     * @return \Entity\User
     */
    public function addSkill(Skill $skill)
    {
        $skill->addUser($this);
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove Skill entity from collection.
     *
     * @param \Entity\Skill $skill
     * @return \Entity\User
     */
    public function removeSkill(Skill $skill)
    {
        $skill->removeUser($this);
        $this->skills->removeElement($skill);

        return $this;
    }

    /**
     * Get Skill entity collection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    public function __sleep()
    {
        return array('IdUser', 'Name', 'Surname', 'Birthdate', 'Email', 'CV', 'Role', 'Password');
    }
}