<?php
namespace Voronin\Cars\Controller\Edit;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\Config;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected PageFactory $_pageFactory;

    /**
     * @var ForwardFactory
     */
    protected ForwardFactory $_forwardFactory;

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ForwardFactory $forwardFactory,
        Config $config
    ) {
        $this->_pageFactory = $pageFactory;
        $this->config = $config;
        $this->_forwardFactory = $forwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()){
            return $this->_pageFactory->create();
        } else {
            //404
            $forward = $this->_forwardFactory->create()->forward('defaultNoRoute');
            return $forward;
        }

    }
}
