<?php
namespace Voronin\Cars\Controller\Edit;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\Config;

class Index extends Action implements HttpGetActionInterface
{
    protected PageFactory $_pageFactory;

    private $config;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Config $config
    ) {
        $this->_pageFactory = $pageFactory;
        $this->config = $config;
        parent::__construct($context);
    }

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
