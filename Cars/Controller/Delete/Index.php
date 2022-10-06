<?php
namespace Voronin\Cars\Controller\Delete;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;
use Voronin\Cars\Model\Config;

class Index extends Action implements HttpGetActionInterface
{
    private CarsFactory $_carsFactory;

    private CarsResourceModel $carsResourceModel;

    private $config;

    public function __construct(
        Context $context,
        CarsFactory $carsFactory,
        CarsResourceModel $carsResourceModel,
        Config $config
    ) {
        $this->_carsFactory = $carsFactory;
        $this->config = $config;
        $this->carsResourceModel = $carsResourceModel;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()){
            $params = $this->_request->getParams();

            try {
                $model = $this->_carsFactory->create();
                $this->carsResourceModel->load($model, $params['id']);
                $this->carsResourceModel->delete($model);
                $this->messageManager->addSuccessMessage(__('Car data was deleted from DB.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something is wrong! Can\'t delete car data from DB!'));
            }

            //redirect to cars page
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('cars');
            return $redirect;
        } else {
            //redirect to the main page
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('/');
            return $redirect;
        }


    }
}
