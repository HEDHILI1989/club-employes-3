<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Receiver;
use CoreBundle\Entity\Sender;
use Doctrine\ORM\Tools\Setup;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use \FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;

class InvitationController extends Controller
{
    
    /**
     * @Rest\View()
     * @Rest\Post("/invitation/send/{user_receiver}/{user_sender}")
     * @ParamConverter("userReceiver",options={"mapping":{"user_receiver":"id"}})
     * @ParamConverter("userSender",options={"mapping":{"user_sender":"id"}})
     */
    public function sendAction(?User $userReceiver, ?User $userSender): View
    {       
        $invitationService = $this->get('core.service.invitation');
        return $invitationService->sendInvitation($userReceiver, $userSender);       
    }

     /**
     * @Rest\View()
     * @Rest\Post("/invitation/cancel/{idReceiver}/{idSender}")
     * @ParamConverter("receiver",options={"mapping":{"idReceiver":"id"}})
     * @ParamConverter("sender",options={"mapping":{"idSender":"id"}})
     */
    public function cancelAction(?Receiver $receiver, ?Sender $sender): View {
        $invitationService = $this->get('core.service.invitation');
        return $invitationService->cancelInvitation($receiver, $sender);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/invitation/update/{idSender}/{idReceiver}/{status}")
     * @ParamConverter("sender",options={"mapping":{"idSender":"id"}})
     * @ParamConverter("receiver",options={"mapping":{"idReceiver":"id"}})
     */
    public function refusedOrAcceptedAction(?Sender $sender, ?Receiver $receiver, string $status): View {
        $invitationService = $this->get('core.service.invitation');
        return $invitationService->acceptedOrRefusedInvitation($sender, $receiver, $status);
    }
}
