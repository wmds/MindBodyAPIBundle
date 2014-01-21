<?php
/**
 * Created by JetBrains PhpStorm.
 * User: GabrielCol
 * Date: 3/28/13
 * Time: 12:40 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Services;


class Services {

    const appointment_wsdl  = "AppointmentService.asmx?wsdl";
    const class_wsdl        = "ClassService.asmx?wsdl";
    const client_wsdl       = "ClientService.asmx?wsdl";
    const data_wsdl         = "DataService.asmx?wsdl";
    const finder_wsdl       = "FinderService.asmx?wsdl";
    const sale_wsdl         = "SaleService.asmx?wsdl";
    const site_wsdl         = "SiteService.asmx?wsdl";
    const staff_wsdl        = "StaffService.asmx?wsdl";

    /**
     * @var array
     */
    private $params = array();

    /**
     * @var action
     */
    private $action;

    /**
     * SOAP Client
     * @var soapclient
     */
    private $soapClient;

    /**
     * @var debug
     */
    private $debug;

    /**
     * Keeps the last call data for debug purpose
     * @var lastCall
     */
    private $lastCall;

    /**
     * Array with developer credentials, user credentials, xml detail level
     * @var apiData
     */
    private $apiData;

    /**
     * @param $soapURL
     * @param $developerCredentials
     * @param $userCredentials
     * @param $debug
     * @param $XMLDetail
     */
    public function __construct($soapURL, $service, $developerCredentials, $userCredentials, $debug, $XMLDetail) {
        $this->debug        = $debug;
        $this->soapClient   = new \SoapClient($soapURL.$this->getServiceWsdl($service), array('trace' => $this->debug));
        $this->soapClient->__setLocation(str_replace("?wsdl","",$soapURL.$this->getServiceWsdl($service)));
        $this->apiData      = array(
            'SourceCredentials' => $developerCredentials,
            'XMLDetail'         => $XMLDetail
        );

        if($userCredentials) {
            $this->apiData = array_merge(
                $this->apiData,
                array('UserCredentials' => $userCredentials)
            );
        }
    }

    private function getServiceWsdl($service) {
        switch(strtolower($service)) {
            case "appointment":
                return self::appointment_wsdl;
                break;
            case "class":
                return self::class_wsdl;
                break;
            case "client":
                return self::client_wsdl;
                break;
            case "data":
                return self::data_wsdl;
                break;
            case "finder":
                return self::finder_wsdl;
                break;
            case "sale":
                return self::sale_wsdl;
                break;
            case "site":
                return self::site_wsdl;
                break;
            case "staff":
                return self::staff_wsdl;
                break;
            default:
                throw new \Exception("Service \"".$service."\" not exists. Please visit http://api.mindbodyonline.com/Doc for the complete list of available Services");
                break;
        }
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }

    /**
     * @param \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Services\action $action
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Services\lastCall $lastCall
     */
    public function setLastCall($lastCall)
    {
        $this->lastCall = $lastCall;
    }

    /**
     * @return \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Services\lastCall
     */
    public function getLastCall()
    {
        return $this->lastCall;
    }

    public function execute() {

        $request = array(
            'Request' => array_merge($this->apiData, $this->params)
        );
        $this->lastCall = $request;

        $action = $this->action;

        /**
         * Make the SOAP Call
         */
        try {
            $result = $this->soapClient->$action($request);
        }
        catch (SoapFault $fault)
        {
            //debugResponse($this->client, $fault->getMessage());
            // <xmp> tag displays xml output in html
            //echo '</xmp><br/><br/> Error Message : <br/>', $fault->getMessage();
        }

        $resultObj = $action."Result";

        if($result->$resultObj->ErrorCode != 200) {
            throw new \Exception ("MindbodyAPI Error: ".$result->$resultObj->Status." - ".$result->$resultObj->Message."\n"
                                .print_r($this->lastCall,true));
            ;
        }

        if ($this->debug)
        {
            echo '<pre>';
            print_r($this->lastCall);
            echo '</pre>';
        }

        /*
         * Reset params
         */
        $this->params = NULL;

        return $result->$resultObj;

    }



}
