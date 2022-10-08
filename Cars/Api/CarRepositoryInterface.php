<?php

namespace Voronin\Cars\Api;

use Voronin\Cars\Api\Data\CarInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface CarRepositoryInterface
{
    public function get(int $id);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function save(CarInterface $car);

    public function delete(CarInterface $car);

    public function deleteById(int $id);

}
