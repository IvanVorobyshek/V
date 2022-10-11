<?php

namespace Voronin\Cars\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class Edit extends Action
{
    private $pageFactory;

    protected $_carsFactory;

    private $coreRegistry;

    /**
     * @var CarsResourceModel
     */
    private CarsResourceModel $carsResourceModel;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CarsFactory $_carsFactory,
        CarsResourceModel $carsResourceModel,
        \Magento\Framework\Registry $coreRegistry
    ){
        $this->pageFactory = $pageFactory;
        $this->_carsFactory = $_carsFactory;
        $this->coreRegistry = $coreRegistry;
        $this->carsResourceModel = $carsResourceModel;
        parent::__construct($context);
    }

    public function execute(): Page
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Magento_Catalog::catalog_products');
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = '';

        if ($rowId){
//            $rowData = $this->_carsFactory->create()->load($rowId);

            $rowData = $this->_carsFactory->create();
            $this->carsResourceModel->load($rowData, $rowId);
            $rowData->getData();
            if(!$rowData->getId()){
                $this->messageManager->addErrorMessage(__('Car data no longer exist.'));
                $this->_redirect('voronin_cars/index/index');
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $title = $rowId ? __('Edit car ') : __('!Add car!');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Voronin_Cars::home');
    }
}
