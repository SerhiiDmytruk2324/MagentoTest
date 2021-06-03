<?php
/**
 * Copyright © Elogic.
 * 2020.09.22
 */
namespace Elogic\Vendor\Model;

use Magento\Framework\Model\AbstractModel;

class Vendor extends AbstractModel{

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = "id"; // parent value is 'id'

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Vendor::class);
    }

    /**
     * Return data, used for editing form
     * @return mixed
     */
    public function getDataForForm()
    {
        return $this->getData();
    }
}