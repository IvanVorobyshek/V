<?php

namespace Voronin\Cars\Controller\Adminhtml\Index;
use Magento\Backend\App\Action\Context;
use Voronin\Cars\Controller\Adminhtml\Index\Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var CarsFactory|\Voronin\Cars\Model\CarsFactory
     */
    protected $_carsFactory;

    /**
     * @var CarsResourceModel
     */
    private CarsResourceModel $carsResourceModel;


    /**
     * @param Context $context
     * @param CarsResourceModel $carsResourceModel
     * @param \Voronin\Cars\Model\CarsFactory $carsFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        CarsResourceModel $carsResourceModel,
        \Voronin\Cars\Model\CarsFactory $carsFactory
    )
    {
        $this->_carsFactory = $carsFactory;
        $this->carsResourceModel = $carsResourceModel;
        parent::__construct($context);
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $carId = isset($data['car_id']) ? $data['car_id'] : '';
        if (!$data) {
            $this->_redirect('voronin_cars/index/index');
        }
        try {
//            $rowData = $this->_carsFactory->create()->load($carId);
            $rowData = $this->_carsFactory->create();
            $rowData->setData($data);
            if (!$rowData->getId() && $carId) {
                $this->messageManager->addErrorMessage(__('Car data no longer exist.'));
                $this->_redirect('voronin_cars/index/index');
            }
            $this->carsResourceModel->save($rowData);
//            $rowData->setData($data);
//            $rowData->save();
            $this->messageManager->addSuccessMessage(__('Car data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('voronin_cars/index/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Voronin_Cars::home');
    }
}
