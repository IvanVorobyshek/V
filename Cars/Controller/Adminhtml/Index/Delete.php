<?php

namespace Voronin\Cars\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Voronin\Cars\Model\CarsFactory;

class Delete extends Action
{
    protected $_carsFactory;

    public function __construct(
        Context $context,
        CarsFactory $_carsFactory,
    ){
        $this->_carsFactory = $_carsFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $carId = (int)$this->getRequest()->getParam('id');
        if (!$carId) {
            $this->_redirect('voronin_cars/index/index');
        }
        try {
            $deleteData = $this->_carsFactory->create()->load($carId);
            $deleteData->delete();
            $this->messageManager->addSuccessMessage(__('Car data has been successfully deleted.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something is wrong! Can\'t delete data from DB!'));
        }
        $this->_redirect('voronin_cars/index/index');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Voronin_Cars::home');
    }
}
