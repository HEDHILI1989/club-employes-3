<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sender
 *
 * @ORM\Table(name="SENDER")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\SenderRepository")
 */
class Sender
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
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\User",inversedBy="sender")     
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Invitation",mappedBy="sender",cascade={"persist","remove"})
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
     * @return Sender
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
     * @return Sender
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
