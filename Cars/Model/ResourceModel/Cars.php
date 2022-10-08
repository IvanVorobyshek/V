<?php
namespace Voronin\Cars\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Voronin\Cars\Api\Data\CarInterface;

class Cars extends AbstractDb
{
    const TABLE_NAME = 'cars';
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, CarInterface::CAR_ID);
    }
}
