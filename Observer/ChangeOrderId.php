<?php

namespace EmizenTech\CustomOrderNumber\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Address;
use Magento\Framework\App\ResourceConnection;

class changeOrderId implements ObserverInterface
{
	protected $scopeConfig;
	protected $resource;
	protected $logger;
	protected $OrderidobjFactory;

	public function __construct(
		\Psr\Log\LoggerInterface $logger,
		\EmizenTech\CustomOrderNumber\Model\OrderidFactory $Orderidobj,
		ResourceConnection $resource,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
    	$this->resource = $resource;
    	$this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->OrderidobjFactory = $Orderidobj;
        //$this->UsedorderidobjFactory = $Usedorderidobj;
    }
    public function execute(Observer $observer)
    {
    	if($this->scopeConfig->getValue('customorder/customorderinvoce/active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE) ==1)
    	{
    		$incNo = $this->scopeConfig->getValue('customorder/customorder_grp/startfrom', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    		if($incNo){
	    		$orderInstance = $observer->getOrder();
		        $id = $orderInstance->getIncrementId();
	        	$orderIdObj = $this->OrderidobjFactory->create()->load(1);

			    if(!$orderIdObj->getStartup())
			    {
			    	$orderIdObj = $this->OrderidobjFactory->create();
			    	$orderIdObj->setData(array("startup"=>$incNo,"currentid"=>$incNo))->save();
			    }
			    else
			    {
			    	if($orderIdObj->getData("startup") != $incNo){
			    		$orderIdObj->setStartup($incNo);
			    		$orderIdObj->setCurrentid($incNo);
			    		$orderIdObj->save();
				    }
				    else
				    {
				    	$incNo = (int)$orderIdObj->getData("currentid")+1;
			    		$orderIdObj->setCurrentid($incNo);
			    		$orderIdObj->save();
				    }

			    }

		        $prefix = $this->scopeConfig->getValue('customorder/customorder_grp/prefix', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		        $postfix = $this->scopeConfig->getValue('customorder/customorder_grp/postfix', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

		        $orderInstance = $observer->getOrder();
		        $orderInstance->setData("increment_id",$prefix.$incNo.$postfix)->save();
		    }
		}
    }
}
