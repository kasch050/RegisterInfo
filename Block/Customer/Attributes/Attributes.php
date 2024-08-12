<?php

namespace Kasch\RegisterInfo\Block\Customer\Attributes;

use Magento\Eav\Api\Data\AttributeInterface;
use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Customer;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Eav\Api\AttributeRepositoryInterface;

class Attributes extends Template {

    const ATTRIBUTE_CODE = 'hear_from_us';
    /**
     * @var CustomerMetadataInterface
     */
    protected CustomerMetadataInterface $_customerMetadata;
    /**
     * @var AttributeRepositoryInterface
     */
    protected AttributeRepositoryInterface $_attributeRepository;

    /**
     * @param Template\Context $context
     * @param CustomerMetadataInterface $customerMetadata
     * @param AttributeRepositoryInterface $attributeRepository
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CustomerMetadataInterface $customerMetadata,
        AttributeRepositoryInterface $attributeRepository,
        array $data = [] ) {
        $this->_customerMetadata = $customerMetadata;
        $this->_attributeRepository = $attributeRepository;
        parent::__construct(
            $context,
            $data );
    }

    /**
     * @param string $attributeCode
     *
     * @return AttributeInterface|null
     */
    protected function getAttribute (string $attributeCode): ?AttributeInterface {
        try {
            return $this->_attributeRepository->get(Customer::ENTITY, $attributeCode);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @return array|null
     */
    public function getCustomerAttributeOptions(): ?array {
        try {
            return $this->getAttribute(self::ATTRIBUTE_CODE)->getOptions();
        } catch (\Exception $e) {
            return [$e->getMessage()];
        }
    }

    /**
     * @return string|null
     */
    public function getCustomerAttributeFrontendLabel ( string $attributeCode = self::ATTRIBUTE_CODE ): ?string {
        try {
            return $this->getAttribute( $attributeCode )->getDefaultFrontendLabel();
        } catch (\Exception $e) {
            return null;
        }
    }

}
