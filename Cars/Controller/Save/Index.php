<?php
namespace Voronin\Cars\Controller\Save;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Voronin\Cars\Model\Cars;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;
use Voronin\Cars\Model\Config;

class Index extends Action
{
    private Cars $cars;

    private CarsResourceModel $carsResourceModel;

    private $config;

    /**
     * @param Context $context
     * @param Cars $cars
     * @param CarsResourceModel $carsResourceModel
     */
    public function __construct(
        Context $context,
        Cars $cars,
        CarsResourceModel $carsResourceModel,
        Config $config
    ) {
        $this->cars = $cars;
        $this->carsResourceModel = $carsResourceModel;
        $this->config = $config;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()){
            $params = $this->_request->getParams();
            $model = $this->cars->setData($params);
            try {
                $this->carsResourceModel->save($model);
                $this->messageManager->addSuccessMessage(__('Wow! Data was added to DB.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something is wrong! Can\'t write data to DB!'));
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
