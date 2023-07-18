<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Solution\ExampleAdminNewPage\Controller\Adminhtml\HelloWorld;

use Magento\Cms\Model\Page\DomValidationState;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Config\Dom\ValidationException;
use Magento\Framework\Config\Dom\ValidationSchemaException;
use Magento\Cms\Model\Page\CustomLayout\CustomLayoutValidator;
use Magento\Framework\Filter\FilterInput;

/**
 * Controller helper for user input.
 */
class PostDataProcessor
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;

    /**
     * @var \Magento\Framework\View\Model\Layout\Update\ValidatorFactory
     */
    protected $validatorFactory;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var DomValidationState
     */
    private $validationState;

    /**
     * @var CustomLayoutValidator
     */
    private $customLayoutValidator;


    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
    ) {
        $this->messageManager = $messageManager;
    }


    /**
     * Check if required fields is not empty
     *
     * @param array $data
     * @return bool
     */
    public function validateRequireEntry(array $data)
    {
        $requiredFields = [
            'image' => __('Image'),
            'link' => __('Link'),
            'comment' => __('Comment')
        ];
        $errorNo = true;
        foreach ($data as $field => $value) {
            if (in_array($field, array_keys($requiredFields)) && $value == '') {
                $errorNo = false;
                $this->messageManager->addErrorMessage(
                    __('To apply changes you should fill in hidden required "%1" field', $requiredFields[$field])
                );
            }
        }
        return $errorNo;
    }


}
