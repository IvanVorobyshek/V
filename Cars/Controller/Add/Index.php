<?php
namespace Voronin\Cars\Controller\Add;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\Config;

class Index extends Action
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
        ForwardFactory $forwardFactory,
        Config $config
    ) {
        $this->_pageFactory = $pageFactory;
        $this->config = $config;
        $this->_forwardFactory = $forwardFactory;
        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
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
