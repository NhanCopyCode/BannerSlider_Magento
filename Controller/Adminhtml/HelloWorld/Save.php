<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Solution\ExampleAdminNewPage\Controller\Adminhtml\HelloWorld;
//
//use Magento\Backend\App\Action;
//use Magento\Backend\Model\View\Result\Redirect;
//use Magento\Cms\Api\Data\PageInterface;
//use Magento\Cms\Api\PageRepositoryInterface;
//use Solution\ExampleAdminNewPage\Model\Banner;
//use Magento\Cms\Model\PageFactory;
//use Magento\Framework\App\Action\HttpPostActionInterface;
//use Magento\Framework\App\ObjectManager;
//use Magento\Framework\App\Request\DataPersistorInterface;
//use Magento\Framework\Controller\ResultInterface;
//use Magento\Framework\Exception\LocalizedException;
//
///**
// * Save CMS page action.
// *
// * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
// */
//class Save extends Action implements HttpPostActionInterface
//{
//    /**
//     * Authorization level of a basic admin session
//     *
//     * @see _isAllowed()
//     */
//    const ADMIN_RESOURCE = 'Solution_ExampleAdminNewPage::save';
//
//    /**
//     * @var PostDataProcessor
//     */
//    protected $dataProcessor;
//
//    /**
//     * @var DataPersistorInterface
//     */
//    protected $dataPersistor;
//
//    /**
//     * @var PageFactory
//     */
//    private $pageFactory;
//
//    /**
//     * @var PageRepositoryInterface
//     */
//    private $pageRepository;
//
//    /**
//     * @param Action\Context $context
//     * @param PostDataProcessor $dataProcessor
//     * @param DataPersistorInterface $dataPersistor
//     * @param PageFactory|null $pageFactory
//     * @param PageRepositoryInterface|null $pageRepository
//     */
//    public function __construct(
//        Action\Context $context,
//        PostDataProcessor $dataProcessor,
//        DataPersistorInterface $dataPersistor,
//        PageFactory $pageFactory = null,
//        PageRepositoryInterface $pageRepository = null
//    ) {
//        $this->dataProcessor = $dataProcessor;
//        $this->dataPersistor = $dataPersistor;
//        $this->pageFactory = $pageFactory ?: ObjectManager::getInstance()->get(PageFactory::class);
//        $this->pageRepository = $pageRepository ?: ObjectManager::getInstance()->get(PageRepositoryInterface::class);
//        parent::__construct($context);
//    }
//
//    /**
//     * Save action
//     *
//     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
//     * @return ResultInterface
//     */
//    public function execute()
//    {
//        $data = $this->getRequest()->getPostValue();
//        /** @var Redirect $resultRedirect */
//        $resultRedirect = $this->resultRedirectFactory->create();
//        if ($data) {
//
//            if (empty($data['id'])) {
//                $data['id'] = null;
//            }
//
//            /** @var Banner $model */
//            $model = $this->pageFactory->create();
//
//            $id = $this->getRequest()->getParam('id');
//            if ($id) {
//                try {
//                    $model = $this->pageRepository->getById($id);
//                } catch (LocalizedException $e) {
//                    $this->messageManager->addErrorMessage(__('This page no longer exists.'));
//                    return $resultRedirect->setPath('*/*/');
//                }
//            }
//            // Validate data
//            if (!$this->dataProcessor->validateRequireEntry($data)) {
//                // Redirect to Edit page if has error
//                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
//            }
//
//            $model->setData($data);
//
//            try {
//                $this->pageRepository->save($model);
//                $this->messageManager->addSuccessMessage(__('You saved the page.'));
//                return $this->processResultRedirect($model, $resultRedirect, $data);
//            } catch (LocalizedException $e) {
//                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
//            } catch (\Throwable $e) {
//                $this->messageManager->addErrorMessage(__('Something went wrong while saving the page.'));
//            }
//
//            $this->dataPersistor->set('banner', $data);
//            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
//        }
//        return $resultRedirect->setPath('*/*/');
//    }
//
//    /**
//     * Process result redirect
//     *
//     * @param PageInterface $model
//     * @param Redirect $resultRedirect
//     * @param array $data
//     * @return Redirect
//     * @throws LocalizedException
//     */
//    private function processResultRedirect($model, $resultRedirect, $data)
//    {
//        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
//            $newPage = $this->pageFactory->create(['data' => $data]);
//            $newPage->setId(null);
//            $identifier = $model->getIdentifier() . '-' . uniqid();
//            $newPage->setIdentifier($identifier);
//            $newPage->setIsActive(false);
//            $this->pageRepository->save($newPage);
//            $this->messageManager->addSuccessMessage(__('You duplicated the page.'));
//            return $resultRedirect->setPath(
//                '*/*/edit',
//                [
//                    'id' => $newPage->getId(),
//                    '_current' => true,
//                ]
//            );
//        }
//        $this->dataPersistor->clear('banner');
//        if ($this->getRequest()->getParam('back')) {
//            return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
//        }
//        return $resultRedirect->setPath('*/*/');
//    }
//}
use Magento\Framework\App\ResponseInterface;
use Solution\ExampleAdminNewPage\Model\BannerFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    private $bannerFactory;

    public function __construct( Action\Context $context, BannerFactory $bannerFactory) {
        parent::__construct($context);
        $this->bannerFactory = $bannerFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['id']) ? $data['id'] : null;

        $newData = [
            'image' => $data['images'][0]['name'],
            'link' => $data['link'],
            'comment' => $data['comment'],
        ];

        $post = $this->bannerFactory->create();

        if ($id) {
            $post->load($id);
        }
//        echo "<pre>";
//        print_r($data['images']);
//        echo "</pre>";
//        die;

        try {
            $post->addData($newData);
            $post->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Save failed.'));
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        return $this->resultRedirectFactory->create()->setPath('banner/helloworld/index');
    }
}

