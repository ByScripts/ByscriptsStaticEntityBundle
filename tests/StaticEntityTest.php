<?php
/*
 * This file is part of the ByscriptsStaticEntityBundle package.
 *
 * (c) Thierry Goettelmann <thierry@byscripts.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Byscripts\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class FooTest
 *
 * @author Thierry Goettelmann <thierry@byscripts.info>
 */
class StaticEntityTest extends WebTestCase
{
    public function testParamConverter()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/test/param-converter/mr');

        $this->assertEquals(
            'Mister',
            $crawler->text()
        );
    }

    public function testParamConverterBad()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/test/param-converter/non-existent-id');

        $this->assertEquals(
            'no-civility',
            $crawler->text()
        );
    }

    public function testParamConverterDefaultValue()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/test/param-converter-default');

        $this->assertEquals(
            'Misses',
            $crawler->text()
        );
    }

    public function testFormType()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/test/form-type');
        $this->assertEquals('MisterMisses', $crawler->filterXPath('html/body/form/div//select')->text());
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     * @expectedExceptionMessage required option "class" is missing
     */
    public function testFormTypeWithoutClass()
    {
            $client = static::createClient();
            $client->request('GET', '/test/form-type-without-class');
    }
}
