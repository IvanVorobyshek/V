<?php

namespace Voronin\Cars\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\FrameWork\View\LayoutInterface;
use Voronin\Cars\Model\ResourceModel\Cars\Collection;

class MyViewModel implements ArgumentInterface
{
    /**
     * @var Collection
     */
    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return Collection
     */
    public function getAllCars(): Collection
    {
        return $this->collection;
    }
}
