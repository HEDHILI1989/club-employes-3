<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 
/**
 * Receiver
 *
 * @ORM\Table(name="RECEIVER")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ReceiverRepository")
 */
class Receiver
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *  
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\User",inversedBy="receiver")     
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Invitation",mappedBy="receiver",cascade={"persist","remove"})
     */
    private $invitation;

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
     * Set user
     *
     * @param \CoreBundle\Entity\User $user
     *
     * @return Receiver
     */
    public function setUser(\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoreBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invitation = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invitation
     *
     * @param \CoreBundle\Entity\Invitation $invitation
     *
     * @return Receiver
     */
    public function addInvitation(\CoreBundle\Entity\Invitation $invitation)
    {
        $this->invitation[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \CoreBundle\Entity\Invitation $invitation
     */
    public function removeInvitation(\CoreBundle\Entity\Invitation $invitation)
    {
        $this->invitation->removeElement($invitation);
    }

    /**
     * Get invitation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
}
