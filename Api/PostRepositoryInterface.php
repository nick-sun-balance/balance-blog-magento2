<?php

namespace Balance\Blog\Api;

/**
 * Interface PostRepositoryInterface
 * @package Balance\Blog\Api
 */
interface PostRepositoryInterface
{
    /**
     * @param $postId
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function getById($postId);

    /**
     * @param Data\PostInterface $post
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function save(\Balance\Blog\Api\Data\PostInterface $post);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);


    /**
     * @param $postId
     *
     * @return bool
     */
    public function deleteById($postId);
}
