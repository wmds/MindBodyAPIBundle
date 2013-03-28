<?php
/**
 * Created by JetBrains PhpStorm.
 * User: GabrielCol
 * Date: 3/28/13
 * Time: 12:26 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend;


class UserCredentials {
    /**
     * @var username
     */
    private $username;

    /**
     * @param \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend\username $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend\username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend\password $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend\password
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @var password
     */
    private $password;

    /**
     * @param \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend\siteIDs $siteIDs
     */
    public function setSiteIDs($siteIDs)
    {
        $this->siteIDs = $siteIDs;
    }

    /**
     * @return \Wmds\MindBodyAPIBundle\MindbodyOnlineAPI\Extend\siteIDs
     */
    public function getSiteIDs()
    {
        return $this->siteIDs;
    }
    /**
     * @var siteIDs
     */
    private $siteIDs;

    /**
     * @return array
     */
    public function getCredentials() {
        if($this->username == false) {
            return false;
        }
        return array(
            'Username'      => $this->username,
            'Password'      => $this->password,
            'SiteIDs'       => $this->siteIDs
        );
    }
}