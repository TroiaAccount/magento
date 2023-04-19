<?php
declare(strict_types=1);
namespace Perspective\Hello\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;

class JsonTest implements HttpGetActionInterface
{
    protected $JsonFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        JsonFactory $JsonFactory
    )
    {
        $this->JsonFactory = $JsonFactory;
    }
    public function execute()
    {

        return $this->JsonFactory->create(['fdasdf' => 'adfasdf']);
    }
}
