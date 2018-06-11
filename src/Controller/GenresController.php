<?php

namespace App\Controller;


use App\Entity\Genres;
use App\Services\FixturesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GenresController extends AbstractController
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
     * @Route("/genres", name="genres_all")
     */
    public function indexGenres()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Genres::class);

        $genres = $repository->findAll();

        return $this->render(
            'genres/index.html.twig',
            ['genres' => $genres]
        );
    }

    /**
     * @param FixturesManager $fm
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/genres/add", name="genres_add")
     */
    public function add( FixturesManager $fm ) {

        $repository = $this->getDoctrine()
            ->getRepository(Genres::class);

        $genres = $repository->findAll();

        $em = $this->getDoctrine()->getManager();
        for($i = 0; $i < 2; $i++){
            $genres = new Genres();
            $genres->setNom($fm->getFaker()->jobTitle);
            $em->persist($genres);
        }
        $em->flush();

        return $this->redirectToRoute('genres_all');
    }



    //Add method form here




    /**
     * @param Genres $genres
     * @Route("/genres/{id}", name="genres_show")
     * @return Response
     */
    public function showGenres(Genres $genres){

        return $this->render(
            'genres/detail.html.twig',
            ['genres'=>$genres]
        );
    }
}
