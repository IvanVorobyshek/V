<?php

namespace Voronin\Cars\Block\Adminhtml\Cars\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

/**
 * Class Form
 * @package MageDigest\CustomerReview\Block\Adminhtml\Reviews\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var
     */
    protected $_systemStore;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Form
     * @throws LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(['data' => ['id' => 'edit_form', 'enctype' => 'multipart/form-data', 'action' => $this->getData('action'), 'method' => 'post']]);
        $form->setHtmlIdPrefix('voronin_cars_');
        if ($model) {
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Car Data'), 'class' => 'fieldset-wide']);
            $fieldset->addField('car_id', 'hidden', ['name' => 'car_id']);
        } else {
            $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Car Data'), 'class' => 'fieldset-wide']);
        }
        $fieldset->addField(
            'car_model',
            'text',
            [
                'name' => 'car_model',
                'label' => __('Car Model'),
                'title' => __('Car Model'),
                'class' => 'required-entry',
                'required' => true,
//                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'car_manufacturer',
            'text',
            [
                'name' => 'car_manufacturer',
                'label' => __('Car Manufacturer'),
                'title' => __('Car Manufacturer'),
                'class' => 'required-entry',
                'required' => true,
//                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'car_description',
            'text',
            [
                'name' => 'car_description',
                'label' => __('Car Description'),
                'title' => __('Car Description'),
                'class' => 'required-entry',
                'required' => true,
//                'disabled' => $model ? true : false,
            ]
        );
        $fieldset->addField(
            'car_release_year',
            'text',
            [
                'name' => 'car_release_year',
                'label' => __('Car Release Year'),
                'title' => __('Car Release Year'),
                'class' => 'required-entry',
                'required' => true,
//                'disabled' => $model ? true : false,
            ]
        );
        $form->setValues($model ? $model->getData() : '');
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
