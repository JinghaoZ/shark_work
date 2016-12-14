create database task;

CREATE table task_user(
  `id` int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(16) not null DEFAULT '' COMMENT 'Login名称',
  `password` VARCHAR(16) not null DEFAULT '' COMMENT 'LoginPassword',
  `nickname` VARCHAR(256) not null DEFAULT '' COMMENT 'Location',
  `logo` VARCHAR(128) not null DEFAULT '' COMMENT 'Logo',
  `add_time` int not null DEFAULT 0 COMMENT 'Rigister时间',
  `tel` VARCHAR(13) DEFAULT ''
)engine=InnoDB DEFAULT charset=utf8 COMMENT 'User �?;


CREATE table task_admin(
  `id` int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(16) not null DEFAULT '' COMMENT 'Login名称',
  `password` VARCHAR(16) not null DEFAULT '' COMMENT 'LoginPassword'
)engine=InnoDB DEFAULT charset=utf8 COMMENT '管理员表';

CREATE TABLE task_goods(
  `id` int UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
  `goods_name` VARCHAR(32) not NULL DEFAULT '' COMMENT 'Goods Name',
  `goods_type` VARCHAR(10) not NULL DEFAULT '' COMMENT 'Goods Type：bike,art,clothes,book',
  `username` varchar(16) not null default '' COMMENT '发布该商品的User ',
  `goods_desc` VARCHAR(256) NOT NULL DEFAULT '商品详情',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '仅发布为0，生成订单之后为1',
  `add_time` int UNSIGNED NOT NULL  DEFAULT 0 COMMENT 'Time'
)ENGINE =InnoDB DEFAULT CHARSET = utf8 COMMENT '商品�?;

CREATE TABLE task_order(
  `id` int UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
  `goods_id1` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '交易双发物品1',
  `goods_id2` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '交易双方物品2',
  `status` TINYINT NOT NULL DEFAULT 0 COMMENT '订单状态成功为1，待交易0',
  `add_time` int NOT NULL DEFAULT 0 COMMENT '订单生成时间'
)ENGINE=InnoDB DEFAULT CHARSET =utf8 COMMENT '订单�?;


alter table task_goods add `logo` VARCHAR(128) not null DEFAULT '';