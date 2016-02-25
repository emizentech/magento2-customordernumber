<?php
/**
 * Copyright © 2015 EmizenTech. All rights reserved.
 */

namespace EmizenTech\CustomOrderNumber\Model\Resource\Invoiceid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('EmizenTech\CustomOrderNumber\Model\Invoiceid', 'EmizenTech\CustomOrderNumber\Model\Resource\Invoiceid');
    }
}
