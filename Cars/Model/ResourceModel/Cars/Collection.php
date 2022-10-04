<?php
namespace Voronin\Cars\Model\ResourceModel\Cars;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'car_id';
    protected $_eventPrefix = 'voronin_cars_cars_collection';
    protected $_eventObject = 'cars_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Voronin\Cars\Model\Cars', 'Voronin\Cars\Model\ResourceModel\Cars');
    }
}
