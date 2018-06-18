<?php

namespace PrzedmiotBundle\Controller;

use ModelBundle\Entity\Kurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Kurs controller.
 *
 * @Route("kurs")
 */
class KursController extends Controller
{
    /**
     * Lists all kurs entities.
     *
     * @Route("/", name="kurs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kurs = $em->getRepository('ModelBundle:Kurs')->findAll();

        return $this->render('@Przedmiot/kurs/index.html.twig', array(
            'kurs' => $kurs,
        ));
    }

    /**
     * Creates a new kurs entity.
     *
     * @Route("/new", name="kurs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $kurs = new Kurs();
        $form = $this->createForm('ModelBundle\Form\KursType', $kurs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kurs);
            $em->flush();

            return $this->redirectToRoute('kurs_show', array('id' => $kurs->getId()));
        }

        return $this->render('@Przedmiot/kurs/new.html.twig', array(
            'kurs' => $kurs,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kurs entity.
     *
     * @Route("/{id}", name="kurs_show")
     * @Method("GET")
     */
    public function showAction(Kurs $kurs)
    {
        $deleteForm = $this->createDeleteForm($kurs);

        return $this->render('@Przedmiot/kurs/show.html.twig', array(
            'kurs' => $kurs,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kur entity.
     *
     * @Route("/{id}/edit", name="kurs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Kurs $kurs)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($kurs);
        $editForm = $this->createForm('ModelBundle\Form\KursType', $kurs);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kurs_edit', array('id' => $kurs->getId()));
        }

        return $this->render('@Przedmiot/kurs/edit.html.twig', array(
            'kurs' => $kurs,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kurs entity.
     *
     * @Route("/{id}", name="kurs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Kurs $kurs)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($kurs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kurs);
            $em->flush();
        }

        return $this->redirectToRoute('kurs_index');
    }

    /**
     * Creates a form to delete a kur entity.
     *
     * @param Kurs $kurs The kurs entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Kurs $kur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kurs_delete', array('id' => $kur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
