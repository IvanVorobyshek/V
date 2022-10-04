<?php
namespace Voronin\Cars\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\Config;

class Index extends Action implements HttpGetActionInterface
{
    protected PageFactory $_pageFactory;

    protected CarsFactory $_carsFactory;

    protected UrlInterface $_urlBuilder;

    private $config;

    protected $_request;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CarsFactory $carsFactory,
        RequestInterface $request,
        UrlInterface $urlBuilder,
        Config $config
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_carsFactory = $carsFactory;
        $this->_request = $request;
        $this->_urlBuilder = $urlBuilder;
        $this->config = $config;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()) {
            return $this->_pageFactory->create();
        } else {
            //redirect to the main page
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('/');
            return $redirect;
        }
    }
}
