<?php

namespace PrzedmiotBundle\Controller;

use ModelBundle\Entity\Przedmiot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Przedmiot controller.
 *
 * @Route("przedmiot")
 */
class PrzedmiotController extends Controller
{
    /**
     * Lists all przedmiot entities.
     *
     * @Route("/", name="przedmiot_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $przedmiots = $em->getRepository('ModelBundle:Przedmiot')->findAll();

        return $this->render('@Przedmiot/przedmiot/index.html.twig', array(
            'przedmiots' => $przedmiots,
        ));
    }

    /**
     * Creates a new przedmiot entity.
     *
     * @Route("/new", name="przedmiot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $przedmiot = new Przedmiot();
        $form = $this->createForm('ModelBundle\Form\PrzedmiotType', $przedmiot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($przedmiot);
            $em->flush();

            return $this->redirectToRoute('przedmiot_show', array('id' => $przedmiot->getId()));
        }

        return $this->render('@Przedmiot/przedmiot/new.html.twig', array(
            'przedmiot' => $przedmiot,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a przedmiot entity.
     *
     * @Route("/{id}", name="przedmiot_show")
     * @Method("GET")
     */
    public function showAction(Przedmiot $przedmiot)
    {
        $deleteForm = $this->createDeleteForm($przedmiot);

        return $this->render('@Przedmiot/przedmiot/show.html.twig', array(
            'przedmiot' => $przedmiot,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing przedmiot entity.
     *
     * @Route("/{id}/edit", name="przedmiot_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Przedmiot $przedmiot)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($przedmiot);
        $editForm = $this->createForm('ModelBundle\Form\PrzedmiotType', $przedmiot);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('przedmiot_edit', array('id' => $przedmiot->getId()));
        }

        return $this->render('@Przedmiot/przedmiot/edit.html.twig', array(
            'przedmiot' => $przedmiot,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a przedmiot entity.
     *
     * @Route("/{id}", name="przedmiot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Przedmiot $przedmiot)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($przedmiot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($przedmiot);
            $em->flush();
        }

        return $this->redirectToRoute('przedmiot_index');
    }

    /**
     * Creates a form to delete a przedmiot entity.
     *
     * @param Przedmiot $przedmiot The przedmiot entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Przedmiot $przedmiot)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('przedmiot_delete', array('id' => $przedmiot->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
