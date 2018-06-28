<?php

namespace EfektKsztalceniaBundle\Controller;

use ModelBundle\Entity\EfektKierunkowy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Efektkierunkowy controller.
 *
 * @Route("efektkierunkowy")
 */
class EfektKierunkowyController extends Controller
{
    /**
     * Lists all efektKierunkowy entities.
     *
     * @Route("/", name="efektkierunkowy_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $efektKierunkowies = $em->getRepository('ModelBundle:EfektKierunkowy')->findAll();

        return $this->render('@EfektKsztalcenia/efektkierunkowy/index.html.twig', array(
            'efektKierunkowies' => $efektKierunkowies,
        ));
    }

    /**
     * Creates a new efektKierunkowy entity.
     *
     * @Route("/new", name="efektkierunkowy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $efektKierunkowy = new Efektkierunkowy();
        $form = $this->createForm('ModelBundle\Form\EfektKierunkowyType', $efektKierunkowy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($efektKierunkowy);
            $em->flush();

            return $this->redirectToRoute('efektkierunkowy_show', array('id' => $efektKierunkowy->getId()));
        }

        return $this->render('@EfektKsztalcenia/efektkierunkowy/new.html.twig', array(
            'efektKierunkowy' => $efektKierunkowy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a efektKierunkowy entity.
     *
     * @Route("/{id}", name="efektkierunkowy_show")
     * @Method("GET")
     */
    public function showAction(EfektKierunkowy $efektKierunkowy)
    {
        $deleteForm = $this->createDeleteForm($efektKierunkowy);

        return $this->render('@EfektKsztalcenia/efektkierunkowy/show.html.twig', array(
            'efektKierunkowy' => $efektKierunkowy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing efektKierunkowy entity.
     *
     * @Route("/{id}/edit", name="efektkierunkowy_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EfektKierunkowy $efektKierunkowy)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($efektKierunkowy);
        $editForm = $this->createForm('ModelBundle\Form\EfektKierunkowyType', $efektKierunkowy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('efektkierunkowy_edit', array('id' => $efektKierunkowy->getId()));
        }

        return $this->render('@EfektKsztalcenia/efektkierunkowy/edit.html.twig', array(
            'efektKierunkowy' => $efektKierunkowy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a efektKierunkowy entity.
     *
     * @Route("/{id}", name="efektkierunkowy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EfektKierunkowy $efektKierunkowy)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($efektKierunkowy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($efektKierunkowy);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a efektKierunkowy entity.
     *
     * @param EfektKierunkowy $efektKierunkowy The efektKierunkowy entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(EfektKierunkowy $efektKierunkowy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('efektkierunkowy_delete', array('id' => $efektKierunkowy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
