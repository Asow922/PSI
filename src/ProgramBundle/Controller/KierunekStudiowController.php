<?php

namespace ProgramBundle\Controller;

use ModelBundle\Entity\KierunekStudiow;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Kierunekstudiow controller.
 *
 * @Route("kierunekstudiow")
 */
class KierunekStudiowController extends Controller
{
    /**
     * Lists all kierunekStudiow entities.
     *
     * @Route("/", name="kierunekstudiow_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kierunekStudiows = $em->getRepository('ModelBundle:KierunekStudiow')->findAll();

        return $this->render('@Program/kierunekstudiow/index.html.twig', array(
            'kierunekStudiows' => $kierunekStudiows,
        ));
    }

    /**
     * Creates a new kierunekStudiow entity.
     *
     * @Route("/new", name="kierunekstudiow_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $kierunekStudiow = new Kierunekstudiow();
        $form = $this->createForm('ModelBundle\Form\KierunekStudiowType', $kierunekStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kierunekStudiow);
            $em->flush();

            return $this->redirectToRoute('kierunekstudiow_show', array('id' => $kierunekStudiow->getId()));
        }

        return $this->render('@Program/kierunekstudiow/new.html.twig', array(
            'kierunekStudiow' => $kierunekStudiow,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kierunekStudiow entity.
     *
     * @Route("/{id}", name="kierunekstudiow_show")
     * @Method("GET")
     */
    public function showAction(KierunekStudiow $kierunekStudiow)
    {
        $deleteForm = $this->createDeleteForm($kierunekStudiow);

        return $this->render('@Program/kierunekstudiow/show.html.twig', array(
            'kierunekStudiow' => $kierunekStudiow,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kierunekStudiow entity.
     *
     * @Route("/{id}/edit", name="kierunekstudiow_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, KierunekStudiow $kierunekStudiow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($kierunekStudiow);
        $editForm = $this->createForm('ModelBundle\Form\KierunekStudiowType', $kierunekStudiow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kierunekstudiow_edit', array('id' => $kierunekStudiow->getId()));
        }

        return $this->render('@Program/kierunekstudiow/edit.html.twig', array(
            'kierunekStudiow' => $kierunekStudiow,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kierunekStudiow entity.
     *
     * @Route("/{id}", name="kierunekstudiow_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, KierunekStudiow $kierunekStudiow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($kierunekStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kierunekStudiow);
            $em->flush();
        }

        return $this->redirectToRoute('kierunekstudiow_index');
    }

    /**
     * Creates a form to delete a kierunekStudiow entity.
     *
     * @param KierunekStudiow $kierunekStudiow The kierunekStudiow entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(KierunekStudiow $kierunekStudiow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kierunekstudiow_delete', array('id' => $kierunekStudiow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
