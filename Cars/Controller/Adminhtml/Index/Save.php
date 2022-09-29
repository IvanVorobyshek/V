<?php

namespace Voronin\Cars\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    /**

     */
    protected $_carsFactory;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param Voronin\Cars\Model\CarsFactory $carsFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Voronin\Cars\Model\CarsFactory $carsFactory
    )
    {
        $this->_carsFactory = $carsFactory;
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
            $rowData = $this->_carsFactory->create()->load($carId);
            if (!$rowData->getId() && $carId) {
                $this->messageManager->addError(__('Car data no longer exist.'));
                $this->_redirect('voronin_cars/index/index');
            }
            $rowData->setData($data);
            $rowData->save();
            $this->messageManager->addSuccess(__('Car data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
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
