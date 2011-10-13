<?php

namespace Lapaperie\DiffusionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\DiffusionBundle\Entity\Diffusion;
use Lapaperie\DiffusionBundle\Form\DiffusionType;

use Lapaperie\FileUploadBundle\Entity\FileUpload;
use Lapaperie\FileUploadBundle\Form\FileUploadType;

use Lapaperie\GalleryBundle\Entity\Gallery;

use Lapaperie\GalleryBundle\Entity\Image;
use Lapaperie\GalleryBundle\Form\ImageType;

/**
 * Diffusion Admin controller.
 *
 * @Route("/admin/diffusion")
 */
class DiffusionAdminController extends Controller
{
    /**
     * Lists all Diffusion entities.
     *
     * @Route("/", name="diffusion")
     * @Template("LapaperieDiffusionBundle:Admin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperieDiffusionBundle:Diffusion')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Creates a new Diffusion entity.
     *
     * @Route("/create", name="diffusion_create")
     * @Template("LapaperieDiffusionBundle:Admin:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Diffusion();
        $request = $this->getRequest();
        $form    = $this->createForm(new DiffusionType(), $entity);

        if ($request->getMethod() == 'POST')
        {

            $form->bindRequest($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('diffusion', array('id' => $entity->getId())));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Diffusion entity.
     *
     * @Route("/{id}/edit", name="diffusion_edit")
     * @Template("LapaperieDiffusionBundle:Admin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperieDiffusionBundle:Diffusion')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Diffusion entity.');
        }

        $editForm = $this->createForm(new DiffusionType(), $entity);
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

            //update Diffusion ou fileUpload ou Images?
            if($request->request->get('lapaperie_fileuploadbundle_fileuploadtype'))
            {
                $editFileForm->bindRequest($request);

                if ($editFileForm->isValid())
                {
                    $fileEntity->uploadFile();
                    $em->persist($fileEntity);
                    $entity->setFile($fileEntity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('diffusion_edit', array('id' => $id)));
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

                    return $this->redirect($this->generateUrl('diffusion_edit', array('id' => $id)));
                }
            }
            else
            {
                $editForm->bindRequest($request);

                if ($editForm->isValid())
                {
                    $em->persist($entity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('diffusion_edit', array('id' => $id)));
                }
            }
        }

        //sans cette ligne, twig ne voit pas les images de l'entité !?
        $images = $entity->getGallery()->getImages();

        return array(
            'entity'           => $entity,
            'form'             => $editForm->createView(),
            'edit_file_form'   => $editFileForm->createView(),
            'edit_image_form'  => $editImageForm->createView(),
            'delete_form'      => $deleteForm->createView(),
        );
    }

    /**
     * delete an Image
     *
     * @Route("/{id}/delete_image", name="image_diffusion_delete")
     */
    public function deleteImage($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $image = $em->getRepository('LapaperieGalleryBundle:Image')->find($id);

        if (!$image)
        {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $diffusion = $em->getRepository('LapaperieDiffusionBundle:Diffusion')->findByImageId($id);
        $id_diffusion = $diffusion[0]->getId();

        $em->remove($image);
        $em->flush();

        return $this->redirect($this->generateUrl('diffusion_edit', array('id' => $id_diffusion)));
    }

    /**
     * Deletes a Diffusion entity.
     *
     * @Route("/{id}/delete", name="diffusion_delete")
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
            $entity = $em->getRepository('LapaperieDiffusionBundle:Diffusion')->find($id);

            if (!$entity)
            {
                throw $this->createNotFoundException('Unable to find Diffusion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diffusion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
