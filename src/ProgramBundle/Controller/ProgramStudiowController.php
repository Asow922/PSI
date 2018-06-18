<?php

namespace ProgramBundle\Controller;

use ModelBundle\Entity\ProgramStudiow;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Programstudiow controller.
 *
 * @Route("programstudiow")
 */
class ProgramStudiowController extends Controller
{
    /**
     * Lists all programStudiow entities.
     *
     * @Route("/", name="programstudiow_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $programStudiows = $em->getRepository('ModelBundle:ProgramStudiow')->findAll();

        return $this->render('@Program/programstudiow/index.html.twig', array(
            'programStudiows' => $programStudiows,
        ));
    }

    /**
     * Creates a new programStudiow entity.
     *
     * @Route("/new", name="programstudiow_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $programStudiow = new Programstudiow();
        $form = $this->createForm('ModelBundle\Form\ProgramStudiowType', $programStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($programStudiow);
            $em->flush();

            return $this->redirectToRoute('programstudiow_show', array('id' => $programStudiow->getId()));
        }

        return $this->render('@Program/programstudiow/new.html.twig', array(
            'programStudiow' => $programStudiow,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a programStudiow entity.
     *
     * @Route("/{id}", name="programstudiow_show")
     * @Method("GET")
     */
    public function showAction(ProgramStudiow $programStudiow)
    {
        $deleteForm = $this->createDeleteForm($programStudiow);

        return $this->render('@Program/programstudiow/show.html.twig', array(
            'programStudiow' => $programStudiow,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing programStudiow entity.
     *
     * @Route("/{id}/edit", name="programstudiow_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProgramStudiow $programStudiow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($programStudiow);
        $editForm = $this->createForm('ModelBundle\Form\ProgramStudiowType', $programStudiow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('programstudiow_edit', array('id' => $programStudiow->getId()));
        }

        return $this->render('@Program/programstudiow/edit.html.twig', array(
            'programStudiow' => $programStudiow,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a programStudiow entity.
     *
     * @Route("/{id}", name="programstudiow_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProgramStudiow $programStudiow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($programStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($programStudiow);
            $em->flush();
        }

        return $this->redirectToRoute('programstudiow_index');
    }

    /**
     * Creates a form to delete a programStudiow entity.
     *
     * @param ProgramStudiow $programStudiow The programStudiow entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(ProgramStudiow $programStudiow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('programstudiow_delete', array('id' => $programStudiow->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
