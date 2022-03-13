<?php

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use CoreBundle\Entity\User;

class UserController extends Controller
{
    /**     
     * @Rest\View()
     * @Rest\Post("/user/add")     
     */
    public function addAction(Request $request) {                 
        $toolsService = $this->get('core.service.shared.tools');
        $userService = $this->get('core.service.user');  
        $user = $toolsService->deserialize($request->getContent(), User::class, 'json');         
        return $userService->create($user);  
    }
}
