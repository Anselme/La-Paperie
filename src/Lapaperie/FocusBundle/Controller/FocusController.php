<?php

namespace Lapaperie\FocusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\FocusBundle\Entity\Focus;
use Lapaperie\FocusBundle\Form\FocusType;

/**
 * Focus controller.
 *
 * @Route("/admin/focus")
 */
class FocusController extends Controller
{
    /**
     * Lists all Focus entities.
     *
     * @Route("/", name="focus")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperieFocusBundle:Focus')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Displays a form to create a new Focus entity.
     *
     * @Route("/new", name="focus_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Focus();
        $form   = $this->createForm(new FocusType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Focus entity.
     *
     * @Route("/create", name="focus_create")
     * @Method("post")
     * @Template("LapaperieFocusBundle:Focus:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Focus();
        $request = $this->getRequest();
        $form    = $this->createForm(new FocusType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('focus'));

        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Focus entity.
     *
     * @Route("/{id}/edit", name="focus_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperieFocusBundle:Focus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Focus entity.');
        }

        $editForm = $this->createForm(new FocusType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Focus entity.
     *
     * @Route("/{id}/update", name="focus_update")
     * @Method("post")
     * @Template("LapaperieFocusBundle:Focus:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperieFocusBundle:Focus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Focus entity.');
        }

        $editForm   = $this->createForm(new FocusType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('focus_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Focus entity.
     *
     * @Route("/{id}/delete", name="focus_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('LapaperieFocusBundle:Focus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Focus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('focus'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
