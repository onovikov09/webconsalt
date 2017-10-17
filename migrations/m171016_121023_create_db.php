<?php

use yii\db\Migration;

class m171016_121023_create_db extends Migration
{
    public function safeUp()
    {
        $sSql = <<<SQL

CREATE TABLE `bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `step` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `wages` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `stat_manager_call` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `manager_id` int(11) NOT NULL,
  `calls` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SQL;
        $this->execute($sSql);
    }

    public function safeDown()
    {
        $this->execute('DROP TABLE `bonus`; DROP TABLE `manager`; DROP TABLE `stat_manager_call`;');
    }
}
