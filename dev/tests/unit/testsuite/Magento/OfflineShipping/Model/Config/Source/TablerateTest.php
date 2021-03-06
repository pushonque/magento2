<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\OfflineShipping\Model\Config\Source;

class TablerateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\OfflineShipping\Model\Config\Source\Tablerate
     */
    protected $model;

    /**
     * @var \Magento\OfflineShipping\Model\Carrier\Tablerate|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $carrierTablerateMock;

    protected function setUp()
    {
        $this->carrierTablerateMock = $this->getMockBuilder('\Magento\OfflineShipping\Model\Carrier\Tablerate')
            ->disableOriginalConstructor()
            ->setMethods(['getCode'])
            ->getMock();

        $helper = new \Magento\TestFramework\Helper\ObjectManager($this);
        $this->model = $helper->getObject('Magento\OfflineShipping\Model\Config\Source\Tablerate', [
            'carrierTablerate' => $this->carrierTablerateMock
        ]);
    }

    public function testToOptionArray()
    {
        $codes = [1, 2, 3, 4, 5];
        $expected = [];
        foreach ($codes as $k => $v) {
            $expected[] = ['value' => $k, 'label' => $v];
        }

        $this->carrierTablerateMock->expects($this->once())
            ->method('getCode')
            ->willReturn($codes);

        $this->assertEquals($expected, $this->model->toOptionArray());
    }
}
