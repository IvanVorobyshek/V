<?php
namespace Voronin\Cars\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\CarsFactory;

class Index extends Action implements HttpGetActionInterface
{
    protected PageFactory $_pageFactory;

    protected CarsFactory $_carsFactory;

    protected UrlInterface $_urlBuilder;

    protected $_request;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CarsFactory $carsFactory,
        RequestInterface $request,
        UrlInterface $urlBuilder
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_carsFactory = $carsFactory;
        $this->_request = $request;
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
