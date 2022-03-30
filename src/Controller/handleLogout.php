<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class handleLogout extends AbstractController
{

    public function exit(){
        return $this->render('logout.html.twig');
    }

}
