<?php

namespace Balance\Blog\Api;

/**
 * Interface PostRepositoryInterface
 * @package Balance\Blog\Api
 */
interface PostRepositoryInterface
{
    /**
     * @param int $postId
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If post with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
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
     * @param int $postId
     *
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function deleteById($postId);
}
