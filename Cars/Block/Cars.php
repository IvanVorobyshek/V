<?php
namespace Voronin\Cars\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Voronin\Cars\Model\ResourceModel\Cars\Collection;

class Cars extends Template
{
    /**
     * @var Collection
     */
    private Collection $collection;

    /**
     * @param Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }

    /**
     * @return Collection
     */
    public function getAllCars(): Collection
    {
        return $this->collection;
    }

    /**
     * @return string
     */
    public function getAddUrl(): string
    {
        return $this->getUrl('cars/add');
    }

    /**
     * @param $id
     * @return string
     */
    public function getEditUrl($id): string
    {
        return $this->getUrl('cars/edit/index/id/' . $id);
    }

    /**
     * @param $id
     * @return string
     */
    public function getDeleteUrl($id): string
    {
        return $this->getUrl('cars/delete/index/id/' . $id);
    }
}
