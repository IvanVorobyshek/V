<?php

namespace Voronin\Cars\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const XML_PATH_ENABLED = 'Voronin_Cars_Section_ID/Voronin_Cars_Group_ID/Voronin_Cars_Enabled_ID';

    /**
     * @var ScopeConfigInterface
     */
    private $config;

    /**
     * @param ScopeConfigInterface $config
     */
    public function __construct(ScopeConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function isEnabled(): mixed
    {
        return $this->config->getValue(self::XML_PATH_ENABLED);
    }
}
