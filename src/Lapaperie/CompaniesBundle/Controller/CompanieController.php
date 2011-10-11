<?php

namespace Lapaperie\CompaniesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\CompaniesBundle\Entity\Companie;
use Lapaperie\CompaniesBundle\Form\CompanieType;
use Lapaperie\CompaniesBundle\Entity\ImageCompanie;
use Lapaperie\CompaniesBundle\Form\ImageCompanieType;

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
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperieCompaniesBundle:Companie')->findAll();

        return array('entities' => $entities);
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
        //$deleteImageForm = $this->createImageDeleteForm($id);

        //Images des companies
        $imageEntity = new ImageCompanie();
        $editImageForm = $this->createForm(new ImageCompanieType(), $imageEntity);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            //update Companie ou Image ?
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
            'delete_form' => $deleteForm->createView(),
            //'image_delete_form' => $deleteImageForm->createView(),
        );
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

    private function createImageDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Deletes a ImageCompanie entity.
     *
     * @Route("/{id}/deleteimage", name="imagecompanie_delete")
     * @Method("post")
     */
    public function deleteImageAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('LapaperieCompaniesBundle:ImageCompanie')->find($id);
        $idCompanie = $entity->getCompanie()->getId();

        if ($form->isValid()) {

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ImageCompanie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('companie_edit', array('id' => $idCompanie)));
    }

}
