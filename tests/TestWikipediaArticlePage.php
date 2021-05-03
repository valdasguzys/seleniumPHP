<?php

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;


class TestWikipediaArticlePage extends TestCase 
{
    private $serverUrl;
    private $driver;

    // //////starts the driver
    // private static $handle;
    // public static function setUpBeforeClass(): void {
    //     print(">>>>>");
    //   self::$handle = popen('webdrivers\geckodriver.exe --port=4444', 'r');
    //     // self::$handle = popen('webdrivers\chromedriver90.exe --port=4444', 'r');
    // }


    public function setup(): void 
    {
        // Chromedriver (if started using --port=4444 as above)
        $this->serverUrl = 'http://localhost:4444';
        //for use with diferent drivers
        $this->driver = RemoteWebDriver::create($this->serverUrl, DesiredCapabilities::chrome());
        // $this->driver = RemoteWebDriver::create($this->serverUrl, DesiredCapabilities::firefox());

    }

    public function testUserIsAbleToNavigateFromHomepageToContentPage() 
    {
        // Given :: some starting page
        $this->driver->get('https://en.wikipedia.org/');

        // When :: 'PHP' in the search box and submit was pressed
        $this->driver->findElement(WebDriverBy::id('searchInput')) // find search input element
            ->sendKeys('PHP') // fill the search box
            ->submit(); // submit the whole form
        
        sleep(1);
        // Then 
        $this->assertEquals($this->driver->getTitle(), 'PHP - Wikipedia');

        // Teardown : close the browser
        $this->driver->quit();

    }

    public function testUserIsAbleToNavigateToContentPAgeFromAnotherContentPage() 
    {
        // Given :: some starting page
        $this->driver->get('https://en.wikipedia.org/wiki/Selenium_(software)');

        // When :: 'PHP' in the search box and submit was pressed
        $this->driver->findElement(WebDriverBy::id('searchInput')) // find search input element
            ->sendKeys('PHP') // fill the search box
            ->submit(); // submit the whole form
        
        sleep(1);
        // Then 
        $this->assertEquals($this->driver->getTitle(), 'PHP - Wikipedia');

        // Teardown : close the browser
        $this->driver->quit();
    }

    public function testUserIsAbleToAccessTheEditSectionOfTheContentPage() 
    {
        // Given
        $this->driver->get('https://en.wikipedia.org/wiki/PHP');

        // When
        $this->driver->findElement(WebDriverBy::id('ca-edit'))->click();

        sleep(1);
        // Then 
        $this->assertEquals($this->driver->findElement(WebDriverBy::id('firstHeading'))->getText(), 'Editing PHP');

        // Teardown : close the browser
        $this->driver->quit();
    }

    public function testJSExecution()
    {
        //Given 
        $this->driver->get('http://en.wikipedia.org/wiki/PHP');
        $result = $this->driver->executeScript("return document.getElementById('siteSub').textContent"); 
        var_dump($this->driver->executeScript("return $('#siteSub').text()"));

        sleep(1);
        //Then 
        $this->assertEquals($result, 'From Wikipedia, the free encyclopedia');

        //Teardown 
        $this->driver->quit();
    }

    /////// supposed to close driver, but doesn't work
    // public static function tearDownAfterClass(): void {
    //     pclose(self::$handle);
    // } 
}
