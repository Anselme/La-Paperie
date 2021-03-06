<?php

namespace Lapaperie\AgendaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Agenda controller.
 *
 * @Route("/agenda")
 */
class AgendaController extends Controller
{

    /**
     * Agenda .
     *
     * @Route("/", name="LapaperieAgendaBundle_home")
     */
    public function indexAction(Request $request)
    {
        //par defaut on n'affiche pas la definition de la sortie de fabrique
        $definition = false ;

        setlocale(LC_TIME, 'fr_FR');
        $current_month = $request->query->get('month');
        $current_year = $request->query->get('year');

        $actual_month = date('n') ;
        $actual_year = date('Y') ;
        if (!isset($current_month))
        {
            $current_month = $actual_month ;
            $current_year = $actual_year ;
        }

        $date = new \DateTime($current_year."-".$current_month."-01");
        $next_month = $current_month + 1 ;
        if ($next_month>12)
        {
            $next_month -= 12 ;
            $current_year++;
        }
        $date_end = new \DateTime($current_year."-".$next_month ."-01");

        $repository = $this->getDoctrine()->getRepository('LapaperieAgendaBundle:Actualite');
        $agenda = $repository->findActiveActualiteByMonth($date, $date_end);

        //si on a coché la bonne case dans une actualité, la définition de "sortie de fabrique" s'affiche
        foreach ($agenda as $actualite) {
            if($actualite->getShowDefinition() == true) $definition = true ;
        }

        $calendar = array();
        $years = array();
        setlocale(LC_TIME, 'fr_FR.utf8');

        for($i = -4; $i<8; $i++)
        {
            $toto = mktime(0, 0, 0,$actual_month + $i,1,date('Y'));
            $current_month == date("n", $toto) ? $active = "active-agenda" : $active = "" ;

            array_push($calendar, array(
                "name" => strftime("%B",$toto),
                "order" => date("n",$toto),
                "year" => date("Y",$toto),
                "active" => $active,
            ));

            $years[date("Y", $toto)] =  date("Y", $toto);
        }

        $years = implode(" / ", $years);

        return $this->render('LapaperieAgendaBundle:Default:index.html.twig',
            array('agenda' => $agenda,
            'calendar' => $calendar,
            'years' => $years,
            'definition' => $definition
        ));
    }
}
