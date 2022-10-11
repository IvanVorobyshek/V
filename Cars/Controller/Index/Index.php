<?php
namespace Voronin\Cars\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Voronin\Cars\Model\Cars;
use Voronin\Cars\Model\Config;
use \Magento\Framework\Controller\Result\ForwardFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;
use Voronin\Cars\Model\CarsFactory;

class Index extends Action
{
    protected PageFactory $_pageFactory;
    private CarsFactory $_carsFactory;

    private Cars $cars;
    private CarsResourceModel $carsResourceModel;

    protected ForwardFactory $_forwardFactory;

    private $config;

    public function __construct(
        Context $context,
        Cars $cars,
        CarsFactory $carsFactory,
        CarsResourceModel $carsResourceModel,
        PageFactory $pageFactory,
        ForwardFactory $_forwardFactory,
        Config $config
    ) {
        $this->_pageFactory = $pageFactory;
        $this->cars = $cars;
        $this->carsResourceModel = $carsResourceModel;
        $this->_carsFactory = $carsFactory;
        $this->config = $config;
        $this->_forwardFactory = $_forwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->config->isEnabled()) {
//            $mysql = new \mysqli('localhost', 'magento_user', 'magento_pass', 'magento_db');
//            $mysql->query("INSERT INTO `cars` (`car_model`) VALUES('asdasd111')");

            $params = ['car_model' => 'asss', 'aaaa' => 'asdasd'];
//            $model = $this->cars->setData($params);
//            $this->carsResourceModel->save($model);

            $model = $this->_carsFactory->create();
//            $this->carsResourceModel->load($model, 60);
            $model->setData($params);
//            var_dump($model);
            $this->carsResourceModel->save($model);


            return $this->_pageFactory->create();
        } else {
            //404
            $forward = $this->_forwardFactory->create()->forward('defaultNoRoute');
            return $forward;
        }
    }
}
