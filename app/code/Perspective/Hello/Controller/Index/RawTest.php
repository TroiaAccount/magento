<?php
declare(strict_types=1);
namespace Perspective\Hello\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Raw;

class RawTest implements HttpGetActionInterface
{
    protected $raw;
    public function __construct (Raw $raw)
    {
        $this->raw = $raw;
    }

    public function execute()
    {
        $content = 'This is a raw response from Magento';
        $resultRaw = $this->raw->setContents($content);
        return $resultRaw;
    }
}
