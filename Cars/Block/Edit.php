<?php
namespace Voronin\Cars\Block;

use Magento\Framework\App\Request\Http\Proxy;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Voronin\Cars\Model\CarsFactory;

class Edit extends Template
{
    /**
     * @var Proxy
     */
    protected $_request;

    /**
     * @var CarsFactory
     */
    private CarsFactory $_carsFactory;

    /**
     * @param Context $context
     * @param Proxy $request
     * @param CarsFactory $carsFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Proxy $request,
        CarsFactory $carsFactory,
        array $data = []
    ) {
        $this->_request = $request;
        $this->_carsFactory = $carsFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array|mixed|null
     */
    public function getOutData()
    {
        $params = $this->_request->getParams();
        $mymodel = $this->_carsFactory->create();
        $mymodel->load($params['id']);
        return $mymodel->getData();
    }

    /**
     * @return string
     */
    public function getCancelUrl(): string
    {
        return $this->getUrl('cars');
    }

    /**
     * @param $id
     * @return string
     */
    public function getUpdateUrl($id): string
    {
        return $this->getUrl('cars/update/index/id/' . $id);
    }
}
