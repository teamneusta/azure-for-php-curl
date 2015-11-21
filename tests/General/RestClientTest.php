<?php

namespace TeamNeusta\WindowsAzureCurl\Tests\General\ServiceBuilder;


use TeamNeusta\WindowsAzureCurl\General\RestClient;
use TeamNeusta\WindowsAzureCurl\General\ServiceBuilder;
use TeamNeusta\WindowsAzureCurl\Service\Settings\MediaServiceSettings;
use TeamNeusta\WindowsAzureCurl\Service\Settings\SettingsInterface;
use TeamNeusta\WindowsAzureCurl\TestSettings;
use Prophecy\Argument;

class RestClientTest extends \PHPUnit_Framework_TestCase
{

    /**
     * settingsProphecy
     *
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $settingsProphecy;

    /**
     * authorization
     *
     * @var string
     */
    protected $authorization = '';

    /**
     * curlProphecy
     *
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $curlProphecy;

    protected $url = 'http://some.dummy.url/';

    /**
     * restClient
     *
     * @var RestClient
     */
    protected $restClient;

    public function setUp()
    {
        $this->settingsProphecy = $this->prophesize('\\TeamNeusta\\WindowsAzureCurl\\Service\\Settings\\SettingsInterface');
        $this->curlProphecy = $this->prophesize('\\Curl\\Curl');
    }

    /**
     * getRestClient
     *
     * @return RestClient
     */
    protected function getRestClient() {
        return new RestClient($this->url, $this->settingsProphecy->reveal(), $this->authorization, $this->curlProphecy->reveal());
    }

    public function testShouldSetCurlOptReturnTransferDefaultlyToTrue() {
        $this->curlProphecy->setOpt(Argument::type('integer'), Argument::any())->shouldBeCalled();
        $this->curlProphecy->get(Argument::type('string'), Argument::type('array'))->shouldBeCalled();
        $this->curlProphecy->setOpt(CURLOPT_RETURNTRANSFER, true)->shouldBeCalled();
        $this->restClient = $this->getRestClient();
        $this->restClient->send('foo', 'get');
    }

    public function testShouldSetCurlOptSslVerifypeerDefaultlyToFalse() {
        $this->curlProphecy->setOpt(Argument::type('integer'), Argument::any())->shouldBeCalled();
        $this->curlProphecy->get(Argument::type('string'), Argument::type('array'))->shouldBeCalled();
        $this->curlProphecy->setOpt(CURLOPT_SSL_VERIFYPEER, false)->shouldBeCalled();
        $this->restClient = $this->getRestClient();
        $this->restClient->send('foo', 'get');
    }

    public function curlMethodWithUrlDataProvider()
    {
        return [
            'Normal' => [
                'url' => 'foo',
                'method' => 'get',
                'parameters' => [],
                'postParameters' => [],
                'header' => [],
                'content' => '',
                'expectedUrl' => 'http://some.dummy.url/foo',
                'expectedParameters' => []
            ],
            'Complete Url' => [
                'url' => 'http://some.dev/foo',
                'method' => 'get',
                'parameters' => [],
                'postParameters' => [],
                'header' => [],
                'content' => '',
                'expectedUrl' => 'http://some.dev/foo',
                'expectedParameters' => []
            ],
            'with headers' => [
                'url' => 'http://some.dev/foo',
                'method' => 'get',
                'parameters' => [],
                'postParameters' => [],
                'header' => [
                    'some' => 'header',
                    'foo' => 'bar',
                ],
                'content' => '',
                'expectedUrl' => 'http://some.dev/foo',
                'expectedParameters' => []
            ],

        ];
    }

    /**
     * testShouldCallCurlMethodWithUrl
     *
     * @dataProvider curlMethodWithUrlDataProvider
     * @param $url
     * @param $method
     * @param $parameters
     * @param $postParameters
     * @param $header
     * @param $content
     * @param $expectedUrl
     * @param $expectedParameters
     * @return void
     */
    public function testShouldCallCurlMethodWithUrl($url, $method, $parameters, $postParameters, $header, $content, $expectedUrl, $expectedParameters) {
        $this->curlProphecy->setOpt(Argument::type('integer'), Argument::any())->shouldBeCalled();
        $this->curlProphecy->get(Argument::type('string'), Argument::type('array'))->shouldBeCalled();
        $this->curlProphecy->{$method}($expectedUrl, $expectedParameters)->shouldBeCalled();
        $this->curlProphecy->setHeader(Argument::type('string'), Argument::type('string'))->shouldBeCalledTimes(count($header));
        $this->restClient = $this->getRestClient();
        $this->restClient->send($url, $method, $parameters, $postParameters, $header, $content);
    }

    public function testShouldCallMultipleByRedirect()
    {
        $this->curlProphecy = $this->prophesize('\\Curl\\Curl');
        $this->curlProphecy->setOpt(Argument::type('integer'), Argument::any())->shouldBeCalled();
        $this->curlProphecy->get(Argument::exact('http://some.dummy.url/foo'), Argument::type('array'))->will(function () {
            $this->http_status_code = 301;
            $this->response_headers = ['Location' => 'http://other.location/'];
        });
        $this->curlProphecy->get('http://other.location/foo', [])->shouldBeCalled()->will(function () {
            $this->http_status_code = 200;
            $this->response_headers = null;
        });
        $this->restClient = $this->getRestClient();
        $this->restClient->send('foo', 'get');
    }
}
