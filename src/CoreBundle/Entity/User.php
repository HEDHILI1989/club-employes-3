<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="USER")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=20)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=20)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;
         
 
    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Sender",mappedBy="user",cascade={"persist","remove"})
     */
    private $sender;

     /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Receiver",mappedBy="user",cascade={"persist","remove"})
     */
    private $receiver;

        
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sender = new \Doctrine\Common\Collections\ArrayCollection();
        $this->receiver = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Add sender
     *
     * @param \CoreBundle\Entity\Sender $sender
     *
     * @return User
     */
    public function addSender(\CoreBundle\Entity\Sender $sender)
    {
        $this->sender[] = $sender;

        return $this;
    }

    /**
     * Remove sender
     *
     * @param \CoreBundle\Entity\Sender $sender
     */
    public function removeSender(\CoreBundle\Entity\Sender $sender)
    {
        $this->sender->removeElement($sender);
    }

    /**
     * Get sender
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Add receiver
     *
     * @param \CoreBundle\Entity\Receiver $receiver
     *
     * @return User
     */
    public function addReceiver(\CoreBundle\Entity\Receiver $receiver)
    {
        $this->receiver[] = $receiver;

        return $this;
    }

    /**
     * Remove receiver
     *
     * @param \CoreBundle\Entity\Receiver $receiver
     */
    public function removeReceiver(\CoreBundle\Entity\Receiver $receiver)
    {
        $this->receiver->removeElement($receiver);
    }

    /**
     * Get receiver
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReceiver()
    {
        return $this->receiver;
    }
}
