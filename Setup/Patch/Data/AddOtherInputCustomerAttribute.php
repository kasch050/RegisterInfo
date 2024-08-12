<?php

namespace Kasch\RegisterInfo\Setup\Patch\Data;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Validator\ValidateException;

class AddOtherInputCustomerAttribute implements DataPatchInterface {
	/**
	 * @var ModuleDataSetupInterface
	 */
	private ModuleDataSetupInterface $moduleDataSetup;

	/**
	 * @var EavSetupFactory
	 */
	private EavSetupFactory $eavSetupFactory;

	/**
	 * @var Config
	 */
	private Config $eavConfig;

	/**
	 * @var Attribute
	 */
	private Attribute $attributeResource;

	/**
	 * @param ModuleDataSetupInterface $moduleDataSetup
	 * @param EavSetupFactory $eavSetupFactory
	 * @param Config $eavConfig
	 * @param Attribute $attributeResource
	 */
	public function __construct(
		ModuleDataSetupInterface $moduleDataSetup,
		EavSetupFactory $eavSetupFactory,
		Config $eavConfig,
		Attribute $attributeResource
	) {
		$this->moduleDataSetup   = $moduleDataSetup;
		$this->eavSetupFactory   = $eavSetupFactory;
		$this->eavConfig         = $eavConfig;
		$this->attributeResource = $attributeResource;
	}

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     * @throws LocalizedException
     * @throws ValidateException
     */
	public function apply() {
		/** @var EavSetup $eavSetup */
		$eavSetup = $this->eavSetupFactory->create( [ 'setup' => $this->moduleDataSetup ] );

		$eavSetup->addAttribute(
			Customer::ENTITY,
			'other_input',
			[
				'input'                 => 'text',
				'is_visible_in_grid'    => false,
				'visible'               => true,
				'user_defined'          => true,
				'is_filterable_in_grid' => false,
				'system'                => false,
				'label'                 => 'Eingabe Sonstige',
				'source'                => null,
				'position'              => 11,
				'type'                  => 'varchar',
				'is_used_in_grid'       => false,
				'required'              => false,
			]
		);

		$eavSetup->addAttributeToSet(
			CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
			CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
			'Default',
			'other_input'
		);

		$attribute = $this->eavConfig->getAttribute( Customer::ENTITY, 'other_input' );
		$attribute->setData(
			'used_in_forms',
			[ 'adminhtml_customer', 'customer_account_create' ]
		);
		$this->attributeResource->save( $attribute );

		return $this;
	}

	/**
	 * Get array of patches that have to be executed prior to this.
	 *
	 * Example of implementation:
	 *
	 * [
	 *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
	 *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
	 * ]
	 *
	 * @return string[]
	 */
	public static function getDependencies() {
		return [];
	}

	/**
	 * Get aliases (previous names) for the patch.
	 *
	 * @return string[]
	 */
	public function getAliases() {
		return [];
	}
}
