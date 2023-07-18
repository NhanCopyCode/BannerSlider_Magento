<?php
namespace Solution\ExampleAdminNewPage\Model\ResourceModel\Banner;

use Magento\Framework\Event\ManagerInterface;
use Solution\ExampleAdminNewPage\Model\Banner;
use Solution\ExampleAdminNewPage\Model\ResourceModel\Banner as BannerResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init(
            Banner::class,
            BannerResourceModel::class
        );
    }


}
