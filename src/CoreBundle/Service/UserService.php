<?php

namespace CoreBundle\Service;

 
use CoreBundle\Entity\User;
use CoreBundle\Service\Shared\ToolsService;
use Doctrine\ORM\EntityManagerInterface;
use \FOS\RestBundle\View\View;

class UserService {

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
     * @param User|null $user
     * @return View
     */
    public function create(?User $user): View {
       
        if ($user) {
            $email = $this->em->getRepository(User::class)->findBy(['email' => $user->getEmail()]);
            if ($email) {
                return $this->toolsService->responseHttp('Please choose onther email beacause this email exist', 200);
            } else {
                $this->em->persist($user);
                $this->em->flush();
            }                      
        }
        return $this->toolsService->responseHttp('User created', 201);
    }
}