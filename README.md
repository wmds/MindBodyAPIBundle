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
        api_user: StudioAlign                       # (Required)
        api_key:  'YTH8ubnBjaahdDOL7G7DgjjujJI='    # (Required)
        site_ids:  [ 16603 ]                        # (Required) if not set, default to -99 (sandbox)
        sandbox:  true                              # (Optional) default: true
        debug:    false                             # (Optional) default: false
        xml: 'Full'                                 # (Optional) default: Full, possible: Bare, Basic, Full