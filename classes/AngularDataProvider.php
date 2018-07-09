<?php
/**
 * Date: 07.11.2017
 * Time: 17:51
 */

namespace app\classes;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;

class AngularDataProvider extends ActiveDataProvider{

    private $_pagination;

    /**
     * Returns the _pagination object used by this data provider.
     * Note that you should call [[prepare()]] or [[getModels()]] first to get correct values
     * of [[Pagination::totalCount]] and [[Pagination::pageCount]].
     * @return AngularPagination|false the _pagination object. If this is false, it means the _pagination is disabled.
     */
    public function getPagination()
    {
        if ($this->_pagination === null) {
            $this->setPagination([]);
        }

        return $this->_pagination;
    }

    /**
     * Sets the _pagination for this data provider.
     * @param array|AngularPagination|bool $value the _pagination to be used by this data provider.
     * This can be one of the following:
     *
     * - a configuration array for creating the _pagination object. The "class" element defaults
     *   to 'yii\data\Pagination'
     * - an instance of [[Pagination]] or its subclass
     * - false, if _pagination needs to be disabled.
     *
     * @throws InvalidParamException
     */
    public function setPagination($value)
    {
        if (is_array($value)) {
            $config = ['class' => AngularPagination::class];
            if ($this->id !== null) {
                $config['pageParam'] = $this->id . '-page';
                $config['pageSizeParam'] = $this->id . '-per-page';
            }
            $this->_pagination = Yii::createObject(array_merge($config, $value));
        } elseif ($value instanceof AngularPagination || $value === false) {
            $this->_pagination = $value;
        } else {
            throw new InvalidParamException('Only Pagination instance, configuration array or false is allowed.');
        }
    }


}