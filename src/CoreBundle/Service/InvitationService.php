<?php

namespace CoreBundle\Service;

use CoreBundle\Entity\Invitation;
use CoreBundle\Entity\Receiver;
use CoreBundle\Entity\Sender;
use CoreBundle\Entity\User;
use CoreBundle\Service\Shared\ToolsService;
use Doctrine\ORM\EntityManagerInterface;
use \FOS\RestBundle\View\View;

class InvitationService {

    protected $em;
    protected $toolsService;

    public function __construct(
                                EntityManagerInterface $em,
                                ToolsService $toolsService)
    {
        $this->em = $em;            
        $this->toolsService = $toolsService;
    }

    /**
     *
     * @param User $userReceiver
     * @param User $userSender
     * @return View
     */
    public function sendInvitation(User $userReceiver, User $userSender): View {
        $receiver = $this->createReceiver($userReceiver);
        $sender = $this->createSender($userSender);
        $invitation = (new Invitation())->setReceiver($receiver)->setSender($sender)->setStatus(Invitation::STATUS_INPROGRESS);
        $this->em->persist($invitation);
        $this->em->flush();
        return $this->toolsService->responseHttp('Invitation sent', 201);
    }

    /**
     *
     * @param Receiver $receiver
     * @param Sender $sender
     * @return View
     */
    public function cancelInvitation(Receiver $receiver, Sender $sender): View {        
        $invitation = $this->em->getRepository(Invitation::class)
                            ->findOneBy(['receiver' => $receiver, 'sender' => $sender]);
        if (!$invitation) {
            return $this->toolsService->responseHttp('Invitation not found', 404);
        }                           
        $this->em->remove($invitation);
        $this->em->flush();
        return $this->toolsService->responseHttp('Invitation cancel', 204);
    }

    /**
     *
     * @param Sender $sender
     * @param Receiver $receiver
     * @param string $status
     * @return View
     */
    public function acceptedOrRefusedInvitation(Sender $sender, Receiver $receiver, string $status): View {
        $invitation = $this->em->getRepository(Invitation::class)
                            ->findOneBy(['receiver' => $receiver, 'sender' => $sender]);
        if (!$invitation) {
            return $this->toolsService->responseHttp('Invitation not found', 404);            
        }         
        if ($status === Invitation::STATUS_ACCEPTED) {
            $invitation->setStatus($status);
            $this->em->persist($invitation);
            $this->em->flush();
            return $this->toolsService->responseHttp('Invitation accepted', 200);
        } elseif ($status === Invitation::STATUS_REFUSED) {
            $this->em->remove($invitation);
            $this->em->flush();
            return $this->toolsService->responseHttp('Invitation refused', 201);
        }
    }
    
    /**
     *
     * @param User $userReceiver
     * @return Receiver
     */
    public function createReceiver(User $userReceiver): Receiver {
        $receiver = (new Receiver())->setUser($userReceiver);          
        $this->em->persist($receiver);
        $this->em->flush();
        return $receiver;
    }

    /**
     *
     * @param User $userSender
     * @return Sender
     */
    public function createSender(User $userSender): Sender {
        $sender = (new Sender())->setUser($userSender);
        $this->em->persist($sender);
        $this->em->flush();
        return $sender;
    }
}