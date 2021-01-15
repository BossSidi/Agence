<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param PropertyRepository $propertyRepository
     * @return Response
     */
    public function home(Request $request, PropertyRepository $propertyRepository): Response
    {
        $properties = $propertyRepository->findLatest();
        return $this->render("home/home.html.twig", [
            'properties'=>$properties
        ]);
    }

}