<?php

namespace Voronin\Cars\Controller\Adminhtml\Index;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $_carsFactory;

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
        $selectedIds = $data['selected'];
        try {
            foreach ($selectedIds as $selectedId) {
                $deleteData = $this->_carsFactory->create()->load($selectedId);
                $deleteData->delete();
            }
            $this->messageManager->addSuccess(__('Car data has been successfully deleted.'));
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
