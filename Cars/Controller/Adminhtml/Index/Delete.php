<?php

namespace Voronin\Cars\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class Delete extends Action
{
    /**
     * @var CarsFactory
     */
    protected $_carsFactory;

    /**
     * @var CarsResourceModel
     */
    private CarsResourceModel $carsResourceModel;

    /**
     * @param Context $context
     * @param CarsFactory $_carsFactory
     * @param CarsResourceModel $carsResourceModel
     */
    public function __construct(
        Context $context,
        CarsFactory $_carsFactory,
        CarsResourceModel $carsResourceModel,
    ){
        $this->_carsFactory = $_carsFactory;
        $this->carsResourceModel = $carsResourceModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $carId = (int)$this->getRequest()->getParam('id');
        if (!$carId) {
            $this->_redirect('voronin_cars/index/index');
        }
        try {
//            $deleteData = $this->_carsFactory->create()->load($carId);
//            $deleteData->delete();
            $model = $this->_carsFactory->create();
            $this->carsResourceModel->load($model, $carId);
            $this->carsResourceModel->delete($model);
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
