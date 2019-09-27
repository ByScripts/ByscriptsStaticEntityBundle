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
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

/**
 * Class StaticEntityTest
 *
 * @author Thierry Goettelmann <thierry@byscripts.info>
 */
class StaticEntityTest extends WebTestCase
{
    public function testParamConverter()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/test/param-converter/mr');

        $this->assertEquals(
            'Mister',
            $crawler->text()
        );
    }

    public function testParamConverterBad()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Static entity not found');

        $client = static::createClient();
        $client->request('GET', '/test/param-converter/non-existent-id');
    }

    public function testParamConverterNoAttribute()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/test/param-converter-no-attribute');

        $this->assertEquals(
            'null',
            $crawler->text()
        );
    }

    public function testParamConverterDefaultValue()
    {
        $client = static::createClient();
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
        $content = $crawler->filterXPath('html/body/form/div//select')->text();
        $this->assertStringContainsString('Mister', $content);
        $this->assertStringContainsString('Misses', $content);
    }

    public function testFormTypeWithoutClass()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('required option "class" is missing');

        $client = static::createClient();
        $client->request('GET', '/test/form-type-without-class');
    }
}
