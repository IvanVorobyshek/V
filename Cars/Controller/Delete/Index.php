<?php
namespace Voronin\Cars\Controller\Delete;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\Config;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class Index extends Action implements HttpGetActionInterface
{
    /**
     * @var CarsFactory
     */
    private CarsFactory $_carsFactory;

    /**
     * @var CarsResourceModel
     */
    private CarsResourceModel $carsResourceModel;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var ForwardFactory
     */
    protected ForwardFactory $_forwardFactory;

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
            //404
            $forward = $this->_forwardFactory->create()->forward('defaultNoRoute');
            return $forward;
        }
    }
}
