<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$mysqli = new mysqli('localhost', 'root', 'root');

if (!$mysqli) {
    echo'database error';
} else {
    echo'php env successful';
}

$sql = "SELECT
       TIMESTAMPDIFF(
          SECOND,
          from_unixtime(`triggers`.lastchange),
          CURRENT_TIMESTAMP ()
       ) AS second_diff,
       `triggers`.triggerid AS tid,
       `triggers`.description,
       `triggers`.`status`,
       `triggers`.priority,
       `triggers`.lastchange,
       from_unixtime(`triggers`.lastchange) AS lasttime,
       from_unixtime(Item.lastlogsize) AS changetime,
       `Item`.units,
       `Item`.hostid,
       `hosts`.`host`,
       `hosts`.name,
       `triggers`.expression,
       Item.delta,
       FROM_UNIXTIME(`events`.clock) AS clock,
       `events`.objectid,
       `events`.eventid,
       MAX(`events`.eventid) AS eid,
       `events`.acknowledged,

    IF (
       (
          SELECT
             acknowledged
          FROM
             `events`
          WHERE
             objectid = tid
          ORDER BY
             eventid DESC
          LIMIT 1
       ) = 0,
       'N',
       'Y'
    ) AS n_acknowledged
    FROM
       `triggers`
    INNER JOIN functions ON `triggers`.triggerid = functions.triggerid
    INNER JOIN items  Item ON functions.itemid = Item.itemid
    INNER JOIN `hosts` ON Item.hostid = `hosts`.hostid
    LEFT JOIN `events` ON `events`.objectid = `triggers`.triggerid
    WHERE
       `triggers`.`value` = 1
    AND `triggers`.priority != 1
    AND `hosts`. STATUS = 0
    AND `events`.`object` = 0
    AND `events`.`value` = 1
    GROUP BY
       functions.triggerid
    ORDER BY
       lasttime,
       clock DESC";

       $result = $mysqli->query($sql);

       /* numeric array */
       $row = $result->fetch_array(MYSQLI_NUM);
       printf("%s (%s)\n", $row[0], $row[1]);

       /* associative array */
       $row = $result->fetch_array(MYSQLI_ASSOC);
       printf("%s (%s)\n", $row['Name'], $row['CountryCode']);

       /* associative and numeric array */
       $row = $result->fetch_array(MYSQLI_BOTH);
       printf("%s (%s)\n", $row[0], $row['CountryCode']);

       /* free result set */
       $result->free();

       /* close connection */
       $mysqli->close();
