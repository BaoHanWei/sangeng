DROP TABLE IF EXISTS `ocenter_user_location`;
CREATE TABLE IF NOT EXISTS `ocenter_user_location` (
  `uid` int(11) NOT NULL,
  `lng` decimal(10,5) DEFAULT '0.00000' COMMENT '经度',
  `lat` decimal(10,5) NOT NULL DEFAULT '0.00000' COMMENT '纬度',
  `last_confirm_time` int(10) unsigned NOT NULL,
  `ClientID` char(32) NOT NULL COMMENT '客户端所在手机CID',
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户定位';

DROP TABLE IF EXISTS `ocenter_store_order_car`;
CREATE TABLE IF NOT EXISTS `ocenter_store_order_car` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `create_time` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `goods_id` int(11) DEFAULT NULL COMMENT '商品的id',
  `count` float NOT NULL DEFAULT '0' COMMENT '商品数',
  `collection` int(5) NOT NULL DEFAULT '0' COMMENT '是否收藏过',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='订单表' AUTO_INCREMENT=236 ;
ALTER TABLE  `ocenter_user_location` ADD  `token` CHAR( 32 ) NOT NULL COMMENT  'ios标识'
ALTER TABLE `ocenter_user_location`ADD PRIMARY KEY(`uid`);
ALTER TABLE  `ocenter_cat_entity` ADD  `app_icon` INT(11) NOT NULL;
ALTER TABLE  `ocenter_store_order` ADD  `r_id` INT(11) NOT NULL;
CREATE TABLE IF NOT EXISTS `ocenter_store_trans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `create_time` int(15) NOT NULL,
  `update_time` int(15) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `is_default` tinyint(2) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用于记录买家的配送地址信息';
