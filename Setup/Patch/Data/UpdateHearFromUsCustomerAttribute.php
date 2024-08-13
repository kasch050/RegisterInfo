<?php

namespace Kasch\RegisterInfo\Setup\Patch\Data;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class UpdateHearFromUsCustomerAttribute implements DataPatchInterface {
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
	 */
	public function apply() {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->updateAttribute(
            Customer::ENTITY,
            'hear_from_us',
            'frontend_label',
            'How did you hear about us'
        );
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
