<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'username' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '用户名', 'precision' => null, 'fixed' => null],
        'surname' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '姓名', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '邮箱', 'precision' => null, 'fixed' => null],
        'active' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'u_start' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => 'VIP结束时间', 'precision' => null, 'autoIncrement' => null],
        'u_end' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => 'VIP结束时间', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'phone' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => '', 'collate' => 'utf8mb4_general_ci', 'comment' => '电话号', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'username' => ['type' => 'unique', 'columns' => ['username'], 'length' => []],
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
            'username' => 'Lorem ipsum dolor sit amet',
            'surname' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'active' => 1,
            'u_start' => 1,
            'u_end' => 1,
            'created' => '2017-06-29 06:25:05',
            'modified' => '2017-06-29 06:25:05',
            'phone' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
