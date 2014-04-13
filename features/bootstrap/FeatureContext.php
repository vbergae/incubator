<?php

//   Copyright 2014 Víctor Berga <vbergae@gmail.com>
//
//   Licensed under the Apache License, Version 2.0 (the "License");
//   you may not use this file except in compliance with the License.
//   You may obtain a copy of the License at
//
//       http://www.apache.org/licenses/LICENSE-2.0
//
//   Unless required by applicable law or agreed to in writing, software
//   distributed under the License is distributed on an "AS IS" BASIS,
//   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//   See the License for the specific language governing permissions and
//   limitations under the License.


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
    

    /**
     * @Given /^I am on the dasboard$/
     */
    public function iAmOnTheDasboard()
    {
        throw new PendingException();
    }

    /**
     * @When /^I click "([^"]*)" button$/
     */
    public function iClickButton($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I visit "([^"]*)"$/
     */
    public function iVisit($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see "([^"]*)" element$/
     */
    public function iShouldSeeElement($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^The element "([^"]*)" should contain more than "([^"]*)" element$/
     */
    public function theElementShouldContainMoreThanElement($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When /^I set the field "([^"]*)" with the value "([^"]*)"$/
     */
    public function iSetTheFieldWithTheValue($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I click the element "([^"]*)"$/
     */
    public function iClickTheElement($arg1)
    {
        throw new PendingException();
    }    
    
    /** @AfterScenario */
    public function after(){
        $this->session->reset();
    }    
}
