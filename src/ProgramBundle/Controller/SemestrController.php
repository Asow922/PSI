<?php

namespace ProgramBundle\Controller;

use ModelBundle\Entity\Semestr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Semestr controller.
 *
 * @Route("semestr")
 */
class SemestrController extends Controller
{
    /**
     * Lists all semestr entities.
     *
     * @Route("/", name="semestr_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $semestrs = $em->getRepository('ModelBundle:Semestr')->findAll();

        return $this->render('@Program/semestr/index.html.twig', array(
            'semestrs' => $semestrs,
        ));
    }

    /**
     * Creates a new semestr entity.
     *
     * @Route("/new", name="semestr_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $semestr = new Semestr();
        $form = $this->createForm('ModelBundle\Form\SemestrType', $semestr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($semestr);
            $em->flush();

            return $this->redirectToRoute('semestr_show', array('id' => $semestr->getId()));
        }

        return $this->render('@Program/semestr/new.html.twig', array(
            'semestr' => $semestr,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a semestr entity.
     *
     * @Route("/{id}", name="semestr_show")
     * @Method("GET")
     */
    public function showAction(Semestr $semestr)
    {
        $deleteForm = $this->createDeleteForm($semestr);

        return $this->render('@Program/semestr/show.html.twig', array(
            'semestr' => $semestr,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing semestr entity.
     *
     * @Route("/{id}/edit", name="semestr_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Semestr $semestr)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($semestr);
        $editForm = $this->createForm('ModelBundle\Form\SemestrType', $semestr);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('semestr_edit', array('id' => $semestr->getId()));
        }

        return $this->render('@Program/semestr/edit.html.twig', array(
            'semestr' => $semestr,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a semestr entity.
     *
     * @Route("/{id}", name="semestr_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Semestr $semestr)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($semestr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($semestr);
            $em->flush();
        }

        return $this->redirectToRoute('semestr_index');
    }

    /**
     * Creates a form to delete a semestr entity.
     *
     * @param Semestr $semestr The semestr entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Semestr $semestr)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('semestr_delete', array('id' => $semestr->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
