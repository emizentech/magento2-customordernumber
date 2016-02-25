<?php
/**
 * Copyright © 2015 EmizenTech. All rights reserved.
 */

namespace EmizenTech\CustomOrderNumber\Model\Resource;

class Invoiceid extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('emizentech_custominvoicenumber', 'id');
    }
}
