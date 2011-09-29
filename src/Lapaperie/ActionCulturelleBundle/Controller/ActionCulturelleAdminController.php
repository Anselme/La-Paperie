<?php

namespace Lapaperie\ActionCulturelleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\ActionCulturelleBundle\Entity\ActionCulturelle;
use Lapaperie\ActionCulturelleBundle\Form\ActionCulturelleType;

/**
 * ActionCulturelle Admin controller.
 *
 * @Route("/admin/action-cul")
 */
class ActionCulturelleAdminController extends Controller
{
    /**
     * Lists all ActionCulturelle entities.
     *
     * @Route("/", name="actionculturelle")
     * @Template("LapaperieActionCulturelleBundle:Admin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Creates a new ActionCulturelle entity.
     *
     * @Route("/create", name="actionculturelle_create")
     * @Template("LapaperieActionCulturelleBundle:Admin:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new ActionCulturelle();
        $request = $this->getRequest();
        $form    = $this->createForm(new ActionCulturelleType(), $entity);

        if ($request->getMethod() == 'POST') {

            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $entity->upload();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('actionculturelle', array('id' => $entity->getId())));

            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing ActionCulturelle entity.
     *
     * @Route("/{id}/edit", name="actionculturelle_edit")
     * @Template("LapaperieActionCulturelleBundle:Admin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActionCulturelle entity.');
        }

        $editForm = $this->createForm(new ActionCulturelleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {


            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $entity->upload();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('actionculturelle_edit', array('id' => $id)));
            }
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ActionCulturelle entity.
     *
     * @Route("/{id}/delete", name="actionculturelle_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ActionCulturelle entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('actionculturelle'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
