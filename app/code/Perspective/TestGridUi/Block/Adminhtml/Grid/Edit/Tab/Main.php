<?php
namespace Perspective\TestGridUi\Block\Adminhtml\Grid\Edit\Tab;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
/**
 * Blog form block
 */
class Main extends Generic implements TabInterface
{

protected $_coreRegistry = null;
/**
 * @var \Magento\Backend\Model\Auth\Session
 */
protected $_adminSession;
/**
 * @var \Perspective\TestGridUi\Model\Status
 */
protected $_status;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry
    $registry
     * @param \Magento\Framework\Data\FormFactory
    $formFactory
     * @param \Magento\Backend\Model\Auth\Session
    $adminSession
     * @param \Perspective\TestGridUi\Model\Status
    $status
     * @param array
    $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Perspective\TestGridUi\Model\Status $status,
        array $data = []
    ) {
        $this->_adminSession = $adminSession;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * Prepare the form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('perspective_testgridui_form_data');
        $isElementDisabled = false;
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __
        ('Blog Information')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
                'value' => $this->_adminSession->getUser()->getFirstname(),
                'disabled' => $isElementDisabled,
            ]
        );
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Blog Title'),
                'title' => __('Blog Title'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        $contentField = $fieldset->addField(
            'content',
            'textarea',
            [
                'name' => 'content',
                'label' => __('Content'),
                'title' => __('Content'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $fieldset->addField('status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => $this->_status->getOptionArray(),
                'disabled' => $isElementDisabled,
            ]
        );
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '0' : '1');
        }
        $form->addValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('Blog Information');
    }

    public function getTabTitle()
    {
        return __('Blog Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
