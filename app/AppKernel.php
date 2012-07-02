<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),

            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            new Lapaperie\MainBundle\LapaperieMainBundle(),
            new Lapaperie\AgendaBundle\LapaperieAgendaBundle(),
            new Lapaperie\VideoBundle\LapaperieVideoBundle(),
            new Lapaperie\CompaniesBundle\LapaperieCompaniesBundle(),
            new Lapaperie\AdminBundle\LapaperieAdminBundle(),
            new Lapaperie\NewsletterBundle\LapaperieNewsletterBundle(),
            new Lapaperie\ActionCulturelleBundle\LapaperieActionCulturelleBundle(),
            new Lapaperie\DiffusionBundle\LapaperieDiffusionBundle(),
            new Lapaperie\PagesBundle\LapaperiePagesBundle(),
            new Lapaperie\FileUploadBundle\LapaperieFileUploadBundle(),
            new Lapaperie\GalleryBundle\LapaperieGalleryBundle(),
            new Lapaperie\RessourcesBundle\LapaperieRessourcesBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();

            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
