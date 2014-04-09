<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Session;

require_once 'PHPUnit/Framework/Assert/Functions.php';

class FeatureContext extends BehatContext
{
    private $session;
    
    /** @BeforeScenario */
    public function before()
    {
        $driver = new GoutteDriver();
        $this->session = new Session($driver);
        $this->session->start();	
    }

    /**
     * @When /^I am on the dashboard$/
     */
    public function iAmOnTheDashboard()
    {
        $this->session->visit('http://localhost:9080/dashboard');
    }

    /**
     * @Then /^I should get:$/
     */
    public function iShouldGet($string)
    {
        $dashboard  = $this->session->getPage();
        $html       = $dashboard->getHtml();
        $contains   = strpos($html, $string->getRaw());

        assertTrue($contains !== false, 'Failed to find: '.$string);
    }
    
    /** @AfterScenario */
    public function after(){
        $this->session->reset();
    }    
}
