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

//    private $layout;
//
//    public function __construct(LayoutInterface $layout)
//    {
//        $this->layout = $layout;
//    }
//
//    public function getHandles(): array
//    {
//        return $this->layout->getUpdate()->getHandles();
//    }

}
