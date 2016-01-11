<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 11/01/16
 * Time: 11:27 AM
 */

namespace Balance\Blog\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

class PostRepository implements \Balance\Blog\Api\PostRepositoryInterface
{
    /**
     * @var \Balance\Blog\Model\ResourceModel\Post
     */
    protected $resource;

    /**
     * @var \Balance\Blog\Model\PostFactory
     */
    protected $postFactory;

    /**
     * @var \Balance\Blog\Model\ResourceModel\Post\CollectionFactory
     */
    protected $postCollectionFactory;

    /**
     * @var \Magento\Framework\Api\SearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \Balance\Blog\Api\Data\PostInterfaceFactory
     */
    protected $dataPostFactory;

    /**
     * @param ResourceModel\Post                            $resource
     * @param PostFactory                                   $postFactory
     * @param ResourceModel\Post\CollectionFactory          $postCollectionFactory
     * @param \Magento\Framework\Api\SearchResultsInterface $searchResultsFactory
     * @param DataObjectHelper                              $dataObjectHelper
     * @param DataObjectProcessor                           $dataObjectProcessor
     * @param \Balance\Blog\Api\Data\PostInterfaceFactory   $dataPostFactory
     */
    public function __construct(
        \Balance\Blog\Model\ResourceModel\Post $resource,
        \Balance\Blog\Model\PostFactory $postFactory,
        \Balance\Blog\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory,
        \Magento\Framework\Api\SearchResultsInterface $searchResultsFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor,
        \Balance\Blog\Api\Data\PostInterfaceFactory $dataPostFactory

    )
    {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataPostFactory = $dataPostFactory;
    }


    /**
     * Retrieve post entity.
     *
     * @api
     *
     * @param int $postId
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If post with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($postId)
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $postId);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Post with id %1 does not exist.', $postId));
        }
        return $post;
    }


    /**
     * Save post.
     *
     * @param \Balance\Blog\Api\Data\PostInterface $post
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Balance\Blog\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $post;
    }

    /**
     * Retrieve posts matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $this->searchResultsFactory->setSearchCriteria($searchCriteria);

        $collection = $this->postCollectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $this->searchResultsFactory->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {

            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    (strtoupper($sortOrder->getDirection()) === 'ASC') ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $posts = [];
        /** @var \Balance\Blog\Model\Post $postModel */
        foreach ($collection as $postModel) {
            $postData = $this->dataPostFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $postData,
                $postModel->getData(),
                '\Balance\Blog\Api\Data\PostInterface'
            );
            $posts[] = $this->dataObjectProcessor->buildOutputDataArray(
                $postData,
                '\Balance\Blog\Api\Data\PostInterface'
            );
        }
        $this->searchResultsFactory->setItems($posts);
        return $this->searchResultsFactory;
    }


    /**
     * Delete Post
     *
     * @param \Balance\Blog\Api\Data\PostInterface $post
     *
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Balance\Blog\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete post by ID.
     *
     * @param int $postId
     *
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postId)
    {
        return $this->delete($this->getById($postId));
    }
}
