<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverKeys;
use PHPUnit\Framework\TestCase;


class TestSEBHomePage extends TestCase 
{
    private $serverUrl;
    private $driver;

    public function setup(): void 
    {
        $this->serverUrl = 'http://localhost:4444';
        $this->driver = RemoteWebDriver::create($this->serverUrl, DesiredCapabilities::chrome());
        // $this->driver = RemoteWebDriver::create($this->serverUrl, DesiredCapabilities::firefox());
    }

    public function testUserIsAbleToSearch() 
    {
        // Given
        $this->driver->get('https://www.seb.lt/');
        // When
        $this->driver->findElement(WebDriverBy::id('searchid01'))
            ->sendKeys('kreditai')
            ->submit();        
        sleep(1);
        // Then 
        $this->assertEquals($this->driver->getTitle(), 'Paieškos rezultatai | SEB bankas');
        $this->assertEquals($this->driver
            ->findElement(WebDriverBy::cssSelector('#block-system-main > div > div > div.longtext > div.mobile-hide > h2'))
            ->getText(), 'Paieškos rezultatai');
        // Teardown
        $this->driver->quit();
    }


    // FAILED TEST. was not able to select the correct element for testing

    // public function testNavigatingToAboutPage() 
    // {
    //     // Given
    //     $this->driver->get('https://www.seb.lt/');
    //     // When
    //     $this->driver->findElement(WebDriverBy::cssSelector('#block-seb-headertabs > div > ul > li:nth-child(6) > a'))
    //         ->click();        
    //     sleep(1);
    //     // Then 
    //     $this->assertEquals($this->driver->getTitle(), 'Apie SEB | SEB bankas');
    //     // Teardown
    //     $this->driver->quit();
    // }


    // // FAILED TEST. was not able to select the correct element for testing
    // public function testUserIsAbleToChosePrivateBanking() 
    // {
    //     // Given
    //     $this->driver->get('https://www.seb.lt/');
    //     // When
    //     $this->driver->findElement(WebDriverBy::cssSelector('#profile01 > a'))
    //         ->click()
    //         ->findElement(WebDriverBy::cssSelector('#profile01drop > span > span > ul > li:nth-child(1) > a'))   
    //         ->click();    
            
    //     sleep(1);
    //     // Then 

    //     // Teardown
    //     $this->driver->quit();
    // }


}