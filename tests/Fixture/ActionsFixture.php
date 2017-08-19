<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActionsFixture
 *
 */
class ActionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'strategy_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'type' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sendto' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '发送到', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'delay' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '延迟时间', 'precision' => null, 'autoIncrement' => null],
        'repeat' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '重复次数', 'precision' => null, 'autoIncrement' => null],
        'interval' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '时间间隔', 'precision' => null, 'autoIncrement' => null],
        'executed_num' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'strategy_id' => 1,
            'type' => 1,
            'sendto' => 'Lorem ipsum dolor sit amet',
            'status' => 1,
            'delay' => 1,
            'repeat' => 1,
            'interval' => 1,
            'executed_num' => 1
        ],
    ];
}
