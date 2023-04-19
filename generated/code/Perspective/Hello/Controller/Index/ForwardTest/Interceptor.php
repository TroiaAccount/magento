<?php
namespace Perspective\Hello\Controller\Index\ForwardTest;

/**
 * Interceptor class for @see \Perspective\Hello\Controller\Index\ForwardTest
 */
class Interceptor extends \Perspective\Hello\Controller\Index\ForwardTest implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\Model\View\Result\Forward $forward)
    {
        $this->___init();
        parent::__construct($forward);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }
}
