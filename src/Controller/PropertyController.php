<?php


namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository $propertyRepository
     */
    private $propertyRepository;
    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * PropertyController constructor.
     * @param PropertyRepository $propertyRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(PropertyRepository $propertyRepository, EntityManagerInterface $em)
    {
        $this->em=$em;
        $this->propertyRepository= $propertyRepository;


    }


    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {

        $property = $this->propertyRepository->findAllVisible();
       return $this->render("property/index.html.twig",
       array('current_menu'=>'property')
       );

    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Request $request
     * @param Property $property
     * @return Response
     */
    public function show(Request $request,Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug)
        {
           return $this->redirectToRoute('property.show', [
                'id'=>$property->getId(),
                'slug'=>$property->getSlug()
            ], 301);
        }
         return $this->render("property/show.html.twig", array(
                 'current_menu'=>'property',
                 'property'=>$property,

                 ));
    }

}