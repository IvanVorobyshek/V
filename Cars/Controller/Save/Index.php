<?php
namespace Voronin\Cars\Controller\Save;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;
use Voronin\Cars\Model\Cars;
use Voronin\Cars\Model\Config;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class Index extends Action
{
    /**
     * @var Cars
     */
    private Cars $cars;

    /**
     * @var CarsFactory
     */
    private CarsFactory $_carsFactory;

    /**
     * @var CarsResourceModel
     */
    private CarsResourceModel $carsResourceModel;

    /**
     * @var ForwardFactory
     */
    protected ForwardFactory $_forwardFactory;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Context $context
     * @param Cars $cars
     * @param CarsResourceModel $carsResourceModel
     */
    public function __construct(
        Context $context,
        Cars $cars,
        CarsFactory $carsFactory,
        CarsResourceModel $carsResourceModel,
        ForwardFactory $forwardFactory,
        Config $config
    ) {
        $this->cars = $cars;
        $this->_carsFactory = $carsFactory;
        $this->carsResourceModel = $carsResourceModel;
        $this->config = $config;
        $this->_forwardFactory = $forwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()) {
            $params = $this->_request->getParams();
            try {
//                $model = $this->_carsFactory->create();
//                $this->carsResourceModel->load($model);
//                $model->setData($params);

//                $model = $this->_carsFactory->create();
//                $model->setData($params);
//                $this->carsResourceModel->save($model);
//                $params['car_id'] = '38';
//                unset($params['Save']);
//                unset($params['form_key']);
//                var_dump($params);
//                exit();
                $model = $this->cars->setData($params);
                $this->carsResourceModel->save($model);
                $this->messageManager->addSuccessMessage(__('Wow! Data has been added to DB.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something is wrong! Can\'t write data to DB!'));
            }

            //redirect to cars page
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('cars');
        } else {
            //404
            $redirect = $this->_forwardFactory->create()->forward('defaultNoRoute');
            return $redirect;
        }
        return $redirect;
    }
}
