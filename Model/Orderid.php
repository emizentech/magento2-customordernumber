<?php
/**
 * Copyright © 2015 EmizenTech. All rights reserved.
 */

namespace EmizenTech\CustomOrderNumber\Model;

class Orderid extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('EmizenTech\CustomOrderNumber\Model\Resource\Orderid');
    }
}
