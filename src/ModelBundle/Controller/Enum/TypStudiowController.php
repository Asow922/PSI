<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\TypStudiow;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Typstudiow controller.
 *
 * @Route("enum_typstudiow")
 */
class TypStudiowController extends Controller
{
    /**
     * Lists all typStudiow entities.
     *
     * @Route("/", name="enum_typstudiow_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $typStudiows = $em->getRepository('ModelBundle:Enum\TypStudiow')->findAll();

        return $this->render('enum/typstudiow/index.html.twig', array(
            'typStudiows' => $typStudiows,
        ));
    }

    /**
     * Creates a new typStudiow entity.
     *
     * @Route("/new", name="enum_typstudiow_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $typStudiow = new Typstudiow();
        $form = $this->createForm('ModelBundle\Form\Enum\TypStudiowType', $typStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typStudiow);
            $em->flush();

            return $this->redirectToRoute('enum_typstudiow_show', array('id' => $typStudiow->getId()));
        }

        return $this->render('enum/typstudiow/new.html.twig', array(
            'typStudiow' => $typStudiow,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typStudiow entity.
     *
     * @Route("/{id}", name="enum_typstudiow_show")
     * @Method("GET")
     */
    public function showAction(TypStudiow $typStudiow)
    {
        $deleteForm = $this->createDeleteForm($typStudiow);

        return $this->render('enum/typstudiow/show.html.twig', array(
            'typStudiow' => $typStudiow,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typStudiow entity.
     *
     * @Route("/{id}/edit", name="enum_typstudiow_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TypStudiow $typStudiow)
    {
        $deleteForm = $this->createDeleteForm($typStudiow);
        $editForm = $this->createForm('ModelBundle\Form\Enum\TypStudiowType', $typStudiow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_typstudiow_edit', array('id' => $typStudiow->getId()));
        }

        return $this->render('enum/typstudiow/edit.html.twig', array(
            'typStudiow' => $typStudiow,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typStudiow entity.
     *
     * @Route("/{id}", name="enum_typstudiow_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TypStudiow $typStudiow)
    {
        $form = $this->createDeleteForm($typStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typStudiow);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a typStudiow entity.
     *
     * @param TypStudiow $typStudiow The typStudiow entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypStudiow $typStudiow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_typstudiow_delete', array('id' => $typStudiow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
