<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\SposobZaliczenia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sposobzaliczenium controller.
 *
 * @Route("enum_sposobzaliczenia")
 */
class SposobZaliczeniaController extends Controller
{
    /**
     * Lists all sposobZaliczenium entities.
     *
     * @Route("/", name="enum_sposobzaliczenia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sposobZaliczenias = $em->getRepository('ModelBundle:Enum\SposobZaliczenia')->findAll();

        return $this->render('enum/sposobzaliczenia/index.html.twig', array(
            'sposobZaliczenias' => $sposobZaliczenias,
        ));
    }

    /**
     * Creates a new sposobZaliczenium entity.
     *
     * @Route("/new", name="enum_sposobzaliczenia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sposobZaliczenium = new Sposobzaliczenium();
        $form = $this->createForm('ModelBundle\Form\Enum\SposobZaliczeniaType', $sposobZaliczenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sposobZaliczenium);
            $em->flush();

            return $this->redirectToRoute('enum_sposobzaliczenia_show', array('id' => $sposobZaliczenium->getId()));
        }

        return $this->render('enum/sposobzaliczenia/new.html.twig', array(
            'sposobZaliczenium' => $sposobZaliczenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sposobZaliczenium entity.
     *
     * @Route("/{id}", name="enum_sposobzaliczenia_show")
     * @Method("GET")
     */
    public function showAction(SposobZaliczenia $sposobZaliczenium)
    {
        $deleteForm = $this->createDeleteForm($sposobZaliczenium);

        return $this->render('enum/sposobzaliczenia/show.html.twig', array(
            'sposobZaliczenium' => $sposobZaliczenium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sposobZaliczenium entity.
     *
     * @Route("/{id}/edit", name="enum_sposobzaliczenia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SposobZaliczenia $sposobZaliczenium)
    {
        $deleteForm = $this->createDeleteForm($sposobZaliczenium);
        $editForm = $this->createForm('ModelBundle\Form\Enum\SposobZaliczeniaType', $sposobZaliczenium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_sposobzaliczenia_edit', array('id' => $sposobZaliczenium->getId()));
        }

        return $this->render('enum/sposobzaliczenia/edit.html.twig', array(
            'sposobZaliczenium' => $sposobZaliczenium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sposobZaliczenium entity.
     *
     * @Route("/{id}", name="enum_sposobzaliczenia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SposobZaliczenia $sposobZaliczenium)
    {
        $form = $this->createDeleteForm($sposobZaliczenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sposobZaliczenium);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a sposobZaliczenium entity.
     *
     * @param SposobZaliczenia $sposobZaliczenium The sposobZaliczenium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SposobZaliczenia $sposobZaliczenium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_sposobzaliczenia_delete', array('id' => $sposobZaliczenium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
