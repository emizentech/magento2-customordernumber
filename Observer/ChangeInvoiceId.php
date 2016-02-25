<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace EmizenTech\CustomOrderNumber\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ResourceConnection;


class ChangeInvoiceId implements ObserverInterface
{
    protected $scopeConfig;
    protected $resource;
    protected $orderFactory;
    protected $_invoiceCollectionFactory;
    protected $logger;
    protected $InvoiceidobjFactory;

    public function __construct(
        ResourceConnection $resource,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollectionFactory,
        \Psr\Log\LoggerInterface $logger,
        \EmizenTech\CustomOrderNumber\Model\InvoiceidFactory $Invoiceidobj,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->resource = $resource;
        $this->orderFactory = $orderFactory;
        $this->_invoiceCollectionFactory = $invoiceCollectionFactory;
        $this->logger = $logger;
        $this->InvoiceidobjFactory = $Invoiceidobj;
        $this->scopeConfig = $scopeConfig;
    }
    public function execute(Observer $observer)
    {   
        if($this->scopeConfig->getValue('customorder/customorderinvoce/active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE) ==1)
        {
            $incNo = $this->scopeConfig->getValue('customorder/custominvoice_grp/startfrom', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            if($incNo)
            {
                $invoiceInstance = $observer->getInvoice();
                $id = $invoiceInstance->getIncrementId();
                $invoiceIdObj = $this->InvoiceidobjFactory->create()->load(1);

                if(!$invoiceIdObj->getStartup())
                {
                    $invoiceIdObj = $this->InvoiceidobjFactory->create();
                    $invoiceIdObj->setData(array("startup"=>$incNo,"currentid"=>$incNo))->save();
                }
                else
                {
                    if($invoiceIdObj->getData("startup") != $incNo){
                        $invoiceIdObj->setStartup($incNo);
                        $invoiceIdObj->setCurrentid($incNo);
                        $invoiceIdObj->save();
                    }
                    else
                    {
                        $incNo = (int)$invoiceIdObj->getData("currentid")+1;
                        $invoiceIdObj->setCurrentid($incNo);
                        $invoiceIdObj->save();
                    }
                }
                $prefix = $this->scopeConfig->getValue('customorder/custominvoice_grp/prefix', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
                $postfix = $this->scopeConfig->getValue('customorder/custominvoice_grp/postfix', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

                $invoiceInstance = $observer->getInvoice();
                $invoiceInstance->setData("increment_id",$prefix.$incNo.$postfix)->save();
            }
        }
    }
}
