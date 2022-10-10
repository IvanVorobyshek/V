<?php

namespace Voronin\Cars\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Request\Http\Proxy;
use Voronin\Cars\Model\CarsFactory;
use Voronin\Cars\Model\ResourceModel\Cars as CarsResourceModel;

class MyViewModelCarsEdit implements ArgumentInterface
{

    /**
     * @var Proxy
     */
    protected $_request;

    /**
     * @var CarsResourceModel
     */
    private CarsResourceModel $carsResourceModel;

    /**
     * @var CarsFactory
     */
    private CarsFactory $_carsFactory;

    public function __construct(
        Proxy $request,
        CarsFactory $carsFactory,
        CarsResourceModel $carsResourceModel,
        array $data = []
    ) {
        $this->_request = $request;
        $this->carsResourceModel = $carsResourceModel;
        $this->_carsFactory = $carsFactory;
    }

    /**
     * @return array|mixed|null
     */
    public function getOutData()
    {
        $params = $this->_request->getParams();
        $model = $this->_carsFactory->create();
        $this->carsResourceModel->load($model, $params['id']);
        return $model->getData();
    }

}
