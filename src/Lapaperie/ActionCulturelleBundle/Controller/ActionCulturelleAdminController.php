<?php

namespace Lapaperie\ActionCulturelleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\ActionCulturelleBundle\Entity\ActionCulturelle;
use Lapaperie\ActionCulturelleBundle\Form\ActionCulturelleType;

use Lapaperie\FileUploadBundle\Entity\FileUpload;
use Lapaperie\FileUploadBundle\Form\FileUploadType;

use Lapaperie\GalleryBundle\Entity\Gallery;

use Lapaperie\GalleryBundle\Entity\Image;
use Lapaperie\GalleryBundle\Form\ImageType;

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

        if ($request->getMethod() == 'POST')
        {

            $form->bindRequest($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
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

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find ActionCulturelle entity.');
        }

        $editForm = $this->createForm(new ActionCulturelleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        //File Upload
        $fileEntity = new FileUpload();
        $editFileForm = $this->createForm(new FileUploadType(), $fileEntity);

        //Images
        $imageEntity = new Image();
        $editImageForm = $this->createForm(new ImageType(), $imageEntity);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {

            //update Action ou fileUpload ou Images?
            if($request->request->get('lapaperie_fileuploadbundle_fileuploadtype'))
            {
                $editFileForm->bindRequest($request);

                if ($editFileForm->isValid())
                {
                    $fileEntity->uploadFile();
                    $em->persist($fileEntity);
                    $entity->setFile($fileEntity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('actionculturelle_edit', array('id' => $id)));
                }
            }
            elseif($request->request->get('lapaperie_gallerybundle_imagetype'))
            {
                $editImageForm->bindRequest($request);

                if ($editImageForm->isValid())
                {
                    $imageEntity->upload();
                    $imageEntity->setGallery($entity->getGallery());

                    $em->persist($imageEntity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('actionculturelle_edit', array('id' => $id)));
                }
            }
            else
            {
                $editForm->bindRequest($request);

                if ($editForm->isValid())
                {
                    $em->persist($entity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('actionculturelle_edit', array('id' => $id)));
                }
            }
        }

        //sans cette ligne, twig ne voit pas les images de l'entité !?
        $images = $entity->getGallery()->getImages();

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'edit_file_form'   => $editFileForm->createView(),
            'edit_image_form'  => $editImageForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * delete an Image
     *
     * @Route("/{id}/delete_image", name="image_actionculturelle_delete")
     */
    public function deleteImage($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $image = $em->getRepository('LapaperieGalleryBundle:Image')->find($id);

        if (!$image)
        {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $diffusion = $em->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle')->findByImageId($id);
        $id_diffusion = $diffusion[0]->getId();

        $em->remove($image);
        $em->flush();

        return $this->redirect($this->generateUrl('actionculturelle_edit', array('id' => $id_diffusion)));
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

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
                $entity = $em->getRepository('LapaperieActionCulturelleBundle:ActionCulturelle')->find($id);

                if (!$entity)
                {
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
