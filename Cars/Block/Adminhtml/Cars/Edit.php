<?php

namespace Voronin\Cars\Block\Adminhtml\Cars;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, array $data = [])
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'car_id';
        $this->_blockGroup = 'Voronin_Cars';
        $this->_controller = 'adminhtml_cars';
        parent::_construct();
        if ($this->_isAllowedAction('Voronin_Cars::edit')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }

    /**
     * @return Phrase|string
     */
    public function getHeaderText(): \Magento\Framework\Phrase|string
    {
        return __('Edit Car');
    }

    /**
     * @param $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId): bool
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getFormActionUrl(): mixed
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }
}
