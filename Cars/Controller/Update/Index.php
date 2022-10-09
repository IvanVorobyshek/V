<?php
namespace Voronin\Cars\Controller\Update;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
//use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Controller\Result\ForwardFactory;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\Config;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class Index extends Action
{
    /**
     * @var CarsFactory
     */
    private CarsFactory $_carsFactory;

    private CarsResourceModel $carsResourceModel;

    /**
     * @var ForwardFactory
     */
    protected ForwardFactory $_forwardFactory;

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Context $context,
        CarsFactory $carsFactory,
        CarsResourceModel $carsResourceModel,
        ForwardFactory $forwardFactory,
        Config $config
    ) {
        $this->_carsFactory = $carsFactory;
        $this->config = $config;
        $this->carsResourceModel = $carsResourceModel;
        $this->_forwardFactory = $forwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()) {
            $params = $this->_request->getParams();
            try {
                $model = $this->_carsFactory->create();
                $this->carsResourceModel->load($model, $params['id']);
                $model->addData($params);
                $this->carsResourceModel->save($model);
                $this->messageManager->addSuccessMessage(__('Car data has been updated.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something is wrong! Can\'t update car data in DB!'));
            }

            //redirect to cars page
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('cars');
            return $redirect;
        } else {
            //404
            $forward = $this->_forwardFactory->create()->forward('defaultNoRoute');
            return $forward;
        }
    }
}
