<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 5/01/16
 * Time: 1:42 PM
 */

namespace Balance\Blog\Observer;

use Magento\Framework\Event\ObserverInterface;

class BlogViewObserver implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $post = $observer->getPost();
        $this->logger->debug('Blog viewed: '. $post->getId());
    }
}