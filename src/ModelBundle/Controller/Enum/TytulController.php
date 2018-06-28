<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\Tytul;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tytul controller.
 *
 * @Route("enum_tytul")
 */
class TytulController extends Controller
{
    /**
     * Lists all tytul entities.
     *
     * @Route("/", name="enum_tytul_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tytuls = $em->getRepository('ModelBundle:Enum\Tytul')->findAll();

        return $this->render('enum/tytul/index.html.twig', array(
            'tytuls' => $tytuls,
        ));
    }

    /**
     * Creates a new tytul entity.
     *
     * @Route("/new", name="enum_tytul_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tytul = new Tytul();
        $form = $this->createForm('ModelBundle\Form\Enum\TytulType', $tytul);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tytul);
            $em->flush();

            return $this->redirectToRoute('enum_tytul_show', array('id' => $tytul->getId()));
        }

        return $this->render('enum/tytul/new.html.twig', array(
            'tytul' => $tytul,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tytul entity.
     *
     * @Route("/{id}", name="enum_tytul_show")
     * @Method("GET")
     */
    public function showAction(Tytul $tytul)
    {
        $deleteForm = $this->createDeleteForm($tytul);

        return $this->render('enum/tytul/show.html.twig', array(
            'tytul' => $tytul,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tytul entity.
     *
     * @Route("/{id}/edit", name="enum_tytul_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tytul $tytul)
    {
        $deleteForm = $this->createDeleteForm($tytul);
        $editForm = $this->createForm('ModelBundle\Form\Enum\TytulType', $tytul);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_tytul_edit', array('id' => $tytul->getId()));
        }

        return $this->render('enum/tytul/edit.html.twig', array(
            'tytul' => $tytul,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tytul entity.
     *
     * @Route("/{id}", name="enum_tytul_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tytul $tytul)
    {
        $form = $this->createDeleteForm($tytul);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tytul);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a tytul entity.
     *
     * @param Tytul $tytul The tytul entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tytul $tytul)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_tytul_delete', array('id' => $tytul->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
