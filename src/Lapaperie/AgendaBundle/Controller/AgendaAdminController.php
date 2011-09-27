<?php

namespace Lapaperie\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\AgendaBundle\Entity\Actualite;
use Lapaperie\AgendaBundle\Form\ActualiteType;

/**
 * AgendaAdmin controller.
 *
 * @Route("/admin/agenda")
 */
class AgendaAdminController extends Controller
{
    /**
     * Lists all Actualite entities.
     *
     * @Route("/", name="agenda")
     * @Template("LapaperieAgendaBundle:Admin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperieAgendaBundle:Actualite')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Creates a new Actualite entity.
     *
     * @Route("/create", name="agenda_create")
     * @Template("LapaperieAgendaBundle:Admin:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Actualite();
        $form    = $this->createForm(new ActualiteType(), $entity);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('agenda'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Actualite entity.
     *
     * @Route("/{id}/edit", name="agenda_edit")
     * @Template("LapaperieAgendaBundle:Admin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperieAgendaBundle:Actualite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Acutalite entity.');
        }

        $editForm   = $this->createForm(new ActualiteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $editForm->bindRequest($request);

            if ($editForm->isValid()) {

                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('agenda_edit', array('id' => $id)));
            }
        }

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Acualite entity.
     *
     * @Route("/{id}/delete", name="agenda_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('LapaperieAgendaBundle:Actualite')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Actualite entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('agenda'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
