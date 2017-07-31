<?php
namespace Ruslan\Brand\Model\Data\Source;
/*
 * Ruslan_Brand

 * @category   Turiknox
 * @package    Ruslan_Brand
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-brand-uicomponent/blob/master/LICENSE.md
 * @version    1.0.0
 */
use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Enabled')],
            ['value' => 0, 'label' => __('Disabled')]
        ];
    }
}
