<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 19/11/2015
 * Time: 3:59 PM
 */

namespace Balance\Blog\Api\Data;

interface PostInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const POST_ID = 'post_id';
    const URL_KEY = 'url_key';
    const TITLE = 'title';
    const CONTENT = 'content';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';
    const IS_ACTIVE = 'is_active';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function setId($id);

    /**
     * Set URL Key
     *
     * @param string $url_key
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function setUrlKey($url_key);

    /**
     * Set title
     *
     * @param string $title
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     *
     * @return \Balance\Blog\Api\Data\PostInterface
     */
    public function setIsActive($isActive);

}