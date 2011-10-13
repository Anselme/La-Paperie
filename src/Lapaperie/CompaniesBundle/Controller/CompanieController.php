<?php

namespace Lapaperie\CompaniesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;


use Lapaperie\CompaniesBundle\Entity\Companie;
use Lapaperie\CompaniesBundle\Form\CompanieType;

use Lapaperie\CompaniesBundle\Entity\ImageCompanie;
use Lapaperie\CompaniesBundle\Form\ImageCompanieType;

use Lapaperie\FileUploadBundle\Entity\FileUpload;
use Lapaperie\FileUploadBundle\Form\FileUploadType;

/**
 * Companie controller.
 *
 * @Route("/admin/companie")
 */
class CompanieController extends Controller
{
    /**
     * Lists all Companie entities.
     *
     * @Route("/", name="companie")
     * @Template()
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getEntityManager()->getRepository('LapaperieCompaniesBundle:Companie');

        $query = $repo->createQBfindAllOrderByDebutResidenceDesc();
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(10);
        $paginator->setCurrentPage($this->get('request')->query->get('page', 1), false, true);

        return array('paginator' => $paginator);
    }

    /**
     * Creates a new Companie entity.
     *
     * @Route("/create", name="companie_create")
     * @Template("LapaperieCompaniesBundle:Companie:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Companie();
        $request = $this->getRequest();
        $form    = $this->createForm(new CompanieType(), $entity);

        if ($request->getMethod() == 'POST') {

            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('companie' ));

            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Companie entity.
     *
     * @Route("/{id}/edit", name="companie_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperieCompaniesBundle:Companie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Companie entity.');
        }

        $editForm   = $this->createForm(new CompanieType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        //Images des companies
        $imageEntity = new ImageCompanie();
        $editImageForm = $this->createForm(new ImageCompanieType(), $imageEntity);

        //File Upload
        $fileEntity = new FileUpload();
        $editFileForm = $this->createForm(new FileUploadType(), $fileEntity);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            //update Companie ou Image ou fileUpload ?
            if($request->request->get('lapaperie_companiesbundle_imagecompanietype'))
            {
                $editImageForm->bindRequest($request);

                if ($editImageForm->isValid()) {
                    $imageEntity->upload($entity);
                    $em->persist($imageEntity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('companie_edit', array('id' => $id)));
                }
            }
            elseif($request->request->get('lapaperie_fileuploadbundle_fileuploadtype'))
            {

                $editFileForm->bindRequest($request);

                if ($editFileForm->isValid()) {
                    $fileEntity->uploadFile();
                    $em->persist($fileEntity);
                    $entity->setFile($fileEntity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('companie_edit', array('id' => $id)));
                }
            }
            else
            {

                $editForm->bindRequest($request);

                if ($editForm->isValid()) {
                    $em->persist($entity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('companie_edit', array('id' => $id)));
                }
            }
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'edit_image_form'   => $editImageForm->createView(),
            'edit_file_form'   => $editFileForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * delete an Image
     *
     * @Route("/{id}/delete_image", name="image_delete")
     */
    public function deleteImage($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $image = $em->getRepository('LapaperieCompaniesBundle:ImageCompanie')->find($id);

        if (!$image)
        {
            throw $this->createNotFoundException('Unable to find ImageCompanie entity.');
        }

        $id_companie = $image->getCompanie()->getId();

        $em->remove($image);
        $em->flush();

        return $this->redirect($this->generateUrl('companie_edit', array('id' => $id_companie)));
    }

    /**
     * Deletes a Companie entity.
     *
     * @Route("/{id}/delete", name="companie_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('LapaperieCompaniesBundle:Companie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Companie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('companie'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
