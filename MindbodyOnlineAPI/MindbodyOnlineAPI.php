<?php
/**
 * Created by JetBrains PhpStorm.
 * User: GabrielCol
 * Date: 3/27/13
 * Time: 10:45 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Wmds\MindBodyAPIBundle\MindbodyOnlineAPI;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend\UserCredentials;
use Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Services\Appointment;
use Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Services\Services;

class MindbodyOnlineAPI {

    const SOAP_URL = "http://clients.mindbodyonline.com/api/0_5/";

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var debug
     */
    private $debug;

    /**
     * @var XMLDetail
     */
    private $XMLDetail;

    /**
     * @var developerCredentials
     */
    private $developerCredentials;

    /**
     * @param UserCredentials
     */
    private $userCredentials;

    /**
     * @param $service
     * @return Services
     */
    public function getService($service)
    {
        return new Services(
            self::SOAP_URL,
            $service,
            $this->developerCredentials,
            $this->userCredentials->getCredentials(),
            $this->debug,
            $this->XMLDetail
        );
    }


    /**
     * @param ContainerInterface $container
     */

    public function __construct(ContainerInterface $container)
    {
        $this->container        = $container;
        $this->userCredentials  = new UserCredentials();

        $config             = $this->container->getParameter('wmds_mind_body_api_data');

        /* Set debug level */
        $this->debug        = $config['debug'];
        $this->XMLDetail    = $config['xml'];

        /* Set developer credentials */
        $this->setDeveloperCredentials(array(
            'SourceName'    => $config['api_user'],
            'Password'      => $config['api_key'],
            'SiteIDs'       => ($config['sandbox'] == true)?array(-99):$config['site_ids']
        ));

    }

    /**
     * @param \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\developerCredentials $developerCredentials
     */
    public function setDeveloperCredentials($developerCredentials)
    {
        $this->developerCredentials = $developerCredentials;
    }

    public function execute() {
         var_dump($this->appointment);
    }

}