<?php
/**
 * Testclass to Markup_DataSuite for method getDate in Markup_Data class
 *
 * PHP version 5
 *
 * @category  Testable
 * @package   Test
 * @author    Henrik Roos <henrik.roos@afternoon.se>
 * @copyright 2013 Henrik Roos
 * @license   http://opensource.org/licenses/gpl-3.0.html GPL-3.0
 * @link      https://github.com/HenrikRoos/imdb-markup-syntax imdb-markup-syntax
 */

/**
 * Testclass to Markup_DataSuite for method getDate in Markup_Data class
 *
 * @category  Testable
 * @package   Test
 * @author    Henrik Roos <henrik.roos@afternoon.se>
 * @copyright 2013 Henrik Roos
 * @license   http://opensource.org/licenses/gpl-3.0.html GPL-3.0
 * @link      https://github.com/HenrikRoos/imdb-markup-syntax imdb-markup-syntax
 */
class Get_DateTest extends PHPUnit_Framework_TestCase
{

    /** @var string positive testdata */
    public $testdataPositive;

    /**
     * Positive test: Get data sucessful then release date is set
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getDate
     * @covers Markup_Data::getValueValue
     *
     * @return void
     */
    public function testReleaseDatePositive()
    {
        //Given
        $locale = 'en_US';
        $expected = 'Fri Jul 18 2008';

        //When
        $imdb = new Movie_Datasource($this->testdataPositive, $locale);
        $data = $imdb->getData();
        $mdata = new Markup_Data($data, null, $locale);
        $actual = $mdata->getDate();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Positive test: Get data sucessful then release date is set in Swedish
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getDate
     * @covers Markup_Data::getValueValue
     *
     * @return void
     */
    public function testReleaseDatePositiveSwedish()
    {
        //Given
        $locale = 'sv_SE';
        $expected = 'Fre 25 Jul 2008';

        //When
        $imdb = new Movie_Datasource($this->testdataPositive, $locale);
        $data = $imdb->getData();
        $mdata = new Markup_Data($data, null, $locale);
        $actual = $mdata->getDate();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Positive test: Get data sucessful then release date is set in French
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getDate
     * @covers Markup_Data::getValueValue
     *
     * @return void
     */
    public function testReleaseDatePositiveFrench()
    {
        //Given
        $locale = 'fr_FR';
        $expected = 'Mer 13 aoû 2008';

        //When
        $imdb = new Movie_Datasource($this->testdataPositive, $locale);
        $data = $imdb->getData();
        $mdata = new Markup_Data($data, null, $locale);
        $actual = $mdata->getDate();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Alternative positive test: No release_date is not set but year is set
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getDate
     * @covers Markup_Data::getValueValue
     *
     * @return void
     */
    public function testYearAlternative()
    {
        //Given
        $imdb = new Movie_Datasource($this->testdataPositive);
        $data = $imdb->getData();
        $data->release_date->normal = '';
        $expected = '2008';

        //When
        $mdata = new Markup_Data($data);
        $actual = $mdata->getDate();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Negative test: Data is not set (release date and year)
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getDate
     * @covers Markup_Data::getValueValue
     *
     * @return void
     */
    public function testNoSet()
    {
        //Given
        $imdb = new Movie_Datasource($this->testdataPositive);
        $data = $imdb->getData();
        unset($data->release_date);
        unset($data->year);
        $expected = false;

        //When
        $mdata = new Markup_Data($data);
        $actual = $mdata->getDate();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Negative test: Data is empty
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getDate
     * @covers Markup_Data::getValueValue
     *
     * @return void
     */
    public function testEmpty()
    {
        //Given
        $imdb = new Movie_Datasource($this->testdataPositive);
        $data = $imdb->getData();
        $data->release_date->normal = '';
        $data->year = "";
        $expected = false;

        //When
        $mdata = new Markup_Data($data);
        $actual = $mdata->getDate();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Set up local testdata
     *
     * @return void
     */
    protected function setUp()
    {
        $this->testdataPositive = 'tt0468569';
        setlocale(LC_ALL, '');
    }

    /**
     * Clean up after testing.
     *
     * @return void
     */
    protected function tearDown()
    {
        parent::tearDown();
        setlocale(LC_ALL, '');
    }

}
