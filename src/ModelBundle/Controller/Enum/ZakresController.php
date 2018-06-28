<?php

namespace ModelBundle\Controller\Enum;

use ModelBundle\Entity\Enum\Zakres;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Zakre controller.
 *
 * @Route("enum_zakres")
 */
class ZakresController extends Controller
{
    /**
     * Lists all zakre entities.
     *
     * @Route("/", name="enum_zakres_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $zakres = $em->getRepository('ModelBundle:Enum\Zakres')->findAll();

        return $this->render('enum/zakres/index.html.twig', array(
            'zakres' => $zakres,
        ));
    }

    /**
     * Creates a new zakre entity.
     *
     * @Route("/new", name="enum_zakres_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $zakre = new Zakre();
        $form = $this->createForm('ModelBundle\Form\Enum\ZakresType', $zakre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zakre);
            $em->flush();

            return $this->redirectToRoute('enum_zakres_show', array('id' => $zakre->getId()));
        }

        return $this->render('enum/zakres/new.html.twig', array(
            'zakre' => $zakre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a zakre entity.
     *
     * @Route("/{id}", name="enum_zakres_show")
     * @Method("GET")
     */
    public function showAction(Zakres $zakre)
    {
        $deleteForm = $this->createDeleteForm($zakre);

        return $this->render('enum/zakres/show.html.twig', array(
            'zakre' => $zakre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing zakre entity.
     *
     * @Route("/{id}/edit", name="enum_zakres_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Zakres $zakre)
    {
        $deleteForm = $this->createDeleteForm($zakre);
        $editForm = $this->createForm('ModelBundle\Form\Enum\ZakresType', $zakre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enum_zakres_edit', array('id' => $zakre->getId()));
        }

        return $this->render('enum/zakres/edit.html.twig', array(
            'zakre' => $zakre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a zakre entity.
     *
     * @Route("/{id}", name="enum_zakres_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Zakres $zakre)
    {
        $form = $this->createDeleteForm($zakre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($zakre);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a zakre entity.
     *
     * @param Zakres $zakre The zakre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Zakres $zakre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enum_zakres_delete', array('id' => $zakre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
