<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PaxType;
use App\Form\ChambreType;
use App\Entity\Pax;
use App\Entity\Chambre;

    /**
     * @Route("/reservation", name="reservation")
     */

class ReservationController extends AbstractController
{


    /**
     *  @Route("/step1", name="step1")
     */

    public function step1(Request $request)
    {


        $pax = new Pax();
        $form = $this->createForm(PaxType::class, $pax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$pax = $pax->setStep(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pax);
            $entityManager->flush();

            return $this->redirectToRoute('reservationstep2');
             $this->addFlash("succes", "Vous vous êtes inscrit sur ce site");
        }

        return $this->render('reservation/step1.html.twig', [
            'pax' => $pax,
            'form' => $form->createView(),
        ]); 
    	
    }


    /**
     *  @Route("/step2", name="step2")
     */

    public function step2(Request $request)
    {

        $chambre = new Chambre();
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$chambre = $chambre->setStep(2);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chambre);
            $entityManager->flush();

            return $this->redirectToRoute('reservationstep2');
        }

        return $this->render('reservation/step2.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);


    }

}
