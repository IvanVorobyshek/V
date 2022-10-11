<?php

namespace Voronin\Cars\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class MassDelete extends \Magento\Backend\App\Action
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
     * @param CarsResourceModel $carsResourceModel
     * @param CarsFactory $carsFactory
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
        $selectedIds = $data['selected'];
        $model = $this->_carsFactory->create();
        try {
            foreach ($selectedIds as $selectedId) {
//                $deleteData = $this->_carsFactory->create()->load($selectedId);
//                $deleteData->delete();
                $this->carsResourceModel->load($model, $selectedId);
                $this->carsResourceModel->delete($model);
            }
            $this->messageManager->addSuccessMessage(__('Car data has been successfully deleted.'));
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
