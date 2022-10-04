<?php
namespace Voronin\Cars\Controller\Add;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\Config;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected PageFactory $_pageFactory;

    /**
     * @var
     */
    private $config;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Config $config
    ) {
        $this->_pageFactory = $pageFactory;
        $this->config = $config;
        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        if ($this->config->isEnabled()){
            return $this->_pageFactory->create();
        } else {
            //redirect to the main page
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('/');
            return $redirect;
        }
    }
}
