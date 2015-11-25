<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 20/11/2015
 * Time: 9:57 AM
 */

namespace Balance\Blog\Controller\Adminhtml\Post;
use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Balance_Blog::delete');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Balance\Blog\Model\Post $model */
            $model = $this->_objectManager->create('Balance\Blog\Model\Post');

            $id = $this->getRequest()->getParam('post_id');
            if ($id) {
                $model->load($id);
            }

            $this->_eventManager->dispatch(
                'blog_post_prepare_delete',
                ['post' => $model, 'request' => $this->getRequest()]
            );

            try {
                $postTitle = $model->getData('title');
                $model->delete();
                $this->messageManager->addSuccess(__(sprintf('You deleted this Post: %s.', $postTitle)));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
//                if ($this->getRequest()->getParam('back')) {
//                    return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId(), '_current' => true]);
//                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while deleting the post.'));
            }

//            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/index');
        }
        return $resultRedirect->setPath('*/*/');
    }
}