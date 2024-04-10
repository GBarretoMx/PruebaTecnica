<?php
declare(strict_types=1);
namespace Chupaprecios\NewSection\Observer;

use Chupaprecios\NewSection\Logger\Logger;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class LogDataOrder implements ObserverInterface
{

    /**
     * @var Logger
     */
    protected Logger $logger;


    /**
     * @param Logger $logger
     */
    public function __construct(
        Logger $logger,
    )
    {
         $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $event      = $observer->getEvent();
        $order      = $event->getOrder()->getData();
        $incremenId = $order['increment_id'];
        $order = json_encode($order);
        $this->logger->info($incremenId, ['OrderData' => $order ]);
    }
}
