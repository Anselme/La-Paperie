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
     * Creates a new Focus entity.
     *
     * @Route("/create", name="focus_create")
     * @Template("LapaperieFocusBundle:Focus:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Focus();
        $form    = $this->createForm(new FocusType(), $entity);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $request_args = $request->request->get('lapaperie_focusbundle_focustype');
                isset($request_args['isOnLine'])?$isOnline = true:$isOnLine = false ;

                if($isOnLine)
                {
                    $em = $this->getDoctrine()->getEntityManager();
                    $repository = $em->getRepository('LapaperieFocusBundle:Focus')->setOthersOffLine();
                }

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('focus'));
            }
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

        $editForm   = $this->createForm(new FocusType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $editForm->bindRequest($request);

            if ($editForm->isValid()) {

                //TODO -> vérifier le focntionnemetn d'accès aux variables $_POST
                $request_args = $request->request->get('lapaperie_focusbundle_focustype');
                isset($request_args['isOnLine'])?$isOnline = true:$isOnLine = false ;

                if($isOnLine)
                {
                    $em1 = $this->getDoctrine()->getEntityManager();
                    $repository = $em1->getRepository('LapaperieFocusBundle:Focus')->setOthersOffLine($id);
                }

                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('focus_edit', array('id' => $id)));
            }
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
