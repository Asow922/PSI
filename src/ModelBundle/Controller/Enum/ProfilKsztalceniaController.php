<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\ProfilKsztalcenia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Profilksztalcenium controller.
 *
 * @Route("enum_profilksztalcenia")
 */
class ProfilKsztalceniaController extends Controller
{
    /**
     * Lists all profilKsztalcenium entities.
     *
     * @Route("/", name="enum_profilksztalcenia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $profilKsztalcenias = $em->getRepository('ModelBundle:Enum\ProfilKsztalcenia')->findAll();

        return $this->render('enum/profilksztalcenia/index.html.twig', array(
            'profilKsztalcenias' => $profilKsztalcenias,
        ));
    }

    /**
     * Creates a new profilKsztalcenium entity.
     *
     * @Route("/new", name="enum_profilksztalcenia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $profilKsztalcenium = new Profilksztalcenium();
        $form = $this->createForm('ModelBundle\Form\Enum\ProfilKsztalceniaType', $profilKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profilKsztalcenium);
            $em->flush();

            return $this->redirectToRoute('enum_profilksztalcenia_show', array('id' => $profilKsztalcenium->getId()));
        }

        return $this->render('enum/profilksztalcenia/new.html.twig', array(
            'profilKsztalcenium' => $profilKsztalcenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a profilKsztalcenium entity.
     *
     * @Route("/{id}", name="enum_profilksztalcenia_show")
     * @Method("GET")
     */
    public function showAction(ProfilKsztalcenia $profilKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($profilKsztalcenium);

        return $this->render('enum/profilksztalcenia/show.html.twig', array(
            'profilKsztalcenium' => $profilKsztalcenium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing profilKsztalcenium entity.
     *
     * @Route("/{id}/edit", name="enum_profilksztalcenia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProfilKsztalcenia $profilKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($profilKsztalcenium);
        $editForm = $this->createForm('ModelBundle\Form\Enum\ProfilKsztalceniaType', $profilKsztalcenium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_profilksztalcenia_edit', array('id' => $profilKsztalcenium->getId()));
        }

        return $this->render('enum/profilksztalcenia/edit.html.twig', array(
            'profilKsztalcenium' => $profilKsztalcenium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a profilKsztalcenium entity.
     *
     * @Route("/{id}", name="enum_profilksztalcenia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProfilKsztalcenia $profilKsztalcenium)
    {
        $form = $this->createDeleteForm($profilKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profilKsztalcenium);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a profilKsztalcenium entity.
     *
     * @param ProfilKsztalcenia $profilKsztalcenium The profilKsztalcenium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProfilKsztalcenia $profilKsztalcenium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_profilksztalcenia_delete', array('id' => $profilKsztalcenium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
