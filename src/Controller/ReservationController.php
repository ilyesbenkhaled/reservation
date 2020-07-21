<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PaxType;
use App\Form\ChildType;
use App\Form\ChambreType;
use App\Repository\PaxRepository;
use App\Repository\ChambreRepository;
use App\Entity\Pax;
use App\Entity\Child;
use App\Entity\Chambre;
use Symfony\Component\Validator\Constraints\DateTime;

    /**
     * @Route("/reservation", name="reservation")
     */

class ReservationController extends AbstractController
{


    /**
     *  @Route("/step1", name="step1", methods={"GET", "POST"})
     */

    public function step1(Request $request)
    { 	

    	$child = new Child();
    	$date = date("Y");
        $pax = new Pax();
        $form = $this->createForm(PaxType::class, $pax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$data = $form->getData();
        	$pax = $pax->setStep(1);
        	// $child = $child->setFatherName();
        	// $x = $data->getFirstName();
        	 // dd($x);
        	$dateM = $data->getDateDeNaissance()->format('Y');
        	$dateN = substr($dateM, 0, 4);
            $age = $date - $dateN;
            $pax = $pax->setAge($age);
            if($age >= 18){
            $pax = $pax->setTranche('adulte');
            } else{
        	 $pax = $pax->setTranche('enfant');
             }  
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pax);
            $entityManager->flush();

            return $this->redirectToRoute('reservationstep2', [
                'id' => $pax->getId()] );
             $this->addFlash("succes", "Vous vous êtes inscrit sur ce site");
        }

        return $this->render('reservation/step1.html.twig', [
            'pax' => $pax,
            'form' => $form->createView(),
        ]); 
    	
    }


    /**
     *  @Route("/step2/{id}", name="step2", methods={"GET", "POST"})
     */

    public function step2(Pax $pax, Request $request)
    {
        $age = $pax->getAge();
        if($age < 18)
        {
        	$this->addFlash('warning', 'forbidden to book a room for a single child, Pease click here to comeback');
        }
        $chambre = new Chambre();
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$chambre = $chambre->setStep(2);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chambre);
            $entityManager->flush();

            return $this->redirectToRoute('reservationstep2', [
            	'id' => $pax->getId() ]);
        }

        return $this->render('reservation/step2.html.twig', [
            'chambre' => $chambre,
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     */
    public function index(PaxRepository $paxRepository, ChambreRepository $chambreRepository): Response
    {
        return $this->render('pax/index.html.twig', [
            'paxes' => $paxRepository->findAll(),
            'rooms' => $chambreRepository->findAll(),
            // 'id' => $pax->getId(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pax $pax, Chambre $chambre): Response
    {
        $form = $this->createForm(PaxType::class, $pax, ChambreType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservationlist');
        }

        return $this->render('pax/edit.html.twig', [
            'pax' => $pax,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pax_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pax $pax): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pax->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pax);
            $entityManager->flush();
            $this->addFlash('success', 'Le commentaire a bien été supprimé');
        }

        return $this->redirectToRoute('reservationlist');
    }

}
