<?php
namespace Voronin\Cars\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Add extends Template
{
    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getCancelUrl(): string
    {
        return $this->getUrl('cars');
    }

    /**
     * @return string
     */
    public function getSaveUrl(): string
    {
        return $this->getUrl('cars/save');
    }
}
