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
     * @Given /^I am "([^"]*)" user$/
     */
    public function iAmUser($arg1)
    {
        if ((string)$arg1 == 'Anonymous')
            return;
        
        $login = $this->session->getPage();
        assertTrue($login->hasField('email'));
       
        $field = $login->findField('email');
        assertNotNull($field);
        
        $field->setValue($arg1, 'field "name" not found');
        
        $button = $login->findById('submit-login');
        $button->click();
    }    
    
    /**
     * @Given /^the homepage$/
     */
    public function theHomepage()
    {
        $this->session->visit('http://localhost:9080/dashboard');
    }    
    
    /**
     * @When /^I am on the dashboard$/
     */
    public function iAmOnTheDashboard()
    {
        $this->session->visit('http://localhost:9080/dashboard');
    }

    /**
     * @Then /^I should get redirected to "([^"]*)"$/
     */
    public function iShouldGetRedirectedTo($arg1)
    {
        $contains = strpos($this->session->getCurrentUrl(), $arg1);
        assertTrue($contains !== false, 'Failed to find: '.$arg1);        
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
