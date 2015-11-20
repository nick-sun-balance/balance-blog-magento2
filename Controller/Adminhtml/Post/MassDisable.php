<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 20/11/2015
 * Time: 9:24 AM
 */

namespace Balance\Blog\Controller\Adminhtml\Post;

use Balance\Blog\Controller\Adminhtml\AbstractMassStatus;

/**
 * Class MassDisable
 */
class MassDisable extends AbstractMassStatus
{
    /**
     * Field id
     */
    const ID_FIELD = 'post_id';

    /**
     * Resource collection
     *
     * @var string
     */
    protected $collection = 'Balance\Blog\Model\ResourceModel\Post\Collection';

    /**
     * Post model
     *
     * @var string
     */
    protected $model = 'Balance\Blog\Model\Post';

    /**
     * Post disable status
     *
     * @var boolean
     */
    protected $status = false;
}
