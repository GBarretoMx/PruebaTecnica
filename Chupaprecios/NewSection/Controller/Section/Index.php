<?php
declare(strict_types=1);
namespace Chupaprecios\NewSection\Controller\Section;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{

    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;


    protected ScopeConfigInterface $scopeConfig;


    /**
     * @param PageFactory $resultPageFactory
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        PageFactory $resultPageFactory,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig       = $scopeConfig;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('ChupaPrecios'));
        return $resultPage;
    }

}
