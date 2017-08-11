<?php

/**
 * @author Ruslan Miskiv
 *
 * Status Model
 */

namespace Ruslan\Brand\Model\Attribute\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 * @package Ruslan\Brand\Model\Attribute\Source
 */
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
