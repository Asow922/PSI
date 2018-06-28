<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\ObszarKsztalcenia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Obszarksztalcenium controller.
 *
 * @Route("enum_obszarksztalcenia")
 */
class ObszarKsztalceniaController extends Controller
{
    /**
     * Lists all obszarKsztalcenium entities.
     *
     * @Route("/", name="enum_obszarksztalcenia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $obszarKsztalcenias = $em->getRepository('ModelBundle:Enum\ObszarKsztalcenia')->findAll();

        return $this->render('enum/obszarksztalcenia/index.html.twig', array(
            'obszarKsztalcenias' => $obszarKsztalcenias,
        ));
    }

    /**
     * Creates a new obszarKsztalcenium entity.
     *
     * @Route("/new", name="enum_obszarksztalcenia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $obszarKsztalcenium = new Obszarksztalcenium();
        $form = $this->createForm('ModelBundle\Form\Enum\ObszarKsztalceniaType', $obszarKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($obszarKsztalcenium);
            $em->flush();

            return $this->redirectToRoute('enum_obszarksztalcenia_show', array('id' => $obszarKsztalcenium->getId()));
        }

        return $this->render('enum/obszarksztalcenia/new.html.twig', array(
            'obszarKsztalcenium' => $obszarKsztalcenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a obszarKsztalcenium entity.
     *
     * @Route("/{id}", name="enum_obszarksztalcenia_show")
     * @Method("GET")
     */
    public function showAction(ObszarKsztalcenia $obszarKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($obszarKsztalcenium);

        return $this->render('enum/obszarksztalcenia/show.html.twig', array(
            'obszarKsztalcenium' => $obszarKsztalcenium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing obszarKsztalcenium entity.
     *
     * @Route("/{id}/edit", name="enum_obszarksztalcenia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ObszarKsztalcenia $obszarKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($obszarKsztalcenium);
        $editForm = $this->createForm('ModelBundle\Form\Enum\ObszarKsztalceniaType', $obszarKsztalcenium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_obszarksztalcenia_edit', array('id' => $obszarKsztalcenium->getId()));
        }

        return $this->render('enum/obszarksztalcenia/edit.html.twig', array(
            'obszarKsztalcenium' => $obszarKsztalcenium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a obszarKsztalcenium entity.
     *
     * @Route("/{id}", name="enum_obszarksztalcenia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ObszarKsztalcenia $obszarKsztalcenium)
    {
        $form = $this->createDeleteForm($obszarKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($obszarKsztalcenium);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a obszarKsztalcenium entity.
     *
     * @param ObszarKsztalcenia $obszarKsztalcenium The obszarKsztalcenium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ObszarKsztalcenia $obszarKsztalcenium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_obszarksztalcenia_delete', array('id' => $obszarKsztalcenium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
