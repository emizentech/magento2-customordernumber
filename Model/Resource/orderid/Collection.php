<?php
/**
 * Copyright © 2015 EmizenTech. All rights reserved.
 */

namespace EmizenTech\CustomOrderNumber\Model\Resource\Orderid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('EmizenTech\CustomOrderNumber\Model\Orderid', 'EmizenTech\CustomOrderNumber\Model\Resource\Orderid');
    }
}
