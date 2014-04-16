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
    const TESTHOST = 'http://localhost:9080';
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
     * @When /^I am on the "([^"]*)"$/
     */
    public function iAmOnThe($arg1)
    {
        $this->session->visit(self::TESTHOST.$arg1);
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
     * @When /^I visit "([^"]*)"$/
     */
    public function iVisit($arg1)
    {
        $this->session->visit($arg1);
    }
    
    /**
     * @When /^I click the element "([^"]*)"$/
     */
    public function iClickTheElement($arg1)
    {
        $login      = $this->session->getPage();
        $element    = $login->findById($arg1);
        assertTrue($element !== NULL, 'Element with id "'.$arg1.'" not found');
        $element->click();        
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
    
    /** @AfterScenario */
    public function after(){
        $this->session->reset();
    }    
}
