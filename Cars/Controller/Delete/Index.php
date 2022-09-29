<?php
namespace Voronin\Cars\Controller\Delete;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Voronin\Cars\Model\CarsFactory;

class Index extends Action implements HttpGetActionInterface
{
    private CarsFactory $_carsFactory;

    public function __construct(
        Context $context,
        CarsFactory $carsFactory
    ) {
        $this->_carsFactory = $carsFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->_request->getParams();

        try {
            $model = $this->_carsFactory->create();
            $model->load($params['id']);
//            var_dump($mymodel->getData());
            $model->delete();
            $this->messageManager->addSuccessMessage(__('Car data was deleted from DB.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something is wrong! Can\'t delete car data from DB!'));
        }

        //redirect to cars page
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('cars');
        return $redirect;
    }
}
