<?php

namespace Voronin\Cars\Plugin;

use Voronin\Cars\Ui\DataProvider\Category\ListingDataProvider as CategoryDataProvider;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class AddAttributesToUiDataProvider
{
    /** @var AttributeRepositoryInterface */
    private $attributeRepository;

    /** @var ProductMetadataInterface */
    private $productMetadata;

    /**
     * Constructor
     *
     * @param AttributeRepositoryInterface $attributeRepository
     * @param ProductMetadataInterface $productMetadata
     */
    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        ProductMetadataInterface $productMetadata
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->productMetadata = $productMetadata;
    }

    /**
     * Get Search Result after plugin
     *
     * @param CategoryDataProvider $subject
     * @param SearchResult $result
     * @return SearchResult
     */
    public function afterGetSearchResult(CategoryDataProvider $subject, SearchResult $result)
    {
        if ($result->isLoaded()) {
            return $result;
        }

//        $edition = $this->productMetadata->getEdition();
//
//        $column = 'car_id';
//
//        if ($edition == 'Enterprise') {
//            $column = 'row_id';
//        }
//
//        $attribute = $this->attributeRepository->get('catalog_category', 'car_model');
//
//        $result->getSelect()->joinLeft(
//            ['voronincarsmodel' => $attribute->getBackendTable()],
//            'voronincarsmodel.' . $column . ' = main_table.' . $column . ' AND voronincarsmodel.attribute_id = '
//            . $attribute->getAttributeId(),
//            ['car_model' => 'voronincarsmodel.value']
//        );

//        $result->getSelect()->where('devgridname.value LIKE "b%"');

        return $result;
    }
}

