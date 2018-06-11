<?php

namespace App\Controller;

use App\Entity\Acteurs;
use App\Services\FixturesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActeursController extends AbstractController
{

    /**
     * @var FixturesManager $fm
     */
    private $fm;

    /**
     * @param FixturesManager $fm
     */
    public function __construct( FixturesManager $fm ) {
        $this->fm = $fm;
    }

    /**
     * @Route("/acteurs", name="acteurs_all")
     */
    public function indexActeurs()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Acteurs::class);

        $acteurs = $repository->findAll();

        return $this->render(
            'acteurs/index.html.twig',
            ['acteurs' => $acteurs]
        );
    }

    /**
     * @param FixturesManager $fm
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/acteurs/add", name="acteurs_add")
     */
    public function add( FixturesManager $fm ) {

        $repository = $this->getDoctrine()
            ->getRepository(Acteurs::class);

        $acteurs = $repository->findAll();

        $em = $this->getDoctrine()->getManager();
        for($i = 0; $i < 2; $i++){
            $acteurs = new Acteurs();
            $acteurs->setNom($fm->getFaker()->name);
            $acteurs->setPrenom($fm->getFaker()->firstName);
            $acteurs->setDateDeNaissance($fm->getFaker()->dateTime($max = 'now', $timezone = null) );
            $acteurs->setDateDeDeces($fm->getFaker()->dateTime($max = 'now', $timezone = null) );
            $acteurs->setImageUrl($fm->getFaker()->imageUrl(300,150));
            $em->persist($acteurs);
        }
        $em->flush();

        return $this->redirectToRoute('acteurs_all');
    }

}
