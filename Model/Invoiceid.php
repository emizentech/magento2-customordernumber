<?php
/**
 * Copyright © 2015 EmizenTech. All rights reserved.
 */

namespace EmizenTech\CustomOrderNumber\Model;

class Invoiceid extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('EmizenTech\CustomOrderNumber\Model\Resource\Invoiceid');
    }
}
