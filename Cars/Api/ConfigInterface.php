<?php
namespace Voronin\Cars\Api;

/**
 * @api
 * Interface ConfigInterface
 * @package Voronin\Cars\api
 */
interface ConfigInterface
{
    const XML_PATH_ENABLED = 'Voronin_Cars_Section_ID/Voronin_Cars_Group_ID/Voronin_Cars_Enabled_ID';

    /**
     * @return mixed
     */
    public function isEnabled(): mixed;
}
