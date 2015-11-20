<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 19/11/2015
 * Time: 4:46 PM
 */

namespace Balance\Blog\Model\ResourceModel\Post;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';

    protected $_eventPrefix = 'blog_post_collection';

    protected $_eventObject = 'post_collection';
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Balance\Blog\Model\Post', 'Balance\Blog\Model\ResourceModel\Post');
        $this->_map['fields']['post_id'] = 'main_table.post_id';
    }
}