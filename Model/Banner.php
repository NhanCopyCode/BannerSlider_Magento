<?php

namespace Solution\ExampleAdminNewPage\Model;

use Magento\Framework\Model\AbstractModel;

class Banner extends AbstractModel {
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    protected function _construct() {
       $this->_init('Solution\ExampleAdminNewPage\Model\ResourceModel\Banner');
   }
}
