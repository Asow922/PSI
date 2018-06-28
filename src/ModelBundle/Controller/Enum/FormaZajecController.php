<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\FormaZajec;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formazajec controller.
 *
 * @Route("enum_formazajec")
 */
class FormaZajecController extends Controller
{
    /**
     * Lists all formaZajec entities.
     *
     * @Route("/", name="enum_formazajec_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formaZajecs = $em->getRepository('ModelBundle:Enum\FormaZajec')->findAll();

        return $this->render('enum/formazajec/index.html.twig', array(
            'formaZajecs' => $formaZajecs,
        ));
    }

    /**
     * Creates a new formaZajec entity.
     *
     * @Route("/new", name="enum_formazajec_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formaZajec = new Formazajec();
        $form = $this->createForm('ModelBundle\Form\Enum\FormaZajecType', $formaZajec);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formaZajec);
            $em->flush();

            return $this->redirectToRoute('enum_formazajec_show', array('id' => $formaZajec->getId()));
        }

        return $this->render('enum/formazajec/new.html.twig', array(
            'formaZajec' => $formaZajec,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formaZajec entity.
     *
     * @Route("/{id}", name="enum_formazajec_show")
     * @Method("GET")
     */
    public function showAction(FormaZajec $formaZajec)
    {
        $deleteForm = $this->createDeleteForm($formaZajec);

        return $this->render('enum/formazajec/show.html.twig', array(
            'formaZajec' => $formaZajec,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing formaZajec entity.
     *
     * @Route("/{id}/edit", name="enum_formazajec_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FormaZajec $formaZajec)
    {
        $deleteForm = $this->createDeleteForm($formaZajec);
        $editForm = $this->createForm('ModelBundle\Form\Enum\FormaZajecType', $formaZajec);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_formazajec_edit', array('id' => $formaZajec->getId()));
        }

        return $this->render('enum/formazajec/edit.html.twig', array(
            'formaZajec' => $formaZajec,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formaZajec entity.
     *
     * @Route("/{id}", name="enum_formazajec_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FormaZajec $formaZajec)
    {
        $form = $this->createDeleteForm($formaZajec);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formaZajec);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a formaZajec entity.
     *
     * @param FormaZajec $formaZajec The formaZajec entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormaZajec $formaZajec)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_formazajec_delete', array('id' => $formaZajec->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
