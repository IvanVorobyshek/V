<?php

namespace Voronin\Cars\Api\Data;

interface CarInterface
{
    const CAR_ID = 'car_id';
    const CAR_MODEL = 'car_model';
    const CAR_MANUFACTURER = 'car_manufacturer';
    const CAR_DESCRIPTION = 'car_description';
    const CAR_RELEASE_YEAR = 'car_release_year';
    const CAR_CREATED_AT = 'car_created_at';
    const CAR_UPDATED_AT = 'car_updated_at';

    /**
     * @return int
     */
    public function getId():int;

    /**
     * @param int $id
     * @return mixed
     */
    public function setId(int $id);

    /**
     * @return string
     */
    public function getCarModel():string;

    /**
     * @param $carModel
     * @return CarInterface
     */
    public function setCarModel(string $carModel):CarInterface;

    /**
     * @return string
     */
    public function getCarManufacturer():string;

    /**
     * @param string $carManufacturer
     * @return CarInterface
     */
    public function setCarManufacturer(string $carManufacturer):CarInterface;

    /**
     * @return string
     */
    public function getCarDescription():string;

    /**
     * @param string $carDescription
     * @return CarInterface
     */
    public function setCarDescription(string $carDescription):CarInterface;

    /**
     * @return int
     */
    public function getCarRealeaseYear():string;

    /**
     * @param int $carRealeaseYear
     * @return CarInterface
     */
    public function setCarReleaseYear(string $carRealeaseYear):CarInterface;

    /**
     * @return string
     */
    public function getCarCreatedAt():string;

    /**
     * @param string $carCreatedAt
     * @return CarInterface
     */
    public function setCarCreatedAt(string $carCreatedAt):CarInterface;

    /**
     * @return string
     */
    public function getCarUpdatedAt():string;

    /**
     * @param string $carUpdatedAt
     * @return CarInterface
     */
    public function setCarUpdatedAt(string $carUpdatedAt):CarInterface;
}
