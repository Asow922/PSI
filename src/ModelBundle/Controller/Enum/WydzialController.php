<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\Wydzial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Wydzial controller.
 *
 * @Route("enum_wydzial")
 */
class WydzialController extends Controller
{
    /**
     * Lists all wydzial entities.
     *
     * @Route("/", name="enum_wydzial_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $wydzials = $em->getRepository('ModelBundle:Enum\Wydzial')->findAll();

        return $this->render('enum/wydzial/index.html.twig', array(
            'wydzials' => $wydzials,
        ));
    }

    /**
     * Creates a new wydzial entity.
     *
     * @Route("/new", name="enum_wydzial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wydzial = new Wydzial();
        $form = $this->createForm('ModelBundle\Form\Enum\WydzialType', $wydzial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wydzial);
            $em->flush();

            return $this->redirectToRoute('enum_wydzial_show', array('id' => $wydzial->getId()));
        }

        return $this->render('enum/wydzial/new.html.twig', array(
            'wydzial' => $wydzial,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a wydzial entity.
     *
     * @Route("/{id}", name="enum_wydzial_show")
     * @Method("GET")
     */
    public function showAction(Wydzial $wydzial)
    {
        $deleteForm = $this->createDeleteForm($wydzial);

        return $this->render('enum/wydzial/show.html.twig', array(
            'wydzial' => $wydzial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wydzial entity.
     *
     * @Route("/{id}/edit", name="enum_wydzial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Wydzial $wydzial)
    {
        $deleteForm = $this->createDeleteForm($wydzial);
        $editForm = $this->createForm('ModelBundle\Form\Enum\WydzialType', $wydzial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_wydzial_edit', array('id' => $wydzial->getId()));
        }

        return $this->render('enum/wydzial/edit.html.twig', array(
            'wydzial' => $wydzial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a wydzial entity.
     *
     * @Route("/{id}", name="enum_wydzial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Wydzial $wydzial)
    {
        $form = $this->createDeleteForm($wydzial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wydzial);
            $em->flush();
        }

        return $this->redirectToRoute('enum_wydzial_index');
    }

    /**
     * Creates a form to delete a wydzial entity.
     *
     * @param Wydzial $wydzial The wydzial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Wydzial $wydzial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_wydzial_delete', array('id' => $wydzial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
