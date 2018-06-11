<?php

namespace App\Controller;

use App\Entity\Affiches;
use App\Services\FixturesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AffichesController extends AbstractController
{
    /**
     * @var FixturesManager $fm
     */
    private $fm;

    /**
     * NewsController constructor.
     * @param FixturesManager $fm
     */
    public function __construct( FixturesManager $fm ) {
        $this->fm = $fm;
    }

    /**
     * @Route("/affiches", name="affiches_all")
     */
    public function indexAffiches(){
        $repository = $this->getDoctrine()
            ->getRepository(Affiches::class);

        $affiches = $repository->findAll();

        return $this->render(
            'affiches/index.html.twig',
            ['affiches' => $affiches]
        );
    }

    /**
     * @param FixturesManager $fm
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/affiches/add", name="affiches_add")
     */
    public function add( FixturesManager $fm ) {

        $repository = $this->getDoctrine()
            ->getRepository(Affiches::class);
        $affiches = $repository->findAll();

        $em = $this->getDoctrine()->getManager();
        for($i = 0; $i < 2; $i++){
            $affiches = new Affiches();
            $affiches->setDescription($fm->getFaker()->jobTitle);
            $affiches->setImageUrl($fm->getFaker()->imageUrl(300,150));
            $em->persist($affiches);
        }
        $em->flush();

        return $this->redirectToRoute('affiches_all');
    }

}
