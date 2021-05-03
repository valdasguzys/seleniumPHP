<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;


class TestWikipediaHomePage extends TestCase 
{
    private $serverUrl;
    private $driver;

    public function setup(): void 
    {
        $this->serverUrl = 'http://localhost:4444';
        $this->driver = RemoteWebDriver::create($this->serverUrl, DesiredCapabilities::chrome());
        // $this->driver = RemoteWebDriver::create($this->serverUrl, DesiredCapabilities::firefox());
    }

    public function testUserIsAbleSees10OfferedLanguages () 
    {
        // Given
        $this->driver->get('https://wikipedia.org/');

        // When 
        $languageOptions = $this->driver->findElements(WebDriverBy::className('central-featured-lang'));

        // Then 
        $this->assertEquals(count($languageOptions), 10 );

        // Teardown : close the browser
        $this->driver->quit();
    }

}