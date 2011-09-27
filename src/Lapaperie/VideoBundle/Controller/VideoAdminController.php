<?php

namespace Lapaperie\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\VideoBundle\Entity\Video;
use Lapaperie\VideoBundle\Form\VideoType;

/**
 * Video Admin controller.
 *
 * @Route("/admin/video")
 */
class VideoAdminController extends Controller
{
    /**
     * Lists all Video entities.
     *
     * @Route("/", name="video")
     * @Template("LapaperieVideoBundle:Video:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperieVideoBundle:Video')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Creates a new Video entity.
     *
     * @Route("/create", name="video_create")
     * @Template("LapaperieVideoBundle:Video:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Video();
        $request = $this->getRequest();
        $form    = $this->createForm(new VideoType(), $entity);

        if ($request->getMethod() == 'POST') {

            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('video', array('id' => $entity->getId())));

            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Video entity.
     *
     * @Route("/{id}/edit", name="video_edit")
     * @Template("LapaperieVideoBundle:Video:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperieVideoBundle:Video')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Video entity.');
        }

        $editForm = $this->createForm(new VideoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {


            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $entity->upload();
                $entity->setSrc();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('video_edit', array('id' => $id)));
            }
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Video entity.
     *
     * @Route("/{id}/delete", name="video_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('LapaperieVideoBundle:Video')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Video entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('video'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
