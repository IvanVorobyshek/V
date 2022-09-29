<?php

namespace Voronin\Cars\Ui\DataProvider\Category\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
//        $this->addFilterToMap('entity_id', 'main_table.entity_id');
//        $this->addFilterToMap('name', 'devgridname.value');
        $this->addFilterToMap('car_id', 'main_table.car_id');
        $this->addFilterToMap('car_model', 'voronincarsmodel.car_model');
        parent::_initSelect();
    }
}
