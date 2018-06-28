<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\PoziomKsztalcenia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Poziomksztalcenium controller.
 *
 * @Route("enum_poziomksztalcenia")
 */
class PoziomKsztalceniaController extends Controller
{
    /**
     * Lists all poziomKsztalcenium entities.
     *
     * @Route("/", name="enum_poziomksztalcenia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $poziomKsztalcenias = $em->getRepository('ModelBundle:Enum\PoziomKsztalcenia')->findAll();

        return $this->render('enum/poziomksztalcenia/index.html.twig', array(
            'poziomKsztalcenias' => $poziomKsztalcenias,
        ));
    }

    /**
     * Creates a new poziomKsztalcenium entity.
     *
     * @Route("/new", name="enum_poziomksztalcenia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $poziomKsztalcenium = new Poziomksztalcenium();
        $form = $this->createForm('ModelBundle\Form\Enum\PoziomKsztalceniaType', $poziomKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($poziomKsztalcenium);
            $em->flush();

            return $this->redirectToRoute('enum_poziomksztalcenia_show', array('id' => $poziomKsztalcenium->getId()));
        }

        return $this->render('enum/poziomksztalcenia/new.html.twig', array(
            'poziomKsztalcenium' => $poziomKsztalcenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a poziomKsztalcenium entity.
     *
     * @Route("/{id}", name="enum_poziomksztalcenia_show")
     * @Method("GET")
     */
    public function showAction(PoziomKsztalcenia $poziomKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($poziomKsztalcenium);

        return $this->render('enum/poziomksztalcenia/show.html.twig', array(
            'poziomKsztalcenium' => $poziomKsztalcenium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing poziomKsztalcenium entity.
     *
     * @Route("/{id}/edit", name="enum_poziomksztalcenia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PoziomKsztalcenia $poziomKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($poziomKsztalcenium);
        $editForm = $this->createForm('ModelBundle\Form\Enum\PoziomKsztalceniaType', $poziomKsztalcenium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_poziomksztalcenia_edit', array('id' => $poziomKsztalcenium->getId()));
        }

        return $this->render('enum/poziomksztalcenia/edit.html.twig', array(
            'poziomKsztalcenium' => $poziomKsztalcenium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a poziomKsztalcenium entity.
     *
     * @Route("/{id}", name="enum_poziomksztalcenia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PoziomKsztalcenia $poziomKsztalcenium)
    {
        $form = $this->createDeleteForm($poziomKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($poziomKsztalcenium);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a poziomKsztalcenium entity.
     *
     * @param PoziomKsztalcenia $poziomKsztalcenium The poziomKsztalcenium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PoziomKsztalcenia $poziomKsztalcenium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_poziomksztalcenia_delete', array('id' => $poziomKsztalcenium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
