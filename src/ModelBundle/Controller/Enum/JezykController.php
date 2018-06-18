<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\Jezyk;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Jezyk controller.
 *
 * @Route("enum_jezyk")
 */
class JezykController extends Controller
{
    /**
     * Lists all jezyk entities.
     *
     * @Route("/", name="enum_jezyk_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jezyks = $em->getRepository('ModelBundle:Enum\Jezyk')->findAll();

        return $this->render('enum/jezyk/index.html.twig', array(
            'jezyks' => $jezyks,
        ));
    }

    /**
     * Creates a new jezyk entity.
     *
     * @Route("/new", name="enum_jezyk_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jezyk = new Jezyk();
        $form = $this->createForm('ModelBundle\Form\Enum\JezykType', $jezyk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jezyk);
            $em->flush();

            return $this->redirectToRoute('enum_jezyk_show', array('id' => $jezyk->getId()));
        }

        return $this->render('enum/jezyk/new.html.twig', array(
            'jezyk' => $jezyk,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jezyk entity.
     *
     * @Route("/{id}", name="enum_jezyk_show")
     * @Method("GET")
     */
    public function showAction(Jezyk $jezyk)
    {
        $deleteForm = $this->createDeleteForm($jezyk);

        return $this->render('enum/jezyk/show.html.twig', array(
            'jezyk' => $jezyk,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jezyk entity.
     *
     * @Route("/{id}/edit", name="enum_jezyk_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Jezyk $jezyk)
    {
        $deleteForm = $this->createDeleteForm($jezyk);
        $editForm = $this->createForm('ModelBundle\Form\Enum\JezykType', $jezyk);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_jezyk_edit', array('id' => $jezyk->getId()));
        }

        return $this->render('enum/jezyk/edit.html.twig', array(
            'jezyk' => $jezyk,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jezyk entity.
     *
     * @Route("/{id}", name="enum_jezyk_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Jezyk $jezyk)
    {
        $form = $this->createDeleteForm($jezyk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jezyk);
            $em->flush();
        }

        return $this->redirectToRoute('enum_jezyk_index');
    }

    /**
     * Creates a form to delete a jezyk entity.
     *
     * @param Jezyk $jezyk The jezyk entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jezyk $jezyk)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_jezyk_delete', array('id' => $jezyk->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
