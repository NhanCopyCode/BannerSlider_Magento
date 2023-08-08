<?php
namespace Solution\ExampleAdminNewPage\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Solution\ExampleAdminNewPage\Model\BannerFactory;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    protected $resultPageFactory;
    protected $bannerFactory;

    public function __construct(
        PageFactory $resultFactory,
        BannerFactory $bannerFactory
    )
    {
        $this->bannerFactory = $bannerFactory;
        $this->resultPageFactory = $resultFactory;
    }
    public function getBannerData() {
        $bannerCollection = $this->bannerFactory->create()->getCollection();
        return$bannerCollection->getFirstItem();
    }
    public function execute()
    {

            return $this->resultPageFactory->create();
    }
}
