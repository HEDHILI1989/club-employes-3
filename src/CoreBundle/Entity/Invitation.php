<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 *
 * @ORM\Table(name="INVITATION")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\InvitationRepository")
 */
class Invitation
{

    const STATUS_INPROGRESS = 'inprogress';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REFUSED = 'refused';
    const STATUS_CANCEL = 'cancel';

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
     * @ORM\Column(name="status", type="string", length=15)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Receiver",inversedBy="invitation")     
     */
    private $receiver;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Sender",inversedBy="invitation")     
     */
    private $sender;

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
     * Set status
     *
     * @param string $status
     *
     * @return Invitation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set receiver
     *
     * @param \CoreBundle\Entity\Receiver $receiver
     *
     * @return Invitation
     */
    public function setReceiver(\CoreBundle\Entity\Receiver $receiver = null)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \CoreBundle\Entity\Receiver
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set sender
     *
     * @param \CoreBundle\Entity\Sender $sender
     *
     * @return Invitation
     */
    public function setSender(\CoreBundle\Entity\Sender $sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \CoreBundle\Entity\Sender
     */
    public function getSender()
    {
        return $this->sender;
    }
}
