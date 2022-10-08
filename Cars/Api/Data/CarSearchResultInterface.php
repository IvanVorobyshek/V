<?php

namespace Voronin\Cars\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface CarSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Voronin\Cars\Api\Data\CarInterface[]
     */
    public function getItems();

    /**
     * @param \Voronin\Cars\Api\Data\CarInterface[] $items
     * @return CarSearchResultInterface
     */
    public function setItems(array $items);
}
