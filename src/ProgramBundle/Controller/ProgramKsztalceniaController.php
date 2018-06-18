<?php

namespace ProgramBundle\Controller;

use ModelBundle\Entity\ProgramKsztalcenia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Programksztalcenium controller.
 *
 * @Route("programksztalcenia")
 */
class ProgramKsztalceniaController extends Controller
{
    /**
     * Lists all programKsztalcenium entities.
     *
     * @Route("/", name="programksztalcenia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $programKsztalcenias = $em->getRepository('ModelBundle:ProgramKsztalcenia')->findAll();

        return $this->render('@Program/programksztalcenia/index.html.twig', array(
            'programKsztalcenias' => $programKsztalcenias,
        ));
    }

    /**
     * Creates a new programKsztalcenium entity.
     *
     * @Route("/new", name="programksztalcenia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $programKsztalcenium = new Programksztalcenium();
        $form = $this->createForm('ModelBundle\Form\ProgramKsztalceniaType', $programKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($programKsztalcenium);
            $em->flush();

            return $this->redirectToRoute('programksztalcenia_show', array('id' => $programKsztalcenium->getId()));
        }

        return $this->render('@Program/programksztalcenia/new.html.twig', array(
            'programKsztalcenium' => $programKsztalcenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a programKsztalcenium entity.
     *
     * @Route("/{id}", name="programksztalcenia_show")
     * @Method("GET")
     */
    public function showAction(ProgramKsztalcenia $programKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($programKsztalcenium);

        return $this->render('@Program/programksztalcenia/show.html.twig', array(
            'programKsztalcenium' => $programKsztalcenium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing programKsztalcenium entity.
     *
     * @Route("/{id}/edit", name="programksztalcenia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProgramKsztalcenia $programKsztalcenium)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($programKsztalcenium);
        $editForm = $this->createForm('ModelBundle\Form\ProgramKsztalceniaType', $programKsztalcenium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('programksztalcenia_edit', array('id' => $programKsztalcenium->getId()));
        }

        return $this->render('@Program/programksztalcenia/edit.html.twig', array(
            'programKsztalcenium' => $programKsztalcenium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a programKsztalcenium entity.
     *
     * @Route("/{id}", name="programksztalcenia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProgramKsztalcenia $programKsztalcenium)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($programKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($programKsztalcenium);
            $em->flush();
        }

        return $this->redirectToRoute('programksztalcenia_index');
    }

    /**
     * Creates a form to delete a programKsztalcenium entity.
     *
     * @param ProgramKsztalcenia $programKsztalcenium The programKsztalcenium entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(ProgramKsztalcenia $programKsztalcenium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('programksztalcenia_delete', array('id' => $programKsztalcenium->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
