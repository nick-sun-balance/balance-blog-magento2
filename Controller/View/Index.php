<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 19/11/2015
 * Time: 7:12 PM
 */


namespace Balance\Blog\Controller\View;

use \Magento\Framework\App\Action\Action;

class Index extends Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $postId = $this->getRequest()->getParam('post_id', $this->getRequest()->getParam('id', false));
        /** @var \Balance\Blog\Helper\Post $post_helper */
        $postHelper = $this->_objectManager->get('Balance\Blog\Helper\Post');
        $resultPage = $postHelper->prepareResultPost($this, $postId);
        if (!$resultPage) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');
        }
        $model = $this->_objectManager->create('Balance\Blog\Model\Post');
        if (!$model->load($postId)) {
            return false;
        }

        $parameters = [
            'post' => $model
        ];
        $this->_eventManager->dispatch('blog_view_index', $parameters);


        return $resultPage;
    }
}