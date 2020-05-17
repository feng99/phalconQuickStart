<?php

namespace App\Sdks\Models\Mongo;

use App\Sdks\Core\Traits\CacheTraits;
use App\Sdks\Library\Helpers\DiHelper;

/**
 * mongo实体层基类
 *
 * 
 */
abstract class MongoEntity
{
    use CacheTraits;

    protected $mongodb;

    public function __construct()
    {
        $this->mongodb = DiHelper::getShared('mongodb');
    }

    abstract protected function getCollection();

    /**
     * 保存数据
     *
     * @param  array $data
     * @return bool
     */
    protected function save(array $data)
    {
        $result = $this->getCollection()->insertOne($data);

        return (bool)$result->getInsertedCount();
    }

    /**
     * 批量保存数据
     *
     * @param  array $data
     * @return bool
     */
    protected function saveAll(array $data)
    {
        $result = $this->getCollection()->insertMany($data);

        return (bool)$result->getInsertedCount();
    }

    /**
     * 查询数据
     *
     * @param  array $filter
     * @param  array $options
     * @return array
     */
    protected function find($filter = [], $options = [])
    {
        $result = $this->getCollection()->findOne($filter, $options);

        return $result ? iterator_to_array($result) : [];
    }

    /**
     * 查询数据
     *
     * @param  array $filter
     * @param  array $options
     * @return array
     */
    protected function findAll($filter = [], $options = [])
    {
        $result = $this->getCollection()->find($filter, $options);

        return $result ? iterator_to_array($result) : [];
    }

}
