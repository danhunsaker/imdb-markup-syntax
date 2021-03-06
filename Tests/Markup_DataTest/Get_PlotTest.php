<?php
/**
 * Testclass to Markup_DataSuite for method getPlot in Markup_Data class
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
 * Testclass to Markup_DataSuite for method getPlot in Markup_Data class
 *
 * @category  Testable
 * @package   Test
 * @author    Henrik Roos <henrik.roos@afternoon.se>
 * @copyright 2013 Henrik Roos
 * @license   http://opensource.org/licenses/gpl-3.0.html GPL-3.0
 * @link      https://github.com/HenrikRoos/imdb-markup-syntax imdb-markup-syntax
 */
class Get_PlotTest extends PHPUnit_Framework_TestCase
{

    /** @var string positive testdata */
    public $testdataPositive = 'tt0137523';

    /**
     * Positive test: Get data sucessful
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getPlot
     * @covers Markup_Data::getValue
     *
     * @return void
     */
    public function testPositive()
    {
        //Given
        $imdb = new Movie_Datasource($this->testdataPositive);
        $data = $imdb->getData();
        $expected = 'An insomniac office worker looking for a way to change his life'
            . ' crosses paths with a devil-may-care soap maker and they form an'
            . ' underground fight club that evolves into something much, much'
            . ' more...';

        //When
        $mdata = new Markup_Data($data);
        $actual = $mdata->getPlot();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Negative test: No data is set
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getPlot
     * @covers Markup_Data::getValue
     *
     * @return void
     */
    public function testNotSet()
    {
        //Given
        $imdb = new Movie_Datasource($this->testdataPositive);
        $data = $imdb->getData();
        unset($data->plot);
        $expected = false;

        //When
        $mdata = new Markup_Data($data);
        $actual = $mdata->getPlot();

        //Then
        $this->assertSame($expected, $actual);
    }

    /**
     * Negative test: Data is empty
     *
     * @covers Markup_Data::__construct
     * @covers Markup_Data::getPlot
     * @covers Markup_Data::getValue
     *
     * @return void
     */
    public function testEmpty()
    {
        //Given
        $imdb = new Movie_Datasource($this->testdataPositive);
        $data = $imdb->getData();
        $data->plot->outline = '';
        $expected = false;

        //When
        $mdata = new Markup_Data($data);
        $actual = $mdata->getPlot();

        //Then
        $this->assertSame($expected, $actual);
    }
}
