<?php
namespace Solution\ExampleAdminNewPage\Model\ResourceModel;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

    protected function _construct()
    {
        $this->_init('banner', 'id');
    }

//    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
//    {
//        $newImage = $object->getData('image');
//
//        // Check when new image uploaded
//        if ($newImage != null) {
//            $imageUploader = \Magento\Framework\App\ObjectManager::getInstance()
//                ->get('Solution\ExampleAdminNewPage\BannerImageUpload');
//            $imageUploader->moveFileFromTmp($newImage);
//        }
//
//        return $this;
//    }
//    public function beforeSave($object)
//    {
//        $attributeName = $this->getAttribute()->getName();
//        $value = $object->getData($attributeName);
//
//        if ($this->isTmpFileAvailable($value) && $imageName = $this->getUploadedImageName($value)) {
//            try {
//                /** @var StoreInterface $store */
//                $store = $this->storeManager->getStore();
//                $baseMediaDir = $store->getBaseMediaDir();
//                $newImgRelativePath = $this->imageUploader->moveFileFromTmp($imageName, true);
//                $value[0]['url'] = '/' . $baseMediaDir . '/' . $newImgRelativePath;
//                $value[0]['name'] = $value[0]['url'];
//            } catch (\Exception $e) {
//                $this->_logger->critical($e);
//            }
//        } elseif ($this->fileResidesOutsideCategoryDir($value)) {
//            // use relative path for image attribute so we know it's outside of category dir when we fetch it
//            // phpcs:ignore Magento2.Functions.DiscouragedFunction
//            $value[0]['url'] = parse_url($value[0]['url'], PHP_URL_PATH);
//            $value[0]['name'] = $value[0]['url'];
//        }
//
//        if ($imageName = $this->getUploadedImageName($value)) {
//            if (!$this->fileResidesOutsideCategoryDir($value)) {
//                $imageName = $this->checkUniqueImageName($imageName);
//            }
//            $object->setData($this->additionalData . $attributeName, $value);
//            $object->setData($attributeName, $imageName);
//        } elseif (!is_string($value)) {
//            $object->setData($attributeName, null);
//        }
//
//        return parent::beforeSave($object);
//    }
}
