<?php

namespace Voronin\Cars\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Request\Http\Proxy;
use Voronin\Cars\Model\CarsFactory;


class MyViewModelCarsEdit implements ArgumentInterface
{

    /**
     * @var Proxy
     */
    protected $_request;

    /**
     * @var CarsFactory
     */
    private CarsFactory $_carsFactory;

    public function __construct(
        Proxy $request,
        CarsFactory $carsFactory,
        array $data = []
    ) {
        $this->_request = $request;
        $this->_carsFactory = $carsFactory;
    }

    /**
     * @return array|mixed|null
     */
    public function getOutData()
    {
        $params = $this->_request->getParams();
        $model = $this->_carsFactory->create();
        $model->load($params['id']);
        return $model->getData();
    }

}
