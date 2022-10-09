<?php
namespace Voronin\Cars\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\Config;
use \Magento\Framework\Controller\Result\ForwardFactory;

class Index extends Action
{
    protected PageFactory $_pageFactory;

    protected ForwardFactory $_forwardFactory;

    private $config;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ForwardFactory $_forwardFactory,
        Config $config
    ) {
        $this->_pageFactory = $pageFactory;
        $this->config = $config;
        $this->_forwardFactory = $_forwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()) {
            return $this->_pageFactory->create();
        } else {
            //404
            $forward = $this->_forwardFactory->create()->forward('defaultNoRoute');
            return $forward;
        }
    }
}
