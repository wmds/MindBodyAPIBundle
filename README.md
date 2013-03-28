MindBodyAPIBundle
=================

Integrates MindBodyOnline.com API with Symfony 2

**1. Installing the bundle**

    php composer.phar require wmds/mindbodyonline-api-bundle dev-master

Add the bundle to your AppKernel.php file:

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Wmds\MindBodyAPIBundle\WmdsMindBodyAPIBundle(),
            // ...
        );
    }

Add config data to your app/config/config.yml file :

    # app/config/config.yml
    wmds_mind_body_api:
        api_user: YourSourceName                    # (Required)
        api_key:  YourPassword                      # (Required)
        site_ids:  [ 100 ]                          # (Required) if not set, default to -99 (sandbox)
        sandbox:  true                              # (Optional) default: true
        debug:    false                             # (Optional) default: false
        xml: 'Full'                                 # (Optional) default: Full, possible: Bare, Basic, Full

**1. How to use it**

This bundle is a service, to use it:

    // Anywhere in your controller
    $mbapi = $this->get('wmds_mind_body_api');

MindBodyOnline.com has a list of available services that you can check on http://api.mindbodyonline.com/Doc
To use an API service:

    // Get the SaleService
    $sale = $mbapi->getService('sale');

    //Get the AppointmentService
    $appointment = $mbapi->getService('AppoinTment'); // string passed is case insensitive

this will automatically set the $sale object, initiate the SOAP object and passes the wsdl url.

To make a request, call the setParam() function to add all the parameters that you need and then execute():

    $products =  $sale->setAction('GetProducts')
                    ->setParam('SellOnline',true)
                    ->execute();

