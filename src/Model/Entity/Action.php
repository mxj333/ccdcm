<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Action Entity
 *
 * @property int $id
 * @property int $strategy_id
 * @property int $type
 * @property string $sendto
 * @property bool $status
 * @property int $delay
 * @property int $repeat
 * @property int $interval
 * @property int $executed_num
 *
 * @property \App\Model\Entity\Strategy $strategy
 * @property \App\Model\Entity\Send[] $sends
 */
class Action extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
