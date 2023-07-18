<?php

namespace Solution\ExampleAdminNewPage\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Solution\ExampleAdminNewPage\Model\BannerFactory;
use Solution\ExampleAdminNewPage\Model\ResourceModel\Banner\Collection;

class ShowData extends Template
{
    protected $bannerFactory;

    public $collection;

    public function __construct(Context $context, Collection $collectionFactory, BannerFactory $bannerFactory, array $data = [])
    {
        $this->bannerFactory = $bannerFactory;
        $this->collection = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        $banner = $this->bannerFactory->create();
        $collection = $banner->getCollection();

//        foreach ($collection as $item) {
//            echo "<pre>";
//            print_r($item->getData());
//            echo "</pre>";
//        }
        return $collection;
    }

}
