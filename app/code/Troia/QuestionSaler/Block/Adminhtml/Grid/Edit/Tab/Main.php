<?php
namespace Troia\QuestionSaler\Block\Adminhtml\Grid\Edit\Tab;
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
     * @var \Troia\QuestionSaler\Model\Options
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
     * @param \Troia\QuestionSaler\Model\Options
    $status
     * @param array
    $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Troia\QuestionSaler\Model\Options $status,
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

        $model = $this->_coreRegistry->registry('troia_questionsaler_form_data');
        $isElementDisabled = false;
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Question saler')]);
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
                'disabled' => true,
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
                'required' => true,
                'disabled' => true,
            ]
        );
        $fieldset->addField(
            'telephone',
            'text',
            [
                'name' => 'telephone',
                'label' => __('Telephone'),
                'title' => __('Telephone'),
                'required' => true,
                'disabled' => true,
            ]
        );
        $fieldset->addField(
            'question',
            'textarea',
            [
                'name' => 'question',
                'label' => __('Question'),
                'title' => __('Question'),
                'required' => true,
                'disabled' => true,
            ]
        );
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
        $fieldset->addField(
            'answer',
            'textarea',
            [
                'name' => 'answer',
                'label' => __('Answer'),
                'title' => __('Answer'),
                'required' => false,
                'disabled' => false,
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
        return __('Question saler');
    }

    public function getTabTitle()
    {
        return __('Question saler');
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
