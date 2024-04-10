<?php

namespace Chupaprecios\NewSection\Observer;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FinalPriceObserver implements ObserverInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if (!empty($this->getConfigSobrePrecio())){
            $event      = $observer->getEvent();
            $product    = $event->getProduct();
            $finalPrice = $product->getData('price') + $this->getConfigSobrePrecio();
            $product->setFinalPrice((float) $finalPrice);
        }
    }

    /**
     * Get Config SobrePrecio
     * @return null|string
     */
    public function getConfigSobrePrecio()
    {
        return $this->scopeConfig->getValue(
            'chupaprecios_section/general/sobreprecio',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

}
