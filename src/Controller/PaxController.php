<?php

namespace App\Controller;

use App\Entity\Pax;
use App\Form\PaxType;
use App\Repository\PaxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pax")
 */
class PaxController extends AbstractController
{

    /**
     * @Route("/new", name="pax_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pax = new Pax();
        $form = $this->createForm(PaxType::class, $pax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pax);
            $entityManager->flush();

            return $this->redirectToRoute('pax_index');
        }

        return $this->render('pax/new.html.twig', [
            'pax' => $pax,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pax_show", methods={"GET"})
     */
    public function show(Pax $pax): Response
    {
        return $this->render('pax/show.html.twig', [
            'pax' => $pax,
        ]);
    }



    // /**
    //  * @Route("/{id}", name="pax_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Pax $pax): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$pax->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($pax);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('pax_index');
    // }
}
