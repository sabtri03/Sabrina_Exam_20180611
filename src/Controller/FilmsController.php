<?php

namespace App\Controller;

use App\Entity\Films;
use App\Form\FilmsType;
use App\Services\FixturesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
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
     * @Route("/", name="homeAction")
     */
    public function homeAction(){
        $repository = $this->getDoctrine()
            ->getRepository(Films::class);

        $films = $repository->findAll();

        return $this->render(
            'films/index.html.twig',
            ['films' => $films]
        );
    }

    /**
     * @param FixturesManager $fm
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("films/add", name="films_add")
     */
    public function add( FixturesManager $fm ) {

        $repository = $this->getDoctrine()
            ->getRepository(Films::class);
        $films = $repository->findAll();

        $em = $this->getDoctrine()->getManager();
        for($i = 0; $i < 2; $i++){
            $films = new Films();
            $films->setTitle($fm->getFaker()->words(rand(2, 4), true));
            $films->setResume($fm->getFaker()->paragraph(3));
            $films->setDateSortie($fm->getFaker()->dateTime($max = 'now', $timezone = null) );
            $films->setProduction($fm->getFaker()->name);
            $films->setRealisateur($fm->getFaker()->name);
            $em->persist($films);
        }
        $em->flush();

        return $this->redirectToRoute('homeAction');
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/films/form", name="films_form")
     */
    public function AddForm( Request $request ) {

        $films = new Films();
        $form = $this->createForm(FilmsType::class, $films);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($films);
            $em->flush();
            return $this->redirectToRoute('homeAction');
        }

        return $this->render('films/form.html.twig',
            ['form'=>$form->createView()]
        );
    }


    /**
     * @Route("/films/{id}", name="films_show")
     */
    public function showFilms(Films $films){

        return $this->render(
            'films/detail.html.twig',
            ['films'=>$films]
        );
    }


}
