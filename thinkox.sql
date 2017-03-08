/*
Navicat MySQL Data Transfer

Source Server         : 虚拟机_Mysql
Source Server Version : 50626
Source Host           : 192.168.110.120:3306
Source Database       : thinkox

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2017-03-07 17:50:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for os_action
-- ----------------------------
DROP TABLE IF EXISTS `os_action`;
CREATE TABLE `os_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `module` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11022 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表';

-- ----------------------------
-- Records of os_action
-- ----------------------------
INSERT INTO `os_action` VALUES ('1', 'reg', '用户注册', '用户注册', '', '', '1', '1', '1426070545', '');
INSERT INTO `os_action` VALUES ('2', 'input_password', '输入密码', '记录输入密码的次数。', '', '', '1', '1', '1426122119', '');
INSERT INTO `os_action` VALUES ('3', 'user_login', '用户登录', '积分+10，每天一次', 'a:1:{i:0;a:5:{s:5:\"table\";s:6:\"member\";s:5:\"field\";s:1:\"1\";s:4:\"rule\";s:2:\"10\";s:5:\"cycle\";s:2:\"24\";s:3:\"max\";s:1:\"1\";}}', '[user|get_nickname]在[time|time_format]登录了账号', '1', '1', '1428397656', '');
INSERT INTO `os_action` VALUES ('4', 'update_config', '更新配置', '新增或修改或删除配置', '', '', '1', '1', '1383294988', '');
INSERT INTO `os_action` VALUES ('7', 'update_channel', '更新导航', '新增或修改或删除导航', '', '', '1', '1', '1383296301', '');
INSERT INTO `os_action` VALUES ('8', 'update_menu', '更新菜单', '新增或修改或删除菜单', '', '', '1', '1', '1383296392', '');
INSERT INTO `os_action` VALUES ('10001', 'add_weibo', '发布微博', '新增微博', 'a:1:{i:0;a:5:{s:5:\"table\";s:6:\"member\";s:5:\"field\";s:1:\"1\";s:4:\"rule\";s:2:\"+1\";s:5:\"cycle\";s:2:\"24\";s:3:\"max\";s:2:\"10\";}}', '[user|get_nickname]在[time|time_format]发布了新微博：[record|intval]', '1', '1', '1437116716', 'Weibo');
INSERT INTO `os_action` VALUES ('10002', 'add_weibo_comment', '添加微博评论', '添加微博评论', 'a:1:{i:0;a:5:{s:5:\"table\";s:6:\"member\";s:5:\"field\";s:1:\"1\";s:4:\"rule\";s:2:\"+1\";s:5:\"cycle\";s:2:\"24\";s:3:\"max\";s:2:\"10\";}}', '[user|get_nickname]在[time|time_format]添加了微博评论：[record|intval]', '1', '1', '1437116734', 'Weibo');
INSERT INTO `os_action` VALUES ('10003', 'del_weibo_comment', '删除微博评论', '删除微博评论', '', '[user|get_nickname]在[time|time_format]删除了微博评论：[record|intval]', '1', '1', '1428399164', 'Weibo');
INSERT INTO `os_action` VALUES ('10004', 'del_weibo', '删除微博', '删除微博', '', '[user|get_nickname]在[time|time_format]删除了微博：[record|intval]', '1', '1', '1428461334', 'Weibo');
INSERT INTO `os_action` VALUES ('10005', 'set_weibo_top', '置顶微博', '置顶微博', '', '[user|get_nickname]在[time|time_format]置顶了微博：[record|intval]', '1', '1', '1428399164', 'Weibo');
INSERT INTO `os_action` VALUES ('10006', 'set_weibo_down', '取消置顶微博', '取消置顶微博', '', '[user|get_nickname]在[time|time_format]取消置顶了微博：[record|intval]', '1', '1', '1428462983', 'Weibo');
INSERT INTO `os_action` VALUES ('11000', 'add_news', '资讯投稿', '用户发布资讯', 'N;', '', '2', '1', '1428479582', 'News');
INSERT INTO `os_action` VALUES ('11001', 'add_question', '提问', '用户提出问题', 'N;', '', '2', '1', '1428479582', 'Question');
INSERT INTO `os_action` VALUES ('11002', 'edit_question', '编辑问题', '用户编辑问题', 'N;', '', '2', '1', '1428479582', 'Question');
INSERT INTO `os_action` VALUES ('11003', 'add_answer', '回答', '用户发布答案', 'N;', '', '2', '1', '1428479582', 'Question');
INSERT INTO `os_action` VALUES ('11004', 'edit_answer', '编辑回答', '用户编辑答案', 'N;', '', '2', '1', '1428479582', 'Question');
INSERT INTO `os_action` VALUES ('11005', 'support_answer', '支持、反对回答', '用户支持、反对答案', 'N;', '', '2', '1', '1428479582', 'Question');
INSERT INTO `os_action` VALUES ('11020', 'add_event', '编辑活动', '用户发布、编辑活动', 'N;', '', '2', '1', '1428479582', 'Event');
INSERT INTO `os_action` VALUES ('11021', 'event_do_sign', '报名活动', '活动报名', '', '', '2', '1', '1432088916', 'Event');

-- ----------------------------
-- Table structure for os_action_limit
-- ----------------------------
DROP TABLE IF EXISTS `os_action_limit`;
CREATE TABLE `os_action_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `frequency` int(11) NOT NULL,
  `time_number` int(11) NOT NULL,
  `time_unit` varchar(50) NOT NULL,
  `punish` text NOT NULL,
  `if_message` tinyint(4) NOT NULL,
  `message_content` text NOT NULL,
  `action_list` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_time` int(11) NOT NULL,
  `module` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_action_limit
-- ----------------------------
INSERT INTO `os_action_limit` VALUES ('1', 'reg', '注册限制', '1', '1', 'minute', 'warning', '0', '', '[reg]', '1', '0', '');
INSERT INTO `os_action_limit` VALUES ('2', 'input_password', '输密码', '3', '1', 'minute', 'warning', '0', '', '[input_password]', '1', '0', '');
INSERT INTO `os_action_limit` VALUES ('3', 'add_weibo', '新增微博', '1', '10', 'second', 'warning', '0', '', '[add_weibo]', '1', '0', 'Weibo');
INSERT INTO `os_action_limit` VALUES ('4', 'add_weibo_comment', '添加微博评论', '1', '10', 'second', 'warning', '0', '', '[add_weibo_comment]', '1', '0', 'Weibo');
INSERT INTO `os_action_limit` VALUES ('5', 'add_news', '资讯投稿', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[add_news]', '-1', '0', 'News');
INSERT INTO `os_action_limit` VALUES ('6', 'add_question', '提问', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[add_question]', '1', '0', 'Question');
INSERT INTO `os_action_limit` VALUES ('7', 'edit_question', '编辑问题', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[edit_question]', '1', '0', 'Question');
INSERT INTO `os_action_limit` VALUES ('8', 'add_answer', '回答', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[add_answer]', '1', '0', 'Question');
INSERT INTO `os_action_limit` VALUES ('9', 'edit_answer', '编辑回答', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[edit_answer]', '1', '0', 'Question');
INSERT INTO `os_action_limit` VALUES ('10', 'support_answer', '支持、反对回答', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[support_answer]', '1', '0', 'Question');
INSERT INTO `os_action_limit` VALUES ('25', 'add_event', '编辑活动', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[add_event]', '1', '0', 'Event');
INSERT INTO `os_action_limit` VALUES ('26', 'event_do_sign', '报名活动', '1', '1', 'minute', 'warning', '1', '操作太频繁！', '[event_do_sign]', '1', '0', 'Event');

-- ----------------------------
-- Table structure for os_action_log
-- ----------------------------
DROP TABLE IF EXISTS `os_action_log`;
CREATE TABLE `os_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=199 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

-- ----------------------------
-- Records of os_action_log
-- ----------------------------
INSERT INTO `os_action_log` VALUES ('1', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-05 22:41登录了账号【积分：+10分】', '1', '1473086500');
INSERT INTO `os_action_log` VALUES ('2', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-11 21:52登录了账号【积分：+10分】', '1', '1473601948');
INSERT INTO `os_action_log` VALUES ('3', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/admin/public/login.html', '1', '1473602128');
INSERT INTO `os_action_log` VALUES ('4', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/admin/public/login.html', '1', '1473602135');
INSERT INTO `os_action_log` VALUES ('5', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/admin/public/login.html', '1', '1473602143');
INSERT INTO `os_action_log` VALUES ('6', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-11 21:56登录了账号', '1', '1473602209');
INSERT INTO `os_action_log` VALUES ('7', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-18 11:04登录了账号【积分：+10分】', '1', '1474167898');
INSERT INTO `os_action_log` VALUES ('8', '8', '1', '3232263681', 'Menu', '10002', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1474168254');
INSERT INTO `os_action_log` VALUES ('9', '8', '1', '3232263681', 'Menu', '10002', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1474168280');
INSERT INTO `os_action_log` VALUES ('10', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-18 21:18登录了账号', '1', '1474204714');
INSERT INTO `os_action_log` VALUES ('11', '10001', '1', '3232263681', 'weibo', '1', 'admin在2016-09-18 21:26发布了新微博：1【积分：+1分】', '1', '1474205179');
INSERT INTO `os_action_log` VALUES ('12', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-18 22:09登录了账号', '1', '1474207760');
INSERT INTO `os_action_log` VALUES ('13', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/ucenter/member/login.html', '1', '1474294851');
INSERT INTO `os_action_log` VALUES ('14', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-19 22:20登录了账号【积分：+10分】', '1', '1474294857');
INSERT INTO `os_action_log` VALUES ('15', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-19 23:34登录了账号', '1', '1474299270');
INSERT INTO `os_action_log` VALUES ('16', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-21 19:58登录了账号【积分：+10分】', '1', '1474459080');
INSERT INTO `os_action_log` VALUES ('17', '10001', '1', '3232263681', 'weibo', '2', 'admin在2016-09-21 23:01发布了新微博：2【积分：+1分】', '1', '1474470116');
INSERT INTO `os_action_log` VALUES ('18', '10002', '1', '3232263681', 'weibo_comment', '1', 'admin在2016-09-22 00:13添加了微博评论：1【积分：+1分】', '1', '1474474399');
INSERT INTO `os_action_log` VALUES ('19', '10002', '1', '3232263681', 'weibo_comment', '2', 'admin在2016-09-22 00:14添加了微博评论：2【积分：+1分】', '1', '1474474447');
INSERT INTO `os_action_log` VALUES ('20', '10001', '1', '3232263681', 'weibo', '3', 'admin在2016-09-22 20:58发布了新微博：3【积分：+1分】', '1', '1474549104');
INSERT INTO `os_action_log` VALUES ('21', '10001', '1', '3232263681', 'weibo', '4', 'admin在2016-09-22 20:58发布了新微博：4【积分：+1分】', '1', '1474549138');
INSERT INTO `os_action_log` VALUES ('22', '10001', '1', '3232263681', 'weibo', '5', 'admin在2016-09-22 21:56发布了新微博：5【积分：+1分】', '1', '1474552614');
INSERT INTO `os_action_log` VALUES ('23', '10001', '1', '3232263681', 'weibo', '6', 'admin在2016-09-22 21:57发布了新微博：6【积分：+1分】', '1', '1474552668');
INSERT INTO `os_action_log` VALUES ('24', '10001', '1', '3232263681', 'weibo', '7', 'admin在2016-09-22 21:58发布了新微博：7【积分：+1分】', '1', '1474552724');
INSERT INTO `os_action_log` VALUES ('25', '3', '1', '3232263681', 'member', '1', 'admin在2016-09-25 10:28登录了账号【积分：+10分】', '1', '1474770518');
INSERT INTO `os_action_log` VALUES ('26', '10002', '1', '3232263681', 'weibo_comment', '3', 'admin在2016-09-25 15:47添加了微博评论：3【积分：+1分】', '1', '1474789676');
INSERT INTO `os_action_log` VALUES ('27', '11000', '1', '3232263681', 'News', '2', '操作url：/index.php?s=/admin/news/editnews.html', '1', '1474800021');
INSERT INTO `os_action_log` VALUES ('28', '8', '1', '3232263681', 'Menu', '10029', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474806897');
INSERT INTO `os_action_log` VALUES ('29', '8', '1', '3232263681', 'Menu', '10030', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474807227');
INSERT INTO `os_action_log` VALUES ('30', '8', '1', '3232263681', 'Menu', '10029', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1474807301');
INSERT INTO `os_action_log` VALUES ('31', '8', '1', '3232263681', 'Menu', '10029', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1474807326');
INSERT INTO `os_action_log` VALUES ('32', '8', '1', '3232263681', 'Menu', '10030', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1474807473');
INSERT INTO `os_action_log` VALUES ('33', '8', '1', '3232263681', 'Menu', '10031', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474807585');
INSERT INTO `os_action_log` VALUES ('34', '8', '1', '3232263681', 'Menu', '10032', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474807661');
INSERT INTO `os_action_log` VALUES ('35', '8', '1', '3232263681', 'Menu', '10030', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1474813153');
INSERT INTO `os_action_log` VALUES ('36', '8', '1', '3232263681', 'Menu', '10033', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474814080');
INSERT INTO `os_action_log` VALUES ('37', '8', '1', '3232263681', 'Menu', '10034', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474814124');
INSERT INTO `os_action_log` VALUES ('38', '8', '1', '3232263681', 'Menu', '10035', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474814187');
INSERT INTO `os_action_log` VALUES ('39', '8', '1', '3232263681', 'Menu', '10036', '操作url：/index.php?s=/admin/menu/add.html', '1', '1474814219');
INSERT INTO `os_action_log` VALUES ('40', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-10 21:10登录了账号【积分：+10分】', '1', '1476105054');
INSERT INTO `os_action_log` VALUES ('41', '10001', '1', '3232263681', 'weibo', '8', 'admin在2016-10-10 21:11发布了新微博：8【积分：+1分】', '1', '1476105090');
INSERT INTO `os_action_log` VALUES ('42', '10001', '1', '3232263681', 'weibo', '9', 'admin在2016-10-10 21:14发布了新微博：9【积分：+1分】', '1', '1476105249');
INSERT INTO `os_action_log` VALUES ('43', '10001', '1', '3232263681', 'weibo', '10', 'admin在2016-10-10 21:14发布了新微博：10【积分：+1分】', '1', '1476105291');
INSERT INTO `os_action_log` VALUES ('44', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/ucenter/member/login.html', '1', '1476110113');
INSERT INTO `os_action_log` VALUES ('45', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-10 22:35登录了账号', '1', '1476110119');
INSERT INTO `os_action_log` VALUES ('46', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-12 21:28登录了账号【积分：+10分】', '1', '1476278914');
INSERT INTO `os_action_log` VALUES ('47', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-13 21:33登录了账号【积分：+10分】', '1', '1476365618');
INSERT INTO `os_action_log` VALUES ('48', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-15 11:13登录了账号【积分：+10分】', '1', '1476501217');
INSERT INTO `os_action_log` VALUES ('49', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-15 12:46登录了账号', '1', '1476506814');
INSERT INTO `os_action_log` VALUES ('50', '8', '1', '3232263681', 'Menu', '10037', '操作url：/index.php?s=/admin/menu/add.html', '1', '1476530995');
INSERT INTO `os_action_log` VALUES ('51', '8', '1', '3232263681', 'Menu', '10037', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476531106');
INSERT INTO `os_action_log` VALUES ('52', '8', '1', '3232263681', 'Menu', '10037', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476531221');
INSERT INTO `os_action_log` VALUES ('53', '8', '1', '3232263681', 'Menu', '10031', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476531696');
INSERT INTO `os_action_log` VALUES ('54', '8', '1', '3232263681', 'Menu', '10037', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476531717');
INSERT INTO `os_action_log` VALUES ('55', '8', '1', '3232263681', 'Menu', '10031', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476532049');
INSERT INTO `os_action_log` VALUES ('56', '8', '1', '3232263681', 'Menu', '10037', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476532066');
INSERT INTO `os_action_log` VALUES ('57', '8', '1', '3232263681', 'Menu', '10038', '操作url：/index.php?s=/admin/menu/add.html', '1', '1476534650');
INSERT INTO `os_action_log` VALUES ('58', '8', '1', '3232263681', 'Menu', '10030', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476535259');
INSERT INTO `os_action_log` VALUES ('59', '8', '1', '3232263681', 'Menu', '10037', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476535272');
INSERT INTO `os_action_log` VALUES ('60', '8', '1', '3232263681', 'Menu', '10032', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476535288');
INSERT INTO `os_action_log` VALUES ('61', '8', '1', '3232263681', 'Menu', '10031', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476535297');
INSERT INTO `os_action_log` VALUES ('62', '8', '1', '3232263681', 'Menu', '10039', '操作url：/index.php?s=/admin/menu/add.html', '1', '1476536429');
INSERT INTO `os_action_log` VALUES ('63', '8', '1', '3232263681', 'Menu', '0', '操作url：/index.php?s=/admin/menu/del/id/10037.html', '1', '1476541261');
INSERT INTO `os_action_log` VALUES ('64', '8', '1', '3232263681', 'Menu', '10031', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1476541300');
INSERT INTO `os_action_log` VALUES ('65', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-16 09:25登录了账号', '1', '1476581112');
INSERT INTO `os_action_log` VALUES ('66', '1', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/ucenter/member/register.html', '1', '1476600094');
INSERT INTO `os_action_log` VALUES ('67', '1', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/ucenter/member/register.html', '1', '1476600423');
INSERT INTO `os_action_log` VALUES ('68', '3', '101', '3232263681', 'member', '101', '包汉伟1在2016-10-16 14:48登录了账号【积分：+10分】', '1', '1476600509');
INSERT INTO `os_action_log` VALUES ('69', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-16 14:51登录了账号', '1', '1476600688');
INSERT INTO `os_action_log` VALUES ('70', '1', '1', '3232263681', 'ucenter_member', '1', '操作url：/index.php?s=/ucenter/member/register.html', '1', '1476607329');
INSERT INTO `os_action_log` VALUES ('71', '3', '102', '3232263681', 'member', '102', '请叫我包包大人在2016-10-16 17:05登录了账号【积分：+10分】', '1', '1476608753');
INSERT INTO `os_action_log` VALUES ('72', '2', '101', '3232263681', 'ucenter_member', '101', '操作url：/index.php?s=/ucenter/member/login.html', '1', '1476709869');
INSERT INTO `os_action_log` VALUES ('73', '3', '101', '3232263681', 'member', '101', '包汉伟1在2016-10-17 21:11登录了账号【积分：+10分】', '1', '1476709875');
INSERT INTO `os_action_log` VALUES ('74', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-18 21:11登录了账号【积分：+10分】', '1', '1476796290');
INSERT INTO `os_action_log` VALUES ('75', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-18 21:46登录了账号【积分：+10分】', '1', '1476798377');
INSERT INTO `os_action_log` VALUES ('76', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-19 20:47登录了账号', '1', '1476881262');
INSERT INTO `os_action_log` VALUES ('77', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-20 21:13登录了账号【积分：+10分】', '1', '1476969210');
INSERT INTO `os_action_log` VALUES ('78', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-21 22:59登录了账号【积分：+10分】', '1', '1477061996');
INSERT INTO `os_action_log` VALUES ('79', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-21 23:47登录了账号【积分：+10分】', '1', '1477064872');
INSERT INTO `os_action_log` VALUES ('80', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-23 08:53登录了账号【积分：+10分】', '1', '1477184003');
INSERT INTO `os_action_log` VALUES ('81', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-23 08:55登录了账号【积分：+10分】', '1', '1477184137');
INSERT INTO `os_action_log` VALUES ('82', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-23 09:04登录了账号', '1', '1477184649');
INSERT INTO `os_action_log` VALUES ('83', '10001', '101', '3232263681', 'weibo', '11', '包汉伟在2016-10-23 11:14发布了新微博：11【积分：+1分】', '1', '1477192478');
INSERT INTO `os_action_log` VALUES ('84', '10001', '101', '3232263681', 'weibo', '12', '包汉伟在2016-10-23 11:41发布了新微博：12【积分：+1分】', '1', '1477194083');
INSERT INTO `os_action_log` VALUES ('85', '10001', '101', '3232263681', 'weibo', '13', '包汉伟在2016-10-23 11:42发布了新微博：13【积分：+1分】', '1', '1477194176');
INSERT INTO `os_action_log` VALUES ('86', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-23 15:14登录了账号', '1', '1477206872');
INSERT INTO `os_action_log` VALUES ('87', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-23 21:17登录了账号', '1', '1477228679');
INSERT INTO `os_action_log` VALUES ('88', '3', '102', '3232263681', 'member', '102', '请叫我包包大人在2016-10-23 22:34登录了账号【积分：+10分】', '1', '1477233275');
INSERT INTO `os_action_log` VALUES ('89', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-27 22:24登录了账号【积分：+10分】', '1', '1477578297');
INSERT INTO `os_action_log` VALUES ('90', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-27 22:25登录了账号【积分：+10分】', '1', '1477578338');
INSERT INTO `os_action_log` VALUES ('91', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-10-31 16:10登录了账号【积分：+10分】', '1', '1477901445');
INSERT INTO `os_action_log` VALUES ('92', '3', '1', '3232263681', 'member', '1', 'admin在2016-10-31 18:27登录了账号【积分：+10分】', '1', '1477909638');
INSERT INTO `os_action_log` VALUES ('93', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-01 22:32登录了账号【积分：+10分】', '1', '1478010748');
INSERT INTO `os_action_log` VALUES ('94', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-02 22:18登录了账号', '1', '1478096280');
INSERT INTO `os_action_log` VALUES ('95', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-02 22:45登录了账号', '1', '1478097912');
INSERT INTO `os_action_log` VALUES ('96', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-05 09:50登录了账号【积分：+10分】', '1', '1478310648');
INSERT INTO `os_action_log` VALUES ('97', '3', '1', '3232263681', 'member', '1', 'admin在2016-11-07 23:28登录了账号【积分：+10分】', '1', '1478532486');
INSERT INTO `os_action_log` VALUES ('98', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-13 09:34登录了账号【积分：+10分】', '1', '1479000870');
INSERT INTO `os_action_log` VALUES ('99', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-13 20:30登录了账号', '1', '1479040207');
INSERT INTO `os_action_log` VALUES ('100', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-14 21:28登录了账号【积分：+10分】', '1', '1479130134');
INSERT INTO `os_action_log` VALUES ('101', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-15 22:16登录了账号【积分：+10分】', '1', '1479219395');
INSERT INTO `os_action_log` VALUES ('102', '3', '1', '3232263681', 'member', '1', 'admin在2016-11-17 22:27登录了账号【积分：+10分】', '1', '1479392877');
INSERT INTO `os_action_log` VALUES ('103', '3', '1', '3232263681', 'member', '1', 'admin在2016-11-19 10:51登录了账号【积分：+10分】', '1', '1479523863');
INSERT INTO `os_action_log` VALUES ('104', '11001', '1', '3232263681', 'question', '1', '操作url：/question/edit', '1', '1479525296');
INSERT INTO `os_action_log` VALUES ('105', '11001', '1', '3232263681', 'question', '2', '操作url：/question/edit', '1', '1479525736');
INSERT INTO `os_action_log` VALUES ('106', '11001', '1', '3232263681', 'question', '3', '操作url：/question/edit', '1', '1479525809');
INSERT INTO `os_action_log` VALUES ('107', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-20 12:07登录了账号【积分：+10分】', '1', '1479614855');
INSERT INTO `os_action_log` VALUES ('108', '11003', '101', '3232263681', 'question_answer', '1', '操作url：/question/editanswer', '1', '1479618679');
INSERT INTO `os_action_log` VALUES ('109', '3', '1', '3232263681', 'member', '1', 'admin在2016-11-22 22:10登录了账号【积分：+10分】', '1', '1479823815');
INSERT INTO `os_action_log` VALUES ('110', '11001', '1', '3232263681', 'question', '4', '操作url：/question/edit', '1', '1479995194');
INSERT INTO `os_action_log` VALUES ('111', '11005', '1', '3232263681', 'question_answer_support', '1', '操作url：/question/answer/support.html', '1', '1480087996');
INSERT INTO `os_action_log` VALUES ('112', '11003', '1', '3232263681', 'question_answer', '2', '操作url：/question/editanswer', '1', '1480088578');
INSERT INTO `os_action_log` VALUES ('113', '11003', '1', '3232263681', 'question_answer', '3', '操作url：/question/editanswer', '1', '1480089749');
INSERT INTO `os_action_log` VALUES ('114', '10005', '1', '3232263681', 'weibo', '13', 'admin在2016-11-26 01:35置顶了微博：13', '1', '1480095341');
INSERT INTO `os_action_log` VALUES ('115', '10006', '1', '3232263681', 'weibo', '13', 'admin在2016-11-26 01:44取消置顶了微博：13', '1', '1480095848');
INSERT INTO `os_action_log` VALUES ('116', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-28 21:37登录了账号【积分：+10分】', '1', '1480340224');
INSERT INTO `os_action_log` VALUES ('117', '3', '1', '3232263681', 'member', '1', 'admin在2016-11-28 22:42登录了账号【积分：+10分】', '1', '1480344178');
INSERT INTO `os_action_log` VALUES ('118', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-29 21:59登录了账号【积分：+10分】', '1', '1480427951');
INSERT INTO `os_action_log` VALUES ('119', '11001', '101', '3232263681', 'question', '5', '操作url：/question/edit', '1', '1480431957');
INSERT INTO `os_action_log` VALUES ('120', '11003', '101', '3232263681', 'question_answer', '4', '操作url：/question/editanswer', '1', '1480432667');
INSERT INTO `os_action_log` VALUES ('121', '11002', '101', '3232263681', 'question', '5', '操作url：/question/answer/setbest.html', '1', '1480433484');
INSERT INTO `os_action_log` VALUES ('122', '11005', '101', '3232263681', 'question_answer_support', '2', '操作url：/question/answer/support.html', '1', '1480434727');
INSERT INTO `os_action_log` VALUES ('123', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-11-30 22:50登录了账号【积分：+10分】', '1', '1480517412');
INSERT INTO `os_action_log` VALUES ('124', '10001', '101', '3232263681', 'weibo', '14', '包汉伟在2016-12-01 09:28发布了新微博：14【积分：+1分】', '1', '1480555690');
INSERT INTO `os_action_log` VALUES ('125', '10001', '101', '3232263681', 'weibo', '15', '包汉伟在2016-12-01 10:06发布了新微博：15【积分：+1分】', '1', '1480557973');
INSERT INTO `os_action_log` VALUES ('126', '10002', '101', '3232263681', 'weibo_comment', '4', '包汉伟在2016-12-01 12:27添加了微博评论：4【积分：+1分】', '1', '1480566476');
INSERT INTO `os_action_log` VALUES ('127', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-01 12:34登录了账号【积分：+10分】', '1', '1480566886');
INSERT INTO `os_action_log` VALUES ('128', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-01 17:50登录了账号', '1', '1480585842');
INSERT INTO `os_action_log` VALUES ('129', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-12-01 17:54登录了账号', '1', '1480586073');
INSERT INTO `os_action_log` VALUES ('130', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-12-05 21:24登录了账号【积分：+10分】', '1', '1480944241');
INSERT INTO `os_action_log` VALUES ('131', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-05 21:39登录了账号【积分：+10分】', '1', '1480945166');
INSERT INTO `os_action_log` VALUES ('132', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-12-05 21:47登录了账号', '1', '1480945628');
INSERT INTO `os_action_log` VALUES ('133', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-27 21:42登录了账号【积分：+10分】', '1', '1482846126');
INSERT INTO `os_action_log` VALUES ('134', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-28 21:24登录了账号', '1', '1482931482');
INSERT INTO `os_action_log` VALUES ('135', '11000', '1', '3232263681', 'News', '3', '操作url：/index.php?s=/admin/news/editnews.html', '1', '1482935629');
INSERT INTO `os_action_log` VALUES ('136', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-29 22:35登录了账号【积分：+10分】', '1', '1483022129');
INSERT INTO `os_action_log` VALUES ('137', '3', '101', '3232263681', 'member', '101', '包汉伟在2016-12-31 10:24登录了账号【积分：+10分】', '1', '1483151047');
INSERT INTO `os_action_log` VALUES ('138', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-31 10:55登录了账号【积分：+10分】', '1', '1483152925');
INSERT INTO `os_action_log` VALUES ('139', '3', '1', '3232263681', 'member', '1', 'admin在2016-12-31 23:32登录了账号', '1', '1483198325');
INSERT INTO `os_action_log` VALUES ('140', '3', '1', '3232263681', 'member', '1', 'admin在2017-01-02 16:56登录了账号【积分：+10分】', '1', '1483347404');
INSERT INTO `os_action_log` VALUES ('141', '11006', '1', '3232263681', 'Group', '6', '操作url：/group/create', '1', '1483362986');
INSERT INTO `os_action_log` VALUES ('142', '8', '1', '3232263681', 'Menu', '10050', '操作url：/index.php?s=/admin/menu/edit.html', '1', '1483365355');
INSERT INTO `os_action_log` VALUES ('143', '3', '1', '3232263681', 'member', '1', 'admin在2017-01-07 11:49登录了账号【积分：+10分】', '1', '1483760971');
INSERT INTO `os_action_log` VALUES ('144', '3', '1', '3232263681', 'member', '1', 'admin在2017-01-09 23:09登录了账号【积分：+10分】', '1', '1483974565');
INSERT INTO `os_action_log` VALUES ('145', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/ucenter/member/login.html', '1', '1484318502');
INSERT INTO `os_action_log` VALUES ('146', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/ucenter/member/login.html', '1', '1484318511');
INSERT INTO `os_action_log` VALUES ('147', '3', '1', '3232263681', 'member', '1', 'admin在2017-01-13 22:41登录了账号【积分：+10分】', '1', '1484318518');
INSERT INTO `os_action_log` VALUES ('148', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-01-15 21:21登录了账号【积分：+10分】', '1', '1484486466');
INSERT INTO `os_action_log` VALUES ('149', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-05 21:50登录了账号【积分：+10分】', '1', '1486302626');
INSERT INTO `os_action_log` VALUES ('150', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-12 10:20登录了账号【积分：+10分】', '1', '1486866058');
INSERT INTO `os_action_log` VALUES ('151', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-12 10:28登录了账号【积分：+10分】', '1', '1486866532');
INSERT INTO `os_action_log` VALUES ('152', '2', '101', '3232263681', 'ucenter_member', '101', '操作url：/ucenter/member/login.html', '1', '1486880409');
INSERT INTO `os_action_log` VALUES ('153', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-12 14:20登录了账号', '1', '1486880416');
INSERT INTO `os_action_log` VALUES ('154', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-13 10:21登录了账号', '1', '1486952485');
INSERT INTO `os_action_log` VALUES ('155', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/ucenter/member/login.html', '1', '1487040738');
INSERT INTO `os_action_log` VALUES ('156', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-14 10:52登录了账号【积分：+10分】', '1', '1487040744');
INSERT INTO `os_action_log` VALUES ('157', '2', '101', '3232263681', 'ucenter_member', '101', '操作url：/ucenter/member/login.html', '1', '1487310860');
INSERT INTO `os_action_log` VALUES ('158', '2', '101', '3232263681', 'ucenter_member', '101', '操作url：/ucenter/member/login.html', '1', '1487310866');
INSERT INTO `os_action_log` VALUES ('159', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-17 13:54登录了账号【积分：+10分】', '1', '1487310871');
INSERT INTO `os_action_log` VALUES ('160', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-17 14:03登录了账号【积分：+10分】', '1', '1487311384');
INSERT INTO `os_action_log` VALUES ('161', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-17 22:28登录了账号', '1', '1487341738');
INSERT INTO `os_action_log` VALUES ('162', '2', '101', '3232263681', 'ucenter_member', '101', '操作url：/login', '1', '1487650726');
INSERT INTO `os_action_log` VALUES ('163', '1', '1', '3232263681', 'ucenter_member', '1', '操作url：/register', '1', '1487652824');
INSERT INTO `os_action_log` VALUES ('164', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-21 12:59登录了账号【积分：+10分】', '1', '1487653151');
INSERT INTO `os_action_log` VALUES ('165', '1', '1', '3232263681', 'ucenter_member', '1', '操作url：/register', '1', '1487665325');
INSERT INTO `os_action_log` VALUES ('166', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-21 16:24登录了账号【积分：+10分】', '1', '1487665491');
INSERT INTO `os_action_log` VALUES ('167', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/ucenter/member/login.html', '1', '1487814243');
INSERT INTO `os_action_log` VALUES ('168', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/ucenter/member/login.html', '1', '1487814248');
INSERT INTO `os_action_log` VALUES ('169', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-23 09:44登录了账号【积分：+10分】', '1', '1487814255');
INSERT INTO `os_action_log` VALUES ('170', '2', '1', '3232263681', 'ucenter_member', '1', '操作url：/ucenter/member/login.html', '1', '1487859692');
INSERT INTO `os_action_log` VALUES ('171', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-23 22:21登录了账号', '1', '1487859697');
INSERT INTO `os_action_log` VALUES ('172', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-25 09:58登录了账号【积分：+10分】', '1', '1487987928');
INSERT INTO `os_action_log` VALUES ('173', '10001', '1', '3232263681', 'weibo', '18', 'admin在2017-02-26 14:54发布了新微博：18【积分：+1分】', '1', '1488092097');
INSERT INTO `os_action_log` VALUES ('174', '11020', '1', '3232263681', 'event', '13', '操作url：/event/index/dopost.html', '1', '1488095582');
INSERT INTO `os_action_log` VALUES ('175', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-27 10:21登录了账号【积分：+10分】', '1', '1488162105');
INSERT INTO `os_action_log` VALUES ('176', '2', '101', '3232263681', 'ucenter_member', '101', '操作url：/ucenter/member/login.html', '1', '1488162829');
INSERT INTO `os_action_log` VALUES ('177', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-27 10:33登录了账号【积分：+10分】', '1', '1488162834');
INSERT INTO `os_action_log` VALUES ('178', '11020', '101', '3232263681', 'event', '14', '操作url：/event/index/dopost.html', '1', '1488162961');
INSERT INTO `os_action_log` VALUES ('179', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-27 10:37登录了账号', '1', '1488163066');
INSERT INTO `os_action_log` VALUES ('180', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-02-28 16:44登录了账号【积分：+10分】', '1', '1488271488');
INSERT INTO `os_action_log` VALUES ('181', '11001', '101', '3232263681', 'question', '6', '操作url：/question/edit', '1', '1488275754');
INSERT INTO `os_action_log` VALUES ('182', '11003', '101', '3232263681', 'question_answer', '5', '操作url：/question/editanswer', '1', '1488275849');
INSERT INTO `os_action_log` VALUES ('183', '3', '1', '3232263681', 'member', '1', 'admin在2017-02-28 17:58登录了账号【积分：+10分】', '1', '1488275905');
INSERT INTO `os_action_log` VALUES ('184', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-03-01 09:57登录了账号', '1', '1488333475');
INSERT INTO `os_action_log` VALUES ('185', '3', '1', '3232263681', 'member', '1', 'admin在2017-03-01 14:56登录了账号', '1', '1488351370');
INSERT INTO `os_action_log` VALUES ('186', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-03-02 11:04登录了账号【积分：+10分】', '1', '1488423881');
INSERT INTO `os_action_log` VALUES ('187', '3', '1', '3232263681', 'member', '1', 'admin在2017-03-02 11:20登录了账号', '1', '1488424829');
INSERT INTO `os_action_log` VALUES ('188', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-03-03 09:28登录了账号', '1', '1488504530');
INSERT INTO `os_action_log` VALUES ('189', '3', '1', '3232263681', 'member', '1', 'admin在2017-03-03 10:12登录了账号', '1', '1488507133');
INSERT INTO `os_action_log` VALUES ('190', '11000', '1', '3232263681', 'News', '4', '操作url：/news/edit', '1', '1488511773');
INSERT INTO `os_action_log` VALUES ('191', '11000', '1', '3232263681', 'News', '5', '操作url：/news/edit', '1', '1488515452');
INSERT INTO `os_action_log` VALUES ('192', '11000', '1', '3232263681', 'News', '6', '操作url：/news/edit', '1', '1488518715');
INSERT INTO `os_action_log` VALUES ('193', '3', '1', '3232263681', 'member', '1', 'admin在2017-03-03 22:49登录了账号', '1', '1488552568');
INSERT INTO `os_action_log` VALUES ('194', '11000', '1', '3232263681', 'News', '7', '操作url：/news/edit', '1', '1488559640');
INSERT INTO `os_action_log` VALUES ('195', '10001', '1', '3232263681', 'weibo', '19', 'admin在2017-03-04 10:36发布了新微博：19【积分：+1分】', '1', '1488594988');
INSERT INTO `os_action_log` VALUES ('196', '3', '1', '3232263681', 'member', '1', 'admin在2017-03-05 11:06登录了账号【积分：+10分】', '1', '1488683176');
INSERT INTO `os_action_log` VALUES ('197', '3', '1', '3232263681', 'member', '1', 'admin在2017-03-05 14:38登录了账号', '1', '1488695902');
INSERT INTO `os_action_log` VALUES ('198', '3', '101', '3232263681', 'member', '101', '包汉伟在2017-03-07 09:20登录了账号【积分：+10分】', '1', '1488849616');

-- ----------------------------
-- Table structure for os_addons
-- ----------------------------
DROP TABLE IF EXISTS `os_addons`;
CREATE TABLE `os_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
-- Records of os_addons
-- ----------------------------
INSERT INTO `os_addons` VALUES ('7', 'CheckIn', '签到', '签到插件', '1', '{\"random\":\"1\"}', 'xjw129xjt(肖骏涛)', '0.1', '1432791968', '0');
INSERT INTO `os_addons` VALUES ('8', 'Support', '赞', '赞的功能', '1', 'null', '嘉兴想天信息科技有限公司', '0.1', '1432792013', '0');
INSERT INTO `os_addons` VALUES ('9', 'SuperLinks', '合作单位', '合作单位', '1', '{\"random\":\"1\"}', '苏南 newsn.net', '0.1', '1432792019', '1');
INSERT INTO `os_addons` VALUES ('10', 'Report', '举报后台', '可举报不法数据', '1', '{\"meta\":\"\"}', '想天科技xuminwei', '0.1', '1432792026', '1');
INSERT INTO `os_addons` VALUES ('11', 'LocalComment', '本地评论', '本地评论插件，不依赖社会化评论平台', '1', '{\"can_guest_comment\":\"0\"}', 'caipeichao', '0.1', '1432792035', '0');
INSERT INTO `os_addons` VALUES ('12', 'ChinaCity', '中国省市区三级联动', '每个系统都需要的一个中国省市区三级联动插件。想天-駿濤修改，将镇级地区移除', '1', 'null', 'i友街', '2.0', '1432792040', '0');
INSERT INTO `os_addons` VALUES ('13', 'Recommend', '推荐关注', '可选择多种方法推荐用户', '1', '{\"howToRecommend\":\"1\",\"howManyRecommend\":\"1\",\"recommendUser\":\"1\"}', '嘉兴想天信息科技有限公司', '0.1', '1432792055', '1');
INSERT INTO `os_addons` VALUES ('14', 'SyncLogin', '同步登陆', '同步登陆', '1', '{\"type\":null,\"meta\":\"\",\"bind\":\"0\",\"QqKEY\":\"\",\"QqSecret\":\"\",\"SinaKEY\":\"\",\"SinaSecret\":\"\",\"WeixinKEY\":\"\",\"WeixinSecret\":\"\"}', 'xjw129xjt', '0.1', '1432792112', '0');

-- ----------------------------
-- Table structure for os_adv
-- ----------------------------
DROP TABLE IF EXISTS `os_adv`;
CREATE TABLE `os_adv` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '广告名称',
  `pos_id` int(11) NOT NULL COMMENT '广告位置',
  `data` text NOT NULL COMMENT '图片地址',
  `click_count` int(11) NOT NULL COMMENT '点击量',
  `url` varchar(500) NOT NULL COMMENT '链接地址',
  `sort` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) unsigned DEFAULT '0' COMMENT '结束时间',
  `target` varchar(20) DEFAULT '_blank',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10007 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告表';

-- ----------------------------
-- Records of os_adv
-- ----------------------------
INSERT INTO `os_adv` VALUES ('10001', 'Windows 10 全新开始屏幕曝光', '5', '{\"pic\":8,\"target\":\"_blank\"}', '0', '', '0', '1', '1482932361', '1482932136', '1483536936', '_blank');
INSERT INTO `os_adv` VALUES ('10002', '微信小程序将于 2017 年 1 月 9 日正式开放', '5', '{\"pic\":9,\"target\":\"_blank\"}', '0', '', '1', '1', '1482932361', '1482932230', '1483537030', '_blank');
INSERT INTO `os_adv` VALUES ('10004', '【新游坊】第106期 IGN高分佳作《蘑菇11》来袭', '9', '{\"pic\":18,\"target\":\"_blank\"}', '0', 'http://www.baidu.com', '0', '1', '1487993693', '1487993517', '1493523000', '_blank');
INSERT INTO `os_adv` VALUES ('10005', '每周最佳游戏：同名日漫改编游戏《学园偶像祭》上架安卓', '9', '{\"pic\":19,\"target\":\"_blank\"}', '0', 'http://www.baidu.com', '1', '1', '1487993693', '1487993626', '1488598426', '_blank');
INSERT INTO `os_adv` VALUES ('10006', '这份年度行业报告里 手游有这些变化和趋势', '9', '{\"pic\":20,\"target\":\"_blank\"}', '0', 'http://www.baidu.com', '2', '1', '1487993693', '1487993626', '1488598426', '_blank');

-- ----------------------------
-- Table structure for os_adv_pos
-- ----------------------------
DROP TABLE IF EXISTS `os_adv_pos`;
CREATE TABLE `os_adv_pos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) NOT NULL,
  `title` char(80) NOT NULL DEFAULT '' COMMENT '广告位置名称',
  `path` varchar(100) NOT NULL COMMENT '所在路径 模块/控制器/方法',
  `type` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '广告位类型 \r\n1.单图\r\n2.多图\r\n3.文字链接\r\n4.代码',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `data` varchar(500) NOT NULL COMMENT '额外的数据',
  `width` char(20) NOT NULL DEFAULT '' COMMENT '广告位置宽度',
  `height` char(20) NOT NULL DEFAULT '' COMMENT '广告位置高度',
  `margin` varchar(50) NOT NULL COMMENT '边缘',
  `padding` varchar(50) NOT NULL COMMENT '留白',
  `theme` varchar(50) NOT NULL DEFAULT 'all' COMMENT '适用主题，默认为all，通用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10017 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='广告位置表';

-- ----------------------------
-- Records of os_adv_pos
-- ----------------------------
INSERT INTO `os_adv_pos` VALUES ('1', 'right_below_all', '右侧底部广告', 'Weibo/Index/index', '1', '1', '0', '280px', '100px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('2', 'below_checkrank', '签到下方广告', 'Weibo/Index/index', '1', '1', '0', '280px', '100px', '0 0 10px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('3', 'filter_right', '过滤右方', 'Weibo/Index/index', '3', '1', '0', '300px', '30px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10', 'below_post_content', '帖子主题下方广告1', 'Forum/Index/index', '1', '1', '0', '680px', '100px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('11', 'below_post_content', '论坛帖子主题下方广告', 'Forum/Index/detail', '1', '1', '', '680px', '100px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('4', 'below_self_info', '个人资料下方', 'Weibo/Index/index', '1', '1', '', '280px', '100px', '0 0 10px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('5', 'index_top', '资讯首页顶部广告', 'News/Index/index', '2', '1', '{\"style\":1}', '825px', '240px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('6', 'index_bottom_top', '资讯首页右侧最底部广告', 'News/Index/index', '1', '1', '', '280px', '100px', '10px 0 0 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('9', 'slider', '首页轮播图', 'Home/Index/index', '2', '1', '{\"style\":1}', '765px', '332px', '0 0 15px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('7', 'index_right_top', '资讯首页右侧最顶部广告', 'News/Index/index', '1', '1', '[]', '280px', '100px', '0 0 10px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('8', 'below_article_content', '资讯文章内容下方广告', 'News/Index/detail', '1', '1', '', '690px', '100px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10000', 'index_top', '博客首页顶部广告', 'Blog/Index/index', '2', '1', '{\"style\":1}', '780px', '240px', '0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10001', 'index_right_top', '资讯首页右侧最顶部广告', 'Blog/Index/index', '1', '1', '[]', '340px', '120px', '0 0 0 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10002', 'index_bottom_top', '资讯首页右侧最底部广告', 'Blog/Index/index', '1', '1', '[]', '340px', '120px', '0 0 0 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10003', 'below_article_content', '资讯文章内容下方广告', 'Blog/Index/detail', '1', '1', '[]', '690px', '100px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10004', 'index_top', '博客首页顶部广告', 'Blog/Index/column', '2', '1', '{\"style\":1}', '800px', '240px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10005', 'index_right_top', '博客首页右侧最顶部广告', 'Blog/Index/column', '1', '1', '[]', '340px', '120px', '0 0 10px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10006', 'index_bottom_top', '博客首页右侧最底部广告', 'Blog/Index/column', '1', '1', '[]', '340px', '120px', '10px 0 0 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10007', 'index_top', '博客首页顶部广告', 'Blog/Column/index', '2', '1', '{\"style\":1}', '800px', '240px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10008', 'index_right_top', '博客首页右侧最顶部广告', 'Blog/Column/index', '1', '1', '[]', '340px', '120px', '0 0 10px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10009', 'index_bottom_top', '博客首页右侧最底部广告', 'Blog/Column/index', '1', '1', '[]', '340px', '120px', '10px 0 0 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10010', 'index_top', '博客首页顶部广告', 'Blog/Column/experts', '2', '1', '{\"style\":1}', '800px', '240px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10011', 'index_right_top', '博客首页右侧最顶部广告', 'Blog/Column/experts', '1', '1', '[]', '340px', '120px', '0 0 10px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10012', 'index_bottom_top', '博客首页右侧最底部广告', 'Blog/Column/experts', '1', '1', '[]', '340px', '120px', '10px 0 0 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10013', 'index_top', '博客首页顶部广告', 'Blog/Column/ranking', '2', '1', '{\"style\":1}', '800px', '240px', '', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10014', 'index_right_top', '博客首页右侧最顶部广告', 'Blog/Column/ranking', '1', '1', '[]', '340px', '120px', '0 0 10px 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10015', 'index_bottom_top', '博客首页右侧最底部广告', 'Blog/Column/ranking', '1', '1', '[]', '340px', '120px', '10px 0 0 0', '', 'all');
INSERT INTO `os_adv_pos` VALUES ('10016', 'below_article_content', '资讯文章内容下方广告', 'Blog/Column/detail', '1', '1', '[]', '690px', '100px', '', '', 'all');

-- ----------------------------
-- Table structure for os_attachment
-- ----------------------------
DROP TABLE IF EXISTS `os_attachment`;
CREATE TABLE `os_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '附件显示名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件类型',
  `source` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源ID',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联记录ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `dir` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录ID',
  `sort` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_record_status` (`record_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
-- Records of os_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for os_auth_extend
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_extend`;
CREATE TABLE `os_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';

-- ----------------------------
-- Records of os_auth_extend
-- ----------------------------
INSERT INTO `os_auth_extend` VALUES ('1', '1', '1');
INSERT INTO `os_auth_extend` VALUES ('1', '1', '2');
INSERT INTO `os_auth_extend` VALUES ('1', '2', '1');
INSERT INTO `os_auth_extend` VALUES ('1', '2', '2');
INSERT INTO `os_auth_extend` VALUES ('1', '3', '1');
INSERT INTO `os_auth_extend` VALUES ('1', '3', '2');
INSERT INTO `os_auth_extend` VALUES ('1', '4', '1');
INSERT INTO `os_auth_extend` VALUES ('1', '37', '1');

-- ----------------------------
-- Table structure for os_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_group`;
CREATE TABLE `os_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` text NOT NULL COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_auth_group
-- ----------------------------
INSERT INTO `os_auth_group` VALUES ('1', 'admin', '1', '普通用户', '', '1', ',10058,10060,10063,10065,10068,10069,10070,10071,10095,10098,10036,10053,10054,340,338,341,344');
INSERT INTO `os_auth_group` VALUES ('2', 'admin', '1', 'VIP', '', '1', ',338,340,341,344,10053,10054,10058,10060,10063,10065,10068,10069,10070,10071,10095,10098');

-- ----------------------------
-- Table structure for os_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_group_access`;
CREATE TABLE `os_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_auth_group_access
-- ----------------------------
INSERT INTO `os_auth_group_access` VALUES ('1', '1');
INSERT INTO `os_auth_group_access` VALUES ('101', '1');
INSERT INTO `os_auth_group_access` VALUES ('102', '1');
INSERT INTO `os_auth_group_access` VALUES ('104', '1');

-- ----------------------------
-- Table structure for os_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `os_auth_rule`;
CREATE TABLE `os_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=10139 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_auth_rule
-- ----------------------------
INSERT INTO `os_auth_rule` VALUES ('1', 'admin', '2', 'Admin/Index/index', '首页', '1', '');
INSERT INTO `os_auth_rule` VALUES ('2', 'admin', '2', 'Admin/Article/mydocument', '资讯', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('3', 'admin', '2', 'Admin/User/index', '用户', '1', '');
INSERT INTO `os_auth_rule` VALUES ('4', 'admin', '2', 'Admin/Addons/index', '插件', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('5', 'admin', '2', 'Admin/Config/group', '系统', '1', '');
INSERT INTO `os_auth_rule` VALUES ('7', 'admin', '1', 'Admin/article/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('8', 'admin', '1', 'Admin/article/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('9', 'admin', '1', 'Admin/article/setStatus', '改变状态', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('10', 'admin', '1', 'Admin/article/update', '保存', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('11', 'admin', '1', 'Admin/article/autoSave', '保存草稿', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('12', 'admin', '1', 'Admin/article/move', '移动', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('13', 'admin', '1', 'Admin/article/copy', '复制', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('14', 'admin', '1', 'Admin/article/paste', '粘贴', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('15', 'admin', '1', 'Admin/article/permit', '还原', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('16', 'admin', '1', 'Admin/article/clear', '清空', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('17', 'admin', '1', 'Admin/article/index', '文档列表', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('18', 'admin', '1', 'Admin/article/recycle', '回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('19', 'admin', '1', 'Admin/User/addaction', '新增用户行为', '1', '');
INSERT INTO `os_auth_rule` VALUES ('20', 'admin', '1', 'Admin/User/editaction', '编辑用户行为', '1', '');
INSERT INTO `os_auth_rule` VALUES ('21', 'admin', '1', 'Admin/User/saveAction', '保存用户行为', '1', '');
INSERT INTO `os_auth_rule` VALUES ('22', 'admin', '1', 'Admin/User/setStatus', '变更行为状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('23', 'admin', '1', 'Admin/User/changeStatus?method=forbidUser', '禁用会员', '1', '');
INSERT INTO `os_auth_rule` VALUES ('24', 'admin', '1', 'Admin/User/changeStatus?method=resumeUser', '启用会员', '1', '');
INSERT INTO `os_auth_rule` VALUES ('25', 'admin', '1', 'Admin/User/changeStatus?method=deleteUser', '删除会员', '1', '');
INSERT INTO `os_auth_rule` VALUES ('26', 'admin', '1', 'Admin/User/index', '用户信息', '1', '');
INSERT INTO `os_auth_rule` VALUES ('27', 'admin', '1', 'Admin/User/action', '积分规则', '1', '');
INSERT INTO `os_auth_rule` VALUES ('28', 'admin', '1', 'Admin/AuthManager/changeStatus?method=deleteGroup', '删除', '1', '');
INSERT INTO `os_auth_rule` VALUES ('29', 'admin', '1', 'Admin/AuthManager/changeStatus?method=forbidGroup', '禁用', '1', '');
INSERT INTO `os_auth_rule` VALUES ('30', 'admin', '1', 'Admin/AuthManager/changeStatus?method=resumeGroup', '恢复', '1', '');
INSERT INTO `os_auth_rule` VALUES ('31', 'admin', '1', 'Admin/AuthManager/createGroup', '新增', '1', '');
INSERT INTO `os_auth_rule` VALUES ('32', 'admin', '1', 'Admin/AuthManager/editGroup', '编辑', '1', '');
INSERT INTO `os_auth_rule` VALUES ('33', 'admin', '1', 'Admin/AuthManager/writeGroup', '保存用户组', '1', '');
INSERT INTO `os_auth_rule` VALUES ('34', 'admin', '1', 'Admin/AuthManager/group', '授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('35', 'admin', '1', 'Admin/AuthManager/access', '访问授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('36', 'admin', '1', 'Admin/AuthManager/user', '成员授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('37', 'admin', '1', 'Admin/AuthManager/removeFromGroup', '解除授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('38', 'admin', '1', 'Admin/AuthManager/addToGroup', '保存成员授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('39', 'admin', '1', 'Admin/AuthManager/category', '分类授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('40', 'admin', '1', 'Admin/AuthManager/addToCategory', '保存分类授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('41', 'admin', '1', 'Admin/AuthManager/index', '用户组管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('42', 'admin', '1', 'Admin/Addons/create', '创建', '1', '');
INSERT INTO `os_auth_rule` VALUES ('43', 'admin', '1', 'Admin/Addons/checkForm', '检测创建', '1', '');
INSERT INTO `os_auth_rule` VALUES ('44', 'admin', '1', 'Admin/Addons/preview', '预览', '1', '');
INSERT INTO `os_auth_rule` VALUES ('45', 'admin', '1', 'Admin/Addons/build', '快速生成插件', '1', '');
INSERT INTO `os_auth_rule` VALUES ('46', 'admin', '1', 'Admin/Addons/config', '设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('47', 'admin', '1', 'Admin/Addons/disable', '禁用', '1', '');
INSERT INTO `os_auth_rule` VALUES ('48', 'admin', '1', 'Admin/Addons/enable', '启用', '1', '');
INSERT INTO `os_auth_rule` VALUES ('49', 'admin', '1', 'Admin/Addons/install', '安装', '1', '');
INSERT INTO `os_auth_rule` VALUES ('50', 'admin', '1', 'Admin/Addons/uninstall', '卸载', '1', '');
INSERT INTO `os_auth_rule` VALUES ('51', 'admin', '1', 'Admin/Addons/saveconfig', '更新配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('52', 'admin', '1', 'Admin/Addons/adminList', '插件后台列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('53', 'admin', '1', 'Admin/Addons/execute', 'URL方式访问插件', '1', '');
INSERT INTO `os_auth_rule` VALUES ('54', 'admin', '1', 'Admin/Addons/index', '插件管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('55', 'admin', '1', 'Admin/Addons/hooks', '钩子管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('56', 'admin', '1', 'Admin/model/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('57', 'admin', '1', 'Admin/model/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('58', 'admin', '1', 'Admin/model/setStatus', '改变状态', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('59', 'admin', '1', 'Admin/model/update', '保存数据', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('60', 'admin', '1', 'Admin/Model/index', '模型管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('61', 'admin', '1', 'Admin/Config/edit', '编辑', '1', '');
INSERT INTO `os_auth_rule` VALUES ('62', 'admin', '1', 'Admin/Config/del', '删除', '1', '');
INSERT INTO `os_auth_rule` VALUES ('63', 'admin', '1', 'Admin/Config/add', '新增', '1', '');
INSERT INTO `os_auth_rule` VALUES ('64', 'admin', '1', 'Admin/Config/save', '保存', '1', '');
INSERT INTO `os_auth_rule` VALUES ('65', 'admin', '1', 'Admin/Config/group', '网站设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('66', 'admin', '1', 'Admin/Config/index', '配置管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('67', 'admin', '1', 'Admin/Channel/add', '新增', '1', '');
INSERT INTO `os_auth_rule` VALUES ('68', 'admin', '1', 'Admin/Channel/edit', '编辑', '1', '');
INSERT INTO `os_auth_rule` VALUES ('69', 'admin', '1', 'Admin/Channel/del', '删除', '1', '');
INSERT INTO `os_auth_rule` VALUES ('70', 'admin', '1', 'Admin/Channel/index', '顶部导航', '1', '');
INSERT INTO `os_auth_rule` VALUES ('71', 'admin', '1', 'Admin/Category/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('72', 'admin', '1', 'Admin/Category/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('73', 'admin', '1', 'Admin/Category/remove', '删除', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('74', 'admin', '1', 'Admin/Category/index', '分类管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('75', 'admin', '1', 'Admin/file/upload', '上传控件', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('76', 'admin', '1', 'Admin/file/uploadPicture', '上传图片', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('77', 'admin', '1', 'Admin/file/download', '下载', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('94', 'admin', '1', 'Admin/AuthManager/modelauth', '模型授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('79', 'admin', '1', 'Admin/article/batchOperate', '导入', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('80', 'admin', '1', 'Admin/Database/index?type=export', '备份数据库', '1', '');
INSERT INTO `os_auth_rule` VALUES ('81', 'admin', '1', 'Admin/Database/index?type=import', '还原数据库', '1', '');
INSERT INTO `os_auth_rule` VALUES ('82', 'admin', '1', 'Admin/Database/export', '备份', '1', '');
INSERT INTO `os_auth_rule` VALUES ('83', 'admin', '1', 'Admin/Database/optimize', '优化表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('84', 'admin', '1', 'Admin/Database/repair', '修复表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('86', 'admin', '1', 'Admin/Database/import', '恢复', '1', '');
INSERT INTO `os_auth_rule` VALUES ('87', 'admin', '1', 'Admin/Database/del', '删除', '1', '');
INSERT INTO `os_auth_rule` VALUES ('88', 'admin', '1', 'Admin/User/add', '新增用户', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('89', 'admin', '1', 'Admin/Attribute/index', '属性管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('90', 'admin', '1', 'Admin/Attribute/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('91', 'admin', '1', 'Admin/Attribute/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('92', 'admin', '1', 'Admin/Attribute/setStatus', '改变状态', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('93', 'admin', '1', 'Admin/Attribute/update', '保存数据', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('95', 'admin', '1', 'Admin/AuthManager/addToModel', '保存模型授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('96', 'admin', '1', 'Admin/Category/move', '移动', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('97', 'admin', '1', 'Admin/Category/merge', '合并', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('98', 'admin', '1', 'Admin/Config/menu', '后台菜单管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('99', 'admin', '1', 'Admin/Article/mydocument', '内容', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('100', 'admin', '1', 'Admin/Menu/index', '后台菜单管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('101', 'admin', '1', 'Admin/other', '其他', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('102', 'admin', '1', 'Admin/Menu/add', '新增', '1', '');
INSERT INTO `os_auth_rule` VALUES ('103', 'admin', '1', 'Admin/Menu/edit', '编辑', '1', '');
INSERT INTO `os_auth_rule` VALUES ('104', 'admin', '1', 'Admin/Think/lists?model=article', '文章管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('105', 'admin', '1', 'Admin/Think/lists?model=download', '下载管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('106', 'admin', '1', 'Admin/Think/lists?model=config', '配置管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('107', 'admin', '1', 'Admin/Action/actionlog', '行为日志', '1', '');
INSERT INTO `os_auth_rule` VALUES ('108', 'admin', '1', 'Admin/User/updatePassword', '修改密码', '1', '');
INSERT INTO `os_auth_rule` VALUES ('109', 'admin', '1', 'Admin/User/updateNickname', '修改昵称', '1', '');
INSERT INTO `os_auth_rule` VALUES ('110', 'admin', '1', 'Admin/action/edit', '查看行为日志', '1', '');
INSERT INTO `os_auth_rule` VALUES ('205', 'admin', '1', 'Admin/think/add', '新增数据', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('111', 'admin', '2', 'Admin/article/index', '文档列表', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('112', 'admin', '2', 'Admin/article/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('113', 'admin', '2', 'Admin/article/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('114', 'admin', '2', 'Admin/article/setStatus', '改变状态', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('115', 'admin', '2', 'Admin/article/update', '保存', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('116', 'admin', '2', 'Admin/article/autoSave', '保存草稿', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('117', 'admin', '2', 'Admin/article/move', '移动', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('118', 'admin', '2', 'Admin/article/copy', '复制', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('119', 'admin', '2', 'Admin/article/paste', '粘贴', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('120', 'admin', '2', 'Admin/article/batchOperate', '导入', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('121', 'admin', '2', 'Admin/article/recycle', '回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('122', 'admin', '2', 'Admin/article/permit', '还原', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('123', 'admin', '2', 'Admin/article/clear', '清空', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('124', 'admin', '2', 'Admin/User/add', '新增用户', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('125', 'admin', '2', 'Admin/User/action', '用户行为', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('126', 'admin', '2', 'Admin/User/addAction', '新增用户行为', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('127', 'admin', '2', 'Admin/User/editAction', '编辑用户行为', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('128', 'admin', '2', 'Admin/User/saveAction', '保存用户行为', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('129', 'admin', '2', 'Admin/User/setStatus', '变更行为状态', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('130', 'admin', '2', 'Admin/User/changeStatus?method=forbidUser', '禁用会员', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('131', 'admin', '2', 'Admin/User/changeStatus?method=resumeUser', '启用会员', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('132', 'admin', '2', 'Admin/User/changeStatus?method=deleteUser', '删除会员', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('133', 'admin', '2', 'Admin/AuthManager/index', '权限管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('134', 'admin', '2', 'Admin/AuthManager/changeStatus?method=deleteGroup', '删除', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('135', 'admin', '2', 'Admin/AuthManager/changeStatus?method=forbidGroup', '禁用', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('136', 'admin', '2', 'Admin/AuthManager/changeStatus?method=resumeGroup', '恢复', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('137', 'admin', '2', 'Admin/AuthManager/createGroup', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('138', 'admin', '2', 'Admin/AuthManager/editGroup', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('139', 'admin', '2', 'Admin/AuthManager/writeGroup', '保存用户组', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('140', 'admin', '2', 'Admin/AuthManager/group', '授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('141', 'admin', '2', 'Admin/AuthManager/access', '访问授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('142', 'admin', '2', 'Admin/AuthManager/user', '成员授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('143', 'admin', '2', 'Admin/AuthManager/removeFromGroup', '解除授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('144', 'admin', '2', 'Admin/AuthManager/addToGroup', '保存成员授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('145', 'admin', '2', 'Admin/AuthManager/category', '分类授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('146', 'admin', '2', 'Admin/AuthManager/addToCategory', '保存分类授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('147', 'admin', '2', 'Admin/AuthManager/modelauth', '模型授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('148', 'admin', '2', 'Admin/AuthManager/addToModel', '保存模型授权', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('149', 'admin', '2', 'Admin/Addons/create', '创建', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('150', 'admin', '2', 'Admin/Addons/checkForm', '检测创建', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('151', 'admin', '2', 'Admin/Addons/preview', '预览', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('152', 'admin', '2', 'Admin/Addons/build', '快速生成插件', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('153', 'admin', '2', 'Admin/Addons/config', '设置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('154', 'admin', '2', 'Admin/Addons/disable', '禁用', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('155', 'admin', '2', 'Admin/Addons/enable', '启用', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('156', 'admin', '2', 'Admin/Addons/install', '安装', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('157', 'admin', '2', 'Admin/Addons/uninstall', '卸载', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('158', 'admin', '2', 'Admin/Addons/saveconfig', '更新配置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('159', 'admin', '2', 'Admin/Addons/adminList', '插件后台列表', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('160', 'admin', '2', 'Admin/Addons/execute', 'URL方式访问插件', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('161', 'admin', '2', 'Admin/Addons/hooks', '钩子管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('162', 'admin', '2', 'Admin/Model/index', '模型管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('163', 'admin', '2', 'Admin/model/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('164', 'admin', '2', 'Admin/model/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('165', 'admin', '2', 'Admin/model/setStatus', '改变状态', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('166', 'admin', '2', 'Admin/model/update', '保存数据', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('167', 'admin', '2', 'Admin/Attribute/index', '属性管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('168', 'admin', '2', 'Admin/Attribute/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('169', 'admin', '2', 'Admin/Attribute/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('170', 'admin', '2', 'Admin/Attribute/setStatus', '改变状态', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('171', 'admin', '2', 'Admin/Attribute/update', '保存数据', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('172', 'admin', '2', 'Admin/Config/index', '配置管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('173', 'admin', '2', 'Admin/Config/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('174', 'admin', '2', 'Admin/Config/del', '删除', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('175', 'admin', '2', 'Admin/Config/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('176', 'admin', '2', 'Admin/Config/save', '保存', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('177', 'admin', '2', 'Admin/Menu/index', '菜单管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('178', 'admin', '2', 'Admin/Channel/index', '导航管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('179', 'admin', '2', 'Admin/Channel/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('180', 'admin', '2', 'Admin/Channel/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('181', 'admin', '2', 'Admin/Channel/del', '删除', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('182', 'admin', '2', 'Admin/Category/index', '分类管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('183', 'admin', '2', 'Admin/Category/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('184', 'admin', '2', 'Admin/Category/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('185', 'admin', '2', 'Admin/Category/remove', '删除', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('186', 'admin', '2', 'Admin/Category/move', '移动', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('187', 'admin', '2', 'Admin/Category/merge', '合并', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('188', 'admin', '2', 'Admin/Database/index?type=export', '备份数据库', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('189', 'admin', '2', 'Admin/Database/export', '备份', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('190', 'admin', '2', 'Admin/Database/optimize', '优化表', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('191', 'admin', '2', 'Admin/Database/repair', '修复表', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('192', 'admin', '2', 'Admin/Database/index?type=import', '还原数据库', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('193', 'admin', '2', 'Admin/Database/import', '恢复', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('194', 'admin', '2', 'Admin/Database/del', '删除', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('195', 'admin', '2', 'Admin/other', '其他', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('196', 'admin', '2', 'Admin/Menu/add', '新增', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('197', 'admin', '2', 'Admin/Menu/edit', '编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('198', 'admin', '2', 'Admin/Think/lists?model=article', '应用', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('199', 'admin', '2', 'Admin/Think/lists?model=download', '下载管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('200', 'admin', '2', 'Admin/Think/lists?model=config', '应用', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('201', 'admin', '2', 'Admin/Action/actionlog', '行为日志', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('202', 'admin', '2', 'Admin/User/updatePassword', '修改密码', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('203', 'admin', '2', 'Admin/User/updateNickname', '修改昵称', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('204', 'admin', '2', 'Admin/action/edit', '查看行为日志', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('206', 'admin', '1', 'Admin/think/edit', '编辑数据', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('207', 'admin', '1', 'Admin/Menu/import', '导入', '1', '');
INSERT INTO `os_auth_rule` VALUES ('208', 'admin', '1', 'Admin/Model/generate', '生成', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('209', 'admin', '1', 'Admin/Addons/addHook', '新增钩子', '1', '');
INSERT INTO `os_auth_rule` VALUES ('210', 'admin', '1', 'Admin/Addons/edithook', '编辑钩子', '1', '');
INSERT INTO `os_auth_rule` VALUES ('211', 'admin', '1', 'Admin/Article/sort', '文档排序', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('212', 'admin', '1', 'Admin/Config/sort', '排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('213', 'admin', '1', 'Admin/Menu/sort', '排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('214', 'admin', '1', 'Admin/Channel/sort', '排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('215', 'admin', '1', 'Admin/Category/operate/type/move', '移动', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('216', 'admin', '1', 'Admin/Category/operate/type/merge', '合并', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('217', 'admin', '1', 'Admin/Forum/forum', '板块管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('218', 'admin', '1', 'Admin/Forum/post', '帖子管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('219', 'admin', '1', 'Admin/Forum/editForum', '编辑／发表帖子', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('220', 'admin', '1', 'Admin/Forum/editPost', 'edit pots', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('221', 'admin', '2', 'Admin//Admin/Forum/index', '讨论区', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('222', 'admin', '2', 'Admin//Admin/Weibo/index', '微博', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('223', 'admin', '1', 'Admin/Forum/sortForum', '排序', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('224', 'admin', '1', 'Admin/SEO/editRule', '新增、编辑', '1', '');
INSERT INTO `os_auth_rule` VALUES ('225', 'admin', '1', 'Admin/SEO/sortRule', '排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('226', 'admin', '1', 'Admin/SEO/index', 'SEO规则管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('227', 'admin', '1', 'Admin/Forum/editReply', '新增 编辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('228', 'admin', '1', 'Admin/Weibo/editComment', '编辑回复', '1', '');
INSERT INTO `os_auth_rule` VALUES ('229', 'admin', '1', 'Admin/Weibo/editWeibo', '编辑微博', '1', '');
INSERT INTO `os_auth_rule` VALUES ('230', 'admin', '1', 'Admin/SEO/ruleTrash', 'SEO规则回收站', '1', '');
INSERT INTO `os_auth_rule` VALUES ('231', 'admin', '1', 'Admin/Rank/userList', '查看用户', '1', '');
INSERT INTO `os_auth_rule` VALUES ('232', 'admin', '1', 'Admin/Rank/userRankList', '用户头衔列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('233', 'admin', '1', 'Admin/Rank/userAddRank', '关联新头衔', '1', '');
INSERT INTO `os_auth_rule` VALUES ('234', 'admin', '1', 'Admin/Rank/userChangeRank', '编辑头衔关联', '1', '');
INSERT INTO `os_auth_rule` VALUES ('235', 'admin', '1', 'Admin/Issue/add', '编辑专辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('236', 'admin', '1', 'Admin/Issue/issue', '专辑管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('237', 'admin', '1', 'Admin/Issue/operate', '专辑操作', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('238', 'admin', '1', 'Admin/Weibo/weibo', '微博管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('239', 'admin', '1', 'Admin/Rank/index', '头衔列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('240', 'admin', '1', 'Admin/Forum/forumTrash', '板块回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('241', 'admin', '1', 'Admin/Weibo/weiboTrash', '微博回收站', '1', '');
INSERT INTO `os_auth_rule` VALUES ('242', 'admin', '1', 'Admin/Rank/editRank', '添加头衔', '1', '');
INSERT INTO `os_auth_rule` VALUES ('243', 'admin', '1', 'Admin/Weibo/comment', '回复管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('244', 'admin', '1', 'Admin/Forum/postTrash', '帖子回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('245', 'admin', '1', 'Admin/Weibo/commentTrash', '回复回收站', '1', '');
INSERT INTO `os_auth_rule` VALUES ('246', 'admin', '1', 'Admin/Issue/issueTrash', '专辑回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('247', 'admin', '1', 'Admin//Admin/Forum/reply', '回复管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('248', 'admin', '1', 'Admin/Forum/replyTrash', '回复回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('249', 'admin', '2', 'Admin/Forum/index', '贴吧', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('250', 'admin', '2', 'Admin/Weibo/weibo', '微博', '1', '');
INSERT INTO `os_auth_rule` VALUES ('251', 'admin', '2', 'Admin/SEO/index', 'SEO', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('252', 'admin', '2', 'Admin/Rank/index', '头衔', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('253', 'admin', '2', 'Admin/Issue/issue', '专辑', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('254', 'admin', '1', 'Admin/Issue/contents', '内容管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('255', 'admin', '1', 'Admin/User/profile', '扩展资料', '1', '');
INSERT INTO `os_auth_rule` VALUES ('256', 'admin', '1', 'Admin/User/editProfile', '添加、编辑分组', '1', '');
INSERT INTO `os_auth_rule` VALUES ('257', 'admin', '1', 'Admin/User/sortProfile', '分组排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('258', 'admin', '1', 'Admin/User/field', '字段列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('259', 'admin', '1', 'Admin/User/editFieldSetting', '添加、编辑字段', '1', '');
INSERT INTO `os_auth_rule` VALUES ('260', 'admin', '1', 'Admin/User/sortField', '字段排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('261', 'admin', '1', 'Admin/Update/quick', '全部补丁', '1', '');
INSERT INTO `os_auth_rule` VALUES ('262', 'admin', '1', 'Admin/Update/addpack', '新增补丁', '1', '');
INSERT INTO `os_auth_rule` VALUES ('263', 'admin', '1', 'Admin/User/expandinfo_select', '用户扩展资料列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('264', 'admin', '1', 'Admin/User/expandinfo_details', '扩展资料详情', '1', '');
INSERT INTO `os_auth_rule` VALUES ('265', 'admin', '1', 'Admin/Shop/shopLog', '商城信息记录', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('266', 'admin', '1', 'Admin/Shop/setStatus', '商品分类状态设置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('267', 'admin', '1', 'Admin/Shop/setGoodsStatus', '商品状态设置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('268', 'admin', '1', 'Admin/Shop/operate', '商品分类操作', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('269', 'admin', '1', 'Admin/Shop/add', '商品分类添加', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('270', 'admin', '1', 'Admin/Shop/goodsEdit', '添加、编辑商品', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('271', 'admin', '1', 'Admin/Shop/hotSellConfig', '热销商品阀值配置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('272', 'admin', '1', 'Admin/Shop/setNew', '设置新品', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('273', 'admin', '1', 'Admin/EventType/index', '活动分类管理', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('274', 'admin', '1', 'Admin/Event/event', '内容管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('275', 'admin', '1', 'Admin/EventType/eventTypeTrash', '活动分类回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('276', 'admin', '1', 'Admin/Event/verify', '内容审核', '1', '');
INSERT INTO `os_auth_rule` VALUES ('277', 'admin', '1', 'Admin/Event/contentTrash', '内容回收站', '1', '');
INSERT INTO `os_auth_rule` VALUES ('278', 'admin', '1', 'Admin/Rank/rankVerify', '待审核用户头衔', '1', '');
INSERT INTO `os_auth_rule` VALUES ('279', 'admin', '1', 'Admin/Rank/rankVerifyFailure', '被驳回的头衔申请', '1', '');
INSERT INTO `os_auth_rule` VALUES ('280', 'admin', '1', 'Admin/Weibo/config', '微博设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('281', 'admin', '1', 'Admin/Issue/verify', '内容审核', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('282', 'admin', '1', 'Admin/Shop/goodsList', '商品列表', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('283', 'admin', '1', 'Admin/Shop/shopCategory', '商品分类配置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('284', 'admin', '1', 'Admin/Shop/categoryTrash', '商品分类回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('285', 'admin', '1', 'Admin/Shop/verify', '待发货交易', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('286', 'admin', '1', 'Admin/Issue/contentTrash', '内容回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('287', 'admin', '1', 'Admin/Shop/goodsBuySuccess', '交易成功记录', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('288', 'admin', '1', 'Admin/Shop/goodsTrash', '商品回收站', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('289', 'admin', '1', 'Admin/Shop/toxMoneyConfig', '货币配置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('290', 'admin', '2', 'Admin/Shop/shopCategory', '商城', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('291', 'admin', '2', 'Admin/EventType/index', '活动', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('340', 'Weibo', '1', 'Weibo/Index/doSend', '发微博', '1', '');
INSERT INTO `os_auth_rule` VALUES ('297', 'Home', '1', 'deleteLocalComment', '删除本地评论', '1', '');
INSERT INTO `os_auth_rule` VALUES ('306', 'Issue', '1', 'addIssueContent', '专辑投稿权限', '1', '');
INSERT INTO `os_auth_rule` VALUES ('307', 'Issue', '1', 'editIssueContent', '编辑专辑内容（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('339', 'Weibo', '1', 'Weibo/Index/doDelWeibo', '删除微博(管理)', '1', '');
INSERT INTO `os_auth_rule` VALUES ('338', 'Weibo', '1', 'Weibo/Index/doSendRepost', '转发微博', '1', '');
INSERT INTO `os_auth_rule` VALUES ('313', 'admin', '1', 'Admin/module/install', '模块安装', '1', '');
INSERT INTO `os_auth_rule` VALUES ('315', 'admin', '1', 'Admin/module/lists', '模块管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('316', 'admin', '1', 'Admin/module/uninstall', '卸载模块', '1', '');
INSERT INTO `os_auth_rule` VALUES ('317', 'admin', '1', 'Admin/AuthManager/addNode', '新增权限节点', '1', '');
INSERT INTO `os_auth_rule` VALUES ('318', 'admin', '1', 'Admin/AuthManager/accessUser', '前台权限管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('319', 'admin', '1', 'Admin/User/changeGroup', '转移用户组', '1', '');
INSERT INTO `os_auth_rule` VALUES ('320', 'admin', '1', 'Admin/AuthManager/deleteNode', '删除权限节点', '1', '');
INSERT INTO `os_auth_rule` VALUES ('321', 'admin', '1', 'Admin/Issue/config', '专辑设置', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('322', 'admin', '2', 'Admin/module/lists', '云平台', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('341', 'Weibo', '1', 'Weibo/Index/doComment', '评论微博', '1', '');
INSERT INTO `os_auth_rule` VALUES ('342', 'Weibo', '1', 'Weibo/Index/doDelComment', '删除评论微博(管理)', '1', '');
INSERT INTO `os_auth_rule` VALUES ('343', 'Weibo', '1', 'Weibo/Index/setTop', '微博置顶(管理)', '1', '');
INSERT INTO `os_auth_rule` VALUES ('344', 'Weibo', '1', 'Weibo/Topic/beAdmin', '抢先成为话题主持人', '1', '');
INSERT INTO `os_auth_rule` VALUES ('345', 'Weibo', '1', 'Weibo/Topic/editTopic', '管理话题(管理)', '1', '');
INSERT INTO `os_auth_rule` VALUES ('346', 'admin', '1', 'Admin/UserConfig/index', '用户注册配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('347', 'admin', '1', 'Admin/User/scoreList', '积分类型列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('348', 'admin', '1', 'Admin/User/editScoreType', '新增/编辑类型', '1', '');
INSERT INTO `os_auth_rule` VALUES ('349', 'admin', '1', 'Admin/User/recharge', '充值积分', '1', '');
INSERT INTO `os_auth_rule` VALUES ('350', 'admin', '1', 'Admin/Authorize/ssoSetting', '单点登录配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('351', 'admin', '1', 'Admin/Authorize/ssolist', '应用列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('352', 'admin', '1', 'Admin/authorize/editssoapp', '新增/编辑应用', '1', '');
INSERT INTO `os_auth_rule` VALUES ('353', 'admin', '1', 'Admin/ActionLimit/limitList', '行为限制列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('354', 'admin', '1', 'Admin/ActionLimit/editLimit', '新增/编辑行为限制', '1', '');
INSERT INTO `os_auth_rule` VALUES ('355', 'admin', '1', 'Admin/Role/index', '身份列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('356', 'admin', '1', 'Admin/Role/editRole', '编辑身份', '1', '');
INSERT INTO `os_auth_rule` VALUES ('357', 'admin', '1', 'Admin/Role/setStatus', '启用、禁用、删除身份', '1', '');
INSERT INTO `os_auth_rule` VALUES ('358', 'admin', '1', 'Admin/Role/sort', '身份排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('359', 'admin', '1', 'Admin/Role/configScore', '默认积分配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('360', 'admin', '1', 'Admin/Role/configAuth', '默认权限配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('361', 'admin', '1', 'Admin/Role/configAvatar', '默认头像配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('362', 'admin', '1', 'Admin/Role/configRank', '默认头衔配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('363', 'admin', '1', 'Admin/Role/configField', '默认字段管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('364', 'admin', '1', 'Admin/Role/group', '身份分组', '1', '');
INSERT INTO `os_auth_rule` VALUES ('365', 'admin', '1', 'Admin/Role/editGroup', '编辑分组', '1', '');
INSERT INTO `os_auth_rule` VALUES ('366', 'admin', '1', 'Admin/Role/deleteGroup', '删除分组', '1', '');
INSERT INTO `os_auth_rule` VALUES ('367', 'admin', '1', 'Admin/Role/config', '身份基本信息配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('368', 'admin', '1', 'Admin/Role/userList', '用户列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('369', 'admin', '1', 'Admin/Role/setUserStatus', '设置用户状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('370', 'admin', '1', 'Admin/Role/setUserAudit', '审核用户', '1', '');
INSERT INTO `os_auth_rule` VALUES ('371', 'admin', '1', 'Admin/Role/changeRole', '迁移用户', '1', '');
INSERT INTO `os_auth_rule` VALUES ('372', 'admin', '1', 'Admin/Role/uploadPicture', '上传默认头像', '1', '');
INSERT INTO `os_auth_rule` VALUES ('373', 'admin', '1', 'Admin/Invite/index', '类型管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('374', 'admin', '1', 'Admin/Invite/invite', '邀请码管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('375', 'admin', '1', 'Admin/Invite/config', '基础配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('376', 'admin', '1', 'Admin/Invite/buyLog', '兑换记录', '1', '');
INSERT INTO `os_auth_rule` VALUES ('377', 'admin', '1', 'Admin/Invite/inviteLog', '邀请记录', '1', '');
INSERT INTO `os_auth_rule` VALUES ('378', 'admin', '1', 'Admin/Invite/userInfo', '用户信息', '1', '');
INSERT INTO `os_auth_rule` VALUES ('379', 'admin', '1', 'Admin/Invite/edit', '编辑邀请注册类型', '1', '');
INSERT INTO `os_auth_rule` VALUES ('380', 'admin', '1', 'Admin/Invite/setStatus', '删除邀请', '1', '');
INSERT INTO `os_auth_rule` VALUES ('381', 'admin', '1', 'Admin/Invite/delete', '删除邀请码', '1', '');
INSERT INTO `os_auth_rule` VALUES ('382', 'admin', '1', 'Admin/Invite/createCode', '生成邀请码', '1', '');
INSERT INTO `os_auth_rule` VALUES ('383', 'admin', '1', 'Admin/Invite/deleteTrue', '删除无用邀请码', '1', '');
INSERT INTO `os_auth_rule` VALUES ('384', 'admin', '1', 'Admin/Invite/cvs', '导出cvs', '1', '');
INSERT INTO `os_auth_rule` VALUES ('385', 'admin', '1', 'Admin/Invite/editUserInfo', '用户信息编辑', '1', '');
INSERT INTO `os_auth_rule` VALUES ('386', 'admin', '1', 'Admin/Action/remove', '删除日志', '1', '');
INSERT INTO `os_auth_rule` VALUES ('387', 'admin', '1', 'Admin/Action/clear', '清空日志', '1', '');
INSERT INTO `os_auth_rule` VALUES ('388', 'admin', '1', 'Admin/User/setTypeStatus', '设置积分状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('389', 'admin', '1', 'Admin/User/delType', '删除积分类型', '1', '');
INSERT INTO `os_auth_rule` VALUES ('390', 'admin', '1', 'Admin/User/getNickname', '充值积分-获取用户昵称', '1', '');
INSERT INTO `os_auth_rule` VALUES ('391', 'admin', '1', 'Admin/Menu/del', '删除菜单', '1', '');
INSERT INTO `os_auth_rule` VALUES ('392', 'admin', '1', 'Admin/Menu/toogleDev', '设置开发者模式可见', '1', '');
INSERT INTO `os_auth_rule` VALUES ('393', 'admin', '1', 'Admin/Menu/toogleHide', '设置显示隐藏', '1', '');
INSERT INTO `os_auth_rule` VALUES ('394', 'admin', '1', 'Admin/ActionLimit/setLimitStatus', '行为限制启用、禁用、删除', '1', '');
INSERT INTO `os_auth_rule` VALUES ('395', 'admin', '1', 'Admin/SEO/setRuleStatus', '启用、禁用、删除、回收站还原', '1', '');
INSERT INTO `os_auth_rule` VALUES ('396', 'admin', '1', 'Admin/SEO/doClear', '回收站彻底删除', '1', '');
INSERT INTO `os_auth_rule` VALUES ('397', 'admin', '1', 'Admin/Role/initUnhaveUser', '初始化无角色用户', '1', '');
INSERT INTO `os_auth_rule` VALUES ('398', 'admin', '1', 'Admin/Addons/delHook', '删除钩子', '1', '');
INSERT INTO `os_auth_rule` VALUES ('399', 'admin', '1', 'Admin/Update/usePack', '使用补丁', '1', '');
INSERT INTO `os_auth_rule` VALUES ('400', 'admin', '1', 'Admin/Update/view', '查看补丁', '1', '');
INSERT INTO `os_auth_rule` VALUES ('401', 'admin', '1', 'Admin/Update/delPack', '删除补丁', '1', '');
INSERT INTO `os_auth_rule` VALUES ('402', 'admin', '1', 'Admin/UserTag/userTag', '用户标签列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('403', 'admin', '1', 'Admin/UserTag/add', '添加分类、标签', '1', '');
INSERT INTO `os_auth_rule` VALUES ('404', 'admin', '1', 'Admin/UserTag/setStatus', '设置分类、标签状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('405', 'admin', '1', 'Admin/UserTag/tagTrash', '分类、标签回收站', '1', '');
INSERT INTO `os_auth_rule` VALUES ('406', 'admin', '1', 'Admin/UserTag/userTagClear', '测底删除回收站内容', '1', '');
INSERT INTO `os_auth_rule` VALUES ('407', 'admin', '1', 'Admin/role/configusertag', '可拥有标签配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('408', 'admin', '1', 'Admin/Module/edit', '编辑模块', '1', '');
INSERT INTO `os_auth_rule` VALUES ('409', 'admin', '1', 'Admin/Config/website', '网站信息', '1', '');
INSERT INTO `os_auth_rule` VALUES ('410', 'admin', '1', 'Admin/Theme/setTheme', '使用主题', '1', '');
INSERT INTO `os_auth_rule` VALUES ('411', 'admin', '1', 'Admin/Theme/lookTheme', '查看主题', '1', '');
INSERT INTO `os_auth_rule` VALUES ('412', 'admin', '1', 'Admin/Theme/packageDownload', '主题打包下载', '1', '');
INSERT INTO `os_auth_rule` VALUES ('413', 'admin', '1', 'Admin/Theme/delete', '卸载删除主题', '1', '');
INSERT INTO `os_auth_rule` VALUES ('414', 'admin', '1', 'Admin/Theme/add', '上传安装主题', '1', '');
INSERT INTO `os_auth_rule` VALUES ('415', 'admin', '2', 'Admin/Home/config', '网站主页', '1', '');
INSERT INTO `os_auth_rule` VALUES ('416', 'admin', '1', 'Admin/Home/config', '基本设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('417', 'admin', '1', 'Admin/Weibo/topic', '话题管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('418', 'admin', '1', 'Admin/Weibo/setWeiboTop', '置顶微博', '1', '');
INSERT INTO `os_auth_rule` VALUES ('419', 'admin', '1', 'Admin/Weibo/setWeiboStatus', '设置微博状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('420', 'admin', '1', 'Admin/Weibo/setCommentStatus', '设置微博评论状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('421', 'admin', '1', 'Admin/Weibo/setTopicTop', '设置置顶话题', '1', '');
INSERT INTO `os_auth_rule` VALUES ('422', 'admin', '1', 'Admin/Weibo/delTopic', '删除话题', '1', '');
INSERT INTO `os_auth_rule` VALUES ('423', 'admin', '1', 'Admin/People/config', '基本设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('424', 'admin', '1', 'Admin/Cloud/index', '云市场', '1', '');
INSERT INTO `os_auth_rule` VALUES ('425', 'admin', '2', 'Admin/authorize/ssoSetting', '授权', '1', '');
INSERT INTO `os_auth_rule` VALUES ('426', 'admin', '2', 'Admin/Role/index', '身份', '1', '');
INSERT INTO `os_auth_rule` VALUES ('427', 'admin', '1', 'Admin/Theme/tpls', '主题管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('428', 'admin', '2', 'Admin/ActionLimit/limitList', '安全', '1', '');
INSERT INTO `os_auth_rule` VALUES ('429', 'admin', '2', 'Admin/Cloud/index', '扩展', '1', '');
INSERT INTO `os_auth_rule` VALUES ('430', 'admin', '2', 'Admin/People/config', '会员展示', '1', '');
INSERT INTO `os_auth_rule` VALUES ('431', 'admin', '1', 'Admin/Index/index', '后台入口', '-1', '');
INSERT INTO `os_auth_rule` VALUES ('10000', 'admin', '1', 'Admin/Cloud/install', '在线安装', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10001', 'admin', '1', 'Admin/User/initpass', '重置用户密码', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10002', 'admin', '1', 'Admin/Cloud/version', '获取版本信息', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10003', 'admin', '1', 'Admin/Cloud/getFileList', '获取文件列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10004', 'admin', '1', 'Admin/Cloud/compare', '比较本地文件', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10005', 'admin', '1', 'Admin/Cloud/cover', '覆盖文件', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10006', 'admin', '1', 'Admin/Cloud/updb', '更新数据库', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10007', 'admin', '1', 'Admin/Cloud/finish', '更新完成', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10008', 'admin', '1', 'Admin/Cloud/getVersionList', '获取扩展升级列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10009', 'admin', '1', 'Admin/Cloud/updateGoods', '自动升级', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10010', 'admin', '1', 'Admin/Cloud/Updating1', '自动升级1-获取文件列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10011', 'admin', '1', 'Admin/Cloud/Updating2', '自动升级2-比较文件', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10012', 'admin', '1', 'Admin/Cloud/updating3', '自动升级3-升级代码', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10013', 'admin', '1', 'Admin/Cloud/updating4', '自动升级4-导入数据库', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10014', 'admin', '1', 'Admin/Cloud/updating5', '自动升级5-重置版本号', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10015', 'admin', '1', 'Admin/Adv/pos', '广告位', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10016', 'admin', '1', 'Admin/Adv/adv', '广告管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10017', 'admin', '1', 'Admin/Adv/editAdv', '新增广告', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10018', 'admin', '1', 'Admin/Adv/editPos', '编辑广告位', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10019', 'admin', '1', 'Admin/Adv/setPosStatus', '设置广告位状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10020', 'admin', '1', 'Admin/Adv/schedule', '广告排期', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10021', 'admin', '1', 'Admin/Channel/user', '用户导航', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10022', 'admin', '1', 'Admin/Action/scoreLog', '积分日志', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10023', 'admin', '1', 'Admin/Cloud/update', '自动升级', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10024', 'admin', '1', 'Admin/Rank/setVerifyStatus', '用户头衔审核', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10025', 'admin', '2', 'Admin/Operation/index', '运营', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10026', 'admin', '1', 'Admin/message/userList', '群发消息用户列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10027', 'admin', '1', 'Admin/Expression/index', '表情设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10028', 'admin', '1', 'Admin/message/sendMessage', '群发消息', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10029', 'admin', '1', 'Admin/Expression/add', '添加表情包', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10030', 'admin', '1', 'Admin/Expression/package', '表情包列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10031', 'admin', '1', 'Admin/Expression/expressionList', '表情列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10032', 'admin', '1', 'Admin/Expression/delPackage', '删除表情包', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10033', 'admin', '1', 'Admin/Expression/editPackage', '编辑表情包', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10034', 'admin', '1', 'Admin/Expression/delExpression', '删除表情', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10035', 'admin', '1', 'Admin/Expression/upload', '上传表情包', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10036', 'News', '1', 'News/Index/add', '资讯投稿', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10037', 'News', '1', 'News/Index/edit', '编辑资讯（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10038', 'admin', '1', 'Admin/News/audit', '审核列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10039', 'admin', '1', 'Admin/News/doAudit', '资讯审核失败操作', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10040', 'admin', '1', 'Admin/News/setNewsStatus', '审核通过', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10041', 'admin', '1', 'Admin/News/newsCategory', '分类管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10042', 'admin', '1', 'Admin/News/add', '编辑、添加分类', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10043', 'admin', '1', 'Admin/News/setStatus', '设置分类状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10044', 'admin', '1', 'Admin/News/index', '资讯列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10045', 'admin', '1', 'Admin/News/setDead', '设为到期', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10046', 'admin', '1', 'Admin/News/editNews', '编辑、添加资讯', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10047', 'admin', '1', 'Admin/News/config', '基础配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10048', 'admin', '1', 'Admin/Blog/index', '博客列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10049', 'admin', '1', 'Admin/Blog/blogCategory', '分类管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10050', 'admin', '1', 'Admin/Blog/config', '基础配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10051', 'admin', '2', 'Admin/News/index', '资讯', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10052', 'admin', '2', 'Admin/Blog/index', '博客', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10053', 'Question', '1', 'Question/Answer/add', '回答', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10054', 'Question', '1', 'Question/Index/add', '提问', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10055', 'Question', '1', 'Question/Index/edit', '编辑问题（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10056', 'Question', '1', 'Question/Answer/edit', '编辑答案（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10057', 'Question', '1', 'Question/Answer/setBest', '设为最佳答案（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10125', 'admin', '1', 'Admin/Book/bookCategory', '教程分类', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10124', 'admin', '1', 'Admin/Book/changeSectionType', '修改章节类型', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10123', 'admin', '1', 'Admin/Book/sortSections', '章节排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10122', 'admin', '1', 'Admin/Book/sortBook', '教程排序', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10121', 'admin', '1', 'Admin/Book/editSection', '编辑章节', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10120', 'admin', '1', 'Admin/Book/sections', '章节列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10119', 'admin', '1', 'Admin/Book/editSections', '批量编辑章节', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10118', 'admin', '1', 'Admin/Book/editBook', '编辑教程', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10117', 'admin', '1', 'Admin/Book/setBookStatus', '设置教程状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10116', 'admin', '1', 'Admin/Book/setSectionStatus', '设置章节状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10115', 'admin', '1', 'Admin/Book/index', '教程列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10114', 'admin', '2', 'Admin/Book/index', '教程', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10113', 'admin', '1', 'Admin/Question/setQuestionStatus', '设置问题状态（审核、启用、禁用、删除）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10112', 'admin', '1', 'Admin/Question/recommend', '推荐设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10111', 'admin', '1', 'Admin/Question/index', '问题列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10110', 'admin', '1', 'Admin/Question/setAnswerStatus', '设置回答状态（启用、禁用、删除）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10109', 'admin', '1', 'Admin/Question/answer', '回答列表', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10108', 'admin', '1', 'Admin/Question/config', '基础配置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10107', 'admin', '1', 'Admin/Question/add', '编辑、添加分类', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10106', 'admin', '1', 'Admin/Question/setStatus', '设置分类状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10105', 'admin', '1', 'Admin/Question/category', '分类管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10104', 'admin', '1', 'Admin/Blog/setBlogStatus', '设置分类状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10103', 'admin', '1', 'Admin/Blog/addblogcategory', '编辑、添加分类', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10102', 'admin', '1', 'Admin/Blog/setStatus', '设置分类状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10101', 'admin', '1', 'Admin/Blog/add', '编辑、添加分类', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10100', 'admin', '1', 'Admin/Blog/setDead', '设为到期', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10099', 'admin', '1', 'Admin/Blog/editBlog', '编辑、添加博客', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10092', 'Book', '1', 'Book/index/editSection', '编辑教程章节（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10093', 'Event', '1', 'Event/Index/doEndEvent', '结束活动（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10094', 'Event', '1', 'Event/Index/shenhe', '活动报名审核（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10095', 'Event', '1', 'Event/Index/doSign', '活动报名', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10096', 'Event', '1', 'Event/Index/doDelEvent', '删除活动（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10097', 'Event', '1', 'Event/Index/edit', '编辑活动（管理）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10098', 'Event', '1', 'Event/Index/add', '发布活动', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10126', 'admin', '1', 'Admin/Book/setStatus', '设置分类状态', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10127', 'admin', '1', 'Admin/Book/add', '编辑分类', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10128', 'admin', '1', 'Admin/Event/config', '活动设置', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10129', 'admin', '1', 'Admin/Event/index', '活动分类管理', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10130', 'admin', '1', 'Admin/Event/setStatus', '分类禁用、启用、删除', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10131', 'admin', '1', 'Admin/Event/operate', '分类操作', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10132', 'admin', '1', 'Admin/Event/doMerge', '合并分类', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10133', 'admin', '1', 'Admin/Event/eventTypeTrash', '活动分类回收站', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10134', 'admin', '1', 'Admin/Event/setEventContentStatus', '设置活动状态（删除、审核）', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10135', 'admin', '1', 'Admin/Event/doRecommend', '设为推荐', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10136', 'admin', '1', 'Admin/Event/add', '编辑活动', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10137', 'admin', '2', 'Admin/Question/index', '问答', '1', '');
INSERT INTO `os_auth_rule` VALUES ('10138', 'admin', '2', 'Admin/Event/index', '活动', '1', '');

-- ----------------------------
-- Table structure for os_avatar
-- ----------------------------
DROP TABLE IF EXISTS `os_avatar`;
CREATE TABLE `os_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `path` varchar(200) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_temp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_avatar
-- ----------------------------
INSERT INTO `os_avatar` VALUES ('1', '101', '/101/580322b4e8c05.jpg', 'local', '1476600505', '1', '0');
INSERT INTO `os_avatar` VALUES ('2', '102', '/102/58034391e562e.jpg', 'local', '1476608917', '1', '0');

-- ----------------------------
-- Table structure for os_blog
-- ----------------------------
DROP TABLE IF EXISTS `os_blog`;
CREATE TABLE `os_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `category` int(11) NOT NULL COMMENT '系统分类',
  `cid` int(11) DEFAULT NULL COMMENT '作者博客分类',
  `status` tinyint(2) NOT NULL COMMENT '状态,0逻辑删除，1代表正常，2代表草稿箱，3代表逻辑删除',
  `tags` varchar(100) NOT NULL COMMENT '标签',
  `is_top` int(5) NOT NULL COMMENT '是否置顶,1代表置顶，0代表正常',
  `is_recommend` int(4) NOT NULL COMMENT '是否官网推荐,0代表正常,1代表官方推荐，2官方已经审核通过',
  `blog_type` int(1) NOT NULL COMMENT '1原创，2代表转帖',
  `view` int(10) NOT NULL COMMENT '阅读量',
  `praise` int(10) DEFAULT '0' COMMENT '赞',
  `comment` int(10) NOT NULL COMMENT '评论量',
  `collection` int(10) NOT NULL COMMENT '收藏量',
  `is_comment` varchar(255) DEFAULT NULL COMMENT '是否允许评论',
  `is_private` int(11) NOT NULL COMMENT '是否对所有人可见，1代表可见，0代表不可见',
  `origin_url` varchar(200) NOT NULL COMMENT '来源url',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `doc_parent_id` int(11) DEFAULT NULL COMMENT '专栏文章的父级id',
  `doc_project_id` int(11) DEFAULT NULL COMMENT '所属项目',
  `doc_sort` int(11) DEFAULT '0' COMMENT '排序',
  `doc_modify_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='博客';

-- ----------------------------
-- Records of os_blog
-- ----------------------------
INSERT INTO `os_blog` VALUES ('27', '101', 'vagrant virtualbox VM has become “inaccessible”解决办', '今天早晨来到公司，在启动 vagrant up 时发现，虚拟机报错，错误如下：\nBringing machine &#39;default&#39; up with &#39;virtualbox&#39; provider...\nYour VM has become &quot;inaccessible.&quot; Unfortunately, this is a critical error', '7', '23', '1', 'vagrant,virtualbox', '0', '0', '1', '25', '0', '0', '0', '1', '1', '', '1488851672', '1488855790', null, null, '0', '0');

-- ----------------------------
-- Table structure for os_blog_category
-- ----------------------------
DROP TABLE IF EXISTS `os_blog_category`;
CREATE TABLE `os_blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `can_post` tinyint(4) NOT NULL COMMENT '前台可投稿',
  `need_audit` tinyint(4) NOT NULL COMMENT '前台投稿是否需要审核',
  `sort` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='博客分类';

-- ----------------------------
-- Records of os_blog_category
-- ----------------------------
INSERT INTO `os_blog_category` VALUES ('1', '移动开发_mobile', '0', '1', '1', '1', '1');
INSERT INTO `os_blog_category` VALUES ('2', 'Web前端_web', '0', '1', '1', '2', '1');
INSERT INTO `os_blog_category` VALUES ('3', '架构设计_enterprise', '0', '1', '1', '3', '1');
INSERT INTO `os_blog_category` VALUES ('4', '编程语言_code', '0', '1', '1', '4', '1');
INSERT INTO `os_blog_category` VALUES ('5', '互联网_www', '0', '1', '1', '5', '1');
INSERT INTO `os_blog_category` VALUES ('6', '数据库_database', '0', '1', '1', '6', '1');
INSERT INTO `os_blog_category` VALUES ('7', '系统运维_system', '0', '1', '1', '7', '1');
INSERT INTO `os_blog_category` VALUES ('8', '云计算_cloud', '0', '1', '1', '8', '1');
INSERT INTO `os_blog_category` VALUES ('9', '研发管理_software', '0', '1', '1', '9', '1');
INSERT INTO `os_blog_category` VALUES ('10', '综合_other', '0', '1', '1', '10', '1');

-- ----------------------------
-- Table structure for os_blog_category_1
-- ----------------------------
DROP TABLE IF EXISTS `os_blog_category_1`;
CREATE TABLE `os_blog_category_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `can_post` tinyint(4) NOT NULL COMMENT '前台可投稿',
  `need_audit` tinyint(4) NOT NULL COMMENT '前台投稿是否需要审核',
  `sort` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='博客分类';

-- ----------------------------
-- Records of os_blog_category_1
-- ----------------------------
INSERT INTO `os_blog_category_1` VALUES ('1', '博客专栏', '0', '1', '1', '1', '1');
INSERT INTO `os_blog_category_1` VALUES ('2', '博客专家', '0', '1', '1', '2', '1');
INSERT INTO `os_blog_category_1` VALUES ('3', '排行榜', '0', '1', '1', '3', '1');
INSERT INTO `os_blog_category_1` VALUES ('4', '我的博客', '0', '1', '1', '4', '1');

-- ----------------------------
-- Table structure for os_blog_detail
-- ----------------------------
DROP TABLE IF EXISTS `os_blog_detail`;
CREATE TABLE `os_blog_detail` (
  `blog_id` int(11) NOT NULL,
  `content` longtext NOT NULL COMMENT '内容',
  `markdown_template` longtext,
  `template` varchar(50) NOT NULL COMMENT '模板',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='博客详情';

-- ----------------------------
-- Records of os_blog_detail
-- ----------------------------
INSERT INTO `os_blog_detail` VALUES ('27', '<p>今天早晨来到公司，在启动 <code>vagrant up</code> 时发现，虚拟机报错，错误如下：</p>\n<pre><code class=\"lang-bash\">Bringing machine &#39;default&#39; up with &#39;virtualbox&#39; provider...\nYour VM has become &quot;inaccessible.&quot; Unfortunately, this is a critical error\nwith VirtualBox that Vagrant can not cleanly recover from. Please open VirtualBo\nx and clear out your inaccessible virtual machines or find a way to fix them.\n</code></pre>\n<p>第一反应是：会不会版本升级导致不兼容？但是细看此报错，没有发现问题所在。于是果断问度娘。经过细查，果真有人也遇到过了，并给出了解决方案。看到解决方案后，恍然大悟。我们细看<code>vagrant</code>无法访问的提示：<code>Please open VirtualBox and clear out your inaccessible virtual machines or find a way to fix them.</code><br>于是打开<code>virtualbox</code>界面，<code>virtualbox</code>也提示该虚拟机无法启动，是因为<code>C:\\Users\\denglj\\VirtualBox VMs\\vagrant_default_1411538218356_15372\\vagrant_default_1411538218356_15372.vbox</code>文件不存在。于是进入该文件的目录，发现并没有后缀为.vbox文件，而是多了一个.vbox-tmp的文件。<br>抱着试试的想法，简单地将该文件后缀中的-tmp去掉，在执行vagrant up命令，成功了。问题得到解决</p>\n', '今天早晨来到公司，在启动 `vagrant up` 时发现，虚拟机报错，错误如下：\n```bash\nBringing machine \'default\' up with \'virtualbox\' provider...\nYour VM has become \"inaccessible.\" Unfortunately, this is a critical error\nwith VirtualBox that Vagrant can not cleanly recover from. Please open VirtualBo\nx and clear out your inaccessible virtual machines or find a way to fix them.\n```\n第一反应是：会不会版本升级导致不兼容？但是细看此报错，没有发现问题所在。于是果断问度娘。经过细查，果真有人也遇到过了，并给出了解决方案。看到解决方案后，恍然大悟。我们细看`vagrant`无法访问的提示：`Please open VirtualBox and clear out your inaccessible virtual machines or find a way to fix them.`\n于是打开`virtualbox`界面，`virtualbox`也提示该虚拟机无法启动，是因为`C:\\Users\\denglj\\VirtualBox VMs\\vagrant_default_1411538218356_15372\\vagrant_default_1411538218356_15372.vbox`文件不存在。于是进入该文件的目录，发现并没有后缀为.vbox文件，而是多了一个.vbox-tmp的文件。\n抱着试试的想法，简单地将该文件后缀中的-tmp去掉，在执行vagrant up命令，成功了。问题得到解决', '');

-- ----------------------------
-- Table structure for os_blog_document
-- ----------------------------
DROP TABLE IF EXISTS `os_blog_document`;
CREATE TABLE `os_blog_document` (
  `doc_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(200) NOT NULL COMMENT '文档名称',
  `parent_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '父ID',
  `project_id` int(11) NOT NULL COMMENT '所属项目',
  `doc_sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `doc_content` longtext COMMENT '文档内容',
  `create_time` datetime DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `modify_time` datetime DEFAULT NULL,
  `modify_at` int(11) DEFAULT NULL,
  `version` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '当前时间戳',
  PRIMARY KEY (`doc_id`),
  UNIQUE KEY `wk_document_id_uindex` (`doc_id`),
  KEY `project_id_index` (`project_id`),
  KEY `doc_sort_index` (`doc_sort`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文档表';

-- ----------------------------
-- Records of os_blog_document
-- ----------------------------
INSERT INTO `os_blog_document` VALUES ('1', '空白文档', '0', '1', '0', null, '2017-02-08 16:17:11', '1', null, null, '2017-02-08 16:17:11');

-- ----------------------------
-- Table structure for os_blog_project
-- ----------------------------
DROP TABLE IF EXISTS `os_blog_project`;
CREATE TABLE `os_blog_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `project_name` varchar(200) NOT NULL COMMENT '项目名称',
  `description` varchar(2000) DEFAULT NULL COMMENT '项目描述',
  `logo` varchar(255) DEFAULT NULL COMMENT '标题图',
  `doc_tree` text COMMENT '当前项目的文档树',
  `project_open_state` tinyint(4) DEFAULT '0' COMMENT '项目公开状态：0 私密，1 完全公开，2 加密公开',
  `project_password` varchar(255) DEFAULT NULL COMMENT '项目密码',
  `doc_count` int(11) DEFAULT '0' COMMENT '文档数据量',
  `create_time` datetime DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `modify_time` datetime DEFAULT NULL,
  `modify_at` int(11) DEFAULT NULL,
  `version` varchar(50) NOT NULL DEFAULT '0.1' COMMENT '版本号',
  `view` int(10) DEFAULT '0' COMMENT '阅读数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id_uindex` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of os_blog_project
-- ----------------------------
INSERT INTO `os_blog_project` VALUES ('3', '101', null, 'Web开发实战', '《Web开发实战》是作者的第二本技术书籍，集合了大量的前端开发案例，目前主要选择日常开发中会用到的加入本书，分为四部分：CSS实战篇、JavaScript实战篇、Canvas实战篇和移动实战篇。 每一节都会添加上详细的代码和讲解，也会针对用到的CSS属性或JavaScript方法进行简单的介绍，每一节都有相对应的Demo！ 为了苦逼的生活，望谅解本书收费！ 此书永久更新，会不断地添加新功能！ 注：如果此书缺少你所需要的，你也可以在评论区告知。', '13', null, '1', null, '11', '2017-02-14 14:15:53', '0', null, null, '0.1', null);
INSERT INTO `os_blog_project` VALUES ('4', '101', null, 'Web开发实战', '《Web开发实战》是作者的第二本技术书籍，集合了大量的前端开发案例，目前主要选择日常开发中会用到的加入本书，分为四部分：CSS实战篇、JavaScript实战篇、Canvas实战篇和移动实战篇。 每一节都会添加上详细的代码和讲解，也会针对用到的CSS属性或JavaScript方法进行简单的介绍，每一节都有相对应的Demo！ 为了苦逼的生活，望谅解本书收费！ 此书永久更新，会不断地添加新功能！ 注：如果此书缺少你所需要的，你也可以在评论区告知。', '13', '', '1', '', '11', '2017-02-14 14:15:53', '0', '2017-02-18 13:04:12', null, '0.1', '0');
INSERT INTO `os_blog_project` VALUES ('5', '101', null, 'Web开发实战', '《Web开发实战》是作者的第二本技术书籍，集合了大量的前端开发案例，目前主要选择日常开发中会用到的加入本书，分为四部分：CSS实战篇、JavaScript实战篇、Canvas实战篇和移动实战篇。 每一节都会添加上详细的代码和讲解，也会针对用到的CSS属性或JavaScript方法进行简单的介绍，每一节都有相对应的Demo！ 为了苦逼的生活，望谅解本书收费！ 此书永久更新，会不断地添加新功能！ 注：如果此书缺少你所需要的，你也可以在评论区告知。', '13', '', '1', '', '11', '2017-02-14 14:15:53', '0', '2017-02-18 13:05:40', null, '0.1', '0');
INSERT INTO `os_blog_project` VALUES ('6', '101', null, 'Web开发实战', '《Web开发实战》是作者的第二本技术书籍，集合了大量的前端开发案例，目前主要选择日常开发中会用到的加入本书，分为四部分：CSS实战篇、JavaScript实战篇、Canvas实战篇和移动实战篇。 每一节都会添加上详细的代码和讲解，也会针对用到的CSS属性或JavaScript方法进行简单的介绍，每一节都有相对应的Demo！ 为了苦逼的生活，望谅解本书收费！ 此书永久更新，会不断地添加新功能！ 注：如果此书缺少你所需要的，你也可以在评论区告知。', '13', '', '1', '', '11', '2017-02-14 14:15:53', '0', '2017-02-18 13:06:53', null, '0.1', '0');
INSERT INTO `os_blog_project` VALUES ('7', '101', null, 'Web开发实战', '《Web开发实战》是作者的第二本技术书籍，集合了大量的前端开发案例，目前主要选择日常开发中会用到的加入本书，分为四部分：CSS实战篇、JavaScript实战篇、Canvas实战篇和移动实战篇。 每一节都会添加上详细的代码和讲解，也会针对用到的CSS属性或JavaScript方法进行简单的介绍，每一节都有相对应的Demo！ 为了苦逼的生活，望谅解本书收费！ 此书永久更新，会不断地添加新功能！ 注：如果此书缺少你所需要的，你也可以在评论区告知。', '13', '', '1', '', '11', '2017-02-14 14:15:53', '0', '2017-02-18 13:07:08', null, '0.1', '0');
INSERT INTO `os_blog_project` VALUES ('8', '101', null, 'PHP编码规范（中文版）', '本文档是PHP互操作性框架制定小组（PHP-FIG :PHP Framework Interoperability Group）制定的PHP编码规范（PSR:Proposing a Standards Recommendation）中译版。', '14', null, '1', null, '0', '2017-02-21 13:00:56', '0', null, null, '0.1', '0');

-- ----------------------------
-- Table structure for os_blog_user_category
-- ----------------------------
DROP TABLE IF EXISTS `os_blog_user_category`;
CREATE TABLE `os_blog_user_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sort` tinyint(3) NOT NULL COMMENT '排序',
  `count` int(11) NOT NULL COMMENT '文章总数',
  `status` tinyint(1) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of os_blog_user_category
-- ----------------------------
INSERT INTO `os_blog_user_category` VALUES ('19', '101', 'Linux', '0', '0', '1', '1478534435');
INSERT INTO `os_blog_user_category` VALUES ('21', '101', 'PHP', '1', '0', '1', '1478534736');
INSERT INTO `os_blog_user_category` VALUES ('22', '101', '版本控制工具', '0', '0', '1', '1480589222');
INSERT INTO `os_blog_user_category` VALUES ('23', '101', 'Vagrant', '0', '1', '1', '1488850268');

-- ----------------------------
-- Table structure for os_book
-- ----------------------------
DROP TABLE IF EXISTS `os_book`;
CREATE TABLE `os_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `uid` int(11) NOT NULL,
  `keywords` varchar(100) NOT NULL COMMENT '关键词，空格分隔',
  `summary` varchar(200) NOT NULL COMMENT '简介',
  `img` int(11) NOT NULL COMMENT '封面',
  `status` tinyint(4) NOT NULL,
  `is_show` tinyint(2) NOT NULL COMMENT '0：草稿；1：发布',
  `create_time` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `see` int(11) NOT NULL COMMENT '查看量',
  `role_ids` varchar(100) NOT NULL,
  `cate_ids` varchar(100) DEFAULT NULL COMMENT '1代表入门教程，2开源教程，3精选教程',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='教程表';

-- ----------------------------
-- Records of os_book
-- ----------------------------
INSERT INTO `os_book` VALUES ('6', '微信小程序开发文档', '1', '微信，小程序', '微信小程序开发文档，主要介绍了微信小程序的开发教程，微信小程序的api文档，微信的应用号开发资料等', '24', '1', '1', '1488169081', '0', '7', '0', '', '1,2,3');
INSERT INTO `os_book` VALUES ('7', 'Laravel 5.4 中文文档', '1', 'PHP,PHP框架,Laravel', 'Laravel是一套简洁、优雅的PHP Web开发框架(PHP Web Framework)。它可以让你从面条一样杂乱的代码中解脱出来；它可以帮你构建一个完美的网络APP，而且每行代码都可以简洁、富于表达力。但是Laravel 是出了名的学习门槛高，为了新手快速入门并编写出优雅的代码，故翻译此书贡献给大家', '25', '1', '1', '1488169746', '0', '6', '0', '', null);
INSERT INTO `os_book` VALUES ('8', 'Linux教程', '1', 'Linux', 'Linux教程主要是为初学Linux的学员提供基础的入门知识，学员在学习Linux知识之前，需要对硬件知识有大概的了解，这样便于更快的理解掌握教程中的内容。', '26', '1', '1', '1488169998', '0', '10', '0', '', null);
INSERT INTO `os_book` VALUES ('9', 'ThinkPHP5.0完全开发手册', '1', 'API开发,PHP,ThinkPHP,WEB开发', 'ThinkPHP V5.0是一个为API开发而设计的高性能框架——是一个颠覆和重构版本，采用全新的架构思想，引入了很多的PHP新特性，优化了核心，减少了依赖，实现了真正的惰性加载，支持composer，并针对API开发做了大量的优化。\r\nThinkPHP5是一个全新的里程碑版本，包括路由、日志、异常、模型、数据库、模板引擎和验证等模块都已经重构，不适合原有3.2项目的升级，请慎重考虑商业项目升级，', '27', '1', '1', '1488170146', '0', '6', '0', '', null);
INSERT INTO `os_book` VALUES ('10', 'React 教程', '1', 'JavaScript,React', 'React 是一个用于构建用户界面的 JAVASCRIPT 库。 React主要用于构建UI，很人多认为 React 是 MVC 中的 V（视图）', '28', '1', '1', '1488170261', '0', '3', '0', '', null);
INSERT INTO `os_book` VALUES ('11', 'BootStrap教程', '1', 'BootStrap,Html5,CSS3', 'Bootstrap，来自 Twitter，是目前最受欢迎的前端框架。Bootstrap 是基于 HTML、CSS、JavaScript的，它在jQuery的基础上进行了更为个性化和人性化的完善，形成一套自己独有的网站风格，并兼容大部分jQuery插件。在您学习完本教程后，您即可达到使用 Bootstrap 开发 Web 项目的中等水平。', '29', '1', '1', '1488170587', '0', '1', '0', '', null);
INSERT INTO `os_book` VALUES ('12', 'MySQL教程', '1', 'mysql', 'Mysql是最流行的关系型数据库管理系统，在WEB应用方面MySQL是最好的RDBMS(Relational Database Management System：关系数据库管理系统)应用软件之一。\r\n在本教程中，会让大家快速掌握Mysql的基本知识，并轻松使用Mysql数据库。', '30', '1', '1', '1488172002', '0', '8', '0', '', null);
INSERT INTO `os_book` VALUES ('13', 'MongoDB教程', '1', 'mongodb', 'MongoDB 是一个基于分布式文件存储的数据库。由C++语言编写。旨在为WEB应用提供可扩展的高性能数据存储解决方案。\r\nMongoDB是一个介于关系数据库和非关系数据库之间的产品，是非关系数据库当中功能最丰富，最像关系数据库的。他支持的数据结构非常松散，是类似json的bson格式，因此可以存储比较复杂的数据类型。Mongo最大的特点是他支持的查询语言非常强大，其语法有点类似于面向对象的查询语', '31', '1', '1', '1488172458', '0', '9', '0', '', null);
INSERT INTO `os_book` VALUES ('14', 'Node.js教程', '1', 'nodejs', 'Node.js是一个Javascript运行环境(runtime)。实际上它是对Google V8引擎进行了封装。V8引 擎执行Javascript的速度非常快，性能非常好。Node.js对一些特殊用例进行了优化，提供了替代的API，使得V8在非浏览器环境下运行得更好。\r\nNode.js是一个基于Chrome JavaScript运行时建立的平台， 用于方便地搭建响应速度快、易于扩展的网络应用。N', '32', '1', '1', '1488172678', '0', '3', '1', '', null);

-- ----------------------------
-- Table structure for os_book_category
-- ----------------------------
DROP TABLE IF EXISTS `os_book_category`;
CREATE TABLE `os_book_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `sort` int(6) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Records of os_book_category
-- ----------------------------
INSERT INTO `os_book_category` VALUES ('1', 'HTML/CSS', '0', '1', '0');
INSERT INTO `os_book_category` VALUES ('3', 'Javascript', '0', '1', '0');
INSERT INTO `os_book_category` VALUES ('6', 'PHP', '0', '1', '0');
INSERT INTO `os_book_category` VALUES ('7', 'webApp开发', '0', '1', '0');
INSERT INTO `os_book_category` VALUES ('8', '关系型数据库', '0', '1', '0');
INSERT INTO `os_book_category` VALUES ('9', '非关系型数据库', '0', '1', '0');
INSERT INTO `os_book_category` VALUES ('10', '服务器运维', '0', '1', '0');

-- ----------------------------
-- Table structure for os_book_detail
-- ----------------------------
DROP TABLE IF EXISTS `os_book_detail`;
CREATE TABLE `os_book_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `section_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章内容表';

-- ----------------------------
-- Records of os_book_detail
-- ----------------------------

-- ----------------------------
-- Table structure for os_book_section
-- ----------------------------
DROP TABLE IF EXISTS `os_book_section`;
CREATE TABLE `os_book_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0:节；1：章',
  `summary` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_show` tinyint(2) NOT NULL COMMENT '0:草稿；1：正常',
  `create_time` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `open_child` tinyint(2) NOT NULL COMMENT '展开该章节',
  `color` varchar(20) NOT NULL COMMENT '文字颜色',
  `see` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='章节表';

-- ----------------------------
-- Records of os_book_section
-- ----------------------------
INSERT INTO `os_book_section` VALUES ('1', '章节1', '是打符号，大师傅，第三方回家', '1', '0', 'hfdjsgkj电话放假回家放得开是过客发的好几十个hi开发的事老公', '1', '1', '1438840849', '3', '0', '1', '0', '1', '', '0');
INSERT INTO `os_book_section` VALUES ('2', '章节2', '', '1', '0', '', '1', '1', '1438840849', '1', '0', '1', '0', '1', '#cc0033', '0');
INSERT INTO `os_book_section` VALUES ('3', '文章3', '', '1', '1', '', '1', '1', '1438840849', '2', '0', '1', '0', '1', '', '1');
INSERT INTO `os_book_section` VALUES ('4', '子章节1', '', '1', '0', '', '1', '1', '1438841147', '0', '0', '1', '1', '1', '', '0');
INSERT INTO `os_book_section` VALUES ('5', '子文章2', '', '1', '1', '', '1', '1', '1438841147', '0', '0', '1', '1', '1', '', '1');
INSERT INTO `os_book_section` VALUES ('6', '子章节3', '', '1', '0', '', '1', '1', '1438841147', '0', '0', '1', '1', '1', '', '1');
INSERT INTO `os_book_section` VALUES ('7', '发动机开始个', '', '1', '0', '', '1', '1', '1438841595', '0', '0', '1', '4', '0', '', '5');
INSERT INTO `os_book_section` VALUES ('8', '发多少功夫是的', '富贵花分公司地方，法的规定发生个', '1', '1', '的撒伐好激动撒放假扩大是饭店喝酒撒福克斯大家发觉好多撒放寒假快乐的撒谎覅大事飞机很快的撒开发尽快回答说发卡上的符合健康大事发大水佛挡杀佛就看到萨哈夫就看到萨哈夫可就大师傅款式大方好看啊圣诞节快发货道具卡收费空间大会尽快发货四大皆空复合接口啊速度发货爱的色放扣篮大赛好付款就爱上对话框浪费好多健身房扩大双方哈电视看发的哈就开始发打开萨哈夫健康的萨福克打算咖啡壶的撒健康防护会计师大黄蜂啊收到回复啊的撒开', '1', '1', '1438841595', '0', '0', '1', '4', '0', '', '6');
INSERT INTO `os_book_section` VALUES ('9', '佛塑股份', '', '1', '0', '', '1', '1', '1438841595', '0', '0', '1', '4', '0', '', '2');
INSERT INTO `os_book_section` VALUES ('10', '发多少功夫大广东佛山', '', '1', '0', '', '1', '1', '1438938238', '0', '0', '1', '7', '0', '', '2');
INSERT INTO `os_book_section` VALUES ('11', '放到', '', '1', '0', '', '1', '1', '1438938423', '0', '0', '1', '7', '0', '', '1');
INSERT INTO `os_book_section` VALUES ('12', '发多少功夫大事', '', '1', '0', '', '1', '1', '1438938423', '0', '0', '1', '7', '0', '', '1');
INSERT INTO `os_book_section` VALUES ('13', '风格的风格的', '', '1', '0', '', '1', '1', '1438938423', '0', '0', '1', '7', '0', '', '1');
INSERT INTO `os_book_section` VALUES ('14', '的萨芬撒', '', '1', '0', '', '-1', '1', '1438938423', '0', '0', '1', '7', '0', '', '0');
INSERT INTO `os_book_section` VALUES ('15', 'vc下班vc下地方', '', '1', '0', '', '-1', '1', '1438938437', '0', '0', '1', '7', '0', '', '0');

-- ----------------------------
-- Table structure for os_channel
-- ----------------------------
DROP TABLE IF EXISTS `os_channel`;
CREATE TABLE `os_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `color` varchar(30) NOT NULL,
  `band_color` varchar(30) NOT NULL,
  `band_text` varchar(30) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_channel
-- ----------------------------
INSERT INTO `os_channel` VALUES ('1', '0', '首页', 'Home/Index/index', '1', '0', '0', '1', '0', '#ffffff', '#000000', '', 'home');
INSERT INTO `os_channel` VALUES ('2', '0', '教程', 'Book/Index/index', '2', '0', '0', '1', '0', '#ffffff', '#000000', '', 'book');
INSERT INTO `os_channel` VALUES ('3', '0', '问答', 'Question/index/index', '3', '0', '0', '1', '0', '#ffffff', '#000000', '', 'question');
INSERT INTO `os_channel` VALUES ('4', '0', '博客', 'Blog/index/index', '4', '0', '0', '1', '0', '#ffffff', '#000000', '', 'edit');
INSERT INTO `os_channel` VALUES ('5', '0', '微博', 'Weibo/index/index', '5', '0', '0', '1', '0', '#ffffff', '#000000', '', 'comments-alt');
INSERT INTO `os_channel` VALUES ('6', '0', '资讯', 'News/index/index', '6', '0', '0', '1', '0', '#ffffff', '#000000', '', 'rss');
INSERT INTO `os_channel` VALUES ('7', '0', '活动', 'Event/index/index', '7', '0', '0', '1', '0', '#ffffff', '#000000', '', 'map-marker');

-- ----------------------------
-- Table structure for os_checkin
-- ----------------------------
DROP TABLE IF EXISTS `os_checkin`;
CREATE TABLE `os_checkin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_checkin
-- ----------------------------
INSERT INTO `os_checkin` VALUES ('1', '1', '1474205049');
INSERT INTO `os_checkin` VALUES ('2', '101', '1480519648');
INSERT INTO `os_checkin` VALUES ('3', '101', '1480555738');

-- ----------------------------
-- Table structure for os_config
-- ----------------------------
DROP TABLE IF EXISTS `os_config`;
CREATE TABLE `os_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(500) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=10269 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_config
-- ----------------------------
INSERT INTO `os_config` VALUES ('100', 'WEB_SITE_CLOSE', '4', '关闭站点', '1', '0:关闭,1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', '1378898976', '1379235296', '1', '1', '11');
INSERT INTO `os_config` VALUES ('101', 'CONFIG_TYPE_LIST', '3', '配置类型列表', '4', '', '主要用于数据解析和页面表单的生成', '1378898976', '1379235348', '1', '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举\r\n8:多选框', '8');
INSERT INTO `os_config` VALUES ('102', 'CONFIG_GROUP_LIST', '3', '配置分组', '4', '', '配置分组', '1379228036', '1384418383', '1', '1:基本\r\n2:内容\r\n3:用户\r\n4:系统\r\n5:邮件', '15');
INSERT INTO `os_config` VALUES ('103', 'HOOKS_TYPE', '3', '钩子的类型', '4', '', '类型 1-用于扩展显示内容，2-用于扩展业务处理', '1379313397', '1379313407', '1', '1:视图\r\n2:控制器', '17');
INSERT INTO `os_config` VALUES ('104', 'AUTH_CONFIG', '3', 'Auth配置', '4', '', '自定义Auth.class.php类配置', '1379409310', '1379409564', '1', 'AUTH_ON:1\r\nAUTH_TYPE:2', '20');
INSERT INTO `os_config` VALUES ('105', 'LIST_ROWS', '0', '后台每页记录数', '2', '', '后台数据每页显示记录数', '1379503896', '1380427745', '1', '10', '24');
INSERT INTO `os_config` VALUES ('107', 'CODEMIRROR_THEME', '4', '预览插件的CodeMirror主题', '4', '3024-day:3024 day\r\n3024-night:3024 night\r\nambiance:ambiance\r\nbase16-dark:base16 dark\r\nbase16-light:base16 light\r\nblackboard:blackboard\r\ncobalt:cobalt\r\neclipse:eclipse\r\nelegant:elegant\r\nerlang-dark:erlang-dark\r\nlesser-dark:lesser-dark\r\nmidnight:midnight', '详情见CodeMirror官网', '1379814385', '1384740813', '1', 'ambiance', '13');
INSERT INTO `os_config` VALUES ('108', 'DATA_BACKUP_PATH', '1', '数据库备份根路径', '4', '', '路径必须以 / 结尾', '1381482411', '1381482411', '1', './Data/Backup', '16');
INSERT INTO `os_config` VALUES ('109', 'DATA_BACKUP_PART_SIZE', '0', '数据库备份卷大小', '4', '', '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '1381482488', '1381729564', '1', '20971520', '18');
INSERT INTO `os_config` VALUES ('110', 'DATA_BACKUP_COMPRESS', '4', '数据库备份文件是否启用压缩', '4', '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1381713345', '1381729544', '1', '1', '22');
INSERT INTO `os_config` VALUES ('111', 'DATA_BACKUP_COMPRESS_LEVEL', '4', '数据库备份文件压缩级别', '4', '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '1381713408', '1381713408', '1', '9', '25');
INSERT INTO `os_config` VALUES ('112', 'DEVELOP_MODE', '4', '开启开发者模式', '4', '0:关闭\r\n1:开启', '是否开启开发者模式', '1383105995', '1383291877', '1', '1', '26');
INSERT INTO `os_config` VALUES ('113', 'ALLOW_VISIT', '3', '不受限控制器方法', '0', '', '', '1386644047', '1386644741', '1', '0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname\r\n10:file/uploadpicture', '2');
INSERT INTO `os_config` VALUES ('114', 'DENY_VISIT', '3', '超管专限控制器方法', '0', '', '仅超级管理员可访问的控制器方法', '1386644141', '1386644659', '1', '0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree', '3');
INSERT INTO `os_config` VALUES ('115', 'ADMIN_ALLOW_IP', '2', '后台允许访问IP', '4', '', '多个用逗号分隔，如果不配置表示不限制IP访问', '1387165454', '1387165553', '1', '', '27');
INSERT INTO `os_config` VALUES ('116', 'SHOW_PAGE_TRACE', '4', '是否显示页面Trace', '4', '0:关闭\r\n1:开启', '是否显示页面Trace信息', '1387165685', '1387165685', '1', '0', '7');
INSERT INTO `os_config` VALUES ('117', 'MAIL_TYPE', '4', '邮件类型', '5', '1:SMTP 模块发送\r\n2:mail() 函数发送', '如果您选择了采用服务器内置的 Mail 服务，您不需要填写下面的内容', '1388332882', '1388931416', '1', '1', '0');
INSERT INTO `os_config` VALUES ('118', 'MAIL_SMTP_HOST', '1', 'SMTP 服务器', '5', '', 'SMTP服务器', '1388332932', '1388332932', '1', '', '0');
INSERT INTO `os_config` VALUES ('119', 'MAIL_SMTP_PORT', '0', 'SMTP服务器端口', '5', '', '默认25', '1388332975', '1388332975', '1', '25', '0');
INSERT INTO `os_config` VALUES ('120', 'MAIL_SMTP_USER', '1', 'SMTP服务器用户名', '5', '', '填写完整用户名', '1388333010', '1388333010', '1', '', '0');
INSERT INTO `os_config` VALUES ('121', 'MAIL_SMTP_PASS', '6', 'SMTP服务器密码', '5', '', '填写您的密码', '1388333057', '1389187088', '1', '', '0');
INSERT INTO `os_config` VALUES ('122', 'MAIL_USER_PASS', '5', '密码找回模板', '0', '', '支持HTML代码', '1388583989', '1388672614', '1', '密码找回111223333555111', '0');
INSERT INTO `os_config` VALUES ('123', 'PIC_FILE_PATH', '1', '图片文件保存根目录', '4', '', '图片文件保存根目录./目录/', '1388673255', '1388673255', '1', './Uploads/', '0');
INSERT INTO `os_config` VALUES ('124', 'COUNT_DAY', '0', '后台首页统计用户增长天数', '0', '', '默认统计最近半个月的用户数增长情况', '1420791945', '1420876261', '1', '2', '0');
INSERT INTO `os_config` VALUES ('125', 'MAIL_USER_REG', '5', '注册邮件模板', '3', '', '支持HTML代码', '1388337307', '1389532335', '1', '<a href=\"http://www.opensns.cn\" target=\"_blank\">点击进入</a><span style=\"color:#E53333;\">当您收到这封邮件，表明您已注册成功，以上为您的用户名和密码。。。。祝您生活愉快····</span>', '55');
INSERT INTO `os_config` VALUES ('126', 'USER_NAME_BAOLIU', '1', '保留用户名和昵称', '3', '', '禁止注册用户名和昵称，包含这些即无法注册,用\" , \"号隔开，用户只能是英文，下划线_，数字等', '1388845937', '1388845937', '1', '管理员,测试,admin,垃圾', '0');
INSERT INTO `os_config` VALUES ('128', 'VERIFY_OPEN', '8', '验证码配置', '4', 'reg:注册显示\r\nlogin:登陆显示\r\nreset:密码重置', '验证码配置', '1388500332', '1405561711', '1', 'reg,reset', '0');
INSERT INTO `os_config` VALUES ('129', 'VERIFY_TYPE', '4', '验证码类型', '4', '1:中文\r\n2:英文\r\n3:数字\r\n4:英文+数字', '验证码类型', '1388500873', '1405561731', '1', '4', '0');
INSERT INTO `os_config` VALUES ('130', 'NO_BODY_TLE', '2', '空白说明', '2', '', '空白说明', '1392216444', '1392981305', '1', '呵呵，暂时没有内容哦！！', '0');
INSERT INTO `os_config` VALUES ('131', 'USER_RESPASS', '5', '密码找回模板', '3', '', '密码找回文本', '1396191234', '1396191234', '1', '<span style=\"color:#009900;\">请点击以下链接找回密码，如无反应，请将链接地址复制到浏览器中打开(下次登录前有效)</span>', '0');
INSERT INTO `os_config` VALUES ('132', 'COUNT_CODE', '2', '统计代码', '1', '', '用于统计网站访问量的第三方代码，推荐CNZZ统计', '1403058890', '1403058890', '1', '', '12');
INSERT INTO `os_config` VALUES ('134', 'URL_MODEL', '4', 'URL模式', '4', '2:REWRITE模式(开启伪静态)\r\n3:兼容模式', '选择Rewrite模式则开启伪静态，在开启伪静态之前需要先<a href=\"http://v2.opensns.cn/index.php?s=/news/index/detail/id/128.html\" target=\"_blank\">设置伪静态</a>或者阅读/Rewrite/readme.txt中的说明，默认建议开启兼容模式', '1421027546', '1421027676', '1', '2', '0');
INSERT INTO `os_config` VALUES ('135', 'DEFUALT_HOME_URL', '1', '登录前首页Url', '1', '', '支持形如weibo/index/index的ThinkPhp路由写法，支持普通的url写法，不填则显示默认聚合首页', '1417509438', '1427340006', '1', '', '1');
INSERT INTO `os_config` VALUES ('136', 'AUTO_UPDATE', '4', '自动更新提示', '1', '0:关闭,1:开启', '关闭后，后台将不显示更新提示', '1433731153', '1433731348', '1', '1', '2');
INSERT INTO `os_config` VALUES ('137', 'WEB_SITE_CLOSE_HINT', '2', '关站提示文字', '1', '', '站点关闭后的提示文字。', '1433731248', '1433731287', '1', '网站正在更新维护，请稍候再试。', '4');
INSERT INTO `os_config` VALUES ('138', 'SESSION_PREFIX', '1', '网站前台session前缀', '1', '', '当多个网站在同一个根域名下请保证每个网站的前缀不同', '1436923664', '1436923664', '1', 'phpzhidao', '20');
INSERT INTO `os_config` VALUES ('139', 'COOKIE_PREFIX', '1', '网站前台cookie前缀', '1', '', '当多个网站在同一个根域名下请保证每个网站的前缀不同', '1436923664', '1436923664', '1', 'phpzhidao_', '21');
INSERT INTO `os_config` VALUES ('140', 'MAIL_SMTP_CE', '1', '邮件发送测试', '5', '', '填写测试邮件地址', '1388334529', '1388584028', '1', '', '11');
INSERT INTO `os_config` VALUES ('10047', '_USERCONFIG_REG_SWITCH', '0', '', '0', '', '', '1476600135', '1476600135', '1', 'email', '0');
INSERT INTO `os_config` VALUES ('10228', '_CONFIG_WEB_SITE_NAME', '0', '', '0', '', '', '1480567130', '1480567130', '1', 'PHP之道', '0');
INSERT INTO `os_config` VALUES ('10229', '_CONFIG_ICP', '0', '', '0', '', '', '1480567130', '1480567130', '1', '沪ICP备12007XXX号', '0');
INSERT INTO `os_config` VALUES ('10230', '_CONFIG_LOGO', '0', '', '0', '', '', '1480567130', '1480567130', '1', '3', '0');
INSERT INTO `os_config` VALUES ('10231', '_CONFIG_QRCODE', '0', '', '0', '', '', '1480567130', '1480567130', '1', '', '0');
INSERT INTO `os_config` VALUES ('10242', '_CONFIG_ABOUT_US', '0', '', '0', '', '', '1480567131', '1480567131', '1', '<p>&nbsp; 嘉兴想天信息科技有限公司是一家专注于为客户提供专业的社交方案。公司秉持简洁、高效、创新，不断为客户创造奇迹。旗下产品有OpenSNS开源社交系统和OpenCenter开源用户和后台管理系统。</p>', '0');
INSERT INTO `os_config` VALUES ('10241', '_CONFIG_SUBSCRIB_US', '0', '', '0', '', '', '1480567131', '1480567131', '1', '<p>业务QQ：276905621</p><p>联系地址：浙江省桐乡市环城南路1号电子商务中心</p><p>联系电话：0573-88037510</p>', '0');
INSERT INTO `os_config` VALUES ('10240', '_CONFIG_COPY_RIGHT', '0', '', '0', '', '', '1480567131', '1480567131', '1', '<p>Copyright ©2013-2014 <a href=\"http://www.ourstu.com\" target=\"_blank\">嘉兴想天信息科技有限公司</a></p>', '0');
INSERT INTO `os_config` VALUES ('1008', '_HOME_LOGO', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1009', '_HOME_ENTER_URL', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('10000', '_HOME_BLOCK', '0', '', '0', '', '', '1474799712', '1474799712', '1', '[{\"data-id\":\"disable\",\"title\":\"禁用\",\"items\":[]},{\"data-id\":\"enable\",\"title\":\"启用\",\"items\":[{\"data-id\":\"slider\",\"title\":\"轮播\"},{\"data-id\":\"Weibo\",\"title\":\"微博\"},{\"data-id\":\"People\",\"title\":\"找人\"},{\"data-id\":\"Blog\",\"title\":\"博客\"},{\"data-id\":\"News\",\"title\":\"资讯\"}]}]', '0');
INSERT INTO `os_config` VALUES ('1011', '_HOME_PIC1', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1012', '_HOME_URL1', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1013', '_HOME_TITLE1', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1014', '_HOME_PIC2', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1015', '_HOME_URL2', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1016', '_HOME_TITLE2', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1017', '_HOME_PIC3', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1018', '_HOME_URL3', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('1019', '_HOME_TITLE3', '0', '', '0', '', '', '1432791820', '1432791820', '1', '', '0');
INSERT INTO `os_config` VALUES ('10048', '_USERCONFIG_EMAIL_VERIFY_TYPE', '0', '', '0', '', '', '1476600135', '1476600135', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10049', '_USERCONFIG_MOBILE_VERIFY_TYPE', '0', '', '0', '', '', '1476600135', '1476600135', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10050', '_USERCONFIG_NEW_USER_FOLLOW', '0', '', '0', '', '', '1476600135', '1476600135', '1', '', '0');
INSERT INTO `os_config` VALUES ('10051', '_USERCONFIG_NEW_USER_FANS', '0', '', '0', '', '', '1476600135', '1476600135', '1', '', '0');
INSERT INTO `os_config` VALUES ('10052', '_USERCONFIG_NEW_USER_FRIENDS', '0', '', '0', '', '', '1476600135', '1476600135', '1', '', '0');
INSERT INTO `os_config` VALUES ('10053', '_USERCONFIG_REG_STEP', '0', '', '0', '', '', '1476600135', '1476600135', '1', '[{\"data-id\":\"disable\",\"title\":\"\\u7981\\u7528\",\"items\":[]},{\"data-id\":\"enable\",\"title\":\"\\u542f\\u7528\",\"items\":[{\"data-id\":\"change_avatar\",\"title\":\"\\u4fee\\u6539\\u5934\\u50cf\"},{\"data-id\":\"set_tag\",\"title\":\"\\u9009\\u62e9\\u4e2a\\u4eba\\u6807\\u7b7e\"},{\"data-id\":\"expand_info\",\"title\":\"\\u586b\\u5199\\u6269\\u5c55\\u8d44\\u6599\"}]}]', '0');
INSERT INTO `os_config` VALUES ('10054', '_USERCONFIG_REG_CAN_SKIP', '0', '', '0', '', '', '1476600135', '1476600135', '1', '', '0');
INSERT INTO `os_config` VALUES ('10055', '_USERCONFIG_OPEN_QUICK_LOGIN', '0', '', '0', '', '', '1476600135', '1476600135', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10056', '_USERCONFIG_LOGIN_SWITCH', '0', '', '0', '', '', '1476600135', '1476600135', '1', 'username', '0');
INSERT INTO `os_config` VALUES ('10057', '_USERCONFIG_SMS_HOOK', '0', '', '0', '', '', '1476600135', '1476600135', '1', 'none', '0');
INSERT INTO `os_config` VALUES ('10058', '_USERCONFIG_SMS_RESEND', '0', '', '0', '', '', '1476600135', '1476600135', '1', '60', '0');
INSERT INTO `os_config` VALUES ('10059', '_USERCONFIG_SMS_UID', '0', '', '0', '', '', '1476600135', '1476600135', '1', '', '0');
INSERT INTO `os_config` VALUES ('10060', '_USERCONFIG_SMS_PWD', '0', '', '0', '', '', '1476600135', '1476600135', '1', '', '0');
INSERT INTO `os_config` VALUES ('10061', '_USERCONFIG_SMS_CONTENT', '0', '', '0', '', '', '1476600135', '1476600135', '1', '您的验证码为{$verify}验证码，账号为{$account}', '0');
INSERT INTO `os_config` VALUES ('10062', '_USERCONFIG_LEVEL', '0', '', '0', '', '', '1476600135', '1476600135', '1', '0:Lv1 实习\r\n50:Lv2 试用\r\n100:Lv3 转正\r\n200:Lv4 助理\r\n400:Lv5 经理\r\n800:Lv6 董事\r\n1600:Lv7 董事长', '0');
INSERT INTO `os_config` VALUES ('10063', '_USERCONFIG_NICKNAME_MIN_LENGTH', '0', '', '0', '', '', '1476600135', '1476600135', '1', '2', '0');
INSERT INTO `os_config` VALUES ('10064', '_USERCONFIG_NICKNAME_MAX_LENGTH', '0', '', '0', '', '', '1476600135', '1476600135', '1', '32', '0');
INSERT INTO `os_config` VALUES ('10065', '_USERCONFIG_USERNAME_MIN_LENGTH', '0', '', '0', '', '', '1476600135', '1476600135', '1', '2', '0');
INSERT INTO `os_config` VALUES ('10066', '_USERCONFIG_USERNAME_MAX_LENGTH', '0', '', '0', '', '', '1476600135', '1476600135', '1', '32', '0');
INSERT INTO `os_config` VALUES ('10067', '_USERCONFIG_UCENTER_KANBAN', '0', '', '0', '', '', '1476600135', '1476600135', '1', '[{\"data-id\":\"disable\",\"title\":\"\\u7981\\u7528\",\"items\":[{\"data-id\":\"News\",\"title\":\"\\u8d44\\u8baf\"},{\"data-id\":\"info\",\"title\":\"\\u8d44\\u6599\"}]},{\"data-id\":\"enable\",\"title\":\"\\u542f\\u7528\",\"items\":[{\"data-id\":\"Weibo\",\"title\":\"\\u5fae\\u535a\"},{\"data-id\":\"Blog\",\"title\":\"\\u535a\\u5ba2\"},{\"data-id\":\"follow\",\"title\":\"TA\\u7684\\u5173\\u6ce8\\/\\u7c89\\u4e1d\"},{\"data-id\":\"rank_title\",\"title\":\"\\u5934\\u8854\"}]}]', '0');
INSERT INTO `os_config` VALUES ('10232', '_CONFIG_JUMP_BACKGROUND', '0', '', '0', '', '', '1480567130', '1480567130', '1', '', '0');
INSERT INTO `os_config` VALUES ('10233', '_CONFIG_SUCCESS_WAIT_TIME', '0', '', '0', '', '', '1480567130', '1480567130', '1', '2', '0');
INSERT INTO `os_config` VALUES ('10069', '_USERCONFIG_REG_EMAIL_VERIFY', '0', '', '0', '', '', '1476600135', '1476600135', '1', '<p>您的验证码为{$verify}验证码，账号为{$account}。</p>', '0');
INSERT INTO `os_config` VALUES ('10068', '_USERCONFIG_REG_EMAIL_ACTIVATE', '0', '', '0', '', '', '1476600135', '1476600135', '1', '<p>您在{$title}的激活链接为<a href=\"{$url}\" target=\"_blank\">激活</a>，或者请复制链接：{$url}到浏览器打开。</p>', '0');
INSERT INTO `os_config` VALUES ('10234', '_CONFIG_ERROR_WAIT_TIME', '0', '', '0', '', '', '1480567130', '1480567130', '1', '5', '0');
INSERT INTO `os_config` VALUES ('10235', '_CONFIG_OPEN_IM', '0', '', '0', '', '', '1480567130', '1480567130', '1', '1', '0');
INSERT INTO `os_config` VALUES ('10236', '_CONFIG_GET_INFORMATION', '0', '', '0', '', '', '1480567130', '1480567130', '1', '1', '0');
INSERT INTO `os_config` VALUES ('10237', '_CONFIG_GET_INFORMATION_INTERNAL', '0', '', '0', '', '', '1480567130', '1480567130', '1', '60', '0');
INSERT INTO `os_config` VALUES ('10238', '_CONFIG_PICTURE_UPLOAD_DRIVER', '0', '', '0', '', '', '1480567130', '1480567130', '1', 'local', '0');
INSERT INTO `os_config` VALUES ('10239', '_CONFIG_DOWNLOAD_UPLOAD_DRIVER', '0', '', '0', '', '', '1480567130', '1480567130', '1', 'local', '0');
INSERT INTO `os_config` VALUES ('10220', '_QUESTION_QUESTION_NEED_AUDIT', '0', '', '0', '', '', '1479525435', '1479525435', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10221', '_QUESTION_QUESTION_ANSWER_MIN_NUM', '0', '', '0', '', '', '1479525435', '1479525435', '1', '20', '0');
INSERT INTO `os_config` VALUES ('10222', '_QUESTION_QUESTION_SHOW_TITLE', '0', '', '0', '', '', '1479525435', '1479525435', '1', '热门问题', '0');
INSERT INTO `os_config` VALUES ('10223', '_QUESTION_QUESTION_SHOW_COUNT', '0', '', '0', '', '', '1479525435', '1479525435', '1', '4', '0');
INSERT INTO `os_config` VALUES ('10224', '_QUESTION_QUESTION_SHOW_TYPE', '0', '', '0', '', '', '1479525435', '1479525435', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10225', '_QUESTION_QUESTION_SHOW_ORDER_FIELD', '0', '', '0', '', '', '1479525435', '1479525435', '1', 'answer_num', '0');
INSERT INTO `os_config` VALUES ('10226', '_QUESTION_QUESTION_SHOW_ORDER_TYPE', '0', '', '0', '', '', '1479525435', '1479525435', '1', 'desc', '0');
INSERT INTO `os_config` VALUES ('10227', '_QUESTION_QUESTION_SHOW_CACHE_TIME', '0', '', '0', '', '', '1479525435', '1479525435', '1', '600', '0');
INSERT INTO `os_config` VALUES ('10256', '_NEWS_NEWS_SHOW_POSITION', '0', '', '0', '', '', '1488507366', '1488507366', '1', '1:系统首页\r\n2:推荐阅读\r\n4:本类推荐', '0');
INSERT INTO `os_config` VALUES ('10257', '_NEWS_NEWS_ORDER_FIELD', '0', '', '0', '', '', '1488507366', '1488507366', '1', 'create_time', '0');
INSERT INTO `os_config` VALUES ('10258', '_NEWS_NEWS_ORDER_TYPE', '0', '', '0', '', '', '1488507366', '1488507366', '1', 'desc', '0');
INSERT INTO `os_config` VALUES ('10259', '_NEWS_NEWS_PAGE_NUM', '0', '', '0', '', '', '1488507366', '1488507366', '1', '20', '0');
INSERT INTO `os_config` VALUES ('10260', '_NEWS_NEWS_SHOW_TITLE', '0', '', '0', '', '', '1488507366', '1488507366', '1', '开发者头条', '0');
INSERT INTO `os_config` VALUES ('10261', '_NEWS_NEWS_SHOW_COUNT', '0', '', '0', '', '', '1488507366', '1488507366', '1', '4', '0');
INSERT INTO `os_config` VALUES ('10262', '_NEWS_NEWS_SHOW_TYPE', '0', '', '0', '', '', '1488507366', '1488507366', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10263', '_NEWS_NEWS_SHOW_ORDER_FIELD', '0', '', '0', '', '', '1488507366', '1488507366', '1', 'view', '0');
INSERT INTO `os_config` VALUES ('10264', '_NEWS_NEWS_SHOW_ORDER_TYPE', '0', '', '0', '', '', '1488507366', '1488507366', '1', 'desc', '0');
INSERT INTO `os_config` VALUES ('10265', '_NEWS_NEWS_SHOW_CACHE_TIME', '0', '', '0', '', '', '1488507366', '1488507366', '1', '600', '0');
INSERT INTO `os_config` VALUES ('10266', '_NEWS_INDEX_LOCAL_COMMENT_CAN_GUEST', '0', '', '0', '', '', '1488507366', '1488507366', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10267', '_NEWS_INDEX_LOCAL_COMMENT_ORDER', '0', '', '0', '', '', '1488507366', '1488507366', '1', '0', '0');
INSERT INTO `os_config` VALUES ('10268', '_NEWS_INDEX_LOCAL_COMMENT_COUNT', '0', '', '0', '', '', '1488507366', '1488507366', '1', '10', '0');

-- ----------------------------
-- Table structure for os_district
-- ----------------------------
DROP TABLE IF EXISTS `os_district`;
CREATE TABLE `os_district` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `level` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `upid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=910007 DEFAULT CHARSET=utf8 COMMENT='中国省市区乡镇数据表';

-- ----------------------------
-- Records of os_district
-- ----------------------------
INSERT INTO `os_district` VALUES ('110000', '北京市', '1', '0');
INSERT INTO `os_district` VALUES ('120000', '天津市', '1', '0');
INSERT INTO `os_district` VALUES ('130000', '河北省', '1', '0');
INSERT INTO `os_district` VALUES ('140000', '山西省', '1', '0');
INSERT INTO `os_district` VALUES ('150000', '内蒙古', '1', '0');
INSERT INTO `os_district` VALUES ('210000', '辽宁省', '1', '0');
INSERT INTO `os_district` VALUES ('220000', '吉林省', '1', '0');
INSERT INTO `os_district` VALUES ('230000', '黑龙江', '1', '0');
INSERT INTO `os_district` VALUES ('310000', '上海市', '1', '0');
INSERT INTO `os_district` VALUES ('320000', '江苏省', '1', '0');
INSERT INTO `os_district` VALUES ('330000', '浙江省', '1', '0');
INSERT INTO `os_district` VALUES ('340000', '安徽省', '1', '0');
INSERT INTO `os_district` VALUES ('350000', '福建省', '1', '0');
INSERT INTO `os_district` VALUES ('360000', '江西省', '1', '0');
INSERT INTO `os_district` VALUES ('370000', '山东省', '1', '0');
INSERT INTO `os_district` VALUES ('410000', '河南省', '1', '0');
INSERT INTO `os_district` VALUES ('420000', '湖北省', '1', '0');
INSERT INTO `os_district` VALUES ('430000', '湖南省', '1', '0');
INSERT INTO `os_district` VALUES ('440000', '广东省', '1', '0');
INSERT INTO `os_district` VALUES ('450000', '广西省', '1', '0');
INSERT INTO `os_district` VALUES ('460000', '海南省', '1', '0');
INSERT INTO `os_district` VALUES ('500000', '重庆市', '1', '0');
INSERT INTO `os_district` VALUES ('510000', '四川省', '1', '0');
INSERT INTO `os_district` VALUES ('520000', '贵州省', '1', '0');
INSERT INTO `os_district` VALUES ('530000', '云南省', '1', '0');
INSERT INTO `os_district` VALUES ('540000', '西　藏', '1', '0');
INSERT INTO `os_district` VALUES ('610000', '陕西省', '1', '0');
INSERT INTO `os_district` VALUES ('620000', '甘肃省', '1', '0');
INSERT INTO `os_district` VALUES ('630000', '青海省', '1', '0');
INSERT INTO `os_district` VALUES ('640000', '宁　夏', '1', '0');
INSERT INTO `os_district` VALUES ('650000', '新　疆', '1', '0');
INSERT INTO `os_district` VALUES ('710000', '台湾省', '1', '0');
INSERT INTO `os_district` VALUES ('810000', '香　港', '1', '0');
INSERT INTO `os_district` VALUES ('820000', '澳　门', '1', '0');
INSERT INTO `os_district` VALUES ('110100', '北京市', '2', '110000');
INSERT INTO `os_district` VALUES ('110200', '县', '2', '110000');
INSERT INTO `os_district` VALUES ('120100', '市辖区', '2', '120000');
INSERT INTO `os_district` VALUES ('120200', '县', '2', '120000');
INSERT INTO `os_district` VALUES ('130100', '石家庄市', '2', '130000');
INSERT INTO `os_district` VALUES ('130200', '唐山市', '2', '130000');
INSERT INTO `os_district` VALUES ('130300', '秦皇岛市', '2', '130000');
INSERT INTO `os_district` VALUES ('130400', '邯郸市', '2', '130000');
INSERT INTO `os_district` VALUES ('130500', '邢台市', '2', '130000');
INSERT INTO `os_district` VALUES ('130600', '保定市', '2', '130000');
INSERT INTO `os_district` VALUES ('130700', '张家口市', '2', '130000');
INSERT INTO `os_district` VALUES ('130800', '承德市', '2', '130000');
INSERT INTO `os_district` VALUES ('130900', '沧州市', '2', '130000');
INSERT INTO `os_district` VALUES ('131000', '廊坊市', '2', '130000');
INSERT INTO `os_district` VALUES ('131100', '衡水市', '2', '130000');
INSERT INTO `os_district` VALUES ('140100', '太原市', '2', '140000');
INSERT INTO `os_district` VALUES ('140200', '大同市', '2', '140000');
INSERT INTO `os_district` VALUES ('140300', '阳泉市', '2', '140000');
INSERT INTO `os_district` VALUES ('140400', '长治市', '2', '140000');
INSERT INTO `os_district` VALUES ('140500', '晋城市', '2', '140000');
INSERT INTO `os_district` VALUES ('140600', '朔州市', '2', '140000');
INSERT INTO `os_district` VALUES ('140700', '晋中市', '2', '140000');
INSERT INTO `os_district` VALUES ('140800', '运城市', '2', '140000');
INSERT INTO `os_district` VALUES ('140900', '忻州市', '2', '140000');
INSERT INTO `os_district` VALUES ('141000', '临汾市', '2', '140000');
INSERT INTO `os_district` VALUES ('141100', '吕梁市', '2', '140000');
INSERT INTO `os_district` VALUES ('150100', '呼和浩特市', '2', '150000');
INSERT INTO `os_district` VALUES ('150200', '包头市', '2', '150000');
INSERT INTO `os_district` VALUES ('150300', '乌海市', '2', '150000');
INSERT INTO `os_district` VALUES ('150400', '赤峰市', '2', '150000');
INSERT INTO `os_district` VALUES ('150500', '通辽市', '2', '150000');
INSERT INTO `os_district` VALUES ('150600', '鄂尔多斯市', '2', '150000');
INSERT INTO `os_district` VALUES ('150700', '呼伦贝尔市', '2', '150000');
INSERT INTO `os_district` VALUES ('150800', '巴彦淖尔市', '2', '150000');
INSERT INTO `os_district` VALUES ('150900', '乌兰察布市', '2', '150000');
INSERT INTO `os_district` VALUES ('152200', '兴安盟', '2', '150000');
INSERT INTO `os_district` VALUES ('152500', '锡林郭勒盟', '2', '150000');
INSERT INTO `os_district` VALUES ('152900', '阿拉善盟', '2', '150000');
INSERT INTO `os_district` VALUES ('210100', '沈阳市', '2', '210000');
INSERT INTO `os_district` VALUES ('210200', '大连市', '2', '210000');
INSERT INTO `os_district` VALUES ('210300', '鞍山市', '2', '210000');
INSERT INTO `os_district` VALUES ('210400', '抚顺市', '2', '210000');
INSERT INTO `os_district` VALUES ('210500', '本溪市', '2', '210000');
INSERT INTO `os_district` VALUES ('210600', '丹东市', '2', '210000');
INSERT INTO `os_district` VALUES ('210700', '锦州市', '2', '210000');
INSERT INTO `os_district` VALUES ('210800', '营口市', '2', '210000');
INSERT INTO `os_district` VALUES ('210900', '阜新市', '2', '210000');
INSERT INTO `os_district` VALUES ('211000', '辽阳市', '2', '210000');
INSERT INTO `os_district` VALUES ('211100', '盘锦市', '2', '210000');
INSERT INTO `os_district` VALUES ('211200', '铁岭市', '2', '210000');
INSERT INTO `os_district` VALUES ('211300', '朝阳市', '2', '210000');
INSERT INTO `os_district` VALUES ('211400', '葫芦岛市', '2', '210000');
INSERT INTO `os_district` VALUES ('220100', '长春市', '2', '220000');
INSERT INTO `os_district` VALUES ('220200', '吉林市', '2', '220000');
INSERT INTO `os_district` VALUES ('220300', '四平市', '2', '220000');
INSERT INTO `os_district` VALUES ('220400', '辽源市', '2', '220000');
INSERT INTO `os_district` VALUES ('220500', '通化市', '2', '220000');
INSERT INTO `os_district` VALUES ('220600', '白山市', '2', '220000');
INSERT INTO `os_district` VALUES ('220700', '松原市', '2', '220000');
INSERT INTO `os_district` VALUES ('220800', '白城市', '2', '220000');
INSERT INTO `os_district` VALUES ('222400', '延边朝鲜族自治州', '2', '220000');
INSERT INTO `os_district` VALUES ('230100', '哈尔滨市', '2', '230000');
INSERT INTO `os_district` VALUES ('230200', '齐齐哈尔市', '2', '230000');
INSERT INTO `os_district` VALUES ('230300', '鸡西市', '2', '230000');
INSERT INTO `os_district` VALUES ('230400', '鹤岗市', '2', '230000');
INSERT INTO `os_district` VALUES ('230500', '双鸭山市', '2', '230000');
INSERT INTO `os_district` VALUES ('230600', '大庆市', '2', '230000');
INSERT INTO `os_district` VALUES ('230700', '伊春市', '2', '230000');
INSERT INTO `os_district` VALUES ('230800', '佳木斯市', '2', '230000');
INSERT INTO `os_district` VALUES ('230900', '七台河市', '2', '230000');
INSERT INTO `os_district` VALUES ('231000', '牡丹江市', '2', '230000');
INSERT INTO `os_district` VALUES ('231100', '黑河市', '2', '230000');
INSERT INTO `os_district` VALUES ('231200', '绥化市', '2', '230000');
INSERT INTO `os_district` VALUES ('232700', '大兴安岭地区', '2', '230000');
INSERT INTO `os_district` VALUES ('310100', '市辖区', '2', '310000');
INSERT INTO `os_district` VALUES ('310200', '县', '2', '310000');
INSERT INTO `os_district` VALUES ('320100', '南京市', '2', '320000');
INSERT INTO `os_district` VALUES ('320200', '无锡市', '2', '320000');
INSERT INTO `os_district` VALUES ('320300', '徐州市', '2', '320000');
INSERT INTO `os_district` VALUES ('320400', '常州市', '2', '320000');
INSERT INTO `os_district` VALUES ('320500', '苏州市', '2', '320000');
INSERT INTO `os_district` VALUES ('320600', '南通市', '2', '320000');
INSERT INTO `os_district` VALUES ('320700', '连云港市', '2', '320000');
INSERT INTO `os_district` VALUES ('320800', '淮安市', '2', '320000');
INSERT INTO `os_district` VALUES ('320900', '盐城市', '2', '320000');
INSERT INTO `os_district` VALUES ('321000', '扬州市', '2', '320000');
INSERT INTO `os_district` VALUES ('321100', '镇江市', '2', '320000');
INSERT INTO `os_district` VALUES ('321200', '泰州市', '2', '320000');
INSERT INTO `os_district` VALUES ('321300', '宿迁市', '2', '320000');
INSERT INTO `os_district` VALUES ('330100', '杭州市', '2', '330000');
INSERT INTO `os_district` VALUES ('330200', '宁波市', '2', '330000');
INSERT INTO `os_district` VALUES ('330300', '温州市', '2', '330000');
INSERT INTO `os_district` VALUES ('330400', '嘉兴市', '2', '330000');
INSERT INTO `os_district` VALUES ('330500', '湖州市', '2', '330000');
INSERT INTO `os_district` VALUES ('330600', '绍兴市', '2', '330000');
INSERT INTO `os_district` VALUES ('330700', '金华市', '2', '330000');
INSERT INTO `os_district` VALUES ('330800', '衢州市', '2', '330000');
INSERT INTO `os_district` VALUES ('330900', '舟山市', '2', '330000');
INSERT INTO `os_district` VALUES ('331000', '台州市', '2', '330000');
INSERT INTO `os_district` VALUES ('331100', '丽水市', '2', '330000');
INSERT INTO `os_district` VALUES ('340100', '合肥市', '2', '340000');
INSERT INTO `os_district` VALUES ('340200', '芜湖市', '2', '340000');
INSERT INTO `os_district` VALUES ('340300', '蚌埠市', '2', '340000');
INSERT INTO `os_district` VALUES ('340400', '淮南市', '2', '340000');
INSERT INTO `os_district` VALUES ('340500', '马鞍山市', '2', '340000');
INSERT INTO `os_district` VALUES ('340600', '淮北市', '2', '340000');
INSERT INTO `os_district` VALUES ('340700', '铜陵市', '2', '340000');
INSERT INTO `os_district` VALUES ('340800', '安庆市', '2', '340000');
INSERT INTO `os_district` VALUES ('341000', '黄山市', '2', '340000');
INSERT INTO `os_district` VALUES ('341100', '滁州市', '2', '340000');
INSERT INTO `os_district` VALUES ('341200', '阜阳市', '2', '340000');
INSERT INTO `os_district` VALUES ('341300', '宿州市', '2', '340000');
INSERT INTO `os_district` VALUES ('341500', '六安市', '2', '340000');
INSERT INTO `os_district` VALUES ('341600', '亳州市', '2', '340000');
INSERT INTO `os_district` VALUES ('341700', '池州市', '2', '340000');
INSERT INTO `os_district` VALUES ('341800', '宣城市', '2', '340000');
INSERT INTO `os_district` VALUES ('350100', '福州市', '2', '350000');
INSERT INTO `os_district` VALUES ('350200', '厦门市', '2', '350000');
INSERT INTO `os_district` VALUES ('350300', '莆田市', '2', '350000');
INSERT INTO `os_district` VALUES ('350400', '三明市', '2', '350000');
INSERT INTO `os_district` VALUES ('350500', '泉州市', '2', '350000');
INSERT INTO `os_district` VALUES ('350600', '漳州市', '2', '350000');
INSERT INTO `os_district` VALUES ('350700', '南平市', '2', '350000');
INSERT INTO `os_district` VALUES ('350800', '龙岩市', '2', '350000');
INSERT INTO `os_district` VALUES ('350900', '宁德市', '2', '350000');
INSERT INTO `os_district` VALUES ('360100', '南昌市', '2', '360000');
INSERT INTO `os_district` VALUES ('360200', '景德镇市', '2', '360000');
INSERT INTO `os_district` VALUES ('360300', '萍乡市', '2', '360000');
INSERT INTO `os_district` VALUES ('360400', '九江市', '2', '360000');
INSERT INTO `os_district` VALUES ('360500', '新余市', '2', '360000');
INSERT INTO `os_district` VALUES ('360600', '鹰潭市', '2', '360000');
INSERT INTO `os_district` VALUES ('360700', '赣州市', '2', '360000');
INSERT INTO `os_district` VALUES ('360800', '吉安市', '2', '360000');
INSERT INTO `os_district` VALUES ('360900', '宜春市', '2', '360000');
INSERT INTO `os_district` VALUES ('361000', '抚州市', '2', '360000');
INSERT INTO `os_district` VALUES ('361100', '上饶市', '2', '360000');
INSERT INTO `os_district` VALUES ('370100', '济南市', '2', '370000');
INSERT INTO `os_district` VALUES ('370200', '青岛市', '2', '370000');
INSERT INTO `os_district` VALUES ('370300', '淄博市', '2', '370000');
INSERT INTO `os_district` VALUES ('370400', '枣庄市', '2', '370000');
INSERT INTO `os_district` VALUES ('370500', '东营市', '2', '370000');
INSERT INTO `os_district` VALUES ('370600', '烟台市', '2', '370000');
INSERT INTO `os_district` VALUES ('370700', '潍坊市', '2', '370000');
INSERT INTO `os_district` VALUES ('370800', '济宁市', '2', '370000');
INSERT INTO `os_district` VALUES ('370900', '泰安市', '2', '370000');
INSERT INTO `os_district` VALUES ('371000', '威海市', '2', '370000');
INSERT INTO `os_district` VALUES ('371100', '日照市', '2', '370000');
INSERT INTO `os_district` VALUES ('371200', '莱芜市', '2', '370000');
INSERT INTO `os_district` VALUES ('371300', '临沂市', '2', '370000');
INSERT INTO `os_district` VALUES ('371400', '德州市', '2', '370000');
INSERT INTO `os_district` VALUES ('371500', '聊城市', '2', '370000');
INSERT INTO `os_district` VALUES ('371600', '滨州市', '2', '370000');
INSERT INTO `os_district` VALUES ('371700', '菏泽市', '2', '370000');
INSERT INTO `os_district` VALUES ('410100', '郑州市', '2', '410000');
INSERT INTO `os_district` VALUES ('410200', '开封市', '2', '410000');
INSERT INTO `os_district` VALUES ('410300', '洛阳市', '2', '410000');
INSERT INTO `os_district` VALUES ('410400', '平顶山市', '2', '410000');
INSERT INTO `os_district` VALUES ('410500', '安阳市', '2', '410000');
INSERT INTO `os_district` VALUES ('410600', '鹤壁市', '2', '410000');
INSERT INTO `os_district` VALUES ('410700', '新乡市', '2', '410000');
INSERT INTO `os_district` VALUES ('410800', '焦作市', '2', '410000');
INSERT INTO `os_district` VALUES ('410900', '濮阳市', '2', '410000');
INSERT INTO `os_district` VALUES ('411000', '许昌市', '2', '410000');
INSERT INTO `os_district` VALUES ('411100', '漯河市', '2', '410000');
INSERT INTO `os_district` VALUES ('411200', '三门峡市', '2', '410000');
INSERT INTO `os_district` VALUES ('411300', '南阳市', '2', '410000');
INSERT INTO `os_district` VALUES ('411400', '商丘市', '2', '410000');
INSERT INTO `os_district` VALUES ('411500', '信阳市', '2', '410000');
INSERT INTO `os_district` VALUES ('411600', '周口市', '2', '410000');
INSERT INTO `os_district` VALUES ('411700', '驻马店市', '2', '410000');
INSERT INTO `os_district` VALUES ('420100', '武汉市', '2', '420000');
INSERT INTO `os_district` VALUES ('420200', '黄石市', '2', '420000');
INSERT INTO `os_district` VALUES ('420300', '十堰市', '2', '420000');
INSERT INTO `os_district` VALUES ('420500', '宜昌市', '2', '420000');
INSERT INTO `os_district` VALUES ('420600', '襄樊市', '2', '420000');
INSERT INTO `os_district` VALUES ('420700', '鄂州市', '2', '420000');
INSERT INTO `os_district` VALUES ('420800', '荆门市', '2', '420000');
INSERT INTO `os_district` VALUES ('420900', '孝感市', '2', '420000');
INSERT INTO `os_district` VALUES ('421000', '荆州市', '2', '420000');
INSERT INTO `os_district` VALUES ('421100', '黄冈市', '2', '420000');
INSERT INTO `os_district` VALUES ('421200', '咸宁市', '2', '420000');
INSERT INTO `os_district` VALUES ('421300', '随州市', '2', '420000');
INSERT INTO `os_district` VALUES ('422800', '恩施土家族苗族自治州', '2', '420000');
INSERT INTO `os_district` VALUES ('429000', '省直辖行政单位', '2', '420000');
INSERT INTO `os_district` VALUES ('430100', '长沙市', '2', '430000');
INSERT INTO `os_district` VALUES ('430200', '株洲市', '2', '430000');
INSERT INTO `os_district` VALUES ('430300', '湘潭市', '2', '430000');
INSERT INTO `os_district` VALUES ('430400', '衡阳市', '2', '430000');
INSERT INTO `os_district` VALUES ('430500', '邵阳市', '2', '430000');
INSERT INTO `os_district` VALUES ('430600', '岳阳市', '2', '430000');
INSERT INTO `os_district` VALUES ('430700', '常德市', '2', '430000');
INSERT INTO `os_district` VALUES ('430800', '张家界市', '2', '430000');
INSERT INTO `os_district` VALUES ('430900', '益阳市', '2', '430000');
INSERT INTO `os_district` VALUES ('431000', '郴州市', '2', '430000');
INSERT INTO `os_district` VALUES ('431100', '永州市', '2', '430000');
INSERT INTO `os_district` VALUES ('431200', '怀化市', '2', '430000');
INSERT INTO `os_district` VALUES ('431300', '娄底市', '2', '430000');
INSERT INTO `os_district` VALUES ('433100', '湘西土家族苗族自治州', '2', '430000');
INSERT INTO `os_district` VALUES ('440100', '广州市', '2', '440000');
INSERT INTO `os_district` VALUES ('440200', '韶关市', '2', '440000');
INSERT INTO `os_district` VALUES ('440300', '深圳市', '2', '440000');
INSERT INTO `os_district` VALUES ('440400', '珠海市', '2', '440000');
INSERT INTO `os_district` VALUES ('440500', '汕头市', '2', '440000');
INSERT INTO `os_district` VALUES ('440600', '佛山市', '2', '440000');
INSERT INTO `os_district` VALUES ('440700', '江门市', '2', '440000');
INSERT INTO `os_district` VALUES ('440800', '湛江市', '2', '440000');
INSERT INTO `os_district` VALUES ('440900', '茂名市', '2', '440000');
INSERT INTO `os_district` VALUES ('441200', '肇庆市', '2', '440000');
INSERT INTO `os_district` VALUES ('441300', '惠州市', '2', '440000');
INSERT INTO `os_district` VALUES ('441400', '梅州市', '2', '440000');
INSERT INTO `os_district` VALUES ('441500', '汕尾市', '2', '440000');
INSERT INTO `os_district` VALUES ('441600', '河源市', '2', '440000');
INSERT INTO `os_district` VALUES ('441700', '阳江市', '2', '440000');
INSERT INTO `os_district` VALUES ('441800', '清远市', '2', '440000');
INSERT INTO `os_district` VALUES ('441900', '东莞市', '2', '440000');
INSERT INTO `os_district` VALUES ('442000', '中山市', '2', '440000');
INSERT INTO `os_district` VALUES ('445100', '潮州市', '2', '440000');
INSERT INTO `os_district` VALUES ('445200', '揭阳市', '2', '440000');
INSERT INTO `os_district` VALUES ('445300', '云浮市', '2', '440000');
INSERT INTO `os_district` VALUES ('450100', '南宁市', '2', '450000');
INSERT INTO `os_district` VALUES ('450200', '柳州市', '2', '450000');
INSERT INTO `os_district` VALUES ('450300', '桂林市', '2', '450000');
INSERT INTO `os_district` VALUES ('450400', '梧州市', '2', '450000');
INSERT INTO `os_district` VALUES ('450500', '北海市', '2', '450000');
INSERT INTO `os_district` VALUES ('450600', '防城港市', '2', '450000');
INSERT INTO `os_district` VALUES ('450700', '钦州市', '2', '450000');
INSERT INTO `os_district` VALUES ('450800', '贵港市', '2', '450000');
INSERT INTO `os_district` VALUES ('450900', '玉林市', '2', '450000');
INSERT INTO `os_district` VALUES ('451000', '百色市', '2', '450000');
INSERT INTO `os_district` VALUES ('451100', '贺州市', '2', '450000');
INSERT INTO `os_district` VALUES ('451200', '河池市', '2', '450000');
INSERT INTO `os_district` VALUES ('451300', '来宾市', '2', '450000');
INSERT INTO `os_district` VALUES ('451400', '崇左市', '2', '450000');
INSERT INTO `os_district` VALUES ('460100', '海口市', '2', '460000');
INSERT INTO `os_district` VALUES ('460200', '三亚市', '2', '460000');
INSERT INTO `os_district` VALUES ('469000', '省直辖县级行政单位', '2', '460000');
INSERT INTO `os_district` VALUES ('500100', '市辖区', '2', '500000');
INSERT INTO `os_district` VALUES ('500200', '县', '2', '500000');
INSERT INTO `os_district` VALUES ('500300', '市', '2', '500000');
INSERT INTO `os_district` VALUES ('510100', '成都市', '2', '510000');
INSERT INTO `os_district` VALUES ('510300', '自贡市', '2', '510000');
INSERT INTO `os_district` VALUES ('510400', '攀枝花市', '2', '510000');
INSERT INTO `os_district` VALUES ('510500', '泸州市', '2', '510000');
INSERT INTO `os_district` VALUES ('510600', '德阳市', '2', '510000');
INSERT INTO `os_district` VALUES ('510700', '绵阳市', '2', '510000');
INSERT INTO `os_district` VALUES ('510800', '广元市', '2', '510000');
INSERT INTO `os_district` VALUES ('510900', '遂宁市', '2', '510000');
INSERT INTO `os_district` VALUES ('511000', '内江市', '2', '510000');
INSERT INTO `os_district` VALUES ('511100', '乐山市', '2', '510000');
INSERT INTO `os_district` VALUES ('511300', '南充市', '2', '510000');
INSERT INTO `os_district` VALUES ('511400', '眉山市', '2', '510000');
INSERT INTO `os_district` VALUES ('511500', '宜宾市', '2', '510000');
INSERT INTO `os_district` VALUES ('511600', '广安市', '2', '510000');
INSERT INTO `os_district` VALUES ('511700', '达州市', '2', '510000');
INSERT INTO `os_district` VALUES ('511800', '雅安市', '2', '510000');
INSERT INTO `os_district` VALUES ('511900', '巴中市', '2', '510000');
INSERT INTO `os_district` VALUES ('512000', '资阳市', '2', '510000');
INSERT INTO `os_district` VALUES ('513200', '阿坝藏族羌族自治州', '2', '510000');
INSERT INTO `os_district` VALUES ('513300', '甘孜藏族自治州', '2', '510000');
INSERT INTO `os_district` VALUES ('513400', '凉山彝族自治州', '2', '510000');
INSERT INTO `os_district` VALUES ('520100', '贵阳市', '2', '520000');
INSERT INTO `os_district` VALUES ('520200', '六盘水市', '2', '520000');
INSERT INTO `os_district` VALUES ('520300', '遵义市', '2', '520000');
INSERT INTO `os_district` VALUES ('520400', '安顺市', '2', '520000');
INSERT INTO `os_district` VALUES ('522200', '铜仁地区', '2', '520000');
INSERT INTO `os_district` VALUES ('522300', '黔西南布依族苗族自治州', '2', '520000');
INSERT INTO `os_district` VALUES ('522400', '毕节地区', '2', '520000');
INSERT INTO `os_district` VALUES ('522600', '黔东南苗族侗族自治州', '2', '520000');
INSERT INTO `os_district` VALUES ('522700', '黔南布依族苗族自治州', '2', '520000');
INSERT INTO `os_district` VALUES ('530100', '昆明市', '2', '530000');
INSERT INTO `os_district` VALUES ('530300', '曲靖市', '2', '530000');
INSERT INTO `os_district` VALUES ('530400', '玉溪市', '2', '530000');
INSERT INTO `os_district` VALUES ('530500', '保山市', '2', '530000');
INSERT INTO `os_district` VALUES ('530600', '昭通市', '2', '530000');
INSERT INTO `os_district` VALUES ('530700', '丽江市', '2', '530000');
INSERT INTO `os_district` VALUES ('530800', '思茅市', '2', '530000');
INSERT INTO `os_district` VALUES ('530900', '临沧市', '2', '530000');
INSERT INTO `os_district` VALUES ('532300', '楚雄彝族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('532500', '红河哈尼族彝族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('532600', '文山壮族苗族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('532800', '西双版纳傣族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('532900', '大理白族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('533100', '德宏傣族景颇族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('533300', '怒江傈僳族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('533400', '迪庆藏族自治州', '2', '530000');
INSERT INTO `os_district` VALUES ('540100', '拉萨市', '2', '540000');
INSERT INTO `os_district` VALUES ('542100', '昌都地区', '2', '540000');
INSERT INTO `os_district` VALUES ('542200', '山南地区', '2', '540000');
INSERT INTO `os_district` VALUES ('542300', '日喀则地区', '2', '540000');
INSERT INTO `os_district` VALUES ('542400', '那曲地区', '2', '540000');
INSERT INTO `os_district` VALUES ('542500', '阿里地区', '2', '540000');
INSERT INTO `os_district` VALUES ('542600', '林芝地区', '2', '540000');
INSERT INTO `os_district` VALUES ('610100', '西安市', '2', '610000');
INSERT INTO `os_district` VALUES ('610200', '铜川市', '2', '610000');
INSERT INTO `os_district` VALUES ('610300', '宝鸡市', '2', '610000');
INSERT INTO `os_district` VALUES ('610400', '咸阳市', '2', '610000');
INSERT INTO `os_district` VALUES ('610500', '渭南市', '2', '610000');
INSERT INTO `os_district` VALUES ('610600', '延安市', '2', '610000');
INSERT INTO `os_district` VALUES ('610700', '汉中市', '2', '610000');
INSERT INTO `os_district` VALUES ('610800', '榆林市', '2', '610000');
INSERT INTO `os_district` VALUES ('610900', '安康市', '2', '610000');
INSERT INTO `os_district` VALUES ('611000', '商洛市', '2', '610000');
INSERT INTO `os_district` VALUES ('620100', '兰州市', '2', '620000');
INSERT INTO `os_district` VALUES ('620200', '嘉峪关市', '2', '620000');
INSERT INTO `os_district` VALUES ('620300', '金昌市', '2', '620000');
INSERT INTO `os_district` VALUES ('620400', '白银市', '2', '620000');
INSERT INTO `os_district` VALUES ('620500', '天水市', '2', '620000');
INSERT INTO `os_district` VALUES ('620600', '武威市', '2', '620000');
INSERT INTO `os_district` VALUES ('620700', '张掖市', '2', '620000');
INSERT INTO `os_district` VALUES ('620800', '平凉市', '2', '620000');
INSERT INTO `os_district` VALUES ('620900', '酒泉市', '2', '620000');
INSERT INTO `os_district` VALUES ('621000', '庆阳市', '2', '620000');
INSERT INTO `os_district` VALUES ('621100', '定西市', '2', '620000');
INSERT INTO `os_district` VALUES ('621200', '陇南市', '2', '620000');
INSERT INTO `os_district` VALUES ('622900', '临夏回族自治州', '2', '620000');
INSERT INTO `os_district` VALUES ('623000', '甘南藏族自治州', '2', '620000');
INSERT INTO `os_district` VALUES ('630100', '西宁市', '2', '630000');
INSERT INTO `os_district` VALUES ('632100', '海东地区', '2', '630000');
INSERT INTO `os_district` VALUES ('632200', '海北藏族自治州', '2', '630000');
INSERT INTO `os_district` VALUES ('632300', '黄南藏族自治州', '2', '630000');
INSERT INTO `os_district` VALUES ('632500', '海南藏族自治州', '2', '630000');
INSERT INTO `os_district` VALUES ('632600', '果洛藏族自治州', '2', '630000');
INSERT INTO `os_district` VALUES ('632700', '玉树藏族自治州', '2', '630000');
INSERT INTO `os_district` VALUES ('632800', '海西蒙古族藏族自治州', '2', '630000');
INSERT INTO `os_district` VALUES ('640100', '银川市', '2', '640000');
INSERT INTO `os_district` VALUES ('640200', '石嘴山市', '2', '640000');
INSERT INTO `os_district` VALUES ('640300', '吴忠市', '2', '640000');
INSERT INTO `os_district` VALUES ('640400', '固原市', '2', '640000');
INSERT INTO `os_district` VALUES ('640500', '中卫市', '2', '640000');
INSERT INTO `os_district` VALUES ('650100', '乌鲁木齐市', '2', '650000');
INSERT INTO `os_district` VALUES ('650200', '克拉玛依市', '2', '650000');
INSERT INTO `os_district` VALUES ('652100', '吐鲁番地区', '2', '650000');
INSERT INTO `os_district` VALUES ('652200', '哈密地区', '2', '650000');
INSERT INTO `os_district` VALUES ('652300', '昌吉回族自治州', '2', '650000');
INSERT INTO `os_district` VALUES ('652700', '博尔塔拉蒙古自治州', '2', '650000');
INSERT INTO `os_district` VALUES ('652800', '巴音郭楞蒙古自治州', '2', '650000');
INSERT INTO `os_district` VALUES ('652900', '阿克苏地区', '2', '650000');
INSERT INTO `os_district` VALUES ('653000', '克孜勒苏柯尔克孜自治州', '2', '650000');
INSERT INTO `os_district` VALUES ('653100', '喀什地区', '2', '650000');
INSERT INTO `os_district` VALUES ('653200', '和田地区', '2', '650000');
INSERT INTO `os_district` VALUES ('654000', '伊犁哈萨克自治州', '2', '650000');
INSERT INTO `os_district` VALUES ('654200', '塔城地区', '2', '650000');
INSERT INTO `os_district` VALUES ('654300', '阿勒泰地区', '2', '650000');
INSERT INTO `os_district` VALUES ('659000', '省直辖行政单位', '2', '650000');
INSERT INTO `os_district` VALUES ('110101', '东城区', '3', '110100');
INSERT INTO `os_district` VALUES ('110102', '西城区', '3', '110100');
INSERT INTO `os_district` VALUES ('110103', '崇文区', '3', '110100');
INSERT INTO `os_district` VALUES ('110104', '宣武区', '3', '110100');
INSERT INTO `os_district` VALUES ('110105', '朝阳区', '3', '110100');
INSERT INTO `os_district` VALUES ('110106', '丰台区', '3', '110100');
INSERT INTO `os_district` VALUES ('110107', '石景山区', '3', '110100');
INSERT INTO `os_district` VALUES ('110108', '海淀区', '3', '110100');
INSERT INTO `os_district` VALUES ('110109', '门头沟区', '3', '110100');
INSERT INTO `os_district` VALUES ('110111', '房山区', '3', '110100');
INSERT INTO `os_district` VALUES ('110112', '通州区', '3', '110100');
INSERT INTO `os_district` VALUES ('110113', '顺义区', '3', '110100');
INSERT INTO `os_district` VALUES ('110114', '昌平区', '3', '110100');
INSERT INTO `os_district` VALUES ('110115', '大兴区', '3', '110100');
INSERT INTO `os_district` VALUES ('110116', '怀柔区', '3', '110100');
INSERT INTO `os_district` VALUES ('110117', '平谷区', '3', '110100');
INSERT INTO `os_district` VALUES ('110228', '密云县', '3', '110200');
INSERT INTO `os_district` VALUES ('110229', '延庆县', '3', '110200');
INSERT INTO `os_district` VALUES ('120101', '和平区', '3', '120100');
INSERT INTO `os_district` VALUES ('120102', '河东区', '3', '120100');
INSERT INTO `os_district` VALUES ('120103', '河西区', '3', '120100');
INSERT INTO `os_district` VALUES ('120104', '南开区', '3', '120100');
INSERT INTO `os_district` VALUES ('120105', '河北区', '3', '120100');
INSERT INTO `os_district` VALUES ('120106', '红桥区', '3', '120100');
INSERT INTO `os_district` VALUES ('120107', '塘沽区', '3', '120100');
INSERT INTO `os_district` VALUES ('120108', '汉沽区', '3', '120100');
INSERT INTO `os_district` VALUES ('120109', '大港区', '3', '120100');
INSERT INTO `os_district` VALUES ('120110', '东丽区', '3', '120100');
INSERT INTO `os_district` VALUES ('120111', '西青区', '3', '120100');
INSERT INTO `os_district` VALUES ('120112', '津南区', '3', '120100');
INSERT INTO `os_district` VALUES ('120113', '北辰区', '3', '120100');
INSERT INTO `os_district` VALUES ('120114', '武清区', '3', '120100');
INSERT INTO `os_district` VALUES ('120115', '宝坻区', '3', '120100');
INSERT INTO `os_district` VALUES ('120221', '宁河县', '3', '120200');
INSERT INTO `os_district` VALUES ('120223', '静海县', '3', '120200');
INSERT INTO `os_district` VALUES ('120225', '蓟　县', '3', '120200');
INSERT INTO `os_district` VALUES ('130101', '市辖区', '3', '130100');
INSERT INTO `os_district` VALUES ('130102', '长安区', '3', '130100');
INSERT INTO `os_district` VALUES ('130103', '桥东区', '3', '130100');
INSERT INTO `os_district` VALUES ('130104', '桥西区', '3', '130100');
INSERT INTO `os_district` VALUES ('130105', '新华区', '3', '130100');
INSERT INTO `os_district` VALUES ('130107', '井陉矿区', '3', '130100');
INSERT INTO `os_district` VALUES ('130108', '裕华区', '3', '130100');
INSERT INTO `os_district` VALUES ('130121', '井陉县', '3', '130100');
INSERT INTO `os_district` VALUES ('130123', '正定县', '3', '130100');
INSERT INTO `os_district` VALUES ('130124', '栾城县', '3', '130100');
INSERT INTO `os_district` VALUES ('130125', '行唐县', '3', '130100');
INSERT INTO `os_district` VALUES ('130126', '灵寿县', '3', '130100');
INSERT INTO `os_district` VALUES ('130127', '高邑县', '3', '130100');
INSERT INTO `os_district` VALUES ('130128', '深泽县', '3', '130100');
INSERT INTO `os_district` VALUES ('130129', '赞皇县', '3', '130100');
INSERT INTO `os_district` VALUES ('130130', '无极县', '3', '130100');
INSERT INTO `os_district` VALUES ('130131', '平山县', '3', '130100');
INSERT INTO `os_district` VALUES ('130132', '元氏县', '3', '130100');
INSERT INTO `os_district` VALUES ('130133', '赵　县', '3', '130100');
INSERT INTO `os_district` VALUES ('130181', '辛集市', '3', '130100');
INSERT INTO `os_district` VALUES ('130182', '藁城市', '3', '130100');
INSERT INTO `os_district` VALUES ('130183', '晋州市', '3', '130100');
INSERT INTO `os_district` VALUES ('130184', '新乐市', '3', '130100');
INSERT INTO `os_district` VALUES ('130185', '鹿泉市', '3', '130100');
INSERT INTO `os_district` VALUES ('130201', '市辖区', '3', '130200');
INSERT INTO `os_district` VALUES ('130202', '路南区', '3', '130200');
INSERT INTO `os_district` VALUES ('130203', '路北区', '3', '130200');
INSERT INTO `os_district` VALUES ('130204', '古冶区', '3', '130200');
INSERT INTO `os_district` VALUES ('130205', '开平区', '3', '130200');
INSERT INTO `os_district` VALUES ('130207', '丰南区', '3', '130200');
INSERT INTO `os_district` VALUES ('130208', '丰润区', '3', '130200');
INSERT INTO `os_district` VALUES ('130223', '滦　县', '3', '130200');
INSERT INTO `os_district` VALUES ('130224', '滦南县', '3', '130200');
INSERT INTO `os_district` VALUES ('130225', '乐亭县', '3', '130200');
INSERT INTO `os_district` VALUES ('130227', '迁西县', '3', '130200');
INSERT INTO `os_district` VALUES ('130229', '玉田县', '3', '130200');
INSERT INTO `os_district` VALUES ('130230', '唐海县', '3', '130200');
INSERT INTO `os_district` VALUES ('130281', '遵化市', '3', '130200');
INSERT INTO `os_district` VALUES ('130283', '迁安市', '3', '130200');
INSERT INTO `os_district` VALUES ('130301', '市辖区', '3', '130300');
INSERT INTO `os_district` VALUES ('130302', '海港区', '3', '130300');
INSERT INTO `os_district` VALUES ('130303', '山海关区', '3', '130300');
INSERT INTO `os_district` VALUES ('130304', '北戴河区', '3', '130300');
INSERT INTO `os_district` VALUES ('130321', '青龙满族自治县', '3', '130300');
INSERT INTO `os_district` VALUES ('130322', '昌黎县', '3', '130300');
INSERT INTO `os_district` VALUES ('130323', '抚宁县', '3', '130300');
INSERT INTO `os_district` VALUES ('130324', '卢龙县', '3', '130300');
INSERT INTO `os_district` VALUES ('130401', '市辖区', '3', '130400');
INSERT INTO `os_district` VALUES ('130402', '邯山区', '3', '130400');
INSERT INTO `os_district` VALUES ('130403', '丛台区', '3', '130400');
INSERT INTO `os_district` VALUES ('130404', '复兴区', '3', '130400');
INSERT INTO `os_district` VALUES ('130406', '峰峰矿区', '3', '130400');
INSERT INTO `os_district` VALUES ('130421', '邯郸县', '3', '130400');
INSERT INTO `os_district` VALUES ('130423', '临漳县', '3', '130400');
INSERT INTO `os_district` VALUES ('130424', '成安县', '3', '130400');
INSERT INTO `os_district` VALUES ('130425', '大名县', '3', '130400');
INSERT INTO `os_district` VALUES ('130426', '涉　县', '3', '130400');
INSERT INTO `os_district` VALUES ('130427', '磁　县', '3', '130400');
INSERT INTO `os_district` VALUES ('130428', '肥乡县', '3', '130400');
INSERT INTO `os_district` VALUES ('130429', '永年县', '3', '130400');
INSERT INTO `os_district` VALUES ('130430', '邱　县', '3', '130400');
INSERT INTO `os_district` VALUES ('130431', '鸡泽县', '3', '130400');
INSERT INTO `os_district` VALUES ('130432', '广平县', '3', '130400');
INSERT INTO `os_district` VALUES ('130433', '馆陶县', '3', '130400');
INSERT INTO `os_district` VALUES ('130434', '魏　县', '3', '130400');
INSERT INTO `os_district` VALUES ('130435', '曲周县', '3', '130400');
INSERT INTO `os_district` VALUES ('130481', '武安市', '3', '130400');
INSERT INTO `os_district` VALUES ('130501', '市辖区', '3', '130500');
INSERT INTO `os_district` VALUES ('130502', '桥东区', '3', '130500');
INSERT INTO `os_district` VALUES ('130503', '桥西区', '3', '130500');
INSERT INTO `os_district` VALUES ('130521', '邢台县', '3', '130500');
INSERT INTO `os_district` VALUES ('130522', '临城县', '3', '130500');
INSERT INTO `os_district` VALUES ('130523', '内丘县', '3', '130500');
INSERT INTO `os_district` VALUES ('130524', '柏乡县', '3', '130500');
INSERT INTO `os_district` VALUES ('130525', '隆尧县', '3', '130500');
INSERT INTO `os_district` VALUES ('130526', '任　县', '3', '130500');
INSERT INTO `os_district` VALUES ('130527', '南和县', '3', '130500');
INSERT INTO `os_district` VALUES ('130528', '宁晋县', '3', '130500');
INSERT INTO `os_district` VALUES ('130529', '巨鹿县', '3', '130500');
INSERT INTO `os_district` VALUES ('130530', '新河县', '3', '130500');
INSERT INTO `os_district` VALUES ('130531', '广宗县', '3', '130500');
INSERT INTO `os_district` VALUES ('130532', '平乡县', '3', '130500');
INSERT INTO `os_district` VALUES ('130533', '威　县', '3', '130500');
INSERT INTO `os_district` VALUES ('130534', '清河县', '3', '130500');
INSERT INTO `os_district` VALUES ('130535', '临西县', '3', '130500');
INSERT INTO `os_district` VALUES ('130581', '南宫市', '3', '130500');
INSERT INTO `os_district` VALUES ('130582', '沙河市', '3', '130500');
INSERT INTO `os_district` VALUES ('130601', '市辖区', '3', '130600');
INSERT INTO `os_district` VALUES ('130602', '新市区', '3', '130600');
INSERT INTO `os_district` VALUES ('130603', '北市区', '3', '130600');
INSERT INTO `os_district` VALUES ('130604', '南市区', '3', '130600');
INSERT INTO `os_district` VALUES ('130621', '满城县', '3', '130600');
INSERT INTO `os_district` VALUES ('130622', '清苑县', '3', '130600');
INSERT INTO `os_district` VALUES ('130623', '涞水县', '3', '130600');
INSERT INTO `os_district` VALUES ('130624', '阜平县', '3', '130600');
INSERT INTO `os_district` VALUES ('130625', '徐水县', '3', '130600');
INSERT INTO `os_district` VALUES ('130626', '定兴县', '3', '130600');
INSERT INTO `os_district` VALUES ('130627', '唐　县', '3', '130600');
INSERT INTO `os_district` VALUES ('130628', '高阳县', '3', '130600');
INSERT INTO `os_district` VALUES ('130629', '容城县', '3', '130600');
INSERT INTO `os_district` VALUES ('130630', '涞源县', '3', '130600');
INSERT INTO `os_district` VALUES ('130631', '望都县', '3', '130600');
INSERT INTO `os_district` VALUES ('130632', '安新县', '3', '130600');
INSERT INTO `os_district` VALUES ('130633', '易　县', '3', '130600');
INSERT INTO `os_district` VALUES ('130634', '曲阳县', '3', '130600');
INSERT INTO `os_district` VALUES ('130635', '蠡　县', '3', '130600');
INSERT INTO `os_district` VALUES ('130636', '顺平县', '3', '130600');
INSERT INTO `os_district` VALUES ('130637', '博野县', '3', '130600');
INSERT INTO `os_district` VALUES ('130638', '雄　县', '3', '130600');
INSERT INTO `os_district` VALUES ('130681', '涿州市', '3', '130600');
INSERT INTO `os_district` VALUES ('130682', '定州市', '3', '130600');
INSERT INTO `os_district` VALUES ('130683', '安国市', '3', '130600');
INSERT INTO `os_district` VALUES ('130684', '高碑店市', '3', '130600');
INSERT INTO `os_district` VALUES ('130701', '市辖区', '3', '130700');
INSERT INTO `os_district` VALUES ('130702', '桥东区', '3', '130700');
INSERT INTO `os_district` VALUES ('130703', '桥西区', '3', '130700');
INSERT INTO `os_district` VALUES ('130705', '宣化区', '3', '130700');
INSERT INTO `os_district` VALUES ('130706', '下花园区', '3', '130700');
INSERT INTO `os_district` VALUES ('130721', '宣化县', '3', '130700');
INSERT INTO `os_district` VALUES ('130722', '张北县', '3', '130700');
INSERT INTO `os_district` VALUES ('130723', '康保县', '3', '130700');
INSERT INTO `os_district` VALUES ('130724', '沽源县', '3', '130700');
INSERT INTO `os_district` VALUES ('130725', '尚义县', '3', '130700');
INSERT INTO `os_district` VALUES ('130726', '蔚　县', '3', '130700');
INSERT INTO `os_district` VALUES ('130727', '阳原县', '3', '130700');
INSERT INTO `os_district` VALUES ('130728', '怀安县', '3', '130700');
INSERT INTO `os_district` VALUES ('130729', '万全县', '3', '130700');
INSERT INTO `os_district` VALUES ('130730', '怀来县', '3', '130700');
INSERT INTO `os_district` VALUES ('130731', '涿鹿县', '3', '130700');
INSERT INTO `os_district` VALUES ('130732', '赤城县', '3', '130700');
INSERT INTO `os_district` VALUES ('130733', '崇礼县', '3', '130700');
INSERT INTO `os_district` VALUES ('130801', '市辖区', '3', '130800');
INSERT INTO `os_district` VALUES ('130802', '双桥区', '3', '130800');
INSERT INTO `os_district` VALUES ('130803', '双滦区', '3', '130800');
INSERT INTO `os_district` VALUES ('130804', '鹰手营子矿区', '3', '130800');
INSERT INTO `os_district` VALUES ('130821', '承德县', '3', '130800');
INSERT INTO `os_district` VALUES ('130822', '兴隆县', '3', '130800');
INSERT INTO `os_district` VALUES ('130823', '平泉县', '3', '130800');
INSERT INTO `os_district` VALUES ('130824', '滦平县', '3', '130800');
INSERT INTO `os_district` VALUES ('130825', '隆化县', '3', '130800');
INSERT INTO `os_district` VALUES ('130826', '丰宁满族自治县', '3', '130800');
INSERT INTO `os_district` VALUES ('130827', '宽城满族自治县', '3', '130800');
INSERT INTO `os_district` VALUES ('130828', '围场满族蒙古族自治县', '3', '130800');
INSERT INTO `os_district` VALUES ('130901', '市辖区', '3', '130900');
INSERT INTO `os_district` VALUES ('130902', '新华区', '3', '130900');
INSERT INTO `os_district` VALUES ('130903', '运河区', '3', '130900');
INSERT INTO `os_district` VALUES ('130921', '沧　县', '3', '130900');
INSERT INTO `os_district` VALUES ('130922', '青　县', '3', '130900');
INSERT INTO `os_district` VALUES ('130923', '东光县', '3', '130900');
INSERT INTO `os_district` VALUES ('130924', '海兴县', '3', '130900');
INSERT INTO `os_district` VALUES ('130925', '盐山县', '3', '130900');
INSERT INTO `os_district` VALUES ('130926', '肃宁县', '3', '130900');
INSERT INTO `os_district` VALUES ('130927', '南皮县', '3', '130900');
INSERT INTO `os_district` VALUES ('130928', '吴桥县', '3', '130900');
INSERT INTO `os_district` VALUES ('130929', '献　县', '3', '130900');
INSERT INTO `os_district` VALUES ('130930', '孟村回族自治县', '3', '130900');
INSERT INTO `os_district` VALUES ('130981', '泊头市', '3', '130900');
INSERT INTO `os_district` VALUES ('130982', '任丘市', '3', '130900');
INSERT INTO `os_district` VALUES ('130983', '黄骅市', '3', '130900');
INSERT INTO `os_district` VALUES ('130984', '河间市', '3', '130900');
INSERT INTO `os_district` VALUES ('131001', '市辖区', '3', '131000');
INSERT INTO `os_district` VALUES ('131002', '安次区', '3', '131000');
INSERT INTO `os_district` VALUES ('131003', '广阳区', '3', '131000');
INSERT INTO `os_district` VALUES ('131022', '固安县', '3', '131000');
INSERT INTO `os_district` VALUES ('131023', '永清县', '3', '131000');
INSERT INTO `os_district` VALUES ('131024', '香河县', '3', '131000');
INSERT INTO `os_district` VALUES ('131025', '大城县', '3', '131000');
INSERT INTO `os_district` VALUES ('131026', '文安县', '3', '131000');
INSERT INTO `os_district` VALUES ('131028', '大厂回族自治县', '3', '131000');
INSERT INTO `os_district` VALUES ('131081', '霸州市', '3', '131000');
INSERT INTO `os_district` VALUES ('131082', '三河市', '3', '131000');
INSERT INTO `os_district` VALUES ('131101', '市辖区', '3', '131100');
INSERT INTO `os_district` VALUES ('131102', '桃城区', '3', '131100');
INSERT INTO `os_district` VALUES ('131121', '枣强县', '3', '131100');
INSERT INTO `os_district` VALUES ('131122', '武邑县', '3', '131100');
INSERT INTO `os_district` VALUES ('131123', '武强县', '3', '131100');
INSERT INTO `os_district` VALUES ('131124', '饶阳县', '3', '131100');
INSERT INTO `os_district` VALUES ('131125', '安平县', '3', '131100');
INSERT INTO `os_district` VALUES ('131126', '故城县', '3', '131100');
INSERT INTO `os_district` VALUES ('131127', '景　县', '3', '131100');
INSERT INTO `os_district` VALUES ('131128', '阜城县', '3', '131100');
INSERT INTO `os_district` VALUES ('131181', '冀州市', '3', '131100');
INSERT INTO `os_district` VALUES ('131182', '深州市', '3', '131100');
INSERT INTO `os_district` VALUES ('140101', '市辖区', '3', '140100');
INSERT INTO `os_district` VALUES ('140105', '小店区', '3', '140100');
INSERT INTO `os_district` VALUES ('140106', '迎泽区', '3', '140100');
INSERT INTO `os_district` VALUES ('140107', '杏花岭区', '3', '140100');
INSERT INTO `os_district` VALUES ('140108', '尖草坪区', '3', '140100');
INSERT INTO `os_district` VALUES ('140109', '万柏林区', '3', '140100');
INSERT INTO `os_district` VALUES ('140110', '晋源区', '3', '140100');
INSERT INTO `os_district` VALUES ('140121', '清徐县', '3', '140100');
INSERT INTO `os_district` VALUES ('140122', '阳曲县', '3', '140100');
INSERT INTO `os_district` VALUES ('140123', '娄烦县', '3', '140100');
INSERT INTO `os_district` VALUES ('140181', '古交市', '3', '140100');
INSERT INTO `os_district` VALUES ('140201', '市辖区', '3', '140200');
INSERT INTO `os_district` VALUES ('140202', '城　区', '3', '140200');
INSERT INTO `os_district` VALUES ('140203', '矿　区', '3', '140200');
INSERT INTO `os_district` VALUES ('140211', '南郊区', '3', '140200');
INSERT INTO `os_district` VALUES ('140212', '新荣区', '3', '140200');
INSERT INTO `os_district` VALUES ('140221', '阳高县', '3', '140200');
INSERT INTO `os_district` VALUES ('140222', '天镇县', '3', '140200');
INSERT INTO `os_district` VALUES ('140223', '广灵县', '3', '140200');
INSERT INTO `os_district` VALUES ('140224', '灵丘县', '3', '140200');
INSERT INTO `os_district` VALUES ('140225', '浑源县', '3', '140200');
INSERT INTO `os_district` VALUES ('140226', '左云县', '3', '140200');
INSERT INTO `os_district` VALUES ('140227', '大同县', '3', '140200');
INSERT INTO `os_district` VALUES ('140301', '市辖区', '3', '140300');
INSERT INTO `os_district` VALUES ('140302', '城　区', '3', '140300');
INSERT INTO `os_district` VALUES ('140303', '矿　区', '3', '140300');
INSERT INTO `os_district` VALUES ('140311', '郊　区', '3', '140300');
INSERT INTO `os_district` VALUES ('140321', '平定县', '3', '140300');
INSERT INTO `os_district` VALUES ('140322', '盂　县', '3', '140300');
INSERT INTO `os_district` VALUES ('140401', '市辖区', '3', '140400');
INSERT INTO `os_district` VALUES ('140402', '城　区', '3', '140400');
INSERT INTO `os_district` VALUES ('140411', '郊　区', '3', '140400');
INSERT INTO `os_district` VALUES ('140421', '长治县', '3', '140400');
INSERT INTO `os_district` VALUES ('140423', '襄垣县', '3', '140400');
INSERT INTO `os_district` VALUES ('140424', '屯留县', '3', '140400');
INSERT INTO `os_district` VALUES ('140425', '平顺县', '3', '140400');
INSERT INTO `os_district` VALUES ('140426', '黎城县', '3', '140400');
INSERT INTO `os_district` VALUES ('140427', '壶关县', '3', '140400');
INSERT INTO `os_district` VALUES ('140428', '长子县', '3', '140400');
INSERT INTO `os_district` VALUES ('140429', '武乡县', '3', '140400');
INSERT INTO `os_district` VALUES ('140430', '沁　县', '3', '140400');
INSERT INTO `os_district` VALUES ('140431', '沁源县', '3', '140400');
INSERT INTO `os_district` VALUES ('140481', '潞城市', '3', '140400');
INSERT INTO `os_district` VALUES ('140501', '市辖区', '3', '140500');
INSERT INTO `os_district` VALUES ('140502', '城　区', '3', '140500');
INSERT INTO `os_district` VALUES ('140521', '沁水县', '3', '140500');
INSERT INTO `os_district` VALUES ('140522', '阳城县', '3', '140500');
INSERT INTO `os_district` VALUES ('140524', '陵川县', '3', '140500');
INSERT INTO `os_district` VALUES ('140525', '泽州县', '3', '140500');
INSERT INTO `os_district` VALUES ('140581', '高平市', '3', '140500');
INSERT INTO `os_district` VALUES ('140601', '市辖区', '3', '140600');
INSERT INTO `os_district` VALUES ('140602', '朔城区', '3', '140600');
INSERT INTO `os_district` VALUES ('140603', '平鲁区', '3', '140600');
INSERT INTO `os_district` VALUES ('140621', '山阴县', '3', '140600');
INSERT INTO `os_district` VALUES ('140622', '应　县', '3', '140600');
INSERT INTO `os_district` VALUES ('140623', '右玉县', '3', '140600');
INSERT INTO `os_district` VALUES ('140624', '怀仁县', '3', '140600');
INSERT INTO `os_district` VALUES ('140701', '市辖区', '3', '140700');
INSERT INTO `os_district` VALUES ('140702', '榆次区', '3', '140700');
INSERT INTO `os_district` VALUES ('140721', '榆社县', '3', '140700');
INSERT INTO `os_district` VALUES ('140722', '左权县', '3', '140700');
INSERT INTO `os_district` VALUES ('140723', '和顺县', '3', '140700');
INSERT INTO `os_district` VALUES ('140724', '昔阳县', '3', '140700');
INSERT INTO `os_district` VALUES ('140725', '寿阳县', '3', '140700');
INSERT INTO `os_district` VALUES ('140726', '太谷县', '3', '140700');
INSERT INTO `os_district` VALUES ('140727', '祁　县', '3', '140700');
INSERT INTO `os_district` VALUES ('140728', '平遥县', '3', '140700');
INSERT INTO `os_district` VALUES ('140729', '灵石县', '3', '140700');
INSERT INTO `os_district` VALUES ('140781', '介休市', '3', '140700');
INSERT INTO `os_district` VALUES ('140801', '市辖区', '3', '140800');
INSERT INTO `os_district` VALUES ('140802', '盐湖区', '3', '140800');
INSERT INTO `os_district` VALUES ('140821', '临猗县', '3', '140800');
INSERT INTO `os_district` VALUES ('140822', '万荣县', '3', '140800');
INSERT INTO `os_district` VALUES ('140823', '闻喜县', '3', '140800');
INSERT INTO `os_district` VALUES ('140824', '稷山县', '3', '140800');
INSERT INTO `os_district` VALUES ('140825', '新绛县', '3', '140800');
INSERT INTO `os_district` VALUES ('140826', '绛　县', '3', '140800');
INSERT INTO `os_district` VALUES ('140827', '垣曲县', '3', '140800');
INSERT INTO `os_district` VALUES ('140828', '夏　县', '3', '140800');
INSERT INTO `os_district` VALUES ('140829', '平陆县', '3', '140800');
INSERT INTO `os_district` VALUES ('140830', '芮城县', '3', '140800');
INSERT INTO `os_district` VALUES ('140881', '永济市', '3', '140800');
INSERT INTO `os_district` VALUES ('140882', '河津市', '3', '140800');
INSERT INTO `os_district` VALUES ('140901', '市辖区', '3', '140900');
INSERT INTO `os_district` VALUES ('140902', '忻府区', '3', '140900');
INSERT INTO `os_district` VALUES ('140921', '定襄县', '3', '140900');
INSERT INTO `os_district` VALUES ('140922', '五台县', '3', '140900');
INSERT INTO `os_district` VALUES ('140923', '代　县', '3', '140900');
INSERT INTO `os_district` VALUES ('140924', '繁峙县', '3', '140900');
INSERT INTO `os_district` VALUES ('140925', '宁武县', '3', '140900');
INSERT INTO `os_district` VALUES ('140926', '静乐县', '3', '140900');
INSERT INTO `os_district` VALUES ('140927', '神池县', '3', '140900');
INSERT INTO `os_district` VALUES ('140928', '五寨县', '3', '140900');
INSERT INTO `os_district` VALUES ('140929', '岢岚县', '3', '140900');
INSERT INTO `os_district` VALUES ('140930', '河曲县', '3', '140900');
INSERT INTO `os_district` VALUES ('140931', '保德县', '3', '140900');
INSERT INTO `os_district` VALUES ('140932', '偏关县', '3', '140900');
INSERT INTO `os_district` VALUES ('140981', '原平市', '3', '140900');
INSERT INTO `os_district` VALUES ('141001', '市辖区', '3', '141000');
INSERT INTO `os_district` VALUES ('141002', '尧都区', '3', '141000');
INSERT INTO `os_district` VALUES ('141021', '曲沃县', '3', '141000');
INSERT INTO `os_district` VALUES ('141022', '翼城县', '3', '141000');
INSERT INTO `os_district` VALUES ('141023', '襄汾县', '3', '141000');
INSERT INTO `os_district` VALUES ('141024', '洪洞县', '3', '141000');
INSERT INTO `os_district` VALUES ('141025', '古　县', '3', '141000');
INSERT INTO `os_district` VALUES ('141026', '安泽县', '3', '141000');
INSERT INTO `os_district` VALUES ('141027', '浮山县', '3', '141000');
INSERT INTO `os_district` VALUES ('141028', '吉　县', '3', '141000');
INSERT INTO `os_district` VALUES ('141029', '乡宁县', '3', '141000');
INSERT INTO `os_district` VALUES ('141030', '大宁县', '3', '141000');
INSERT INTO `os_district` VALUES ('141031', '隰　县', '3', '141000');
INSERT INTO `os_district` VALUES ('141032', '永和县', '3', '141000');
INSERT INTO `os_district` VALUES ('141033', '蒲　县', '3', '141000');
INSERT INTO `os_district` VALUES ('141034', '汾西县', '3', '141000');
INSERT INTO `os_district` VALUES ('141081', '侯马市', '3', '141000');
INSERT INTO `os_district` VALUES ('141082', '霍州市', '3', '141000');
INSERT INTO `os_district` VALUES ('141101', '市辖区', '3', '141100');
INSERT INTO `os_district` VALUES ('141102', '离石区', '3', '141100');
INSERT INTO `os_district` VALUES ('141121', '文水县', '3', '141100');
INSERT INTO `os_district` VALUES ('141122', '交城县', '3', '141100');
INSERT INTO `os_district` VALUES ('141123', '兴　县', '3', '141100');
INSERT INTO `os_district` VALUES ('141124', '临　县', '3', '141100');
INSERT INTO `os_district` VALUES ('141125', '柳林县', '3', '141100');
INSERT INTO `os_district` VALUES ('141126', '石楼县', '3', '141100');
INSERT INTO `os_district` VALUES ('141127', '岚　县', '3', '141100');
INSERT INTO `os_district` VALUES ('141128', '方山县', '3', '141100');
INSERT INTO `os_district` VALUES ('141129', '中阳县', '3', '141100');
INSERT INTO `os_district` VALUES ('141130', '交口县', '3', '141100');
INSERT INTO `os_district` VALUES ('141181', '孝义市', '3', '141100');
INSERT INTO `os_district` VALUES ('141182', '汾阳市', '3', '141100');
INSERT INTO `os_district` VALUES ('150101', '市辖区', '3', '150100');
INSERT INTO `os_district` VALUES ('150102', '新城区', '3', '150100');
INSERT INTO `os_district` VALUES ('150103', '回民区', '3', '150100');
INSERT INTO `os_district` VALUES ('150104', '玉泉区', '3', '150100');
INSERT INTO `os_district` VALUES ('150105', '赛罕区', '3', '150100');
INSERT INTO `os_district` VALUES ('150121', '土默特左旗', '3', '150100');
INSERT INTO `os_district` VALUES ('150122', '托克托县', '3', '150100');
INSERT INTO `os_district` VALUES ('150123', '和林格尔县', '3', '150100');
INSERT INTO `os_district` VALUES ('150124', '清水河县', '3', '150100');
INSERT INTO `os_district` VALUES ('150125', '武川县', '3', '150100');
INSERT INTO `os_district` VALUES ('150201', '市辖区', '3', '150200');
INSERT INTO `os_district` VALUES ('150202', '东河区', '3', '150200');
INSERT INTO `os_district` VALUES ('150203', '昆都仑区', '3', '150200');
INSERT INTO `os_district` VALUES ('150204', '青山区', '3', '150200');
INSERT INTO `os_district` VALUES ('150205', '石拐区', '3', '150200');
INSERT INTO `os_district` VALUES ('150206', '白云矿区', '3', '150200');
INSERT INTO `os_district` VALUES ('150207', '九原区', '3', '150200');
INSERT INTO `os_district` VALUES ('150221', '土默特右旗', '3', '150200');
INSERT INTO `os_district` VALUES ('150222', '固阳县', '3', '150200');
INSERT INTO `os_district` VALUES ('150223', '达尔罕茂明安联合旗', '3', '150200');
INSERT INTO `os_district` VALUES ('150301', '市辖区', '3', '150300');
INSERT INTO `os_district` VALUES ('150302', '海勃湾区', '3', '150300');
INSERT INTO `os_district` VALUES ('150303', '海南区', '3', '150300');
INSERT INTO `os_district` VALUES ('150304', '乌达区', '3', '150300');
INSERT INTO `os_district` VALUES ('150401', '市辖区', '3', '150400');
INSERT INTO `os_district` VALUES ('150402', '红山区', '3', '150400');
INSERT INTO `os_district` VALUES ('150403', '元宝山区', '3', '150400');
INSERT INTO `os_district` VALUES ('150404', '松山区', '3', '150400');
INSERT INTO `os_district` VALUES ('150421', '阿鲁科尔沁旗', '3', '150400');
INSERT INTO `os_district` VALUES ('150422', '巴林左旗', '3', '150400');
INSERT INTO `os_district` VALUES ('150423', '巴林右旗', '3', '150400');
INSERT INTO `os_district` VALUES ('150424', '林西县', '3', '150400');
INSERT INTO `os_district` VALUES ('150425', '克什克腾旗', '3', '150400');
INSERT INTO `os_district` VALUES ('150426', '翁牛特旗', '3', '150400');
INSERT INTO `os_district` VALUES ('150428', '喀喇沁旗', '3', '150400');
INSERT INTO `os_district` VALUES ('150429', '宁城县', '3', '150400');
INSERT INTO `os_district` VALUES ('150430', '敖汉旗', '3', '150400');
INSERT INTO `os_district` VALUES ('150501', '市辖区', '3', '150500');
INSERT INTO `os_district` VALUES ('150502', '科尔沁区', '3', '150500');
INSERT INTO `os_district` VALUES ('150521', '科尔沁左翼中旗', '3', '150500');
INSERT INTO `os_district` VALUES ('150522', '科尔沁左翼后旗', '3', '150500');
INSERT INTO `os_district` VALUES ('150523', '开鲁县', '3', '150500');
INSERT INTO `os_district` VALUES ('150524', '库伦旗', '3', '150500');
INSERT INTO `os_district` VALUES ('150525', '奈曼旗', '3', '150500');
INSERT INTO `os_district` VALUES ('150526', '扎鲁特旗', '3', '150500');
INSERT INTO `os_district` VALUES ('150581', '霍林郭勒市', '3', '150500');
INSERT INTO `os_district` VALUES ('150602', '东胜区', '3', '150600');
INSERT INTO `os_district` VALUES ('150621', '达拉特旗', '3', '150600');
INSERT INTO `os_district` VALUES ('150622', '准格尔旗', '3', '150600');
INSERT INTO `os_district` VALUES ('150623', '鄂托克前旗', '3', '150600');
INSERT INTO `os_district` VALUES ('150624', '鄂托克旗', '3', '150600');
INSERT INTO `os_district` VALUES ('150625', '杭锦旗', '3', '150600');
INSERT INTO `os_district` VALUES ('150626', '乌审旗', '3', '150600');
INSERT INTO `os_district` VALUES ('150627', '伊金霍洛旗', '3', '150600');
INSERT INTO `os_district` VALUES ('150701', '市辖区', '3', '150700');
INSERT INTO `os_district` VALUES ('150702', '海拉尔区', '3', '150700');
INSERT INTO `os_district` VALUES ('150721', '阿荣旗', '3', '150700');
INSERT INTO `os_district` VALUES ('150722', '莫力达瓦达斡尔族自治旗', '3', '150700');
INSERT INTO `os_district` VALUES ('150723', '鄂伦春自治旗', '3', '150700');
INSERT INTO `os_district` VALUES ('150724', '鄂温克族自治旗', '3', '150700');
INSERT INTO `os_district` VALUES ('150725', '陈巴尔虎旗', '3', '150700');
INSERT INTO `os_district` VALUES ('150726', '新巴尔虎左旗', '3', '150700');
INSERT INTO `os_district` VALUES ('150727', '新巴尔虎右旗', '3', '150700');
INSERT INTO `os_district` VALUES ('150781', '满洲里市', '3', '150700');
INSERT INTO `os_district` VALUES ('150782', '牙克石市', '3', '150700');
INSERT INTO `os_district` VALUES ('150783', '扎兰屯市', '3', '150700');
INSERT INTO `os_district` VALUES ('150784', '额尔古纳市', '3', '150700');
INSERT INTO `os_district` VALUES ('150785', '根河市', '3', '150700');
INSERT INTO `os_district` VALUES ('150801', '市辖区', '3', '150800');
INSERT INTO `os_district` VALUES ('150802', '临河区', '3', '150800');
INSERT INTO `os_district` VALUES ('150821', '五原县', '3', '150800');
INSERT INTO `os_district` VALUES ('150822', '磴口县', '3', '150800');
INSERT INTO `os_district` VALUES ('150823', '乌拉特前旗', '3', '150800');
INSERT INTO `os_district` VALUES ('150824', '乌拉特中旗', '3', '150800');
INSERT INTO `os_district` VALUES ('150825', '乌拉特后旗', '3', '150800');
INSERT INTO `os_district` VALUES ('150826', '杭锦后旗', '3', '150800');
INSERT INTO `os_district` VALUES ('150901', '市辖区', '3', '150900');
INSERT INTO `os_district` VALUES ('150902', '集宁区', '3', '150900');
INSERT INTO `os_district` VALUES ('150921', '卓资县', '3', '150900');
INSERT INTO `os_district` VALUES ('150922', '化德县', '3', '150900');
INSERT INTO `os_district` VALUES ('150923', '商都县', '3', '150900');
INSERT INTO `os_district` VALUES ('150924', '兴和县', '3', '150900');
INSERT INTO `os_district` VALUES ('150925', '凉城县', '3', '150900');
INSERT INTO `os_district` VALUES ('150926', '察哈尔右翼前旗', '3', '150900');
INSERT INTO `os_district` VALUES ('150927', '察哈尔右翼中旗', '3', '150900');
INSERT INTO `os_district` VALUES ('150928', '察哈尔右翼后旗', '3', '150900');
INSERT INTO `os_district` VALUES ('150929', '四子王旗', '3', '150900');
INSERT INTO `os_district` VALUES ('150981', '丰镇市', '3', '150900');
INSERT INTO `os_district` VALUES ('152201', '乌兰浩特市', '3', '152200');
INSERT INTO `os_district` VALUES ('152202', '阿尔山市', '3', '152200');
INSERT INTO `os_district` VALUES ('152221', '科尔沁右翼前旗', '3', '152200');
INSERT INTO `os_district` VALUES ('152222', '科尔沁右翼中旗', '3', '152200');
INSERT INTO `os_district` VALUES ('152223', '扎赉特旗', '3', '152200');
INSERT INTO `os_district` VALUES ('152224', '突泉县', '3', '152200');
INSERT INTO `os_district` VALUES ('152501', '二连浩特市', '3', '152500');
INSERT INTO `os_district` VALUES ('152502', '锡林浩特市', '3', '152500');
INSERT INTO `os_district` VALUES ('152522', '阿巴嘎旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152523', '苏尼特左旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152524', '苏尼特右旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152525', '东乌珠穆沁旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152526', '西乌珠穆沁旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152527', '太仆寺旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152528', '镶黄旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152529', '正镶白旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152530', '正蓝旗', '3', '152500');
INSERT INTO `os_district` VALUES ('152531', '多伦县', '3', '152500');
INSERT INTO `os_district` VALUES ('152921', '阿拉善左旗', '3', '152900');
INSERT INTO `os_district` VALUES ('152922', '阿拉善右旗', '3', '152900');
INSERT INTO `os_district` VALUES ('152923', '额济纳旗', '3', '152900');
INSERT INTO `os_district` VALUES ('210101', '市辖区', '3', '210100');
INSERT INTO `os_district` VALUES ('210102', '和平区', '3', '210100');
INSERT INTO `os_district` VALUES ('210103', '沈河区', '3', '210100');
INSERT INTO `os_district` VALUES ('210104', '大东区', '3', '210100');
INSERT INTO `os_district` VALUES ('210105', '皇姑区', '3', '210100');
INSERT INTO `os_district` VALUES ('210106', '铁西区', '3', '210100');
INSERT INTO `os_district` VALUES ('210111', '苏家屯区', '3', '210100');
INSERT INTO `os_district` VALUES ('210112', '东陵区', '3', '210100');
INSERT INTO `os_district` VALUES ('210113', '新城子区', '3', '210100');
INSERT INTO `os_district` VALUES ('210114', '于洪区', '3', '210100');
INSERT INTO `os_district` VALUES ('210122', '辽中县', '3', '210100');
INSERT INTO `os_district` VALUES ('210123', '康平县', '3', '210100');
INSERT INTO `os_district` VALUES ('210124', '法库县', '3', '210100');
INSERT INTO `os_district` VALUES ('210181', '新民市', '3', '210100');
INSERT INTO `os_district` VALUES ('210201', '市辖区', '3', '210200');
INSERT INTO `os_district` VALUES ('210202', '中山区', '3', '210200');
INSERT INTO `os_district` VALUES ('210203', '西岗区', '3', '210200');
INSERT INTO `os_district` VALUES ('210204', '沙河口区', '3', '210200');
INSERT INTO `os_district` VALUES ('210211', '甘井子区', '3', '210200');
INSERT INTO `os_district` VALUES ('210212', '旅顺口区', '3', '210200');
INSERT INTO `os_district` VALUES ('210213', '金州区', '3', '210200');
INSERT INTO `os_district` VALUES ('210224', '长海县', '3', '210200');
INSERT INTO `os_district` VALUES ('210281', '瓦房店市', '3', '210200');
INSERT INTO `os_district` VALUES ('210282', '普兰店市', '3', '210200');
INSERT INTO `os_district` VALUES ('210283', '庄河市', '3', '210200');
INSERT INTO `os_district` VALUES ('210301', '市辖区', '3', '210300');
INSERT INTO `os_district` VALUES ('210302', '铁东区', '3', '210300');
INSERT INTO `os_district` VALUES ('210303', '铁西区', '3', '210300');
INSERT INTO `os_district` VALUES ('210304', '立山区', '3', '210300');
INSERT INTO `os_district` VALUES ('210311', '千山区', '3', '210300');
INSERT INTO `os_district` VALUES ('210321', '台安县', '3', '210300');
INSERT INTO `os_district` VALUES ('210323', '岫岩满族自治县', '3', '210300');
INSERT INTO `os_district` VALUES ('210381', '海城市', '3', '210300');
INSERT INTO `os_district` VALUES ('210401', '市辖区', '3', '210400');
INSERT INTO `os_district` VALUES ('210402', '新抚区', '3', '210400');
INSERT INTO `os_district` VALUES ('210403', '东洲区', '3', '210400');
INSERT INTO `os_district` VALUES ('210404', '望花区', '3', '210400');
INSERT INTO `os_district` VALUES ('210411', '顺城区', '3', '210400');
INSERT INTO `os_district` VALUES ('210421', '抚顺县', '3', '210400');
INSERT INTO `os_district` VALUES ('210422', '新宾满族自治县', '3', '210400');
INSERT INTO `os_district` VALUES ('210423', '清原满族自治县', '3', '210400');
INSERT INTO `os_district` VALUES ('210501', '市辖区', '3', '210500');
INSERT INTO `os_district` VALUES ('210502', '平山区', '3', '210500');
INSERT INTO `os_district` VALUES ('210503', '溪湖区', '3', '210500');
INSERT INTO `os_district` VALUES ('210504', '明山区', '3', '210500');
INSERT INTO `os_district` VALUES ('210505', '南芬区', '3', '210500');
INSERT INTO `os_district` VALUES ('210521', '本溪满族自治县', '3', '210500');
INSERT INTO `os_district` VALUES ('210522', '桓仁满族自治县', '3', '210500');
INSERT INTO `os_district` VALUES ('210601', '市辖区', '3', '210600');
INSERT INTO `os_district` VALUES ('210602', '元宝区', '3', '210600');
INSERT INTO `os_district` VALUES ('210603', '振兴区', '3', '210600');
INSERT INTO `os_district` VALUES ('210604', '振安区', '3', '210600');
INSERT INTO `os_district` VALUES ('210624', '宽甸满族自治县', '3', '210600');
INSERT INTO `os_district` VALUES ('210681', '东港市', '3', '210600');
INSERT INTO `os_district` VALUES ('210682', '凤城市', '3', '210600');
INSERT INTO `os_district` VALUES ('210701', '市辖区', '3', '210700');
INSERT INTO `os_district` VALUES ('210702', '古塔区', '3', '210700');
INSERT INTO `os_district` VALUES ('210703', '凌河区', '3', '210700');
INSERT INTO `os_district` VALUES ('210711', '太和区', '3', '210700');
INSERT INTO `os_district` VALUES ('210726', '黑山县', '3', '210700');
INSERT INTO `os_district` VALUES ('210727', '义　县', '3', '210700');
INSERT INTO `os_district` VALUES ('210781', '凌海市', '3', '210700');
INSERT INTO `os_district` VALUES ('210782', '北宁市', '3', '210700');
INSERT INTO `os_district` VALUES ('210801', '市辖区', '3', '210800');
INSERT INTO `os_district` VALUES ('210802', '站前区', '3', '210800');
INSERT INTO `os_district` VALUES ('210803', '西市区', '3', '210800');
INSERT INTO `os_district` VALUES ('210804', '鲅鱼圈区', '3', '210800');
INSERT INTO `os_district` VALUES ('210811', '老边区', '3', '210800');
INSERT INTO `os_district` VALUES ('210881', '盖州市', '3', '210800');
INSERT INTO `os_district` VALUES ('210882', '大石桥市', '3', '210800');
INSERT INTO `os_district` VALUES ('210901', '市辖区', '3', '210900');
INSERT INTO `os_district` VALUES ('210902', '海州区', '3', '210900');
INSERT INTO `os_district` VALUES ('210903', '新邱区', '3', '210900');
INSERT INTO `os_district` VALUES ('210904', '太平区', '3', '210900');
INSERT INTO `os_district` VALUES ('210905', '清河门区', '3', '210900');
INSERT INTO `os_district` VALUES ('210911', '细河区', '3', '210900');
INSERT INTO `os_district` VALUES ('210921', '阜新蒙古族自治县', '3', '210900');
INSERT INTO `os_district` VALUES ('210922', '彰武县', '3', '210900');
INSERT INTO `os_district` VALUES ('211001', '市辖区', '3', '211000');
INSERT INTO `os_district` VALUES ('211002', '白塔区', '3', '211000');
INSERT INTO `os_district` VALUES ('211003', '文圣区', '3', '211000');
INSERT INTO `os_district` VALUES ('211004', '宏伟区', '3', '211000');
INSERT INTO `os_district` VALUES ('211005', '弓长岭区', '3', '211000');
INSERT INTO `os_district` VALUES ('211011', '太子河区', '3', '211000');
INSERT INTO `os_district` VALUES ('211021', '辽阳县', '3', '211000');
INSERT INTO `os_district` VALUES ('211081', '灯塔市', '3', '211000');
INSERT INTO `os_district` VALUES ('211101', '市辖区', '3', '211100');
INSERT INTO `os_district` VALUES ('211102', '双台子区', '3', '211100');
INSERT INTO `os_district` VALUES ('211103', '兴隆台区', '3', '211100');
INSERT INTO `os_district` VALUES ('211121', '大洼县', '3', '211100');
INSERT INTO `os_district` VALUES ('211122', '盘山县', '3', '211100');
INSERT INTO `os_district` VALUES ('211201', '市辖区', '3', '211200');
INSERT INTO `os_district` VALUES ('211202', '银州区', '3', '211200');
INSERT INTO `os_district` VALUES ('211204', '清河区', '3', '211200');
INSERT INTO `os_district` VALUES ('211221', '铁岭县', '3', '211200');
INSERT INTO `os_district` VALUES ('211223', '西丰县', '3', '211200');
INSERT INTO `os_district` VALUES ('211224', '昌图县', '3', '211200');
INSERT INTO `os_district` VALUES ('211281', '调兵山市', '3', '211200');
INSERT INTO `os_district` VALUES ('211282', '开原市', '3', '211200');
INSERT INTO `os_district` VALUES ('211301', '市辖区', '3', '211300');
INSERT INTO `os_district` VALUES ('211302', '双塔区', '3', '211300');
INSERT INTO `os_district` VALUES ('211303', '龙城区', '3', '211300');
INSERT INTO `os_district` VALUES ('211321', '朝阳县', '3', '211300');
INSERT INTO `os_district` VALUES ('211322', '建平县', '3', '211300');
INSERT INTO `os_district` VALUES ('211324', '喀喇沁左翼蒙古族自治县', '3', '211300');
INSERT INTO `os_district` VALUES ('211381', '北票市', '3', '211300');
INSERT INTO `os_district` VALUES ('211382', '凌源市', '3', '211300');
INSERT INTO `os_district` VALUES ('211401', '市辖区', '3', '211400');
INSERT INTO `os_district` VALUES ('211402', '连山区', '3', '211400');
INSERT INTO `os_district` VALUES ('211403', '龙港区', '3', '211400');
INSERT INTO `os_district` VALUES ('211404', '南票区', '3', '211400');
INSERT INTO `os_district` VALUES ('211421', '绥中县', '3', '211400');
INSERT INTO `os_district` VALUES ('211422', '建昌县', '3', '211400');
INSERT INTO `os_district` VALUES ('211481', '兴城市', '3', '211400');
INSERT INTO `os_district` VALUES ('220101', '市辖区', '3', '220100');
INSERT INTO `os_district` VALUES ('220102', '南关区', '3', '220100');
INSERT INTO `os_district` VALUES ('220103', '宽城区', '3', '220100');
INSERT INTO `os_district` VALUES ('220104', '朝阳区', '3', '220100');
INSERT INTO `os_district` VALUES ('220105', '二道区', '3', '220100');
INSERT INTO `os_district` VALUES ('220106', '绿园区', '3', '220100');
INSERT INTO `os_district` VALUES ('220112', '双阳区', '3', '220100');
INSERT INTO `os_district` VALUES ('220122', '农安县', '3', '220100');
INSERT INTO `os_district` VALUES ('220181', '九台市', '3', '220100');
INSERT INTO `os_district` VALUES ('220182', '榆树市', '3', '220100');
INSERT INTO `os_district` VALUES ('220183', '德惠市', '3', '220100');
INSERT INTO `os_district` VALUES ('220201', '市辖区', '3', '220200');
INSERT INTO `os_district` VALUES ('220202', '昌邑区', '3', '220200');
INSERT INTO `os_district` VALUES ('220203', '龙潭区', '3', '220200');
INSERT INTO `os_district` VALUES ('220204', '船营区', '3', '220200');
INSERT INTO `os_district` VALUES ('220211', '丰满区', '3', '220200');
INSERT INTO `os_district` VALUES ('220221', '永吉县', '3', '220200');
INSERT INTO `os_district` VALUES ('220281', '蛟河市', '3', '220200');
INSERT INTO `os_district` VALUES ('220282', '桦甸市', '3', '220200');
INSERT INTO `os_district` VALUES ('220283', '舒兰市', '3', '220200');
INSERT INTO `os_district` VALUES ('220284', '磐石市', '3', '220200');
INSERT INTO `os_district` VALUES ('220301', '市辖区', '3', '220300');
INSERT INTO `os_district` VALUES ('220302', '铁西区', '3', '220300');
INSERT INTO `os_district` VALUES ('220303', '铁东区', '3', '220300');
INSERT INTO `os_district` VALUES ('220322', '梨树县', '3', '220300');
INSERT INTO `os_district` VALUES ('220323', '伊通满族自治县', '3', '220300');
INSERT INTO `os_district` VALUES ('220381', '公主岭市', '3', '220300');
INSERT INTO `os_district` VALUES ('220382', '双辽市', '3', '220300');
INSERT INTO `os_district` VALUES ('220401', '市辖区', '3', '220400');
INSERT INTO `os_district` VALUES ('220402', '龙山区', '3', '220400');
INSERT INTO `os_district` VALUES ('220403', '西安区', '3', '220400');
INSERT INTO `os_district` VALUES ('220421', '东丰县', '3', '220400');
INSERT INTO `os_district` VALUES ('220422', '东辽县', '3', '220400');
INSERT INTO `os_district` VALUES ('220501', '市辖区', '3', '220500');
INSERT INTO `os_district` VALUES ('220502', '东昌区', '3', '220500');
INSERT INTO `os_district` VALUES ('220503', '二道江区', '3', '220500');
INSERT INTO `os_district` VALUES ('220521', '通化县', '3', '220500');
INSERT INTO `os_district` VALUES ('220523', '辉南县', '3', '220500');
INSERT INTO `os_district` VALUES ('220524', '柳河县', '3', '220500');
INSERT INTO `os_district` VALUES ('220581', '梅河口市', '3', '220500');
INSERT INTO `os_district` VALUES ('220582', '集安市', '3', '220500');
INSERT INTO `os_district` VALUES ('220601', '市辖区', '3', '220600');
INSERT INTO `os_district` VALUES ('220602', '八道江区', '3', '220600');
INSERT INTO `os_district` VALUES ('220621', '抚松县', '3', '220600');
INSERT INTO `os_district` VALUES ('220622', '靖宇县', '3', '220600');
INSERT INTO `os_district` VALUES ('220623', '长白朝鲜族自治县', '3', '220600');
INSERT INTO `os_district` VALUES ('220625', '江源县', '3', '220600');
INSERT INTO `os_district` VALUES ('220681', '临江市', '3', '220600');
INSERT INTO `os_district` VALUES ('220701', '市辖区', '3', '220700');
INSERT INTO `os_district` VALUES ('220702', '宁江区', '3', '220700');
INSERT INTO `os_district` VALUES ('220721', '前郭尔罗斯蒙古族自治县', '3', '220700');
INSERT INTO `os_district` VALUES ('220722', '长岭县', '3', '220700');
INSERT INTO `os_district` VALUES ('220723', '乾安县', '3', '220700');
INSERT INTO `os_district` VALUES ('220724', '扶余县', '3', '220700');
INSERT INTO `os_district` VALUES ('220801', '市辖区', '3', '220800');
INSERT INTO `os_district` VALUES ('220802', '洮北区', '3', '220800');
INSERT INTO `os_district` VALUES ('220821', '镇赉县', '3', '220800');
INSERT INTO `os_district` VALUES ('220822', '通榆县', '3', '220800');
INSERT INTO `os_district` VALUES ('220881', '洮南市', '3', '220800');
INSERT INTO `os_district` VALUES ('220882', '大安市', '3', '220800');
INSERT INTO `os_district` VALUES ('222401', '延吉市', '3', '222400');
INSERT INTO `os_district` VALUES ('222402', '图们市', '3', '222400');
INSERT INTO `os_district` VALUES ('222403', '敦化市', '3', '222400');
INSERT INTO `os_district` VALUES ('222404', '珲春市', '3', '222400');
INSERT INTO `os_district` VALUES ('222405', '龙井市', '3', '222400');
INSERT INTO `os_district` VALUES ('222406', '和龙市', '3', '222400');
INSERT INTO `os_district` VALUES ('222424', '汪清县', '3', '222400');
INSERT INTO `os_district` VALUES ('222426', '安图县', '3', '222400');
INSERT INTO `os_district` VALUES ('230101', '市辖区', '3', '230100');
INSERT INTO `os_district` VALUES ('230102', '道里区', '3', '230100');
INSERT INTO `os_district` VALUES ('230103', '南岗区', '3', '230100');
INSERT INTO `os_district` VALUES ('230104', '道外区', '3', '230100');
INSERT INTO `os_district` VALUES ('230106', '香坊区', '3', '230100');
INSERT INTO `os_district` VALUES ('230107', '动力区', '3', '230100');
INSERT INTO `os_district` VALUES ('230108', '平房区', '3', '230100');
INSERT INTO `os_district` VALUES ('230109', '松北区', '3', '230100');
INSERT INTO `os_district` VALUES ('230111', '呼兰区', '3', '230100');
INSERT INTO `os_district` VALUES ('230123', '依兰县', '3', '230100');
INSERT INTO `os_district` VALUES ('230124', '方正县', '3', '230100');
INSERT INTO `os_district` VALUES ('230125', '宾　县', '3', '230100');
INSERT INTO `os_district` VALUES ('230126', '巴彦县', '3', '230100');
INSERT INTO `os_district` VALUES ('230127', '木兰县', '3', '230100');
INSERT INTO `os_district` VALUES ('230128', '通河县', '3', '230100');
INSERT INTO `os_district` VALUES ('230129', '延寿县', '3', '230100');
INSERT INTO `os_district` VALUES ('230181', '阿城市', '3', '230100');
INSERT INTO `os_district` VALUES ('230182', '双城市', '3', '230100');
INSERT INTO `os_district` VALUES ('230183', '尚志市', '3', '230100');
INSERT INTO `os_district` VALUES ('230184', '五常市', '3', '230100');
INSERT INTO `os_district` VALUES ('230201', '市辖区', '3', '230200');
INSERT INTO `os_district` VALUES ('230202', '龙沙区', '3', '230200');
INSERT INTO `os_district` VALUES ('230203', '建华区', '3', '230200');
INSERT INTO `os_district` VALUES ('230204', '铁锋区', '3', '230200');
INSERT INTO `os_district` VALUES ('230205', '昂昂溪区', '3', '230200');
INSERT INTO `os_district` VALUES ('230206', '富拉尔基区', '3', '230200');
INSERT INTO `os_district` VALUES ('230207', '碾子山区', '3', '230200');
INSERT INTO `os_district` VALUES ('230208', '梅里斯达斡尔族区', '3', '230200');
INSERT INTO `os_district` VALUES ('230221', '龙江县', '3', '230200');
INSERT INTO `os_district` VALUES ('230223', '依安县', '3', '230200');
INSERT INTO `os_district` VALUES ('230224', '泰来县', '3', '230200');
INSERT INTO `os_district` VALUES ('230225', '甘南县', '3', '230200');
INSERT INTO `os_district` VALUES ('230227', '富裕县', '3', '230200');
INSERT INTO `os_district` VALUES ('230229', '克山县', '3', '230200');
INSERT INTO `os_district` VALUES ('230230', '克东县', '3', '230200');
INSERT INTO `os_district` VALUES ('230231', '拜泉县', '3', '230200');
INSERT INTO `os_district` VALUES ('230281', '讷河市', '3', '230200');
INSERT INTO `os_district` VALUES ('230301', '市辖区', '3', '230300');
INSERT INTO `os_district` VALUES ('230302', '鸡冠区', '3', '230300');
INSERT INTO `os_district` VALUES ('230303', '恒山区', '3', '230300');
INSERT INTO `os_district` VALUES ('230304', '滴道区', '3', '230300');
INSERT INTO `os_district` VALUES ('230305', '梨树区', '3', '230300');
INSERT INTO `os_district` VALUES ('230306', '城子河区', '3', '230300');
INSERT INTO `os_district` VALUES ('230307', '麻山区', '3', '230300');
INSERT INTO `os_district` VALUES ('230321', '鸡东县', '3', '230300');
INSERT INTO `os_district` VALUES ('230381', '虎林市', '3', '230300');
INSERT INTO `os_district` VALUES ('230382', '密山市', '3', '230300');
INSERT INTO `os_district` VALUES ('230401', '市辖区', '3', '230400');
INSERT INTO `os_district` VALUES ('230402', '向阳区', '3', '230400');
INSERT INTO `os_district` VALUES ('230403', '工农区', '3', '230400');
INSERT INTO `os_district` VALUES ('230404', '南山区', '3', '230400');
INSERT INTO `os_district` VALUES ('230405', '兴安区', '3', '230400');
INSERT INTO `os_district` VALUES ('230406', '东山区', '3', '230400');
INSERT INTO `os_district` VALUES ('230407', '兴山区', '3', '230400');
INSERT INTO `os_district` VALUES ('230421', '萝北县', '3', '230400');
INSERT INTO `os_district` VALUES ('230422', '绥滨县', '3', '230400');
INSERT INTO `os_district` VALUES ('230501', '市辖区', '3', '230500');
INSERT INTO `os_district` VALUES ('230502', '尖山区', '3', '230500');
INSERT INTO `os_district` VALUES ('230503', '岭东区', '3', '230500');
INSERT INTO `os_district` VALUES ('230505', '四方台区', '3', '230500');
INSERT INTO `os_district` VALUES ('230506', '宝山区', '3', '230500');
INSERT INTO `os_district` VALUES ('230521', '集贤县', '3', '230500');
INSERT INTO `os_district` VALUES ('230522', '友谊县', '3', '230500');
INSERT INTO `os_district` VALUES ('230523', '宝清县', '3', '230500');
INSERT INTO `os_district` VALUES ('230524', '饶河县', '3', '230500');
INSERT INTO `os_district` VALUES ('230601', '市辖区', '3', '230600');
INSERT INTO `os_district` VALUES ('230602', '萨尔图区', '3', '230600');
INSERT INTO `os_district` VALUES ('230603', '龙凤区', '3', '230600');
INSERT INTO `os_district` VALUES ('230604', '让胡路区', '3', '230600');
INSERT INTO `os_district` VALUES ('230605', '红岗区', '3', '230600');
INSERT INTO `os_district` VALUES ('230606', '大同区', '3', '230600');
INSERT INTO `os_district` VALUES ('230621', '肇州县', '3', '230600');
INSERT INTO `os_district` VALUES ('230622', '肇源县', '3', '230600');
INSERT INTO `os_district` VALUES ('230623', '林甸县', '3', '230600');
INSERT INTO `os_district` VALUES ('230624', '杜尔伯特蒙古族自治县', '3', '230600');
INSERT INTO `os_district` VALUES ('230701', '市辖区', '3', '230700');
INSERT INTO `os_district` VALUES ('230702', '伊春区', '3', '230700');
INSERT INTO `os_district` VALUES ('230703', '南岔区', '3', '230700');
INSERT INTO `os_district` VALUES ('230704', '友好区', '3', '230700');
INSERT INTO `os_district` VALUES ('230705', '西林区', '3', '230700');
INSERT INTO `os_district` VALUES ('230706', '翠峦区', '3', '230700');
INSERT INTO `os_district` VALUES ('230707', '新青区', '3', '230700');
INSERT INTO `os_district` VALUES ('230708', '美溪区', '3', '230700');
INSERT INTO `os_district` VALUES ('230709', '金山屯区', '3', '230700');
INSERT INTO `os_district` VALUES ('230710', '五营区', '3', '230700');
INSERT INTO `os_district` VALUES ('230711', '乌马河区', '3', '230700');
INSERT INTO `os_district` VALUES ('230712', '汤旺河区', '3', '230700');
INSERT INTO `os_district` VALUES ('230713', '带岭区', '3', '230700');
INSERT INTO `os_district` VALUES ('230714', '乌伊岭区', '3', '230700');
INSERT INTO `os_district` VALUES ('230715', '红星区', '3', '230700');
INSERT INTO `os_district` VALUES ('230716', '上甘岭区', '3', '230700');
INSERT INTO `os_district` VALUES ('230722', '嘉荫县', '3', '230700');
INSERT INTO `os_district` VALUES ('230781', '铁力市', '3', '230700');
INSERT INTO `os_district` VALUES ('230801', '市辖区', '3', '230800');
INSERT INTO `os_district` VALUES ('230802', '永红区', '3', '230800');
INSERT INTO `os_district` VALUES ('230803', '向阳区', '3', '230800');
INSERT INTO `os_district` VALUES ('230804', '前进区', '3', '230800');
INSERT INTO `os_district` VALUES ('230805', '东风区', '3', '230800');
INSERT INTO `os_district` VALUES ('230811', '郊　区', '3', '230800');
INSERT INTO `os_district` VALUES ('230822', '桦南县', '3', '230800');
INSERT INTO `os_district` VALUES ('230826', '桦川县', '3', '230800');
INSERT INTO `os_district` VALUES ('230828', '汤原县', '3', '230800');
INSERT INTO `os_district` VALUES ('230833', '抚远县', '3', '230800');
INSERT INTO `os_district` VALUES ('230881', '同江市', '3', '230800');
INSERT INTO `os_district` VALUES ('230882', '富锦市', '3', '230800');
INSERT INTO `os_district` VALUES ('230901', '市辖区', '3', '230900');
INSERT INTO `os_district` VALUES ('230902', '新兴区', '3', '230900');
INSERT INTO `os_district` VALUES ('230903', '桃山区', '3', '230900');
INSERT INTO `os_district` VALUES ('230904', '茄子河区', '3', '230900');
INSERT INTO `os_district` VALUES ('230921', '勃利县', '3', '230900');
INSERT INTO `os_district` VALUES ('231001', '市辖区', '3', '231000');
INSERT INTO `os_district` VALUES ('231002', '东安区', '3', '231000');
INSERT INTO `os_district` VALUES ('231003', '阳明区', '3', '231000');
INSERT INTO `os_district` VALUES ('231004', '爱民区', '3', '231000');
INSERT INTO `os_district` VALUES ('231005', '西安区', '3', '231000');
INSERT INTO `os_district` VALUES ('231024', '东宁县', '3', '231000');
INSERT INTO `os_district` VALUES ('231025', '林口县', '3', '231000');
INSERT INTO `os_district` VALUES ('231081', '绥芬河市', '3', '231000');
INSERT INTO `os_district` VALUES ('231083', '海林市', '3', '231000');
INSERT INTO `os_district` VALUES ('231084', '宁安市', '3', '231000');
INSERT INTO `os_district` VALUES ('231085', '穆棱市', '3', '231000');
INSERT INTO `os_district` VALUES ('231101', '市辖区', '3', '231100');
INSERT INTO `os_district` VALUES ('231102', '爱辉区', '3', '231100');
INSERT INTO `os_district` VALUES ('231121', '嫩江县', '3', '231100');
INSERT INTO `os_district` VALUES ('231123', '逊克县', '3', '231100');
INSERT INTO `os_district` VALUES ('231124', '孙吴县', '3', '231100');
INSERT INTO `os_district` VALUES ('231181', '北安市', '3', '231100');
INSERT INTO `os_district` VALUES ('231182', '五大连池市', '3', '231100');
INSERT INTO `os_district` VALUES ('231201', '市辖区', '3', '231200');
INSERT INTO `os_district` VALUES ('231202', '北林区', '3', '231200');
INSERT INTO `os_district` VALUES ('231221', '望奎县', '3', '231200');
INSERT INTO `os_district` VALUES ('231222', '兰西县', '3', '231200');
INSERT INTO `os_district` VALUES ('231223', '青冈县', '3', '231200');
INSERT INTO `os_district` VALUES ('231224', '庆安县', '3', '231200');
INSERT INTO `os_district` VALUES ('231225', '明水县', '3', '231200');
INSERT INTO `os_district` VALUES ('231226', '绥棱县', '3', '231200');
INSERT INTO `os_district` VALUES ('231281', '安达市', '3', '231200');
INSERT INTO `os_district` VALUES ('231282', '肇东市', '3', '231200');
INSERT INTO `os_district` VALUES ('231283', '海伦市', '3', '231200');
INSERT INTO `os_district` VALUES ('232721', '呼玛县', '3', '232700');
INSERT INTO `os_district` VALUES ('232722', '塔河县', '3', '232700');
INSERT INTO `os_district` VALUES ('232723', '漠河县', '3', '232700');
INSERT INTO `os_district` VALUES ('310101', '黄浦区', '3', '310100');
INSERT INTO `os_district` VALUES ('310103', '卢湾区', '3', '310100');
INSERT INTO `os_district` VALUES ('310104', '徐汇区', '3', '310100');
INSERT INTO `os_district` VALUES ('310105', '长宁区', '3', '310100');
INSERT INTO `os_district` VALUES ('310106', '静安区', '3', '310100');
INSERT INTO `os_district` VALUES ('310107', '普陀区', '3', '310100');
INSERT INTO `os_district` VALUES ('310108', '闸北区', '3', '310100');
INSERT INTO `os_district` VALUES ('310109', '虹口区', '3', '310100');
INSERT INTO `os_district` VALUES ('310110', '杨浦区', '3', '310100');
INSERT INTO `os_district` VALUES ('310112', '闵行区', '3', '310100');
INSERT INTO `os_district` VALUES ('310113', '宝山区', '3', '310100');
INSERT INTO `os_district` VALUES ('310114', '嘉定区', '3', '310100');
INSERT INTO `os_district` VALUES ('310115', '浦东新区', '3', '310100');
INSERT INTO `os_district` VALUES ('310116', '金山区', '3', '310100');
INSERT INTO `os_district` VALUES ('310117', '松江区', '3', '310100');
INSERT INTO `os_district` VALUES ('310118', '青浦区', '3', '310100');
INSERT INTO `os_district` VALUES ('310119', '南汇区', '3', '310100');
INSERT INTO `os_district` VALUES ('310120', '奉贤区', '3', '310100');
INSERT INTO `os_district` VALUES ('310230', '崇明县', '3', '310200');
INSERT INTO `os_district` VALUES ('320101', '市辖区', '3', '320100');
INSERT INTO `os_district` VALUES ('320102', '玄武区', '3', '320100');
INSERT INTO `os_district` VALUES ('320103', '白下区', '3', '320100');
INSERT INTO `os_district` VALUES ('320104', '秦淮区', '3', '320100');
INSERT INTO `os_district` VALUES ('320105', '建邺区', '3', '320100');
INSERT INTO `os_district` VALUES ('320106', '鼓楼区', '3', '320100');
INSERT INTO `os_district` VALUES ('320107', '下关区', '3', '320100');
INSERT INTO `os_district` VALUES ('320111', '浦口区', '3', '320100');
INSERT INTO `os_district` VALUES ('320113', '栖霞区', '3', '320100');
INSERT INTO `os_district` VALUES ('320114', '雨花台区', '3', '320100');
INSERT INTO `os_district` VALUES ('320115', '江宁区', '3', '320100');
INSERT INTO `os_district` VALUES ('320116', '六合区', '3', '320100');
INSERT INTO `os_district` VALUES ('320124', '溧水县', '3', '320100');
INSERT INTO `os_district` VALUES ('320125', '高淳县', '3', '320100');
INSERT INTO `os_district` VALUES ('320201', '市辖区', '3', '320200');
INSERT INTO `os_district` VALUES ('320202', '崇安区', '3', '320200');
INSERT INTO `os_district` VALUES ('320203', '南长区', '3', '320200');
INSERT INTO `os_district` VALUES ('320204', '北塘区', '3', '320200');
INSERT INTO `os_district` VALUES ('320205', '锡山区', '3', '320200');
INSERT INTO `os_district` VALUES ('320206', '惠山区', '3', '320200');
INSERT INTO `os_district` VALUES ('320211', '滨湖区', '3', '320200');
INSERT INTO `os_district` VALUES ('320281', '江阴市', '3', '320200');
INSERT INTO `os_district` VALUES ('320282', '宜兴市', '3', '320200');
INSERT INTO `os_district` VALUES ('320301', '市辖区', '3', '320300');
INSERT INTO `os_district` VALUES ('320302', '鼓楼区', '3', '320300');
INSERT INTO `os_district` VALUES ('320303', '云龙区', '3', '320300');
INSERT INTO `os_district` VALUES ('320304', '九里区', '3', '320300');
INSERT INTO `os_district` VALUES ('320305', '贾汪区', '3', '320300');
INSERT INTO `os_district` VALUES ('320311', '泉山区', '3', '320300');
INSERT INTO `os_district` VALUES ('320321', '丰　县', '3', '320300');
INSERT INTO `os_district` VALUES ('320322', '沛　县', '3', '320300');
INSERT INTO `os_district` VALUES ('320323', '铜山县', '3', '320300');
INSERT INTO `os_district` VALUES ('320324', '睢宁县', '3', '320300');
INSERT INTO `os_district` VALUES ('320381', '新沂市', '3', '320300');
INSERT INTO `os_district` VALUES ('320382', '邳州市', '3', '320300');
INSERT INTO `os_district` VALUES ('320401', '市辖区', '3', '320400');
INSERT INTO `os_district` VALUES ('320402', '天宁区', '3', '320400');
INSERT INTO `os_district` VALUES ('320404', '钟楼区', '3', '320400');
INSERT INTO `os_district` VALUES ('320405', '戚墅堰区', '3', '320400');
INSERT INTO `os_district` VALUES ('320411', '新北区', '3', '320400');
INSERT INTO `os_district` VALUES ('320412', '武进区', '3', '320400');
INSERT INTO `os_district` VALUES ('320481', '溧阳市', '3', '320400');
INSERT INTO `os_district` VALUES ('320482', '金坛市', '3', '320400');
INSERT INTO `os_district` VALUES ('320501', '市辖区', '3', '320500');
INSERT INTO `os_district` VALUES ('320502', '沧浪区', '3', '320500');
INSERT INTO `os_district` VALUES ('320503', '平江区', '3', '320500');
INSERT INTO `os_district` VALUES ('320504', '金阊区', '3', '320500');
INSERT INTO `os_district` VALUES ('320505', '虎丘区', '3', '320500');
INSERT INTO `os_district` VALUES ('320506', '吴中区', '3', '320500');
INSERT INTO `os_district` VALUES ('320507', '相城区', '3', '320500');
INSERT INTO `os_district` VALUES ('320581', '常熟市', '3', '320500');
INSERT INTO `os_district` VALUES ('320582', '张家港市', '3', '320500');
INSERT INTO `os_district` VALUES ('320583', '昆山市', '3', '320500');
INSERT INTO `os_district` VALUES ('320584', '吴江市', '3', '320500');
INSERT INTO `os_district` VALUES ('320585', '太仓市', '3', '320500');
INSERT INTO `os_district` VALUES ('320601', '市辖区', '3', '320600');
INSERT INTO `os_district` VALUES ('320602', '崇川区', '3', '320600');
INSERT INTO `os_district` VALUES ('320611', '港闸区', '3', '320600');
INSERT INTO `os_district` VALUES ('320621', '海安县', '3', '320600');
INSERT INTO `os_district` VALUES ('320623', '如东县', '3', '320600');
INSERT INTO `os_district` VALUES ('320681', '启东市', '3', '320600');
INSERT INTO `os_district` VALUES ('320682', '如皋市', '3', '320600');
INSERT INTO `os_district` VALUES ('320683', '通州市', '3', '320600');
INSERT INTO `os_district` VALUES ('320684', '海门市', '3', '320600');
INSERT INTO `os_district` VALUES ('320701', '市辖区', '3', '320700');
INSERT INTO `os_district` VALUES ('320703', '连云区', '3', '320700');
INSERT INTO `os_district` VALUES ('320705', '新浦区', '3', '320700');
INSERT INTO `os_district` VALUES ('320706', '海州区', '3', '320700');
INSERT INTO `os_district` VALUES ('320721', '赣榆县', '3', '320700');
INSERT INTO `os_district` VALUES ('320722', '东海县', '3', '320700');
INSERT INTO `os_district` VALUES ('320723', '灌云县', '3', '320700');
INSERT INTO `os_district` VALUES ('320724', '灌南县', '3', '320700');
INSERT INTO `os_district` VALUES ('320801', '市辖区', '3', '320800');
INSERT INTO `os_district` VALUES ('320802', '清河区', '3', '320800');
INSERT INTO `os_district` VALUES ('320803', '楚州区', '3', '320800');
INSERT INTO `os_district` VALUES ('320804', '淮阴区', '3', '320800');
INSERT INTO `os_district` VALUES ('320811', '清浦区', '3', '320800');
INSERT INTO `os_district` VALUES ('320826', '涟水县', '3', '320800');
INSERT INTO `os_district` VALUES ('320829', '洪泽县', '3', '320800');
INSERT INTO `os_district` VALUES ('320830', '盱眙县', '3', '320800');
INSERT INTO `os_district` VALUES ('320831', '金湖县', '3', '320800');
INSERT INTO `os_district` VALUES ('320901', '市辖区', '3', '320900');
INSERT INTO `os_district` VALUES ('320902', '亭湖区', '3', '320900');
INSERT INTO `os_district` VALUES ('320903', '盐都区', '3', '320900');
INSERT INTO `os_district` VALUES ('320921', '响水县', '3', '320900');
INSERT INTO `os_district` VALUES ('320922', '滨海县', '3', '320900');
INSERT INTO `os_district` VALUES ('320923', '阜宁县', '3', '320900');
INSERT INTO `os_district` VALUES ('320924', '射阳县', '3', '320900');
INSERT INTO `os_district` VALUES ('320925', '建湖县', '3', '320900');
INSERT INTO `os_district` VALUES ('320981', '东台市', '3', '320900');
INSERT INTO `os_district` VALUES ('320982', '大丰市', '3', '320900');
INSERT INTO `os_district` VALUES ('321001', '市辖区', '3', '321000');
INSERT INTO `os_district` VALUES ('321002', '广陵区', '3', '321000');
INSERT INTO `os_district` VALUES ('321003', '邗江区', '3', '321000');
INSERT INTO `os_district` VALUES ('321011', '郊　区', '3', '321000');
INSERT INTO `os_district` VALUES ('321023', '宝应县', '3', '321000');
INSERT INTO `os_district` VALUES ('321081', '仪征市', '3', '321000');
INSERT INTO `os_district` VALUES ('321084', '高邮市', '3', '321000');
INSERT INTO `os_district` VALUES ('321088', '江都市', '3', '321000');
INSERT INTO `os_district` VALUES ('321101', '市辖区', '3', '321100');
INSERT INTO `os_district` VALUES ('321102', '京口区', '3', '321100');
INSERT INTO `os_district` VALUES ('321111', '润州区', '3', '321100');
INSERT INTO `os_district` VALUES ('321112', '丹徒区', '3', '321100');
INSERT INTO `os_district` VALUES ('321181', '丹阳市', '3', '321100');
INSERT INTO `os_district` VALUES ('321182', '扬中市', '3', '321100');
INSERT INTO `os_district` VALUES ('321183', '句容市', '3', '321100');
INSERT INTO `os_district` VALUES ('321201', '市辖区', '3', '321200');
INSERT INTO `os_district` VALUES ('321202', '海陵区', '3', '321200');
INSERT INTO `os_district` VALUES ('321203', '高港区', '3', '321200');
INSERT INTO `os_district` VALUES ('321281', '兴化市', '3', '321200');
INSERT INTO `os_district` VALUES ('321282', '靖江市', '3', '321200');
INSERT INTO `os_district` VALUES ('321283', '泰兴市', '3', '321200');
INSERT INTO `os_district` VALUES ('321284', '姜堰市', '3', '321200');
INSERT INTO `os_district` VALUES ('321301', '市辖区', '3', '321300');
INSERT INTO `os_district` VALUES ('321302', '宿城区', '3', '321300');
INSERT INTO `os_district` VALUES ('321311', '宿豫区', '3', '321300');
INSERT INTO `os_district` VALUES ('321322', '沭阳县', '3', '321300');
INSERT INTO `os_district` VALUES ('321323', '泗阳县', '3', '321300');
INSERT INTO `os_district` VALUES ('321324', '泗洪县', '3', '321300');
INSERT INTO `os_district` VALUES ('330101', '市辖区', '3', '330100');
INSERT INTO `os_district` VALUES ('330102', '上城区', '3', '330100');
INSERT INTO `os_district` VALUES ('330103', '下城区', '3', '330100');
INSERT INTO `os_district` VALUES ('330104', '江干区', '3', '330100');
INSERT INTO `os_district` VALUES ('330105', '拱墅区', '3', '330100');
INSERT INTO `os_district` VALUES ('330106', '西湖区', '3', '330100');
INSERT INTO `os_district` VALUES ('330108', '滨江区', '3', '330100');
INSERT INTO `os_district` VALUES ('330109', '萧山区', '3', '330100');
INSERT INTO `os_district` VALUES ('330110', '余杭区', '3', '330100');
INSERT INTO `os_district` VALUES ('330122', '桐庐县', '3', '330100');
INSERT INTO `os_district` VALUES ('330127', '淳安县', '3', '330100');
INSERT INTO `os_district` VALUES ('330182', '建德市', '3', '330100');
INSERT INTO `os_district` VALUES ('330183', '富阳市', '3', '330100');
INSERT INTO `os_district` VALUES ('330185', '临安市', '3', '330100');
INSERT INTO `os_district` VALUES ('330201', '市辖区', '3', '330200');
INSERT INTO `os_district` VALUES ('330203', '海曙区', '3', '330200');
INSERT INTO `os_district` VALUES ('330204', '江东区', '3', '330200');
INSERT INTO `os_district` VALUES ('330205', '江北区', '3', '330200');
INSERT INTO `os_district` VALUES ('330206', '北仑区', '3', '330200');
INSERT INTO `os_district` VALUES ('330211', '镇海区', '3', '330200');
INSERT INTO `os_district` VALUES ('330212', '鄞州区', '3', '330200');
INSERT INTO `os_district` VALUES ('330225', '象山县', '3', '330200');
INSERT INTO `os_district` VALUES ('330226', '宁海县', '3', '330200');
INSERT INTO `os_district` VALUES ('330281', '余姚市', '3', '330200');
INSERT INTO `os_district` VALUES ('330282', '慈溪市', '3', '330200');
INSERT INTO `os_district` VALUES ('330283', '奉化市', '3', '330200');
INSERT INTO `os_district` VALUES ('330301', '市辖区', '3', '330300');
INSERT INTO `os_district` VALUES ('330302', '鹿城区', '3', '330300');
INSERT INTO `os_district` VALUES ('330303', '龙湾区', '3', '330300');
INSERT INTO `os_district` VALUES ('330304', '瓯海区', '3', '330300');
INSERT INTO `os_district` VALUES ('330322', '洞头县', '3', '330300');
INSERT INTO `os_district` VALUES ('330324', '永嘉县', '3', '330300');
INSERT INTO `os_district` VALUES ('330326', '平阳县', '3', '330300');
INSERT INTO `os_district` VALUES ('330327', '苍南县', '3', '330300');
INSERT INTO `os_district` VALUES ('330328', '文成县', '3', '330300');
INSERT INTO `os_district` VALUES ('330329', '泰顺县', '3', '330300');
INSERT INTO `os_district` VALUES ('330381', '瑞安市', '3', '330300');
INSERT INTO `os_district` VALUES ('330382', '乐清市', '3', '330300');
INSERT INTO `os_district` VALUES ('330401', '市辖区', '3', '330400');
INSERT INTO `os_district` VALUES ('330402', '秀城区', '3', '330400');
INSERT INTO `os_district` VALUES ('330411', '秀洲区', '3', '330400');
INSERT INTO `os_district` VALUES ('330421', '嘉善县', '3', '330400');
INSERT INTO `os_district` VALUES ('330424', '海盐县', '3', '330400');
INSERT INTO `os_district` VALUES ('330481', '海宁市', '3', '330400');
INSERT INTO `os_district` VALUES ('330482', '平湖市', '3', '330400');
INSERT INTO `os_district` VALUES ('330483', '桐乡市', '3', '330400');
INSERT INTO `os_district` VALUES ('330501', '市辖区', '3', '330500');
INSERT INTO `os_district` VALUES ('330502', '吴兴区', '3', '330500');
INSERT INTO `os_district` VALUES ('330503', '南浔区', '3', '330500');
INSERT INTO `os_district` VALUES ('330521', '德清县', '3', '330500');
INSERT INTO `os_district` VALUES ('330522', '长兴县', '3', '330500');
INSERT INTO `os_district` VALUES ('330523', '安吉县', '3', '330500');
INSERT INTO `os_district` VALUES ('330601', '市辖区', '3', '330600');
INSERT INTO `os_district` VALUES ('330602', '越城区', '3', '330600');
INSERT INTO `os_district` VALUES ('330621', '绍兴县', '3', '330600');
INSERT INTO `os_district` VALUES ('330624', '新昌县', '3', '330600');
INSERT INTO `os_district` VALUES ('330681', '诸暨市', '3', '330600');
INSERT INTO `os_district` VALUES ('330682', '上虞市', '3', '330600');
INSERT INTO `os_district` VALUES ('330683', '嵊州市', '3', '330600');
INSERT INTO `os_district` VALUES ('330701', '市辖区', '3', '330700');
INSERT INTO `os_district` VALUES ('330702', '婺城区', '3', '330700');
INSERT INTO `os_district` VALUES ('330703', '金东区', '3', '330700');
INSERT INTO `os_district` VALUES ('330723', '武义县', '3', '330700');
INSERT INTO `os_district` VALUES ('330726', '浦江县', '3', '330700');
INSERT INTO `os_district` VALUES ('330727', '磐安县', '3', '330700');
INSERT INTO `os_district` VALUES ('330781', '兰溪市', '3', '330700');
INSERT INTO `os_district` VALUES ('330782', '义乌市', '3', '330700');
INSERT INTO `os_district` VALUES ('330783', '东阳市', '3', '330700');
INSERT INTO `os_district` VALUES ('330784', '永康市', '3', '330700');
INSERT INTO `os_district` VALUES ('330801', '市辖区', '3', '330800');
INSERT INTO `os_district` VALUES ('330802', '柯城区', '3', '330800');
INSERT INTO `os_district` VALUES ('330803', '衢江区', '3', '330800');
INSERT INTO `os_district` VALUES ('330822', '常山县', '3', '330800');
INSERT INTO `os_district` VALUES ('330824', '开化县', '3', '330800');
INSERT INTO `os_district` VALUES ('330825', '龙游县', '3', '330800');
INSERT INTO `os_district` VALUES ('330881', '江山市', '3', '330800');
INSERT INTO `os_district` VALUES ('330901', '市辖区', '3', '330900');
INSERT INTO `os_district` VALUES ('330902', '定海区', '3', '330900');
INSERT INTO `os_district` VALUES ('330903', '普陀区', '3', '330900');
INSERT INTO `os_district` VALUES ('330921', '岱山县', '3', '330900');
INSERT INTO `os_district` VALUES ('330922', '嵊泗县', '3', '330900');
INSERT INTO `os_district` VALUES ('331001', '市辖区', '3', '331000');
INSERT INTO `os_district` VALUES ('331002', '椒江区', '3', '331000');
INSERT INTO `os_district` VALUES ('331003', '黄岩区', '3', '331000');
INSERT INTO `os_district` VALUES ('331004', '路桥区', '3', '331000');
INSERT INTO `os_district` VALUES ('331021', '玉环县', '3', '331000');
INSERT INTO `os_district` VALUES ('331022', '三门县', '3', '331000');
INSERT INTO `os_district` VALUES ('331023', '天台县', '3', '331000');
INSERT INTO `os_district` VALUES ('331024', '仙居县', '3', '331000');
INSERT INTO `os_district` VALUES ('331081', '温岭市', '3', '331000');
INSERT INTO `os_district` VALUES ('331082', '临海市', '3', '331000');
INSERT INTO `os_district` VALUES ('331101', '市辖区', '3', '331100');
INSERT INTO `os_district` VALUES ('331102', '莲都区', '3', '331100');
INSERT INTO `os_district` VALUES ('331121', '青田县', '3', '331100');
INSERT INTO `os_district` VALUES ('331122', '缙云县', '3', '331100');
INSERT INTO `os_district` VALUES ('331123', '遂昌县', '3', '331100');
INSERT INTO `os_district` VALUES ('331124', '松阳县', '3', '331100');
INSERT INTO `os_district` VALUES ('331125', '云和县', '3', '331100');
INSERT INTO `os_district` VALUES ('331126', '庆元县', '3', '331100');
INSERT INTO `os_district` VALUES ('331127', '景宁畲族自治县', '3', '331100');
INSERT INTO `os_district` VALUES ('331181', '龙泉市', '3', '331100');
INSERT INTO `os_district` VALUES ('340101', '市辖区', '3', '340100');
INSERT INTO `os_district` VALUES ('340102', '瑶海区', '3', '340100');
INSERT INTO `os_district` VALUES ('340103', '庐阳区', '3', '340100');
INSERT INTO `os_district` VALUES ('340104', '蜀山区', '3', '340100');
INSERT INTO `os_district` VALUES ('340111', '包河区', '3', '340100');
INSERT INTO `os_district` VALUES ('340121', '长丰县', '3', '340100');
INSERT INTO `os_district` VALUES ('340122', '肥东县', '3', '340100');
INSERT INTO `os_district` VALUES ('340123', '肥西县', '3', '340100');
INSERT INTO `os_district` VALUES ('340201', '市辖区', '3', '340200');
INSERT INTO `os_district` VALUES ('340202', '镜湖区', '3', '340200');
INSERT INTO `os_district` VALUES ('340203', '马塘区', '3', '340200');
INSERT INTO `os_district` VALUES ('340204', '新芜区', '3', '340200');
INSERT INTO `os_district` VALUES ('340207', '鸠江区', '3', '340200');
INSERT INTO `os_district` VALUES ('340221', '芜湖县', '3', '340200');
INSERT INTO `os_district` VALUES ('340222', '繁昌县', '3', '340200');
INSERT INTO `os_district` VALUES ('340223', '南陵县', '3', '340200');
INSERT INTO `os_district` VALUES ('340301', '市辖区', '3', '340300');
INSERT INTO `os_district` VALUES ('340302', '龙子湖区', '3', '340300');
INSERT INTO `os_district` VALUES ('340303', '蚌山区', '3', '340300');
INSERT INTO `os_district` VALUES ('340304', '禹会区', '3', '340300');
INSERT INTO `os_district` VALUES ('340311', '淮上区', '3', '340300');
INSERT INTO `os_district` VALUES ('340321', '怀远县', '3', '340300');
INSERT INTO `os_district` VALUES ('340322', '五河县', '3', '340300');
INSERT INTO `os_district` VALUES ('340323', '固镇县', '3', '340300');
INSERT INTO `os_district` VALUES ('340401', '市辖区', '3', '340400');
INSERT INTO `os_district` VALUES ('340402', '大通区', '3', '340400');
INSERT INTO `os_district` VALUES ('340403', '田家庵区', '3', '340400');
INSERT INTO `os_district` VALUES ('340404', '谢家集区', '3', '340400');
INSERT INTO `os_district` VALUES ('340405', '八公山区', '3', '340400');
INSERT INTO `os_district` VALUES ('340406', '潘集区', '3', '340400');
INSERT INTO `os_district` VALUES ('340421', '凤台县', '3', '340400');
INSERT INTO `os_district` VALUES ('340501', '市辖区', '3', '340500');
INSERT INTO `os_district` VALUES ('340502', '金家庄区', '3', '340500');
INSERT INTO `os_district` VALUES ('340503', '花山区', '3', '340500');
INSERT INTO `os_district` VALUES ('340504', '雨山区', '3', '340500');
INSERT INTO `os_district` VALUES ('340521', '当涂县', '3', '340500');
INSERT INTO `os_district` VALUES ('340601', '市辖区', '3', '340600');
INSERT INTO `os_district` VALUES ('340602', '杜集区', '3', '340600');
INSERT INTO `os_district` VALUES ('340603', '相山区', '3', '340600');
INSERT INTO `os_district` VALUES ('340604', '烈山区', '3', '340600');
INSERT INTO `os_district` VALUES ('340621', '濉溪县', '3', '340600');
INSERT INTO `os_district` VALUES ('340701', '市辖区', '3', '340700');
INSERT INTO `os_district` VALUES ('340702', '铜官山区', '3', '340700');
INSERT INTO `os_district` VALUES ('340703', '狮子山区', '3', '340700');
INSERT INTO `os_district` VALUES ('340711', '郊　区', '3', '340700');
INSERT INTO `os_district` VALUES ('340721', '铜陵县', '3', '340700');
INSERT INTO `os_district` VALUES ('340801', '市辖区', '3', '340800');
INSERT INTO `os_district` VALUES ('340802', '迎江区', '3', '340800');
INSERT INTO `os_district` VALUES ('340803', '大观区', '3', '340800');
INSERT INTO `os_district` VALUES ('340811', '郊　区', '3', '340800');
INSERT INTO `os_district` VALUES ('340822', '怀宁县', '3', '340800');
INSERT INTO `os_district` VALUES ('340823', '枞阳县', '3', '340800');
INSERT INTO `os_district` VALUES ('340824', '潜山县', '3', '340800');
INSERT INTO `os_district` VALUES ('340825', '太湖县', '3', '340800');
INSERT INTO `os_district` VALUES ('340826', '宿松县', '3', '340800');
INSERT INTO `os_district` VALUES ('340827', '望江县', '3', '340800');
INSERT INTO `os_district` VALUES ('340828', '岳西县', '3', '340800');
INSERT INTO `os_district` VALUES ('340881', '桐城市', '3', '340800');
INSERT INTO `os_district` VALUES ('341001', '市辖区', '3', '341000');
INSERT INTO `os_district` VALUES ('341002', '屯溪区', '3', '341000');
INSERT INTO `os_district` VALUES ('341003', '黄山区', '3', '341000');
INSERT INTO `os_district` VALUES ('341004', '徽州区', '3', '341000');
INSERT INTO `os_district` VALUES ('341021', '歙　县', '3', '341000');
INSERT INTO `os_district` VALUES ('341022', '休宁县', '3', '341000');
INSERT INTO `os_district` VALUES ('341023', '黟　县', '3', '341000');
INSERT INTO `os_district` VALUES ('341024', '祁门县', '3', '341000');
INSERT INTO `os_district` VALUES ('341101', '市辖区', '3', '341100');
INSERT INTO `os_district` VALUES ('341102', '琅琊区', '3', '341100');
INSERT INTO `os_district` VALUES ('341103', '南谯区', '3', '341100');
INSERT INTO `os_district` VALUES ('341122', '来安县', '3', '341100');
INSERT INTO `os_district` VALUES ('341124', '全椒县', '3', '341100');
INSERT INTO `os_district` VALUES ('341125', '定远县', '3', '341100');
INSERT INTO `os_district` VALUES ('341126', '凤阳县', '3', '341100');
INSERT INTO `os_district` VALUES ('341181', '天长市', '3', '341100');
INSERT INTO `os_district` VALUES ('341182', '明光市', '3', '341100');
INSERT INTO `os_district` VALUES ('341201', '市辖区', '3', '341200');
INSERT INTO `os_district` VALUES ('341202', '颍州区', '3', '341200');
INSERT INTO `os_district` VALUES ('341203', '颍东区', '3', '341200');
INSERT INTO `os_district` VALUES ('341204', '颍泉区', '3', '341200');
INSERT INTO `os_district` VALUES ('341221', '临泉县', '3', '341200');
INSERT INTO `os_district` VALUES ('341222', '太和县', '3', '341200');
INSERT INTO `os_district` VALUES ('341225', '阜南县', '3', '341200');
INSERT INTO `os_district` VALUES ('341226', '颍上县', '3', '341200');
INSERT INTO `os_district` VALUES ('341282', '界首市', '3', '341200');
INSERT INTO `os_district` VALUES ('341301', '市辖区', '3', '341300');
INSERT INTO `os_district` VALUES ('341302', '墉桥区', '3', '341300');
INSERT INTO `os_district` VALUES ('341321', '砀山县', '3', '341300');
INSERT INTO `os_district` VALUES ('341322', '萧　县', '3', '341300');
INSERT INTO `os_district` VALUES ('341323', '灵璧县', '3', '341300');
INSERT INTO `os_district` VALUES ('341324', '泗　县', '3', '341300');
INSERT INTO `os_district` VALUES ('341401', '庐江县', '3', '340100');
INSERT INTO `os_district` VALUES ('341402', '巢湖市', '3', '340100');
INSERT INTO `os_district` VALUES ('341422', '无为县', '3', '340200');
INSERT INTO `os_district` VALUES ('341423', '含山县', '3', '340500');
INSERT INTO `os_district` VALUES ('341424', '和　县', '3', '340500');
INSERT INTO `os_district` VALUES ('341501', '市辖区', '3', '341500');
INSERT INTO `os_district` VALUES ('341502', '金安区', '3', '341500');
INSERT INTO `os_district` VALUES ('341503', '裕安区', '3', '341500');
INSERT INTO `os_district` VALUES ('341521', '寿　县', '3', '341500');
INSERT INTO `os_district` VALUES ('341522', '霍邱县', '3', '341500');
INSERT INTO `os_district` VALUES ('341523', '舒城县', '3', '341500');
INSERT INTO `os_district` VALUES ('341524', '金寨县', '3', '341500');
INSERT INTO `os_district` VALUES ('341525', '霍山县', '3', '341500');
INSERT INTO `os_district` VALUES ('341601', '市辖区', '3', '341600');
INSERT INTO `os_district` VALUES ('341602', '谯城区', '3', '341600');
INSERT INTO `os_district` VALUES ('341621', '涡阳县', '3', '341600');
INSERT INTO `os_district` VALUES ('341622', '蒙城县', '3', '341600');
INSERT INTO `os_district` VALUES ('341623', '利辛县', '3', '341600');
INSERT INTO `os_district` VALUES ('341701', '市辖区', '3', '341700');
INSERT INTO `os_district` VALUES ('341702', '贵池区', '3', '341700');
INSERT INTO `os_district` VALUES ('341721', '东至县', '3', '341700');
INSERT INTO `os_district` VALUES ('341722', '石台县', '3', '341700');
INSERT INTO `os_district` VALUES ('341723', '青阳县', '3', '341700');
INSERT INTO `os_district` VALUES ('341801', '市辖区', '3', '341800');
INSERT INTO `os_district` VALUES ('341802', '宣州区', '3', '341800');
INSERT INTO `os_district` VALUES ('341821', '郎溪县', '3', '341800');
INSERT INTO `os_district` VALUES ('341822', '广德县', '3', '341800');
INSERT INTO `os_district` VALUES ('341823', '泾　县', '3', '341800');
INSERT INTO `os_district` VALUES ('341824', '绩溪县', '3', '341800');
INSERT INTO `os_district` VALUES ('341825', '旌德县', '3', '341800');
INSERT INTO `os_district` VALUES ('341881', '宁国市', '3', '341800');
INSERT INTO `os_district` VALUES ('350101', '市辖区', '3', '350100');
INSERT INTO `os_district` VALUES ('350102', '鼓楼区', '3', '350100');
INSERT INTO `os_district` VALUES ('350103', '台江区', '3', '350100');
INSERT INTO `os_district` VALUES ('350104', '仓山区', '3', '350100');
INSERT INTO `os_district` VALUES ('350105', '马尾区', '3', '350100');
INSERT INTO `os_district` VALUES ('350111', '晋安区', '3', '350100');
INSERT INTO `os_district` VALUES ('350121', '闽侯县', '3', '350100');
INSERT INTO `os_district` VALUES ('350122', '连江县', '3', '350100');
INSERT INTO `os_district` VALUES ('350123', '罗源县', '3', '350100');
INSERT INTO `os_district` VALUES ('350124', '闽清县', '3', '350100');
INSERT INTO `os_district` VALUES ('350125', '永泰县', '3', '350100');
INSERT INTO `os_district` VALUES ('350128', '平潭县', '3', '350100');
INSERT INTO `os_district` VALUES ('350181', '福清市', '3', '350100');
INSERT INTO `os_district` VALUES ('350182', '长乐市', '3', '350100');
INSERT INTO `os_district` VALUES ('350201', '市辖区', '3', '350200');
INSERT INTO `os_district` VALUES ('350203', '思明区', '3', '350200');
INSERT INTO `os_district` VALUES ('350205', '海沧区', '3', '350200');
INSERT INTO `os_district` VALUES ('350206', '湖里区', '3', '350200');
INSERT INTO `os_district` VALUES ('350211', '集美区', '3', '350200');
INSERT INTO `os_district` VALUES ('350212', '同安区', '3', '350200');
INSERT INTO `os_district` VALUES ('350213', '翔安区', '3', '350200');
INSERT INTO `os_district` VALUES ('350301', '市辖区', '3', '350300');
INSERT INTO `os_district` VALUES ('350302', '城厢区', '3', '350300');
INSERT INTO `os_district` VALUES ('350303', '涵江区', '3', '350300');
INSERT INTO `os_district` VALUES ('350304', '荔城区', '3', '350300');
INSERT INTO `os_district` VALUES ('350305', '秀屿区', '3', '350300');
INSERT INTO `os_district` VALUES ('350322', '仙游县', '3', '350300');
INSERT INTO `os_district` VALUES ('350401', '市辖区', '3', '350400');
INSERT INTO `os_district` VALUES ('350402', '梅列区', '3', '350400');
INSERT INTO `os_district` VALUES ('350403', '三元区', '3', '350400');
INSERT INTO `os_district` VALUES ('350421', '明溪县', '3', '350400');
INSERT INTO `os_district` VALUES ('350423', '清流县', '3', '350400');
INSERT INTO `os_district` VALUES ('350424', '宁化县', '3', '350400');
INSERT INTO `os_district` VALUES ('350425', '大田县', '3', '350400');
INSERT INTO `os_district` VALUES ('350426', '尤溪县', '3', '350400');
INSERT INTO `os_district` VALUES ('350427', '沙　县', '3', '350400');
INSERT INTO `os_district` VALUES ('350428', '将乐县', '3', '350400');
INSERT INTO `os_district` VALUES ('350429', '泰宁县', '3', '350400');
INSERT INTO `os_district` VALUES ('350430', '建宁县', '3', '350400');
INSERT INTO `os_district` VALUES ('350481', '永安市', '3', '350400');
INSERT INTO `os_district` VALUES ('350501', '市辖区', '3', '350500');
INSERT INTO `os_district` VALUES ('350502', '鲤城区', '3', '350500');
INSERT INTO `os_district` VALUES ('350503', '丰泽区', '3', '350500');
INSERT INTO `os_district` VALUES ('350504', '洛江区', '3', '350500');
INSERT INTO `os_district` VALUES ('350505', '泉港区', '3', '350500');
INSERT INTO `os_district` VALUES ('350521', '惠安县', '3', '350500');
INSERT INTO `os_district` VALUES ('350524', '安溪县', '3', '350500');
INSERT INTO `os_district` VALUES ('350525', '永春县', '3', '350500');
INSERT INTO `os_district` VALUES ('350526', '德化县', '3', '350500');
INSERT INTO `os_district` VALUES ('350527', '金门县', '3', '350500');
INSERT INTO `os_district` VALUES ('350581', '石狮市', '3', '350500');
INSERT INTO `os_district` VALUES ('350582', '晋江市', '3', '350500');
INSERT INTO `os_district` VALUES ('350583', '南安市', '3', '350500');
INSERT INTO `os_district` VALUES ('350601', '市辖区', '3', '350600');
INSERT INTO `os_district` VALUES ('350602', '芗城区', '3', '350600');
INSERT INTO `os_district` VALUES ('350603', '龙文区', '3', '350600');
INSERT INTO `os_district` VALUES ('350622', '云霄县', '3', '350600');
INSERT INTO `os_district` VALUES ('350623', '漳浦县', '3', '350600');
INSERT INTO `os_district` VALUES ('350624', '诏安县', '3', '350600');
INSERT INTO `os_district` VALUES ('350625', '长泰县', '3', '350600');
INSERT INTO `os_district` VALUES ('350626', '东山县', '3', '350600');
INSERT INTO `os_district` VALUES ('350627', '南靖县', '3', '350600');
INSERT INTO `os_district` VALUES ('350628', '平和县', '3', '350600');
INSERT INTO `os_district` VALUES ('350629', '华安县', '3', '350600');
INSERT INTO `os_district` VALUES ('350681', '龙海市', '3', '350600');
INSERT INTO `os_district` VALUES ('350701', '市辖区', '3', '350700');
INSERT INTO `os_district` VALUES ('350702', '延平区', '3', '350700');
INSERT INTO `os_district` VALUES ('350721', '顺昌县', '3', '350700');
INSERT INTO `os_district` VALUES ('350722', '浦城县', '3', '350700');
INSERT INTO `os_district` VALUES ('350723', '光泽县', '3', '350700');
INSERT INTO `os_district` VALUES ('350724', '松溪县', '3', '350700');
INSERT INTO `os_district` VALUES ('350725', '政和县', '3', '350700');
INSERT INTO `os_district` VALUES ('350781', '邵武市', '3', '350700');
INSERT INTO `os_district` VALUES ('350782', '武夷山市', '3', '350700');
INSERT INTO `os_district` VALUES ('350783', '建瓯市', '3', '350700');
INSERT INTO `os_district` VALUES ('350784', '建阳市', '3', '350700');
INSERT INTO `os_district` VALUES ('350801', '市辖区', '3', '350800');
INSERT INTO `os_district` VALUES ('350802', '新罗区', '3', '350800');
INSERT INTO `os_district` VALUES ('350821', '长汀县', '3', '350800');
INSERT INTO `os_district` VALUES ('350822', '永定县', '3', '350800');
INSERT INTO `os_district` VALUES ('350823', '上杭县', '3', '350800');
INSERT INTO `os_district` VALUES ('350824', '武平县', '3', '350800');
INSERT INTO `os_district` VALUES ('350825', '连城县', '3', '350800');
INSERT INTO `os_district` VALUES ('350881', '漳平市', '3', '350800');
INSERT INTO `os_district` VALUES ('350901', '市辖区', '3', '350900');
INSERT INTO `os_district` VALUES ('350902', '蕉城区', '3', '350900');
INSERT INTO `os_district` VALUES ('350921', '霞浦县', '3', '350900');
INSERT INTO `os_district` VALUES ('350922', '古田县', '3', '350900');
INSERT INTO `os_district` VALUES ('350923', '屏南县', '3', '350900');
INSERT INTO `os_district` VALUES ('350924', '寿宁县', '3', '350900');
INSERT INTO `os_district` VALUES ('350925', '周宁县', '3', '350900');
INSERT INTO `os_district` VALUES ('350926', '柘荣县', '3', '350900');
INSERT INTO `os_district` VALUES ('350981', '福安市', '3', '350900');
INSERT INTO `os_district` VALUES ('350982', '福鼎市', '3', '350900');
INSERT INTO `os_district` VALUES ('360101', '市辖区', '3', '360100');
INSERT INTO `os_district` VALUES ('360102', '东湖区', '3', '360100');
INSERT INTO `os_district` VALUES ('360103', '西湖区', '3', '360100');
INSERT INTO `os_district` VALUES ('360104', '青云谱区', '3', '360100');
INSERT INTO `os_district` VALUES ('360105', '湾里区', '3', '360100');
INSERT INTO `os_district` VALUES ('360111', '青山湖区', '3', '360100');
INSERT INTO `os_district` VALUES ('360121', '南昌县', '3', '360100');
INSERT INTO `os_district` VALUES ('360122', '新建县', '3', '360100');
INSERT INTO `os_district` VALUES ('360123', '安义县', '3', '360100');
INSERT INTO `os_district` VALUES ('360124', '进贤县', '3', '360100');
INSERT INTO `os_district` VALUES ('360201', '市辖区', '3', '360200');
INSERT INTO `os_district` VALUES ('360202', '昌江区', '3', '360200');
INSERT INTO `os_district` VALUES ('360203', '珠山区', '3', '360200');
INSERT INTO `os_district` VALUES ('360222', '浮梁县', '3', '360200');
INSERT INTO `os_district` VALUES ('360281', '乐平市', '3', '360200');
INSERT INTO `os_district` VALUES ('360301', '市辖区', '3', '360300');
INSERT INTO `os_district` VALUES ('360302', '安源区', '3', '360300');
INSERT INTO `os_district` VALUES ('360313', '湘东区', '3', '360300');
INSERT INTO `os_district` VALUES ('360321', '莲花县', '3', '360300');
INSERT INTO `os_district` VALUES ('360322', '上栗县', '3', '360300');
INSERT INTO `os_district` VALUES ('360323', '芦溪县', '3', '360300');
INSERT INTO `os_district` VALUES ('360401', '市辖区', '3', '360400');
INSERT INTO `os_district` VALUES ('360402', '庐山区', '3', '360400');
INSERT INTO `os_district` VALUES ('360403', '浔阳区', '3', '360400');
INSERT INTO `os_district` VALUES ('360421', '九江县', '3', '360400');
INSERT INTO `os_district` VALUES ('360423', '武宁县', '3', '360400');
INSERT INTO `os_district` VALUES ('360424', '修水县', '3', '360400');
INSERT INTO `os_district` VALUES ('360425', '永修县', '3', '360400');
INSERT INTO `os_district` VALUES ('360426', '德安县', '3', '360400');
INSERT INTO `os_district` VALUES ('360427', '星子县', '3', '360400');
INSERT INTO `os_district` VALUES ('360428', '都昌县', '3', '360400');
INSERT INTO `os_district` VALUES ('360429', '湖口县', '3', '360400');
INSERT INTO `os_district` VALUES ('360430', '彭泽县', '3', '360400');
INSERT INTO `os_district` VALUES ('360481', '瑞昌市', '3', '360400');
INSERT INTO `os_district` VALUES ('360501', '市辖区', '3', '360500');
INSERT INTO `os_district` VALUES ('360502', '渝水区', '3', '360500');
INSERT INTO `os_district` VALUES ('360521', '分宜县', '3', '360500');
INSERT INTO `os_district` VALUES ('360601', '市辖区', '3', '360600');
INSERT INTO `os_district` VALUES ('360602', '月湖区', '3', '360600');
INSERT INTO `os_district` VALUES ('360622', '余江县', '3', '360600');
INSERT INTO `os_district` VALUES ('360681', '贵溪市', '3', '360600');
INSERT INTO `os_district` VALUES ('360701', '市辖区', '3', '360700');
INSERT INTO `os_district` VALUES ('360702', '章贡区', '3', '360700');
INSERT INTO `os_district` VALUES ('360721', '赣　县', '3', '360700');
INSERT INTO `os_district` VALUES ('360722', '信丰县', '3', '360700');
INSERT INTO `os_district` VALUES ('360723', '大余县', '3', '360700');
INSERT INTO `os_district` VALUES ('360724', '上犹县', '3', '360700');
INSERT INTO `os_district` VALUES ('360725', '崇义县', '3', '360700');
INSERT INTO `os_district` VALUES ('360726', '安远县', '3', '360700');
INSERT INTO `os_district` VALUES ('360727', '龙南县', '3', '360700');
INSERT INTO `os_district` VALUES ('360728', '定南县', '3', '360700');
INSERT INTO `os_district` VALUES ('360729', '全南县', '3', '360700');
INSERT INTO `os_district` VALUES ('360730', '宁都县', '3', '360700');
INSERT INTO `os_district` VALUES ('360731', '于都县', '3', '360700');
INSERT INTO `os_district` VALUES ('360732', '兴国县', '3', '360700');
INSERT INTO `os_district` VALUES ('360733', '会昌县', '3', '360700');
INSERT INTO `os_district` VALUES ('360734', '寻乌县', '3', '360700');
INSERT INTO `os_district` VALUES ('360735', '石城县', '3', '360700');
INSERT INTO `os_district` VALUES ('360781', '瑞金市', '3', '360700');
INSERT INTO `os_district` VALUES ('360782', '南康市', '3', '360700');
INSERT INTO `os_district` VALUES ('360801', '市辖区', '3', '360800');
INSERT INTO `os_district` VALUES ('360802', '吉州区', '3', '360800');
INSERT INTO `os_district` VALUES ('360803', '青原区', '3', '360800');
INSERT INTO `os_district` VALUES ('360821', '吉安县', '3', '360800');
INSERT INTO `os_district` VALUES ('360822', '吉水县', '3', '360800');
INSERT INTO `os_district` VALUES ('360823', '峡江县', '3', '360800');
INSERT INTO `os_district` VALUES ('360824', '新干县', '3', '360800');
INSERT INTO `os_district` VALUES ('360825', '永丰县', '3', '360800');
INSERT INTO `os_district` VALUES ('360826', '泰和县', '3', '360800');
INSERT INTO `os_district` VALUES ('360827', '遂川县', '3', '360800');
INSERT INTO `os_district` VALUES ('360828', '万安县', '3', '360800');
INSERT INTO `os_district` VALUES ('360829', '安福县', '3', '360800');
INSERT INTO `os_district` VALUES ('360830', '永新县', '3', '360800');
INSERT INTO `os_district` VALUES ('360881', '井冈山市', '3', '360800');
INSERT INTO `os_district` VALUES ('360901', '市辖区', '3', '360900');
INSERT INTO `os_district` VALUES ('360902', '袁州区', '3', '360900');
INSERT INTO `os_district` VALUES ('360921', '奉新县', '3', '360900');
INSERT INTO `os_district` VALUES ('360922', '万载县', '3', '360900');
INSERT INTO `os_district` VALUES ('360923', '上高县', '3', '360900');
INSERT INTO `os_district` VALUES ('360924', '宜丰县', '3', '360900');
INSERT INTO `os_district` VALUES ('360925', '靖安县', '3', '360900');
INSERT INTO `os_district` VALUES ('360926', '铜鼓县', '3', '360900');
INSERT INTO `os_district` VALUES ('360981', '丰城市', '3', '360900');
INSERT INTO `os_district` VALUES ('360982', '樟树市', '3', '360900');
INSERT INTO `os_district` VALUES ('360983', '高安市', '3', '360900');
INSERT INTO `os_district` VALUES ('361001', '市辖区', '3', '361000');
INSERT INTO `os_district` VALUES ('361002', '临川区', '3', '361000');
INSERT INTO `os_district` VALUES ('361021', '南城县', '3', '361000');
INSERT INTO `os_district` VALUES ('361022', '黎川县', '3', '361000');
INSERT INTO `os_district` VALUES ('361023', '南丰县', '3', '361000');
INSERT INTO `os_district` VALUES ('361024', '崇仁县', '3', '361000');
INSERT INTO `os_district` VALUES ('361025', '乐安县', '3', '361000');
INSERT INTO `os_district` VALUES ('361026', '宜黄县', '3', '361000');
INSERT INTO `os_district` VALUES ('361027', '金溪县', '3', '361000');
INSERT INTO `os_district` VALUES ('361028', '资溪县', '3', '361000');
INSERT INTO `os_district` VALUES ('361029', '东乡县', '3', '361000');
INSERT INTO `os_district` VALUES ('361030', '广昌县', '3', '361000');
INSERT INTO `os_district` VALUES ('361101', '市辖区', '3', '361100');
INSERT INTO `os_district` VALUES ('361102', '信州区', '3', '361100');
INSERT INTO `os_district` VALUES ('361121', '上饶县', '3', '361100');
INSERT INTO `os_district` VALUES ('361122', '广丰县', '3', '361100');
INSERT INTO `os_district` VALUES ('361123', '玉山县', '3', '361100');
INSERT INTO `os_district` VALUES ('361124', '铅山县', '3', '361100');
INSERT INTO `os_district` VALUES ('361125', '横峰县', '3', '361100');
INSERT INTO `os_district` VALUES ('361126', '弋阳县', '3', '361100');
INSERT INTO `os_district` VALUES ('361127', '余干县', '3', '361100');
INSERT INTO `os_district` VALUES ('361128', '鄱阳县', '3', '361100');
INSERT INTO `os_district` VALUES ('361129', '万年县', '3', '361100');
INSERT INTO `os_district` VALUES ('361130', '婺源县', '3', '361100');
INSERT INTO `os_district` VALUES ('361181', '德兴市', '3', '361100');
INSERT INTO `os_district` VALUES ('370101', '市辖区', '3', '370100');
INSERT INTO `os_district` VALUES ('370102', '历下区', '3', '370100');
INSERT INTO `os_district` VALUES ('370103', '市中区', '3', '370100');
INSERT INTO `os_district` VALUES ('370104', '槐荫区', '3', '370100');
INSERT INTO `os_district` VALUES ('370105', '天桥区', '3', '370100');
INSERT INTO `os_district` VALUES ('370112', '历城区', '3', '370100');
INSERT INTO `os_district` VALUES ('370113', '长清区', '3', '370100');
INSERT INTO `os_district` VALUES ('370124', '平阴县', '3', '370100');
INSERT INTO `os_district` VALUES ('370125', '济阳县', '3', '370100');
INSERT INTO `os_district` VALUES ('370126', '商河县', '3', '370100');
INSERT INTO `os_district` VALUES ('370181', '章丘市', '3', '370100');
INSERT INTO `os_district` VALUES ('370201', '市辖区', '3', '370200');
INSERT INTO `os_district` VALUES ('370202', '市南区', '3', '370200');
INSERT INTO `os_district` VALUES ('370203', '市北区', '3', '370200');
INSERT INTO `os_district` VALUES ('370205', '四方区', '3', '370200');
INSERT INTO `os_district` VALUES ('370211', '黄岛区', '3', '370200');
INSERT INTO `os_district` VALUES ('370212', '崂山区', '3', '370200');
INSERT INTO `os_district` VALUES ('370213', '李沧区', '3', '370200');
INSERT INTO `os_district` VALUES ('370214', '城阳区', '3', '370200');
INSERT INTO `os_district` VALUES ('370281', '胶州市', '3', '370200');
INSERT INTO `os_district` VALUES ('370282', '即墨市', '3', '370200');
INSERT INTO `os_district` VALUES ('370283', '平度市', '3', '370200');
INSERT INTO `os_district` VALUES ('370284', '胶南市', '3', '370200');
INSERT INTO `os_district` VALUES ('370285', '莱西市', '3', '370200');
INSERT INTO `os_district` VALUES ('370301', '市辖区', '3', '370300');
INSERT INTO `os_district` VALUES ('370302', '淄川区', '3', '370300');
INSERT INTO `os_district` VALUES ('370303', '张店区', '3', '370300');
INSERT INTO `os_district` VALUES ('370304', '博山区', '3', '370300');
INSERT INTO `os_district` VALUES ('370305', '临淄区', '3', '370300');
INSERT INTO `os_district` VALUES ('370306', '周村区', '3', '370300');
INSERT INTO `os_district` VALUES ('370321', '桓台县', '3', '370300');
INSERT INTO `os_district` VALUES ('370322', '高青县', '3', '370300');
INSERT INTO `os_district` VALUES ('370323', '沂源县', '3', '370300');
INSERT INTO `os_district` VALUES ('370401', '市辖区', '3', '370400');
INSERT INTO `os_district` VALUES ('370402', '市中区', '3', '370400');
INSERT INTO `os_district` VALUES ('370403', '薛城区', '3', '370400');
INSERT INTO `os_district` VALUES ('370404', '峄城区', '3', '370400');
INSERT INTO `os_district` VALUES ('370405', '台儿庄区', '3', '370400');
INSERT INTO `os_district` VALUES ('370406', '山亭区', '3', '370400');
INSERT INTO `os_district` VALUES ('370481', '滕州市', '3', '370400');
INSERT INTO `os_district` VALUES ('370501', '市辖区', '3', '370500');
INSERT INTO `os_district` VALUES ('370502', '东营区', '3', '370500');
INSERT INTO `os_district` VALUES ('370503', '河口区', '3', '370500');
INSERT INTO `os_district` VALUES ('370521', '垦利县', '3', '370500');
INSERT INTO `os_district` VALUES ('370522', '利津县', '3', '370500');
INSERT INTO `os_district` VALUES ('370523', '广饶县', '3', '370500');
INSERT INTO `os_district` VALUES ('370601', '市辖区', '3', '370600');
INSERT INTO `os_district` VALUES ('370602', '芝罘区', '3', '370600');
INSERT INTO `os_district` VALUES ('370611', '福山区', '3', '370600');
INSERT INTO `os_district` VALUES ('370612', '牟平区', '3', '370600');
INSERT INTO `os_district` VALUES ('370613', '莱山区', '3', '370600');
INSERT INTO `os_district` VALUES ('370634', '长岛县', '3', '370600');
INSERT INTO `os_district` VALUES ('370681', '龙口市', '3', '370600');
INSERT INTO `os_district` VALUES ('370682', '莱阳市', '3', '370600');
INSERT INTO `os_district` VALUES ('370683', '莱州市', '3', '370600');
INSERT INTO `os_district` VALUES ('370684', '蓬莱市', '3', '370600');
INSERT INTO `os_district` VALUES ('370685', '招远市', '3', '370600');
INSERT INTO `os_district` VALUES ('370686', '栖霞市', '3', '370600');
INSERT INTO `os_district` VALUES ('370687', '海阳市', '3', '370600');
INSERT INTO `os_district` VALUES ('370701', '市辖区', '3', '370700');
INSERT INTO `os_district` VALUES ('370702', '潍城区', '3', '370700');
INSERT INTO `os_district` VALUES ('370703', '寒亭区', '3', '370700');
INSERT INTO `os_district` VALUES ('370704', '坊子区', '3', '370700');
INSERT INTO `os_district` VALUES ('370705', '奎文区', '3', '370700');
INSERT INTO `os_district` VALUES ('370724', '临朐县', '3', '370700');
INSERT INTO `os_district` VALUES ('370725', '昌乐县', '3', '370700');
INSERT INTO `os_district` VALUES ('370781', '青州市', '3', '370700');
INSERT INTO `os_district` VALUES ('370782', '诸城市', '3', '370700');
INSERT INTO `os_district` VALUES ('370783', '寿光市', '3', '370700');
INSERT INTO `os_district` VALUES ('370784', '安丘市', '3', '370700');
INSERT INTO `os_district` VALUES ('370785', '高密市', '3', '370700');
INSERT INTO `os_district` VALUES ('370786', '昌邑市', '3', '370700');
INSERT INTO `os_district` VALUES ('370801', '市辖区', '3', '370800');
INSERT INTO `os_district` VALUES ('370802', '市中区', '3', '370800');
INSERT INTO `os_district` VALUES ('370811', '任城区', '3', '370800');
INSERT INTO `os_district` VALUES ('370826', '微山县', '3', '370800');
INSERT INTO `os_district` VALUES ('370827', '鱼台县', '3', '370800');
INSERT INTO `os_district` VALUES ('370828', '金乡县', '3', '370800');
INSERT INTO `os_district` VALUES ('370829', '嘉祥县', '3', '370800');
INSERT INTO `os_district` VALUES ('370830', '汶上县', '3', '370800');
INSERT INTO `os_district` VALUES ('370831', '泗水县', '3', '370800');
INSERT INTO `os_district` VALUES ('370832', '梁山县', '3', '370800');
INSERT INTO `os_district` VALUES ('370881', '曲阜市', '3', '370800');
INSERT INTO `os_district` VALUES ('370882', '兖州市', '3', '370800');
INSERT INTO `os_district` VALUES ('370883', '邹城市', '3', '370800');
INSERT INTO `os_district` VALUES ('370901', '市辖区', '3', '370900');
INSERT INTO `os_district` VALUES ('370902', '泰山区', '3', '370900');
INSERT INTO `os_district` VALUES ('370903', '岱岳区', '3', '370900');
INSERT INTO `os_district` VALUES ('370921', '宁阳县', '3', '370900');
INSERT INTO `os_district` VALUES ('370923', '东平县', '3', '370900');
INSERT INTO `os_district` VALUES ('370982', '新泰市', '3', '370900');
INSERT INTO `os_district` VALUES ('370983', '肥城市', '3', '370900');
INSERT INTO `os_district` VALUES ('371001', '市辖区', '3', '371000');
INSERT INTO `os_district` VALUES ('371002', '环翠区', '3', '371000');
INSERT INTO `os_district` VALUES ('371081', '文登市', '3', '371000');
INSERT INTO `os_district` VALUES ('371082', '荣成市', '3', '371000');
INSERT INTO `os_district` VALUES ('371083', '乳山市', '3', '371000');
INSERT INTO `os_district` VALUES ('371101', '市辖区', '3', '371100');
INSERT INTO `os_district` VALUES ('371102', '东港区', '3', '371100');
INSERT INTO `os_district` VALUES ('371103', '岚山区', '3', '371100');
INSERT INTO `os_district` VALUES ('371121', '五莲县', '3', '371100');
INSERT INTO `os_district` VALUES ('371122', '莒　县', '3', '371100');
INSERT INTO `os_district` VALUES ('371201', '市辖区', '3', '371200');
INSERT INTO `os_district` VALUES ('371202', '莱城区', '3', '371200');
INSERT INTO `os_district` VALUES ('371203', '钢城区', '3', '371200');
INSERT INTO `os_district` VALUES ('371301', '市辖区', '3', '371300');
INSERT INTO `os_district` VALUES ('371302', '兰山区', '3', '371300');
INSERT INTO `os_district` VALUES ('371311', '罗庄区', '3', '371300');
INSERT INTO `os_district` VALUES ('371312', '河东区', '3', '371300');
INSERT INTO `os_district` VALUES ('371321', '沂南县', '3', '371300');
INSERT INTO `os_district` VALUES ('371322', '郯城县', '3', '371300');
INSERT INTO `os_district` VALUES ('371323', '沂水县', '3', '371300');
INSERT INTO `os_district` VALUES ('371324', '苍山县', '3', '371300');
INSERT INTO `os_district` VALUES ('371325', '费　县', '3', '371300');
INSERT INTO `os_district` VALUES ('371326', '平邑县', '3', '371300');
INSERT INTO `os_district` VALUES ('371327', '莒南县', '3', '371300');
INSERT INTO `os_district` VALUES ('371328', '蒙阴县', '3', '371300');
INSERT INTO `os_district` VALUES ('371329', '临沭县', '3', '371300');
INSERT INTO `os_district` VALUES ('371401', '市辖区', '3', '371400');
INSERT INTO `os_district` VALUES ('371402', '德城区', '3', '371400');
INSERT INTO `os_district` VALUES ('371421', '陵　县', '3', '371400');
INSERT INTO `os_district` VALUES ('371422', '宁津县', '3', '371400');
INSERT INTO `os_district` VALUES ('371423', '庆云县', '3', '371400');
INSERT INTO `os_district` VALUES ('371424', '临邑县', '3', '371400');
INSERT INTO `os_district` VALUES ('371425', '齐河县', '3', '371400');
INSERT INTO `os_district` VALUES ('371426', '平原县', '3', '371400');
INSERT INTO `os_district` VALUES ('371427', '夏津县', '3', '371400');
INSERT INTO `os_district` VALUES ('371428', '武城县', '3', '371400');
INSERT INTO `os_district` VALUES ('371481', '乐陵市', '3', '371400');
INSERT INTO `os_district` VALUES ('371482', '禹城市', '3', '371400');
INSERT INTO `os_district` VALUES ('371501', '市辖区', '3', '371500');
INSERT INTO `os_district` VALUES ('371502', '东昌府区', '3', '371500');
INSERT INTO `os_district` VALUES ('371521', '阳谷县', '3', '371500');
INSERT INTO `os_district` VALUES ('371522', '莘　县', '3', '371500');
INSERT INTO `os_district` VALUES ('371523', '茌平县', '3', '371500');
INSERT INTO `os_district` VALUES ('371524', '东阿县', '3', '371500');
INSERT INTO `os_district` VALUES ('371525', '冠　县', '3', '371500');
INSERT INTO `os_district` VALUES ('371526', '高唐县', '3', '371500');
INSERT INTO `os_district` VALUES ('371581', '临清市', '3', '371500');
INSERT INTO `os_district` VALUES ('371601', '市辖区', '3', '371600');
INSERT INTO `os_district` VALUES ('371602', '滨城区', '3', '371600');
INSERT INTO `os_district` VALUES ('371621', '惠民县', '3', '371600');
INSERT INTO `os_district` VALUES ('371622', '阳信县', '3', '371600');
INSERT INTO `os_district` VALUES ('371623', '无棣县', '3', '371600');
INSERT INTO `os_district` VALUES ('371624', '沾化县', '3', '371600');
INSERT INTO `os_district` VALUES ('371625', '博兴县', '3', '371600');
INSERT INTO `os_district` VALUES ('371626', '邹平县', '3', '371600');
INSERT INTO `os_district` VALUES ('371701', '市辖区', '3', '371700');
INSERT INTO `os_district` VALUES ('371702', '牡丹区', '3', '371700');
INSERT INTO `os_district` VALUES ('371721', '曹　县', '3', '371700');
INSERT INTO `os_district` VALUES ('371722', '单　县', '3', '371700');
INSERT INTO `os_district` VALUES ('371723', '成武县', '3', '371700');
INSERT INTO `os_district` VALUES ('371724', '巨野县', '3', '371700');
INSERT INTO `os_district` VALUES ('371725', '郓城县', '3', '371700');
INSERT INTO `os_district` VALUES ('371726', '鄄城县', '3', '371700');
INSERT INTO `os_district` VALUES ('371727', '定陶县', '3', '371700');
INSERT INTO `os_district` VALUES ('371728', '东明县', '3', '371700');
INSERT INTO `os_district` VALUES ('410101', '市辖区', '3', '410100');
INSERT INTO `os_district` VALUES ('410102', '中原区', '3', '410100');
INSERT INTO `os_district` VALUES ('410103', '二七区', '3', '410100');
INSERT INTO `os_district` VALUES ('410104', '管城回族区', '3', '410100');
INSERT INTO `os_district` VALUES ('410105', '金水区', '3', '410100');
INSERT INTO `os_district` VALUES ('410106', '上街区', '3', '410100');
INSERT INTO `os_district` VALUES ('410108', '邙山区', '3', '410100');
INSERT INTO `os_district` VALUES ('410122', '中牟县', '3', '410100');
INSERT INTO `os_district` VALUES ('410181', '巩义市', '3', '410100');
INSERT INTO `os_district` VALUES ('410182', '荥阳市', '3', '410100');
INSERT INTO `os_district` VALUES ('410183', '新密市', '3', '410100');
INSERT INTO `os_district` VALUES ('410184', '新郑市', '3', '410100');
INSERT INTO `os_district` VALUES ('410185', '登封市', '3', '410100');
INSERT INTO `os_district` VALUES ('410201', '市辖区', '3', '410200');
INSERT INTO `os_district` VALUES ('410202', '龙亭区', '3', '410200');
INSERT INTO `os_district` VALUES ('410203', '顺河回族区', '3', '410200');
INSERT INTO `os_district` VALUES ('410204', '鼓楼区', '3', '410200');
INSERT INTO `os_district` VALUES ('410205', '南关区', '3', '410200');
INSERT INTO `os_district` VALUES ('410211', '郊　区', '3', '410200');
INSERT INTO `os_district` VALUES ('410221', '杞　县', '3', '410200');
INSERT INTO `os_district` VALUES ('410222', '通许县', '3', '410200');
INSERT INTO `os_district` VALUES ('410223', '尉氏县', '3', '410200');
INSERT INTO `os_district` VALUES ('410224', '开封县', '3', '410200');
INSERT INTO `os_district` VALUES ('410225', '兰考县', '3', '410200');
INSERT INTO `os_district` VALUES ('410301', '市辖区', '3', '410300');
INSERT INTO `os_district` VALUES ('410302', '老城区', '3', '410300');
INSERT INTO `os_district` VALUES ('410303', '西工区', '3', '410300');
INSERT INTO `os_district` VALUES ('410304', '廛河回族区', '3', '410300');
INSERT INTO `os_district` VALUES ('410305', '涧西区', '3', '410300');
INSERT INTO `os_district` VALUES ('410306', '吉利区', '3', '410300');
INSERT INTO `os_district` VALUES ('410307', '洛龙区', '3', '410300');
INSERT INTO `os_district` VALUES ('410322', '孟津县', '3', '410300');
INSERT INTO `os_district` VALUES ('410323', '新安县', '3', '410300');
INSERT INTO `os_district` VALUES ('410324', '栾川县', '3', '410300');
INSERT INTO `os_district` VALUES ('410325', '嵩　县', '3', '410300');
INSERT INTO `os_district` VALUES ('410326', '汝阳县', '3', '410300');
INSERT INTO `os_district` VALUES ('410327', '宜阳县', '3', '410300');
INSERT INTO `os_district` VALUES ('410328', '洛宁县', '3', '410300');
INSERT INTO `os_district` VALUES ('410329', '伊川县', '3', '410300');
INSERT INTO `os_district` VALUES ('410381', '偃师市', '3', '410300');
INSERT INTO `os_district` VALUES ('410401', '市辖区', '3', '410400');
INSERT INTO `os_district` VALUES ('410402', '新华区', '3', '410400');
INSERT INTO `os_district` VALUES ('410403', '卫东区', '3', '410400');
INSERT INTO `os_district` VALUES ('410404', '石龙区', '3', '410400');
INSERT INTO `os_district` VALUES ('410411', '湛河区', '3', '410400');
INSERT INTO `os_district` VALUES ('410421', '宝丰县', '3', '410400');
INSERT INTO `os_district` VALUES ('410422', '叶　县', '3', '410400');
INSERT INTO `os_district` VALUES ('410423', '鲁山县', '3', '410400');
INSERT INTO `os_district` VALUES ('410425', '郏　县', '3', '410400');
INSERT INTO `os_district` VALUES ('410481', '舞钢市', '3', '410400');
INSERT INTO `os_district` VALUES ('410482', '汝州市', '3', '410400');
INSERT INTO `os_district` VALUES ('410501', '市辖区', '3', '410500');
INSERT INTO `os_district` VALUES ('410502', '文峰区', '3', '410500');
INSERT INTO `os_district` VALUES ('410503', '北关区', '3', '410500');
INSERT INTO `os_district` VALUES ('410505', '殷都区', '3', '410500');
INSERT INTO `os_district` VALUES ('410506', '龙安区', '3', '410500');
INSERT INTO `os_district` VALUES ('410522', '安阳县', '3', '410500');
INSERT INTO `os_district` VALUES ('410523', '汤阴县', '3', '410500');
INSERT INTO `os_district` VALUES ('410526', '滑　县', '3', '410500');
INSERT INTO `os_district` VALUES ('410527', '内黄县', '3', '410500');
INSERT INTO `os_district` VALUES ('410581', '林州市', '3', '410500');
INSERT INTO `os_district` VALUES ('410601', '市辖区', '3', '410600');
INSERT INTO `os_district` VALUES ('410602', '鹤山区', '3', '410600');
INSERT INTO `os_district` VALUES ('410603', '山城区', '3', '410600');
INSERT INTO `os_district` VALUES ('410611', '淇滨区', '3', '410600');
INSERT INTO `os_district` VALUES ('410621', '浚　县', '3', '410600');
INSERT INTO `os_district` VALUES ('410622', '淇　县', '3', '410600');
INSERT INTO `os_district` VALUES ('410701', '市辖区', '3', '410700');
INSERT INTO `os_district` VALUES ('410702', '红旗区', '3', '410700');
INSERT INTO `os_district` VALUES ('410703', '卫滨区', '3', '410700');
INSERT INTO `os_district` VALUES ('410704', '凤泉区', '3', '410700');
INSERT INTO `os_district` VALUES ('410711', '牧野区', '3', '410700');
INSERT INTO `os_district` VALUES ('410721', '新乡县', '3', '410700');
INSERT INTO `os_district` VALUES ('410724', '获嘉县', '3', '410700');
INSERT INTO `os_district` VALUES ('410725', '原阳县', '3', '410700');
INSERT INTO `os_district` VALUES ('410726', '延津县', '3', '410700');
INSERT INTO `os_district` VALUES ('410727', '封丘县', '3', '410700');
INSERT INTO `os_district` VALUES ('410728', '长垣县', '3', '410700');
INSERT INTO `os_district` VALUES ('410781', '卫辉市', '3', '410700');
INSERT INTO `os_district` VALUES ('410782', '辉县市', '3', '410700');
INSERT INTO `os_district` VALUES ('410801', '市辖区', '3', '410800');
INSERT INTO `os_district` VALUES ('410802', '解放区', '3', '410800');
INSERT INTO `os_district` VALUES ('410803', '中站区', '3', '410800');
INSERT INTO `os_district` VALUES ('410804', '马村区', '3', '410800');
INSERT INTO `os_district` VALUES ('410811', '山阳区', '3', '410800');
INSERT INTO `os_district` VALUES ('410821', '修武县', '3', '410800');
INSERT INTO `os_district` VALUES ('410822', '博爱县', '3', '410800');
INSERT INTO `os_district` VALUES ('410823', '武陟县', '3', '410800');
INSERT INTO `os_district` VALUES ('410825', '温　县', '3', '410800');
INSERT INTO `os_district` VALUES ('410881', '济源市', '3', '410800');
INSERT INTO `os_district` VALUES ('410882', '沁阳市', '3', '410800');
INSERT INTO `os_district` VALUES ('410883', '孟州市', '3', '410800');
INSERT INTO `os_district` VALUES ('410901', '市辖区', '3', '410900');
INSERT INTO `os_district` VALUES ('410902', '华龙区', '3', '410900');
INSERT INTO `os_district` VALUES ('410922', '清丰县', '3', '410900');
INSERT INTO `os_district` VALUES ('410923', '南乐县', '3', '410900');
INSERT INTO `os_district` VALUES ('410926', '范　县', '3', '410900');
INSERT INTO `os_district` VALUES ('410927', '台前县', '3', '410900');
INSERT INTO `os_district` VALUES ('410928', '濮阳县', '3', '410900');
INSERT INTO `os_district` VALUES ('411001', '市辖区', '3', '411000');
INSERT INTO `os_district` VALUES ('411002', '魏都区', '3', '411000');
INSERT INTO `os_district` VALUES ('411023', '许昌县', '3', '411000');
INSERT INTO `os_district` VALUES ('411024', '鄢陵县', '3', '411000');
INSERT INTO `os_district` VALUES ('411025', '襄城县', '3', '411000');
INSERT INTO `os_district` VALUES ('411081', '禹州市', '3', '411000');
INSERT INTO `os_district` VALUES ('411082', '长葛市', '3', '411000');
INSERT INTO `os_district` VALUES ('411101', '市辖区', '3', '411100');
INSERT INTO `os_district` VALUES ('411102', '源汇区', '3', '411100');
INSERT INTO `os_district` VALUES ('411103', '郾城区', '3', '411100');
INSERT INTO `os_district` VALUES ('411104', '召陵区', '3', '411100');
INSERT INTO `os_district` VALUES ('411121', '舞阳县', '3', '411100');
INSERT INTO `os_district` VALUES ('411122', '临颍县', '3', '411100');
INSERT INTO `os_district` VALUES ('411201', '市辖区', '3', '411200');
INSERT INTO `os_district` VALUES ('411202', '湖滨区', '3', '411200');
INSERT INTO `os_district` VALUES ('411221', '渑池县', '3', '411200');
INSERT INTO `os_district` VALUES ('411222', '陕　县', '3', '411200');
INSERT INTO `os_district` VALUES ('411224', '卢氏县', '3', '411200');
INSERT INTO `os_district` VALUES ('411281', '义马市', '3', '411200');
INSERT INTO `os_district` VALUES ('411282', '灵宝市', '3', '411200');
INSERT INTO `os_district` VALUES ('411301', '市辖区', '3', '411300');
INSERT INTO `os_district` VALUES ('411302', '宛城区', '3', '411300');
INSERT INTO `os_district` VALUES ('411303', '卧龙区', '3', '411300');
INSERT INTO `os_district` VALUES ('411321', '南召县', '3', '411300');
INSERT INTO `os_district` VALUES ('411322', '方城县', '3', '411300');
INSERT INTO `os_district` VALUES ('411323', '西峡县', '3', '411300');
INSERT INTO `os_district` VALUES ('411324', '镇平县', '3', '411300');
INSERT INTO `os_district` VALUES ('411325', '内乡县', '3', '411300');
INSERT INTO `os_district` VALUES ('411326', '淅川县', '3', '411300');
INSERT INTO `os_district` VALUES ('411327', '社旗县', '3', '411300');
INSERT INTO `os_district` VALUES ('411328', '唐河县', '3', '411300');
INSERT INTO `os_district` VALUES ('411329', '新野县', '3', '411300');
INSERT INTO `os_district` VALUES ('411330', '桐柏县', '3', '411300');
INSERT INTO `os_district` VALUES ('411381', '邓州市', '3', '411300');
INSERT INTO `os_district` VALUES ('411401', '市辖区', '3', '411400');
INSERT INTO `os_district` VALUES ('411402', '梁园区', '3', '411400');
INSERT INTO `os_district` VALUES ('411403', '睢阳区', '3', '411400');
INSERT INTO `os_district` VALUES ('411421', '民权县', '3', '411400');
INSERT INTO `os_district` VALUES ('411422', '睢　县', '3', '411400');
INSERT INTO `os_district` VALUES ('411423', '宁陵县', '3', '411400');
INSERT INTO `os_district` VALUES ('411424', '柘城县', '3', '411400');
INSERT INTO `os_district` VALUES ('411425', '虞城县', '3', '411400');
INSERT INTO `os_district` VALUES ('411426', '夏邑县', '3', '411400');
INSERT INTO `os_district` VALUES ('411481', '永城市', '3', '411400');
INSERT INTO `os_district` VALUES ('411501', '市辖区', '3', '411500');
INSERT INTO `os_district` VALUES ('411502', '师河区', '3', '411500');
INSERT INTO `os_district` VALUES ('411503', '平桥区', '3', '411500');
INSERT INTO `os_district` VALUES ('411521', '罗山县', '3', '411500');
INSERT INTO `os_district` VALUES ('411522', '光山县', '3', '411500');
INSERT INTO `os_district` VALUES ('411523', '新　县', '3', '411500');
INSERT INTO `os_district` VALUES ('411524', '商城县', '3', '411500');
INSERT INTO `os_district` VALUES ('411525', '固始县', '3', '411500');
INSERT INTO `os_district` VALUES ('411526', '潢川县', '3', '411500');
INSERT INTO `os_district` VALUES ('411527', '淮滨县', '3', '411500');
INSERT INTO `os_district` VALUES ('411528', '息　县', '3', '411500');
INSERT INTO `os_district` VALUES ('411601', '市辖区', '3', '411600');
INSERT INTO `os_district` VALUES ('411602', '川汇区', '3', '411600');
INSERT INTO `os_district` VALUES ('411621', '扶沟县', '3', '411600');
INSERT INTO `os_district` VALUES ('411622', '西华县', '3', '411600');
INSERT INTO `os_district` VALUES ('411623', '商水县', '3', '411600');
INSERT INTO `os_district` VALUES ('411624', '沈丘县', '3', '411600');
INSERT INTO `os_district` VALUES ('411625', '郸城县', '3', '411600');
INSERT INTO `os_district` VALUES ('411626', '淮阳县', '3', '411600');
INSERT INTO `os_district` VALUES ('411627', '太康县', '3', '411600');
INSERT INTO `os_district` VALUES ('411628', '鹿邑县', '3', '411600');
INSERT INTO `os_district` VALUES ('411681', '项城市', '3', '411600');
INSERT INTO `os_district` VALUES ('411701', '市辖区', '3', '411700');
INSERT INTO `os_district` VALUES ('411702', '驿城区', '3', '411700');
INSERT INTO `os_district` VALUES ('411721', '西平县', '3', '411700');
INSERT INTO `os_district` VALUES ('411722', '上蔡县', '3', '411700');
INSERT INTO `os_district` VALUES ('411723', '平舆县', '3', '411700');
INSERT INTO `os_district` VALUES ('411724', '正阳县', '3', '411700');
INSERT INTO `os_district` VALUES ('411725', '确山县', '3', '411700');
INSERT INTO `os_district` VALUES ('411726', '泌阳县', '3', '411700');
INSERT INTO `os_district` VALUES ('411727', '汝南县', '3', '411700');
INSERT INTO `os_district` VALUES ('411728', '遂平县', '3', '411700');
INSERT INTO `os_district` VALUES ('411729', '新蔡县', '3', '411700');
INSERT INTO `os_district` VALUES ('420101', '市辖区', '3', '420100');
INSERT INTO `os_district` VALUES ('420102', '江岸区', '3', '420100');
INSERT INTO `os_district` VALUES ('420103', '江汉区', '3', '420100');
INSERT INTO `os_district` VALUES ('420104', '乔口区', '3', '420100');
INSERT INTO `os_district` VALUES ('420105', '汉阳区', '3', '420100');
INSERT INTO `os_district` VALUES ('420106', '武昌区', '3', '420100');
INSERT INTO `os_district` VALUES ('420107', '青山区', '3', '420100');
INSERT INTO `os_district` VALUES ('420111', '洪山区', '3', '420100');
INSERT INTO `os_district` VALUES ('420112', '东西湖区', '3', '420100');
INSERT INTO `os_district` VALUES ('420113', '汉南区', '3', '420100');
INSERT INTO `os_district` VALUES ('420114', '蔡甸区', '3', '420100');
INSERT INTO `os_district` VALUES ('420115', '江夏区', '3', '420100');
INSERT INTO `os_district` VALUES ('420116', '黄陂区', '3', '420100');
INSERT INTO `os_district` VALUES ('420117', '新洲区', '3', '420100');
INSERT INTO `os_district` VALUES ('420201', '市辖区', '3', '420200');
INSERT INTO `os_district` VALUES ('420202', '黄石港区', '3', '420200');
INSERT INTO `os_district` VALUES ('420203', '西塞山区', '3', '420200');
INSERT INTO `os_district` VALUES ('420204', '下陆区', '3', '420200');
INSERT INTO `os_district` VALUES ('420205', '铁山区', '3', '420200');
INSERT INTO `os_district` VALUES ('420222', '阳新县', '3', '420200');
INSERT INTO `os_district` VALUES ('420281', '大冶市', '3', '420200');
INSERT INTO `os_district` VALUES ('420301', '市辖区', '3', '420300');
INSERT INTO `os_district` VALUES ('420302', '茅箭区', '3', '420300');
INSERT INTO `os_district` VALUES ('420303', '张湾区', '3', '420300');
INSERT INTO `os_district` VALUES ('420321', '郧　县', '3', '420300');
INSERT INTO `os_district` VALUES ('420322', '郧西县', '3', '420300');
INSERT INTO `os_district` VALUES ('420323', '竹山县', '3', '420300');
INSERT INTO `os_district` VALUES ('420324', '竹溪县', '3', '420300');
INSERT INTO `os_district` VALUES ('420325', '房　县', '3', '420300');
INSERT INTO `os_district` VALUES ('420381', '丹江口市', '3', '420300');
INSERT INTO `os_district` VALUES ('420501', '市辖区', '3', '420500');
INSERT INTO `os_district` VALUES ('420502', '西陵区', '3', '420500');
INSERT INTO `os_district` VALUES ('420503', '伍家岗区', '3', '420500');
INSERT INTO `os_district` VALUES ('420504', '点军区', '3', '420500');
INSERT INTO `os_district` VALUES ('420505', '猇亭区', '3', '420500');
INSERT INTO `os_district` VALUES ('420506', '夷陵区', '3', '420500');
INSERT INTO `os_district` VALUES ('420525', '远安县', '3', '420500');
INSERT INTO `os_district` VALUES ('420526', '兴山县', '3', '420500');
INSERT INTO `os_district` VALUES ('420527', '秭归县', '3', '420500');
INSERT INTO `os_district` VALUES ('420528', '长阳土家族自治县', '3', '420500');
INSERT INTO `os_district` VALUES ('420529', '五峰土家族自治县', '3', '420500');
INSERT INTO `os_district` VALUES ('420581', '宜都市', '3', '420500');
INSERT INTO `os_district` VALUES ('420582', '当阳市', '3', '420500');
INSERT INTO `os_district` VALUES ('420583', '枝江市', '3', '420500');
INSERT INTO `os_district` VALUES ('420601', '市辖区', '3', '420600');
INSERT INTO `os_district` VALUES ('420602', '襄城区', '3', '420600');
INSERT INTO `os_district` VALUES ('420606', '樊城区', '3', '420600');
INSERT INTO `os_district` VALUES ('420607', '襄阳区', '3', '420600');
INSERT INTO `os_district` VALUES ('420624', '南漳县', '3', '420600');
INSERT INTO `os_district` VALUES ('420625', '谷城县', '3', '420600');
INSERT INTO `os_district` VALUES ('420626', '保康县', '3', '420600');
INSERT INTO `os_district` VALUES ('420682', '老河口市', '3', '420600');
INSERT INTO `os_district` VALUES ('420683', '枣阳市', '3', '420600');
INSERT INTO `os_district` VALUES ('420684', '宜城市', '3', '420600');
INSERT INTO `os_district` VALUES ('420701', '市辖区', '3', '420700');
INSERT INTO `os_district` VALUES ('420702', '梁子湖区', '3', '420700');
INSERT INTO `os_district` VALUES ('420703', '华容区', '3', '420700');
INSERT INTO `os_district` VALUES ('420704', '鄂城区', '3', '420700');
INSERT INTO `os_district` VALUES ('420801', '市辖区', '3', '420800');
INSERT INTO `os_district` VALUES ('420802', '东宝区', '3', '420800');
INSERT INTO `os_district` VALUES ('420804', '掇刀区', '3', '420800');
INSERT INTO `os_district` VALUES ('420821', '京山县', '3', '420800');
INSERT INTO `os_district` VALUES ('420822', '沙洋县', '3', '420800');
INSERT INTO `os_district` VALUES ('420881', '钟祥市', '3', '420800');
INSERT INTO `os_district` VALUES ('420901', '市辖区', '3', '420900');
INSERT INTO `os_district` VALUES ('420902', '孝南区', '3', '420900');
INSERT INTO `os_district` VALUES ('420921', '孝昌县', '3', '420900');
INSERT INTO `os_district` VALUES ('420922', '大悟县', '3', '420900');
INSERT INTO `os_district` VALUES ('420923', '云梦县', '3', '420900');
INSERT INTO `os_district` VALUES ('420981', '应城市', '3', '420900');
INSERT INTO `os_district` VALUES ('420982', '安陆市', '3', '420900');
INSERT INTO `os_district` VALUES ('420984', '汉川市', '3', '420900');
INSERT INTO `os_district` VALUES ('421001', '市辖区', '3', '421000');
INSERT INTO `os_district` VALUES ('421002', '沙市区', '3', '421000');
INSERT INTO `os_district` VALUES ('421003', '荆州区', '3', '421000');
INSERT INTO `os_district` VALUES ('421022', '公安县', '3', '421000');
INSERT INTO `os_district` VALUES ('421023', '监利县', '3', '421000');
INSERT INTO `os_district` VALUES ('421024', '江陵县', '3', '421000');
INSERT INTO `os_district` VALUES ('421081', '石首市', '3', '421000');
INSERT INTO `os_district` VALUES ('421083', '洪湖市', '3', '421000');
INSERT INTO `os_district` VALUES ('421087', '松滋市', '3', '421000');
INSERT INTO `os_district` VALUES ('421101', '市辖区', '3', '421100');
INSERT INTO `os_district` VALUES ('421102', '黄州区', '3', '421100');
INSERT INTO `os_district` VALUES ('421121', '团风县', '3', '421100');
INSERT INTO `os_district` VALUES ('421122', '红安县', '3', '421100');
INSERT INTO `os_district` VALUES ('421123', '罗田县', '3', '421100');
INSERT INTO `os_district` VALUES ('421124', '英山县', '3', '421100');
INSERT INTO `os_district` VALUES ('421125', '浠水县', '3', '421100');
INSERT INTO `os_district` VALUES ('421126', '蕲春县', '3', '421100');
INSERT INTO `os_district` VALUES ('421127', '黄梅县', '3', '421100');
INSERT INTO `os_district` VALUES ('421181', '麻城市', '3', '421100');
INSERT INTO `os_district` VALUES ('421182', '武穴市', '3', '421100');
INSERT INTO `os_district` VALUES ('421201', '市辖区', '3', '421200');
INSERT INTO `os_district` VALUES ('421202', '咸安区', '3', '421200');
INSERT INTO `os_district` VALUES ('421221', '嘉鱼县', '3', '421200');
INSERT INTO `os_district` VALUES ('421222', '通城县', '3', '421200');
INSERT INTO `os_district` VALUES ('421223', '崇阳县', '3', '421200');
INSERT INTO `os_district` VALUES ('421224', '通山县', '3', '421200');
INSERT INTO `os_district` VALUES ('421281', '赤壁市', '3', '421200');
INSERT INTO `os_district` VALUES ('421301', '市辖区', '3', '421300');
INSERT INTO `os_district` VALUES ('421302', '曾都区', '3', '421300');
INSERT INTO `os_district` VALUES ('421381', '广水市', '3', '421300');
INSERT INTO `os_district` VALUES ('422801', '恩施市', '3', '422800');
INSERT INTO `os_district` VALUES ('422802', '利川市', '3', '422800');
INSERT INTO `os_district` VALUES ('422822', '建始县', '3', '422800');
INSERT INTO `os_district` VALUES ('422823', '巴东县', '3', '422800');
INSERT INTO `os_district` VALUES ('422825', '宣恩县', '3', '422800');
INSERT INTO `os_district` VALUES ('422826', '咸丰县', '3', '422800');
INSERT INTO `os_district` VALUES ('422827', '来凤县', '3', '422800');
INSERT INTO `os_district` VALUES ('422828', '鹤峰县', '3', '422800');
INSERT INTO `os_district` VALUES ('429004', '仙桃市', '3', '429000');
INSERT INTO `os_district` VALUES ('429005', '潜江市', '3', '429000');
INSERT INTO `os_district` VALUES ('429006', '天门市', '3', '429000');
INSERT INTO `os_district` VALUES ('429021', '神农架林区', '3', '429000');
INSERT INTO `os_district` VALUES ('430101', '市辖区', '3', '430100');
INSERT INTO `os_district` VALUES ('430102', '芙蓉区', '3', '430100');
INSERT INTO `os_district` VALUES ('430103', '天心区', '3', '430100');
INSERT INTO `os_district` VALUES ('430104', '岳麓区', '3', '430100');
INSERT INTO `os_district` VALUES ('430105', '开福区', '3', '430100');
INSERT INTO `os_district` VALUES ('430111', '雨花区', '3', '430100');
INSERT INTO `os_district` VALUES ('430121', '长沙县', '3', '430100');
INSERT INTO `os_district` VALUES ('430122', '望城县', '3', '430100');
INSERT INTO `os_district` VALUES ('430124', '宁乡县', '3', '430100');
INSERT INTO `os_district` VALUES ('430181', '浏阳市', '3', '430100');
INSERT INTO `os_district` VALUES ('430201', '市辖区', '3', '430200');
INSERT INTO `os_district` VALUES ('430202', '荷塘区', '3', '430200');
INSERT INTO `os_district` VALUES ('430203', '芦淞区', '3', '430200');
INSERT INTO `os_district` VALUES ('430204', '石峰区', '3', '430200');
INSERT INTO `os_district` VALUES ('430211', '天元区', '3', '430200');
INSERT INTO `os_district` VALUES ('430221', '株洲县', '3', '430200');
INSERT INTO `os_district` VALUES ('430223', '攸　县', '3', '430200');
INSERT INTO `os_district` VALUES ('430224', '茶陵县', '3', '430200');
INSERT INTO `os_district` VALUES ('430225', '炎陵县', '3', '430200');
INSERT INTO `os_district` VALUES ('430281', '醴陵市', '3', '430200');
INSERT INTO `os_district` VALUES ('430301', '市辖区', '3', '430300');
INSERT INTO `os_district` VALUES ('430302', '雨湖区', '3', '430300');
INSERT INTO `os_district` VALUES ('430304', '岳塘区', '3', '430300');
INSERT INTO `os_district` VALUES ('430321', '湘潭县', '3', '430300');
INSERT INTO `os_district` VALUES ('430381', '湘乡市', '3', '430300');
INSERT INTO `os_district` VALUES ('430382', '韶山市', '3', '430300');
INSERT INTO `os_district` VALUES ('430401', '市辖区', '3', '430400');
INSERT INTO `os_district` VALUES ('430405', '珠晖区', '3', '430400');
INSERT INTO `os_district` VALUES ('430406', '雁峰区', '3', '430400');
INSERT INTO `os_district` VALUES ('430407', '石鼓区', '3', '430400');
INSERT INTO `os_district` VALUES ('430408', '蒸湘区', '3', '430400');
INSERT INTO `os_district` VALUES ('430412', '南岳区', '3', '430400');
INSERT INTO `os_district` VALUES ('430421', '衡阳县', '3', '430400');
INSERT INTO `os_district` VALUES ('430422', '衡南县', '3', '430400');
INSERT INTO `os_district` VALUES ('430423', '衡山县', '3', '430400');
INSERT INTO `os_district` VALUES ('430424', '衡东县', '3', '430400');
INSERT INTO `os_district` VALUES ('430426', '祁东县', '3', '430400');
INSERT INTO `os_district` VALUES ('430481', '耒阳市', '3', '430400');
INSERT INTO `os_district` VALUES ('430482', '常宁市', '3', '430400');
INSERT INTO `os_district` VALUES ('430501', '市辖区', '3', '430500');
INSERT INTO `os_district` VALUES ('430502', '双清区', '3', '430500');
INSERT INTO `os_district` VALUES ('430503', '大祥区', '3', '430500');
INSERT INTO `os_district` VALUES ('430511', '北塔区', '3', '430500');
INSERT INTO `os_district` VALUES ('430521', '邵东县', '3', '430500');
INSERT INTO `os_district` VALUES ('430522', '新邵县', '3', '430500');
INSERT INTO `os_district` VALUES ('430523', '邵阳县', '3', '430500');
INSERT INTO `os_district` VALUES ('430524', '隆回县', '3', '430500');
INSERT INTO `os_district` VALUES ('430525', '洞口县', '3', '430500');
INSERT INTO `os_district` VALUES ('430527', '绥宁县', '3', '430500');
INSERT INTO `os_district` VALUES ('430528', '新宁县', '3', '430500');
INSERT INTO `os_district` VALUES ('430529', '城步苗族自治县', '3', '430500');
INSERT INTO `os_district` VALUES ('430581', '武冈市', '3', '430500');
INSERT INTO `os_district` VALUES ('430601', '市辖区', '3', '430600');
INSERT INTO `os_district` VALUES ('430602', '岳阳楼区', '3', '430600');
INSERT INTO `os_district` VALUES ('430603', '云溪区', '3', '430600');
INSERT INTO `os_district` VALUES ('430611', '君山区', '3', '430600');
INSERT INTO `os_district` VALUES ('430621', '岳阳县', '3', '430600');
INSERT INTO `os_district` VALUES ('430623', '华容县', '3', '430600');
INSERT INTO `os_district` VALUES ('430624', '湘阴县', '3', '430600');
INSERT INTO `os_district` VALUES ('430626', '平江县', '3', '430600');
INSERT INTO `os_district` VALUES ('430681', '汨罗市', '3', '430600');
INSERT INTO `os_district` VALUES ('430682', '临湘市', '3', '430600');
INSERT INTO `os_district` VALUES ('430701', '市辖区', '3', '430700');
INSERT INTO `os_district` VALUES ('430702', '武陵区', '3', '430700');
INSERT INTO `os_district` VALUES ('430703', '鼎城区', '3', '430700');
INSERT INTO `os_district` VALUES ('430721', '安乡县', '3', '430700');
INSERT INTO `os_district` VALUES ('430722', '汉寿县', '3', '430700');
INSERT INTO `os_district` VALUES ('430723', '澧　县', '3', '430700');
INSERT INTO `os_district` VALUES ('430724', '临澧县', '3', '430700');
INSERT INTO `os_district` VALUES ('430725', '桃源县', '3', '430700');
INSERT INTO `os_district` VALUES ('430726', '石门县', '3', '430700');
INSERT INTO `os_district` VALUES ('430781', '津市市', '3', '430700');
INSERT INTO `os_district` VALUES ('430801', '市辖区', '3', '430800');
INSERT INTO `os_district` VALUES ('430802', '永定区', '3', '430800');
INSERT INTO `os_district` VALUES ('430811', '武陵源区', '3', '430800');
INSERT INTO `os_district` VALUES ('430821', '慈利县', '3', '430800');
INSERT INTO `os_district` VALUES ('430822', '桑植县', '3', '430800');
INSERT INTO `os_district` VALUES ('430901', '市辖区', '3', '430900');
INSERT INTO `os_district` VALUES ('430902', '资阳区', '3', '430900');
INSERT INTO `os_district` VALUES ('430903', '赫山区', '3', '430900');
INSERT INTO `os_district` VALUES ('430921', '南　县', '3', '430900');
INSERT INTO `os_district` VALUES ('430922', '桃江县', '3', '430900');
INSERT INTO `os_district` VALUES ('430923', '安化县', '3', '430900');
INSERT INTO `os_district` VALUES ('430981', '沅江市', '3', '430900');
INSERT INTO `os_district` VALUES ('431001', '市辖区', '3', '431000');
INSERT INTO `os_district` VALUES ('431002', '北湖区', '3', '431000');
INSERT INTO `os_district` VALUES ('431003', '苏仙区', '3', '431000');
INSERT INTO `os_district` VALUES ('431021', '桂阳县', '3', '431000');
INSERT INTO `os_district` VALUES ('431022', '宜章县', '3', '431000');
INSERT INTO `os_district` VALUES ('431023', '永兴县', '3', '431000');
INSERT INTO `os_district` VALUES ('431024', '嘉禾县', '3', '431000');
INSERT INTO `os_district` VALUES ('431025', '临武县', '3', '431000');
INSERT INTO `os_district` VALUES ('431026', '汝城县', '3', '431000');
INSERT INTO `os_district` VALUES ('431027', '桂东县', '3', '431000');
INSERT INTO `os_district` VALUES ('431028', '安仁县', '3', '431000');
INSERT INTO `os_district` VALUES ('431081', '资兴市', '3', '431000');
INSERT INTO `os_district` VALUES ('431101', '市辖区', '3', '431100');
INSERT INTO `os_district` VALUES ('431102', '芝山区', '3', '431100');
INSERT INTO `os_district` VALUES ('431103', '冷水滩区', '3', '431100');
INSERT INTO `os_district` VALUES ('431121', '祁阳县', '3', '431100');
INSERT INTO `os_district` VALUES ('431122', '东安县', '3', '431100');
INSERT INTO `os_district` VALUES ('431123', '双牌县', '3', '431100');
INSERT INTO `os_district` VALUES ('431124', '道　县', '3', '431100');
INSERT INTO `os_district` VALUES ('431125', '江永县', '3', '431100');
INSERT INTO `os_district` VALUES ('431126', '宁远县', '3', '431100');
INSERT INTO `os_district` VALUES ('431127', '蓝山县', '3', '431100');
INSERT INTO `os_district` VALUES ('431128', '新田县', '3', '431100');
INSERT INTO `os_district` VALUES ('431129', '江华瑶族自治县', '3', '431100');
INSERT INTO `os_district` VALUES ('431201', '市辖区', '3', '431200');
INSERT INTO `os_district` VALUES ('431202', '鹤城区', '3', '431200');
INSERT INTO `os_district` VALUES ('431221', '中方县', '3', '431200');
INSERT INTO `os_district` VALUES ('431222', '沅陵县', '3', '431200');
INSERT INTO `os_district` VALUES ('431223', '辰溪县', '3', '431200');
INSERT INTO `os_district` VALUES ('431224', '溆浦县', '3', '431200');
INSERT INTO `os_district` VALUES ('431225', '会同县', '3', '431200');
INSERT INTO `os_district` VALUES ('431226', '麻阳苗族自治县', '3', '431200');
INSERT INTO `os_district` VALUES ('431227', '新晃侗族自治县', '3', '431200');
INSERT INTO `os_district` VALUES ('431228', '芷江侗族自治县', '3', '431200');
INSERT INTO `os_district` VALUES ('431229', '靖州苗族侗族自治县', '3', '431200');
INSERT INTO `os_district` VALUES ('431230', '通道侗族自治县', '3', '431200');
INSERT INTO `os_district` VALUES ('431281', '洪江市', '3', '431200');
INSERT INTO `os_district` VALUES ('431301', '市辖区', '3', '431300');
INSERT INTO `os_district` VALUES ('431302', '娄星区', '3', '431300');
INSERT INTO `os_district` VALUES ('431321', '双峰县', '3', '431300');
INSERT INTO `os_district` VALUES ('431322', '新化县', '3', '431300');
INSERT INTO `os_district` VALUES ('431381', '冷水江市', '3', '431300');
INSERT INTO `os_district` VALUES ('431382', '涟源市', '3', '431300');
INSERT INTO `os_district` VALUES ('433101', '吉首市', '3', '433100');
INSERT INTO `os_district` VALUES ('433122', '泸溪县', '3', '433100');
INSERT INTO `os_district` VALUES ('433123', '凤凰县', '3', '433100');
INSERT INTO `os_district` VALUES ('433124', '花垣县', '3', '433100');
INSERT INTO `os_district` VALUES ('433125', '保靖县', '3', '433100');
INSERT INTO `os_district` VALUES ('433126', '古丈县', '3', '433100');
INSERT INTO `os_district` VALUES ('433127', '永顺县', '3', '433100');
INSERT INTO `os_district` VALUES ('433130', '龙山县', '3', '433100');
INSERT INTO `os_district` VALUES ('440101', '市辖区', '3', '440100');
INSERT INTO `os_district` VALUES ('440102', '东山区', '3', '440100');
INSERT INTO `os_district` VALUES ('440103', '荔湾区', '3', '440100');
INSERT INTO `os_district` VALUES ('440104', '越秀区', '3', '440100');
INSERT INTO `os_district` VALUES ('440105', '海珠区', '3', '440100');
INSERT INTO `os_district` VALUES ('440106', '天河区', '3', '440100');
INSERT INTO `os_district` VALUES ('440107', '芳村区', '3', '440100');
INSERT INTO `os_district` VALUES ('440111', '白云区', '3', '440100');
INSERT INTO `os_district` VALUES ('440112', '黄埔区', '3', '440100');
INSERT INTO `os_district` VALUES ('440113', '番禺区', '3', '440100');
INSERT INTO `os_district` VALUES ('440114', '花都区', '3', '440100');
INSERT INTO `os_district` VALUES ('440183', '增城市', '3', '440100');
INSERT INTO `os_district` VALUES ('440184', '从化市', '3', '440100');
INSERT INTO `os_district` VALUES ('440201', '市辖区', '3', '440200');
INSERT INTO `os_district` VALUES ('440203', '武江区', '3', '440200');
INSERT INTO `os_district` VALUES ('440204', '浈江区', '3', '440200');
INSERT INTO `os_district` VALUES ('440205', '曲江区', '3', '440200');
INSERT INTO `os_district` VALUES ('440222', '始兴县', '3', '440200');
INSERT INTO `os_district` VALUES ('440224', '仁化县', '3', '440200');
INSERT INTO `os_district` VALUES ('440229', '翁源县', '3', '440200');
INSERT INTO `os_district` VALUES ('440232', '乳源瑶族自治县', '3', '440200');
INSERT INTO `os_district` VALUES ('440233', '新丰县', '3', '440200');
INSERT INTO `os_district` VALUES ('440281', '乐昌市', '3', '440200');
INSERT INTO `os_district` VALUES ('440282', '南雄市', '3', '440200');
INSERT INTO `os_district` VALUES ('440301', '市辖区', '3', '440300');
INSERT INTO `os_district` VALUES ('440303', '罗湖区', '3', '440300');
INSERT INTO `os_district` VALUES ('440304', '福田区', '3', '440300');
INSERT INTO `os_district` VALUES ('440305', '南山区', '3', '440300');
INSERT INTO `os_district` VALUES ('440306', '宝安区', '3', '440300');
INSERT INTO `os_district` VALUES ('440307', '龙岗区', '3', '440300');
INSERT INTO `os_district` VALUES ('440308', '盐田区', '3', '440300');
INSERT INTO `os_district` VALUES ('440401', '市辖区', '3', '440400');
INSERT INTO `os_district` VALUES ('440402', '香洲区', '3', '440400');
INSERT INTO `os_district` VALUES ('440403', '斗门区', '3', '440400');
INSERT INTO `os_district` VALUES ('440404', '金湾区', '3', '440400');
INSERT INTO `os_district` VALUES ('440501', '市辖区', '3', '440500');
INSERT INTO `os_district` VALUES ('440507', '龙湖区', '3', '440500');
INSERT INTO `os_district` VALUES ('440511', '金平区', '3', '440500');
INSERT INTO `os_district` VALUES ('440512', '濠江区', '3', '440500');
INSERT INTO `os_district` VALUES ('440513', '潮阳区', '3', '440500');
INSERT INTO `os_district` VALUES ('440514', '潮南区', '3', '440500');
INSERT INTO `os_district` VALUES ('440515', '澄海区', '3', '440500');
INSERT INTO `os_district` VALUES ('440523', '南澳县', '3', '440500');
INSERT INTO `os_district` VALUES ('440601', '市辖区', '3', '440600');
INSERT INTO `os_district` VALUES ('440604', '禅城区', '3', '440600');
INSERT INTO `os_district` VALUES ('440605', '南海区', '3', '440600');
INSERT INTO `os_district` VALUES ('440606', '顺德区', '3', '440600');
INSERT INTO `os_district` VALUES ('440607', '三水区', '3', '440600');
INSERT INTO `os_district` VALUES ('440608', '高明区', '3', '440600');
INSERT INTO `os_district` VALUES ('440701', '市辖区', '3', '440700');
INSERT INTO `os_district` VALUES ('440703', '蓬江区', '3', '440700');
INSERT INTO `os_district` VALUES ('440704', '江海区', '3', '440700');
INSERT INTO `os_district` VALUES ('440705', '新会区', '3', '440700');
INSERT INTO `os_district` VALUES ('440781', '台山市', '3', '440700');
INSERT INTO `os_district` VALUES ('440783', '开平市', '3', '440700');
INSERT INTO `os_district` VALUES ('440784', '鹤山市', '3', '440700');
INSERT INTO `os_district` VALUES ('440785', '恩平市', '3', '440700');
INSERT INTO `os_district` VALUES ('440801', '市辖区', '3', '440800');
INSERT INTO `os_district` VALUES ('440802', '赤坎区', '3', '440800');
INSERT INTO `os_district` VALUES ('440803', '霞山区', '3', '440800');
INSERT INTO `os_district` VALUES ('440804', '坡头区', '3', '440800');
INSERT INTO `os_district` VALUES ('440811', '麻章区', '3', '440800');
INSERT INTO `os_district` VALUES ('440823', '遂溪县', '3', '440800');
INSERT INTO `os_district` VALUES ('440825', '徐闻县', '3', '440800');
INSERT INTO `os_district` VALUES ('440881', '廉江市', '3', '440800');
INSERT INTO `os_district` VALUES ('440882', '雷州市', '3', '440800');
INSERT INTO `os_district` VALUES ('440883', '吴川市', '3', '440800');
INSERT INTO `os_district` VALUES ('440901', '市辖区', '3', '440900');
INSERT INTO `os_district` VALUES ('440902', '茂南区', '3', '440900');
INSERT INTO `os_district` VALUES ('440903', '茂港区', '3', '440900');
INSERT INTO `os_district` VALUES ('440923', '电白县', '3', '440900');
INSERT INTO `os_district` VALUES ('440981', '高州市', '3', '440900');
INSERT INTO `os_district` VALUES ('440982', '化州市', '3', '440900');
INSERT INTO `os_district` VALUES ('440983', '信宜市', '3', '440900');
INSERT INTO `os_district` VALUES ('441201', '市辖区', '3', '441200');
INSERT INTO `os_district` VALUES ('441202', '端州区', '3', '441200');
INSERT INTO `os_district` VALUES ('441203', '鼎湖区', '3', '441200');
INSERT INTO `os_district` VALUES ('441223', '广宁县', '3', '441200');
INSERT INTO `os_district` VALUES ('441224', '怀集县', '3', '441200');
INSERT INTO `os_district` VALUES ('441225', '封开县', '3', '441200');
INSERT INTO `os_district` VALUES ('441226', '德庆县', '3', '441200');
INSERT INTO `os_district` VALUES ('441283', '高要市', '3', '441200');
INSERT INTO `os_district` VALUES ('441284', '四会市', '3', '441200');
INSERT INTO `os_district` VALUES ('441301', '市辖区', '3', '441300');
INSERT INTO `os_district` VALUES ('441302', '惠城区', '3', '441300');
INSERT INTO `os_district` VALUES ('441303', '惠阳区', '3', '441300');
INSERT INTO `os_district` VALUES ('441322', '博罗县', '3', '441300');
INSERT INTO `os_district` VALUES ('441323', '惠东县', '3', '441300');
INSERT INTO `os_district` VALUES ('441324', '龙门县', '3', '441300');
INSERT INTO `os_district` VALUES ('441401', '市辖区', '3', '441400');
INSERT INTO `os_district` VALUES ('441402', '梅江区', '3', '441400');
INSERT INTO `os_district` VALUES ('441421', '梅　县', '3', '441400');
INSERT INTO `os_district` VALUES ('441422', '大埔县', '3', '441400');
INSERT INTO `os_district` VALUES ('441423', '丰顺县', '3', '441400');
INSERT INTO `os_district` VALUES ('441424', '五华县', '3', '441400');
INSERT INTO `os_district` VALUES ('441426', '平远县', '3', '441400');
INSERT INTO `os_district` VALUES ('441427', '蕉岭县', '3', '441400');
INSERT INTO `os_district` VALUES ('441481', '兴宁市', '3', '441400');
INSERT INTO `os_district` VALUES ('441501', '市辖区', '3', '441500');
INSERT INTO `os_district` VALUES ('441502', '城　区', '3', '441500');
INSERT INTO `os_district` VALUES ('441521', '海丰县', '3', '441500');
INSERT INTO `os_district` VALUES ('441523', '陆河县', '3', '441500');
INSERT INTO `os_district` VALUES ('441581', '陆丰市', '3', '441500');
INSERT INTO `os_district` VALUES ('441601', '市辖区', '3', '441600');
INSERT INTO `os_district` VALUES ('441602', '源城区', '3', '441600');
INSERT INTO `os_district` VALUES ('441621', '紫金县', '3', '441600');
INSERT INTO `os_district` VALUES ('441622', '龙川县', '3', '441600');
INSERT INTO `os_district` VALUES ('441623', '连平县', '3', '441600');
INSERT INTO `os_district` VALUES ('441624', '和平县', '3', '441600');
INSERT INTO `os_district` VALUES ('441625', '东源县', '3', '441600');
INSERT INTO `os_district` VALUES ('441701', '市辖区', '3', '441700');
INSERT INTO `os_district` VALUES ('441702', '江城区', '3', '441700');
INSERT INTO `os_district` VALUES ('441721', '阳西县', '3', '441700');
INSERT INTO `os_district` VALUES ('441723', '阳东县', '3', '441700');
INSERT INTO `os_district` VALUES ('441781', '阳春市', '3', '441700');
INSERT INTO `os_district` VALUES ('441801', '市辖区', '3', '441800');
INSERT INTO `os_district` VALUES ('441802', '清城区', '3', '441800');
INSERT INTO `os_district` VALUES ('441821', '佛冈县', '3', '441800');
INSERT INTO `os_district` VALUES ('441823', '阳山县', '3', '441800');
INSERT INTO `os_district` VALUES ('441825', '连山壮族瑶族自治县', '3', '441800');
INSERT INTO `os_district` VALUES ('441826', '连南瑶族自治县', '3', '441800');
INSERT INTO `os_district` VALUES ('441827', '清新县', '3', '441800');
INSERT INTO `os_district` VALUES ('441881', '英德市', '3', '441800');
INSERT INTO `os_district` VALUES ('441882', '连州市', '3', '441800');
INSERT INTO `os_district` VALUES ('445101', '市辖区', '3', '445100');
INSERT INTO `os_district` VALUES ('445102', '湘桥区', '3', '445100');
INSERT INTO `os_district` VALUES ('445121', '潮安县', '3', '445100');
INSERT INTO `os_district` VALUES ('445122', '饶平县', '3', '445100');
INSERT INTO `os_district` VALUES ('445201', '市辖区', '3', '445200');
INSERT INTO `os_district` VALUES ('445202', '榕城区', '3', '445200');
INSERT INTO `os_district` VALUES ('445221', '揭东县', '3', '445200');
INSERT INTO `os_district` VALUES ('445222', '揭西县', '3', '445200');
INSERT INTO `os_district` VALUES ('445224', '惠来县', '3', '445200');
INSERT INTO `os_district` VALUES ('445281', '普宁市', '3', '445200');
INSERT INTO `os_district` VALUES ('445301', '市辖区', '3', '445300');
INSERT INTO `os_district` VALUES ('445302', '云城区', '3', '445300');
INSERT INTO `os_district` VALUES ('445321', '新兴县', '3', '445300');
INSERT INTO `os_district` VALUES ('445322', '郁南县', '3', '445300');
INSERT INTO `os_district` VALUES ('445323', '云安县', '3', '445300');
INSERT INTO `os_district` VALUES ('445381', '罗定市', '3', '445300');
INSERT INTO `os_district` VALUES ('450101', '市辖区', '3', '450100');
INSERT INTO `os_district` VALUES ('450102', '兴宁区', '3', '450100');
INSERT INTO `os_district` VALUES ('450103', '青秀区', '3', '450100');
INSERT INTO `os_district` VALUES ('450105', '江南区', '3', '450100');
INSERT INTO `os_district` VALUES ('450107', '西乡塘区', '3', '450100');
INSERT INTO `os_district` VALUES ('450108', '良庆区', '3', '450100');
INSERT INTO `os_district` VALUES ('450109', '邕宁区', '3', '450100');
INSERT INTO `os_district` VALUES ('450122', '武鸣县', '3', '450100');
INSERT INTO `os_district` VALUES ('450123', '隆安县', '3', '450100');
INSERT INTO `os_district` VALUES ('450124', '马山县', '3', '450100');
INSERT INTO `os_district` VALUES ('450125', '上林县', '3', '450100');
INSERT INTO `os_district` VALUES ('450126', '宾阳县', '3', '450100');
INSERT INTO `os_district` VALUES ('450127', '横　县', '3', '450100');
INSERT INTO `os_district` VALUES ('450201', '市辖区', '3', '450200');
INSERT INTO `os_district` VALUES ('450202', '城中区', '3', '450200');
INSERT INTO `os_district` VALUES ('450203', '鱼峰区', '3', '450200');
INSERT INTO `os_district` VALUES ('450204', '柳南区', '3', '450200');
INSERT INTO `os_district` VALUES ('450205', '柳北区', '3', '450200');
INSERT INTO `os_district` VALUES ('450221', '柳江县', '3', '450200');
INSERT INTO `os_district` VALUES ('450222', '柳城县', '3', '450200');
INSERT INTO `os_district` VALUES ('450223', '鹿寨县', '3', '450200');
INSERT INTO `os_district` VALUES ('450224', '融安县', '3', '450200');
INSERT INTO `os_district` VALUES ('450225', '融水苗族自治县', '3', '450200');
INSERT INTO `os_district` VALUES ('450226', '三江侗族自治县', '3', '450200');
INSERT INTO `os_district` VALUES ('450301', '市辖区', '3', '450300');
INSERT INTO `os_district` VALUES ('450302', '秀峰区', '3', '450300');
INSERT INTO `os_district` VALUES ('450303', '叠彩区', '3', '450300');
INSERT INTO `os_district` VALUES ('450304', '象山区', '3', '450300');
INSERT INTO `os_district` VALUES ('450305', '七星区', '3', '450300');
INSERT INTO `os_district` VALUES ('450311', '雁山区', '3', '450300');
INSERT INTO `os_district` VALUES ('450321', '阳朔县', '3', '450300');
INSERT INTO `os_district` VALUES ('450322', '临桂县', '3', '450300');
INSERT INTO `os_district` VALUES ('450323', '灵川县', '3', '450300');
INSERT INTO `os_district` VALUES ('450324', '全州县', '3', '450300');
INSERT INTO `os_district` VALUES ('450325', '兴安县', '3', '450300');
INSERT INTO `os_district` VALUES ('450326', '永福县', '3', '450300');
INSERT INTO `os_district` VALUES ('450327', '灌阳县', '3', '450300');
INSERT INTO `os_district` VALUES ('450328', '龙胜各族自治县', '3', '450300');
INSERT INTO `os_district` VALUES ('450329', '资源县', '3', '450300');
INSERT INTO `os_district` VALUES ('450330', '平乐县', '3', '450300');
INSERT INTO `os_district` VALUES ('450331', '荔蒲县', '3', '450300');
INSERT INTO `os_district` VALUES ('450332', '恭城瑶族自治县', '3', '450300');
INSERT INTO `os_district` VALUES ('450401', '市辖区', '3', '450400');
INSERT INTO `os_district` VALUES ('450403', '万秀区', '3', '450400');
INSERT INTO `os_district` VALUES ('450404', '蝶山区', '3', '450400');
INSERT INTO `os_district` VALUES ('450405', '长洲区', '3', '450400');
INSERT INTO `os_district` VALUES ('450421', '苍梧县', '3', '450400');
INSERT INTO `os_district` VALUES ('450422', '藤　县', '3', '450400');
INSERT INTO `os_district` VALUES ('450423', '蒙山县', '3', '450400');
INSERT INTO `os_district` VALUES ('450481', '岑溪市', '3', '450400');
INSERT INTO `os_district` VALUES ('450501', '市辖区', '3', '450500');
INSERT INTO `os_district` VALUES ('450502', '海城区', '3', '450500');
INSERT INTO `os_district` VALUES ('450503', '银海区', '3', '450500');
INSERT INTO `os_district` VALUES ('450512', '铁山港区', '3', '450500');
INSERT INTO `os_district` VALUES ('450521', '合浦县', '3', '450500');
INSERT INTO `os_district` VALUES ('450601', '市辖区', '3', '450600');
INSERT INTO `os_district` VALUES ('450602', '港口区', '3', '450600');
INSERT INTO `os_district` VALUES ('450603', '防城区', '3', '450600');
INSERT INTO `os_district` VALUES ('450621', '上思县', '3', '450600');
INSERT INTO `os_district` VALUES ('450681', '东兴市', '3', '450600');
INSERT INTO `os_district` VALUES ('450701', '市辖区', '3', '450700');
INSERT INTO `os_district` VALUES ('450702', '钦南区', '3', '450700');
INSERT INTO `os_district` VALUES ('450703', '钦北区', '3', '450700');
INSERT INTO `os_district` VALUES ('450721', '灵山县', '3', '450700');
INSERT INTO `os_district` VALUES ('450722', '浦北县', '3', '450700');
INSERT INTO `os_district` VALUES ('450801', '市辖区', '3', '450800');
INSERT INTO `os_district` VALUES ('450802', '港北区', '3', '450800');
INSERT INTO `os_district` VALUES ('450803', '港南区', '3', '450800');
INSERT INTO `os_district` VALUES ('450804', '覃塘区', '3', '450800');
INSERT INTO `os_district` VALUES ('450821', '平南县', '3', '450800');
INSERT INTO `os_district` VALUES ('450881', '桂平市', '3', '450800');
INSERT INTO `os_district` VALUES ('450901', '市辖区', '3', '450900');
INSERT INTO `os_district` VALUES ('450902', '玉州区', '3', '450900');
INSERT INTO `os_district` VALUES ('450921', '容　县', '3', '450900');
INSERT INTO `os_district` VALUES ('450922', '陆川县', '3', '450900');
INSERT INTO `os_district` VALUES ('450923', '博白县', '3', '450900');
INSERT INTO `os_district` VALUES ('450924', '兴业县', '3', '450900');
INSERT INTO `os_district` VALUES ('450981', '北流市', '3', '450900');
INSERT INTO `os_district` VALUES ('451001', '市辖区', '3', '451000');
INSERT INTO `os_district` VALUES ('451002', '右江区', '3', '451000');
INSERT INTO `os_district` VALUES ('451021', '田阳县', '3', '451000');
INSERT INTO `os_district` VALUES ('451022', '田东县', '3', '451000');
INSERT INTO `os_district` VALUES ('451023', '平果县', '3', '451000');
INSERT INTO `os_district` VALUES ('451024', '德保县', '3', '451000');
INSERT INTO `os_district` VALUES ('451025', '靖西县', '3', '451000');
INSERT INTO `os_district` VALUES ('451026', '那坡县', '3', '451000');
INSERT INTO `os_district` VALUES ('451027', '凌云县', '3', '451000');
INSERT INTO `os_district` VALUES ('451028', '乐业县', '3', '451000');
INSERT INTO `os_district` VALUES ('451029', '田林县', '3', '451000');
INSERT INTO `os_district` VALUES ('451030', '西林县', '3', '451000');
INSERT INTO `os_district` VALUES ('451031', '隆林各族自治县', '3', '451000');
INSERT INTO `os_district` VALUES ('451101', '市辖区', '3', '451100');
INSERT INTO `os_district` VALUES ('451102', '八步区', '3', '451100');
INSERT INTO `os_district` VALUES ('451121', '昭平县', '3', '451100');
INSERT INTO `os_district` VALUES ('451122', '钟山县', '3', '451100');
INSERT INTO `os_district` VALUES ('451123', '富川瑶族自治县', '3', '451100');
INSERT INTO `os_district` VALUES ('451201', '市辖区', '3', '451200');
INSERT INTO `os_district` VALUES ('451202', '金城江区', '3', '451200');
INSERT INTO `os_district` VALUES ('451221', '南丹县', '3', '451200');
INSERT INTO `os_district` VALUES ('451222', '天峨县', '3', '451200');
INSERT INTO `os_district` VALUES ('451223', '凤山县', '3', '451200');
INSERT INTO `os_district` VALUES ('451224', '东兰县', '3', '451200');
INSERT INTO `os_district` VALUES ('451225', '罗城仫佬族自治县', '3', '451200');
INSERT INTO `os_district` VALUES ('451226', '环江毛南族自治县', '3', '451200');
INSERT INTO `os_district` VALUES ('451227', '巴马瑶族自治县', '3', '451200');
INSERT INTO `os_district` VALUES ('451228', '都安瑶族自治县', '3', '451200');
INSERT INTO `os_district` VALUES ('451229', '大化瑶族自治县', '3', '451200');
INSERT INTO `os_district` VALUES ('451281', '宜州市', '3', '451200');
INSERT INTO `os_district` VALUES ('451301', '市辖区', '3', '451300');
INSERT INTO `os_district` VALUES ('451302', '兴宾区', '3', '451300');
INSERT INTO `os_district` VALUES ('451321', '忻城县', '3', '451300');
INSERT INTO `os_district` VALUES ('451322', '象州县', '3', '451300');
INSERT INTO `os_district` VALUES ('451323', '武宣县', '3', '451300');
INSERT INTO `os_district` VALUES ('451324', '金秀瑶族自治县', '3', '451300');
INSERT INTO `os_district` VALUES ('451381', '合山市', '3', '451300');
INSERT INTO `os_district` VALUES ('451401', '市辖区', '3', '451400');
INSERT INTO `os_district` VALUES ('451402', '江洲区', '3', '451400');
INSERT INTO `os_district` VALUES ('451421', '扶绥县', '3', '451400');
INSERT INTO `os_district` VALUES ('451422', '宁明县', '3', '451400');
INSERT INTO `os_district` VALUES ('451423', '龙州县', '3', '451400');
INSERT INTO `os_district` VALUES ('451424', '大新县', '3', '451400');
INSERT INTO `os_district` VALUES ('451425', '天等县', '3', '451400');
INSERT INTO `os_district` VALUES ('451481', '凭祥市', '3', '451400');
INSERT INTO `os_district` VALUES ('460101', '市辖区', '3', '460100');
INSERT INTO `os_district` VALUES ('460105', '秀英区', '3', '460100');
INSERT INTO `os_district` VALUES ('460106', '龙华区', '3', '460100');
INSERT INTO `os_district` VALUES ('460107', '琼山区', '3', '460100');
INSERT INTO `os_district` VALUES ('460108', '美兰区', '3', '460100');
INSERT INTO `os_district` VALUES ('460201', '市辖区', '3', '460200');
INSERT INTO `os_district` VALUES ('469001', '五指山市', '3', '469000');
INSERT INTO `os_district` VALUES ('469002', '琼海市', '3', '469000');
INSERT INTO `os_district` VALUES ('469003', '儋州市', '3', '469000');
INSERT INTO `os_district` VALUES ('469005', '文昌市', '3', '469000');
INSERT INTO `os_district` VALUES ('469006', '万宁市', '3', '469000');
INSERT INTO `os_district` VALUES ('469007', '东方市', '3', '469000');
INSERT INTO `os_district` VALUES ('469025', '定安县', '3', '469000');
INSERT INTO `os_district` VALUES ('469026', '屯昌县', '3', '469000');
INSERT INTO `os_district` VALUES ('469027', '澄迈县', '3', '469000');
INSERT INTO `os_district` VALUES ('469028', '临高县', '3', '469000');
INSERT INTO `os_district` VALUES ('469030', '白沙黎族自治县', '3', '469000');
INSERT INTO `os_district` VALUES ('469031', '昌江黎族自治县', '3', '469000');
INSERT INTO `os_district` VALUES ('469033', '乐东黎族自治县', '3', '469000');
INSERT INTO `os_district` VALUES ('469034', '陵水黎族自治县', '3', '469000');
INSERT INTO `os_district` VALUES ('469035', '保亭黎族苗族自治县', '3', '469000');
INSERT INTO `os_district` VALUES ('469036', '琼中黎族苗族自治县', '3', '469000');
INSERT INTO `os_district` VALUES ('469037', '西沙群岛', '3', '469000');
INSERT INTO `os_district` VALUES ('469038', '南沙群岛', '3', '469000');
INSERT INTO `os_district` VALUES ('469039', '中沙群岛的岛礁及其海域', '3', '469000');
INSERT INTO `os_district` VALUES ('500101', '万州区', '3', '500100');
INSERT INTO `os_district` VALUES ('500102', '涪陵区', '3', '500100');
INSERT INTO `os_district` VALUES ('500103', '渝中区', '3', '500100');
INSERT INTO `os_district` VALUES ('500104', '大渡口区', '3', '500100');
INSERT INTO `os_district` VALUES ('500105', '江北区', '3', '500100');
INSERT INTO `os_district` VALUES ('500106', '沙坪坝区', '3', '500100');
INSERT INTO `os_district` VALUES ('500107', '九龙坡区', '3', '500100');
INSERT INTO `os_district` VALUES ('500108', '南岸区', '3', '500100');
INSERT INTO `os_district` VALUES ('500109', '北碚区', '3', '500100');
INSERT INTO `os_district` VALUES ('500110', '万盛区', '3', '500100');
INSERT INTO `os_district` VALUES ('500111', '双桥区', '3', '500100');
INSERT INTO `os_district` VALUES ('500112', '渝北区', '3', '500100');
INSERT INTO `os_district` VALUES ('500113', '巴南区', '3', '500100');
INSERT INTO `os_district` VALUES ('500114', '黔江区', '3', '500100');
INSERT INTO `os_district` VALUES ('500115', '长寿区', '3', '500100');
INSERT INTO `os_district` VALUES ('500222', '綦江县', '3', '500200');
INSERT INTO `os_district` VALUES ('500223', '潼南县', '3', '500200');
INSERT INTO `os_district` VALUES ('500224', '铜梁县', '3', '500200');
INSERT INTO `os_district` VALUES ('500225', '大足县', '3', '500200');
INSERT INTO `os_district` VALUES ('500226', '荣昌县', '3', '500200');
INSERT INTO `os_district` VALUES ('500227', '璧山县', '3', '500200');
INSERT INTO `os_district` VALUES ('500228', '梁平县', '3', '500200');
INSERT INTO `os_district` VALUES ('500229', '城口县', '3', '500200');
INSERT INTO `os_district` VALUES ('500230', '丰都县', '3', '500200');
INSERT INTO `os_district` VALUES ('500231', '垫江县', '3', '500200');
INSERT INTO `os_district` VALUES ('500232', '武隆县', '3', '500200');
INSERT INTO `os_district` VALUES ('500233', '忠　县', '3', '500200');
INSERT INTO `os_district` VALUES ('500234', '开　县', '3', '500200');
INSERT INTO `os_district` VALUES ('500235', '云阳县', '3', '500200');
INSERT INTO `os_district` VALUES ('500236', '奉节县', '3', '500200');
INSERT INTO `os_district` VALUES ('500237', '巫山县', '3', '500200');
INSERT INTO `os_district` VALUES ('500238', '巫溪县', '3', '500200');
INSERT INTO `os_district` VALUES ('500240', '石柱土家族自治县', '3', '500200');
INSERT INTO `os_district` VALUES ('500241', '秀山土家族苗族自治县', '3', '500200');
INSERT INTO `os_district` VALUES ('500242', '酉阳土家族苗族自治县', '3', '500200');
INSERT INTO `os_district` VALUES ('500243', '彭水苗族土家族自治县', '3', '500200');
INSERT INTO `os_district` VALUES ('500381', '江津市', '3', '500300');
INSERT INTO `os_district` VALUES ('500382', '合川市', '3', '500300');
INSERT INTO `os_district` VALUES ('500383', '永川市', '3', '500300');
INSERT INTO `os_district` VALUES ('500384', '南川市', '3', '500300');
INSERT INTO `os_district` VALUES ('510101', '市辖区', '3', '510100');
INSERT INTO `os_district` VALUES ('510104', '锦江区', '3', '510100');
INSERT INTO `os_district` VALUES ('510105', '青羊区', '3', '510100');
INSERT INTO `os_district` VALUES ('510106', '金牛区', '3', '510100');
INSERT INTO `os_district` VALUES ('510107', '武侯区', '3', '510100');
INSERT INTO `os_district` VALUES ('510108', '成华区', '3', '510100');
INSERT INTO `os_district` VALUES ('510112', '龙泉驿区', '3', '510100');
INSERT INTO `os_district` VALUES ('510113', '青白江区', '3', '510100');
INSERT INTO `os_district` VALUES ('510114', '新都区', '3', '510100');
INSERT INTO `os_district` VALUES ('510115', '温江区', '3', '510100');
INSERT INTO `os_district` VALUES ('510121', '金堂县', '3', '510100');
INSERT INTO `os_district` VALUES ('510122', '双流县', '3', '510100');
INSERT INTO `os_district` VALUES ('510124', '郫　县', '3', '510100');
INSERT INTO `os_district` VALUES ('510129', '大邑县', '3', '510100');
INSERT INTO `os_district` VALUES ('510131', '蒲江县', '3', '510100');
INSERT INTO `os_district` VALUES ('510132', '新津县', '3', '510100');
INSERT INTO `os_district` VALUES ('510181', '都江堰市', '3', '510100');
INSERT INTO `os_district` VALUES ('510182', '彭州市', '3', '510100');
INSERT INTO `os_district` VALUES ('510183', '邛崃市', '3', '510100');
INSERT INTO `os_district` VALUES ('510184', '崇州市', '3', '510100');
INSERT INTO `os_district` VALUES ('510301', '市辖区', '3', '510300');
INSERT INTO `os_district` VALUES ('510302', '自流井区', '3', '510300');
INSERT INTO `os_district` VALUES ('510303', '贡井区', '3', '510300');
INSERT INTO `os_district` VALUES ('510304', '大安区', '3', '510300');
INSERT INTO `os_district` VALUES ('510311', '沿滩区', '3', '510300');
INSERT INTO `os_district` VALUES ('510321', '荣　县', '3', '510300');
INSERT INTO `os_district` VALUES ('510322', '富顺县', '3', '510300');
INSERT INTO `os_district` VALUES ('510401', '市辖区', '3', '510400');
INSERT INTO `os_district` VALUES ('510402', '东　区', '3', '510400');
INSERT INTO `os_district` VALUES ('510403', '西　区', '3', '510400');
INSERT INTO `os_district` VALUES ('510411', '仁和区', '3', '510400');
INSERT INTO `os_district` VALUES ('510421', '米易县', '3', '510400');
INSERT INTO `os_district` VALUES ('510422', '盐边县', '3', '510400');
INSERT INTO `os_district` VALUES ('510501', '市辖区', '3', '510500');
INSERT INTO `os_district` VALUES ('510502', '江阳区', '3', '510500');
INSERT INTO `os_district` VALUES ('510503', '纳溪区', '3', '510500');
INSERT INTO `os_district` VALUES ('510504', '龙马潭区', '3', '510500');
INSERT INTO `os_district` VALUES ('510521', '泸　县', '3', '510500');
INSERT INTO `os_district` VALUES ('510522', '合江县', '3', '510500');
INSERT INTO `os_district` VALUES ('510524', '叙永县', '3', '510500');
INSERT INTO `os_district` VALUES ('510525', '古蔺县', '3', '510500');
INSERT INTO `os_district` VALUES ('510601', '市辖区', '3', '510600');
INSERT INTO `os_district` VALUES ('510603', '旌阳区', '3', '510600');
INSERT INTO `os_district` VALUES ('510623', '中江县', '3', '510600');
INSERT INTO `os_district` VALUES ('510626', '罗江县', '3', '510600');
INSERT INTO `os_district` VALUES ('510681', '广汉市', '3', '510600');
INSERT INTO `os_district` VALUES ('510682', '什邡市', '3', '510600');
INSERT INTO `os_district` VALUES ('510683', '绵竹市', '3', '510600');
INSERT INTO `os_district` VALUES ('510701', '市辖区', '3', '510700');
INSERT INTO `os_district` VALUES ('510703', '涪城区', '3', '510700');
INSERT INTO `os_district` VALUES ('510704', '游仙区', '3', '510700');
INSERT INTO `os_district` VALUES ('510722', '三台县', '3', '510700');
INSERT INTO `os_district` VALUES ('510723', '盐亭县', '3', '510700');
INSERT INTO `os_district` VALUES ('510724', '安　县', '3', '510700');
INSERT INTO `os_district` VALUES ('510725', '梓潼县', '3', '510700');
INSERT INTO `os_district` VALUES ('510726', '北川羌族自治县', '3', '510700');
INSERT INTO `os_district` VALUES ('510727', '平武县', '3', '510700');
INSERT INTO `os_district` VALUES ('510781', '江油市', '3', '510700');
INSERT INTO `os_district` VALUES ('510801', '市辖区', '3', '510800');
INSERT INTO `os_district` VALUES ('510802', '市中区', '3', '510800');
INSERT INTO `os_district` VALUES ('510811', '元坝区', '3', '510800');
INSERT INTO `os_district` VALUES ('510812', '朝天区', '3', '510800');
INSERT INTO `os_district` VALUES ('510821', '旺苍县', '3', '510800');
INSERT INTO `os_district` VALUES ('510822', '青川县', '3', '510800');
INSERT INTO `os_district` VALUES ('510823', '剑阁县', '3', '510800');
INSERT INTO `os_district` VALUES ('510824', '苍溪县', '3', '510800');
INSERT INTO `os_district` VALUES ('510901', '市辖区', '3', '510900');
INSERT INTO `os_district` VALUES ('510903', '船山区', '3', '510900');
INSERT INTO `os_district` VALUES ('510904', '安居区', '3', '510900');
INSERT INTO `os_district` VALUES ('510921', '蓬溪县', '3', '510900');
INSERT INTO `os_district` VALUES ('510922', '射洪县', '3', '510900');
INSERT INTO `os_district` VALUES ('510923', '大英县', '3', '510900');
INSERT INTO `os_district` VALUES ('511001', '市辖区', '3', '511000');
INSERT INTO `os_district` VALUES ('511002', '市中区', '3', '511000');
INSERT INTO `os_district` VALUES ('511011', '东兴区', '3', '511000');
INSERT INTO `os_district` VALUES ('511024', '威远县', '3', '511000');
INSERT INTO `os_district` VALUES ('511025', '资中县', '3', '511000');
INSERT INTO `os_district` VALUES ('511028', '隆昌县', '3', '511000');
INSERT INTO `os_district` VALUES ('511101', '市辖区', '3', '511100');
INSERT INTO `os_district` VALUES ('511102', '市中区', '3', '511100');
INSERT INTO `os_district` VALUES ('511111', '沙湾区', '3', '511100');
INSERT INTO `os_district` VALUES ('511112', '五通桥区', '3', '511100');
INSERT INTO `os_district` VALUES ('511113', '金口河区', '3', '511100');
INSERT INTO `os_district` VALUES ('511123', '犍为县', '3', '511100');
INSERT INTO `os_district` VALUES ('511124', '井研县', '3', '511100');
INSERT INTO `os_district` VALUES ('511126', '夹江县', '3', '511100');
INSERT INTO `os_district` VALUES ('511129', '沐川县', '3', '511100');
INSERT INTO `os_district` VALUES ('511132', '峨边彝族自治县', '3', '511100');
INSERT INTO `os_district` VALUES ('511133', '马边彝族自治县', '3', '511100');
INSERT INTO `os_district` VALUES ('511181', '峨眉山市', '3', '511100');
INSERT INTO `os_district` VALUES ('511301', '市辖区', '3', '511300');
INSERT INTO `os_district` VALUES ('511302', '顺庆区', '3', '511300');
INSERT INTO `os_district` VALUES ('511303', '高坪区', '3', '511300');
INSERT INTO `os_district` VALUES ('511304', '嘉陵区', '3', '511300');
INSERT INTO `os_district` VALUES ('511321', '南部县', '3', '511300');
INSERT INTO `os_district` VALUES ('511322', '营山县', '3', '511300');
INSERT INTO `os_district` VALUES ('511323', '蓬安县', '3', '511300');
INSERT INTO `os_district` VALUES ('511324', '仪陇县', '3', '511300');
INSERT INTO `os_district` VALUES ('511325', '西充县', '3', '511300');
INSERT INTO `os_district` VALUES ('511381', '阆中市', '3', '511300');
INSERT INTO `os_district` VALUES ('511401', '市辖区', '3', '511400');
INSERT INTO `os_district` VALUES ('511402', '东坡区', '3', '511400');
INSERT INTO `os_district` VALUES ('511421', '仁寿县', '3', '511400');
INSERT INTO `os_district` VALUES ('511422', '彭山县', '3', '511400');
INSERT INTO `os_district` VALUES ('511423', '洪雅县', '3', '511400');
INSERT INTO `os_district` VALUES ('511424', '丹棱县', '3', '511400');
INSERT INTO `os_district` VALUES ('511425', '青神县', '3', '511400');
INSERT INTO `os_district` VALUES ('511501', '市辖区', '3', '511500');
INSERT INTO `os_district` VALUES ('511502', '翠屏区', '3', '511500');
INSERT INTO `os_district` VALUES ('511521', '宜宾县', '3', '511500');
INSERT INTO `os_district` VALUES ('511522', '南溪县', '3', '511500');
INSERT INTO `os_district` VALUES ('511523', '江安县', '3', '511500');
INSERT INTO `os_district` VALUES ('511524', '长宁县', '3', '511500');
INSERT INTO `os_district` VALUES ('511525', '高　县', '3', '511500');
INSERT INTO `os_district` VALUES ('511526', '珙　县', '3', '511500');
INSERT INTO `os_district` VALUES ('511527', '筠连县', '3', '511500');
INSERT INTO `os_district` VALUES ('511528', '兴文县', '3', '511500');
INSERT INTO `os_district` VALUES ('511529', '屏山县', '3', '511500');
INSERT INTO `os_district` VALUES ('511601', '市辖区', '3', '511600');
INSERT INTO `os_district` VALUES ('511602', '广安区', '3', '511600');
INSERT INTO `os_district` VALUES ('511621', '岳池县', '3', '511600');
INSERT INTO `os_district` VALUES ('511622', '武胜县', '3', '511600');
INSERT INTO `os_district` VALUES ('511623', '邻水县', '3', '511600');
INSERT INTO `os_district` VALUES ('511681', '华莹市', '3', '511600');
INSERT INTO `os_district` VALUES ('511701', '市辖区', '3', '511700');
INSERT INTO `os_district` VALUES ('511702', '通川区', '3', '511700');
INSERT INTO `os_district` VALUES ('511721', '达　县', '3', '511700');
INSERT INTO `os_district` VALUES ('511722', '宣汉县', '3', '511700');
INSERT INTO `os_district` VALUES ('511723', '开江县', '3', '511700');
INSERT INTO `os_district` VALUES ('511724', '大竹县', '3', '511700');
INSERT INTO `os_district` VALUES ('511725', '渠　县', '3', '511700');
INSERT INTO `os_district` VALUES ('511781', '万源市', '3', '511700');
INSERT INTO `os_district` VALUES ('511801', '市辖区', '3', '511800');
INSERT INTO `os_district` VALUES ('511802', '雨城区', '3', '511800');
INSERT INTO `os_district` VALUES ('511821', '名山县', '3', '511800');
INSERT INTO `os_district` VALUES ('511822', '荥经县', '3', '511800');
INSERT INTO `os_district` VALUES ('511823', '汉源县', '3', '511800');
INSERT INTO `os_district` VALUES ('511824', '石棉县', '3', '511800');
INSERT INTO `os_district` VALUES ('511825', '天全县', '3', '511800');
INSERT INTO `os_district` VALUES ('511826', '芦山县', '3', '511800');
INSERT INTO `os_district` VALUES ('511827', '宝兴县', '3', '511800');
INSERT INTO `os_district` VALUES ('511901', '市辖区', '3', '511900');
INSERT INTO `os_district` VALUES ('511902', '巴州区', '3', '511900');
INSERT INTO `os_district` VALUES ('511921', '通江县', '3', '511900');
INSERT INTO `os_district` VALUES ('511922', '南江县', '3', '511900');
INSERT INTO `os_district` VALUES ('511923', '平昌县', '3', '511900');
INSERT INTO `os_district` VALUES ('512001', '市辖区', '3', '512000');
INSERT INTO `os_district` VALUES ('512002', '雁江区', '3', '512000');
INSERT INTO `os_district` VALUES ('512021', '安岳县', '3', '512000');
INSERT INTO `os_district` VALUES ('512022', '乐至县', '3', '512000');
INSERT INTO `os_district` VALUES ('512081', '简阳市', '3', '512000');
INSERT INTO `os_district` VALUES ('513221', '汶川县', '3', '513200');
INSERT INTO `os_district` VALUES ('513222', '理　县', '3', '513200');
INSERT INTO `os_district` VALUES ('513223', '茂　县', '3', '513200');
INSERT INTO `os_district` VALUES ('513224', '松潘县', '3', '513200');
INSERT INTO `os_district` VALUES ('513225', '九寨沟县', '3', '513200');
INSERT INTO `os_district` VALUES ('513226', '金川县', '3', '513200');
INSERT INTO `os_district` VALUES ('513227', '小金县', '3', '513200');
INSERT INTO `os_district` VALUES ('513228', '黑水县', '3', '513200');
INSERT INTO `os_district` VALUES ('513229', '马尔康县', '3', '513200');
INSERT INTO `os_district` VALUES ('513230', '壤塘县', '3', '513200');
INSERT INTO `os_district` VALUES ('513231', '阿坝县', '3', '513200');
INSERT INTO `os_district` VALUES ('513232', '若尔盖县', '3', '513200');
INSERT INTO `os_district` VALUES ('513233', '红原县', '3', '513200');
INSERT INTO `os_district` VALUES ('513321', '康定县', '3', '513300');
INSERT INTO `os_district` VALUES ('513322', '泸定县', '3', '513300');
INSERT INTO `os_district` VALUES ('513323', '丹巴县', '3', '513300');
INSERT INTO `os_district` VALUES ('513324', '九龙县', '3', '513300');
INSERT INTO `os_district` VALUES ('513325', '雅江县', '3', '513300');
INSERT INTO `os_district` VALUES ('513326', '道孚县', '3', '513300');
INSERT INTO `os_district` VALUES ('513327', '炉霍县', '3', '513300');
INSERT INTO `os_district` VALUES ('513328', '甘孜县', '3', '513300');
INSERT INTO `os_district` VALUES ('513329', '新龙县', '3', '513300');
INSERT INTO `os_district` VALUES ('513330', '德格县', '3', '513300');
INSERT INTO `os_district` VALUES ('513331', '白玉县', '3', '513300');
INSERT INTO `os_district` VALUES ('513332', '石渠县', '3', '513300');
INSERT INTO `os_district` VALUES ('513333', '色达县', '3', '513300');
INSERT INTO `os_district` VALUES ('513334', '理塘县', '3', '513300');
INSERT INTO `os_district` VALUES ('513335', '巴塘县', '3', '513300');
INSERT INTO `os_district` VALUES ('513336', '乡城县', '3', '513300');
INSERT INTO `os_district` VALUES ('513337', '稻城县', '3', '513300');
INSERT INTO `os_district` VALUES ('513338', '得荣县', '3', '513300');
INSERT INTO `os_district` VALUES ('513401', '西昌市', '3', '513400');
INSERT INTO `os_district` VALUES ('513422', '木里藏族自治县', '3', '513400');
INSERT INTO `os_district` VALUES ('513423', '盐源县', '3', '513400');
INSERT INTO `os_district` VALUES ('513424', '德昌县', '3', '513400');
INSERT INTO `os_district` VALUES ('513425', '会理县', '3', '513400');
INSERT INTO `os_district` VALUES ('513426', '会东县', '3', '513400');
INSERT INTO `os_district` VALUES ('513427', '宁南县', '3', '513400');
INSERT INTO `os_district` VALUES ('513428', '普格县', '3', '513400');
INSERT INTO `os_district` VALUES ('513429', '布拖县', '3', '513400');
INSERT INTO `os_district` VALUES ('513430', '金阳县', '3', '513400');
INSERT INTO `os_district` VALUES ('513431', '昭觉县', '3', '513400');
INSERT INTO `os_district` VALUES ('513432', '喜德县', '3', '513400');
INSERT INTO `os_district` VALUES ('513433', '冕宁县', '3', '513400');
INSERT INTO `os_district` VALUES ('513434', '越西县', '3', '513400');
INSERT INTO `os_district` VALUES ('513435', '甘洛县', '3', '513400');
INSERT INTO `os_district` VALUES ('513436', '美姑县', '3', '513400');
INSERT INTO `os_district` VALUES ('513437', '雷波县', '3', '513400');
INSERT INTO `os_district` VALUES ('520101', '市辖区', '3', '520100');
INSERT INTO `os_district` VALUES ('520102', '南明区', '3', '520100');
INSERT INTO `os_district` VALUES ('520103', '云岩区', '3', '520100');
INSERT INTO `os_district` VALUES ('520111', '花溪区', '3', '520100');
INSERT INTO `os_district` VALUES ('520112', '乌当区', '3', '520100');
INSERT INTO `os_district` VALUES ('520113', '白云区', '3', '520100');
INSERT INTO `os_district` VALUES ('520114', '小河区', '3', '520100');
INSERT INTO `os_district` VALUES ('520121', '开阳县', '3', '520100');
INSERT INTO `os_district` VALUES ('520122', '息烽县', '3', '520100');
INSERT INTO `os_district` VALUES ('520123', '修文县', '3', '520100');
INSERT INTO `os_district` VALUES ('520181', '清镇市', '3', '520100');
INSERT INTO `os_district` VALUES ('520201', '钟山区', '3', '520200');
INSERT INTO `os_district` VALUES ('520203', '六枝特区', '3', '520200');
INSERT INTO `os_district` VALUES ('520221', '水城县', '3', '520200');
INSERT INTO `os_district` VALUES ('520222', '盘　县', '3', '520200');
INSERT INTO `os_district` VALUES ('520301', '市辖区', '3', '520300');
INSERT INTO `os_district` VALUES ('520302', '红花岗区', '3', '520300');
INSERT INTO `os_district` VALUES ('520303', '汇川区', '3', '520300');
INSERT INTO `os_district` VALUES ('520321', '遵义县', '3', '520300');
INSERT INTO `os_district` VALUES ('520322', '桐梓县', '3', '520300');
INSERT INTO `os_district` VALUES ('520323', '绥阳县', '3', '520300');
INSERT INTO `os_district` VALUES ('520324', '正安县', '3', '520300');
INSERT INTO `os_district` VALUES ('520325', '道真仡佬族苗族自治县', '3', '520300');
INSERT INTO `os_district` VALUES ('520326', '务川仡佬族苗族自治县', '3', '520300');
INSERT INTO `os_district` VALUES ('520327', '凤冈县', '3', '520300');
INSERT INTO `os_district` VALUES ('520328', '湄潭县', '3', '520300');
INSERT INTO `os_district` VALUES ('520329', '余庆县', '3', '520300');
INSERT INTO `os_district` VALUES ('520330', '习水县', '3', '520300');
INSERT INTO `os_district` VALUES ('520381', '赤水市', '3', '520300');
INSERT INTO `os_district` VALUES ('520382', '仁怀市', '3', '520300');
INSERT INTO `os_district` VALUES ('520401', '市辖区', '3', '520400');
INSERT INTO `os_district` VALUES ('520402', '西秀区', '3', '520400');
INSERT INTO `os_district` VALUES ('520421', '平坝县', '3', '520400');
INSERT INTO `os_district` VALUES ('520422', '普定县', '3', '520400');
INSERT INTO `os_district` VALUES ('520423', '镇宁布依族苗族自治县', '3', '520400');
INSERT INTO `os_district` VALUES ('520424', '关岭布依族苗族自治县', '3', '520400');
INSERT INTO `os_district` VALUES ('520425', '紫云苗族布依族自治县', '3', '520400');
INSERT INTO `os_district` VALUES ('522201', '铜仁市', '3', '522200');
INSERT INTO `os_district` VALUES ('522222', '江口县', '3', '522200');
INSERT INTO `os_district` VALUES ('522223', '玉屏侗族自治县', '3', '522200');
INSERT INTO `os_district` VALUES ('522224', '石阡县', '3', '522200');
INSERT INTO `os_district` VALUES ('522225', '思南县', '3', '522200');
INSERT INTO `os_district` VALUES ('522226', '印江土家族苗族自治县', '3', '522200');
INSERT INTO `os_district` VALUES ('522227', '德江县', '3', '522200');
INSERT INTO `os_district` VALUES ('522228', '沿河土家族自治县', '3', '522200');
INSERT INTO `os_district` VALUES ('522229', '松桃苗族自治县', '3', '522200');
INSERT INTO `os_district` VALUES ('522230', '万山特区', '3', '522200');
INSERT INTO `os_district` VALUES ('522301', '兴义市', '3', '522300');
INSERT INTO `os_district` VALUES ('522322', '兴仁县', '3', '522300');
INSERT INTO `os_district` VALUES ('522323', '普安县', '3', '522300');
INSERT INTO `os_district` VALUES ('522324', '晴隆县', '3', '522300');
INSERT INTO `os_district` VALUES ('522325', '贞丰县', '3', '522300');
INSERT INTO `os_district` VALUES ('522326', '望谟县', '3', '522300');
INSERT INTO `os_district` VALUES ('522327', '册亨县', '3', '522300');
INSERT INTO `os_district` VALUES ('522328', '安龙县', '3', '522300');
INSERT INTO `os_district` VALUES ('522401', '毕节市', '3', '522400');
INSERT INTO `os_district` VALUES ('522422', '大方县', '3', '522400');
INSERT INTO `os_district` VALUES ('522423', '黔西县', '3', '522400');
INSERT INTO `os_district` VALUES ('522424', '金沙县', '3', '522400');
INSERT INTO `os_district` VALUES ('522425', '织金县', '3', '522400');
INSERT INTO `os_district` VALUES ('522426', '纳雍县', '3', '522400');
INSERT INTO `os_district` VALUES ('522427', '威宁彝族回族苗族自治县', '3', '522400');
INSERT INTO `os_district` VALUES ('522428', '赫章县', '3', '522400');
INSERT INTO `os_district` VALUES ('522601', '凯里市', '3', '522600');
INSERT INTO `os_district` VALUES ('522622', '黄平县', '3', '522600');
INSERT INTO `os_district` VALUES ('522623', '施秉县', '3', '522600');
INSERT INTO `os_district` VALUES ('522624', '三穗县', '3', '522600');
INSERT INTO `os_district` VALUES ('522625', '镇远县', '3', '522600');
INSERT INTO `os_district` VALUES ('522626', '岑巩县', '3', '522600');
INSERT INTO `os_district` VALUES ('522627', '天柱县', '3', '522600');
INSERT INTO `os_district` VALUES ('522628', '锦屏县', '3', '522600');
INSERT INTO `os_district` VALUES ('522629', '剑河县', '3', '522600');
INSERT INTO `os_district` VALUES ('522630', '台江县', '3', '522600');
INSERT INTO `os_district` VALUES ('522631', '黎平县', '3', '522600');
INSERT INTO `os_district` VALUES ('522632', '榕江县', '3', '522600');
INSERT INTO `os_district` VALUES ('522633', '从江县', '3', '522600');
INSERT INTO `os_district` VALUES ('522634', '雷山县', '3', '522600');
INSERT INTO `os_district` VALUES ('522635', '麻江县', '3', '522600');
INSERT INTO `os_district` VALUES ('522636', '丹寨县', '3', '522600');
INSERT INTO `os_district` VALUES ('522701', '都匀市', '3', '522700');
INSERT INTO `os_district` VALUES ('522702', '福泉市', '3', '522700');
INSERT INTO `os_district` VALUES ('522722', '荔波县', '3', '522700');
INSERT INTO `os_district` VALUES ('522723', '贵定县', '3', '522700');
INSERT INTO `os_district` VALUES ('522725', '瓮安县', '3', '522700');
INSERT INTO `os_district` VALUES ('522726', '独山县', '3', '522700');
INSERT INTO `os_district` VALUES ('522727', '平塘县', '3', '522700');
INSERT INTO `os_district` VALUES ('522728', '罗甸县', '3', '522700');
INSERT INTO `os_district` VALUES ('522729', '长顺县', '3', '522700');
INSERT INTO `os_district` VALUES ('522730', '龙里县', '3', '522700');
INSERT INTO `os_district` VALUES ('522731', '惠水县', '3', '522700');
INSERT INTO `os_district` VALUES ('522732', '三都水族自治县', '3', '522700');
INSERT INTO `os_district` VALUES ('530101', '市辖区', '3', '530100');
INSERT INTO `os_district` VALUES ('530102', '五华区', '3', '530100');
INSERT INTO `os_district` VALUES ('530103', '盘龙区', '3', '530100');
INSERT INTO `os_district` VALUES ('530111', '官渡区', '3', '530100');
INSERT INTO `os_district` VALUES ('530112', '西山区', '3', '530100');
INSERT INTO `os_district` VALUES ('530113', '东川区', '3', '530100');
INSERT INTO `os_district` VALUES ('530121', '呈贡县', '3', '530100');
INSERT INTO `os_district` VALUES ('530122', '晋宁县', '3', '530100');
INSERT INTO `os_district` VALUES ('530124', '富民县', '3', '530100');
INSERT INTO `os_district` VALUES ('530125', '宜良县', '3', '530100');
INSERT INTO `os_district` VALUES ('530126', '石林彝族自治县', '3', '530100');
INSERT INTO `os_district` VALUES ('530127', '嵩明县', '3', '530100');
INSERT INTO `os_district` VALUES ('530128', '禄劝彝族苗族自治县', '3', '530100');
INSERT INTO `os_district` VALUES ('530129', '寻甸回族彝族自治县', '3', '530100');
INSERT INTO `os_district` VALUES ('530181', '安宁市', '3', '530100');
INSERT INTO `os_district` VALUES ('530301', '市辖区', '3', '530300');
INSERT INTO `os_district` VALUES ('530302', '麒麟区', '3', '530300');
INSERT INTO `os_district` VALUES ('530321', '马龙县', '3', '530300');
INSERT INTO `os_district` VALUES ('530322', '陆良县', '3', '530300');
INSERT INTO `os_district` VALUES ('530323', '师宗县', '3', '530300');
INSERT INTO `os_district` VALUES ('530324', '罗平县', '3', '530300');
INSERT INTO `os_district` VALUES ('530325', '富源县', '3', '530300');
INSERT INTO `os_district` VALUES ('530326', '会泽县', '3', '530300');
INSERT INTO `os_district` VALUES ('530328', '沾益县', '3', '530300');
INSERT INTO `os_district` VALUES ('530381', '宣威市', '3', '530300');
INSERT INTO `os_district` VALUES ('530401', '市辖区', '3', '530400');
INSERT INTO `os_district` VALUES ('530402', '红塔区', '3', '530400');
INSERT INTO `os_district` VALUES ('530421', '江川县', '3', '530400');
INSERT INTO `os_district` VALUES ('530422', '澄江县', '3', '530400');
INSERT INTO `os_district` VALUES ('530423', '通海县', '3', '530400');
INSERT INTO `os_district` VALUES ('530424', '华宁县', '3', '530400');
INSERT INTO `os_district` VALUES ('530425', '易门县', '3', '530400');
INSERT INTO `os_district` VALUES ('530426', '峨山彝族自治县', '3', '530400');
INSERT INTO `os_district` VALUES ('530427', '新平彝族傣族自治县', '3', '530400');
INSERT INTO `os_district` VALUES ('530428', '元江哈尼族彝族傣族自治县', '3', '530400');
INSERT INTO `os_district` VALUES ('530501', '市辖区', '3', '530500');
INSERT INTO `os_district` VALUES ('530502', '隆阳区', '3', '530500');
INSERT INTO `os_district` VALUES ('530521', '施甸县', '3', '530500');
INSERT INTO `os_district` VALUES ('530522', '腾冲县', '3', '530500');
INSERT INTO `os_district` VALUES ('530523', '龙陵县', '3', '530500');
INSERT INTO `os_district` VALUES ('530524', '昌宁县', '3', '530500');
INSERT INTO `os_district` VALUES ('530601', '市辖区', '3', '530600');
INSERT INTO `os_district` VALUES ('530602', '昭阳区', '3', '530600');
INSERT INTO `os_district` VALUES ('530621', '鲁甸县', '3', '530600');
INSERT INTO `os_district` VALUES ('530622', '巧家县', '3', '530600');
INSERT INTO `os_district` VALUES ('530623', '盐津县', '3', '530600');
INSERT INTO `os_district` VALUES ('530624', '大关县', '3', '530600');
INSERT INTO `os_district` VALUES ('530625', '永善县', '3', '530600');
INSERT INTO `os_district` VALUES ('530626', '绥江县', '3', '530600');
INSERT INTO `os_district` VALUES ('530627', '镇雄县', '3', '530600');
INSERT INTO `os_district` VALUES ('530628', '彝良县', '3', '530600');
INSERT INTO `os_district` VALUES ('530629', '威信县', '3', '530600');
INSERT INTO `os_district` VALUES ('530630', '水富县', '3', '530600');
INSERT INTO `os_district` VALUES ('530701', '市辖区', '3', '530700');
INSERT INTO `os_district` VALUES ('530702', '古城区', '3', '530700');
INSERT INTO `os_district` VALUES ('530721', '玉龙纳西族自治县', '3', '530700');
INSERT INTO `os_district` VALUES ('530722', '永胜县', '3', '530700');
INSERT INTO `os_district` VALUES ('530723', '华坪县', '3', '530700');
INSERT INTO `os_district` VALUES ('530724', '宁蒗彝族自治县', '3', '530700');
INSERT INTO `os_district` VALUES ('530801', '市辖区', '3', '530800');
INSERT INTO `os_district` VALUES ('530802', '翠云区', '3', '530800');
INSERT INTO `os_district` VALUES ('530821', '普洱哈尼族彝族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530822', '墨江哈尼族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530823', '景东彝族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530824', '景谷傣族彝族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530825', '镇沅彝族哈尼族拉祜族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530826', '江城哈尼族彝族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530827', '孟连傣族拉祜族佤族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530828', '澜沧拉祜族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530829', '西盟佤族自治县', '3', '530800');
INSERT INTO `os_district` VALUES ('530901', '市辖区', '3', '530900');
INSERT INTO `os_district` VALUES ('530902', '临翔区', '3', '530900');
INSERT INTO `os_district` VALUES ('530921', '凤庆县', '3', '530900');
INSERT INTO `os_district` VALUES ('530922', '云　县', '3', '530900');
INSERT INTO `os_district` VALUES ('530923', '永德县', '3', '530900');
INSERT INTO `os_district` VALUES ('530924', '镇康县', '3', '530900');
INSERT INTO `os_district` VALUES ('530925', '双江拉祜族佤族布朗族傣族自治县', '3', '530900');
INSERT INTO `os_district` VALUES ('530926', '耿马傣族佤族自治县', '3', '530900');
INSERT INTO `os_district` VALUES ('530927', '沧源佤族自治县', '3', '530900');
INSERT INTO `os_district` VALUES ('532301', '楚雄市', '3', '532300');
INSERT INTO `os_district` VALUES ('532322', '双柏县', '3', '532300');
INSERT INTO `os_district` VALUES ('532323', '牟定县', '3', '532300');
INSERT INTO `os_district` VALUES ('532324', '南华县', '3', '532300');
INSERT INTO `os_district` VALUES ('532325', '姚安县', '3', '532300');
INSERT INTO `os_district` VALUES ('532326', '大姚县', '3', '532300');
INSERT INTO `os_district` VALUES ('532327', '永仁县', '3', '532300');
INSERT INTO `os_district` VALUES ('532328', '元谋县', '3', '532300');
INSERT INTO `os_district` VALUES ('532329', '武定县', '3', '532300');
INSERT INTO `os_district` VALUES ('532331', '禄丰县', '3', '532300');
INSERT INTO `os_district` VALUES ('532501', '个旧市', '3', '532500');
INSERT INTO `os_district` VALUES ('532502', '开远市', '3', '532500');
INSERT INTO `os_district` VALUES ('532522', '蒙自县', '3', '532500');
INSERT INTO `os_district` VALUES ('532523', '屏边苗族自治县', '3', '532500');
INSERT INTO `os_district` VALUES ('532524', '建水县', '3', '532500');
INSERT INTO `os_district` VALUES ('532525', '石屏县', '3', '532500');
INSERT INTO `os_district` VALUES ('532526', '弥勒县', '3', '532500');
INSERT INTO `os_district` VALUES ('532527', '泸西县', '3', '532500');
INSERT INTO `os_district` VALUES ('532528', '元阳县', '3', '532500');
INSERT INTO `os_district` VALUES ('532529', '红河县', '3', '532500');
INSERT INTO `os_district` VALUES ('532530', '金平苗族瑶族傣族自治县', '3', '532500');
INSERT INTO `os_district` VALUES ('532531', '绿春县', '3', '532500');
INSERT INTO `os_district` VALUES ('532532', '河口瑶族自治县', '3', '532500');
INSERT INTO `os_district` VALUES ('532621', '文山县', '3', '532600');
INSERT INTO `os_district` VALUES ('532622', '砚山县', '3', '532600');
INSERT INTO `os_district` VALUES ('532623', '西畴县', '3', '532600');
INSERT INTO `os_district` VALUES ('532624', '麻栗坡县', '3', '532600');
INSERT INTO `os_district` VALUES ('532625', '马关县', '3', '532600');
INSERT INTO `os_district` VALUES ('532626', '丘北县', '3', '532600');
INSERT INTO `os_district` VALUES ('532627', '广南县', '3', '532600');
INSERT INTO `os_district` VALUES ('532628', '富宁县', '3', '532600');
INSERT INTO `os_district` VALUES ('532801', '景洪市', '3', '532800');
INSERT INTO `os_district` VALUES ('532822', '勐海县', '3', '532800');
INSERT INTO `os_district` VALUES ('532823', '勐腊县', '3', '532800');
INSERT INTO `os_district` VALUES ('532901', '大理市', '3', '532900');
INSERT INTO `os_district` VALUES ('532922', '漾濞彝族自治县', '3', '532900');
INSERT INTO `os_district` VALUES ('532923', '祥云县', '3', '532900');
INSERT INTO `os_district` VALUES ('532924', '宾川县', '3', '532900');
INSERT INTO `os_district` VALUES ('532925', '弥渡县', '3', '532900');
INSERT INTO `os_district` VALUES ('532926', '南涧彝族自治县', '3', '532900');
INSERT INTO `os_district` VALUES ('532927', '巍山彝族回族自治县', '3', '532900');
INSERT INTO `os_district` VALUES ('532928', '永平县', '3', '532900');
INSERT INTO `os_district` VALUES ('532929', '云龙县', '3', '532900');
INSERT INTO `os_district` VALUES ('532930', '洱源县', '3', '532900');
INSERT INTO `os_district` VALUES ('532931', '剑川县', '3', '532900');
INSERT INTO `os_district` VALUES ('532932', '鹤庆县', '3', '532900');
INSERT INTO `os_district` VALUES ('533102', '瑞丽市', '3', '533100');
INSERT INTO `os_district` VALUES ('533103', '潞西市', '3', '533100');
INSERT INTO `os_district` VALUES ('533122', '梁河县', '3', '533100');
INSERT INTO `os_district` VALUES ('533123', '盈江县', '3', '533100');
INSERT INTO `os_district` VALUES ('533124', '陇川县', '3', '533100');
INSERT INTO `os_district` VALUES ('533321', '泸水县', '3', '533300');
INSERT INTO `os_district` VALUES ('533323', '福贡县', '3', '533300');
INSERT INTO `os_district` VALUES ('533324', '贡山独龙族怒族自治县', '3', '533300');
INSERT INTO `os_district` VALUES ('533325', '兰坪白族普米族自治县', '3', '533300');
INSERT INTO `os_district` VALUES ('533421', '香格里拉县', '3', '533400');
INSERT INTO `os_district` VALUES ('533422', '德钦县', '3', '533400');
INSERT INTO `os_district` VALUES ('533423', '维西傈僳族自治县', '3', '533400');
INSERT INTO `os_district` VALUES ('540101', '市辖区', '3', '540100');
INSERT INTO `os_district` VALUES ('540102', '城关区', '3', '540100');
INSERT INTO `os_district` VALUES ('540121', '林周县', '3', '540100');
INSERT INTO `os_district` VALUES ('540122', '当雄县', '3', '540100');
INSERT INTO `os_district` VALUES ('540123', '尼木县', '3', '540100');
INSERT INTO `os_district` VALUES ('540124', '曲水县', '3', '540100');
INSERT INTO `os_district` VALUES ('540125', '堆龙德庆县', '3', '540100');
INSERT INTO `os_district` VALUES ('540126', '达孜县', '3', '540100');
INSERT INTO `os_district` VALUES ('540127', '墨竹工卡县', '3', '540100');
INSERT INTO `os_district` VALUES ('542121', '昌都县', '3', '542100');
INSERT INTO `os_district` VALUES ('542122', '江达县', '3', '542100');
INSERT INTO `os_district` VALUES ('542123', '贡觉县', '3', '542100');
INSERT INTO `os_district` VALUES ('542124', '类乌齐县', '3', '542100');
INSERT INTO `os_district` VALUES ('542125', '丁青县', '3', '542100');
INSERT INTO `os_district` VALUES ('542126', '察雅县', '3', '542100');
INSERT INTO `os_district` VALUES ('542127', '八宿县', '3', '542100');
INSERT INTO `os_district` VALUES ('542128', '左贡县', '3', '542100');
INSERT INTO `os_district` VALUES ('542129', '芒康县', '3', '542100');
INSERT INTO `os_district` VALUES ('542132', '洛隆县', '3', '542100');
INSERT INTO `os_district` VALUES ('542133', '边坝县', '3', '542100');
INSERT INTO `os_district` VALUES ('542221', '乃东县', '3', '542200');
INSERT INTO `os_district` VALUES ('542222', '扎囊县', '3', '542200');
INSERT INTO `os_district` VALUES ('542223', '贡嘎县', '3', '542200');
INSERT INTO `os_district` VALUES ('542224', '桑日县', '3', '542200');
INSERT INTO `os_district` VALUES ('542225', '琼结县', '3', '542200');
INSERT INTO `os_district` VALUES ('542226', '曲松县', '3', '542200');
INSERT INTO `os_district` VALUES ('542227', '措美县', '3', '542200');
INSERT INTO `os_district` VALUES ('542228', '洛扎县', '3', '542200');
INSERT INTO `os_district` VALUES ('542229', '加查县', '3', '542200');
INSERT INTO `os_district` VALUES ('542231', '隆子县', '3', '542200');
INSERT INTO `os_district` VALUES ('542232', '错那县', '3', '542200');
INSERT INTO `os_district` VALUES ('542233', '浪卡子县', '3', '542200');
INSERT INTO `os_district` VALUES ('542301', '日喀则市', '3', '542300');
INSERT INTO `os_district` VALUES ('542322', '南木林县', '3', '542300');
INSERT INTO `os_district` VALUES ('542323', '江孜县', '3', '542300');
INSERT INTO `os_district` VALUES ('542324', '定日县', '3', '542300');
INSERT INTO `os_district` VALUES ('542325', '萨迦县', '3', '542300');
INSERT INTO `os_district` VALUES ('542326', '拉孜县', '3', '542300');
INSERT INTO `os_district` VALUES ('542327', '昂仁县', '3', '542300');
INSERT INTO `os_district` VALUES ('542328', '谢通门县', '3', '542300');
INSERT INTO `os_district` VALUES ('542329', '白朗县', '3', '542300');
INSERT INTO `os_district` VALUES ('542330', '仁布县', '3', '542300');
INSERT INTO `os_district` VALUES ('542331', '康马县', '3', '542300');
INSERT INTO `os_district` VALUES ('542332', '定结县', '3', '542300');
INSERT INTO `os_district` VALUES ('542333', '仲巴县', '3', '542300');
INSERT INTO `os_district` VALUES ('542334', '亚东县', '3', '542300');
INSERT INTO `os_district` VALUES ('542335', '吉隆县', '3', '542300');
INSERT INTO `os_district` VALUES ('542336', '聂拉木县', '3', '542300');
INSERT INTO `os_district` VALUES ('542337', '萨嘎县', '3', '542300');
INSERT INTO `os_district` VALUES ('542338', '岗巴县', '3', '542300');
INSERT INTO `os_district` VALUES ('542421', '那曲县', '3', '542400');
INSERT INTO `os_district` VALUES ('542422', '嘉黎县', '3', '542400');
INSERT INTO `os_district` VALUES ('542423', '比如县', '3', '542400');
INSERT INTO `os_district` VALUES ('542424', '聂荣县', '3', '542400');
INSERT INTO `os_district` VALUES ('542425', '安多县', '3', '542400');
INSERT INTO `os_district` VALUES ('542426', '申扎县', '3', '542400');
INSERT INTO `os_district` VALUES ('542427', '索　县', '3', '542400');
INSERT INTO `os_district` VALUES ('542428', '班戈县', '3', '542400');
INSERT INTO `os_district` VALUES ('542429', '巴青县', '3', '542400');
INSERT INTO `os_district` VALUES ('542430', '尼玛县', '3', '542400');
INSERT INTO `os_district` VALUES ('542521', '普兰县', '3', '542500');
INSERT INTO `os_district` VALUES ('542522', '札达县', '3', '542500');
INSERT INTO `os_district` VALUES ('542523', '噶尔县', '3', '542500');
INSERT INTO `os_district` VALUES ('542524', '日土县', '3', '542500');
INSERT INTO `os_district` VALUES ('542525', '革吉县', '3', '542500');
INSERT INTO `os_district` VALUES ('542526', '改则县', '3', '542500');
INSERT INTO `os_district` VALUES ('542527', '措勤县', '3', '542500');
INSERT INTO `os_district` VALUES ('542621', '林芝县', '3', '542600');
INSERT INTO `os_district` VALUES ('542622', '工布江达县', '3', '542600');
INSERT INTO `os_district` VALUES ('542623', '米林县', '3', '542600');
INSERT INTO `os_district` VALUES ('542624', '墨脱县', '3', '542600');
INSERT INTO `os_district` VALUES ('542625', '波密县', '3', '542600');
INSERT INTO `os_district` VALUES ('542626', '察隅县', '3', '542600');
INSERT INTO `os_district` VALUES ('542627', '朗　县', '3', '542600');
INSERT INTO `os_district` VALUES ('610101', '市辖区', '3', '610100');
INSERT INTO `os_district` VALUES ('610102', '新城区', '3', '610100');
INSERT INTO `os_district` VALUES ('610103', '碑林区', '3', '610100');
INSERT INTO `os_district` VALUES ('610104', '莲湖区', '3', '610100');
INSERT INTO `os_district` VALUES ('610111', '灞桥区', '3', '610100');
INSERT INTO `os_district` VALUES ('610112', '未央区', '3', '610100');
INSERT INTO `os_district` VALUES ('610113', '雁塔区', '3', '610100');
INSERT INTO `os_district` VALUES ('610114', '阎良区', '3', '610100');
INSERT INTO `os_district` VALUES ('610115', '临潼区', '3', '610100');
INSERT INTO `os_district` VALUES ('610116', '长安区', '3', '610100');
INSERT INTO `os_district` VALUES ('610122', '蓝田县', '3', '610100');
INSERT INTO `os_district` VALUES ('610124', '周至县', '3', '610100');
INSERT INTO `os_district` VALUES ('610125', '户　县', '3', '610100');
INSERT INTO `os_district` VALUES ('610126', '高陵县', '3', '610100');
INSERT INTO `os_district` VALUES ('610201', '市辖区', '3', '610200');
INSERT INTO `os_district` VALUES ('610202', '王益区', '3', '610200');
INSERT INTO `os_district` VALUES ('610203', '印台区', '3', '610200');
INSERT INTO `os_district` VALUES ('610204', '耀州区', '3', '610200');
INSERT INTO `os_district` VALUES ('610222', '宜君县', '3', '610200');
INSERT INTO `os_district` VALUES ('610301', '市辖区', '3', '610300');
INSERT INTO `os_district` VALUES ('610302', '渭滨区', '3', '610300');
INSERT INTO `os_district` VALUES ('610303', '金台区', '3', '610300');
INSERT INTO `os_district` VALUES ('610304', '陈仓区', '3', '610300');
INSERT INTO `os_district` VALUES ('610322', '凤翔县', '3', '610300');
INSERT INTO `os_district` VALUES ('610323', '岐山县', '3', '610300');
INSERT INTO `os_district` VALUES ('610324', '扶风县', '3', '610300');
INSERT INTO `os_district` VALUES ('610326', '眉　县', '3', '610300');
INSERT INTO `os_district` VALUES ('610327', '陇　县', '3', '610300');
INSERT INTO `os_district` VALUES ('610328', '千阳县', '3', '610300');
INSERT INTO `os_district` VALUES ('610329', '麟游县', '3', '610300');
INSERT INTO `os_district` VALUES ('610330', '凤　县', '3', '610300');
INSERT INTO `os_district` VALUES ('610331', '太白县', '3', '610300');
INSERT INTO `os_district` VALUES ('610401', '市辖区', '3', '610400');
INSERT INTO `os_district` VALUES ('610402', '秦都区', '3', '610400');
INSERT INTO `os_district` VALUES ('610403', '杨凌区', '3', '610400');
INSERT INTO `os_district` VALUES ('610404', '渭城区', '3', '610400');
INSERT INTO `os_district` VALUES ('610422', '三原县', '3', '610400');
INSERT INTO `os_district` VALUES ('610423', '泾阳县', '3', '610400');
INSERT INTO `os_district` VALUES ('610424', '乾　县', '3', '610400');
INSERT INTO `os_district` VALUES ('610425', '礼泉县', '3', '610400');
INSERT INTO `os_district` VALUES ('610426', '永寿县', '3', '610400');
INSERT INTO `os_district` VALUES ('610427', '彬　县', '3', '610400');
INSERT INTO `os_district` VALUES ('610428', '长武县', '3', '610400');
INSERT INTO `os_district` VALUES ('610429', '旬邑县', '3', '610400');
INSERT INTO `os_district` VALUES ('610430', '淳化县', '3', '610400');
INSERT INTO `os_district` VALUES ('610431', '武功县', '3', '610400');
INSERT INTO `os_district` VALUES ('610481', '兴平市', '3', '610400');
INSERT INTO `os_district` VALUES ('610501', '市辖区', '3', '610500');
INSERT INTO `os_district` VALUES ('610502', '临渭区', '3', '610500');
INSERT INTO `os_district` VALUES ('610521', '华　县', '3', '610500');
INSERT INTO `os_district` VALUES ('610522', '潼关县', '3', '610500');
INSERT INTO `os_district` VALUES ('610523', '大荔县', '3', '610500');
INSERT INTO `os_district` VALUES ('610524', '合阳县', '3', '610500');
INSERT INTO `os_district` VALUES ('610525', '澄城县', '3', '610500');
INSERT INTO `os_district` VALUES ('610526', '蒲城县', '3', '610500');
INSERT INTO `os_district` VALUES ('610527', '白水县', '3', '610500');
INSERT INTO `os_district` VALUES ('610528', '富平县', '3', '610500');
INSERT INTO `os_district` VALUES ('610581', '韩城市', '3', '610500');
INSERT INTO `os_district` VALUES ('610582', '华阴市', '3', '610500');
INSERT INTO `os_district` VALUES ('610601', '市辖区', '3', '610600');
INSERT INTO `os_district` VALUES ('610602', '宝塔区', '3', '610600');
INSERT INTO `os_district` VALUES ('610621', '延长县', '3', '610600');
INSERT INTO `os_district` VALUES ('610622', '延川县', '3', '610600');
INSERT INTO `os_district` VALUES ('610623', '子长县', '3', '610600');
INSERT INTO `os_district` VALUES ('610624', '安塞县', '3', '610600');
INSERT INTO `os_district` VALUES ('610625', '志丹县', '3', '610600');
INSERT INTO `os_district` VALUES ('610626', '吴旗县', '3', '610600');
INSERT INTO `os_district` VALUES ('610627', '甘泉县', '3', '610600');
INSERT INTO `os_district` VALUES ('610628', '富　县', '3', '610600');
INSERT INTO `os_district` VALUES ('610629', '洛川县', '3', '610600');
INSERT INTO `os_district` VALUES ('610630', '宜川县', '3', '610600');
INSERT INTO `os_district` VALUES ('610631', '黄龙县', '3', '610600');
INSERT INTO `os_district` VALUES ('610632', '黄陵县', '3', '610600');
INSERT INTO `os_district` VALUES ('610701', '市辖区', '3', '610700');
INSERT INTO `os_district` VALUES ('610702', '汉台区', '3', '610700');
INSERT INTO `os_district` VALUES ('610721', '南郑县', '3', '610700');
INSERT INTO `os_district` VALUES ('610722', '城固县', '3', '610700');
INSERT INTO `os_district` VALUES ('610723', '洋　县', '3', '610700');
INSERT INTO `os_district` VALUES ('610724', '西乡县', '3', '610700');
INSERT INTO `os_district` VALUES ('610725', '勉　县', '3', '610700');
INSERT INTO `os_district` VALUES ('610726', '宁强县', '3', '610700');
INSERT INTO `os_district` VALUES ('610727', '略阳县', '3', '610700');
INSERT INTO `os_district` VALUES ('610728', '镇巴县', '3', '610700');
INSERT INTO `os_district` VALUES ('610729', '留坝县', '3', '610700');
INSERT INTO `os_district` VALUES ('610730', '佛坪县', '3', '610700');
INSERT INTO `os_district` VALUES ('610801', '市辖区', '3', '610800');
INSERT INTO `os_district` VALUES ('610802', '榆阳区', '3', '610800');
INSERT INTO `os_district` VALUES ('610821', '神木县', '3', '610800');
INSERT INTO `os_district` VALUES ('610822', '府谷县', '3', '610800');
INSERT INTO `os_district` VALUES ('610823', '横山县', '3', '610800');
INSERT INTO `os_district` VALUES ('610824', '靖边县', '3', '610800');
INSERT INTO `os_district` VALUES ('610825', '定边县', '3', '610800');
INSERT INTO `os_district` VALUES ('610826', '绥德县', '3', '610800');
INSERT INTO `os_district` VALUES ('610827', '米脂县', '3', '610800');
INSERT INTO `os_district` VALUES ('610828', '佳　县', '3', '610800');
INSERT INTO `os_district` VALUES ('610829', '吴堡县', '3', '610800');
INSERT INTO `os_district` VALUES ('610830', '清涧县', '3', '610800');
INSERT INTO `os_district` VALUES ('610831', '子洲县', '3', '610800');
INSERT INTO `os_district` VALUES ('610901', '市辖区', '3', '610900');
INSERT INTO `os_district` VALUES ('610902', '汉滨区', '3', '610900');
INSERT INTO `os_district` VALUES ('610921', '汉阴县', '3', '610900');
INSERT INTO `os_district` VALUES ('610922', '石泉县', '3', '610900');
INSERT INTO `os_district` VALUES ('610923', '宁陕县', '3', '610900');
INSERT INTO `os_district` VALUES ('610924', '紫阳县', '3', '610900');
INSERT INTO `os_district` VALUES ('610925', '岚皋县', '3', '610900');
INSERT INTO `os_district` VALUES ('610926', '平利县', '3', '610900');
INSERT INTO `os_district` VALUES ('610927', '镇坪县', '3', '610900');
INSERT INTO `os_district` VALUES ('610928', '旬阳县', '3', '610900');
INSERT INTO `os_district` VALUES ('610929', '白河县', '3', '610900');
INSERT INTO `os_district` VALUES ('611001', '市辖区', '3', '611000');
INSERT INTO `os_district` VALUES ('611002', '商州区', '3', '611000');
INSERT INTO `os_district` VALUES ('611021', '洛南县', '3', '611000');
INSERT INTO `os_district` VALUES ('611022', '丹凤县', '3', '611000');
INSERT INTO `os_district` VALUES ('611023', '商南县', '3', '611000');
INSERT INTO `os_district` VALUES ('611024', '山阳县', '3', '611000');
INSERT INTO `os_district` VALUES ('611025', '镇安县', '3', '611000');
INSERT INTO `os_district` VALUES ('611026', '柞水县', '3', '611000');
INSERT INTO `os_district` VALUES ('620101', '市辖区', '3', '620100');
INSERT INTO `os_district` VALUES ('620102', '城关区', '3', '620100');
INSERT INTO `os_district` VALUES ('620103', '七里河区', '3', '620100');
INSERT INTO `os_district` VALUES ('620104', '西固区', '3', '620100');
INSERT INTO `os_district` VALUES ('620105', '安宁区', '3', '620100');
INSERT INTO `os_district` VALUES ('620111', '红古区', '3', '620100');
INSERT INTO `os_district` VALUES ('620121', '永登县', '3', '620100');
INSERT INTO `os_district` VALUES ('620122', '皋兰县', '3', '620100');
INSERT INTO `os_district` VALUES ('620123', '榆中县', '3', '620100');
INSERT INTO `os_district` VALUES ('620201', '市辖区', '3', '620200');
INSERT INTO `os_district` VALUES ('620301', '市辖区', '3', '620300');
INSERT INTO `os_district` VALUES ('620302', '金川区', '3', '620300');
INSERT INTO `os_district` VALUES ('620321', '永昌县', '3', '620300');
INSERT INTO `os_district` VALUES ('620401', '市辖区', '3', '620400');
INSERT INTO `os_district` VALUES ('620402', '白银区', '3', '620400');
INSERT INTO `os_district` VALUES ('620403', '平川区', '3', '620400');
INSERT INTO `os_district` VALUES ('620421', '靖远县', '3', '620400');
INSERT INTO `os_district` VALUES ('620422', '会宁县', '3', '620400');
INSERT INTO `os_district` VALUES ('620423', '景泰县', '3', '620400');
INSERT INTO `os_district` VALUES ('620501', '市辖区', '3', '620500');
INSERT INTO `os_district` VALUES ('620502', '秦城区', '3', '620500');
INSERT INTO `os_district` VALUES ('620503', '北道区', '3', '620500');
INSERT INTO `os_district` VALUES ('620521', '清水县', '3', '620500');
INSERT INTO `os_district` VALUES ('620522', '秦安县', '3', '620500');
INSERT INTO `os_district` VALUES ('620523', '甘谷县', '3', '620500');
INSERT INTO `os_district` VALUES ('620524', '武山县', '3', '620500');
INSERT INTO `os_district` VALUES ('620525', '张家川回族自治县', '3', '620500');
INSERT INTO `os_district` VALUES ('620601', '市辖区', '3', '620600');
INSERT INTO `os_district` VALUES ('620602', '凉州区', '3', '620600');
INSERT INTO `os_district` VALUES ('620621', '民勤县', '3', '620600');
INSERT INTO `os_district` VALUES ('620622', '古浪县', '3', '620600');
INSERT INTO `os_district` VALUES ('620623', '天祝藏族自治县', '3', '620600');
INSERT INTO `os_district` VALUES ('620701', '市辖区', '3', '620700');
INSERT INTO `os_district` VALUES ('620702', '甘州区', '3', '620700');
INSERT INTO `os_district` VALUES ('620721', '肃南裕固族自治县', '3', '620700');
INSERT INTO `os_district` VALUES ('620722', '民乐县', '3', '620700');
INSERT INTO `os_district` VALUES ('620723', '临泽县', '3', '620700');
INSERT INTO `os_district` VALUES ('620724', '高台县', '3', '620700');
INSERT INTO `os_district` VALUES ('620725', '山丹县', '3', '620700');
INSERT INTO `os_district` VALUES ('620801', '市辖区', '3', '620800');
INSERT INTO `os_district` VALUES ('620802', '崆峒区', '3', '620800');
INSERT INTO `os_district` VALUES ('620821', '泾川县', '3', '620800');
INSERT INTO `os_district` VALUES ('620822', '灵台县', '3', '620800');
INSERT INTO `os_district` VALUES ('620823', '崇信县', '3', '620800');
INSERT INTO `os_district` VALUES ('620824', '华亭县', '3', '620800');
INSERT INTO `os_district` VALUES ('620825', '庄浪县', '3', '620800');
INSERT INTO `os_district` VALUES ('620826', '静宁县', '3', '620800');
INSERT INTO `os_district` VALUES ('620901', '市辖区', '3', '620900');
INSERT INTO `os_district` VALUES ('620902', '肃州区', '3', '620900');
INSERT INTO `os_district` VALUES ('620921', '金塔县', '3', '620900');
INSERT INTO `os_district` VALUES ('620922', '安西县', '3', '620900');
INSERT INTO `os_district` VALUES ('620923', '肃北蒙古族自治县', '3', '620900');
INSERT INTO `os_district` VALUES ('620924', '阿克塞哈萨克族自治县', '3', '620900');
INSERT INTO `os_district` VALUES ('620981', '玉门市', '3', '620900');
INSERT INTO `os_district` VALUES ('620982', '敦煌市', '3', '620900');
INSERT INTO `os_district` VALUES ('621001', '市辖区', '3', '621000');
INSERT INTO `os_district` VALUES ('621002', '西峰区', '3', '621000');
INSERT INTO `os_district` VALUES ('621021', '庆城县', '3', '621000');
INSERT INTO `os_district` VALUES ('621022', '环　县', '3', '621000');
INSERT INTO `os_district` VALUES ('621023', '华池县', '3', '621000');
INSERT INTO `os_district` VALUES ('621024', '合水县', '3', '621000');
INSERT INTO `os_district` VALUES ('621025', '正宁县', '3', '621000');
INSERT INTO `os_district` VALUES ('621026', '宁　县', '3', '621000');
INSERT INTO `os_district` VALUES ('621027', '镇原县', '3', '621000');
INSERT INTO `os_district` VALUES ('621101', '市辖区', '3', '621100');
INSERT INTO `os_district` VALUES ('621102', '安定区', '3', '621100');
INSERT INTO `os_district` VALUES ('621121', '通渭县', '3', '621100');
INSERT INTO `os_district` VALUES ('621122', '陇西县', '3', '621100');
INSERT INTO `os_district` VALUES ('621123', '渭源县', '3', '621100');
INSERT INTO `os_district` VALUES ('621124', '临洮县', '3', '621100');
INSERT INTO `os_district` VALUES ('621125', '漳　县', '3', '621100');
INSERT INTO `os_district` VALUES ('621126', '岷　县', '3', '621100');
INSERT INTO `os_district` VALUES ('621201', '市辖区', '3', '621200');
INSERT INTO `os_district` VALUES ('621202', '武都区', '3', '621200');
INSERT INTO `os_district` VALUES ('621221', '成　县', '3', '621200');
INSERT INTO `os_district` VALUES ('621222', '文　县', '3', '621200');
INSERT INTO `os_district` VALUES ('621223', '宕昌县', '3', '621200');
INSERT INTO `os_district` VALUES ('621224', '康　县', '3', '621200');
INSERT INTO `os_district` VALUES ('621225', '西和县', '3', '621200');
INSERT INTO `os_district` VALUES ('621226', '礼　县', '3', '621200');
INSERT INTO `os_district` VALUES ('621227', '徽　县', '3', '621200');
INSERT INTO `os_district` VALUES ('621228', '两当县', '3', '621200');
INSERT INTO `os_district` VALUES ('622901', '临夏市', '3', '622900');
INSERT INTO `os_district` VALUES ('622921', '临夏县', '3', '622900');
INSERT INTO `os_district` VALUES ('622922', '康乐县', '3', '622900');
INSERT INTO `os_district` VALUES ('622923', '永靖县', '3', '622900');
INSERT INTO `os_district` VALUES ('622924', '广河县', '3', '622900');
INSERT INTO `os_district` VALUES ('622925', '和政县', '3', '622900');
INSERT INTO `os_district` VALUES ('622926', '东乡族自治县', '3', '622900');
INSERT INTO `os_district` VALUES ('622927', '积石山保安族东乡族撒拉族自治县', '3', '622900');
INSERT INTO `os_district` VALUES ('623001', '合作市', '3', '623000');
INSERT INTO `os_district` VALUES ('623021', '临潭县', '3', '623000');
INSERT INTO `os_district` VALUES ('623022', '卓尼县', '3', '623000');
INSERT INTO `os_district` VALUES ('623023', '舟曲县', '3', '623000');
INSERT INTO `os_district` VALUES ('623024', '迭部县', '3', '623000');
INSERT INTO `os_district` VALUES ('623025', '玛曲县', '3', '623000');
INSERT INTO `os_district` VALUES ('623026', '碌曲县', '3', '623000');
INSERT INTO `os_district` VALUES ('623027', '夏河县', '3', '623000');
INSERT INTO `os_district` VALUES ('630101', '市辖区', '3', '630100');
INSERT INTO `os_district` VALUES ('630102', '城东区', '3', '630100');
INSERT INTO `os_district` VALUES ('630103', '城中区', '3', '630100');
INSERT INTO `os_district` VALUES ('630104', '城西区', '3', '630100');
INSERT INTO `os_district` VALUES ('630105', '城北区', '3', '630100');
INSERT INTO `os_district` VALUES ('630121', '大通回族土族自治县', '3', '630100');
INSERT INTO `os_district` VALUES ('630122', '湟中县', '3', '630100');
INSERT INTO `os_district` VALUES ('630123', '湟源县', '3', '630100');
INSERT INTO `os_district` VALUES ('632121', '平安县', '3', '632100');
INSERT INTO `os_district` VALUES ('632122', '民和回族土族自治县', '3', '632100');
INSERT INTO `os_district` VALUES ('632123', '乐都县', '3', '632100');
INSERT INTO `os_district` VALUES ('632126', '互助土族自治县', '3', '632100');
INSERT INTO `os_district` VALUES ('632127', '化隆回族自治县', '3', '632100');
INSERT INTO `os_district` VALUES ('632128', '循化撒拉族自治县', '3', '632100');
INSERT INTO `os_district` VALUES ('632221', '门源回族自治县', '3', '632200');
INSERT INTO `os_district` VALUES ('632222', '祁连县', '3', '632200');
INSERT INTO `os_district` VALUES ('632223', '海晏县', '3', '632200');
INSERT INTO `os_district` VALUES ('632224', '刚察县', '3', '632200');
INSERT INTO `os_district` VALUES ('632321', '同仁县', '3', '632300');
INSERT INTO `os_district` VALUES ('632322', '尖扎县', '3', '632300');
INSERT INTO `os_district` VALUES ('632323', '泽库县', '3', '632300');
INSERT INTO `os_district` VALUES ('632324', '河南蒙古族自治县', '3', '632300');
INSERT INTO `os_district` VALUES ('632521', '共和县', '3', '632500');
INSERT INTO `os_district` VALUES ('632522', '同德县', '3', '632500');
INSERT INTO `os_district` VALUES ('632523', '贵德县', '3', '632500');
INSERT INTO `os_district` VALUES ('632524', '兴海县', '3', '632500');
INSERT INTO `os_district` VALUES ('632525', '贵南县', '3', '632500');
INSERT INTO `os_district` VALUES ('632621', '玛沁县', '3', '632600');
INSERT INTO `os_district` VALUES ('632622', '班玛县', '3', '632600');
INSERT INTO `os_district` VALUES ('632623', '甘德县', '3', '632600');
INSERT INTO `os_district` VALUES ('632624', '达日县', '3', '632600');
INSERT INTO `os_district` VALUES ('632625', '久治县', '3', '632600');
INSERT INTO `os_district` VALUES ('632626', '玛多县', '3', '632600');
INSERT INTO `os_district` VALUES ('632721', '玉树县', '3', '632700');
INSERT INTO `os_district` VALUES ('632722', '杂多县', '3', '632700');
INSERT INTO `os_district` VALUES ('632723', '称多县', '3', '632700');
INSERT INTO `os_district` VALUES ('632724', '治多县', '3', '632700');
INSERT INTO `os_district` VALUES ('632725', '囊谦县', '3', '632700');
INSERT INTO `os_district` VALUES ('632726', '曲麻莱县', '3', '632700');
INSERT INTO `os_district` VALUES ('632801', '格尔木市', '3', '632800');
INSERT INTO `os_district` VALUES ('632802', '德令哈市', '3', '632800');
INSERT INTO `os_district` VALUES ('632821', '乌兰县', '3', '632800');
INSERT INTO `os_district` VALUES ('632822', '都兰县', '3', '632800');
INSERT INTO `os_district` VALUES ('632823', '天峻县', '3', '632800');
INSERT INTO `os_district` VALUES ('640101', '市辖区', '3', '640100');
INSERT INTO `os_district` VALUES ('640104', '兴庆区', '3', '640100');
INSERT INTO `os_district` VALUES ('640105', '西夏区', '3', '640100');
INSERT INTO `os_district` VALUES ('640106', '金凤区', '3', '640100');
INSERT INTO `os_district` VALUES ('640121', '永宁县', '3', '640100');
INSERT INTO `os_district` VALUES ('640122', '贺兰县', '3', '640100');
INSERT INTO `os_district` VALUES ('640181', '灵武市', '3', '640100');
INSERT INTO `os_district` VALUES ('640201', '市辖区', '3', '640200');
INSERT INTO `os_district` VALUES ('640202', '大武口区', '3', '640200');
INSERT INTO `os_district` VALUES ('640205', '惠农区', '3', '640200');
INSERT INTO `os_district` VALUES ('640221', '平罗县', '3', '640200');
INSERT INTO `os_district` VALUES ('640301', '市辖区', '3', '640300');
INSERT INTO `os_district` VALUES ('640302', '利通区', '3', '640300');
INSERT INTO `os_district` VALUES ('640323', '盐池县', '3', '640300');
INSERT INTO `os_district` VALUES ('640324', '同心县', '3', '640300');
INSERT INTO `os_district` VALUES ('640381', '青铜峡市', '3', '640300');
INSERT INTO `os_district` VALUES ('640401', '市辖区', '3', '640400');
INSERT INTO `os_district` VALUES ('640402', '原州区', '3', '640400');
INSERT INTO `os_district` VALUES ('640422', '西吉县', '3', '640400');
INSERT INTO `os_district` VALUES ('640423', '隆德县', '3', '640400');
INSERT INTO `os_district` VALUES ('640424', '泾源县', '3', '640400');
INSERT INTO `os_district` VALUES ('640425', '彭阳县', '3', '640400');
INSERT INTO `os_district` VALUES ('640501', '市辖区', '3', '640500');
INSERT INTO `os_district` VALUES ('640502', '沙坡头区', '3', '640500');
INSERT INTO `os_district` VALUES ('640521', '中宁县', '3', '640500');
INSERT INTO `os_district` VALUES ('640522', '海原县', '3', '640500');
INSERT INTO `os_district` VALUES ('650101', '市辖区', '3', '650100');
INSERT INTO `os_district` VALUES ('650102', '天山区', '3', '650100');
INSERT INTO `os_district` VALUES ('650103', '沙依巴克区', '3', '650100');
INSERT INTO `os_district` VALUES ('650104', '新市区', '3', '650100');
INSERT INTO `os_district` VALUES ('650105', '水磨沟区', '3', '650100');
INSERT INTO `os_district` VALUES ('650106', '头屯河区', '3', '650100');
INSERT INTO `os_district` VALUES ('650107', '达坂城区', '3', '650100');
INSERT INTO `os_district` VALUES ('650108', '东山区', '3', '650100');
INSERT INTO `os_district` VALUES ('650121', '乌鲁木齐县', '3', '650100');
INSERT INTO `os_district` VALUES ('650201', '市辖区', '3', '650200');
INSERT INTO `os_district` VALUES ('650202', '独山子区', '3', '650200');
INSERT INTO `os_district` VALUES ('650203', '克拉玛依区', '3', '650200');
INSERT INTO `os_district` VALUES ('650204', '白碱滩区', '3', '650200');
INSERT INTO `os_district` VALUES ('650205', '乌尔禾区', '3', '650200');
INSERT INTO `os_district` VALUES ('652101', '吐鲁番市', '3', '652100');
INSERT INTO `os_district` VALUES ('652122', '鄯善县', '3', '652100');
INSERT INTO `os_district` VALUES ('652123', '托克逊县', '3', '652100');
INSERT INTO `os_district` VALUES ('652201', '哈密市', '3', '652200');
INSERT INTO `os_district` VALUES ('652222', '巴里坤哈萨克自治县', '3', '652200');
INSERT INTO `os_district` VALUES ('652223', '伊吾县', '3', '652200');
INSERT INTO `os_district` VALUES ('652301', '昌吉市', '3', '652300');
INSERT INTO `os_district` VALUES ('652302', '阜康市', '3', '652300');
INSERT INTO `os_district` VALUES ('652303', '米泉市', '3', '652300');
INSERT INTO `os_district` VALUES ('652323', '呼图壁县', '3', '652300');
INSERT INTO `os_district` VALUES ('652324', '玛纳斯县', '3', '652300');
INSERT INTO `os_district` VALUES ('652325', '奇台县', '3', '652300');
INSERT INTO `os_district` VALUES ('652327', '吉木萨尔县', '3', '652300');
INSERT INTO `os_district` VALUES ('652328', '木垒哈萨克自治县', '3', '652300');
INSERT INTO `os_district` VALUES ('652701', '博乐市', '3', '652700');
INSERT INTO `os_district` VALUES ('652722', '精河县', '3', '652700');
INSERT INTO `os_district` VALUES ('652723', '温泉县', '3', '652700');
INSERT INTO `os_district` VALUES ('652801', '库尔勒市', '3', '652800');
INSERT INTO `os_district` VALUES ('652822', '轮台县', '3', '652800');
INSERT INTO `os_district` VALUES ('652823', '尉犁县', '3', '652800');
INSERT INTO `os_district` VALUES ('652824', '若羌县', '3', '652800');
INSERT INTO `os_district` VALUES ('652825', '且末县', '3', '652800');
INSERT INTO `os_district` VALUES ('652826', '焉耆回族自治县', '3', '652800');
INSERT INTO `os_district` VALUES ('652827', '和静县', '3', '652800');
INSERT INTO `os_district` VALUES ('652828', '和硕县', '3', '652800');
INSERT INTO `os_district` VALUES ('652829', '博湖县', '3', '652800');
INSERT INTO `os_district` VALUES ('652901', '阿克苏市', '3', '652900');
INSERT INTO `os_district` VALUES ('652922', '温宿县', '3', '652900');
INSERT INTO `os_district` VALUES ('652923', '库车县', '3', '652900');
INSERT INTO `os_district` VALUES ('652924', '沙雅县', '3', '652900');
INSERT INTO `os_district` VALUES ('652925', '新和县', '3', '652900');
INSERT INTO `os_district` VALUES ('652926', '拜城县', '3', '652900');
INSERT INTO `os_district` VALUES ('652927', '乌什县', '3', '652900');
INSERT INTO `os_district` VALUES ('652928', '阿瓦提县', '3', '652900');
INSERT INTO `os_district` VALUES ('652929', '柯坪县', '3', '652900');
INSERT INTO `os_district` VALUES ('653001', '阿图什市', '3', '653000');
INSERT INTO `os_district` VALUES ('653022', '阿克陶县', '3', '653000');
INSERT INTO `os_district` VALUES ('653023', '阿合奇县', '3', '653000');
INSERT INTO `os_district` VALUES ('653024', '乌恰县', '3', '653000');
INSERT INTO `os_district` VALUES ('653101', '喀什市', '3', '653100');
INSERT INTO `os_district` VALUES ('653121', '疏附县', '3', '653100');
INSERT INTO `os_district` VALUES ('653122', '疏勒县', '3', '653100');
INSERT INTO `os_district` VALUES ('653123', '英吉沙县', '3', '653100');
INSERT INTO `os_district` VALUES ('653124', '泽普县', '3', '653100');
INSERT INTO `os_district` VALUES ('653125', '莎车县', '3', '653100');
INSERT INTO `os_district` VALUES ('653126', '叶城县', '3', '653100');
INSERT INTO `os_district` VALUES ('653127', '麦盖提县', '3', '653100');
INSERT INTO `os_district` VALUES ('653128', '岳普湖县', '3', '653100');
INSERT INTO `os_district` VALUES ('653129', '伽师县', '3', '653100');
INSERT INTO `os_district` VALUES ('653130', '巴楚县', '3', '653100');
INSERT INTO `os_district` VALUES ('653131', '塔什库尔干塔吉克自治县', '3', '653100');
INSERT INTO `os_district` VALUES ('653201', '和田市', '3', '653200');
INSERT INTO `os_district` VALUES ('653221', '和田县', '3', '653200');
INSERT INTO `os_district` VALUES ('653222', '墨玉县', '3', '653200');
INSERT INTO `os_district` VALUES ('653223', '皮山县', '3', '653200');
INSERT INTO `os_district` VALUES ('653224', '洛浦县', '3', '653200');
INSERT INTO `os_district` VALUES ('653225', '策勒县', '3', '653200');
INSERT INTO `os_district` VALUES ('653226', '于田县', '3', '653200');
INSERT INTO `os_district` VALUES ('653227', '民丰县', '3', '653200');
INSERT INTO `os_district` VALUES ('654002', '伊宁市', '3', '654000');
INSERT INTO `os_district` VALUES ('654003', '奎屯市', '3', '654000');
INSERT INTO `os_district` VALUES ('654021', '伊宁县', '3', '654000');
INSERT INTO `os_district` VALUES ('654022', '察布查尔锡伯自治县', '3', '654000');
INSERT INTO `os_district` VALUES ('654023', '霍城县', '3', '654000');
INSERT INTO `os_district` VALUES ('654024', '巩留县', '3', '654000');
INSERT INTO `os_district` VALUES ('654025', '新源县', '3', '654000');
INSERT INTO `os_district` VALUES ('654026', '昭苏县', '3', '654000');
INSERT INTO `os_district` VALUES ('654027', '特克斯县', '3', '654000');
INSERT INTO `os_district` VALUES ('654028', '尼勒克县', '3', '654000');
INSERT INTO `os_district` VALUES ('654201', '塔城市', '3', '654200');
INSERT INTO `os_district` VALUES ('654202', '乌苏市', '3', '654200');
INSERT INTO `os_district` VALUES ('654221', '额敏县', '3', '654200');
INSERT INTO `os_district` VALUES ('654223', '沙湾县', '3', '654200');
INSERT INTO `os_district` VALUES ('654224', '托里县', '3', '654200');
INSERT INTO `os_district` VALUES ('654225', '裕民县', '3', '654200');
INSERT INTO `os_district` VALUES ('654226', '和布克赛尔蒙古自治县', '3', '654200');
INSERT INTO `os_district` VALUES ('654301', '阿勒泰市', '3', '654300');
INSERT INTO `os_district` VALUES ('654321', '布尔津县', '3', '654300');
INSERT INTO `os_district` VALUES ('654322', '富蕴县', '3', '654300');
INSERT INTO `os_district` VALUES ('654323', '福海县', '3', '654300');
INSERT INTO `os_district` VALUES ('654324', '哈巴河县', '3', '654300');
INSERT INTO `os_district` VALUES ('654325', '青河县', '3', '654300');
INSERT INTO `os_district` VALUES ('654326', '吉木乃县', '3', '654300');
INSERT INTO `os_district` VALUES ('659001', '石河子市', '3', '659000');
INSERT INTO `os_district` VALUES ('659002', '阿拉尔市', '3', '659000');
INSERT INTO `os_district` VALUES ('659003', '图木舒克市', '3', '659000');
INSERT INTO `os_district` VALUES ('659004', '五家渠市', '3', '659000');
INSERT INTO `os_district` VALUES ('810001', '香港', '2', '810000');
INSERT INTO `os_district` VALUES ('810002', '中西区', '3', '810001');
INSERT INTO `os_district` VALUES ('810003', '九龙城区', '3', '810001');
INSERT INTO `os_district` VALUES ('810004', '南区', '3', '810001');
INSERT INTO `os_district` VALUES ('810005', '黄大仙区', '3', '810001');
INSERT INTO `os_district` VALUES ('810006', '油尖旺区', '3', '810001');
INSERT INTO `os_district` VALUES ('810007', '葵青区', '3', '810001');
INSERT INTO `os_district` VALUES ('810008', '西贡区', '3', '810001');
INSERT INTO `os_district` VALUES ('810009', '屯门区', '3', '810001');
INSERT INTO `os_district` VALUES ('810010', '荃湾区', '3', '810001');
INSERT INTO `os_district` VALUES ('810011', '东区', '3', '810001');
INSERT INTO `os_district` VALUES ('810012', '观塘区', '3', '810001');
INSERT INTO `os_district` VALUES ('810013', '深水步区', '3', '810001');
INSERT INTO `os_district` VALUES ('810014', '湾仔区', '3', '810001');
INSERT INTO `os_district` VALUES ('810015', '离岛区', '3', '810001');
INSERT INTO `os_district` VALUES ('810016', '北区', '3', '810001');
INSERT INTO `os_district` VALUES ('810017', '沙田区', '3', '810001');
INSERT INTO `os_district` VALUES ('810018', '大埔区', '3', '810001');
INSERT INTO `os_district` VALUES ('810019', '元朗区', '3', '810001');
INSERT INTO `os_district` VALUES ('820001', '澳门', '2', '820000');
INSERT INTO `os_district` VALUES ('820002', '澳门', '3', '820001');
INSERT INTO `os_district` VALUES ('710001', '台北市', '2', '710000');
INSERT INTO `os_district` VALUES ('710002', '台北县', '3', '710001');
INSERT INTO `os_district` VALUES ('710003', '基隆市', '2', '710000');
INSERT INTO `os_district` VALUES ('910005', '中山市', '3', '442000');
INSERT INTO `os_district` VALUES ('710004', '花莲县', '3', '710003');
INSERT INTO `os_district` VALUES ('910006', '东莞市', '3', '441900');

-- ----------------------------
-- Table structure for os_event
-- ----------------------------
DROP TABLE IF EXISTS `os_event`;
CREATE TABLE `os_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '发起人',
  `title` varchar(255) NOT NULL COMMENT '活动名称',
  `explain` text NOT NULL COMMENT '详细内容',
  `sTime` int(11) NOT NULL COMMENT '活动开始时间',
  `eTime` int(11) NOT NULL COMMENT '活动结束时间',
  `address` varchar(255) NOT NULL COMMENT '活动地点',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `limitCount` int(11) NOT NULL COMMENT '限制人数',
  `cover_id` int(11) NOT NULL COMMENT '封面ID',
  `deadline` int(11) NOT NULL,
  `attentionCount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `signCount` int(11) NOT NULL,
  `is_recommend` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_event
-- ----------------------------
INSERT INTO `os_event` VALUES ('14', '101', '第三届GopherChina上海大会', '<p style=\"box-sizing: border-box; margin-bottom: 16px; color: rgb(74, 74, 74); font-family: &quot;PingFang SC&quot;, &quot;Helvetica Neue&quot;, &quot;Microsoft YaHei UI&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, Sathu, EucrosiaUPC, sans-serif; font-size: 16px; white-space: normal;\">GopherChina&nbsp;是中国的最权威和最实力干货的Go大会，我们致力于为中国广大的Gopher提供最好的大会，我们本着非盈利目的来举办大会，前面两届大会在上海和北京都获得了非常好的口碑，今年我们大会将在四月份举办大会。举办Gopher大会，主要是汇集Gopher的广大开发者，聚集一批大规模应用Go的示范企业给大家分享，呈现一场cool的盛会。</p><p style=\"box-sizing: border-box; margin-bottom: 16px; color: rgb(74, 74, 74); font-family: &quot;PingFang SC&quot;, &quot;Helvetica Neue&quot;, &quot;Microsoft YaHei UI&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, Sathu, EucrosiaUPC, sans-serif; font-size: 16px; white-space: normal;\">这是2015年Go作者之一Robert参会之后写的博客：<a href=\"https://blog.golang.org/gopherchina\" rel=\"nofollow\" style=\"box-sizing: border-box; text-decoration: none; outline: 0px; color: rgb(78, 170, 76);\">https://blog.golang.org/gopherchina</a></p><p style=\"box-sizing: border-box; margin-bottom: 16px; color: rgb(74, 74, 74); font-family: &quot;PingFang SC&quot;, &quot;Helvetica Neue&quot;, &quot;Microsoft YaHei UI&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, Sathu, EucrosiaUPC, sans-serif; font-size: 16px; white-space: normal;\">第一届我们的大会参会人数是500人，去年在北京差不多达到了1000人的规模，&nbsp;今年我们组织了1500人的场地，面向的受众也是越来越多，同时我们也邀请了Go team的同学过来分享。</p><p style=\"box-sizing: border-box; margin-bottom: 16px; color: rgb(74, 74, 74); font-family: &quot;PingFang SC&quot;, &quot;Helvetica Neue&quot;, &quot;Microsoft YaHei UI&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, Sathu, EucrosiaUPC, sans-serif; font-size: 16px; white-space: normal;\">我们的传统是每年必须有T恤，必须有，而且是限量版，只有参会的人才有，买不到。</p><p style=\"box-sizing: border-box; margin-bottom: 16px; color: rgb(74, 74, 74); font-family: &quot;PingFang SC&quot;, &quot;Helvetica Neue&quot;, &quot;Microsoft YaHei UI&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, Sathu, EucrosiaUPC, sans-serif; font-size: 16px; white-space: normal;\">&nbsp;</p><p style=\"box-sizing: border-box; margin-bottom: 16px; color: rgb(74, 74, 74); font-family: &quot;PingFang SC&quot;, &quot;Helvetica Neue&quot;, &quot;Microsoft YaHei UI&quot;, &quot;Microsoft YaHei&quot;, &quot;Noto Sans CJK SC&quot;, Sathu, EucrosiaUPC, sans-serif; font-size: 16px; white-space: normal;\">报名地址：http://www.bagevent.com/event/357764</p><p><br/></p>', '1492185600', '1492272000', ' 上海 杨浦 小南国花园酒店', '1488162961', '300', '23', '1492012500', '1', '1', '1488162961', '10', '0', '6', '1', '1');

-- ----------------------------
-- Table structure for os_event_attend
-- ----------------------------
DROP TABLE IF EXISTS `os_event_attend`;
CREATE TABLE `os_event_attend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0为报名，1为参加',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_event_attend
-- ----------------------------
INSERT INTO `os_event_attend` VALUES ('10', '101', '14', '', '0', '1488162961', '1');

-- ----------------------------
-- Table structure for os_event_type
-- ----------------------------
DROP TABLE IF EXISTS `os_event_type`;
CREATE TABLE `os_event_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `allow_post` tinyint(4) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_event_type
-- ----------------------------
INSERT INTO `os_event_type` VALUES ('6', '技术交流', '1488095472', '1488095420', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for os_expression
-- ----------------------------
DROP TABLE IF EXISTS `os_expression`;
CREATE TABLE `os_expression` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(200) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `expression_pkg_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_expression
-- ----------------------------

-- ----------------------------
-- Table structure for os_expression_pkg
-- ----------------------------
DROP TABLE IF EXISTS `os_expression_pkg`;
CREATE TABLE `os_expression_pkg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pkg_title` varchar(50) NOT NULL,
  `pkg_name` varchar(50) NOT NULL,
  `path` varchar(200) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_expression_pkg
-- ----------------------------

-- ----------------------------
-- Table structure for os_field
-- ----------------------------
DROP TABLE IF EXISTS `os_field`;
CREATE TABLE `os_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `field_data` varchar(1000) NOT NULL,
  `createTime` int(11) NOT NULL,
  `changeTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_field
-- ----------------------------

-- ----------------------------
-- Table structure for os_field_group
-- ----------------------------
DROP TABLE IF EXISTS `os_field_group`;
CREATE TABLE `os_field_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_name` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `visiable` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_field_group
-- ----------------------------
INSERT INTO `os_field_group` VALUES ('1', '个人资料', '1', '1403847366', '0', '1');
INSERT INTO `os_field_group` VALUES ('2', '开发者资料', '1', '1423537648', '0', '0');
INSERT INTO `os_field_group` VALUES ('3', '开源中国资料', '1', '1423538446', '0', '0');

-- ----------------------------
-- Table structure for os_field_setting
-- ----------------------------
DROP TABLE IF EXISTS `os_field_setting`;
CREATE TABLE `os_field_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(25) NOT NULL,
  `profile_group_id` int(11) NOT NULL,
  `visiable` tinyint(4) NOT NULL DEFAULT '1',
  `required` tinyint(4) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  `form_type` varchar(25) NOT NULL,
  `form_default_value` varchar(200) NOT NULL,
  `validation` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` int(11) NOT NULL,
  `child_form_type` varchar(25) NOT NULL,
  `input_tips` varchar(100) NOT NULL COMMENT '输入提示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_field_setting
-- ----------------------------
INSERT INTO `os_field_setting` VALUES ('1', 'qq', '1', '1', '1', '0', 'input', '', '', '1', '1409045825', 'string', '');
INSERT INTO `os_field_setting` VALUES ('2', '生日', '1', '1', '1', '0', 'time', '', '', '1', '1423537409', '', '');
INSERT INTO `os_field_setting` VALUES ('3', '擅长语言', '2', '1', '1', '0', 'select', 'Java|C++|Python|php|object c|ruby', '', '1', '1423537693', '', '');
INSERT INTO `os_field_setting` VALUES ('4', '承接项目', '2', '1', '1', '0', 'radio', '是|否', '', '1', '1423537733', '', '');
INSERT INTO `os_field_setting` VALUES ('5', '简介', '2', '1', '1', '0', 'textarea', '', '', '1', '1423537770', '', '简单介绍入行以来的工作经验，项目经验');
INSERT INTO `os_field_setting` VALUES ('6', '其他技能', '2', '1', '1', '0', 'checkbox', 'PhotoShop|Flash', '', '1', '1423537834', '', '');
INSERT INTO `os_field_setting` VALUES ('7', '昵称', '3', '1', '1', '0', 'input', '', '', '1', '1423704462', 'string', 'OSC账号昵称');

-- ----------------------------
-- Table structure for os_file
-- ----------------------------
DROP TABLE IF EXISTS `os_file`;
CREATE TABLE `os_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` varchar(100) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` varchar(255) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '上传时间',
  `driver` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文件表';

-- ----------------------------
-- Records of os_file
-- ----------------------------

-- ----------------------------
-- Table structure for os_follow
-- ----------------------------
DROP TABLE IF EXISTS `os_follow`;
CREATE TABLE `os_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `follow_who` int(11) NOT NULL COMMENT '关注谁',
  `who_follow` int(11) NOT NULL COMMENT '谁关注',
  `create_time` int(11) NOT NULL,
  `alias` varchar(40) NOT NULL COMMENT '备注',
  `group_id` int(11) NOT NULL COMMENT '分组ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='关注表';

-- ----------------------------
-- Records of os_follow
-- ----------------------------
INSERT INTO `os_follow` VALUES ('5', '1', '101', '1477199031', '', '0');

-- ----------------------------
-- Table structure for os_group
-- ----------------------------
DROP TABLE IF EXISTS `os_group`;
CREATE TABLE `os_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `post_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `allow_user_group` text NOT NULL,
  `sort` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  `background` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '圈子类型，0为公共的，1为私有的',
  `activity` int(11) NOT NULL,
  `member_count` int(11) NOT NULL,
  `member_alias` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group
-- ----------------------------
INSERT INTO `os_group` VALUES ('6', '1', 'javascript教程', '1483362986', '0', '1', '', '0', '11', '0', '3', 'JavaScript 是世界上最流行的脚本语言。 JavaScript 是属于 web 的语言，它适用于 PC、笔记本电脑、平板电脑和移动电话。 JavaScript 被设计为向 HTML 页面增加交互性。 许多 HTML 开发者都不是程序员，但是 JavaScript 却拥有非常简单的语法。几乎每个人都有能力将小的 JavaScript 片段添加到网页中。', '0', '0', '0', '');

-- ----------------------------
-- Table structure for os_group_bookmark
-- ----------------------------
DROP TABLE IF EXISTS `os_group_bookmark`;
CREATE TABLE `os_group_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_bookmark
-- ----------------------------

-- ----------------------------
-- Table structure for os_group_dynamic
-- ----------------------------
DROP TABLE IF EXISTS `os_group_dynamic`;
CREATE TABLE `os_group_dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `row_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_dynamic
-- ----------------------------

-- ----------------------------
-- Table structure for os_group_lzl_reply
-- ----------------------------
DROP TABLE IF EXISTS `os_group_lzl_reply`;
CREATE TABLE `os_group_lzl_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `to_f_reply_id` int(11) NOT NULL,
  `to_reply_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_lzl_reply
-- ----------------------------

-- ----------------------------
-- Table structure for os_group_member
-- ----------------------------
DROP TABLE IF EXISTS `os_group_member`;
CREATE TABLE `os_group_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `activity` int(11) NOT NULL,
  `last_view` int(11) NOT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1为普通成员，2为管理员，3为创建者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_member
-- ----------------------------
INSERT INTO `os_group_member` VALUES ('11', '6', '1', '1', '1483362986', '1483362986', '0', '1484483871', '3');

-- ----------------------------
-- Table structure for os_group_notice
-- ----------------------------
DROP TABLE IF EXISTS `os_group_notice`;
CREATE TABLE `os_group_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_notice
-- ----------------------------

-- ----------------------------
-- Table structure for os_group_post
-- ----------------------------
DROP TABLE IF EXISTS `os_group_post`;
CREATE TABLE `os_group_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `last_reply_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `is_top` tinyint(4) NOT NULL COMMENT '是否置顶',
  `cate_id` int(11) NOT NULL,
  `summary` varchar(250) NOT NULL,
  `cover` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_post
-- ----------------------------

-- ----------------------------
-- Table structure for os_group_post_category
-- ----------------------------
DROP TABLE IF EXISTS `os_group_post_category`;
CREATE TABLE `os_group_post_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_post_category
-- ----------------------------

-- ----------------------------
-- Table structure for os_group_post_reply
-- ----------------------------
DROP TABLE IF EXISTS `os_group_post_reply`;
CREATE TABLE `os_group_post_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_group_post_reply
-- ----------------------------

-- ----------------------------
-- Table structure for os_group_type
-- ----------------------------
DROP TABLE IF EXISTS `os_group_type`;
CREATE TABLE `os_group_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='圈子的分类表';

-- ----------------------------
-- Records of os_group_type
-- ----------------------------
INSERT INTO `os_group_type` VALUES ('1', 'HTML/CSS', '1', '0', '0', '1483350588');
INSERT INTO `os_group_type` VALUES ('3', 'Javascript', '1', '0', '0', '1483351603');
INSERT INTO `os_group_type` VALUES ('4', '服务端', '1', '0', '0', '1483351617');
INSERT INTO `os_group_type` VALUES ('5', '数据库', '1', '0', '0', '1483351630');

-- ----------------------------
-- Table structure for os_hooks
-- ----------------------------
DROP TABLE IF EXISTS `os_hooks`;
CREATE TABLE `os_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_hooks
-- ----------------------------
INSERT INTO `os_hooks` VALUES ('38', 'pageHeader', '页面header钩子，一般用于加载插件CSS文件和代码', '1', '0', '');
INSERT INTO `os_hooks` VALUES ('39', 'pageFooter', '页面footer钩子，一般用于加载插件JS文件和JS代码', '1', '0', 'SuperLinks');
INSERT INTO `os_hooks` VALUES ('40', 'adminEditor', '后台内容编辑页编辑器', '1', '1378982734', 'EditorForAdmin');
INSERT INTO `os_hooks` VALUES ('41', 'AdminIndex', '首页小格子个性化显示', '1', '1382596073', 'SiteStat,SyncLogin,DevTeam,SystemInfo,LocalComment');
INSERT INTO `os_hooks` VALUES ('42', 'topicComment', '评论提交方式扩展钩子。', '1', '1380163518', '');
INSERT INTO `os_hooks` VALUES ('43', 'app_begin', '应用开始', '2', '1384481614', 'Iswaf');
INSERT INTO `os_hooks` VALUES ('44', 'checkIn', '签到', '1', '1395371353', 'CheckIn');
INSERT INTO `os_hooks` VALUES ('45', 'Rank', '签到排名钩子', '1', '1395387442', 'Rank_checkin');
INSERT INTO `os_hooks` VALUES ('46', 'support', '赞', '1', '1398264759', 'Support');
INSERT INTO `os_hooks` VALUES ('47', 'localComment', '本地评论插件', '1', '1399440321', 'LocalComment');
INSERT INTO `os_hooks` VALUES ('48', 'weiboType', '微博类型', '1', '1409121894', '');
INSERT INTO `os_hooks` VALUES ('49', 'repost', '转发钩子', '1', '1403668286', '');
INSERT INTO `os_hooks` VALUES ('50', 'syncLogin', '第三方登陆位置', '1', '1403700579', 'SyncLogin');
INSERT INTO `os_hooks` VALUES ('51', 'syncMeta', '第三方登陆meta接口', '1', '1403700633', 'SyncLogin');
INSERT INTO `os_hooks` VALUES ('52', 'J_China_City', '每个系统都需要的一个中国省市区三级联动插件。', '1', '1403841931', 'ChinaCity');
INSERT INTO `os_hooks` VALUES ('54', 'imageSlider', '图片轮播钩子', '1', '1407144022', '');
INSERT INTO `os_hooks` VALUES ('55', 'friendLink', '友情链接插件', '1', '1407156413', 'SuperLinks');
INSERT INTO `os_hooks` VALUES ('56', 'beforeSendWeibo', '在发微博之前预处理微博', '2', '1408084504', 'InsertFile');
INSERT INTO `os_hooks` VALUES ('57', 'beforeSendRepost', '转发微博前的预处理钩子', '2', '1408085689', '');
INSERT INTO `os_hooks` VALUES ('58', 'parseWeiboContent', '解析微博内容钩子', '2', '1409121261', '');
INSERT INTO `os_hooks` VALUES ('59', 'userConfig', '用户配置页面钩子', '1', '1417137557', 'SyncLogin');
INSERT INTO `os_hooks` VALUES ('60', 'weiboSide', '微博侧边钩子', '1', '1417063425', 'Retopic,Recommend');
INSERT INTO `os_hooks` VALUES ('61', 'personalMenus', '顶部导航栏个人下拉菜单', '1', '1417146501', '');
INSERT INTO `os_hooks` VALUES ('62', 'dealPicture', '上传图片处理', '2', '1417139975', '');
INSERT INTO `os_hooks` VALUES ('63', 'ucenterSideMenu', '用户中心左侧菜单', '1', '1417161205', '');
INSERT INTO `os_hooks` VALUES ('64', 'afterTop', '顶部导航之后的钩子，调用公告等', '1', '1429671392', '');
INSERT INTO `os_hooks` VALUES ('65', 'report', '举报钩子', '1', '1429511732', 'Report');
INSERT INTO `os_hooks` VALUES ('66', 'handleAction', '行为的额外操作', '2', '1433300260', 'CheckIn');
INSERT INTO `os_hooks` VALUES ('67', 'uploadDriver', '附件图片上传引擎', '2', '1435306269', '');
INSERT INTO `os_hooks` VALUES ('68', 'sms', '短信插件钩子', '2', '1437382105', '');
INSERT INTO `os_hooks` VALUES ('69', 'filterHtmlContent', '渲染富文本', '2', '1441951420', '');
INSERT INTO `os_hooks` VALUES ('70', 'parseContent', '解析内容', '2', '1445828128', 'Sensitive');
INSERT INTO `os_hooks` VALUES ('71', 'tool', '返回顶部，右下角工具栏', '1', '1445828128', '');
INSERT INTO `os_hooks` VALUES ('72', 'homeIndex', '网站首页', '2', '1445828128', '');

-- ----------------------------
-- Table structure for os_iexpression
-- ----------------------------
DROP TABLE IF EXISTS `os_iexpression`;
CREATE TABLE `os_iexpression` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(200) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_iexpression
-- ----------------------------

-- ----------------------------
-- Table structure for os_iexpression_link
-- ----------------------------
DROP TABLE IF EXISTS `os_iexpression_link`;
CREATE TABLE `os_iexpression_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iexpression_id` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_iexpression_link
-- ----------------------------

-- ----------------------------
-- Table structure for os_invite
-- ----------------------------
DROP TABLE IF EXISTS `os_invite`;
CREATE TABLE `os_invite` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY_KEY',
  `invite_type` int(11) NOT NULL COMMENT '邀请类型id',
  `code` varchar(25) NOT NULL COMMENT '邀请码',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `can_num` int(10) NOT NULL COMMENT '可以注册用户（含升级）',
  `already_num` int(10) NOT NULL COMMENT '已经注册用户（含升级）',
  `end_time` int(11) NOT NULL COMMENT '有效期至',
  `status` tinyint(2) NOT NULL COMMENT '0：已用完，1：还可注册，2：用户取消邀请，-1：管理员删除',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邀请码表';

-- ----------------------------
-- Records of os_invite
-- ----------------------------

-- ----------------------------
-- Table structure for os_invite_buy_log
-- ----------------------------
DROP TABLE IF EXISTS `os_invite_buy_log`;
CREATE TABLE `os_invite_buy_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY_KEY',
  `invite_type` int(11) NOT NULL COMMENT '邀请类型id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `num` int(10) NOT NULL COMMENT '可邀请名额',
  `content` varchar(200) NOT NULL COMMENT '记录信息',
  `create_time` int(11) NOT NULL COMMENT '创建时间（做频率用）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户购买邀请名额记录';

-- ----------------------------
-- Records of os_invite_buy_log
-- ----------------------------

-- ----------------------------
-- Table structure for os_invite_log
-- ----------------------------
DROP TABLE IF EXISTS `os_invite_log`;
CREATE TABLE `os_invite_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY_KEY',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `inviter_id` int(11) NOT NULL COMMENT '邀请人id',
  `invite_id` int(11) NOT NULL COMMENT '邀请码id',
  `content` varchar(200) NOT NULL COMMENT '记录内容',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邀请注册成功记录表';

-- ----------------------------
-- Records of os_invite_log
-- ----------------------------

-- ----------------------------
-- Table structure for os_invite_type
-- ----------------------------
DROP TABLE IF EXISTS `os_invite_type`;
CREATE TABLE `os_invite_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY_KEY',
  `title` varchar(25) NOT NULL COMMENT '标题',
  `length` int(10) NOT NULL DEFAULT '11' COMMENT '验证码长度',
  `time` varchar(50) NOT NULL COMMENT '有效时长，带单位的时间',
  `cycle_num` int(10) NOT NULL COMMENT '周期内可购买个数',
  `cycle_time` varchar(50) NOT NULL COMMENT '周期时长，带单位的时间',
  `roles` varchar(50) NOT NULL COMMENT '绑定角色ids',
  `auth_groups` varchar(50) NOT NULL COMMENT '允许购买的用户组ids',
  `pay_score` int(10) NOT NULL COMMENT '购买消耗积分',
  `pay_score_type` int(11) NOT NULL COMMENT '购买消耗积分类型',
  `income_score` int(10) NOT NULL COMMENT '每邀请成功一个用户，邀请者增加积分',
  `income_score_type` int(11) NOT NULL COMMENT '邀请成功后增加积分类型id',
  `is_follow` tinyint(2) NOT NULL COMMENT '邀请成功后是否互相关注',
  `status` tinyint(2) NOT NULL,
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邀请注册码类型表';

-- ----------------------------
-- Records of os_invite_type
-- ----------------------------

-- ----------------------------
-- Table structure for os_invite_user_info
-- ----------------------------
DROP TABLE IF EXISTS `os_invite_user_info`;
CREATE TABLE `os_invite_user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY_KEY',
  `invite_type` int(11) NOT NULL COMMENT '邀请类型id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `num` int(11) NOT NULL COMMENT '可邀请名额',
  `already_num` int(11) NOT NULL COMMENT '已邀请名额',
  `success_num` int(11) NOT NULL COMMENT '成功邀请名额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邀请注册用户信息';

-- ----------------------------
-- Records of os_invite_user_info
-- ----------------------------

-- ----------------------------
-- Table structure for os_local_comment
-- ----------------------------
DROP TABLE IF EXISTS `os_local_comment`;
CREATE TABLE `os_local_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `app` text NOT NULL,
  `mod` text NOT NULL,
  `row_id` int(11) NOT NULL,
  `parse` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `create_time` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` bigint(20) NOT NULL,
  `area` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_local_comment
-- ----------------------------
INSERT INTO `os_local_comment` VALUES ('1', '101', 'News', 'index', '14', '0', '博客模块怎么搞', '1480591406', '0', '1', '3232263681', '');
INSERT INTO `os_local_comment` VALUES ('2', '1', 'News', 'index', '2', '0', '样式布局太乱了吧', '1483153277', '0', '1', '3232263681', '');
INSERT INTO `os_local_comment` VALUES ('3', '1', 'News', 'index', '2', '0', '回复 @admin \n            样式布局太乱了吧        ：确实呀。。。。真搞不懂', '1483153297', '0', '1', '3232263681', '');

-- ----------------------------
-- Table structure for os_member
-- ----------------------------
DROP TABLE IF EXISTS `os_member`;
CREATE TABLE `os_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `qq` char(10) NOT NULL DEFAULT '' COMMENT 'qq号',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员状态',
  `last_login_role` int(11) NOT NULL,
  `show_role` int(11) NOT NULL COMMENT '个人主页显示角色',
  `signature` text NOT NULL,
  `pos_province` int(11) NOT NULL,
  `pos_city` int(11) NOT NULL,
  `pos_district` int(11) NOT NULL,
  `pos_community` int(11) NOT NULL,
  `score1` double DEFAULT '0' COMMENT '用户积分',
  `score2` double DEFAULT '0' COMMENT 'score2',
  `score3` double DEFAULT '0' COMMENT 'score3',
  `score4` double DEFAULT '0' COMMENT 'score4',
  `con_check` int(11) NOT NULL DEFAULT '0',
  `total_check` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `status` (`status`),
  KEY `name` (`nickname`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of os_member
-- ----------------------------
INSERT INTO `os_member` VALUES ('1', 'admin', '0', '0000-00-00', '', '58', '0', '1473086386', '3232263681', '1488695902', '1', '1', '1', '', '0', '0', '0', '0', '390', '0', '0', '0', '1', '1');
INSERT INTO `os_member` VALUES ('101', '包汉伟', '0', '0000-00-00', '', '41', '3232263681', '1476600423', '3232263681', '1488849616', '1', '1', '1', '拉黑世界，做回自己', '110000', '110100', '110101', '0', '276', '0', '0', '0', '2', '2');
INSERT INTO `os_member` VALUES ('102', '请叫我包包大人', '0', '0000-00-00', '', '2', '3232263681', '1476607329', '3232263681', '1477233275', '1', '1', '1', '', '0', '0', '0', '0', '20', '0', '0', '0', '0', '0');
INSERT INTO `os_member` VALUES ('103', '悠悠', '0', '0000-00-00', '', '0', '3232263681', '1487652824', '0', '0', '1', '0', '0', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO `os_member` VALUES ('104', '包包大人', '0', '0000-00-00', '', '0', '3232263681', '1487665325', '0', '0', '1', '0', '1', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for os_menu
-- ----------------------------
DROP TABLE IF EXISTS `os_menu`;
CREATE TABLE `os_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  `icon` varchar(20) NOT NULL COMMENT '导航图标',
  `module` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=10139 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_menu
-- ----------------------------
INSERT INTO `os_menu` VALUES ('1', '首页', '0', '1', 'Index/index', '0', '', '', '0', 'home', '');
INSERT INTO `os_menu` VALUES ('2', '用户', '0', '2', 'User/index', '0', '', '', '0', 'user', '');
INSERT INTO `os_menu` VALUES ('3', '用户信息', '2', '2', 'User/index', '0', '', '用户管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('4', '积分规则', '113', '3', 'User/action', '0', '', '行为管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('5', '新增用户行为', '4', '0', 'User/addaction', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('6', '编辑用户行为', '4', '0', 'User/editaction', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('7', '保存用户行为', '4', '0', 'User/saveAction', '0', '\"用户->用户行为\"保存编辑和新增的用户行为', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('8', '变更行为状态', '4', '0', 'User/setStatus', '0', '\"用户->用户行为\"中的启用,禁用和删除权限', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('9', '禁用会员', '4', '0', 'User/changeStatus?method=forbidUser', '0', '\"用户->用户信息\"中的禁用', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('10', '启用会员', '4', '0', 'User/changeStatus?method=resumeUser', '0', '\"用户->用户信息\"中的启用', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('11', '删除会员', '4', '0', 'User/changeStatus?method=deleteUser', '0', '\"用户->用户信息\"中的删除', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('12', '用户组管理', '2', '5', 'AuthManager/index', '0', '', '权限管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('13', '删除', '12', '0', 'AuthManager/changeStatus?method=deleteGroup', '0', '删除用户组', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('14', '禁用', '12', '0', 'AuthManager/changeStatus?method=forbidGroup', '0', '禁用用户组', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('15', '恢复', '12', '0', 'AuthManager/changeStatus?method=resumeGroup', '0', '恢复已禁用的用户组', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('16', '新增', '12', '0', 'AuthManager/createGroup', '0', '创建新的用户组', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('17', '编辑', '12', '0', 'AuthManager/editGroup', '0', '编辑用户组名称和描述', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('18', '保存用户组', '12', '0', 'AuthManager/writeGroup', '0', '新增和编辑用户组的\"保存\"按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('19', '授权', '12', '0', 'AuthManager/group', '0', '\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('20', '访问授权', '12', '0', 'AuthManager/access', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('21', '成员授权', '12', '0', 'AuthManager/user', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('22', '解除授权', '12', '0', 'AuthManager/removeFromGroup', '0', '\"成员授权\"列表页内的解除授权操作按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('23', '保存成员授权', '12', '0', 'AuthManager/addToGroup', '0', '\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('24', '分类授权', '12', '0', 'AuthManager/category', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('25', '保存分类授权', '12', '0', 'AuthManager/addToCategory', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('26', '模型授权', '12', '0', 'AuthManager/modelauth', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('27', '保存模型授权', '12', '0', 'AuthManager/addToModel', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('28', '新增权限节点', '12', '0', 'AuthManager/addNode', '1', '', '', '1', '', '');
INSERT INTO `os_menu` VALUES ('29', '前台权限管理', '12', '0', 'AuthManager/accessUser', '1', '', '权限管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('30', '删除权限节点', '12', '0', 'AuthManager/deleteNode', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('31', '行为日志', '113', '4', 'Action/actionlog', '0', '', '行为管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('32', '查看行为日志', '31', '0', 'action/edit', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('33', '修改密码', '2', '3', 'User/updatePassword', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('34', '修改昵称', '2', '4', 'User/updateNickname', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('35', '查看用户', '197', '1', 'Rank/userList', '0', '', '头衔管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('36', '用户头衔列表', '35', '0', 'Rank/userRankList', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('37', '关联新头衔', '35', '0', 'Rank/userAddRank', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('38', '编辑头衔关联', '35', '0', 'Rank/userChangeRank', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('39', '扩展资料', '2', '3', 'User/profile', '0', '', '用户管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('40', '添加、编辑分组', '39', '0', 'Admin/User/editProfile', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('41', '分组排序', '39', '0', 'Admin/User/sortProfile', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('42', '字段列表', '39', '0', 'Admin/User/field', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('43', '添加、编辑字段', '39', '0', 'Admin/User/editFieldSetting', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('44', '字段排序', '39', '0', 'Admin/User/sortField', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('45', '用户扩展资料列表', '2', '7', 'User/expandinfo_select', '0', '', '用户管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('46', '扩展资料详情', '45', '0', 'User/expandinfo_details', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('47', '待审核用户头衔', '197', '2', 'Rank/rankVerify', '0', '', '头衔管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('48', '被驳回的头衔申请', '197', '3', 'Rank/rankVerifyFailure', '0', '', '头衔管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('49', '转移用户组', '2', '7', 'User/changeGroup', '1', '批量转移用户组', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('50', '用户注册配置', '2', '1', 'UserConfig/index', '0', '', '注册配置', '0', '', '');
INSERT INTO `os_menu` VALUES ('51', '积分类型列表', '113', '1', 'User/scoreList', '0', '', '行为管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('52', '新增/编辑类型', '113', '2', 'User/editScoreType', '1', '', '行为管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('53', '充值积分', '113', '5', 'User/recharge', '1', '', '', '0', '用户管理', '');
INSERT INTO `os_menu` VALUES ('54', '头衔列表', '197', '6', 'Rank/index', '0', '', '头衔管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('55', '添加头衔', '54', '2', 'Rank/editRank', '1', '', '头衔管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('57', '插件管理', '105', '4', 'Addons/index', '0', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('58', '钩子管理', '57', '2', 'Addons/hooks', '0', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('59', '创建', '57', '0', 'Addons/create', '0', '服务器上创建插件结构向导', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('60', '检测创建', '57', '0', 'Addons/checkForm', '0', '检测插件是否可以创建', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('61', '预览', '57', '0', 'Addons/preview', '0', '预览插件定义类文件', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('62', '快速生成插件', '57', '0', 'Addons/build', '0', '开始生成插件结构', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('64', '设置', '57', '0', 'Addons/config', '0', '设置插件配置', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('65', '禁用', '57', '0', 'Addons/disable', '0', '禁用插件', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('66', '启用', '57', '0', 'Addons/enable', '0', '启用插件', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('67', '安装', '57', '0', 'Addons/install', '0', '安装插件', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('68', '卸载', '57', '0', 'Addons/uninstall', '0', '卸载插件', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('69', '更新配置', '57', '0', 'Addons/saveconfig', '0', '更新插件配置处理', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('70', '插件后台列表', '57', '0', 'Addons/adminList', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('71', 'URL方式访问插件', '57', '0', 'Addons/execute', '0', '控制是否有权限通过url访问插件控制器方法', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('72', '新增钩子', '58', '0', 'Addons/addHook', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('73', '编辑钩子', '58', '0', 'Addons/edithook', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('74', '系统', '0', '7', 'Config/group', '0', '', '', '0', 'windows', '');
INSERT INTO `os_menu` VALUES ('75', '网站设置', '74', '1', 'Config/group', '0', '', '系统设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('76', '配置管理', '74', '7', 'Config/index', '0', '', '系统设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('77', '编辑', '76', '0', 'Config/edit', '0', '新增编辑和保存配置', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('78', '删除', '76', '0', 'Config/del', '0', '删除配置', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('79', '新增', '76', '0', 'Config/add', '0', '新增配置', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('80', '保存', '76', '0', 'Config/save', '0', '保存配置', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('81', '排序', '76', '0', 'Config/sort', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('82', '后台菜单管理', '2', '6', 'Menu/index', '0', '', '权限管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('83', '新增', '82', '0', 'Menu/add', '0', '', '系统设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('84', '编辑', '82', '0', 'Menu/edit', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('85', '导入', '82', '0', 'Menu/import', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('86', '排序', '82', '0', 'Menu/sort', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('87', '顶部导航', '74', '3', 'Channel/index', '0', '', '导航管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('88', '新增', '87', '0', 'Channel/add', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('89', '编辑', '87', '0', 'Channel/edit', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('90', '删除', '87', '0', 'Channel/del', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('91', '排序', '87', '0', 'Channel/sort', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('92', '备份数据库', '113', '8', 'Database/index?type=export', '0', '', '数据备份', '0', '', '');
INSERT INTO `os_menu` VALUES ('93', '备份', '92', '0', 'Database/export', '0', '备份数据库', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('94', '优化表', '92', '0', 'Database/optimize', '0', '优化数据表', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('95', '修复表', '92', '0', 'Database/repair', '0', '修复数据表', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('96', '还原数据库', '113', '9', 'Database/index?type=import', '0', '', '数据备份', '0', '', '');
INSERT INTO `os_menu` VALUES ('97', '恢复', '96', '0', 'Database/import', '0', '数据库恢复', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('98', '删除', '96', '0', 'Database/del', '0', '删除备份文件', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('99', 'SEO规则管理', '74', '8', 'SEO/index', '0', '', 'SEO规则', '0', '', '');
INSERT INTO `os_menu` VALUES ('100', '新增、编辑', '99', '0', 'SEO/editRule', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('101', '排序', '99', '0', 'SEO/sortRule', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('102', 'SEO规则回收站', '74', '9', 'SEO/ruleTrash', '0', '', 'SEO规则', '0', '', '');
INSERT INTO `os_menu` VALUES ('103', '全部补丁', '74', '16', 'Update/quick', '1', '', '升级补丁', '0', '', '');
INSERT INTO `os_menu` VALUES ('104', '新增补丁', '74', '15', 'Update/addpack', '1', '', '升级补丁', '0', '', '');
INSERT INTO `os_menu` VALUES ('105', '扩展', '0', '11', 'Cloud/index', '0', '', '', '0', 'cloud', '');
INSERT INTO `os_menu` VALUES ('106', '模块安装', '105', '3', 'module/install', '1', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('107', '模块管理', '105', '5', 'module/lists', '0', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('108', '卸载模块', '105', '7', 'module/uninstall', '1', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('109', '授权', '0', '6', 'authorize/ssoSetting', '0', '', '', '0', 'lock', '');
INSERT INTO `os_menu` VALUES ('110', '单点登录配置', '109', '0', 'Authorize/ssoSetting', '0', '', '单点登录', '0', '', '');
INSERT INTO `os_menu` VALUES ('111', '应用列表', '109', '0', 'Authorize/ssolist', '0', '', '单点登录', '0', '', '');
INSERT INTO `os_menu` VALUES ('112', '新增/编辑应用', '109', '0', 'authorize/editssoapp', '1', '', '单点登录', '0', '', '');
INSERT INTO `os_menu` VALUES ('113', '安全', '0', '5', 'ActionLimit/limitList', '0', '', '', '0', 'shield', '');
INSERT INTO `os_menu` VALUES ('114', '行为限制列表', '113', '6', 'ActionLimit/limitList', '0', '', '行为限制', '0', '', '');
INSERT INTO `os_menu` VALUES ('115', '新增/编辑行为限制', '113', '7', 'ActionLimit/editLimit', '1', '', '行为限制', '0', '', '');
INSERT INTO `os_menu` VALUES ('116', '身份', '0', '3', 'Role/index', '0', '', '', '0', 'group', '');
INSERT INTO `os_menu` VALUES ('117', '身份列表', '116', '1', 'Role/index', '0', '', '身份管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('118', '编辑身份', '116', '2', 'Role/editRole', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('119', '启用、禁用、删除身份', '116', '3', 'Role/setStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('120', '身份排序', '116', '4', 'Role/sort', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('121', '默认积分配置', '117', '0', 'Role/configScore', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('122', '默认权限配置', '117', '0', 'Role/configAuth', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('123', '默认头像配置', '117', '0', 'Role/configAvatar', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('124', '默认头衔配置', '117', '0', 'Role/configRank', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('125', '默认字段管理', '117', '0', 'Role/configField', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('126', '身份分组', '116', '5', 'Role/group', '0', '', '身份管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('127', '编辑分组', '126', '0', 'Role/editGroup', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('128', '删除分组', '126', '0', 'Role/deleteGroup', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('129', '身份基本信息配置', '116', '6', 'Role/config', '1', '', '身份管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('130', '用户列表', '116', '7', 'Role/userList', '0', '', '身份用户管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('131', '设置用户状态', '130', '0', 'Role/setUserStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('132', '审核用户', '130', '0', 'Role/setUserAudit', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('133', '迁移用户', '130', '0', 'Role/changeRole', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('134', '上传默认头像', '123', '0', 'Role/uploadPicture', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('135', '类型管理', '116', '8', 'Invite/index', '0', '', '邀请注册管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('136', '邀请码管理', '116', '9', 'Invite/invite', '0', '', '邀请注册管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('137', '基础配置', '116', '10', 'Invite/config', '0', '', '邀请注册管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('138', '兑换记录', '116', '11', 'Invite/buyLog', '0', '', '邀请注册管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('139', '邀请记录', '116', '12', 'Invite/inviteLog', '0', '', '邀请注册管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('140', '用户信息', '116', '13', 'Invite/userInfo', '0', '', '邀请注册管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('141', '编辑邀请注册类型', '135', '0', 'Invite/edit', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('142', '删除邀请', '135', '0', 'Invite/setStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('143', '删除邀请码', '136', '0', 'Invite/delete', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('144', '生成邀请码', '136', '0', 'Invite/createCode', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('145', '删除无用邀请码', '136', '0', 'Invite/deleteTrue', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('146', '导出cvs', '136', '0', 'Invite/cvs', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('147', '用户信息编辑', '140', '0', 'Invite/editUserInfo', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('148', '删除日志', '31', '0', 'Action/remove', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('149', '清空日志', '31', '0', 'Action/clear', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('150', '设置积分状态', '51', '0', 'User/setTypeStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('151', '删除积分类型', '51', '0', 'User/delType', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('152', '充值积分-获取用户昵称', '53', '0', 'User/getNickname', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('153', '删除菜单', '82', '0', 'Menu/del', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('154', '设置开发者模式可见', '82', '0', 'Menu/toogleDev', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('155', '设置显示隐藏', '82', '0', 'Menu/toogleHide', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('156', '行为限制启用、禁用、删除', '114', '0', 'ActionLimit/setLimitStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('157', '启用、禁用、删除、回收站还原', '99', '0', 'SEO/setRuleStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('158', '回收站彻底删除', '102', '0', 'SEO/doClear', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('159', '初始化无角色用户', '130', '0', 'Role/initUnhaveUser', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('160', '删除钩子', '58', '0', 'Addons/delHook', '0', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('161', '使用补丁', '103', '0', 'Update/usePack', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('162', '查看补丁', '103', '0', 'Update/view', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('163', '删除补丁', '103', '0', 'Update/delPack', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('164', '用户标签列表', '2', '4', 'UserTag/userTag', '0', '', '用户管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('165', '添加分类、标签', '164', '0', 'UserTag/add', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('166', '设置分类、标签状态', '164', '0', 'UserTag/setStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('167', '分类、标签回收站', '164', '0', 'UserTag/tagTrash', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('168', '测底删除回收站内容', '164', '0', 'UserTag/userTagClear', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('169', '可拥有标签配置', '116', '14', 'role/configusertag', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('170', '编辑模块', '107', '0', 'Module/edit', '1', '', '模块管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('171', '网站信息', '74', '2', 'Config/website', '0', '', '系统设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('172', '主题管理', '105', '6', 'Theme/tpls', '0', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('173', '使用主题', '105', '8', 'Theme/setTheme', '1', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('174', '查看主题', '105', '9', 'Theme/lookTheme', '1', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('175', '主题打包下载', '105', '10', 'Theme/packageDownload', '1', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('176', '卸载删除主题', '105', '11', 'Theme/delete', '1', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('177', '上传安装主题', '105', '12', 'Theme/add', '1', '', '本地', '0', '', '');
INSERT INTO `os_menu` VALUES ('178', '云市场', '105', '1', 'Cloud/index', '0', '', '云市场', '0', '', '');
INSERT INTO `os_menu` VALUES ('197', '运营', '0', '4', 'Operation/index', '0', '', '', '0', 'laptop', '');
INSERT INTO `os_menu` VALUES ('198', '群发消息用户列表', '197', '4', 'message/userList', '0', '', '群发消息', '0', '', '');
INSERT INTO `os_menu` VALUES ('199', '群发消息', '197', '5', 'message/sendMessage', '1', '', '群发消息', '0', '', '');
INSERT INTO `os_menu` VALUES ('200', '在线安装', '178', '0', 'Cloud/install', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('201', '重置用户密码', '3', '0', 'User/initpass', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('202', '自动升级', '105', '2', 'Cloud/update', '0', '', '云市场', '0', '', '');
INSERT INTO `os_menu` VALUES ('203', '获取版本信息', '202', '0', 'Cloud/version', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('204', '获取文件列表', '202', '0', 'Cloud/getFileList', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('205', '比较本地文件', '202', '0', 'Cloud/compare', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('206', '覆盖文件', '202', '0', 'Cloud/cover', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('207', '更新数据库', '202', '0', 'Cloud/updb', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('208', '更新完成', '202', '0', 'Cloud/finish', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('209', '表情设置', '74', '4', 'Expression/index', '0', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('210', '添加表情包', '74', '5', 'Expression/add', '1', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('211', '表情包列表', '74', '6', 'Expression/package', '0', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('212', '表情列表', '74', '7', 'Expression/expressionList', '1', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('213', '删除表情包', '74', '8', 'Expression/delPackage', '1', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('214', '编辑表情包', '74', '9', 'Expression/editPackage', '1', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('215', '删除表情', '74', '10', 'Expression/delExpression', '1', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('216', '上传表情包', '74', '11', 'Expression/upload', '1', '', '表情设置', '0', '', '');
INSERT INTO `os_menu` VALUES ('217', '用户头衔审核', '47', '2', 'Rank/setVerifyStatus', '1', '', '头衔管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('218', '获取扩展升级列表', '106', '0', 'Cloud/getVersionList', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('219', '自动升级', '178', '0', 'Cloud/updateGoods', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('220', '自动升级1-获取文件列表', '178', '0', 'Cloud/Updating1', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('221', '自动升级2-比较文件', '178', '0', 'Cloud/Updating2', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('222', '自动升级3-升级代码', '178', '0', 'Cloud/updating3', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('223', '自动升级4-导入数据库', '178', '0', 'Cloud/updating4', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('224', '自动升级5-重置版本号', '178', '0', 'Cloud/updating5', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('225', '广告位', '197', '0', 'Adv/pos', '0', '', '广告配置', '0', '', '');
INSERT INTO `os_menu` VALUES ('226', '广告管理', '197', '0', 'Adv/adv', '0', '', '广告配置', '0', '', '');
INSERT INTO `os_menu` VALUES ('227', '新增广告', '226', '0', 'Adv/editAdv', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('228', '编辑广告位', '225', '0', 'Adv/editPos', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('229', '设置广告位状态', '225', '0', 'Adv/setPosStatus', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('230', '广告排期', '226', '0', 'Adv/schedule', '1', '', '', '0', '', '');
INSERT INTO `os_menu` VALUES ('231', '用户导航', '74', '0', 'Channel/user', '0', '', '导航管理', '0', '', 'Core');
INSERT INTO `os_menu` VALUES ('232', '积分日志', '113', '0', 'Action/scoreLog', '0', '', '积分管理', '0', '', '');
INSERT INTO `os_menu` VALUES ('10000', '网站主页', '0', '0', 'Home/config', '1', '', '', '0', 'home', 'Home');
INSERT INTO `os_menu` VALUES ('10001', '基本设置', '10000', '0', 'Home/config', '0', '', '设置', '0', '', 'Home');
INSERT INTO `os_menu` VALUES ('10002', '微博', '0', '8', 'Weibo/weibo', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10003', '微博管理', '10002', '1', 'Weibo/weibo', '0', '', '微博', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10004', '回复管理', '10002', '3', 'Weibo/comment', '0', '', '回复', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10005', '编辑微博', '10002', '0', 'Weibo/editWeibo', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10006', '编辑回复', '10002', '0', 'Weibo/editComment', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10007', '微博回收站', '10002', '2', 'Weibo/weiboTrash', '0', '', '微博', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10008', '回复回收站', '10002', '4', 'Weibo/commentTrash', '0', '', '回复', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10009', '微博设置', '10002', '0', 'Weibo/config', '0', '微博的基本配置', '设置', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10010', '话题管理', '10002', '0', 'Weibo/topic', '0', '微博的话题', '话题管理', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10011', '置顶微博', '10002', '0', 'Weibo/setWeiboTop', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10012', '设置微博状态', '10002', '0', 'Weibo/setWeiboStatus', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10013', '设置微博评论状态', '10002', '0', 'Weibo/setCommentStatus', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10014', '设置置顶话题', '10002', '0', 'Weibo/setTopicTop', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10015', '删除话题', '10002', '0', 'Weibo/delTopic', '1', '', '', '0', '', 'Weibo');
INSERT INTO `os_menu` VALUES ('10016', '会员展示', '0', '22', 'People/config', '1', '', '', '0', '', 'People');
INSERT INTO `os_menu` VALUES ('10017', '基本设置', '10016', '0', 'People/config', '0', '', '配置', '0', '', 'People');
INSERT INTO `os_menu` VALUES ('10018', '资讯', '0', '22', 'News/index', '1', '', '', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10019', '审核列表', '10018', '0', 'News/audit', '0', '', '资讯管理', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10020', '资讯审核失败操作', '10019', '0', 'News/doAudit', '1', '', '', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10021', '审核通过', '10019', '0', 'News/setNewsStatus', '1', '', '', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10022', '分类管理', '10018', '0', 'News/newsCategory', '0', '', '资讯配置', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10023', '编辑、添加分类', '10022', '0', 'News/add', '1', '', '', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10024', '设置分类状态', '10022', '0', 'News/setStatus', '1', '', '', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10025', '资讯列表', '10018', '0', 'News/index', '0', '', '资讯管理', '0', 'rss-sign', 'News');
INSERT INTO `os_menu` VALUES ('10026', '设为到期', '10025', '0', 'News/setDead', '1', '', '', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10027', '编辑、添加资讯', '10025', '0', 'News/editNews', '1', '', '', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10028', '基础配置', '10018', '0', 'News/config', '0', '', '资讯配置', '0', '', 'News');
INSERT INTO `os_menu` VALUES ('10029', '博客', '0', '23', 'Blog/index', '1', '', '', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10030', '博客列表', '10029', '1', 'Blog/index', '0', '', '博客管理', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10031', '分类管理', '10029', '4', 'Blog/blogCategory', '0', '', '博客配置', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10032', '基础配置', '10029', '3', 'Blog/config', '0', '', '博客配置', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10033', '编辑、添加博客', '10030', '0', 'Blog/editBlog', '1', '', '', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10034', '设为到期', '10030', '0', 'Blog/setDead', '1', '', '', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10035', '编辑、添加分类', '10031', '0', 'Blog/add', '1', '', '', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10036', '设置分类状态', '10031', '0', 'Blog/setStatus', '1', '', '', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10040', '问答', '0', '22', 'Question/index', '1', '', '', '0', 'question', 'Question');
INSERT INTO `os_menu` VALUES ('10038', '编辑、添加分类', '10037', '0', 'Blog/addblogcategory', '1', '', '', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10039', '设置分类状态', '10037', '0', 'Blog/setBlogStatus', '1', '', '', '0', '', 'Blog');
INSERT INTO `os_menu` VALUES ('10041', '分类管理', '10040', '0', 'Question/category', '0', '', '配置管理', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10042', '设置分类状态', '10041', '0', 'Question/setStatus', '1', '', '', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10043', '编辑、添加分类', '10041', '0', 'Question/add', '1', '', '', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10044', '基础配置', '10040', '0', 'Question/config', '0', '', '配置管理', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10045', '回答列表', '10040', '0', 'Question/answer', '0', '', '问答管理', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10046', '设置回答状态（启用、禁用、删除）', '10045', '0', 'Question/setAnswerStatus', '1', '', '', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10047', '问题列表', '10040', '0', 'Question/index', '0', '', '问答管理', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10048', '推荐设置', '10047', '0', 'Question/recommend', '1', '', '', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10049', '设置问题状态（审核、启用、禁用、删除）', '10047', '0', 'Question/setQuestionStatus', '1', '', '', '0', '', 'Question');
INSERT INTO `os_menu` VALUES ('10112', '教程', '0', '0', 'Book/index', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10113', '教程列表', '10112', '0', 'Book/index', '0', '', '教程管理', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10114', '设置章节状态', '10113', '0', 'Book/setSectionStatus', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10115', '设置教程状态', '10113', '0', 'Book/setBookStatus', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10116', '编辑教程', '10113', '0', 'Book/editBook', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10117', '批量编辑章节', '10113', '0', 'Book/editSections', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10118', '章节列表', '10113', '0', 'Book/sections', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10119', '编辑章节', '10113', '0', 'Book/editSection', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10120', '教程排序', '10113', '0', 'Book/sortBook', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10121', '章节排序', '10113', '0', 'Book/sortSections', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10122', '修改章节类型', '10113', '0', 'Book/changeSectionType', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10123', '教程分类', '10112', '0', 'Book/bookCategory', '0', '', '配置管理', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10124', '设置分类状态', '10123', '0', 'Book/setStatus', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10125', '编辑分类', '10123', '0', 'Book/add', '1', '', '', '0', '', 'Book');
INSERT INTO `os_menu` VALUES ('10126', '活动', '0', '22', 'Event/index', '1', '', '', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10127', '活动设置', '10126', '0', 'Event/config', '0', '', '设置', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10128', '内容回收站', '10126', '0', 'Event/contentTrash', '0', '', '内容管理', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10129', '内容审核', '10126', '0', 'Event/verify', '0', '', '内容管理', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10130', '活动分类管理', '10126', '0', 'Event/index', '0', '', '活动分类管理', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10131', '分类禁用、启用、删除', '10130', '0', 'Event/setStatus', '1', '', '', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10132', '分类操作', '10130', '0', 'Event/operate', '1', '', '', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10133', '合并分类', '10130', '0', 'Event/doMerge', '1', '', '', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10134', '活动分类回收站', '10126', '0', 'Event/eventTypeTrash', '0', '', '活动分类管理', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10135', '内容管理', '10126', '0', 'Event/event', '0', '', '内容管理', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10136', '设置活动状态（删除、审核）', '10135', '0', 'Event/setEventContentStatus', '1', '', '', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10137', '设为推荐', '10135', '0', 'Event/doRecommend', '1', '', '', '0', '', 'Event');
INSERT INTO `os_menu` VALUES ('10138', '编辑活动', '10135', '0', 'Event/add', '1', '', '', '0', '', 'Event');

-- ----------------------------
-- Table structure for os_message
-- ----------------------------
DROP TABLE IF EXISTS `os_message`;
CREATE TABLE `os_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `from_uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `last_toast` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='消息表';

-- ----------------------------
-- Records of os_message
-- ----------------------------
INSERT INTO `os_message` VALUES ('1', '1', '101', '102', '1476887806', '1', '1477233284', '1');
INSERT INTO `os_message` VALUES ('2', '2', '101', '102', '1476971142', '1', '1477233284', '1');
INSERT INTO `os_message` VALUES ('3', '3', '101', '102', '1476971169', '1', '1477233284', '1');
INSERT INTO `os_message` VALUES ('4', '4', '101', '102', '1476971562', '1', '1477233284', '1');
INSERT INTO `os_message` VALUES ('5', '5', '101', '102', '1476971930', '1', '1477233284', '1');
INSERT INTO `os_message` VALUES ('6', '6', '101', '102', '1476972110', '1', '1477233284', '1');
INSERT INTO `os_message` VALUES ('7', '7', '101', '102', '1476972116', '1', '1477233284', '1');
INSERT INTO `os_message` VALUES ('8', '8', '101', '1', '1477199032', '1', '1477578306', '1');
INSERT INTO `os_message` VALUES ('9', '9', '101', '102', '1478349106', '0', '0', '1');
INSERT INTO `os_message` VALUES ('10', '10', '101', '102', '1478349213', '0', '0', '1');
INSERT INTO `os_message` VALUES ('11', '11', '101', '102', '1478349228', '0', '0', '1');
INSERT INTO `os_message` VALUES ('12', '12', '101', '1', '1479618680', '1', '1479823821', '1');
INSERT INTO `os_message` VALUES ('13', '13', '0', '101', '1480087996', '1', '1480340233', '1');
INSERT INTO `os_message` VALUES ('14', '14', '0', '1', '1480434728', '1', '1480566895', '1');
INSERT INTO `os_message` VALUES ('15', '15', '101', '101', '1486915647', '0', '1486915651', '1');
INSERT INTO `os_message` VALUES ('16', '16', '1', '101', '1487050877', '0', '1487050878', '1');

-- ----------------------------
-- Table structure for os_message_content
-- ----------------------------
DROP TABLE IF EXISTS `os_message_content`;
CREATE TABLE `os_message_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `args` text NOT NULL,
  `type` tinyint(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_message_content
-- ----------------------------
INSERT INTO `os_message_content` VALUES ('1', '101', '粉丝数增加', '包汉伟 关注了你。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1476887806', '1');
INSERT INTO `os_message_content` VALUES ('2', '101', '粉丝数减少', '包汉伟 取消了对你的关注。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1476971142', '1');
INSERT INTO `os_message_content` VALUES ('3', '101', '粉丝数增加', '包汉伟 关注了你。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1476971169', '1');
INSERT INTO `os_message_content` VALUES ('4', '101', '粉丝数减少', '包汉伟 取消了对你的关注。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1476971562', '1');
INSERT INTO `os_message_content` VALUES ('5', '101', '粉丝数增加', '包汉伟 关注了你。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1476971930', '1');
INSERT INTO `os_message_content` VALUES ('6', '101', '粉丝数减少', '包汉伟 取消了对你的关注。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1476972110', '1');
INSERT INTO `os_message_content` VALUES ('7', '101', '粉丝数增加', '包汉伟 关注了你。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1476972116', '1');
INSERT INTO `os_message_content` VALUES ('8', '101', '粉丝数增加', '包汉伟 关注了你。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1477199032', '1');
INSERT INTO `os_message_content` VALUES ('9', '101', '粉丝数减少', '包汉伟 取消了对你的关注。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1478349106', '1');
INSERT INTO `os_message_content` VALUES ('10', '101', '粉丝数增加', '包汉伟 关注了你。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1478349213', '1');
INSERT INTO `os_message_content` VALUES ('11', '101', '粉丝数减少', '包汉伟 取消了对你的关注。', 'Ucenter/Index/index', '{\"uid\":\"101\"}', '0', '1478349228', '1');
INSERT INTO `os_message_content` VALUES ('12', '101', '包汉伟回答了你的问题【微信公众号开发实时聊天页面】或编辑了 Ta 的答案，快去看看吧！', '问题被回答', 'Question/Index/detail', '{\"id\":1}', '1', '1479618680', '1');
INSERT INTO `os_message_content` VALUES ('13', '0', '答案被支持', '用户admin支持了你关于问题微信公众号开发实时聊天页面的回答。', 'Question/index/detail', '{\"id\":\"1\"}', '1', '1480087996', '1');
INSERT INTO `os_message_content` VALUES ('14', '0', '答案被支持', '用户包汉伟支持了你关于问题这条SQL语句在TP的操作方法里面应该怎么写呢？的回答。', 'Question/index/detail', '{\"id\":\"4\"}', '1', '1480434728', '1');
INSERT INTO `os_message_content` VALUES ('15', '101', '头衔申请', '头衔申请成功,等待管理员审核', 'Ucenter/Message/message', '{\"tab\":\"system\"}', '0', '1486915647', '1');
INSERT INTO `os_message_content` VALUES ('16', '1', '头衔申请审核通过', '管理员通过了你的头衔申请：[博客专家]', 'Ucenter/Message/message', '', '1', '1487050877', '1');

-- ----------------------------
-- Table structure for os_module
-- ----------------------------
DROP TABLE IF EXISTS `os_module`;
CREATE TABLE `os_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '模块名',
  `alias` varchar(30) NOT NULL COMMENT '中文名',
  `version` varchar(20) NOT NULL COMMENT '版本号',
  `is_com` tinyint(4) NOT NULL COMMENT '是否商业版',
  `show_nav` tinyint(4) NOT NULL COMMENT '是否显示在导航栏中',
  `summary` varchar(200) NOT NULL COMMENT '简介',
  `developer` varchar(50) NOT NULL COMMENT '开发者',
  `website` varchar(200) NOT NULL COMMENT '网址',
  `entry` varchar(50) NOT NULL COMMENT '前台入口',
  `is_setup` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否已安装',
  `sort` int(11) NOT NULL COMMENT '模块排序',
  `icon` varchar(20) NOT NULL,
  `can_uninstall` tinyint(4) NOT NULL,
  `admin_entry` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `name_2` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='模块管理表';

-- ----------------------------
-- Records of os_module
-- ----------------------------
INSERT INTO `os_module` VALUES ('1', 'Home', '网站主页', '2.0.0', '0', '1', '首页模块，主要用于展示网站内容', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'Home/index/index', '1', '0', 'home', '1', 'Admin/Home/config');
INSERT INTO `os_module` VALUES ('2', 'Ucenter', '用户中心', '2.0.0', '0', '1', '用户中心模块，系统核心模块', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'Ucenter/index/index', '1', '0', 'user', '0', 'Admin/User/index');
INSERT INTO `os_module` VALUES ('3', 'People', '找人', '2.0.0', '0', '1', '会员展示模块，可以用于会员的查找', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'People/index/index', '1', '0', 'group', '1', 'People/config');
INSERT INTO `os_module` VALUES ('4', 'Weibo', '微博', '2.0.0', '0', '1', '微博模块，用户可以发布微博', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'Weibo/index/index', '1', '0', 'quote-left', '1', 'Admin/Weibo/weibo');
INSERT INTO `os_module` VALUES ('12', 'Core', '系统公共模块', '2.1.0', '0', '0', '系统核心模块，必不可少，负责核心的处理。', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', '', '1', '0', 'globe', '0', '');
INSERT INTO `os_module` VALUES ('13', 'News', '资讯', '2.3.1', '0', '1', '资讯模块，用户可前台投稿的CMS模块', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'News/index/index', '1', '0', 'rss-sign', '1', 'Admin/News/index');
INSERT INTO `os_module` VALUES ('14', 'Blog', '博客', '1.0.0', '0', '1', '博客模块，用户撰写博客的CMS模块', '包汉伟', '', 'Blog/index/index', '1', '0', 'rss-sign', '1', 'Admin/Blog/index');
INSERT INTO `os_module` VALUES ('15', 'Api', 'Api', '1.6.4', '1', '0', 'Api模块', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', '', '0', '0', 'font', '1', 'Admin/Api/index');
INSERT INTO `os_module` VALUES ('16', 'Question', '问答', '2.3.2', '1', '1', '问答模块，用户可前台发布、回答问题', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'Question/index/index', '1', '0', 'question', '1', 'Admin/Question/index');
INSERT INTO `os_module` VALUES ('17', 'Group', '群组', '2.8.0', '0', '1', '群组模块，允许用户建立自己的圈子', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'Group/index/index', '0', '0', 'flag', '1', 'Admin/Group/group');
INSERT INTO `os_module` VALUES ('18', 'Tutorial', '教程', '1.0.0', '0', '1', '教程模块，提供国内专业的编程入门教程及技术手册', '包包大人', 'http://www.phpzhidao.com', 'Tutorial/index/index', '0', '0', 'flag', '1', 'Admin/Tutorial/tutorial');
INSERT INTO `os_module` VALUES ('19', 'Book', '教程', '2.1.0', '1', '1', '教程模块，可以用于发布用户教程等', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'Book/Index/index', '1', '0', 'book', '1', 'Admin/Book/index');
INSERT INTO `os_module` VALUES ('20', 'Event', '活动', '2.8.0', '0', '1', '活动模块，用户可以发起活动', '嘉兴想天信息科技有限公司', 'http://www.ourstu.com', 'Event/index/index', '1', '0', 'map-marker', '1', 'Admin/Event/index');

-- ----------------------------
-- Table structure for os_news
-- ----------------------------
DROP TABLE IF EXISTS `os_news`;
CREATE TABLE `os_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `category` int(11) NOT NULL COMMENT '分类',
  `status` tinyint(2) NOT NULL COMMENT '状态',
  `reason` varchar(100) NOT NULL COMMENT '审核失败原因',
  `sort` int(5) NOT NULL COMMENT '排序',
  `position` int(4) NOT NULL COMMENT '定位，展示位',
  `cover` int(11) NOT NULL COMMENT '封面',
  `view` int(10) NOT NULL COMMENT '阅读量',
  `comment` int(10) NOT NULL COMMENT '评论量',
  `collection` int(10) NOT NULL COMMENT '收藏量',
  `dead_line` int(11) NOT NULL COMMENT '有效期',
  `source` varchar(200) NOT NULL COMMENT '来源url',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='资讯';

-- ----------------------------
-- Records of os_news
-- ----------------------------
INSERT INTO `os_news` VALUES ('6', '1', '晋升的为什么不是你', '2011年底的时候，在网上看了一篇文章，《能让你少奋斗10年的工作经验》，其中大部分条目与工作态度相关，有实例，可操作，故有此感慨。职场纵横，如果下面8条，你也符合部分状态，或许，这就是“晋升的为什么不是你”的答案了。一、心灵停留在舒适区是不可原谅的状态为：1）期望舒适，不愿被打扰，不愿被push，不愿被职责，不愿主动关心别人，不愿思考如何提高团队效率；2）会议上，消极听取领导意见，消极待命，很死', '5', '1', '', '0', '0', '36', '51', '0', '0', '2147483640', '', '1488518715', '1488518715');
INSERT INTO `os_news` VALUES ('4', '1', '架构图解：支付宝钱包系统架构内部剖析', '支付宝是中国支付行业的一个标兵，无论是业务能力还是产品创都引领者中国支付行业的前沿，作为支付业务的基础系统的复杂性和稳定性是支付业务是否能够及时快速安全处理的根本，本期支付圈收集了支付宝的系统架构图包含：清算 客服  处理  资金 财务 等等 供其他支付公司进行参考', '2', '1', '', '0', '0', '33', '4', '0', '0', '2147483640', '', '1488511775', '1488511775');
INSERT INTO `os_news` VALUES ('5', '1', '58同城架构演进，流量从0到10亿', '58同城流量从小到大过程中，架构是如何演进的？遇到了哪些问题？以及如何解决这些问题？', '2', '1', '', '0', '0', '35', '8', '0', '0', '2147483640', '', '1488515452', '1488515452');
INSERT INTO `os_news` VALUES ('7', '1', '在 2017 年做 PHP 开发是一种什么样的体验？', '在 2017 年做 PHP 开发是一种什么样的体验？嘿，我*近接到一个网站开发的项目，不过老实说，我这两年没怎么接触编程，听说 Web 技术已经发生了一些变化。听说你是这里对新技术*了解的开发工程师？你算是找对 ...', '5', '1', '', '0', '0', '37', '1', '0', '0', '2147483640', '', '1488559641', '1488559641');

-- ----------------------------
-- Table structure for os_news_category
-- ----------------------------
DROP TABLE IF EXISTS `os_news_category`;
CREATE TABLE `os_news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `pid` int(11) NOT NULL,
  `can_post` tinyint(4) NOT NULL COMMENT '前台可投稿',
  `need_audit` tinyint(4) NOT NULL COMMENT '前台投稿是否需要审核',
  `sort` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='资讯分类';

-- ----------------------------
-- Records of os_news_category
-- ----------------------------
INSERT INTO `os_news_category` VALUES ('1', '语言&开发', '0', '1', '1', '1', '1');
INSERT INTO `os_news_category` VALUES ('2', '架构&设计', '0', '1', '1', '2', '1');
INSERT INTO `os_news_category` VALUES ('3', '我的投稿', '0', '1', '1', '5', '-1');
INSERT INTO `os_news_category` VALUES ('4', '数据&科学', '0', '1', '1', '3', '1');
INSERT INTO `os_news_category` VALUES ('5', '文化&方法', '0', '1', '1', '4', '1');

-- ----------------------------
-- Table structure for os_news_detail
-- ----------------------------
DROP TABLE IF EXISTS `os_news_detail`;
CREATE TABLE `os_news_detail` (
  `news_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '内容',
  `template` varchar(50) NOT NULL COMMENT '模板',
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='资讯详情';

-- ----------------------------
-- Records of os_news_detail
-- ----------------------------
INSERT INTO `os_news_detail` VALUES ('6', '<p><span style=\"line-height: 1.6;\">2011年底的时候，在网上看了一篇文章，《能让你少奋斗10年的工作经验》，其中大部分条目与工作态度相关，有实例，可操作，故有此感慨。</span><br/></p><p>职场纵横，如果下面8条，你也符合部分状态，或许，这就是“晋升的为什么不是你”的答案了。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>一、心灵停留在舒适区是不可原谅的</strong></span><br style=\"margin: 0px; padding: 0px;\"/>状态为：<br style=\"margin: 0px; padding: 0px;\"/>1）<span style=\"color: rgb(238, 87, 13);\">期望舒适</span>，不愿被打扰，<span style=\"color: rgb(238, 87, 13);\">不愿被push</span>，不愿被职责，不愿主动关心别人，不愿思考如何提高团队效率；<br style=\"margin: 0px; padding: 0px;\"/>2）会议上，消极听取领导意见，<span style=\"color: rgb(238, 87, 13);\">消极待命，很死的完成交予的任务</span>；<br style=\"margin: 0px; padding: 0px;\"/>3）不主动接触其他同事，<span style=\"color: rgb(238, 87, 13);\">聚会不主动发言</span>，没有做好社交的准备；<br style=\"margin: 0px; padding: 0px;\"/>把身边的“随意性”赶走，尽早的冲出自己的舒适区域，开始做好和这个社会交流的准备。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>二、“好像、有人会、大概、晚些时候、说不定、应该”不要常挂嘴边</strong></span><br style=\"margin: 0px; padding: 0px;\"/>状态为：<br style=\"margin: 0px; padding: 0px;\"/>1）“我<span style=\"color: rgb(238, 87, 13);\">晚些时候</span>给他”；<br style=\"margin: 0px; padding: 0px;\"/>2）“<span style=\"color: rgb(238, 87, 13);\">应该是</span>明天”；<br style=\"margin: 0px; padding: 0px;\"/>3）“<span style=\"color: rgb(238, 87, 13);\">到时候</span>有人会把东西准备好”；<br style=\"margin: 0px; padding: 0px;\"/>4）“他<span style=\"color: rgb(238, 87, 13);\">好像</span>说是明天”；<br style=\"margin: 0px; padding: 0px;\"/>这么说的人，<strong>一来想给自己留余地，二来不想给别人造成压迫感</strong>。</p><p><br/></p><p>这样的答案等于没说，<strong>这样的回答往往暴露其更多的缺点</strong>：<br style=\"margin: 0px; padding: 0px;\"/>1）之前没有想到这个工作，或者一直在拖延；<br style=\"margin: 0px; padding: 0px;\"/>2）没有责任心，认为这个不重要；<br style=\"margin: 0px; padding: 0px;\"/>3）应付上级；<br style=\"margin: 0px; padding: 0px;\"/>4）不敢说真话；<br style=\"margin: 0px; padding: 0px;\"/>5）逞能，喜欢答应一些做不到的事；<br style=\"margin: 0px; padding: 0px;\"/>6）不能独立工作；</p><p><br/></p><p><strong>这样的回答，可能让上级更加恼火</strong>：<br style=\"margin: 0px; padding: 0px;\"/>1）<span style=\"color: rgb(238, 87, 13);\">上级的问题没有得到解答，只是起到了提醒你的作用</span>；<br style=\"margin: 0px; padding: 0px;\"/>2）<span style=\"color: rgb(238, 87, 13);\">上级依然要记得提醒你</span>，因为他不知道事情是否真的落实；<br style=\"margin: 0px; padding: 0px;\"/>3）上级<span style=\"color: rgb(238, 87, 13);\">不知道有多少你已经做了的事情中，都是这样落实的</span>（非常致命）；<br style=\"margin: 0px; padding: 0px;\"/>4）上级往往因为没有得到满意的答案，<span style=\"color: rgb(238, 87, 13);\">导致上级自己的计划被推迟</span>或者没有明朗的时间（你把上级的工作计划耽误了）；</p><p><br/></p><p>一个例子，上级问：你什么时候能把要这个漏洞修好？<br style=\"margin: 0px; padding: 0px;\"/>乙说：我已经通知他们了，他们大概明天就会来修的。<br style=\"margin: 0px; padding: 0px;\"/>一天后<br style=\"margin: 0px; padding: 0px;\"/>上级问：维修公司什么时候回来，你找的是哪家维修公司？<br style=\"margin: 0px; padding: 0px;\"/>乙说：好像他们说安排不出人来，如果可以的话，今天晚上或者明天下午就能过来。<br style=\"margin: 0px; padding: 0px;\"/>一天后<br style=\"margin: 0px; padding: 0px;\"/>上级问：漏洞怎么还没有修好？<br style=\"margin: 0px; padding: 0px;\"/>乙说：我晚点再问问他们。<br style=\"margin: 0px; padding: 0px;\"/>上级说：今天下午之前不解决，明天不用来上班了。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>三、不要拖延</strong></span><br style=\"margin: 0px; padding: 0px;\"/>状态为：<br style=\"margin: 0px; padding: 0px;\"/>1）“决定把事情突击完成”；<br style=\"margin: 0px; padding: 0px;\"/>2）“工作永远做不完”；<br style=\"margin: 0px; padding: 0px;\"/>3）“彷徨如何实施的时候，<span style=\"color: rgb(238, 87, 13);\">上级看不下去了，上级自己去做了</span>”（危险的信号）；<br style=\"margin: 0px; padding: 0px;\"/>4）“等看完这一集再做吧”（往往会忘记或者来不及）；<br style=\"margin: 0px; padding: 0px;\"/><span style=\"color: rgb(238, 87, 13);\">不多说，说做就做</span>是良好的习惯。<br style=\"margin: 0px; padding: 0px;\"/>如果不知道做，不用想太多太多时间，求助吧。<br style=\"margin: 0px; padding: 0px;\"/>不要让苦恼和忧虑给你更多的机会蚕食更多的时间。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>四、理论上可行不等于大功告成</strong></span><br style=\"margin: 0px; padding: 0px;\"/>这一点很重要，实施的人开始动手时，往往发现<span style=\"color: rgb(238, 87, 13);\">计划可能等于鬼话</span>。<br style=\"margin: 0px; padding: 0px;\"/>不亲自实践，做计划的人早晚被鄙视。<br style=\"margin: 0px; padding: 0px;\"/><span style=\"color: rgb(238, 87, 13);\">提高自己办实事的能力，切忌空谈</span>。</p><p><br/></p><p>一个例子：持续两个小时的会议，理论上看上去很完美，是否考虑到：<br style=\"margin: 0px; padding: 0px;\"/>开场后调试话筒30分钟；<br style=\"margin: 0px; padding: 0px;\"/>观众提出尖锐的问题；<br style=\"margin: 0px; padding: 0px;\"/>探讨的问题展开了；<br style=\"margin: 0px; padding: 0px;\"/>…<br style=\"margin: 0px; padding: 0px;\"/>不可能考虑到所有的异常状况，想想按照事先的计划，结果会怎样。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>五、不要让别人等你</strong></span><br style=\"margin: 0px; padding: 0px;\"/>工作中任何时候都不要让别人放下手头的工作来等你。<br style=\"margin: 0px; padding: 0px;\"/>做协同工作时，<span style=\"color: rgb(238, 87, 13);\">关注别人的进度，不要落后</span>。<br style=\"margin: 0px; padding: 0px;\"/>当大家发现你的工作量完全可以由其他人代替时，团队就可以不需要你了。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>六、细节很重要</strong></span><br style=\"margin: 0px; padding: 0px;\"/>细节是升职的本钱：<br style=\"margin: 0px; padding: 0px;\"/>1）一个慌忙寻找保险柜钥匙的动作可能让你丧失晋升财务主管的机会；<br style=\"margin: 0px; padding: 0px;\"/>2）<span style=\"color: rgb(238, 87, 13);\">项目谁都能做到60分，但细节决定最终的结果</span>；<br style=\"margin: 0px; padding: 0px;\"/>3）细节决定成败，就是这么残酷。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>七、不要表现的消极</strong></span><br style=\"margin: 0px; padding: 0px;\"/>1）可能做的事情不是自己的兴趣，但不能懒散，懒得理睬，想办法应付；<br style=\"margin: 0px; padding: 0px;\"/>2）可能做的事情很机械，但不要表现的闷闷不乐，因为你可能郁闷更久；<br style=\"margin: 0px; padding: 0px;\"/>3）<span style=\"color: rgb(238, 87, 13);\">上级为项目已经够烦恼了，你还想让他看到你的表情</span>？<br style=\"margin: 0px; padding: 0px;\"/>4）想想你能否在很好的状态下完成以下的工作么：<br style=\"margin: 0px; padding: 0px;\"/>高速公路收费员：每天对着小窗口递卡片，持续三年；<br style=\"margin: 0px; padding: 0px;\"/>学校食堂厨师：烧鸡腿，持续一年；<br style=\"margin: 0px; padding: 0px;\"/>作家：交稿期到了，两个星期没吃早餐了；<br style=\"margin: 0px; padding: 0px;\"/>门市部销售：坐了一天，每一个人来，和昨天一样；<br style=\"margin: 0px; padding: 0px;\"/>IT职员：晚上两点下班，第二天还要上班，持续一个月了；<br style=\"margin: 0px; padding: 0px;\"/>…<br style=\"margin: 0px; padding: 0px;\"/>想想自己接触这个工作，多长时间才碰到一个难题，然后就开始抱怨。<br style=\"margin: 0px; padding: 0px;\"/>有没有一个有趣的职业，工作的很开心，还是自己的兴趣。</p><p><br/></p><p><span style=\"font-size: 18px;\"><strong>八、不要推卸责任</strong></span><br style=\"margin: 0px; padding: 0px;\"/><span style=\"color: rgb(238, 87, 13);\">推卸责任是害怕的条件反射</span>，不要认为别人看不出这一点。</p><p>记得我小学里的一件事情。我一次作业没有带来，老师训斥我：你怎么老是作业不带？<br style=\"margin: 0px; padding: 0px;\"/>我当时说：不是。。。。<br style=\"margin: 0px; padding: 0px;\"/>当我正要支支吾吾时候，老师说：什么不是？你带来了没有？<br style=\"margin: 0px; padding: 0px;\"/>我说：没有<br style=\"margin: 0px; padding: 0px;\"/>老师说：那不就是没有带！什么不是！就是！</p><p><br/></p><p>很多人面对工作也是这样，上级问责的时候，<span style=\"color: rgb(238, 87, 13);\">条件反射的做出推卸动作</span>，然后是一大推无力的辩解和粗糙的借口。<br style=\"margin: 0px; padding: 0px;\"/>仔细想想，究竟是不是自己的责任，是不是要改进自己处事的方法。</p><p><br/></p>', '');
INSERT INTO `os_news_detail` VALUES ('4', '<p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\"><span style=\"max-width: 100%; font-size: 18px; box-sizing: border-box !important; word-wrap: break-word !important;\"><img data-s=\"300,640\" data-type=\"png\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icBzVibdeU3vLCkURpicKu48NT9e3xaJ57KLBib3AmDIHNJPuGbYTsTDUyszccKfP3lZicxicBRHyPTdO5hA/0?wx_fmt=png\" data-ratio=\"0.5533980582524272\" data-w=\"618\" style=\"width: auto ! important; height: auto ! important; visibility: visible ! important;\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icBzVibdeU3vLCkURpicKu48NT9e3xaJ57KLBib3AmDIHNJPuGbYTsTDUyszccKfP3lZicxicBRHyPTdO5hA/640?wx_fmt=png&wxfrom=5&wx_lazy=1\" data-fail=\"0\"/><br/></span></p><p>支付宝是中国支付行业的一个标兵，无论是业务能力还是产品创都引领者中国支付行业的前沿，作为支付业务的基础系统的复杂性和稳定性是支付业务是否能够及时快速安全处理的根本，本期支付圈收集了支付宝的系统架构图包含：清算\r\n 客服 &nbsp;处理 &nbsp;资金 财务 等等 供其他支付公司进行参考！</p><p>本文为网络收集信息，虽然不属于支付宝的最新系统架构信息但是作为支付行业的龙头，架构系统依然值得学习！</p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><hr style=\"max-width: 100%; color: rgb(62, 62, 62); white-space: normal; line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"/><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\">支付宝系统架构概况</span><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.732\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkRmAluvOybPtWzyu7qLg6ccFsNSdOx0aFib9TM0tIH9pWPZcwxzicDLHQ/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkRmAluvOybPtWzyu7qLg6ccFsNSdOx0aFib9TM0tIH9pWPZcwxzicDLHQ/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> 典型处理默认</span><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.7746666666666666\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkhySdXKNp7rGJpUm7blJOoAkXQuC57riaGkMVSdkgb0ia8H9y6duLDQrg/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkhySdXKNp7rGJpUm7blJOoAkXQuC57riaGkMVSdkgb0ia8H9y6duLDQrg/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> 资金处理平台</span><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.66\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmk1ICibTG0JiceI40BeQpqLVVR7BkeUHRXZPTkseqP2rN43IlnvhWtRWLA/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: 670px ! important; height: auto ! important;\" _width=\"670px\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmk1ICibTG0JiceI40BeQpqLVVR7BkeUHRXZPTkseqP2rN43IlnvhWtRWLA/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><span style=\"max-width: 100%; color: rgb(192, 0, 0); font-size: 24px; box-sizing: border-box !important; word-wrap: break-word !important;\">财务会计</span><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.7266666666666667\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkcT2RG5cicZoxh53z24nJyQvlc9lQMgia7GbQKYia01icsN3Fw93r1EzP8w/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkcT2RG5cicZoxh53z24nJyQvlc9lQMgia7GbQKYia01icsN3Fw93r1EzP8w/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><span style=\"max-width: 100%; font-size: 24px; color: rgb(192, 0, 0); box-sizing: border-box !important; word-wrap: break-word !important;\">支付清算</span><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.7373333333333333\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkvc4DnbZbicpr8HvgoD29wibPa2npDtVKZspJwHcP9MMufPM9JLAknymg/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkvc4DnbZbicpr8HvgoD29wibPa2npDtVKZspJwHcP9MMufPM9JLAknymg/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><span style=\"max-width: 100%; color: rgb(192, 0, 0); font-size: 24px; box-sizing: border-box !important; word-wrap: break-word !important;\">核算中心</span><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.7426666666666667\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkOx7dveBJKZn4XiaGexXZtsDJibwibwosHrTqsZRgu6SiaYHh06TB75ibZ1w/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkOx7dveBJKZn4XiaGexXZtsDJibwibwosHrTqsZRgu6SiaYHh06TB75ibZ1w/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; color: rgb(192, 0, 0); box-sizing: border-box !important; word-wrap: break-word !important;\"> <span style=\"max-width: 100%; font-size: 36px; box-sizing: border-box !important; word-wrap: break-word !important;\">交易</span></span><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.744\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkiazfBLxWibYb6iaKXZ2FEyToGiaXibKr8RpET4iaoBdnyuzDtLJAIR0k8P1w/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkiazfBLxWibYb6iaKXZ2FEyToGiaXibKr8RpET4iaoBdnyuzDtLJAIR0k8P1w/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\">柔性事务</span><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.7546666666666667\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkx7uBOrYDczrICRFQhe7BGGp1ib8m3fKrsNFOoKgzG0NTrXkluUkSbGQ/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: 670px ! important; height: auto ! important;\" _width=\"670px\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkx7uBOrYDczrICRFQhe7BGGp1ib8m3fKrsNFOoKgzG0NTrXkluUkSbGQ/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span><br style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.6613333333333333\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkcBtzic1HKkcOA21XuHC3ZEO8qPWVzsVHJaJxaDV0vLpY6iaSjnjScRBw/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: 670px ! important; height: auto ! important;\" _width=\"670px\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkcBtzic1HKkcOA21XuHC3ZEO8qPWVzsVHJaJxaDV0vLpY6iaSjnjScRBw/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.656\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkQwRibiaBABNRV0iacwZXqCxjNugIw5dlIsSAKVuZZ0hwovpHdjwmAEwIw/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: 670px ! important; height: auto ! important;\" _width=\"670px\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkQwRibiaBABNRV0iacwZXqCxjNugIw5dlIsSAKVuZZ0hwovpHdjwmAEwIw/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.784\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkd3jzsic8laSicJkddp1icIM4xnOia4h9JVjjibUwHL8h2RULTFZdMe2rwEw/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: 670px ! important; height: auto ! important;\" _width=\"670px\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkd3jzsic8laSicJkddp1icIM4xnOia4h9JVjjibUwHL8h2RULTFZdMe2rwEw/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.7093333333333334\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkxp5icM5GwDP71snafLPREl4d8TUJrbrIQIkQdE5xYeUpde1GiahZiaQAA/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: 670px ! important; height: auto ! important;\" _width=\"670px\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkxp5icM5GwDP71snafLPREl4d8TUJrbrIQIkQdE5xYeUpde1GiahZiaQAA/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\"> </span></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.8053333333333333\" data-w=\"750\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkwyiagt7ic5WErpeCObe1wxacVecc9WmOrXUD1xuHchbOI3p8vjIcslKw/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: 670px ! important; height: auto ! important;\" _width=\"670px\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkwyiagt7ic5WErpeCObe1wxacVecc9WmOrXUD1xuHchbOI3p8vjIcslKw/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><hr style=\"max-width: 100%; color: rgb(62, 62, 62); white-space: normal; line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"/><h3 class=\"\" style=\"max-width: 100%; color: rgb(62, 62, 62); white-space: normal; line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><span class=\"\" style=\"max-width: 100%; box-sizing: border-box !important; word-wrap: break-word !important;\">支付宝的开源分布式消息中间件--Metamorphosis(MetaQ)</span></h3><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">Metamorphosis\r\n (MetaQ) \r\n是一个高性能、高可用、可扩展的分布式消息中间件，类似于LinkedIn的Kafka，具有消息存储顺序写、吞吐量大和支持本地和XA事务等特性，适用于大吞吐量、顺序消息、广播和日志数据传输等场景，在淘宝和支付宝有着广泛的应用，现已开源。</p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">Metamorphosis是淘宝开源的一个Java消息中间件。关于消息中间件，你应该听说过JMS规范，以及一些开源实现，如ActiveMQ和HornetQ等。Metamorphosis也是其中之一。</p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">Metamorphosis的起源是我从对linkedin的开源MQ--现在转移到apache的kafka的学习开始的，这是一个设计很独特的MQ系统，它采用pull机制，而不是一般MQ的push模型，它大量利用了zookeeper做服务发现和offset存储，它的设计理念我非常欣赏并赞同，强烈建议你阅读一下它的设计文档，总体上说metamorphosis的设计跟它是完全一致的。但是为什么还需要meta呢？</p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">简单概括下我重新写出meta的原因：</p><ul class=\" list-paddingleft-2\" style=\"max-width: 100%; color: rgb(62, 62, 62); white-space: normal; line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">Kafka是scala写，我对scala不熟悉，并且kafka整个社区的发展太缓慢了。</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">有一些功能是kakfa没有实现，但是我们却需要：事务、多种offset存储、高可用方案(HA)等</p></li></ul><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">Meta相对于kafka特有的一些功能：</p><ul class=\" list-paddingleft-2\" style=\"max-width: 100%; color: rgb(62, 62, 62); white-space: normal; line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">文本协议设计，非常透明，支持类似memcached stats的协议来监控broker</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">纯Java实现，从通讯到存储，从client到server都是重新实现。</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">提供事务支持，包括本地事务和XA分布式事务</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">支持HA复制，包括异步复制和同步复制，保证消息的可靠性</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">支持异步发送消息</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">消费消息失败，支持本地恢复</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">多种offset存储支持，数据库、磁盘、zookeeper，可自定义实现</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">支持group commit，提升数据可靠性和吞吐量。</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">支持消息广播模式</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">一系列配套项目：python客户端、twitter storm的spout、tail4j等。</p></li></ul><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">因此meta相比于kafka的提升是巨大的。meta在淘宝和支付宝都得到了广泛应用，现在每天支付宝每天经由meta路由的消息达到120亿，淘宝也有每天也有上亿的消息量。</p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">Meta适合的应用：</p><ul class=\" list-paddingleft-2\" style=\"max-width: 100%; color: rgb(62, 62, 62); white-space: normal; line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">日志传输，高吞吐量的日志传输本来就是kafka的强项</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">消息广播功能，如广播缓存配置失效。</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">数据的顺序同步功能，如mysql binlog复制</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">分布式环境下（broker,producer,consumer都为集群）的消息路由，对顺序和可靠性有极高要求的场景。</p></li><li><p style=\"max-width: 100%; min-height: 1em; box-sizing: border-box !important; word-wrap: break-word !important;\">作为一般MQ来使用的其他功能</p></li></ul><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\">总体结构：</p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p style=\"max-width: 100%; min-height: 1em; color: rgb(62, 62, 62); line-height: 28.4444px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(255, 255, 255);\"><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.551660516605166\" data-w=\"542\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmk6vMUicb1gNmF9dKj9aUx8yOxgOGnem1xzOEUxUwOibibiaJ3DnbUOKg7YA/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmk6vMUicb1gNmF9dKj9aUx8yOxgOGnem1xzOEUxUwOibibiaJ3DnbUOKg7YA/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/>内部结构：<br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/><br style=\"max-width: 100%; line-height: 28px; box-sizing: border-box !important; word-wrap: break-word !important;\"/></p><p><img class=\"\" data-type=\"jpeg\" data-ratio=\"0.6075268817204301\" data-w=\"558\" data-src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkpMUeXE7M5g6odKGpichq3TmwbuTBVhGkgGJGg4I5mD18Hw8JxyJaLUw/0?\" style=\"margin-right: 10px; line-height: 28px; border: 0px none; box-sizing: border-box ! important; overflow-wrap: break-word ! important; visibility: visible ! important; width: auto ! important; height: auto ! important;\" _width=\"auto\" src=\"http://mmbiz.qpic.cn/mmbiz/No0P3jZ7icByyw34ozH7wPpicSIicicPAvmkpMUeXE7M5g6odKGpichq3TmwbuTBVhGkgGJGg4I5mD18Hw8JxyJaLUw/0?wxfrom=5&wx_lazy=1\" data-fail=\"0\" width=\"auto\"/></p><p><br/></p>', '');
INSERT INTO `os_news_detail` VALUES ('5', '<p style=\"text-align:center\"><strong><span style=\"font-family:宋体\">好的架构</span><span style=\"font-family: 宋体; font-size: 16px;\">化是进化而来的，不是设计出来的</span></strong></p><p style=\"text-align:center\"><span style=\"font-size: 16px;\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;----58</span><span style=\"font-size: 16px; font-family: 宋体;\">沈剑</span></p><p><br/></p><p><strong><span style=\"font-family:宋体\">核心内容</span></strong><span style=\"font-family:宋体\">：</span>58<span style=\"font-family:宋体\">同城流量从小到大过程中，<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">架构是如何演进的？遇到了哪些问题？以及如何解决这些问题？</span></span></p><p><strong style=\"font-size: 16px;\"><span style=\"font-family:宋体\">核心观点</span></strong><span style=\"font-size: 16px; font-family: 宋体;\">：<span style=\"color: rgb(255, 0, 0);\">好的架构不是设计出来的，而是进化而来的</span>。</span><br/></p><p><strong style=\"font-size: 16px;\"><span style=\"font-family:宋体\">如何演进</span></strong><span style=\"font-size: 16px; font-family: 宋体;\">：站点流量在不同阶段，会遇到不同的问题，找到对应阶段站点架构所面临的主要问题，在不断解决这些问题的过程中，整个系统的架构就不断的演进了。</span><br/></p><p><span style=\"font-family:宋体\">如何演进，简言之：<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">找到主要矛盾，并解决主要矛盾</span>。</span></p><p><span style=\"font-family:宋体\"></span></p><hr/><p><strong style=\"font-size: 16px;\"><span style=\"font-family:宋体\">第一章：建站之初</span></strong><br/><span style=\"font-family:宋体\"></span></p><p><span style=\"font-family:宋体\">建站之初，站点流量非常小，可能低于十万级别。这意味着，平均每秒钟也就几次访问。请求量比较低，数据量比较小，代码量也比较小，几个工程师，很短的时间搭起这样的系统，甚至没有考虑“架构”的问题。</span></p><p><br/></p><p><span style=\"font-family:宋体\">和许多创业公司初期一样，最初</span>58<span style=\"font-family:宋体\">同城的站点架构特点是“</span><span style=\"color: rgb(255, 0, 0);\">ALL-IN-ONE</span><span style=\"font-family:宋体\">”：</span></p><p><img data-s=\"300,640\" data-type=\"png\" data-src=\"http://mmbiz.qpic.cn/mmbiz/YrezxckhYOx6nzM4Mqz7w9jNNIyicIaNBhfC1D9bGswyyTU6YDMvtITryl6de4I2Mia4xL9qsowricSRlaQtiawOfw/0?wx_fmt=png\" data-ratio=\"0.6046511627906976\" data-w=\"430\" style=\"width: auto ! important; height: auto ! important; visibility: visible ! important;\" src=\"http://mmbiz.qpic.cn/mmbiz/YrezxckhYOx6nzM4Mqz7w9jNNIyicIaNBhfC1D9bGswyyTU6YDMvtITryl6de4I2Mia4xL9qsowricSRlaQtiawOfw/640?wx_fmt=png&wxfrom=5&wx_lazy=1\" data-fail=\"0\"/><br/><span style=\"font-size: 16px; font-family: 宋体;\">这是一个单机系统，所有的站点、数据库、文件都部署在一台服务器上。工程师每天的核心工作是</span><span style=\"font-size: 16px;\">CURD</span><span style=\"font-size: 16px; font-family: 宋体;\">，浏览器端传过来一些数据，解析</span><span style=\"font-size: 16px;\">GET/POST/COOKIE</span><span style=\"font-size: 16px; font-family: 宋体;\">中传过来的数据，拼装成一些</span><span style=\"font-size: 16px;\">CURD</span><span style=\"font-size: 16px; font-family: 宋体;\">的</span><span style=\"font-size: 16px;\">sql</span><span style=\"font-size: 16px; font-family: 宋体;\">语句访问数据库，数据库返回数据，拼装成页面，返回浏览器。相信很多创业团队的工程师，初期做的也是类似的工作。</span></p><p><br/></p><p>58<span style=\"font-family:宋体\">同城最初选择的是微软技术体系这条路：</span>Windows<span style=\"font-family:宋体\">、</span>iis<span style=\"font-family:宋体\">、</span>SQL-Sever<span style=\"font-family:宋体\">、</span>C#</p><p><span style=\"color: rgb(255, 0, 0);\"><span style=\"font-family: 宋体;\">如果重新再来，我们<span style=\"color: rgb(255, 0, 0); font-family: 宋体;\">可能</span>会选择</span>LAMP体系</span><span style=\"font-family:宋体\">。</span></p><p><br/></p><p><span style=\"font-family:宋体\">为什么选择</span>LAMP<span style=\"font-family:宋体\">？</span></p><p><br/></p><p>LAMP<span style=\"font-family:宋体\">无须编译，<span style=\"font-family: 宋体;\">发布</span>快速，功能强大，社区活跃，从前端+后端+数据库访问+业务逻辑处理全部可以搞定，并且开源免费，公司做大了也不会有人上门收钱（不少公司吃过亏）。</span><span style=\"color: rgb(255, 0, 0);\"><span style=\"font-family: 宋体;\">现在大家如果再创业，强烈建议使用</span>LAMP</span><span style=\"font-family:宋体\">。</span></p><p><span style=\"font-family:宋体\"><br/></span><span style=\"font-size: 16px; font-family: 宋体;\">初创阶段，工程师面临的<strong>主要问题</strong>：</span><span style=\"font-size: 16px; color: rgb(255, 0, 0);\"><span style=\"font-size: 16px; font-family: 宋体;\">写</span><span style=\"font-size: 16px;\">CURD</span><span style=\"font-size: 16px; font-family: 宋体;\">的</span><span style=\"font-size: 16px;\">sql</span><span style=\"font-size: 16px; font-family: 宋体;\">语句很容易出错</span></span><span style=\"font-size: 16px; font-family: 宋体;\">。</span></p><p><span style=\"font-family:宋体\">我们在这个阶段</span><strong><span style=\"font-family:宋体\">引进</span>DAO<span style=\"font-family:宋体\">和</span>ORM，</strong><span style=\"font-family:宋体\">让工程师们不再直接面对</span>CURD<span style=\"font-family:宋体\">的</span>sql<span style=\"font-family:宋体\">语句，而是面对他们比较擅长的面向对象开发，极大的提高了编码效率，降低了出错率。</span></p><p><span style=\"font-family:宋体\"></span></p><hr/><p><strong style=\"font-size: 16px;\"><span style=\"font-family:宋体\">第二章：流量增加，数据库成为瓶颈</span></strong><br/><span style=\"font-family:宋体\"></span></p><p><span style=\"font-family:宋体\">随着流量越来越大，老板不只要求“有一个可以看见的站点”，他希望网站能够正常访问，当然速度快点就更好了。</span></p><p><span style=\"font-family:宋体\">而此时系统面临问题是：流量的高峰期容易宕机，大量的请求会压到数据库上，<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">数据库成为新的瓶颈</span>，人多并行访问时站点非常卡。这时，我们的机器数量也从一台变成了多台，我们的系统成了所谓的（伪）“<strong>分布式架构</strong>”：</span></p><p><span style=\"font-family:宋体\"><br/></span><span style=\"font-family: 宋体; font-size: 16px;\">我们使用了一些常见优化手段：</span></p><p><span style=\"font-family:宋体\">（</span>1<span style=\"font-family:宋体\">）<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">动静分离</span>，动态的页面通过</span>Web-Server<span style=\"font-family:宋体\">访问，静态的文件例如图片就放到<span style=\"font-family: 宋体;\">单独的</span>文件服务器上；</span></p><p><span style=\"font-family:宋体\">（</span>2<span style=\"font-family:宋体\">）<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">读写分离</span>，将落到数据库上的读写请求分派到不同的数据库服务器上；</span></p><p><span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">互联网绝大部分的业务场景，都是读多写少</span><span style=\"font-family:宋体\">。对</span>58<span style=\"font-family:宋体\">同城来说，绝大部分用户的需求是访问信息，搜索信息，只有少数的用户发贴。此时读取性能容易成为瓶颈，那么<strong>如何扩展整个站点架构的读性能呢？常用的方法是主从同步，增加从库。</strong>我们原来只有一个读数据库，现在有多个读数据库，就提高了读性能。</span></p><p><br/></p><p><span style=\"font-family:宋体\">在这个阶段，系统的</span><strong><span style=\"font-family:宋体\">主要矛盾为“站点耦合</span>+<span style=\"font-family:宋体\">读写延时”</span></strong><span style=\"font-family:宋体\">，</span>58<span style=\"font-family:宋体\">同城是如何解决这两个问题的呢？</span></p><p><br/></p><p><span style=\"font-family:宋体\">第一个问题是<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">站点耦合</span>。对</span>58<span style=\"font-family:宋体\">同城而言，典型业务场景是：</span><span style=\"font-family: 宋体; font-size: 16px;\">类别聚合的主页，发布信息的发布页，信息聚合的列表页，帖子内容的详细页，原来这些系统都耦合在一个站点中，出现问题的时候，整个系统都会受到影响。</span></p><p><br/></p><p><span style=\"font-family:宋体\">第二个问题是<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">读写延时</span>。数据库做了主从同步和读写分离之后，读写库之间数据的同步有一个延时，数据库数据量越大，从库越多时，延时越明显。对应到业务，有用户发帖子，马上去搜索可能<span style=\"font-family: 宋体;\">搜索</span>不到（着急的用户会再次发布相同的帖子）。</span></p><p><span style=\"font-size: 16px; font-family: 宋体;\"><br/></span></p><p><span style=\"font-size: 16px; font-family: 宋体;\">要解决耦合的问题，最先想到的是<span style=\"font-size: 16px; font-family: 宋体; color: rgb(255, 0, 0);\">针对核心业务做切分</span>，工程师根据业务切分对系统也进行切分：我们将业务垂直拆分成了<strong>首页、发布页、列表页和详情页</strong>。</span></p><p><span style=\"font-family:宋体\">另外，我们在<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">数据库层面也进行了垂直拆分</span>，将单库数据量降下来，让读写延时得到缓解。</span></p><p><br/><span style=\"font-family: 宋体; font-size: 16px;\">同时，还使用了这些技术来优化系统和提高研发效率：</span></p><p><span style=\"font-family:宋体\">（</span>1<span style=\"font-family:宋体\">）对<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">动态资源和静态资源进行拆分</span>。对静态资源我们使用了</span><span style=\"color: rgb(255, 0, 0);\">CDN</span><span style=\"font-family:宋体\">服务，用户就近访问，静态资源的访问速度得到很明显的提升；</span></p><p><span style=\"font-family:宋体\">（</span>2<span style=\"font-family:宋体\">）除此之外，我们还使用了</span><span style=\"color: rgb(255, 0, 0);\">MVC<span style=\"font-family: 宋体;\">模式</span></span><span style=\"font-family:宋体\">，擅长前端的工程师去做展示层，擅长业务逻辑的工程师就做控制层，擅长数据的工程师就做数据层，专人专用，研发效率和质量又进一步提高。</span></p><p><span style=\"font-family:宋体\"></span></p><hr/><p><strong style=\"font-size: 16px;\"><span style=\"font-family:宋体\">第三章：全面转型开源技术体系</span></strong><br/><span style=\"font-family:宋体\"></span></p><p><span style=\"font-family:宋体\">流量越来越大，当流量达到百万甚至千万时，站点面临一个很大的问题就是<strong>性能和成本的折衷</strong>。上文提到</span>58<span style=\"font-family:宋体\">同城最初的技术选型是</span>Windows<span style=\"font-family:宋体\">，我们在这个阶段做了一次脱胎换骨的技术转型，<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">全面转向开源技</span>术：</span></p><p><span style=\"font-family:宋体\">（</span>1<span style=\"font-family:宋体\">）操作系统转型</span>Linux</p><p><span style=\"font-family:宋体\">（</span>2<span style=\"font-family:宋体\">）数据库转型</span>Mysql</p><p><span style=\"font-family:宋体\">（</span>3<span style=\"font-family:宋体\">）</span>web<span style=\"font-family:宋体\">服务器转型</span>Tomcat</p><p><span style=\"font-family:宋体\">（</span>4<span style=\"font-family:宋体\">）开发语言转向了</span>Java</p><p><span style=\"font-family: 宋体; font-size: 16px;\">其实，很多互联网公司在流量从小到大的过程中都经历过类似的转型，例如京东和淘宝。</span></p><p><br/></p><p><span style=\"font-family:宋体\">随着用户量的增加，对站点<strong>可用性要求也越来越高</strong>，机器数也从最开始的几台上升到几百台。那么如何提供保证整个系统的可用性呢？首先，我们在业务层做了<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">进一步的垂直拆分</span>，同时</span><span style=\"color: rgb(255, 0, 0);\"><span style=\"font-family: 宋体;\">引入了</span>Cache</span><span style=\"font-family:宋体\">，如下图所示：</span></p><p><br/><span style=\"font-size: 16px; font-family: 宋体;\">在架构上，我们<span style=\"font-size: 16px; font-family: 宋体; color: rgb(255, 0, 0);\">抽象了一个相对独立的服务层</span>，所有数据的访问都通过这个服务层统一来管理，上游业务线就像调用本地函数一样，通过</span><span style=\"font-size: 16px;\">RPC</span><span style=\"font-size: 16px; font-family: 宋体;\">的框架来调用这个服务获取数据，服务层对上游屏蔽底层数据库与缓存的复杂性。</span></p><p><br/><span style=\"font-family: 宋体; font-size: 16px;\">除此之外，为了保证站点的高可用，我们使用了<span style=\"font-family: 宋体; font-size: 16px; color: rgb(255, 0, 0);\">反向代理</span>。</span></p><p><strong><span style=\"font-family:宋体\">什么是代理？</span></strong><span style=\"font-family:宋体\">代理就是代表用户访问</span>xxoo<span style=\"font-family:宋体\">站点。</span></p><p><strong><span style=\"font-family:宋体\">什么是反向代理？</span></strong><span style=\"font-family:宋体\">反向代理代表的是</span>58<span style=\"font-family:宋体\">网站，用户不用关注访问是</span>58<span style=\"font-family:宋体\">同城的哪台服务器，由反向代理来代表</span>58<span style=\"font-family:宋体\">同城。</span>58<span style=\"font-family:宋体\">同城通过反向代理，</span>DNS<span style=\"font-family:宋体\">轮询，</span> LVS<span style=\"font-family:宋体\">等技术，来保证接入层的高可用性。</span></p><p><span style=\"font-family:宋体\">另外，为了<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">保证服务层和数据层的高可用，我们采用了冗余的方法</span>，单点服务不可用，我们就冗余服务，单点数据不可用，我们就冗余数据。</span></p><p><br/></p><p><span style=\"font-family:宋体\">这个阶段</span>58<span style=\"font-family:宋体\">同城进入了一个<strong>业务高速爆发期</strong>，短期内衍生出非常多的业务站点和服务。新增站点、新增服务每次都会做一些重复的事情，例如线程模型，消息队列，参数解析等等，于是，</span>58<span style=\"font-family:宋体\">同城就<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">研发了自己的站点框架和服务框架</span>，现在这两个框架也都已经开源：</span></p><p>（1<span style=\"font-family:宋体\">）站点框架</span>Argo<span style=\"font-family:宋体\">：</span>https://github.com/58code/Argo</p><p>（2<span style=\"font-family:宋体\">）服务框架</span>Gaea<span style=\"font-family:宋体\">：</span>https://github.com/58code/Gaea</p><p><br/></p><p><span style=\"font-family:宋体\">这个阶段，为了进一步解耦系统，我们引入了<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">配置中心、柔性服务和消息总线</span>。</span></p><p><br/><span style=\"font-size: 16px; font-family: 宋体;\">引入<strong>配置中心</strong>，业务要访问任何一个服务，不需要在本地的配置文件中配置服务的</span><span style=\"font-size: 16px;\">ip list</span><span style=\"font-size: 16px; font-family: 宋体;\">，而只需要访问配置中心。这种方式的扩展性非常好，如果有机器要下线，配置中心会反向通知上游订阅方，而不需要更新本地配置文件。</span></p><p><br/></p><p><strong><span style=\"font-family:宋体\">柔性服务</span></strong><span style=\"font-family:宋体\">是指当流量增加的时候，自动的扩展服务和站点。</span></p><p><br/></p><p><strong><span style=\"font-family:宋体\">消息总线</span></strong><span style=\"font-family:宋体\">也是一种解耦上下游“调用”关系常见的技术手段。</span></p><p><br/></p><p><span style=\"font-family:宋体\">机器越来越多，此时很多系统层面的问题，靠“人肉”已经很难搞定，于是<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">自动化</span>变得越来越重要：自动化回归、自动化测试、自动化运维、自动化监控等等等等。</span></p><p><br/></p><p><span style=\"font-family:宋体\">最后补充一点，<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">这个阶段我们引入了不少智能化产品</span>，比如智能推荐，主动推荐一些相关的数据，以增加</span>58<span style=\"font-family:宋体\">同城的</span>PV<span style=\"font-family:宋体\">；智能广告，通过一些智能的策略，让用户对广告的点击更多，增加同城的收入；智能搜索，在搜索的过程中加入一些智能的策略，提高用户的点击率，以增加</span>58<span style=\"font-family:宋体\">同城的</span>PV<span style=\"font-family:宋体\">。这些智能化产品的背后都由技术驱动。</span></p><p><span style=\"font-family:宋体\"></span></p><hr/><p><strong style=\"font-size: 16px;\"><span style=\"font-family:宋体\">第四章、进一步的挑战</span></strong><br/><span style=\"font-family:宋体\"></span></p><p><span style=\"font-family:宋体\">现在，</span>58<span style=\"font-family:宋体\">同城的流量已经达到</span>10<span style=\"font-family:宋体\">亿的量级，架构上我们规划做一些什么样的事情呢，几个方向：</span></p><p><span style=\"font-family:宋体\">（</span>1<span style=\"font-family:宋体\">）业务服务化</span></p><p><span style=\"font-family:宋体\">（</span>2<span style=\"font-family:宋体\">）多架构模式</span></p><p><span style=\"font-family:宋体\">（</span>3<span style=\"font-family:宋体\">）平台化</span></p><p><span style=\"font-family:宋体\">（4）...</span></p><p><img data-s=\"300,640\" data-type=\"png\" data-src=\"http://mmbiz.qpic.cn/mmbiz/YrezxckhYOx6nzM4Mqz7w9jNNIyicIaNBn2uX9FFOVLwHRqbCjiay97TFCicM2O7NuvLfGyhPGTbFEvlfgx4MHtHg/0?wx_fmt=png\" data-ratio=\"0.7137176938369781\" data-w=\"\" style=\"width: auto ! important; height: auto ! important; visibility: visible ! important;\" src=\"http://mmbiz.qpic.cn/mmbiz/YrezxckhYOx6nzM4Mqz7w9jNNIyicIaNBn2uX9FFOVLwHRqbCjiay97TFCicM2O7NuvLfGyhPGTbFEvlfgx4MHtHg/640?wx_fmt=png&wxfrom=5&wx_lazy=1\" data-fail=\"0\"/><br/><span style=\"font-size: 16px;\"> </span></p><hr/><p><strong><span style=\"font-family:宋体\">第五章：小结</span></strong></p><p><span style=\"font-family:宋体\">最后做一个简单的总结，网站在不同的阶段遇到的问题不一样，而解决这些问题使用的技术也不一样：</span></p><p><span style=\"font-family:宋体\">（</span>1<span style=\"font-family:宋体\">）<strong>流量小</strong>的时候，我们要提高开发效率，可以在早期要引入</span><span style=\"color: rgb(255, 0, 0);\">ORM<span style=\"font-family: 宋体;\">，</span>DAO</span><span style=\"font-family:宋体\">；</span></p><p><span style=\"font-family:宋体\">（</span>2<span style=\"font-family:宋体\">）<strong>流量变大</strong>，可以使用</span><span style=\"color: rgb(255, 0, 0);\"><span style=\"font-family: 宋体;\">动静分离、读写分离、主从同步、垂直拆分、</span>CDN<span style=\"font-family: 宋体;\">、</span>MVC</span><span style=\"font-family:宋体\">等方式不断提升网站的性能和研发效率；</span></p><p><span style=\"font-family:宋体\">（</span>3<span style=\"font-family:宋体\">）面对<strong>更大的流量</strong>时，通过<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">垂直拆分、服务化、反向代理、开发框架</span>（站点</span>/<span style=\"font-family:宋体\">服务）等等手段，可以不断提升高可用（研发效率）；</span></p><p><span style=\"font-family:宋体\">（</span>4<span style=\"font-family:宋体\">）在面对<strong>上亿级的流量</strong>时，通过<span style=\"font-family: 宋体; color: rgb(255, 0, 0);\">配置中心、柔性服务、消息总线、自动化（回归，测试，运维，监控）来迎接新的挑战</span>；</span></p><p><br/></p>', '');
INSERT INTO `os_news_detail` VALUES ('7', '<p style=\"word-wrap: break-word; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; margin-top: 0px !important; background-color: rgb(255, 255, 255);\">在 2017 年做 PHP 开发是一种什么样的体验？</p><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">嘿，我*近接到一个网站开发的项目，不过老实说，我这两年没怎么接触编程，听说 Web 技术已经发生了一些变化。听说你是这里对新技术*了解的开发工程师？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">你算是找对人了。我对今年的技术别提多熟了， VR 、机器学习、守望先锋……你尽管问吧。我刚去了几个热门的技术大会逛了一圈，没有什么新技术是我不知道的。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">厉害。是这样的，我要开发一个网站，用来展示用户的*新动态。我想我应该通过后端接口获取数据，然后用一个 table 来展示数据，用户可以对数据进行排序。如果服务器上的数据变化了，我还需要更新这个 table 。我的思路是用 jQuery 来做。</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">可别用 jQuery ！现在哪还有人用 jQuery 。现在是 2016 年了，你绝对应该用 React 。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">等等，这句话之前已经有一位前端大神和我说过了，我今天主要是想问你后端该怎么做。</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">哦原来是这样，你提到了 Smarty ？你后端语言是 PHP 对吧，现在哪还有人用 Smarty 。现在是 2016 年了，你绝对应该用 Twig 。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">Twig ？也是一个模板引擎吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">是的，但是 Twig 的语法更加优雅，使用更方便，速度也快，而且许多开发框架都支持把 Twig 作为模板引擎，和框架的整合也做得更好。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">好吧那我用 Twig ，请问在哪里下载？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">你不用自己下载安装，只需要在你项目的 composer.json 文件中添加一个依赖，然后 Composer 会帮你安装。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">等等， Composer 是什么？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">Composer 是一个以 PSR-4 标准进行自动化包管理的工具，用它可以方便的进行各种第三方软件的依赖管理和下载、更新等操作</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">PSR-4 ?</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">对， PSR-4 是 PHP-FIG 组织提出的多个为了统一项目规范的标准之一，是用来规范 PHP 项目的 Namespace 、目录结构、加载规范的。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">那除了 PSR-4 之外还有什么？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">还有用来规定代码风格的 PSR-1 ，以及 PSR-1 的扩展版本 PSR-2 ，还有用来规定日志的 PSR-3 ，用来规定缓存的 PSR-6 ，用来规定 HTTP 头消息的 PSR-7 ，以及……</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">等等，怎么没有 PSR-5 ？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">有的，但 PSR-5 还处在草稿阶段，没有正式发布，所以我没有讲给你听。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">有 PSR-8 吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">有的，现在一共是到 PSR-0 到 PSR-17 ，但我没提到的那些大部分都在草稿阶段，所以同上，我没有讲给你听。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">好吧好吧，我用 Composer 行了吧。</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">等等，在你用之前，我建议先配置一个镜像，因为 Composer 的服务器在国外，直接使用经常会出现问题，对了如果你的项目比较大的话，可能第一次使用要 FQ 才能使用。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">为什么？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">因为虽然软件的版本信息是存在 Composer 的服务器上的，但有大部分软件的 zip 文件是存放在 github 或者别的什么地方的。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">好吧这些我都搞定了，我想开始写代码了，听说 Zend Framework 挺有名的？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">现在是 2016 年了，没人再用 ZF 了。现在比较流行的 PHP 框架有 Symfony 、 Laravel 、 YII 、 Codeigniter 这些，如果你对性能要求比较高或者想开发一些 Socket 相关的功能的话，可以试试看 Phalcon 、 Yaf 、 Swoole 、 Workerman 、 ReactPHP 这些，对了*近还有个叫 Kraken 的框架在 Github 上比较火，但我还没有试过。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">有没有国内用的比较广泛的框架？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">ThinkPHP 刚刚推出了支持 Composer 的 5.0 版本，但我建议你再观望一下再决定是否用。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">我以前听说*新版本是 3 ，怎么现在是 5 了，请问 ThinkPHP 4 去哪里了？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">这个套路你还不明白吗？请问你用过 Java 2/3/4 或者 Windows9 吗？</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">好吧，确实没用过，不过我懂你的意思了。我可以开始写代码了吧？ Editplus 我早就装好了</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">可别用 Editplus ！现在哪还有人用 Editplus 。现在是 2016 年了，你绝对应该用 PHPStorm ，非常好用，同类的还有 NetBeans 、 Zend Studio 但现在已经没什么人用了，如果你喜欢简单一些的工具，可以用 Sublime 、 Atom ，或者像我们公司的程序员 MM 一样直接用 VIM 。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">程序员 MM ？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">是的，对了我们公司在漕河泾，有兴趣可以投个简历给我 hongt@xieche.net ，有机会在面试时和程序员 MM 直接交流。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">好吧好吧…随便问问，反正我有女朋友。对了请问代码该怎么调试呢？我以前用 Editplus 的时候都是在代码里写 var_dump 和 die 的。</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">现在哪还有人 var_dump() + die()。现在是 2016 年了，你绝对应该用 Ladybug 。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">Ladybug?</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">对，类似 var_dump + die ，但是更加好用，能够把要 dump 对象里的内容展示的清清楚楚，配合 Xdebug 你甚至可以在 IDE 里进行断点调试、临时更改变量的值等等</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">Xdebug?</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">是的，一个 PHP 的调试工具，安装之后可以像调试 Java 、 C 那样调试 PHP 。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">看起来好高级的样子，但我程序还没开始写呢，我听人说写代码第一步是要建数据库？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">没错，但现在已经是 2016 年了，没有人直接用客户端连上数据库去建表了，大家都在用 ORM 工具管理数据库。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">什么是 ORM ？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">ORM 可以让你像操作类一样去操作一个数据库，知名的 ORM 工具有： Doctrine 、 Propel 、 Eloquent 这些。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">难道我不能直接写 SQL 吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">可以当然是可以的，但现在是 2016 年了，没人直接写 SQL 了。而且如果直接写 SQL 的话，安全性怎么办？如果字段做了变更怎么更新所有现存的 SQL ？代码的部署回滚怎么和数据库绑定？而且用了 ORM 之后你可以很简单的就创建出一个表的 CRUD 表单，甚至可以很简单的写几行代码就实现对这个表的各种 API 操作。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">听上去很不错啊，能举个例子吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">比如我*常用的 Doctrine ，只要我用 PHP 类去定义一个表的实体结构（ Entity ），我就可以让 Doctrine 自动生成这个表的 DDL ，即使我的表结构有变更， Doctrine 也会帮我生成所对应的 update 表结构的 DDL 。 Entity 在每个字段上都可以进行设置，设置完我就可以生成一个对这个表进行操作的 CRUD 表单，假设某个字段我设置的是日期类型，这个字段在 HTML 里就会被自动生成并映射成为一个包含三个下拉框的组件，而这三个下拉框分别是年月日。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">好酷炫，那还有别的用处吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">多了去了，每个网站都有后台吧，使用了 Doctrine 的话配合一些工具，只要写几行代码就可以生成基于表的后台管理界面，实现一个基本可用的网站后台。但需要注意 Doctrine 一般是以 Service 的方式被用在项目中的，你直接用 Doctrine 并不会很方便。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">Service ？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">是的，你可以理解为一系列的你代码中可能会用到的第三方应用，他们都通过 Service 的方式被注册到程序中，你在用到某个功能的时候，只需要对他们进行调用即可，就像调用一个函数那么简单。 Service 一般都会支持 IoC 和 DI ，所以对你将来程序的升级也会很有帮助。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">IoC 和 DI ？这不是 JavaEE 里面经常用到的东西吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">没错，但 PHP 项目中现在也在大量使用 IoC 和 DI ，比如 Symfony 和 Laravel 中就都有非常强大的一套 Service 系统，实现了 IoC 和 DI 。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">好吧不明觉厉，但是我的开发环境还没有呢，是不是先装一个 XAMPP 吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">现在是 2016 年了，没人还在用 XAMPP 了。你至少得用个 Vagrant 或者 Docker 吧？不然你的代码准备怎么部署？开发环境和生成环境怎么保证统一？难道你准备直接用 FTP 传源代码文件吗？</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">er ……是的，难道不应该用 FTP 传代码吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">现在是 2016 年了，没人还在用 FTP 直接传代码了，*差你也得用个 rsync 吧？你可能没有 Vagrant 或者 Docker ，但至少应该尝试用一个部署工具并配置一套部署脚本，比如 Deployer 、 Capistrano 、 Ansible 、 Fabric 等等，如果配合 CI ，自动检查代码、部署那就更完美了。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">CI ？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">对， Continuous Integration ，指的是自动化处理分支的合并、运行测试用例、代码检查、部署等操作，你可以用 Jenkins 自己搭一个，也可以用 Bamboo 或者&nbsp;<a href=\"http://circleci.com/\" rel=\"nofollow\" style=\"word-wrap: break-word; color: rgb(119, 128, 135); text-decoration: none; outline: none medium; transition-property: color; transition-duration: 0.3s; transition-timing-function: ease; word-break: break-all;\">CircleCI.com</a>&nbsp;。为了及时知道代码的 CI 结果，你可以把你的 CI 系统和 Slack 、零信等 IM 工具做整合，这样的话你就可以灵活的在团队里分享并自动化处理各种信息。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">能举个例子吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">比如代码如果在线上出了错，系统可以自动定位到某一次提交，并且发送邮件给改动人。比如服务器负载高了可以自动水平扩展服务器架构。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">水平扩展服务器架构？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">水平扩展的意思就是服务器配置不变，但是数量增多，相对应的垂直扩展就是服务器的性能变高，但是数量不变。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">那具体是怎么做到的呢？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">首先你的程序架构要支持水平扩展，比如 session 和数据库不能存放在单机上，当然还有一些复杂的注意事项暂且不提。其次是你的服务器架构要支持水平扩展，如果你用的是云服务，一般都会有水平扩展的 API ，直接调用就是了。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">听起来好复杂，我的网站暂时应该不会有流量问题，但如果程序出现问题怎么办，有什么办法能及时通知到我吗？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">现在是 2016 年了。一般的做法是搭建一套 ELK 系统进行日志的存储、搜索、展示。</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">ELK ？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">对，就是 Elasticsearch 、 Logstash 和 Kibana 三个软件的缩写，因为大家都经常固定用这三个组合，所以缩写成了 ELK 。当然如果你不想那么麻烦，可以用 Sentry ，或者再简单点自己搭建一个&nbsp;<a href=\"http://log.io/\" rel=\"nofollow\" style=\"word-wrap: break-word; color: rgb(119, 128, 135); text-decoration: none; outline: none medium; transition-property: color; transition-duration: 0.3s; transition-timing-function: ease; word-break: break-all;\">Log.io</a></p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">你别扯远，我就想简简单单跑一个 PHP 的运行环境，听说 Facebook 公司曾经出了个叫什么 HipHop for PHP 的东西？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">没想到你还懂得挺多， HipHop 是 Facebook 出的一款用来加速 PHP 运行的软件，核心原理是把 PHP 代码编译成为一个可以直接执行的程序。而且现在已经是 2016 年了，没人再用 HipHop 了。现在至少你得用 HHVM ，或者 PHP7</p></blockquote><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">HHVM ？</p><blockquote style=\"word-wrap: break-word; padding: 0px; margin: 0px; color: rgb(102, 102, 102); font-size: 16px; white-space: normal; font-family: &quot;Helvetica Neue&quot;, &quot;Luxi Sans&quot;, &quot;DejaVu Sans&quot;, Tahoma, &quot;Hiragino Sans GB&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\"><p style=\"word-wrap: break-word; margin-top: 0px; margin-bottom: 20px; padding: 0px; color: rgb(51, 51, 51);\">是的 HHVM ，因为 HipHop 需要编译才能用，每次 PHP 代码改动都需要重新编译，非常麻烦，所以 Facebook 转而做了 HHVM 。核心原理差不多，但 HHVM 不再需要编译过程，可以直接执行 PHP 文件了，基本上你可以理解为 HHVM 是一个超级加速版的 PHP</p></blockquote><p><br/></p>', '');

-- ----------------------------
-- Table structure for os_picture
-- ----------------------------
DROP TABLE IF EXISTS `os_picture`;
CREATE TABLE `os_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `type` varchar(50) NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_picture
-- ----------------------------
INSERT INTO `os_picture` VALUES ('1', 'local', '/Uploads/Picture/2016-11-07/58209dc893023.png', '', '20a225d981d18b240d6fc78e98372e2d', 'c8a8278e2a120e1a919f4396492ab03611c48a91', '1', '1478532551');
INSERT INTO `os_picture` VALUES ('2', 'local', '/Uploads/Picture/2016-11-07/58209e1ef2f16.png', '', '6a1551f890fa3598a6e63f94c8bd0614', '8269f035ad159fc9af70fa5f1885b48fe47dc0af', '1', '1478532638');
INSERT INTO `os_picture` VALUES ('3', 'local', '/Uploads/Picture/2016-11-07/58209f20b037d.png', '', '885ee65a4b0dc70a5076bc82d4decfb1', '6a2cb0159229be7fcc80446bec054041e3215d24', '1', '1478532894');
INSERT INTO `os_picture` VALUES ('4', 'local', '/Uploads/Picture/2016-11-07/58209fb2f2da3.png', '', '88870c307cf8a409f8d497a78bb34d04', 'ccae2518df9c90e34f2276212aaaf6c24dce6a21', '1', '1478533041');
INSERT INTO `os_picture` VALUES ('5', 'local', '/Uploads/Picture/2016-12-01/583f965ab4662.jpg', '', 'e52402a81353cbf86dedcc582b980028', '3c68b357414051d0a18f4ce8e92619c0e1f05ece', '1', '1480562266');
INSERT INTO `os_picture` VALUES ('6', 'local', '/Uploads/Picture/2016-12-01/583f99ab55af4.png', '', '96c83c9b84902216808f43357d6e4aa5', '6a843422115b61fb0d47262a23e524742fd3d79b', '1', '1480563114');
INSERT INTO `os_picture` VALUES ('7', 'local', '/Uploads/Picture/2016-12-05/58456f9917653.png', '', '51cf18ebd54579907cec2b6e99715886', 'b4551325effd3835052e5aa4978828e1715a6343', '1', '1480945560');
INSERT INTO `os_picture` VALUES ('8', 'local', '/Uploads/Picture/2016-12-28/5863bff31ddcf.jpg', '', 'fe553be9e707064af603ef323ea1afd7', '38fbdd5be5656f22a0f55231c5a025ba5cfb6991', '1', '1482932207');
INSERT INTO `os_picture` VALUES ('9', 'local', '/Uploads/Picture/2016-12-28/5863c07b747c7.png', '', '52ea531197467eb1a95ec15545772e20', '6f20b8a6bc291194f1e36b4a83ecfcfe64150d14', '1', '1482932341');
INSERT INTO `os_picture` VALUES ('10', 'local', '/Uploads/Picture/2016-12-28/5863cd4aa71ce.jpg', '', '9750a5f1e9013f97bb25efad56d0ab47', 'e86fed2f7333f7d9c21fce2e5854113fa7b86278', '1', '1482935621');
INSERT INTO `os_picture` VALUES ('11', 'local', '/Uploads/Picture/2017-01-02/586a52a7c1d9f.jpg', '', 'a04ae4b247699e82d8d299e194142a03', 'c3d4614248826e620fa679c7728ba11db81bbf0a', '1', '1483362982');
INSERT INTO `os_picture` VALUES ('12', 'local', '/Uploads/Picture/2017-01-13/5878e80ca4e0d.jpg', '', 'f6c65af9b9abe56f080c886557564d15', 'c505b46fd0177b688351e69d7ff96500ccabeb09', '1', '1484318731');
INSERT INTO `os_picture` VALUES ('13', 'local', '/Uploads/Picture/2017-02-14/58a29f553f6a0.png', '', 'cfeacf97890e83177ad8d665d5895be9', 'e8c0a83a515aaf8ada952054b4d86fdf61173760', '1', '1487052629');
INSERT INTO `os_picture` VALUES ('14', 'local', '/Uploads/Picture/2017-02-21/58abc98700566.png', '', '1d500d036115ef21c0faaf5e05ae4981', '9fb79c175101bd96d4798b35d8318a183bfaff58', '1', '1487653254');
INSERT INTO `os_picture` VALUES ('15', 'local', '/Uploads/Picture/2017-02-23/58aef03624f5d.jpg', '', 'd633522d968b3045cd91ff38efd284ba', 'cf74c7492a456ba5684fd06a3726d4e4f047bf45', '1', '1487859765');
INSERT INTO `os_picture` VALUES ('16', 'local', '/Uploads/Picture/2017-02-23/58aef07ef1db3.png', '', '9ead00e11ce4c1603c5a3249475fd93c', 'e6613fe6b92998d437e1cf0cce5da6574e6f529f', '1', '1487859837');
INSERT INTO `os_picture` VALUES ('17', 'local', '/Uploads/Picture/2017-02-23/58aef14433019.jpeg', '', 'e287bf2745596b79d1a3d712e4f49657', '2c14c8b3c440c07112e6b0fd40589f628089faa4', '1', '1487860035');
INSERT INTO `os_picture` VALUES ('18', 'local', '/Uploads/Picture/2017-02-25/58b0fad6d6821.jpg', '', '1313ecdda4c2803b33e3b9b064347b14', '17f2be9ea31fef20acc3f3748c2b98bf2d8eb9b2', '1', '1487993558');
INSERT INTO `os_picture` VALUES ('19', 'local', '/Uploads/Picture/2017-02-25/58b0fb2a7efcb.jpg', '', 'eefcfea5edbd38116b88987f62eeb54f', 'a264fc7c47b778c5d2c8b2ae6be56dd82abe9ae6', '1', '1487993642');
INSERT INTO `os_picture` VALUES ('20', 'local', '/Uploads/Picture/2017-02-25/58b0fb4955a08.jpg', '', '4b6db9e67ed81b9fdd1b2a2324d8db05', 'e45532df702d97c7d953a50b7f2983bf53290b38', '1', '1487993672');
INSERT INTO `os_picture` VALUES ('21', 'local', '/Uploads/Picture/2017-02-26/58b27c17c4db9.jpg', '', 'a795bcb501ddf9cd497d2e76b774c369', '2379f94f7de29c4cdb61f40581d916a7969222ff', '1', '1488092183');
INSERT INTO `os_picture` VALUES ('22', 'local', '/Uploads/Picture/2017-02-26/58b28890b1ac5.jpg', '', '5e442b196f332fc6c2e782bb0070a5a5', '21c7096e1a403cf325f9389129742e69b231d232', '1', '1488095376');
INSERT INTO `os_picture` VALUES ('23', 'local', '/Uploads/Picture/2017-02-27/58b39090724ec.png', '', 'e4454821e8df69152e7910f61c2a0f52', '6143013fe7ef748911ddc6fd04b5e3245caae479', '1', '1488162960');
INSERT INTO `os_picture` VALUES ('24', 'local', '/Uploads/Picture/2017-02-27/58b3a8522fb7c.png', '', '7f3a8dc033b45c8d6bced5f8b60476ca', 'a74b730ca321cf34197ad27d6fefb5872938f4f2', '1', '1488169042');
INSERT INTO `os_picture` VALUES ('25', 'local', '/Uploads/Picture/2017-02-27/58b3a9daaf265.jpg', '', '505ee09ceee9f064250b359121a8b653', '5d033616420f117b072a1772d9bd1da6d50cf099', '1', '1488169434');
INSERT INTO `os_picture` VALUES ('26', 'local', '/Uploads/Picture/2017-02-27/58b3abd3e3df3.png', '', 'fcd9448ecfec018ccdb375d3cabd9165', '134ef475a3a25067dd272cbea3b035580f9af71f', '1', '1488169939');
INSERT INTO `os_picture` VALUES ('27', 'local', '/Uploads/Picture/2017-02-27/58b3ac7b15d63.jpg', '', '29c38320851a32184ea33102abfd9fc7', '02af8e54339936b5f7f0c31a9b96d594bd1a3799', '1', '1488170106');
INSERT INTO `os_picture` VALUES ('28', 'local', '/Uploads/Picture/2017-02-27/58b3acfd06aba.jpeg', '', '0590815af7b3c46e416dfc929095bd87', '4af3c4c11bfd146af2c97a689e390b3901ba0179', '1', '1488170236');
INSERT INTO `os_picture` VALUES ('29', 'local', '/Uploads/Picture/2017-02-27/58b3adcd416d6.png', '', '2034dadc8fba7f18b6233eab36298f16', 'f259d2bc7988799040dda74d1e702f2e6b09e238', '1', '1488170445');
INSERT INTO `os_picture` VALUES ('30', 'local', '/Uploads/Picture/2017-02-27/58b3b3da55534.jpg', '', 'f9aa6bb51647c318d578c9b195aaac70', 'fee53562149686beaf459fa7193896445628476b', '1', '1488171994');
INSERT INTO `os_picture` VALUES ('31', 'local', '/Uploads/Picture/2017-02-27/58b3b57d57efa.jpg', '', 'a247d7a8ee47dedd5b5b5e62cdc0d590', 'a9f4df3e1807154aeb5384d5d9914948ec1cb566', '1', '1488172413');
INSERT INTO `os_picture` VALUES ('32', 'local', '/Uploads/Picture/2017-02-27/58b3b668c811e.jpg', '', 'e5a94bdf6fde610f632134523db1dd9b', '602a49d7de295a28a0d23def0f47fe13616daafe', '1', '1488172648');
INSERT INTO `os_picture` VALUES ('33', 'local', '/Uploads/Picture/2017-03-03/58b8e31a145ed.jpg', '', '0c09a2df3827b3a485333794aad9c12a', '29c2b22d3deea3edd5298577f9e47811d00e30b8', '1', '1488511769');
INSERT INTO `os_picture` VALUES ('34', 'local', '/Uploads/Picture/2017-03-03/58b8f0c1c6369.jpg', '', '139b5a4877997c7a00f327b4f3a384e1', '398dba0a0dffba63008750d8afc67583dc9f23ba', '1', '1488515265');
INSERT INTO `os_picture` VALUES ('35', 'local', '/Uploads/Picture/2017-03-03/58b8f179259f9.png', '', '9c987c7eea4def87124b581492392389', '35ffa736af885c3881213ce8f40eb77ffbafc1c5', '1', '1488515449');
INSERT INTO `os_picture` VALUES ('36', 'local', '/Uploads/Picture/2017-03-03/58b8fe39b63c4.jpg', '', 'd96ebec837e332124fd2f1385e259b6c', '739dc83c43d430e2375677f7e9edf841b245d21c', '1', '1488518713');
INSERT INTO `os_picture` VALUES ('37', 'local', '/Uploads/Picture/2017-03-04/58b99e1713a90.jpg', '', '8ef929bf69e5c8788b2b411f78b70c54', '77dad86f0e3b7d3ae9752fb6cba170f09c77c09e', '1', '1488559638');

-- ----------------------------
-- Table structure for os_question
-- ----------------------------
DROP TABLE IF EXISTS `os_question`;
CREATE TABLE `os_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `category` int(11) NOT NULL COMMENT '问题分类',
  `title` varchar(200) NOT NULL COMMENT '问题标题',
  `description` text NOT NULL COMMENT '问题描述',
  `tags` varchar(255) DEFAULT NULL COMMENT '标签',
  `answer_num` int(10) NOT NULL DEFAULT '0' COMMENT '回答数',
  `views` int(10) DEFAULT '0' COMMENT '问题浏览数',
  `best_answer` int(11) NOT NULL COMMENT '最佳答案id',
  `good_question` int(10) NOT NULL DEFAULT '0' COMMENT '好问题（用于好问题排序：数值=支持-反对）',
  `status` tinyint(4) NOT NULL,
  `is_recommend` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否被推荐',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='问题表';

-- ----------------------------
-- Records of os_question
-- ----------------------------
INSERT INTO `os_question` VALUES ('1', '1', '1', '微信公众号开发实时聊天页面', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">开发一个，用微信登录，实时聊天的页面前端要用什么技术。</span></p>', null, '2', '49', '0', '0', '1', '0', '1479525298', '1479525298');
INSERT INTO `os_question` VALUES ('2', '1', '2', '求教大神，前端怎么做一个防sql注入', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">求教大神，前端怎么做一个防sql注入</span><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">狠急，在线等</span></p>', null, '0', '0', '0', '0', '1', '0', '1479525737', '1479525737');
INSERT INTO `os_question` VALUES ('3', '1', '1', '问 请问这个php能像 js一样运行存储成str形式的代码吗?', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1.5em; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; white-space: normal; background-color: rgb(255, 255, 255);\">比如js 的 eval( ) 命令, 可以运行储存成字符串形式的js 代码</p><p style=\"box-sizing: border-box; margin-top: 1.5em; margin-bottom: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; white-space: normal; background-color: rgb(255, 255, 255);\">对应的php 命令是什么?</p><p><br/></p>', null, '0', '0', '0', '0', '1', '0', '1479525810', '1479525810');
INSERT INTO `os_question` VALUES ('4', '1', '1', '这条SQL语句在TP的操作方法里面应该怎么写呢？', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1.5em; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; white-space: normal; background-color: rgb(255, 255, 255);\">比如<code style=\"box-sizing: border-box; font-family: &quot;Source Code Pro&quot;, Consolas, Menlo, Monaco, &quot;Courier New&quot;, monospace; font-size: 0.93em; color: rgb(199, 37, 78); padding: 2px 4px; border-radius: 3px; background-color: rgb(249, 242, 244);\">$Model = M(&#39;table2&#39;);</code>后面应该怎么写呢？</p><pre class=\"hljs sql\" style=\"box-sizing: border-box; overflow: auto; font-family: &quot;Source Code Pro&quot;, Consolas, Menlo, Monaco, &quot;Courier New&quot;, monospace; font-size: 0.93em; padding: 1em; margin-bottom: 1.5em; line-height: 1.3; word-break: break-all; word-wrap: break-word; color: rgb(101, 123, 131); border: none; border-radius: 3px; max-height: 35em; position: relative; margin-top: 0px !important;\">select&nbsp;name,MAX(time)&nbsp;from&nbsp;table2&nbsp;GROUP&nbsp;BY&nbsp;name;</pre><p><br/></p>', 'thinkphp,php', '1', '46', '0', '0', '1', '0', '1479995195', '1479995195');
INSERT INTO `os_question` VALUES ('5', '101', '1', 'linux+nginx+php环境下，html文件使用link引入css文件，修改css文件，页面样式不变?', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">请问各位，这是不是nginx配置有问题，在html文件里使用link标签导入css文件，除了第一次有效果，以后每次修改css文件，页面样式都没有变化</span></p>', 'css,html,php', '1', '21', '4', '0', '1', '0', '1480431958', '1480433485');
INSERT INTO `os_question` VALUES ('6', '101', '1', 'PHP 由于客户比较多，发送短信类型有很多种，想用短信队列来解决发送担心，不知道如何下手？？？', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; background-color: rgb(255, 255, 255);\">PHP 由于客户比较多，发送短信类型有很多种，想用短信队列来解决发送担心，不知道如何下手？？？</span></p>', 'php,队列,redis', '1', '4', '0', '0', '1', '0', '1488275755', '1488275755');

-- ----------------------------
-- Table structure for os_question_answer
-- ----------------------------
DROP TABLE IF EXISTS `os_question_answer`;
CREATE TABLE `os_question_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '回答内容',
  `support` int(10) NOT NULL DEFAULT '0' COMMENT '支持数',
  `oppose` int(10) NOT NULL DEFAULT '0' COMMENT '反对数',
  `status` tinyint(4) NOT NULL,
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='问题回答表';

-- ----------------------------
-- Records of os_question_answer
-- ----------------------------
INSERT INTO `os_question_answer` VALUES ('1', '101', '1', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1.5em; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; white-space: normal; background-color: rgb(255, 255, 255);\">实时聊天，最好的实现就是用<code style=\"box-sizing: border-box; font-family: &quot;Source Code Pro&quot;, Consolas, Menlo, Monaco, &quot;Courier New&quot;, monospace; font-size: 0.93em; color: rgb(199, 37, 78); padding: 2px 4px; border-radius: 3px; background-color: rgb(249, 242, 244);\">WebSocket</code>。</p><p style=\"box-sizing: border-box; margin-top: 1.5em; margin-bottom: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; white-space: normal; background-color: rgb(255, 255, 255);\">前端：socket.io<br style=\"box-sizing: border-box;\"/>后端：<br style=\"box-sizing: border-box;\"/>nodejs：socket.io<br style=\"box-sizing: border-box;\"/>php：swoole</p><p><br/></p>', '1', '0', '1', '1479618680', '1479618680');
INSERT INTO `os_question_answer` VALUES ('2', '1', '4', '<p>手册就有呀，TP手册要熟练看呀。。。这种问题还提问</p>', '1', '0', '1', '1480088579', '1480088579');
INSERT INTO `os_question_answer` VALUES ('3', '1', '1', '<p>问答界面这么丑呀！！！！！！！！！！！！！！</p>', '0', '0', '1', '1480089751', '1480089751');
INSERT INTO `os_question_answer` VALUES ('4', '101', '5', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">是不是缓存的问题。。。比如清一下浏览器缓存，或者打开css的链接强制刷新一下。</span><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; line-height: 22.4px; background-color: rgb(255, 255, 255);\">我习惯在修改css后，引入那个css的后面带个时间戳</span></p>', '0', '0', '1', '1480432668', '1480432668');
INSERT INTO `os_question_answer` VALUES ('5', '101', '6', '<p style=\"box-sizing: border-box; margin-top: 0px; margin-bottom: 1.5em; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">简单点用<code style=\"box-sizing: border-box; font-family: &quot;Source Code Pro&quot;, Consolas, Menlo, Monaco, &quot;Courier New&quot;, monospace; font-size: 0.93em; color: rgb(199, 37, 78); background-color: rgb(249, 242, 244); padding: 2px 4px; border-radius: 3px;\">redis lpush lpop</code></p><p style=\"box-sizing: border-box; margin-top: 1.5em; margin-bottom: 1.5em; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\"><code style=\"box-sizing: border-box; font-family: &quot;Source Code Pro&quot;, Consolas, Menlo, Monaco, &quot;Courier New&quot;, monospace; font-size: 0.93em; color: rgb(199, 37, 78); background-color: rgb(249, 242, 244); padding: 2px 4px; border-radius: 3px;\">$redis-&gt;lpush(&#39;queue&#39;,json_encode($data));</code></p><p style=\"box-sizing: border-box; margin-top: 1.5em; margin-bottom: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;WenQuanYi Micro Hei&quot;, &quot;Microsoft Yahei&quot;, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">开一个进程lpop消费就可以了，你可以先本地测试下<code style=\"box-sizing: border-box; font-family: &quot;Source Code Pro&quot;, Consolas, Menlo, Monaco, &quot;Courier New&quot;, monospace; font-size: 0.93em; color: rgb(199, 37, 78); background-color: rgb(249, 242, 244); padding: 2px 4px; border-radius: 3px;\">while($redis-&gt;lpop(&#39;queue&#39;))</code></p><p><br/></p>', '0', '0', '1', '1488275850', '1488275850');

-- ----------------------------
-- Table structure for os_question_category
-- ----------------------------
DROP TABLE IF EXISTS `os_question_category`;
CREATE TABLE `os_question_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='问题分类表';

-- ----------------------------
-- Records of os_question_category
-- ----------------------------
INSERT INTO `os_question_category` VALUES ('1', 'PHP', '0', '1', '1');
INSERT INTO `os_question_category` VALUES ('2', 'Javascript', '0', '2', '1');
INSERT INTO `os_question_category` VALUES ('3', 'Mysql', '0', '3', '1');
INSERT INTO `os_question_category` VALUES ('4', 'Linux', '0', '4', '1');

-- ----------------------------
-- Table structure for os_question_support
-- ----------------------------
DROP TABLE IF EXISTS `os_question_support`;
CREATE TABLE `os_question_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tablename` varchar(25) NOT NULL COMMENT '表名：question；question_answer',
  `row` int(11) NOT NULL COMMENT '行号',
  `type` int(11) NOT NULL COMMENT '类型：0：反对，1：支持',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='问题支持反对表';

-- ----------------------------
-- Records of os_question_support
-- ----------------------------
INSERT INTO `os_question_support` VALUES ('1', '1', 'QuestionAnswer', '1', '1');
INSERT INTO `os_question_support` VALUES ('2', '101', 'QuestionAnswer', '2', '1');

-- ----------------------------
-- Table structure for os_question_tags
-- ----------------------------
DROP TABLE IF EXISTS `os_question_tags`;
CREATE TABLE `os_question_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` tinyint(6) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0' COMMENT '总数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='标签分类表';

-- ----------------------------
-- Records of os_question_tags
-- ----------------------------
INSERT INTO `os_question_tags` VALUES ('34', 'php', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('35', 'mysql', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('36', 'javascript', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('37', 'jquery', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('38', 'mongodb', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('39', 'linux', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('40', 'nginx', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('41', 'apache', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('42', 'redis', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('43', 'memcached', '1', '0', '1', '0');
INSERT INTO `os_question_tags` VALUES ('44', 'thinkphp', '1', '0', '1', '0');

-- ----------------------------
-- Table structure for os_rank
-- ----------------------------
DROP TABLE IF EXISTS `os_rank`;
CREATE TABLE `os_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '上传者id',
  `title` varchar(50) NOT NULL,
  `logo` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `types` tinyint(2) NOT NULL DEFAULT '1' COMMENT '前台是否可申请',
  `label_content` varchar(10) NOT NULL COMMENT '文字头衔内容',
  `label_color` varchar(10) NOT NULL COMMENT '文字颜色',
  `label_bg` varchar(10) NOT NULL COMMENT 'label背景色',
  `rule_content` text COMMENT '具体规则内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_rank
-- ----------------------------
INSERT INTO `os_rank` VALUES ('1', '1', '博客专家', '7', '1480945596', '1', '博客专家', '', '#F5A623', '<p style=\"text-align: left;\">“博客专家”是本站给予质量较高、影响力较大的IT类博客的荣誉称号，代表了官方对其博客的肯定，同时博客专家也需要承担一定的社区责任。<br/><br/>&nbsp;&nbsp; 博客专家申请规则具体如下：<br/><br/>&nbsp;&nbsp;&nbsp; <strong>申请博客专家应具备的条件</strong>：<br/><br/>&nbsp;&nbsp;&nbsp; 1.原创技术文章总数超过20篇，并且最近一个月内发布了新的原创技术文章。<br/><br/>&nbsp;&nbsp;&nbsp; 2.文章内容的质量很高。<br/><br/>&nbsp;&nbsp;&nbsp; 3.如果已经在某IT领域具有较大影响力，但是尚没有达到上述申请条件的用户，可以通过现有博客专家的推荐，或者本站编辑部推荐，暂时成为“特约专家”，待达到上述条件之后，再转为正式的博客专家。</p><p style=\"text-align: left;\"><br/>&nbsp;&nbsp;&nbsp; <strong>注意事项</strong>：<br/><br/>&nbsp;&nbsp;&nbsp; 1.博客专家如有违反本网站规则的行为，如大量发布广告或软文，对本网站造成不良影响等，将永久取消其博客专家身份。<br/><br/>&nbsp;&nbsp;&nbsp; 2.博客专家在六个月内如果没有发布任何原创或翻译博文，其博客专家身份将自动取消，转为博客频道荣誉专家，进入博客频道荣誉专家列表，不能继续享有博客专家的福利。希望恢复博客专家身份可联系管理员重新申请。<br/><br/>&nbsp;&nbsp;&nbsp; 3.博客专家是本站给予质量较高的技术博客的一个荣誉称号，代表官方对其博客内容的肯定。但博客专家不是本站博客的全职或兼职管理人员，不具备本站博客的管理权力，其观点及行为仅代表个人，不代表本站官方立场。<br/><br/>&nbsp;&nbsp;&nbsp; <strong>博客专家福利</strong>：<br/><br/>&nbsp;&nbsp;&nbsp; 1.博客专家用户头像上显示“专家”勋章，并能开辟自己的专栏。<br/><br/>&nbsp;&nbsp;&nbsp; 2.文章获得更多的推荐机会。博客专家所发的文章都会进入文章预选库，我们有专门的编辑负责从中筛选优质内容，并推荐到本站首页或其他内容频道；同时博客专家每日发布到博客首页的博文不受次数限制。<br/><br/>&nbsp;&nbsp;&nbsp; 3.其他不定时的福利。我们不定期会有一些奖品发放，博客专家享有优先获得权。</p>');

-- ----------------------------
-- Table structure for os_rank_user
-- ----------------------------
DROP TABLE IF EXISTS `os_rank_user`;
CREATE TABLE `os_rank_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `truename` char(12) DEFAULT NULL COMMENT '真实姓名',
  `qq` varchar(30) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `category` int(11) DEFAULT '0',
  `company` varchar(50) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL COMMENT '职位名称',
  `technology` varchar(60) DEFAULT NULL COMMENT '擅长技术',
  `reason` varchar(255) NOT NULL,
  `is_show` tinyint(4) NOT NULL COMMENT '是否显示在昵称右侧（必须有图片才可）',
  `create_time` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_rank_user
-- ----------------------------
INSERT INTO `os_rank_user` VALUES ('1', '101', '1', '包汉伟', '978350126', '北京', '4', '北京天地在线广告有限公司', 'PHP研发工程师', 'PHP', '1、热爱技术2、乐于助人&nbsp;&nbsp;3、喜欢结交志同道合4、希望提高技术5、木有啦', '1', '1486915647', '1');

-- ----------------------------
-- Table structure for os_report
-- ----------------------------
DROP TABLE IF EXISTS `os_report`;
CREATE TABLE `os_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `data` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `updata_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `handle_status` tinyint(4) NOT NULL,
  `handle_result` text NOT NULL,
  `handle_uid` int(11) NOT NULL,
  `handle_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_report
-- ----------------------------

-- ----------------------------
-- Table structure for os_role
-- ----------------------------
DROP TABLE IF EXISTS `os_role`;
CREATE TABLE `os_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL COMMENT '角色组id',
  `name` varchar(25) NOT NULL COMMENT '英文标识',
  `title` varchar(25) NOT NULL COMMENT '中文标题',
  `description` varchar(500) NOT NULL COMMENT '描述',
  `user_groups` varchar(200) NOT NULL COMMENT '默认用户组ids',
  `invite` tinyint(4) NOT NULL COMMENT '预留字段(类型：是否需要邀请注册等)',
  `audit` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `sort` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of os_role
-- ----------------------------
INSERT INTO `os_role` VALUES ('1', '0', 'default', '普通用户', '普通用户', '1', '0', '0', '0', '1', '1473086386', '1473086386');

-- ----------------------------
-- Table structure for os_role_config
-- ----------------------------
DROP TABLE IF EXISTS `os_role_config`;
CREATE TABLE `os_role_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL COMMENT '标识',
  `category` varchar(25) NOT NULL COMMENT '归类标识',
  `value` text NOT NULL COMMENT '配置值',
  `data` text NOT NULL COMMENT '该配置的其它值',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='角色配置表';

-- ----------------------------
-- Records of os_role_config
-- ----------------------------
INSERT INTO `os_role_config` VALUES ('1', '1', 'user_tag', '', '2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,20,21,22,23,24,25,26,27,28,29,30,31,32,33', '', '1477066898');

-- ----------------------------
-- Table structure for os_role_group
-- ----------------------------
DROP TABLE IF EXISTS `os_role_group`;
CREATE TABLE `os_role_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色分组';

-- ----------------------------
-- Records of os_role_group
-- ----------------------------

-- ----------------------------
-- Table structure for os_score_log
-- ----------------------------
DROP TABLE IF EXISTS `os_score_log`;
CREATE TABLE `os_score_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ip` bigint(20) NOT NULL,
  `type` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `value` double NOT NULL,
  `finally_value` double NOT NULL,
  `create_time` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `model` varchar(20) NOT NULL,
  `record_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_score_log
-- ----------------------------
INSERT INTO `os_score_log` VALUES ('1', '1', '3232263681', '1', 'inc', '10', '10', '1473601950', 'admin在2016-09-11 21:52登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('2', '1', '3232263681', '1', 'inc', '10', '20', '1474167899', 'admin在2016-09-18 11:04登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('3', '1', '3232263681', '1', 'inc', '1', '21', '1474205180', 'admin在2016-09-18 21:26发布了新微博：1【积分：+1分】', 'weibo', '1');
INSERT INTO `os_score_log` VALUES ('4', '1', '3232263681', '1', 'inc', '10', '31', '1474294858', 'admin在2016-09-19 22:20登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('5', '1', '3232263681', '1', 'inc', '10', '41', '1474459082', 'admin在2016-09-21 19:58登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('6', '1', '3232263681', '1', 'inc', '1', '42', '1474470117', 'admin在2016-09-21 23:01发布了新微博：2【积分：+1分】', 'weibo', '2');
INSERT INTO `os_score_log` VALUES ('7', '1', '3232263681', '1', 'inc', '1', '43', '1474474400', 'admin在2016-09-22 00:13添加了微博评论：1【积分：+1分】', 'weibo_comment', '1');
INSERT INTO `os_score_log` VALUES ('8', '1', '3232263681', '1', 'inc', '1', '44', '1474474448', 'admin在2016-09-22 00:14添加了微博评论：2【积分：+1分】', 'weibo_comment', '2');
INSERT INTO `os_score_log` VALUES ('9', '1', '3232263681', '1', 'inc', '1', '45', '1474549104', 'admin在2016-09-22 20:58发布了新微博：3【积分：+1分】', 'weibo', '3');
INSERT INTO `os_score_log` VALUES ('10', '1', '3232263681', '1', 'inc', '1', '46', '1474549139', 'admin在2016-09-22 20:58发布了新微博：4【积分：+1分】', 'weibo', '4');
INSERT INTO `os_score_log` VALUES ('11', '1', '3232263681', '1', 'inc', '1', '47', '1474552615', 'admin在2016-09-22 21:56发布了新微博：5【积分：+1分】', 'weibo', '5');
INSERT INTO `os_score_log` VALUES ('12', '1', '3232263681', '1', 'inc', '1', '48', '1474552669', 'admin在2016-09-22 21:57发布了新微博：6【积分：+1分】', 'weibo', '6');
INSERT INTO `os_score_log` VALUES ('13', '1', '3232263681', '1', 'inc', '1', '49', '1474552725', 'admin在2016-09-22 21:58发布了新微博：7【积分：+1分】', 'weibo', '7');
INSERT INTO `os_score_log` VALUES ('14', '1', '3232263681', '1', 'inc', '10', '59', '1474770519', 'admin在2016-09-25 10:28登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('15', '1', '3232263681', '1', 'inc', '1', '60', '1474789677', 'admin在2016-09-25 15:47添加了微博评论：3【积分：+1分】', 'weibo_comment', '3');
INSERT INTO `os_score_log` VALUES ('16', '1', '3232263681', '1', 'inc', '10', '70', '1476105055', 'admin在2016-10-10 21:10登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('17', '1', '3232263681', '1', 'inc', '1', '71', '1476105091', 'admin在2016-10-10 21:11发布了新微博：8【积分：+1分】', 'weibo', '8');
INSERT INTO `os_score_log` VALUES ('18', '1', '3232263681', '1', 'inc', '1', '72', '1476105250', 'admin在2016-10-10 21:14发布了新微博：9【积分：+1分】', 'weibo', '9');
INSERT INTO `os_score_log` VALUES ('19', '1', '3232263681', '1', 'inc', '1', '73', '1476105292', 'admin在2016-10-10 21:14发布了新微博：10【积分：+1分】', 'weibo', '10');
INSERT INTO `os_score_log` VALUES ('20', '1', '3232263681', '1', 'inc', '10', '83', '1476278920', 'admin在2016-10-12 21:28登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('21', '1', '3232263681', '1', 'inc', '10', '93', '1476365619', 'admin在2016-10-13 21:33登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('22', '1', '3232263681', '1', 'inc', '10', '103', '1476501219', 'admin在2016-10-15 11:13登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('23', '101', '3232263681', '1', 'inc', '10', '10', '1476600511', '包汉伟1在2016-10-16 14:48登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('24', '102', '3232263681', '1', 'inc', '10', '10', '1476608754', '请叫我包包大人在2016-10-16 17:05登录了账号【积分：+10分】', 'member', '102');
INSERT INTO `os_score_log` VALUES ('25', '101', '3232263681', '1', 'inc', '10', '20', '1476709876', '包汉伟1在2016-10-17 21:11登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('26', '101', '3232263681', '1', 'inc', '10', '30', '1476796291', '包汉伟在2016-10-18 21:11登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('27', '1', '3232263681', '1', 'inc', '10', '113', '1476798378', 'admin在2016-10-18 21:46登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('28', '101', '3232263681', '1', 'inc', '10', '40', '1476969211', '包汉伟在2016-10-20 21:13登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('29', '101', '3232263681', '1', 'inc', '10', '50', '1477061997', '包汉伟在2016-10-21 22:59登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('30', '1', '3232263681', '1', 'inc', '10', '123', '1477064873', 'admin在2016-10-21 23:47登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('31', '1', '3232263681', '1', 'inc', '10', '133', '1477184005', 'admin在2016-10-23 08:53登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('32', '101', '3232263681', '1', 'inc', '10', '60', '1477184138', '包汉伟在2016-10-23 08:55登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('33', '101', '3232263681', '1', 'inc', '1', '61', '1477192480', '包汉伟在2016-10-23 11:14发布了新微博：11【积分：+1分】', 'weibo', '11');
INSERT INTO `os_score_log` VALUES ('34', '101', '3232263681', '1', 'inc', '1', '62', '1477194084', '包汉伟在2016-10-23 11:41发布了新微博：12【积分：+1分】', 'weibo', '12');
INSERT INTO `os_score_log` VALUES ('35', '101', '3232263681', '1', 'inc', '1', '63', '1477194177', '包汉伟在2016-10-23 11:42发布了新微博：13【积分：+1分】', 'weibo', '13');
INSERT INTO `os_score_log` VALUES ('36', '102', '3232263681', '1', 'inc', '10', '20', '1477233277', '请叫我包包大人在2016-10-23 22:34登录了账号【积分：+10分】', 'member', '102');
INSERT INTO `os_score_log` VALUES ('37', '1', '3232263681', '1', 'inc', '10', '143', '1477578298', 'admin在2016-10-27 22:24登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('38', '101', '3232263681', '1', 'inc', '10', '73', '1477578339', '包汉伟在2016-10-27 22:25登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('39', '101', '3232263681', '1', 'inc', '10', '83', '1477901447', '包汉伟在2016-10-31 16:10登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('40', '1', '3232263681', '1', 'inc', '10', '153', '1477909640', 'admin在2016-10-31 18:27登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('41', '101', '3232263681', '1', 'inc', '10', '93', '1478010749', '包汉伟在2016-11-01 22:32登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('42', '101', '3232263681', '1', 'inc', '10', '103', '1478310649', '包汉伟在2016-11-05 09:50登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('43', '1', '3232263681', '1', 'inc', '10', '163', '1478532487', 'admin在2016-11-07 23:28登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('44', '101', '3232263681', '1', 'inc', '10', '113', '1479000871', '包汉伟在2016-11-13 09:34登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('45', '101', '3232263681', '1', 'inc', '10', '123', '1479130135', '包汉伟在2016-11-14 21:28登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('46', '101', '3232263681', '1', 'inc', '10', '133', '1479219396', '包汉伟在2016-11-15 22:16登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('47', '1', '3232263681', '1', 'inc', '10', '173', '1479392878', 'admin在2016-11-17 22:27登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('48', '1', '3232263681', '1', 'inc', '10', '183', '1479523864', 'admin在2016-11-19 10:51登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('49', '1', '3232263681', '1', 'dec', '5', '178', '1479525297', '', '', '0');
INSERT INTO `os_score_log` VALUES ('50', '101', '3232263681', '1', 'inc', '10', '143', '1479614857', '包汉伟在2016-11-20 12:07登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('51', '1', '3232263681', '1', 'inc', '10', '188', '1479823816', 'admin在2016-11-22 22:10登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('52', '101', '3232263681', '1', 'inc', '10', '153', '1480340225', '包汉伟在2016-11-28 21:37登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('53', '1', '3232263681', '1', 'inc', '10', '198', '1480344179', 'admin在2016-11-28 22:42登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('54', '101', '3232263681', '1', 'inc', '10', '163', '1480427952', '包汉伟在2016-11-29 21:59登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('55', '101', '3232263681', '1', 'inc', '10', '173', '1480517413', '包汉伟在2016-11-30 22:50登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('56', '101', '3232263681', '1', 'inc', '1', '174', '1480555691', '包汉伟在2016-12-01 09:28发布了新微博：14【积分：+1分】', 'weibo', '14');
INSERT INTO `os_score_log` VALUES ('57', '101', '3232263681', '1', 'inc', '1', '175', '1480557974', '包汉伟在2016-12-01 10:06发布了新微博：15【积分：+1分】', 'weibo', '15');
INSERT INTO `os_score_log` VALUES ('58', '101', '3232263681', '1', 'inc', '1', '176', '1480566477', '包汉伟在2016-12-01 12:27添加了微博评论：4【积分：+1分】', 'weibo_comment', '4');
INSERT INTO `os_score_log` VALUES ('59', '1', '3232263681', '1', 'inc', '10', '208', '1480566887', 'admin在2016-12-01 12:34登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('60', '101', '3232263681', '1', 'inc', '10', '186', '1480944242', '包汉伟在2016-12-05 21:24登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('61', '1', '3232263681', '1', 'inc', '10', '218', '1480945168', 'admin在2016-12-05 21:39登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('62', '1', '3232263681', '1', 'inc', '10', '228', '1482846127', 'admin在2016-12-27 21:42登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('63', '1', '3232263681', '1', 'inc', '10', '238', '1483022131', 'admin在2016-12-29 22:35登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('64', '101', '3232263681', '1', 'inc', '10', '196', '1483151048', '包汉伟在2016-12-31 10:24登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('65', '1', '3232263681', '1', 'inc', '10', '248', '1483152926', 'admin在2016-12-31 10:55登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('66', '1', '3232263681', '1', 'inc', '10', '258', '1483347405', 'admin在2017-01-02 16:56登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('67', '1', '3232263681', '1', 'inc', '10', '268', '1483760972', 'admin在2017-01-07 11:49登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('68', '1', '3232263681', '1', 'inc', '10', '278', '1483974566', 'admin在2017-01-09 23:09登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('69', '1', '3232263681', '1', 'inc', '10', '288', '1484318521', 'admin在2017-01-13 22:41登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('70', '101', '3232263681', '1', 'inc', '10', '206', '1484486467', '包汉伟在2017-01-15 21:21登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('71', '1', '3232263681', '1', 'inc', '10', '298', '1486302627', 'admin在2017-02-05 21:50登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('72', '101', '3232263681', '1', 'inc', '10', '216', '1486866059', '包汉伟在2017-02-12 10:20登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('73', '1', '3232263681', '1', 'inc', '10', '308', '1486866532', 'admin在2017-02-12 10:28登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('74', '1', '3232263681', '1', 'inc', '10', '318', '1487040744', 'admin在2017-02-14 10:52登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('75', '101', '3232263681', '1', 'inc', '10', '226', '1487310871', '包汉伟在2017-02-17 13:54登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('76', '1', '3232263681', '1', 'inc', '10', '328', '1487311384', 'admin在2017-02-17 14:03登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('77', '101', '3232263681', '1', 'inc', '10', '236', '1487653151', '包汉伟在2017-02-21 12:59登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('78', '1', '3232263681', '1', 'inc', '10', '338', '1487665491', 'admin在2017-02-21 16:24登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('79', '1', '3232263681', '1', 'inc', '10', '348', '1487814255', 'admin在2017-02-23 09:44登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('80', '1', '3232263681', '1', 'inc', '10', '358', '1487987929', 'admin在2017-02-25 09:58登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('81', '1', '3232263681', '1', 'inc', '1', '359', '1488092098', 'admin在2017-02-26 14:54发布了新微博：18【积分：+1分】', 'weibo', '18');
INSERT INTO `os_score_log` VALUES ('82', '1', '3232263681', '1', 'inc', '10', '369', '1488162105', 'admin在2017-02-27 10:21登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('83', '101', '3232263681', '1', 'inc', '10', '246', '1488162834', '包汉伟在2017-02-27 10:33登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('84', '101', '3232263681', '1', 'inc', '10', '256', '1488271492', '包汉伟在2017-02-28 16:44登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('85', '1', '3232263681', '1', 'inc', '10', '379', '1488275907', 'admin在2017-02-28 17:58登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('86', '101', '3232263681', '1', 'inc', '10', '266', '1488423883', '包汉伟在2017-03-02 11:04登录了账号【积分：+10分】', 'member', '101');
INSERT INTO `os_score_log` VALUES ('87', '1', '3232263681', '1', 'inc', '1', '380', '1488594988', 'admin在2017-03-04 10:36发布了新微博：19【积分：+1分】', 'weibo', '19');
INSERT INTO `os_score_log` VALUES ('88', '1', '3232263681', '1', 'inc', '10', '390', '1488683178', 'admin在2017-03-05 11:06登录了账号【积分：+10分】', 'member', '1');
INSERT INTO `os_score_log` VALUES ('89', '101', '3232263681', '1', 'inc', '10', '276', '1488849619', '包汉伟在2017-03-07 09:20登录了账号【积分：+10分】', 'member', '101');

-- ----------------------------
-- Table structure for os_seo_rule
-- ----------------------------
DROP TABLE IF EXISTS `os_seo_rule`;
CREATE TABLE `os_seo_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `app` varchar(40) NOT NULL,
  `controller` varchar(40) NOT NULL,
  `action` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_description` text NOT NULL,
  `seo_title` text NOT NULL,
  `sort` int(11) NOT NULL,
  `summary` varchar(500) NOT NULL COMMENT 'seo变量介绍',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_seo_rule
-- ----------------------------
INSERT INTO `os_seo_rule` VALUES ('1000', '整站标题', '', '', '', '1', '', '', '', '7', '-');
INSERT INTO `os_seo_rule` VALUES ('1001', '用户中心', 'Ucenter', 'index', 'index', '1', '{$user_info.username|text}的个人主页', '{$user_info.username|text}的个人主页', '{$user_info.nickname|op_t}的个人主页', '3', '-');
INSERT INTO `os_seo_rule` VALUES ('1002', '网站首页', 'Home', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1003', '积分商城首页', 'Shop', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1004', '商品列表', 'Shop', 'Index', 'goods', '1', '', '', '', '0', 'category_name：当前分类名\nchild_category_name：子分类名');
INSERT INTO `os_seo_rule` VALUES ('1005', '商品详情', 'Shop', 'Index', 'goodsdetail', '1', '', '', '', '0', 'content：商品变量集\n   content.goods_name 商品名\n   content.goods_introduct 商品简介\n   content.goods_detail 商品详情');
INSERT INTO `os_seo_rule` VALUES ('1006', '活动主页', 'Event', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1007', '活动详情', 'Event', 'Index', 'detail', '1', '', '', '', '0', 'content：活动变量集\n   content.title 活动名称\n   content.type.title 活动分类名\n   content.user.nickname 发起人昵称\n   content.address 活动地点\n   content.limitCount 人数限制');
INSERT INTO `os_seo_rule` VALUES ('1008', '活动成员', 'Event', 'Index', 'member', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1009', '专辑首页', 'Issue', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1010', '专辑详情', 'Issue', 'Index', 'issuecontentdetail', '1', '', '', '', '0', 'content：专辑内容变量集\n   content.user.nickname 内容发布者昵称\n   content.user.signature 内容发布者签名\n   content.url 内容的Url\n   content.title 内容标题\n   content.create_time|friendlyDate 发布时间\n   content.update_time|friendlyDate 更新时间');
INSERT INTO `os_seo_rule` VALUES ('1011', '论坛主页', 'Forum', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1012', '某个版块的帖子列表', 'Forum', 'Index', 'forum', '1', '', '', '', '0', 'forum：版块变量集\n   forum.description 版块描述\n   forum.title 版块名称\n   forum.topic_count 主题数\n   forum.total_count 帖子数');
INSERT INTO `os_seo_rule` VALUES ('1013', '帖子详情', 'Forum', 'Index', 'detail', '1', '', '', '', '0', 'post：帖子变量集\n   post.title 帖子标题\n   post.content 帖子详情\n   post.forum.title 帖子所在版块标题\n   ');
INSERT INTO `os_seo_rule` VALUES ('1014', '搜索帖子', 'Forum', 'Index', 'search', '1', '', '', '', '0', 'keywords：搜索的关键词，2.4.0以后版本提供');
INSERT INTO `os_seo_rule` VALUES ('1015', '随便看看', 'Forum', 'Index', 'look', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1016', '全部版块', 'Forum', 'Index', 'lists', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1017', '资讯首页/某个分类下的文章列表', 'News', 'Index', 'index', '1', '', '', '', '0', 'now_category.title 当前分类的名称');
INSERT INTO `os_seo_rule` VALUES ('1018', '某篇文章的内容页', 'News', 'Index', 'detail', '1', '', '', '', '0', 'now_category.title 当前分类的名称\ninfo：文章变量集\n   info.title 文章标题\n   info.description 文章摘要\n   info.source 文章来源\n   info.detail.content 文章内容\nauthor.nickname 作者昵称\nauthor.signature 作者签名\n   ');
INSERT INTO `os_seo_rule` VALUES ('1019', '微博首页', 'Weibo', 'Index', 'index', '1', '{$MODULE_ALIAS}', '{$MODULE_ALIAS}首页', '{$MODULE_ALIAS}-{$website_name}', '0', 'title：我关注的、热门微博、全站关注');
INSERT INTO `os_seo_rule` VALUES ('1020', '某条微博的详情页', 'Weibo', 'Index', 'weibodetail', '1', '{$weibo.title|text},{$website_name},{$MODULE_ALIAS}', '{$weibo.content|text}', '{$weibo.content|text}——{$MODULE_ALIAS}', '0', 'weibo:微博变量集\n   weibo.user.nickname 发布者昵称\n   weibo.content 微博内容');
INSERT INTO `os_seo_rule` VALUES ('1021', '微博搜索页面', 'Weibo', 'Index', 'search', '1', '', '', '', '0', 'search_keywords：搜索关键词');
INSERT INTO `os_seo_rule` VALUES ('1022', '热门话题列表', 'Weibo', 'Topic', 'topic', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1023', '某个话题的话题页', 'Weibo', 'Topic', 'index', '1', '', '', '', '0', 'topic：话题变量集\n   topic.name 话题名称\nhost：话题主持人变量集\n   host.nickname 主持人昵称');
INSERT INTO `os_seo_rule` VALUES ('1024', '自动跳转到我的群组', 'Group', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1025', '全部群组', 'Group', 'Index', 'groups', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1026', '我的群组-帖子列表', 'Group', 'Index', 'my', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1027', '我的群组-全部关注的群组列表', 'Group', 'Index', 'mygroup', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1028', '某个群组的帖子列表页面', 'Group', 'Index', 'group', '1', '', '', '', '0', 'search_key：如果查找帖子，则是关键词\ngroup：群组变量集\n   group.title 群组标题\n   group.user.nickname 创始人昵称\n   group.member_count 群组人数');
INSERT INTO `os_seo_rule` VALUES ('1029', '某篇帖子的内容页', 'Group', 'Index', 'detail', '1', '', '', '', '0', 'group：群组变量集\n   group.title 群组标题\n   group.user.nickname 创始人昵称\n   group.member_count 群组人数\npost：帖子变量集\n   post.title 帖子标题\n   post.content 帖子内容');
INSERT INTO `os_seo_rule` VALUES ('1030', '创建群组', 'Group', 'Index', 'create', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1031', '发现', 'Group', 'Index', 'discover', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1032', '精选', 'Group', 'Index', 'select', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1033', '找人首页', 'People', 'Index', 'index', '1', '{$MODULE_ALIAS}', '{$MODULE_ALIAS}', '{$MODULE_ALIAS}', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1034', '微店首页', 'Store', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1035', '某个分类下的商品列表页', 'Store', 'Index', 'li', '1', '', '', '', '0', 'type：当前分类变量集\n   type.title 分类名称');
INSERT INTO `os_seo_rule` VALUES ('1036', '搜索商品列表页', 'Store', 'Index', 'search', '1', '', '', '', '0', 'searchKey：搜索关键词');
INSERT INTO `os_seo_rule` VALUES ('1037', '单个商品的详情页', 'Store', 'Index', 'info', '1', '', '', '', '0', 'info：商品变量集\n   info.title 商品标题\n   info.des 商品描述\n   info.shop：店铺变量集\n       info.shop.title 店铺名称\n       info.shop.summary 店铺简介\n       info.shop.position 店铺所在地\n       info.shop.user.nickname 店主昵称');
INSERT INTO `os_seo_rule` VALUES ('1038', '店铺街', 'Store', 'Index', 'lists', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1039', '某个店铺的首页', 'Store', 'Shop', 'detail', '1', '', '', '', '0', 'shop：店铺变量集\n   shop.title 店铺名称\n   shop.summary 店铺简介\n   shop.position 店铺所在地\n   shop.user.nickname 店主昵称');
INSERT INTO `os_seo_rule` VALUES ('1040', '某个店铺下的商品列表页', 'Store', 'Shop', 'goods', '1', '', '', '', '0', 'shop：店铺变量集\n   shop.title 店铺名称\n   shop.summary 店铺简介\n   shop.position 店铺所在地\n   shop.user.nickname 店主昵称');
INSERT INTO `os_seo_rule` VALUES ('1041', '分类信息首页', 'Cat', 'Index', 'index', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1042', '某个模型下的列表页', 'Cat', 'Index', 'li', '1', '', '', '', '0', 'entity：当前模型变量集\n   entity.alias 模型名');
INSERT INTO `os_seo_rule` VALUES ('1043', '某条信息的详情页', 'Cat', 'Index', 'info', '1', '', '', '', '0', 'entity：当前模型变量集\n   entity.alias 模型名\ninfo：当前信息\n   info.title 信息名称\nuser.nickname 发布者昵称');
INSERT INTO `os_seo_rule` VALUES ('1044', '待回答页面', 'Question', 'Index', 'waitanswer', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1045', '热门问题', 'Question', 'Index', 'goodquestion', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1046', '我的回答', 'Question', 'Index', 'myquestion', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1047', '全部问题', 'Question', 'Index', 'questions', '1', '', '', '', '0', '-');
INSERT INTO `os_seo_rule` VALUES ('1048', '详情', 'Question', 'Index', 'detail', '1', '', '', '', '0', 'question：问题变量集\n   question.title 问题标题\n   question.description 问题描述\n   question.answer_num 回答数\nbest_answer：最佳回答\n   best_answer.content 最佳答案内容');

-- ----------------------------
-- Table structure for os_sso_app
-- ----------------------------
DROP TABLE IF EXISTS `os_sso_app`;
CREATE TABLE `os_sso_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_time` int(11) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_sso_app
-- ----------------------------

-- ----------------------------
-- Table structure for os_super_links
-- ----------------------------
DROP TABLE IF EXISTS `os_super_links`;
CREATE TABLE `os_super_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '类别（1：图片，2：普通）',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '站点名称',
  `cover_id` int(10) NOT NULL COMMENT '图片ID',
  `link` char(140) NOT NULL DEFAULT '' COMMENT '链接地址',
  `level` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '优先级',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态（0：禁用，1：正常）',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='友情连接表';

-- ----------------------------
-- Records of os_super_links
-- ----------------------------

-- ----------------------------
-- Table structure for os_support
-- ----------------------------
DROP TABLE IF EXISTS `os_support`;
CREATE TABLE `os_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appname` varchar(20) NOT NULL COMMENT '应用名',
  `row` int(11) NOT NULL COMMENT '应用标识',
  `uid` int(11) NOT NULL COMMENT '用户',
  `create_time` int(11) NOT NULL COMMENT '发布时间',
  `table` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='支持的表';

-- ----------------------------
-- Records of os_support
-- ----------------------------
INSERT INTO `os_support` VALUES ('1', 'Weibo', '1', '1', '1474468366', 'weibo');
INSERT INTO `os_support` VALUES ('2', 'Weibo', '4', '1', '1474549173', 'weibo');
INSERT INTO `os_support` VALUES ('3', 'Weibo', '15', '101', '1480566452', 'weibo');

-- ----------------------------
-- Table structure for os_sync_login
-- ----------------------------
DROP TABLE IF EXISTS `os_sync_login`;
CREATE TABLE `os_sync_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type_uid` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `oauth_token` varchar(255) NOT NULL,
  `oauth_token_secret` varchar(255) NOT NULL,
  `is_sync` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_sync_login
-- ----------------------------

-- ----------------------------
-- Table structure for os_tag
-- ----------------------------
DROP TABLE IF EXISTS `os_tag`;
CREATE TABLE `os_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` tinyint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='标签分类表';

-- ----------------------------
-- Records of os_tag
-- ----------------------------
INSERT INTO `os_tag` VALUES ('1', '开发平台', '1', '0', '0');
INSERT INTO `os_tag` VALUES ('2', 'PHP', '1', '1', '0');
INSERT INTO `os_tag` VALUES ('3', 'JavaScript', '1', '1', '1');
INSERT INTO `os_tag` VALUES ('4', 'HTML/CSS', '1', '1', '11');
INSERT INTO `os_tag` VALUES ('5', 'Java', '1', '1', '2');
INSERT INTO `os_tag` VALUES ('6', 'Android', '1', '1', '3');
INSERT INTO `os_tag` VALUES ('7', ' iOS/Objective-C', '1', '1', '4');
INSERT INTO `os_tag` VALUES ('8', 'Linux/Unix', '1', '1', '5');
INSERT INTO `os_tag` VALUES ('9', 'C/C++', '1', '1', '7');
INSERT INTO `os_tag` VALUES ('10', 'Python', '1', '1', '6');
INSERT INTO `os_tag` VALUES ('11', ' Ruby', '1', '1', '9');
INSERT INTO `os_tag` VALUES ('12', '.NET/C#', '1', '1', '8');
INSERT INTO `os_tag` VALUES ('13', 'Visual Basic', '1', '1', '14');
INSERT INTO `os_tag` VALUES ('14', 'Lua', '1', '1', '12');
INSERT INTO `os_tag` VALUES ('15', ' 其它', '1', '1', '15');
INSERT INTO `os_tag` VALUES ('16', 'Node.js', '1', '1', '10');
INSERT INTO `os_tag` VALUES ('17', 'HTML5', '1', '1', '11');
INSERT INTO `os_tag` VALUES ('18', 'golang ', '1', '1', '13');
INSERT INTO `os_tag` VALUES ('19', '专长领域', '1', '0', '0');
INSERT INTO `os_tag` VALUES ('20', 'WEB开发', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('21', '游戏开发', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('22', '手机软件开发', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('23', '桌面软件开发', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('24', '服务器端开发', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('25', '网页设计/UI/UED', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('26', '软件测试/QA', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('27', '软件开发管理', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('28', '运维/系统/网络管理', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('29', 'DBA/数据库', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('30', '网站运营/站长', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('31', '人事招聘', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('32', 'CTO/CEO/CXO', '1', '19', '0');
INSERT INTO `os_tag` VALUES ('33', '其它领域', '1', '19', '0');

-- ----------------------------
-- Table structure for os_talk
-- ----------------------------
DROP TABLE IF EXISTS `os_talk`;
CREATE TABLE `os_talk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(11) NOT NULL,
  `uids` varchar(100) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会话表';

-- ----------------------------
-- Records of os_talk
-- ----------------------------
INSERT INTO `os_talk` VALUES ('1', '1476888253', '[102],[101]', '1476888253', '-1', '包汉伟 和 请叫我包包大人聊&nbsp;天');

-- ----------------------------
-- Table structure for os_talk_message
-- ----------------------------
DROP TABLE IF EXISTS `os_talk_message`;
CREATE TABLE `os_talk_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `talk_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='聊天消息表';

-- ----------------------------
-- Records of os_talk_message
-- ----------------------------
INSERT INTO `os_talk_message` VALUES ('1', '[cahan]', '1', '1473089196', '0');

-- ----------------------------
-- Table structure for os_talk_message_push
-- ----------------------------
DROP TABLE IF EXISTS `os_talk_message_push`;
CREATE TABLE `os_talk_message_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `source_id` int(11) NOT NULL COMMENT '来源消息id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(4) NOT NULL,
  `talk_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk COMMENT='状态，0为未提示，1为未点击，-1为已点击';

-- ----------------------------
-- Records of os_talk_message_push
-- ----------------------------

-- ----------------------------
-- Table structure for os_talk_push
-- ----------------------------
DROP TABLE IF EXISTS `os_talk_push`;
CREATE TABLE `os_talk_push` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '接收推送的用户id',
  `source_id` int(11) NOT NULL COMMENT '来源id',
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '状态，0为未提示，1为未点击，-1为已点击',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='对话推送表';

-- ----------------------------
-- Records of os_talk_push
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial`;
CREATE TABLE `os_tutorial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` text NOT NULL,
  `version` char(20) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `post_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `allow_user_tutorial` text NOT NULL,
  `sort` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  `background` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '圈子类型，0为公共的，1为私有的',
  `activity` int(11) NOT NULL,
  `member_count` int(11) NOT NULL,
  `member_alias` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial
-- ----------------------------
INSERT INTO `os_tutorial` VALUES ('6', '1', 'ThinkPHP5.0', '5.0', '1484318597', '0', '1', '0', '0', '12', '0', '4', 'ThinkPHP V5.0是一个为API开发而设计的高性能框架.', '0', '0', '0', '');

-- ----------------------------
-- Table structure for os_tutorial_bookmark
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_bookmark`;
CREATE TABLE `os_tutorial_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_bookmark
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_dynamic
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_dynamic`;
CREATE TABLE `os_tutorial_dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `row_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_dynamic
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_lzl_reply
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_lzl_reply`;
CREATE TABLE `os_tutorial_lzl_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `to_f_reply_id` int(11) NOT NULL,
  `to_reply_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_lzl_reply
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_member
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_member`;
CREATE TABLE `os_tutorial_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `activity` int(11) NOT NULL,
  `last_view` int(11) NOT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1为普通成员，2为管理员，3为创建者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_member
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_notice
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_notice`;
CREATE TABLE `os_tutorial_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tutorial_id` (`tutorial_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_notice
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_post
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_post`;
CREATE TABLE `os_tutorial_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `last_reply_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `reply_count` int(11) NOT NULL,
  `is_top` tinyint(4) NOT NULL COMMENT '是否置顶',
  `cate_id` int(11) NOT NULL,
  `summary` varchar(250) NOT NULL,
  `cover` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_post
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_post_category
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_post_category`;
CREATE TABLE `os_tutorial_post_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_post_category
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_post_reply
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_post_reply`;
CREATE TABLE `os_tutorial_post_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parse` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_tutorial_post_reply
-- ----------------------------

-- ----------------------------
-- Table structure for os_tutorial_type
-- ----------------------------
DROP TABLE IF EXISTS `os_tutorial_type`;
CREATE TABLE `os_tutorial_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='圈子的分类表';

-- ----------------------------
-- Records of os_tutorial_type
-- ----------------------------
INSERT INTO `os_tutorial_type` VALUES ('1', 'HTML/CSS', '1', '0', '0', '1483975565');
INSERT INTO `os_tutorial_type` VALUES ('3', 'Javascript', '1', '0', '0', '1483975597');
INSERT INTO `os_tutorial_type` VALUES ('4', '服务端', '1', '0', '0', '1483975625');
INSERT INTO `os_tutorial_type` VALUES ('5', '数据库', '1', '0', '0', '1483975642');
INSERT INTO `os_tutorial_type` VALUES ('6', '移动端', '1', '0', '0', '1483975650');
INSERT INTO `os_tutorial_type` VALUES ('7', '开发工具', '1', '0', '0', '1483975660');

-- ----------------------------
-- Table structure for os_ucenter_admin
-- ----------------------------
DROP TABLE IF EXISTS `os_ucenter_admin`;
CREATE TABLE `os_ucenter_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of os_ucenter_admin
-- ----------------------------

-- ----------------------------
-- Table structure for os_ucenter_member
-- ----------------------------
DROP TABLE IF EXISTS `os_ucenter_member`;
CREATE TABLE `os_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(32) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  `type` tinyint(4) NOT NULL COMMENT '1为用户名注册，2为邮箱注册，3为手机注册',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of os_ucenter_member
-- ----------------------------
INSERT INTO `os_ucenter_member` VALUES ('1', 'admin', '8749fdf1e0ad06dfcb9af5aea4a12674', 'admin@admin.com', '', '1473086386', '3232263681', '1488552568', '3232263681', '1473086386', '1', '1');
INSERT INTO `os_ucenter_member` VALUES ('101', '', '8749fdf1e0ad06dfcb9af5aea4a12674', '978350126@qq.com', '', '1476600423', '3232263681', '1488162834', '3232263681', '1476600423', '1', '2');
INSERT INTO `os_ucenter_member` VALUES ('102', '', '8749fdf1e0ad06dfcb9af5aea4a12674', '2912382004@qq.com', '', '1476607329', '3232263681', '1477233275', '3232263681', '1476607329', '1', '2');
INSERT INTO `os_ucenter_member` VALUES ('103', '', '8749fdf1e0ad06dfcb9af5aea4a12674', '2766599206@qq.com', '', '1487652824', '3232263681', '1487652824', '3232263681', '1487652824', '1', '2');
INSERT INTO `os_ucenter_member` VALUES ('104', '', '8749fdf1e0ad06dfcb9af5aea4a12674', '97835016@qq.com', '', '1487665325', '3232263681', '1487665325', '3232263681', '1487665325', '1', '2');

-- ----------------------------
-- Table structure for os_ucenter_score_type
-- ----------------------------
DROP TABLE IF EXISTS `os_ucenter_score_type`;
CREATE TABLE `os_ucenter_score_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `unit` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_ucenter_score_type
-- ----------------------------
INSERT INTO `os_ucenter_score_type` VALUES ('1', '积分', '1', '分');
INSERT INTO `os_ucenter_score_type` VALUES ('2', '威望', '1', '点');
INSERT INTO `os_ucenter_score_type` VALUES ('3', '贡献', '1', '元');
INSERT INTO `os_ucenter_score_type` VALUES ('4', '余额', '1', '点');

-- ----------------------------
-- Table structure for os_ucenter_setting
-- ----------------------------
DROP TABLE IF EXISTS `os_ucenter_setting`;
CREATE TABLE `os_ucenter_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '设置ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型（1-用户配置）',
  `value` text NOT NULL COMMENT '配置数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置表';

-- ----------------------------
-- Records of os_ucenter_setting
-- ----------------------------

-- ----------------------------
-- Table structure for os_ucenter_user_link
-- ----------------------------
DROP TABLE IF EXISTS `os_ucenter_user_link`;
CREATE TABLE `os_ucenter_user_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `uc_uid` int(11) NOT NULL,
  `uc_username` varchar(50) NOT NULL,
  `uc_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_ucenter_user_link
-- ----------------------------

-- ----------------------------
-- Table structure for os_url
-- ----------------------------
DROP TABLE IF EXISTS `os_url`;
CREATE TABLE `os_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接唯一标识',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `short` char(100) NOT NULL DEFAULT '' COMMENT '短网址',
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='链接表';

-- ----------------------------
-- Records of os_url
-- ----------------------------

-- ----------------------------
-- Table structure for os_user_config
-- ----------------------------
DROP TABLE IF EXISTS `os_user_config`;
CREATE TABLE `os_user_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `model` varchar(30) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户配置信息表';

-- ----------------------------
-- Records of os_user_config
-- ----------------------------

-- ----------------------------
-- Table structure for os_user_nav
-- ----------------------------
DROP TABLE IF EXISTS `os_user_nav`;
CREATE TABLE `os_user_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `color` varchar(30) NOT NULL,
  `band_color` varchar(30) NOT NULL,
  `band_text` varchar(30) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_user_nav
-- ----------------------------
INSERT INTO `os_user_nav` VALUES ('1', '个人主页', 'ucenter/Index/index', '0', '0', '0', '1', '0', '', '', '', '');
INSERT INTO `os_user_nav` VALUES ('2', '消息中心', 'ucenter/message/message', '0', '0', '0', '1', '0', '', '', '', '');
INSERT INTO `os_user_nav` VALUES ('3', '我的收藏', 'ucenter/Collection/index', '0', '0', '0', '1', '0', '', '', '', '');
INSERT INTO `os_user_nav` VALUES ('4', '我的头衔', 'ucenter/Index/rank', '0', '0', '0', '1', '0', '', '', '', '');

-- ----------------------------
-- Table structure for os_user_role
-- ----------------------------
DROP TABLE IF EXISTS `os_user_role`;
CREATE TABLE `os_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '2：未审核，1:启用，0：禁用，-1：删除',
  `step` varchar(50) NOT NULL COMMENT '记录当前执行步骤',
  `init` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否初始化',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户角色关联';

-- ----------------------------
-- Records of os_user_role
-- ----------------------------
INSERT INTO `os_user_role` VALUES ('1', '1', '1', '1', 'finish', '1');
INSERT INTO `os_user_role` VALUES ('3', '101', '1', '1', 'finish', '1');
INSERT INTO `os_user_role` VALUES ('4', '102', '1', '1', 'finish', '1');
INSERT INTO `os_user_role` VALUES ('5', '103', '0', '1', 'change_avatar', '1');
INSERT INTO `os_user_role` VALUES ('6', '104', '1', '1', 'change_avatar', '1');

-- ----------------------------
-- Table structure for os_user_tag
-- ----------------------------
DROP TABLE IF EXISTS `os_user_tag`;
CREATE TABLE `os_user_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pid` int(11) NOT NULL,
  `sort` tinyint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='标签分类表';

-- ----------------------------
-- Records of os_user_tag
-- ----------------------------
INSERT INTO `os_user_tag` VALUES ('1', '开发平台', '1', '0', '0');
INSERT INTO `os_user_tag` VALUES ('2', 'PHP', '1', '1', '0');
INSERT INTO `os_user_tag` VALUES ('3', 'JavaScript', '1', '1', '1');
INSERT INTO `os_user_tag` VALUES ('4', 'HTML/CSS', '1', '1', '11');
INSERT INTO `os_user_tag` VALUES ('5', 'Java', '1', '1', '2');
INSERT INTO `os_user_tag` VALUES ('6', 'Android', '1', '1', '3');
INSERT INTO `os_user_tag` VALUES ('7', ' iOS/Objective-C', '1', '1', '4');
INSERT INTO `os_user_tag` VALUES ('8', 'Linux/Unix', '1', '1', '5');
INSERT INTO `os_user_tag` VALUES ('9', 'C/C++', '1', '1', '7');
INSERT INTO `os_user_tag` VALUES ('10', 'Python', '1', '1', '6');
INSERT INTO `os_user_tag` VALUES ('11', ' Ruby', '1', '1', '9');
INSERT INTO `os_user_tag` VALUES ('12', '.NET/C#', '1', '1', '8');
INSERT INTO `os_user_tag` VALUES ('13', 'Visual Basic', '1', '1', '14');
INSERT INTO `os_user_tag` VALUES ('14', 'Lua', '1', '1', '12');
INSERT INTO `os_user_tag` VALUES ('15', ' 其它', '1', '1', '15');
INSERT INTO `os_user_tag` VALUES ('16', 'Node.js', '1', '1', '10');
INSERT INTO `os_user_tag` VALUES ('17', 'HTML5', '1', '1', '11');
INSERT INTO `os_user_tag` VALUES ('18', 'golang ', '1', '1', '13');
INSERT INTO `os_user_tag` VALUES ('19', '专长领域', '1', '0', '0');
INSERT INTO `os_user_tag` VALUES ('20', 'WEB开发', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('21', '游戏开发', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('22', '手机软件开发', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('23', '桌面软件开发', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('24', '服务器端开发', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('25', '网页设计/UI/UED', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('26', '软件测试/QA', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('27', '软件开发管理', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('28', '运维/系统/网络管理', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('29', 'DBA/数据库', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('30', '网站运营/站长', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('31', '人事招聘', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('32', 'CTO/CEO/CXO', '1', '19', '0');
INSERT INTO `os_user_tag` VALUES ('33', '其它领域', '1', '19', '0');

-- ----------------------------
-- Table structure for os_user_tag_link
-- ----------------------------
DROP TABLE IF EXISTS `os_user_tag_link`;
CREATE TABLE `os_user_tag_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `tags` varchar(200) NOT NULL COMMENT '标签ids',
  `job` varchar(255) DEFAULT NULL COMMENT '职位角色',
  `work_years` varchar(255) DEFAULT NULL,
  `number_1` tinyint(1) DEFAULT '0',
  `number_2` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户标签关联表';

-- ----------------------------
-- Records of os_user_tag_link
-- ----------------------------
INSERT INTO `os_user_tag_link` VALUES ('3', '101', '[2],[3],[4],[8],[16],[20],[24],[30]', '高级程序员', '3 年', '5', '3');

-- ----------------------------
-- Table structure for os_user_token
-- ----------------------------
DROP TABLE IF EXISTS `os_user_token`;
CREATE TABLE `os_user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_user_token
-- ----------------------------
INSERT INTO `os_user_token` VALUES ('1', '1', 'txHFuSIjDlE9hTiXYZV42ocqmQLfRkNaKeBbsdCz', '1476278919');
INSERT INTO `os_user_token` VALUES ('2', '101', 'pSVuBIUtjRDMOPmqdsn4alYH5vLyNrFzXg2h9Jwo', '1488162834');

-- ----------------------------
-- Table structure for os_verify
-- ----------------------------
DROP TABLE IF EXISTS `os_verify`;
CREATE TABLE `os_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `account` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `verify` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_verify
-- ----------------------------

-- ----------------------------
-- Table structure for os_version
-- ----------------------------
DROP TABLE IF EXISTS `os_version`;
CREATE TABLE `os_version` (
  `title` varchar(50) NOT NULL COMMENT '版本名',
  `create_time` int(11) NOT NULL COMMENT '发布时间',
  `update_time` int(11) NOT NULL COMMENT '更新的时间',
  `log` text NOT NULL COMMENT '更新日志',
  `url` varchar(150) NOT NULL COMMENT '链接到的远程文章',
  `number` int(11) NOT NULL COMMENT '序列号，一般用日期数字标示',
  `name` varchar(50) NOT NULL COMMENT '版本号',
  `is_current` tinyint(4) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `id` (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='自动更新表';

-- ----------------------------
-- Records of os_version
-- ----------------------------
INSERT INTO `os_version` VALUES ('开发者预览版', '1431651600', '1434503121', '暂无', 'http://www.opensns.cn/article/16_200.html', '20150515', '2.0.0', '0');
INSERT INTO `os_version` VALUES ('beta版', '1432332000', '1434503126', '暂无', 'http://www.opensns.cn/article/17.html', '20150602', '2.0.5', '0');
INSERT INTO `os_version` VALUES ('RC版', '1434502800', '1434502800', '* 【新增】新增搜索框，但未完成搜索功能。\r\n* 【新增】安装模块的时候，如果模块的前台entry为空，则不出现添加导航功能\r\n* 【新增】新增获取用户全部积分方法\r\n* 【新增】实现自动更新文件覆盖\r\n* 【新增】新增本地比较\r\n* 【新增】新增本地文件比较\r\n* 【新增】完成自动升级第一步\r\n* 【新增】开发者工具\r\n* 【新增】自动升级的版本确认\r\n* 【新增】新增积分日志。用于记录积分的操作。以及调用方法\r\n* 【新增】完成自动升级最后一步\r\n* 【新增】新增数据库导入功能\r\n* 【新增】活动编辑器加入附件功能\r\n* 【新增】广告和广告位插件\r\n* 【新增】支持在线更新手动下载\r\n* 【新增】短信接口提示服务商\r\n* 【新增】configbuilder支持单文件上传\r\n* 【新增】新增多文件上传插件\r\n* 【新增】资讯、论坛中加入代码高亮 同时修复高亮后代一行码过长bug\r\n* 【新增】新增后台新版本监测\r\n* 【新增】论坛后台分类、板块管理页面\r\n* 【新增】后台自动更新模板\r\n* 【新增】论坛加入首页调用\r\n* 【新增】实现后台自动安装\r\n* 【新增】新增插件的在线安装\r\n* 【新增】新增用户积分及行为的前台显示。\r\n* 【新增】文章模块\r\n* 【新增】支持主题在线安装\r\n* 【新增】新增对token的验证反馈\r\n* 【新增】后台消息群发\r\n* 【新增】支持后台安装的跳转\r\n* 【新增】模块在安装的时候支持自动添加导航栏\r\n\r\n\r\n* 【调整】完全禁用活动二级分类\r\n* 【修改】伴随AdminListBuilder的清空和彻底删除修改\r\n* 【修复】修复微博清空回收站。\r\n* 【修复】【系统】系统-》网站设置-》用户设置中，新注册的用户发布微博到网站中的功能尚未实现，是否先屏蔽\r\n* 【调整】调整微博源微博变量名。\r\n* 【修复】【活动】活动详情页的样式稍作调整，报名按键和文字太靠近\r\n* 【修复】还原clear功能\r\n* 【修复】修复转发的提示错误\r\n* 【调整】调整微博变量名称\r\n* 【调整】调整会员展示头部的间距\r\n* 【修改】积分模型修改\r\n* 【修复】用户投稿时，未审核通过仍能分享到微博，其他用户可以通过微博访问该文章内容。但是资讯搜索时无该文章\r\n* 【修改】广告位置去掉微店首页\r\n* 【修改】修改编辑器保存间隔\r\n* 【修复】修复首页展示的实效项目\r\n* 【修复】修复【查看积分】个人设置中查看积分时，每天显示用户当前的等级\r\n* 【修复】修复论坛权限bug\r\n* 【调整】在后台编辑活动分类的时候，父分类不显示二级的\r\n* 【修复】修复新增用户行为里，为系统的不显示的问题。\r\n* 【调整】调整后台微博评论的排序\r\n* 【修复】修复后台群组编辑添加错误\r\n* 【修复】修复微博回收站无法彻底删除的bug\r\n* 【调整】用户行为默认展示全部，【用户行为】用户-》用户行为中，在系统模块下新增了用户行为，只显示9条行为，其他的不显示，也无法翻页\r\n* 【修复】首页链接错误\r\n* 【修复】修复注册上传头像错位\r\n* 【调整】调整升级进度计算方式。\r\n* 【修改】移除用户的不缓存字段\r\n* 【移除】移除icons_html无用变量\r\n* 【修复】修复问答编辑器ctrl+enter错误\r\n* 【修复】默认广告位配置\r\n* 【修改】修改积分缓存清理方法。支持多用户多类型\r\n* 【修改】修改清除积分缓存方法\r\n* 【修改】修改添加行为后清除积分和等级缓存\r\n* 【调整】调整云市场的链接\r\n* 【修复】修复自动更新提示\r\n* 【升级包】打包自动升级部分\r\n* 【修复】修正自动更新完成的提示文字\r\n* 【修改】修改游客@用户的情况\r\n* 【修改】在用户行为中，加上新增的积分规则的列标题\r\n* 【修改】修改注册时发送两条消息的bug\r\n* 【修改】修改消息提示\r\n* 【修复】修复个人主页粉丝和关注的错位\r\n* 【修复】补上重置用户密码的权限\r\n* 【修复】修复后台错误提示页面\r\n* 【修改】修改sourse\r\n* 【修改】修改adminconfig 以及本地评论调用\r\n* 【优化】给getPagination()和Model中getPage()增加一个rollPage参数，控制分页栏每页显示的页数\r\n* 【调整】资讯编辑器宽度调整到和展示页相同宽度\r\n* 【调整】活动编辑器宽度调整为和页面差不多宽\r\n* 【修改】修改微博插件额外参数过滤调用\r\n* 【修改】op.php\r\n* 【修复】修复上传文件无法保存的问题\r\n* 【修复】单文件上传没有文件时不显示删除按钮\r\n* 【调整】调整自动升级\r\n* 【修复】修复关注可以通过get的方式的细节。禁止get关注\r\n* 【修复】修复资讯内容展示bug\r\n* 【修复】论坛bug修复及后台分类、板块优化\r\n* 【添加】论坛漏加入版本库的文件加入\r\n* 【修复】主题安装bug修复\r\n* 【修复】论坛改进\r\n* 【修复】修复模块安装时的权限问题\r\n* 【修复】修复默认权限出错的时候导致所有权限丢失。\r\n* 【修复】修复注册和登陆的链接地址\r\n* 【修复】修复二级导航样式错误\r\n* 【修改】修改注释\r\n* 【修复】修复score个人信息出不来。\r\n* 【修复】修复用户身份设置样式bug\r\n* 【添加】论坛行为权限限制\r\n* 【调整】调整提示文字\r\n* 【修复】修复导航栏样式问题\r\n* 【修复】修复次级导航样式\r\n* 【修复】修复部分安装Bug\r\n* 【修改】消息修改\r\n* 【修改】 签到插件修改\r\n* 【修复】后台邀请码列表分页bug\r\n* 【修改】修改签到，支持按行为签到\r\n* 【修改】安装包修改。消息表\r\n* 【修改】修改因调整sendmessage方法而错误的其他方法\r\n* 【修改】未登录的时候资讯仍然可以被分享，但是分享出来的微博是无用户的。\r\n* 【修改】没有权限的时候直接在群组的导航栏里就提醒没有权限，而不是到提交表单才提示。\r\n* 【修复】修复个人主页微博点赞\r\n* 【修改】安装文件sql\r\n* 【调整】调整云市场\r\n* 【修复】修复样式问题\r\n* 【调整】在底部加上官网链接\r\n* 【修复】模板解析bug修复\r\n* 【修复】主题解析错误修复\r\n* 【修改】修改消息提示信息\r\n* 【修复】资讯审核文章时，审核失败内容填写时超过100个字仍能发表成功\r\n* 【新增】用户行为新增过滤\r\n* 【调整】用户前台积分规则按模块分组\r\n* 【修改】修改 发送消息函数，并修改调用的参数\r\n* 【修改】修改编辑器视频\r\n* 【修改】过滤微博视频flash地址发布。群组视频过滤\r\n* 【调整】调整二级导航样式\r\n* 【修改】修改配置\r\n* 【调整】调整模块未安装时的文字提示，更加友善。', 'http://v2.opensns.cn/index.php?s=/news/index/detail/id/86.html', '20150617', '2.1.0', '0');
INSERT INTO `os_version` VALUES ('RC sp1，可更新', '1434610054', '0', '* 【调整】完善后台注册配置的文字提示\r\n* 【修改】修改 addons_url 函数。增加显示域名参数\r\n* 【修改】修改本地评论\r\n* 【修改】修改ueditor获取视频swf链接', '', '20150618', '2.1.1', '0');
INSERT INTO `os_version` VALUES ('2.2.0开发版', '1436419697', '1436419697', '* 【打包】补充在线升级的menu\r\n* 【新增】在安装的时候自动写入token\r\n* 【改进】在获取模块升级信息的时候，忽略掉没有token的模块\r\n* 【修复】修复论坛帖子回复的用户头衔不显示的问题\r\n* 【修复】修复自动升级BUG\r\n* 【新增】加入扩展升级最后一步同步版本号\r\n* 【新增】加入代码升级\r\n* 【修改】修改block内嵌block标签的错误\r\n* 【修改】站外分享插件统一调用common->widget->ShareWidget.class.php\r\n* 【修改】增强form_check.js验证规则\r\n* 【新增】新增扩展自动更新第三步入口\r\n* 【修复】修复文字头衔出不来的问题\r\n* 【新增】加入取缩略图的简写函数thumb\r\n* 【新增】后台注册用户统计加入星期提示\r\n* 【新增】支持扩展自动升级比对代码\r\n* 【新增】新增扩展自动更新第一步\r\n* 【调整】调整安装提示文字\r\n* 【新增】后台自动更新支持，支持进入到自动更新页面\r\n* 【调整】调整新版本获取方式，兼容性更好，解决了前台报错的问题。\r\n* 【修复】listbuilder的右侧过滤和查询不能同时生效，需要能够同时生效\r\n* 【完成】伪静态\r\n* 【修复】分享带中文url进行urlencode（）和urldecode（），避免伪静态自动解码\r\n* 【修复】严谨url路由解析方式\r\n* 【修改】群组内帖子标题换行时错位的bug\r\n* 【修改】修改微博话题权限管理\r\n* 【添加】注释\r\n* 【修改】修改上传图片提示信息\r\n* 【修改】修改判断上传驱动插件函数\r\n* 【新增】群组伪静态规则\r\n* 【修改】判断上传驱动插件是否存在\r\n* 【新增】开源版伪静态规则\r\n* 【修改】修改附件以及图片上传和渲染机制\r\n* 【调整】微博个人部分的头衔展示\r\n* 【调整】【头衔】各模块头衔调用调整为最新的方式\r\n* 【新增】新增资讯首页\r\n* 【新增】自动升级加入提示\r\n* 【路由配置】\r\n* 【修复】用户升级身份bug修复\r\n* 【修改】伪静态增强判断严谨性\r\n* 【调整】新增UserRankWidget，统一用户头衔展示\r\n* 【新增】对curl的错误信息判断\r\n* 【新增】新增公共排版样式\r\n* 【修复】修复群组发现分页\r\n* 【修复】合并后台配置bug修复\r\n* 【模块】区分本地和远程模块\r\n* 【新增】新增模块样式\r\n* 【调整】调整模块管理页面样式\r\n* 【修改】头衔新增文字头衔+Admin/Builder/AdminConfigBuilder.class.php增加颜色选择器keyColor()\r\n* 【修复】头衔审核的权限节点丢失+群组、SEO Think\\Controller:doClear方法不存在！\r\n* 【修复】审核头衔的时候微博同步的显示用户昵称而不是用户名\r\n* 【修改】用户名、昵称长度修改为后台配置\r\n* 【优化】如果系统设置新用户注册时关注人，结果信息提示只是“关注了你”，应该是“系统推荐的XX关注了\r\n* 【修复】活动列表页面报名按钮丢失\r\n* 【修改】修改登录提示\r\n* 【修改】本地评论游客能删除游客评论的bug\r\n* 【修改】修改上传表情包提示\r\n* 【修改】修改论坛。资讯后台修改提交过滤\r\n* 【修复】1.在用户标签列表分类回收站 彻底删除用户标签删除不了，提示Think\\Controller:doClear方法不存在！\r\n2、用户行为,发布活动日志不会显示?\r\n* 【修复】修复了数据表配置bug\r\n* 【修复】微博隐藏置顶cookie时间session->1年\r\n* 【修改】群发消息调用函数\r\n* 【新增】core成为系统公共模块，供权限节点等挂载\r\n* 【新增】【模块管理】如果模块后台入口为空，则不显示在后台的左侧菜单栏中\r\n* 【调整】调整快捷登陆窗口的验证码大小\r\n* 【修复】修复数据表内容导出时的特殊字符被textarea转义的错误\r\n* 【修改】修改论坛。专辑。资讯 视频过滤\r\n* 【修复】修复array_diff在linux服务器执行结果不同。\r\n* 【修复】编辑器内容多出好多br\r\n* 【修复】修复微博话题主持人无法编辑话题\r\n* 【修复】未审核角色登录bug\r\n* 【新增】新增自动更新时的文件权限检测，防止不够写入权限而无法覆盖文件\r\n* 【修改】修复腾讯视频无法抓取', '', '20150709', '2.2.0', '0');
INSERT INTO `os_version` VALUES ('V2正式版，升级过程中会丢失登陆，重新登录再升级一遍即可', '1437542458', '1437543468', '新增列表：\r\n\r\n* 【新增】为手机发送验证码添加倒计时。\r\n* 【新增】加入favicon\r\n* 【新增】后台可以配置资讯的排序方式，更新时间还是创建时间或则查看量+每页展示条数\r\n* 【新增+修复】新增群组首页调用+论坛首页调用去除不存在论坛\r\n* 【新增】【优先级3】用户行为日志加入按UID搜索\r\n* 【新增】将手机短息服务商更改为插件，同时支持多家短信服务商\r\n* 【新增】给予其他用户管理权限后，希望能和超级管理员一样有一个后台入口 并更新安装包\r\n* 【新增】体验改进，聚合首页的微博模块中图片时，点击并不是当前页面放大，是打开一个网页展示\r\n* 【新增】支持Ucenter互联\r\n* 【新增】会员展示更名为找人，加入根据身份过滤\r\n* 【新增】排除掉Admin模块的伪静态，规则强制为3\r\n\r\n其他改动列表：\r\n\r\n* 【修复】修复Cloud自动升级的问题\r\n* 【修复】修复模块自动升级版本检测问题 \r\n* 【修复】修复自动升级文件夹创建BUG\r\n* 【修复】用户标签，在后台禁用或者删除后，清理缓存，在前台个人设置中仍能找到该标签bug修复。小名片头衔bug修复\r\n* 【修复】头衔申请bug修复 \r\n* 【修改】资讯中将二级分类禁用后，前台仍能看到。\r\n* 【修改】用户改名后，微博显示的用户名改了，但是@时的用户名没有及时修改。存在缓存。（高亮效果也是，存在缓存）\r\n* 【修改】注册时头像上传的样式有错\r\n* 【修复】微博中后台回复被删除或者禁用后，前台计算微博条数时，仍计入\r\n* 【修改】设置样式\r\n* 【修改】用户行为筛选之后翻到第二页仍然没有筛选效果\r\n* 【修改】把聊天移到导航栏\r\n* 【修复】修复找回密码地址错误\r\n* 【修改】伪静态设置提示修改\r\n* 【修改】修改发布微博。评论微博默认积分规则\r\n* 【修复】资讯列表页分类展示bug修复\r\n* 【修改】修改注册时扩展资料无法跳过问题\r\n* 【修改】修改同步登录远程图片上传到云服务器\r\n* 【修改】修改群组审核通知。修改群组最大创建限制。\r\n* 【修改】修改同步登录\r\n* 【调整】调整表情新增的文字提示\r\n* 【修改】判断session前缀，修改后台session前缀\r\n* 【修复】伪静态模式下上传头像，返回路径使用绝对路径\r\n* 【修复】首页资讯展示不出作者bug修复\r\n* 【修复】修复找人面板数据处理bug\r\n* 【修复】在注册页面点登陆按钮进行登陆时出现重定向循环错误\r\n* 【修复】修复模块编辑的一个清缓存的错误\r\n* 【优化】找人后台可管理显示身份tab\r\n* 【修复】修复Linux无法进行代码覆盖的问题\r\n* 【修复】修复版块缓存问题\r\n* 【修改】修改邮箱账户正则匹配\r\n* 【还原】随便看看数量后台控制\r\n* 【还原】随便看看展示数量还原为30个\r\n* 【修复】论坛随便看看无内容+【新增】后台可以控制每页显示的论坛帖子数\r\n* 【还原】用户名昵称验证被覆盖，现在还原\r\n* 【修改】用户中心邮箱验证BUG\r\n* 【修复】伪静态文件内容补全\r\n* 【修改】论坛获取版主等的id方法', 'http://v2.opensns.cn/news/detail_151.html', '20150722', '2.3.0', '0');
INSERT INTO `os_version` VALUES ('2.4.0开发版', '1439179494', '1439179494', '* 【调整】在文件解压失败的时候终止升级程序并报错。\r\n* 【版本库】版本库内新增文件\r\n* 【修改】Ueditor新增粘贴word图片的功能。\r\n* 【调整】去除个人主页的邮箱显示\r\n* 【修复】修复安装包错误\r\n* 【修复】二级域名下论坛发帖同步微博图片路径bug修复\r\n* 【修复】用户注册bug\r\n* 【调整】调整清缓存的样式\r\n* 【调整】修复下载的地址\r\n* 【新增】新增模块编辑的Token写入\r\n* 【修复】修复取图片修复路径的时候的https开头判断\r\n* 【调整】模块编辑加入写token\r\n* 【调整】调整友情链接插件样式\r\n* 【修复】修复ucenterMember的require_once路径bug\r\n* 【新增】后台设置用户身份\r\n* 【修复】修复设置个人标签tab无法选中\r\n* 【调整】加入权限的修复\r\n* 【改进】优化模块安装机制，更加稳定\r\n* 【修复】用户注册步骤标签选择跳过失败\r\n* 【修复】头衔申请时，连续点两次，申请了两次\r\n* 【修复】修复注册bug\r\n* 【修改】后台新增头衔时，没有图片的时候默认不出现或者是提示无；\r\n* 【修复】积分规则中，规则中的行为类型无论选的是用户还行系统，编辑是都会展示是系统\r\n* 【修复】身份扩展资料bug修复\r\n* 【修复】扩展字段二级类型修复\r\n* 【调整】禁用后台隐藏模块菜单\r\n* 【调整】调整支持插件\r\n* 【优化】增加标签面板最大高度设置，超过部分出现显示、隐藏按钮\r\n* 【修复】缩小搜索按钮宽度\r\n* 【修复】修复头衔的显示\r\n* 【修复】js cookie 前缀 调用后台配置值\r\n* 【新增】自动升级clean_cache()\r\n* 【修复】js cookie增加默认前缀获取后台配置项\r\n* 【修复】头衔修改bug修复\r\n* 【新增】新增函数 home_addons_url\r\n* 【修复】修复自动升级权限问题', '', '20150810', '2.4.0', '0');
INSERT INTO `os_version` VALUES ('2.4.1 远程图片url修复', '1439364001', '1439364001', '* 【修复】修复图片无法显示的问题\r\n* 【修复】修复图片url判断\r\n* 【修复】修复积分商城排版错位问题\r\n* 【修复】zclip插件\r\n* 【修复】修复Ueditor样式错误\r\n* 【修复】复制功能js相对路径bug\r\n* 【修复】修复聊天默认无图和小红点无法消除的bug\r\n* 【修复】修复消息的用户列表的分页', '', '20150812', '2.4.1', '0');
INSERT INTO `os_version` VALUES ('2.4.5，点此下载文章中的附件覆盖升级。', '1440142811', '1440142811', '* 【修复】修复表情大小写问题\r\n* 【修复】修复火狐图标问题\r\n* 【修复】修复部分主机下无法安装的Bug\r\n* 【修复】修复二级导航错位\r\n* 【修复】修复论坛无法删除其他人的帖子的bug\r\n* 【修改】加入系统信息\r\n* 【修复】修复首页不受皮肤插件影响的BUG\r\n* 【修复】初始化没身份用户时过滤掉被删除、禁用的身份\r\n* 【修复】修复插件和主题无法安装的问题\r\n* 【优化】在无session写入权限的时候改进tmp，自动创建\r\n* 【修复】修复SEO等列表页面，文字过长的时候导致显示不全的问题，至少兼容1366px宽\r\n* 【优化】颜色选择用户使用优化\r\n* 【修复】builder颜色选择默认颜色bug修复\r\n* 【修复】排序不能选择bug修复\r\n* 【修改】uc登录时的bug\r\n* 【新增】新增admin.php管理入口\r\n* 【修复】修复论坛搜索展示错误的问题\r\n* 【修复】修复图片无法显示的问题\r\n* 【修复】修复图片url判断\r\n* 【修复】修复Ueditor样式错误\r\n* 【修复】修复聊天默认无图和小红点无法消除的bug\r\n* 【修复】修复消息的用户列表的分页', 'http://os.opensns.cn/news/detail_208.html', '20150821', '2.4.5', '0');
INSERT INTO `os_version` VALUES ('2.5.0  多语者', '1443575463', '1443575463', '* 【补充】补充Expression文件夹\r\n\r\n* 【新增】新增话题链接表\r\n\r\n* 【调整】调整微博发布\r\n\r\n* 【修复】修复群组首页挂载的群组连接错误\r\n\r\n* 【新增】新增topic的表\r\n\r\n* 【新增】支持restful\r\n\r\n* 【修复】修复同步登陆伪静态\r\n\r\n* 【修复】修复论坛handleAt\r\n\r\n* 【修复】在回复微博的时候显示了备注昵称，在本地评论的时候显示了备注昵称，改为真实昵称。\r\n\r\n* 【修复】修复小名片自己也显示关注。\r\n\r\n* 【修复】修复资讯样式\r\n\r\n* 【新增】新增微博换行排版\r\n\r\n* 【新增】资讯来源加入外链\r\n\r\n* 【新增】增加对消息的轮询的配置\r\n\r\n* 【修复】修复专辑的布局\r\n\r\n* 【修复】修复备注昵称错误\r\n\r\n* 【修复】修复签到显示昵称错误的问题。\r\n\r\n* 【新增】新增小名片原昵称显示\r\n\r\n* 【修复】修复推送\r\n\r\n* 【调整】调整小名片的显示\r\n\r\n* 【修复】修复用户列表用户更新不及时的问题\r\n\r\n* 【新增】增加钩子，完善update和install.sql\r\n\r\n* 【新增】增加对[at:uid]的解析\r\n\r\n* 【调整】调整at组件的输出\r\n\r\n* 【修复】修复用户列表用户更新不及时的问题\r\n\r\n* 【修复】修复微博评论列表昵称更新不及时\r\n\r\n* 【修复】修复昵称为空的情况\r\n\r\n* 【新增】补充签到和举报的中文翻译\r\n\r\n* 【新增】在小名片昵称右边加入 备注 入口\r\n\r\n* 【多语化】文章、专辑、论坛、群组\r\n\r\n* 【修复】修复群组导航栏样式错位\r\n\r\n* 【新增】补充SEO设置。\r\n\r\n* 【多语化】论坛、文章、专辑、群组\r\n\r\n* 【多语化】找人&资讯\r\n\r\n* 【修改】各模块多语化\r\n\r\n* 【改进】在身份设置中加入一个取消选中的选项\r\n\r\n* 【改进】群发用户列表 加入 用户搜索功能\r\n\r\n* 【BUG】后台的导航部分设置无效\r\n\r\n* 【修复】修复云市场模块目录的URL问题\r\n\r\n* 【设计】同步登陆插件在后台可以设置初始身份ID\r\n\r\n* 【改进】群组样式错位\r\n\r\n* 【BUG】设置文字头衔；但是在身份，绑定头衔处，出现一个图片位置，显示无图\r\n\r\n* 【修复】修复seo website_name无效的问题\r\n\r\n* 【修复】地址加上http://\r\n\r\n* 【修复】伪静态后404缺少bug修复\r\n\r\n* 【新增】SEO支持变量的提示，对SEO进行模块分类，补充大量SEO规则\r\n\r\n* 【新增】加入多语支持\r\n\r\n* 【修复】修复后台U函数生成前台地址bug\r\n\r\n* 【调整】调整提示文字\r\n\r\n* 【修复】修复论坛同步到微博的图片重复\r\n\r\n* 【修复】复制功能路径修复\r\n\r\n* 【BUG】在个人设置时无效，禁用的用户名和昵称仍能使用\r\n\r\n* 【bug】火狐下聊天样式有错\r\n\r\n* 【修复】修复聊天的错误\r\n\r\n* 【改进】积分规则列表列出积分\r\n\r\n* 【改进】手机验证加入170等其他的开头方式\r\n\r\n* 【修复】修复对多超级管理员的时候的支持\r\n\r\n* 【BUG】论坛楼中楼回复中的头衔显示错误', 'http://os.opensns.cn/news/detail_250.html', '20150930', '2.5.0', '0');
INSERT INTO `os_version` VALUES ('2.5.1', '1444269949', '1444269949', '* 【BUG】二级菜单的菜单栏显示\r\n* 【修复】修复云市场的图片路径\r\n* 【L】微博（-admin-widget）\r\n* 【修改】修改积分类型为double\r\n* 【补充】补充Expression文件夹', '', '20151008', '2.5.1', '0');
INSERT INTO `os_version` VALUES ('2.6.0 ', '1446010231', '1446010231', '* 【新增】对敏感词的支持\r\n\r\n* 【新增】后台首页加入主程序版本号\r\n\r\n* 【修复】throw exception改成调用系统E()函数\r\n\r\n* 【修复】错误被屏蔽，显示白屏bug修复\r\n\r\n* 【修复】后台插件页面显示错误\r\n\r\n* 【修复】修复主题有新版本\r\n\r\n* 【新增】支持主题升级\r\n\r\n* 【修改】手机网页版密码找回\r\n\r\n* 【BUG】资讯详情页显示错位\r\n\r\n* 【修改】为广告位添加缓存\r\n\r\n* 【修改】修改更新sql文件 \r\n\r\n* 【修改】开启app_debug 模式下广告位没有广告提示广告位置名称\r\n\r\n* 【优化】安装的时候数据库信息错误提示人性化\r\n\r\n* 【修改】修改广告位置插件，广告位置自动添加。并可以与主题绑定\r\n\r\n* 【修复】微博首页问题修改版\r\n\r\n* 【修复】群组伪静态bug修复\r\n\r\n* 【修改】微博图片显示中文及其他\r\n\r\n* 【优化】增加用户列表对用户名、邮箱和手机号的显示\r\n\r\n* 【修改】微博图片长宽显示\r\n\r\n* 【调整】调整评论样式 \r\n\r\n* 【新增】新增权限判断相关函数\r\n\r\n* 【修改】微博图片显示\r\n\r\n* 【修复】修复自动升级模块的时候商品图片出不来的问题\r\n\r\n* 【修改】微博图片展示效果更改\r\n\r\n* 【修复】修复裁剪\r\n\r\n* 【修复】修复UploadBase64\r\n\r\n* 【优化】优化form_check.js,增加外部调用方法\r\n\r\n* 【BUG】首页找人模块标题显示\r\n\r\n* 【BUG】后台群组排序\r\n\r\n* 【BUG】积分商城图标显示\r\n\r\n* 【调整】调整群组同步微博的URL\r\n\r\n* 【BUG】菜单栏显示&群组微博自动同步显示\r\n\r\n* 【修复】修复云市场的图片路径\r\n\r\n* 【修改】修改积分类型为double\r\n\r\n* 【补充】补充Expression文件夹', 'http://os.opensns.cn/news/detail_287.html', '20151028', '2.6.0', '0');
INSERT INTO `os_version` VALUES ('2.6.1', '1446107625', '1446107625', '* 【版本库】移除Mob文件\r\n* 【修复】修复多处多语化错误\r\n* 【修复】修复拼写错误\r\n* 【修复】用户列表加入', '', '20151029', '2.6.1', '0');
INSERT INTO `os_version` VALUES ('2.6.2', '1446517979', '1446517979', '* 【修复】活动L\r\n* 【修复】邮箱注册提示信息以及period显示\r\n* 【优化】优化多图上传组件\r\n* 【优化】优化本地评论没内容的展示样式\r\n* 【L】修复followmodel\r\n* 【L】若干修复\r\n* 【修复】微博ucenter显示\r\n* 【修复】误删', '', '20151103', '2.6.2', '0');
INSERT INTO `os_version` VALUES ('2.7.0 广告牌', '1449040556', '1449040556', '* 【调整】将不必要的代码移入_system\r\n* 【新增】插件初始化钩子方法\r\n* 【优化】优化回到顶部\r\n* 【修复】T生成四级目录时去除default层\r\n* 【主题】增加调用接口\r\n* 【修改】模板增加临时调用方法\r\n* 【bug】电脑版用户在没登陆的状态下，看到的热门文章掉到最下面了\r\n* 【优化】调整模块广告位，采用新机制\r\n* 【修复】资讯bug修复\r\n* 【新增】支持轮播图排序\r\n* 【修复】IIS7+的伪静态配置文件去除多余的内容\r\n* 【修复】修复群组详情页编辑器报错\r\n* 【改进】改进keyCity\r\n* 【新增】支持直接从广告管理进入广告编辑\r\n* 【新增】加入广告排期查看\r\n* 【框架】升级后台ZUI框架\r\n* 【修复】修复用户组管理的文字错误\r\n* 【调整】调整默认主题样式\r\n* 【新增】支持listBuilder的width设置\r\n* 【新增】升级过也可以下载补丁\r\n* 【修复】后台错误的时候提示\r\n* 【修复】修复等级\r\n* 【修复】修复后台页面在小屏幕上，显示不全的bug\r\n* 【优化】优化广告位没内容时的占位表现形式\r\n* 【新增】积分日志加入搜索支持\r\n* 【修复】修复空的情况下，多图上传有空图\r\n* 【新增】后台积分日志管理\r\n* 【新增】微博我的喜欢功能\r\n* 【修复】群组图标和导航错误\r\n* 【新增】支持后台自定义用户导航\r\n* 【修复】微博详情页', 'http://os.opensns.cn/news/detail_321.html', '20151202', '2.7.0', '0');
INSERT INTO `os_version` VALUES ('2.7.1，请看更新日志，再更新，有额外操作', '1449107289', '1449107289', '升级到导入sql语句，1.点击执行，不会提示导入成功，但实际已经执行;2.点跳过，进入下一步\r\n* 【修复】修复install安装引导\r\n* 【修复】修复提示窗组件\r\n* 【修复】修复addons初始化钩子错误\r\n* 【新增】后台开关IM功能\r\n* 【调整】调整钩子名称\r\n* 【调整】拆分导航栏样式\r\n* 【优化】默认不展示广告位工具条\r\n* 【修复】修复轮播排序\r\n* 【修复】修复语言、模块检测\r\n* 【多语化】专辑\r\n* 【修复】修复广告位错误\r\n* 【修复】修复模态弹窗', '', '20151203', '2.7.1', '0');
INSERT INTO `os_version` VALUES ('2.7.2', '1449628263', '1449628263', '* 【广告位】修复\r\n* 【修复】针对英文单词，无法按单词换行bug修复\r\n* 【优化】调整listBuilder的按钮颜色\r\n* 【多语】修复网站信息多语\r\n* 【新增】新增广告的时候，加入返回列表按钮\r\n* 【新增】新增Config—>buttonLink\r\n* 【修复】修复Builder表单提交错误\r\n* 【修复】修复Builder __SELF__ 变量问题\r\n* 【修复】修复AdminListBuilder的文字\r\n* 【修复】修复注册参数错误\r\n* 【修复】微博图\r\n* 【优化】微调样式\r\n* 【调整】关闭语言侦测\r\n* 【修复】修复install安装引导', '', '20151209', '2.7.2', '0');
INSERT INTO `os_version` VALUES ('2.7.5', '1450665739', '1450665739', '* 【修改】PC图片上传进度\r\n* 【多语】移除问答的语言\r\n* 【修复】修复语言函数不存在的bug\r\n* 【新增】获取user_config的函数\r\n* 【修改】PC密码找回。\r\n* 【修复】修复个人中心的语言包错误\r\n* 【新增/修改】手机网页版首页自定义，微博图片上传进度（未完成）\r\n* 【增加多种类型积分奖励。】\r\n* 【修改了虾米插件的js，增加了回车键搜索歌曲功能。】\r\n* 【修复】修复微博管理后台多语\r\n* 【新增】密码找回\r\n* 【新增】手机网页版密码找回。\r\n* 【增加签到积分奖励，后台可设置奖励的积分的类型和数值。】\r\n* 【修复】修复内容高度\r\n* 【修改】结果很简单，只是没想到---微博隐藏冲突\r\n* 【给商品和活动的站内分享增加了封面，增加了个人主页的聊天按钮。】\r\n* 【增加了活动页，论坛帖子和积分商城的商品页的站内微博分享。】\r\n* 【修复】微博置顶隐藏\r\n* 【bug】微博图片显示\r\n* 【修复】修复找人样式\r\n* 【修复】2.7.2话题字体颜色 和网站链接颜色是否不对应该是白色\r\n* 【增加了地区人数显示，修改地区字体，增加用户的地区标签】\r\n* 【提交漏交的area.html和mod_header_area.html】\r\n* 【增加了一个area.html和mod_header_area.html。在zh-cn.php中增加了\'地区标签找人\'，在_nav.html中增加了地区标签。增加了对地区显示的css样式。】', '', '20151221', '2.7.5', '0');
INSERT INTO `os_version` VALUES ('2.7.6', '1451972620', '1451972620', '* 【同步】同步商业版一些代码用于阿里悟空聊天\r\n* 【修复】修复thumb函数\r\n* 【修复】调整变量名\r\n* 【调整】加入全局的word-break\r\n* 【修复】邮箱注册提示页面多语言\r\n* 【改进】改进微博性能\r\n* 【优化】优化微博列表速度，添加新的缓存\r\n* 【修复】修复无法检测到新的升级\r\n* 【修改】php输出js语言包\r\n* 【修复】修复get_nickname\r\n* 【修复】修复微博广告位\r\n* 【新增】兼容红包插件\r\n* 【改进】改进函数性能query_user，性能提高10倍\r\n* 【修复】修复JS语言', '', '20160105', '2.7.6', '0');
INSERT INTO `os_version` VALUES ('2.7.7', '1454634305', '1454634305', '* 【修改】表情收藏\r\n* 【修改】签到插件增加积分代码优化\r\n* 【修改】签到插件代码优化\r\n* 【新增】表情收藏功能\r\n* 【修改】修改数据表字段\r\n* 【新增】后台表情上传和分页。\r\n* 【新增】新增ListBuilder tips，用于在页面上上显示提示信息\r\n* 【修复】修复搜索页用户小名片不显示，修复个人主页地址错误\r\n* 【修改】新增个人中心默认看板\r\n* 【修复】微博图片\r\n* 【修改】将迁移帖子模板移到forum模块\r\n* 【修复】微博图片\r\n* 【修复】修复昵称导致的502\r\n* 【修复】修复昵称获取错误\r\n* 【修复】修复at昵称错误\r\n* 【修复】修复了改掉表前缀的情况\r\n* 【修复】修复了改掉表前缀的情况下，全站昵称获取不到\r\n* 【修复】修复ActionLog页面\r\n* 【修复】个人中心bug修复\r\n* 【修改】修改同步登录插件，修复登录多次创建多个帐号的bug\r\n* 【修复】用户个人中心相关bug修复\r\n* 【修复】伪静态路由解析bug\r\n* 【修改】修复添加缓存之后所有插件失效的bug\r\n* 【修复】修复sendVerify\r\n* 【修改】修改发送验证码是输入验证码\r\n* 【优化】优化性能，防止注入\r\n* 【修复】后台登陆后前台身份没登陆bug修复\r\n* 【修复】身份错误提示错位bug修复\r\n* 【修复】登出js bug修复\r\n\r\n', '', '20160205', '2.7.7', '0');
INSERT INTO `os_version` VALUES ('2.7.8', '1459416230', '1459416230', '* 2.7.8\r\n* 【修改】用户组描述修改后权限配置丢失bug\r\n* 【修改】邮箱密码找回，邮箱不能为空\r\n* 【修改】签到详情页切换到今日签到时连续签到和累计签到不显示\r\n* 【修改】游客需要登录才能进行回复操作\r\n* 【修改】语言包里的注册提示\r\n* 【修改】\'我的收藏\'中增加群组帖子\r\n* 【修复】新增绑定手机号和邮箱\r\n* 【修改】默认表情禁止收藏\r\n* 【修改】注册时密码输入提示的完善\r\n* 【修改】设置用户的积分\r\n* 【修复】签到详情页右侧数据未显示\r\n* 【修复】表情收藏bug\r\n* 【修复】文字显示错误。\r\n* 【修改】增加个人中心默认看板\r\n* 【修改】表情收藏破图，自定义表情解析美化\r\n* 【修复】表情功能按钮美化\r\n* 【修复】补充homeIndex钩子给移动端入口插件\r\n* 【修改】表情收藏无法解析，默认启用，添加刷新问题\r\n* 【新增】表情分页，上传\r\n* 【修改】表情收藏\r\n', '', '20160331', '2.7.8', '0');
INSERT INTO `os_version` VALUES ('2.7.9', '1460453060', '1460453060', '* 【修改】聊天内容靠右BUG\r\n* 【修改】聊天内容靠左和切换聊天对象\r\n* 【修复】无法发起聊天bug\r\n* 【修改】返回顶部图片bug\r\n* 【修改】在搜索页面的个人信息展示文字头衔会被当做图片头衔使用\r\n* 【修复】友情链接，语言包等bug\r\n* 【修改】删除微博无提示\r\n* 【修改】返回顶部图片不显示\r\n', '', '20160412', '2.7.9', '0');
INSERT INTO `os_version` VALUES ('2.8.0', '1465981993', '1473087941', '【新增】手机访问电脑版网页时可以自动跳转到对应的手机版\r\n【修复】后台用户列表中用户被删除或禁用后，前台其他用户仍   然能在关注或粉丝列表中找到该用户\r\n【修复】邮箱注册时，激活链接提示激活失败\r\n【修复】用户名注册时，不填写用户名，只填写昵称和密码就可进入下一步\r\n【修复】后台无法修改昵称，一直提示错误\r\n【修复】登陆后台时，账号密码错误没有提示，一直显示正在登录\r\n【修复】邮箱注册时，60S验证后，再次提示验证时，提示语错误', '', '20160615', '2.8.0', '0');
INSERT INTO `os_version` VALUES ('2.8.1', '1467360219', '1473087997', '修复了上传组件的一个漏洞', '', '20160701', '2.8.1', '0');
INSERT INTO `os_version` VALUES ('2.8.2', '1467598649', '1473088043', '修复了图片无法上传的问题', '', '20160704', '2.8.2', '0');
INSERT INTO `os_version` VALUES ('3.1.0【文章链接】升级前请详细阅读链接的文章，有额外操作。', '1474200986', '1474270800', '* 【修复】无注册方式时无报错bug修复\r\n\r\n* 【修复】系统升级过程中bug修复\r\n\r\n* 【修复】默认使用会话列表样式3\r\n\r\n* 【修复】后台用户搜索没有搜索结果时没有提示的BUG\r\n\r\n* 【修复】后台微博基本设置文字错误\r\n\r\n* 【修复】发布微博字数限制BUG\r\n\r\n* 【修复】修复升级时出现的bug\r\n\r\n* 【修复】微博搜索页话题推荐bug修复\r\n\r\n* 【修复】后台左侧模块里二级菜单不显示BUG\r\n\r\n* 【修复】后台导航bug修复\r\n\r\n* 【调整】后台不调用语言包\r\n\r\n* 【修复】微博搜索页bug修复\r\n\r\n* 【修复】修复话题bug\r\n\r\n* 【修复】话题微博置顶bug修复\r\n\r\n* 【修复】本地图片上传时无法获取宽高bug修复\r\n\r\n* 【初始化】v3.1.0开原版\r\n\r\n* 【修复】转换粉丝数int2str函数bug\r\n\r\n* 【修复】会员展示设置数量大于总量时的bug\r\n\r\n* 【调整】会员展示的多排序值显示会员\r\n\r\n* 【新增】会员展示 不同排序值的推荐关注\r\n\r\n* 【新增】会员展示后台设置推荐关注\r\n\r\n* 【新增】会员展示后台增加好友推荐关注和随机推荐关注选项\r\n\r\n* 【调整】自定义表情的宽度和高度\r\n\r\n* 【删除】刚才新增的关注/取关功能\r\n\r\n* 【新增】会员展示的关注和取消关注\r\n\r\n* 【新增】找人的新人动态\r\n\r\n* 【新增】自定义表情支持七牛上传\r\n\r\n* 【新增】会员展示的推荐关注\r\n\r\n* 【调整】表情分页样式\r\n\r\n* 【调整】微博表情分页\r\n\r\n* 【修复】上传自定义表情bug\r\n\r\n* 【删除】dump缩略图\r\n\r\n* 【新增】新增邮箱、手机号可编辑功能\r\n\r\n* 【调整】美化链接图标\r\n\r\n* 【调整】微博热议话题和新人发言图标\r\n\r\n* 【调整】微博详情页样式\r\n\r\n* 【新增】新消息加标题闪动\r\n\r\n* 【修复】置顶隐藏时微博大图查看失败bug修复\r\n\r\n* 【修改】微博热门图标\r\n\r\n* 【新增】敏感词插件集成到V3开源版\r\n\r\n* 【调整】热门微博图标和位置调整\r\n\r\n* 【新增】点击评论按钮时，输入框自动获取焦点\r\n\r\n* 【调整】调整热门微博图标\r\n\r\n* 【新增】我的社群卡片扩展，当超过4个的时候出现向下箭头，点击展开全部的社群功能\r\n\r\n* 【新增】热门微博标记\r\n\r\n* 【调整】调整公告到达排序\r\n\r\n* 【调整】微博点赞评论转发操作的点击区域\r\n\r\n* 【调整】导航下拉菜单样式\r\n\r\n* 【新增】找人模块 增加头像ucard\r\n\r\n* 【调整】调整后台菜单获取，增加是否隐藏管理\r\n\r\n* 【调整】去除重复执行调用\r\n\r\n* 【修复】微博自定义表情无法上传bug\r\n\r\n* 【调整】导航下拉框样式\r\n\r\n* 【调整】图片宽高存入数据库\r\n\r\n* 【修复】后台用户邮箱和手机方式搜索BUG\r\n\r\n* 【调整】微博过滤的选择区域\r\n\r\n* 【调整】微博过滤的搜索图标样式\r\n\r\n* 【修复】图片管理排序bug修复\r\n\r\n* 【修复】修复函数多次定义问题\r\n\r\n* 【修复】按地区找人首页无数据bug\r\n\r\n* 【调整】找人模块 按地区找人\r\n\r\n* 【调整】微博过滤的搜索框样式\r\n\r\n* 【新增】删除七牛图片功能\r\n\r\n* 【新增】发布记忆功能\r\n\r\n* 【调整】找人模块 编译css\r\n\r\n* 【调整】发布微博时能同时插入表情和上传图片\r\n\r\n* 【新增】后台所有页面加入添加常用操作的按钮\r\n\r\n* 【调整】新版找人模块\r\n\r\n* 【调整】热门话题样式\r\n\r\n* 【调整】修改微博样式\r\n\r\n* 【调整】发布框样式\r\n\r\n* 【修复】微博过滤无效的bug\r\n\r\n* 【新增】微博过滤，未完成\r\n\r\n* 【新增】图片管理\r\n\r\n* 【修复】图片水印设置bug修复\r\n\r\n* 【调整】导航栏样式\r\n\r\n* 【调整】发布类型框样式\r\n\r\n* 【修复】转发消息模板选择错误bug修复\r\n\r\n* 【修复】后台导航管理设置图标错乱BUG\r\n\r\n* 【调整】调整微博缓存时间长度，4小时-》20分钟\r\n\r\n* 【修复】修复置顶微博发布时间显示bug\r\n\r\n* 【新增】图片水印兼容进系统中，并放到开源版\r\n\r\n* 【修复】删除微博后处理微博话题\r\n\r\n* 【调整】微博发布框样式\r\n\r\n* 【新增】找人的新人动态\r\n\r\n* 【修复】钩子编辑bug修复\r\n\r\n* 【修复】微博评论返回错误后仍提示评论成功bug修复\r\n\r\n* 【修复】渲染图片微博bug修复\r\n\r\n* 【修复】后台二级菜单多出空的分类BUG\r\n\r\n* 【新增】粉丝数量转化字符\r\n\r\n* 【新增】会员展示的推荐关注\r\n\r\n* 【修复】发布微博时@和topic消息渲染bug修复\r\n\r\n* 【修复】默认允许注册方式\r\n\r\n* 【调整】微博发布框样式\r\n\r\n* 【调整】提前载入微博，优化体验\r\n\r\n* 【修复】去除atwho中无用的调用Jquery.caret.map\r\n\r\n* 【修复】修复微博分页bug\r\n\r\n* 【修复】去除不存在文件的调用\r\n\r\n* 【修复】评论bug修复\r\n\r\n* 【修复】微博bug修复\r\n\r\n* 【修复】微博评论发布后显示bug修复\r\n\r\n* 【修复】微博缓存评论bug修复\r\n\r\n* 【调整】调整微博内容的时间渲染进而提高微博html缓存时间\r\n\r\n* 【修复】发布微博时没有执行相关替换\r\n\r\n* 【调整】调整单次载入微博数\r\n\r\n* 【调整】微博加html缓存，提高相应速度，测试\r\n\r\n* 【修复】微博评论列表隐藏在打开无法显示的bug\r\n\r\n* 【调整】后台session用db存储\r\n\r\n* 【调整】系统版本号调整为3.0.3\r\n\r\n* 【修复】删除错误SQL代码\r\n\r\n* 【调整】后台session取消存数据库去除\r\n\r\n* 【修复】系统安装sql中微博sql修复\r\n\r\n* 【调整】微博版本号升级为3.0.0\r\n\r\n* 【调整】登录页样式\r\n\r\n* 【修复】后台admin无法登录BUG\r\n\r\n* 【新增】微博圈子页面\r\n\r\n* 【修复】个人主页中资料头衔粉丝这三个默认开启\r\n\r\n* 【调整】前台分页样式错乱\r\n\r\n* 【调整】分页总页数为1时不弹出下拉\r\n\r\n* 【调整】默认分页的当前页去边框\r\n\r\n* 【调整】默认分页样式调整\r\n\r\n* 【调整】个人信息面板和个人主页样式调整\r\n\r\n* 【调整】新人发言图片和样式微调\r\n\r\n* 【修复】后台用户审核失败按钮点击提示非法操作BUG\r\n\r\n* 【调整】默认分页修改\r\n\r\n* 【新增】新人发言功能\r\n\r\n* 【修复】gitignore或略过多bug修复\r\n\r\n* 【调整】公告和微博话题样式微调\r\n\r\n* 【新增】微博右侧话题排行\r\n\r\n* 【修复】我的社群今日经验缺少积分类型判断\r\n\r\n* 【修复】话题bug修复\r\n\r\n* 【调整】微博话题功能优化\r\n\r\n* 【修复】话题转移bug修复\r\n\r\n* 【调整】微博头像取128×128\r\n\r\n* 【调整】话题转移功能调整\r\n\r\n* 【修复】发布公告的链接不自动增加http://\r\n\r\n* 【修复】微博头像取64×64\r\n\r\n* 【修复】话题转移bug修复\r\n\r\n* 【修复】公告升级缺少数据库更新bug\r\n\r\n* 【调整】调整话题转移\r\n\r\n* 【调整】微博上关注按钮绑定事件改成函数\r\n\r\n* 【调整】v2话题转移到v3改为长连接方式\r\n\r\n* 【新增】话题转移功能\r\n\r\n* 【调整】微博话题调整\r\n\r\n* 【调整】话题设计优化——前台完成、后台未完成\r\n\r\n* 【修复】loading不展示bug修复\r\n\r\n* 【调整】个人主页样式\r\n\r\n* 【修复】个人信息面板微博数无法正确显示的bug\r\n\r\n* 【修复】后台菜单路径报错\r\n\r\n* 【修复】微博列表关注按钮失效的bug\r\n\r\n* 【修复】修复剩余经验错位\r\n\r\n* 【新增】我的社群今日经验渲染以及做缓存\r\n\r\n* 【调整】更新和编译css\r\n\r\n* 【修改】我的社群面板无法判断是否签到的BUG\r\n\r\n* 【修复】排行榜个人排名缓存BUG\r\n\r\n* 【调整】我的社群面板增加是否登录的判断\r\n\r\n* 【调整】调整404页面的位置\r\n\r\n* 【修复】消息连续操作导致样式冲突bug修复\r\n\r\n* 【调整】去除用户名注册方式\r\n\r\n* 【修复】会话重载bug修复\r\n\r\n* 【调整】调整会话样式和布局\r\n\r\n* 【修复】修复推荐话题错位\r\n\r\n* 【调整】消息框样式重新布局\r\n\r\n* 【新增】loading8种样式扩展\r\n\r\n* 【调整】友链插件改为widget调用\r\n\r\n* 【新增】微博右侧我的社群面板\r\n\r\n* 【修复】后台清理缓存不能用\r\n\r\n* 【修复】模态框赋tag丢失bug修复\r\n\r\n* 【修复】修复签到日历不显示bug\r\n\r\n* 【修复】会话图标bug修复\r\n\r\n* 【调整】微博详情样式\r\n\r\n* 【调整】后台左侧子导航样式修改\r\n\r\n* 【修复】message——logo模块中不显示bug修复\r\n\r\n* 【修复】重新编译css\r\n\r\n* 【修复】v2-》v3bug修复\r\n\r\n* 【调整】后台左侧子导航一直展示\r\n\r\n* 【修复】兼容v2调用\r\n\r\n* 【调整】调整单个微博from左侧块长度\r\n\r\n* 【调整】个人信息面板和签到日历\r\n\r\n* 【修复】更新bug修复\r\n\r\n* 【新增】鼠标悬停微博时未关注的人显示关注按钮\r\n\r\n* 【调整】后台重置粉丝数去掉执行判断的条件\r\n\r\n* 【调整】导航也页脚样式\r\n\r\n* 【调整】全站搜索关键词参数传递问题\r\n\r\n* 【调整】后台全站搜索模块可配置\r\n\r\n* 【修复】后台模块管理图标不兼容\r\n\r\n* 【修复】sql更新文件\r\n\r\n* 【新增】全站搜索模块后台可编辑\r\n\r\n* 【调整】签到日历样式\r\n\r\n* 【调整】注册时验证码调整\r\n\r\n* 【修复】邮箱注册激活失败BUG\r\n\r\n* 【调整】全站搜索页面样式调整\r\n\r\n* 【新增】全站搜索加入积分商城\r\n\r\n* 【调整】邀请码类型有效时长做判断\r\n\r\n* 【修改】v3版本号改为3.0.1\r\n\r\n* 【修改】默认邀请码有效期修改\r\n\r\n* 【修复】session表前缀写死bug修复\r\n\r\n* 【调整】注册时验证码的修改\r\n\r\n* 【新增】全站搜索加入群组、专辑、资讯\r\n\r\n* 【调整】首页图片更换\r\n\r\n* 【新增】后台增加重置粉丝数的按钮\r\n\r\n* 【调整】发布微博插入表情和上传图片调整\r\n\r\n* 【调整】v3-beta后小问题调整\r\n\r\n* 【调整】个人主页样式\r\n\r\n* 【调整】注册时只出现一个验证码\r\n\r\n* 【修复】普通注册时缺少验证码\r\n\r\n* 【修复】首个用户执行bug修复\r\n\r\n* 【修复】AdminLTE。css import google文件导致不稳定bug修复\r\n\r\n* 【修复】第一个访问用户执行统计等死循环bug修复\r\n\r\n* 【新增】全站搜索加入群组\r\n\r\n* 【修复】修复微博详情页评论样式\r\n\r\n* 【修复】修复统计code丢失的bug\r\n\r\n* 【新增】全站搜索加入活动和论坛\r\n\r\n* 【新增】Conf文件夹加入版本库\r\n\r\n* 【新增】首页增加登录页\r\n\r\n* 【新增】首页类型选择设置\r\n\r\n* 【调整】首页样式\r\n\r\n* 【调整】将主色改为变量\r\n\r\n* 【调整】身份创建删除冗余代码\r\n\r\n* 【调整】给微博类型加入title提示\r\n\r\n* 【调整】 调整fetchImage  getimagesize添加缓存\r\n\r\n* 【调整】美化微博的评论列表样式\r\n\r\n* 【调整】调整系统版本号\r\n\r\n* 【新增】新增初始友情链接\r\n\r\n* 【调整】调整页面文案\r\n\r\n* 【调整】首页样式\r\n\r\n* 【调整】首页，后台登陆央视\r\n\r\n* 【调整】每天重置签到的连签\r\n\r\n* 【调整】密码找回页面样式错位\r\n\r\n* 【修复】注册时验证邮箱的URL有问题\r\n\r\n* 【新增】增加顶部小图标\r\n\r\n* 【调整】修改代码审查的错误\r\n\r\n* 【修复】举报处理界面样式错位bug修复\r\n\r\n* 【修复】提示消息错位看不到bug修复\r\n\r\n* 【修复】注册提示信息bug修复\r\n\r\n* 【调整】注册后的步骤样式修改\r\n\r\n* 【调整】话题微博里插入表情、音乐、视频等窗口可随意切换\r\n\r\n* 【调整】静态首页样式\r\n\r\n* 【调整】微博插入表情和上传图片可以随意切换\r\n\r\n* 【调整】用户搜索对搜索条件做判断\r\n\r\n* 【调整】把远程获取图片尺寸的时间，修改为3秒限制\r\n\r\n* 【调整】美化签到的圈\r\n\r\n* 【调整】修改微博操作图标\r\n\r\n* 【调整】注册后选择用户标签样式调整\r\n\r\n* 【调整】message-error消息使用message-danger相同样式\r\n\r\n* 【调整】找人模块搜索框样式调整\r\n\r\n* 【调整】点击签到后实时更新累签和连签\r\n\r\n* 【修复】微博页未登录状态下样式及登录提醒bug\r\n\r\n* 【调整】微博插入表情、网页、音乐、视频等窗口可随意切换\r\n\r\n* 【调整】删除多余文件\r\n\r\n* 【调整】美化微博发布框样式\r\n\r\n* 【调整】微博样式\r\n\r\n* 【调整】css编译\r\n\r\n* 【调整】自动生成的邀请码类型写入SQL\r\n\r\n* 【修复】后台用户列表中搜索图标消失bug修复\r\n\r\n* 【调整】注册后修改头像的页面头像错位\r\n\r\n* 【调整】普通注册后相互关注，粉丝数加1\r\n\r\n* 【调整】每日第一个用户做的事情，调整为异步发起请求。\r\n\r\n* 【调整】微博样式\r\n\r\n* 【调整】计划任务还原到骏涛的版本\r\n\r\n* 【修复】注册后缺少相关步骤的BUG\r\n\r\n* 【调整】身份设置默认头像无法跳过优化\r\n\r\n* 【修复】身份设置默认头像无法跳过bug\r\n\r\n* 【调整】邀请注册开启相互关注，粉丝数都加1\r\n\r\n* 【新增】静态首页图片\r\n\r\n* 【调整】静态首页样式\r\n\r\n* 【新增】增加常用操作的权限节点\r\n\r\n* 【调整】全站搜索查询无结果的页面调整\r\n\r\n* 【调整】css编译\r\n\r\n* 【调整】公告文字修改\r\n\r\n* 【调整】公告修改\r\n\r\n* 【调整】调整公告样式\r\n\r\n* 【修复】css重新编译\r\n\r\n* 【调整】全站搜索 搜索结果页面样式修改\r\n\r\n* 【调整】公告按钮颜色调整\r\n\r\n* 【修复】样式错位\r\n\r\n* 【调整】优化体验\r\n\r\n* 【调整】优化点赞消息和更换头像\r\n\r\n* 【调整】微博和导航样式调整\r\n\r\n* 【修复】注册开启邮箱验证后点击”输入邮箱验证码“的框也会弹出隐藏的验证码框\r\n\r\n* 【调整】微博右侧样式\r\n\r\n* 【修复】导航下拉错位\r\n\r\n* 【修复】微博首页累签和连签渲染\r\n\r\n* 【调整】微博样式\r\n\r\n* 【新增】静态首页\r\n\r\n* 【调整】导航与页脚样式\r\n\r\n* 【调整】顶部增加会话入口\r\n\r\n* 【新增】广告删除功能\r\n\r\n* 【调整】微博首页签到日历累签和连签未登录时不显示\r\n\r\n* 【调整】前台注册时间的渲染\r\n\r\n* 【调整】排行榜页面样式\r\n\r\n* 【调整】微博首页样式\r\n\r\n* 【调整】member表粉丝值的获取。以及关注时fans值加1，取关时减1\r\n\r\n* 【调整】统计取消使用计划任务\r\n\r\n* 【调整】调整代码使之更易理解\r\n\r\n* 【调整】微博模块样式\r\n\r\n* 【新增】全站搜索增加找人\r\n\r\n* 【调整】微博模块样式\r\n\r\n* 【修复】公告重复显示bug\r\n\r\n* 【修复】后台样式bug修复\r\n\r\n* 【调整】优化会话列表关闭按钮范围\r\n\r\n* 【调整】开启邀请注册时的提示\r\n\r\n* 【修复】注册时输入了用户名却提示没有输入用户名\r\n\r\n* 【修复】修复incode页面样式bug\r\n\r\n* 【修复】计划任务数据库参数值错误修复\r\n\r\n* 【调整】添加修改后台导航菜单\r\n\r\n* 【调整】后台样式修改\r\n\r\n* 【新增】全站搜索能搜索微博\r\n\r\n* 【修复】排行榜配置没有给默认值\r\n\r\n* 【修复】注册时图片验证码的框点取消无法隐藏\r\n\r\n* 【修复】登出时后台权限列表无法删掉bug修复\r\n\r\n* 【修改】注册页验证码输入框显示错误的bug\r\n\r\n* 【调整】排行榜页面样式\r\n\r\n* 【调整】修改资料页面样式\r\n\r\n* 【调整】用户组更名为权限组\r\n\r\n* 【修复】计划任务不自动启动bug\r\n\r\n* 【修复】计划任务不自动启动bug修复\r\n\r\n* 【修复】修复版本库同步后计划任务不自动启动问题\r\n\r\n* 【修复】os-icon选择插件重选丢失bug修复\r\n\r\n* 【调整】登录注册页面样式\r\n\r\n* 【新增】导航图标simple-line-icon\r\n\r\n* 【调整】常用操作不引channel.js\r\n\r\n* 【修复】样式修复\r\n\r\n* 【调整】排行榜显示后台可配置\r\n\r\n* 【修复】php redirect之后，后续代码仍然会执行。要加上return\r\n\r\n* 【新增】积分列表根据积分类型筛选\r\n\r\n* 【修复】uc.php漏洞\r\n\r\n* 【修复】修复后台导航设置和商业版不同步的bug\r\n\r\n* 【修复】修复资讯页面调用老的广告钩子\r\n\r\n* 【调整】调整后台文字\r\n\r\n* 【修复】微博回复bug\r\n\r\n* 【调整】修改2.8.2版本号\r\n\r\n* 【修复】修复文字错误\r\n\r\n* 【修复】在登出之后清理掉全部的session内容\r\n\r\n* 【调整】后台顶部导航\r\n\r\n* 【调整】使用最新的表情收藏样式\r\n\r\n* 【修复】回复时出现被回复的内容\r\n\r\n* 【调整】论坛删除帖子时，对回复也进行删除\r\n\r\n* 【修复】修复图片无法上传问题\r\n\r\n* 【修复】上传文件base64的bug\r\n\r\n* 【调整】文件上传base64的bug\r\n\r\n* 【调整】后台用户生日显示bug\r\n\r\n* 【调整】个人资料的修改邮箱样式\r\n\r\n* 【修改】返回顶部的图片链接地址\r\n\r\n* 【修改】注册完成后头像上传页面错位\r\n\r\n* 【修改】活动列表取数据时加status判断\r\n\r\n* 【修复】后台扩展自动升级最新版本显示有误\r\n\r\n* 【修改】登录后台时输入错误的账号密码没有提示\r\n\r\n* 【新增】PC端点击链接，在手机模式访问下，跳手机端链接\r\n\r\n* 【修复】注册的时候验证用户名是否为空\r\n\r\n* 【修改】邮箱注册时，60S后提示是手机验证\r\n\r\n* 【修复】后台用户被删除，但是前台其他用户我的关注或我的粉丝列表中仍显示该用户\r\n\r\n* 【修复】公告消息bug修复\r\n\r\n* 【修复】计划任务不自动启动bug\r\n\r\n* 【调整】主题样式\r\n\r\n* 【编译】css\r\n\r\n* 【调整】排行榜做一个缓存\r\n\r\n* 【调整】常用操作、排行榜BUG修复\r\n\r\n* 【修复】V3-内测版-2 bug修复\r\n\r\n* 【调整】输图片验证码时邮箱或者手机验证的div会隐藏\r\n\r\n* 【新增】用户注册后默认收到一条系统消息\r\n\r\n* 【修复】安装时不启动计划任务\r\n\r\n* 【新增】版本库新增Conf文件夹\r\n\r\n* 【调整】注册页少引js\r\n\r\n* 【调整】会话和消息流程、样式、种类调整\r\n\r\n* 【调整】邮箱注册和手机注册流程的修改\r\n\r\n* 【调整】兼容栋栋写的会话列表\r\n\r\n* 【新增】后台数据统计完成\r\n\r\n* 【调整】主题和注册样式\r\n\r\n* 【调整】默认主题样式\r\n\r\n* 【调整】默认主题\r\n\r\n* 【修复】活跃用户统计bug修复\r\n\r\n* 【调整】后台首页样式提取和常用操作样式修改\r\n\r\n* 【新增】常用操作拖拽保存排序功能\r\n\r\n* 【新增】活跃度统计\r\n\r\n* 【调整】统计展示方式调整\r\n\r\n* 【新增】常用操作可供选择的图标\r\n\r\n* 【新增】充值用户统计完成\r\n\r\n* 【新增】常用操作修改图标和颜色功能\r\n\r\n* 【新增】消费用户统计完成，差展示\r\n\r\n* 【新增】加入版本库\r\n\r\n* 【新增】完成留存率统计\r\n\r\n* 【调整】登陆页样式\r\n\r\n* 【调整】身份创建完成后跳到身份列表\r\n\r\n* 【调整】登录页\r\n\r\n* 【新增】用户流失率统计完成\r\n\r\n* 【调整】去除常用操作冗余代码\r\n\r\n* 【新增】新增常用操作tile表\r\n\r\n* 【新增】常用操作的添加、删除功能\r\n\r\n* 【新增】新增流失率统计\r\n\r\n* 【新增】仪表盘常用操作的兼容\r\n\r\n* 【新增】member表新增“粉丝数”字段\r\n\r\n* 【新增】全站粉丝、连签、累签、积分排行榜\r\n\r\n* 【新增】数据统计相关初始\r\n\r\n* 【新增】网站在线人数统计（session存入数据库）\r\n\r\n* 【修复】计划任务bug修复\r\n\r\n* 【调整】登陆页样式\r\n\r\n* 【修复】积分变动tip添加bug修复\r\n\r\n* 【新增】完成用户组有效期功能\r\n\r\n* 【修复】修复用户推出登录时权限session无法删除问题（去除$_SESSION设置）\r\n\r\n* 【调整】优化消息弹出框用户体验\r\n\r\n* 【新增】用户组有有效期，未完成\r\n\r\n* 【新增】新增身份时能临时保存输入的信息\r\n\r\n* 【新增】新增bootstrap的ajax模态并替换zui的ajax模态\r\n\r\n* 【新增】补充css文件到版本库\r\n\r\n* 【新增】osv2商业版的计划任务兼容进v3中\r\n\r\n* 【新增】后台用户信息面板\r\n\r\n* 【修复】修复显示消息数量图标初始display:none;\r\n\r\n* 【修复】header消息去除\r\n\r\n* 【新增】后台管理员可编辑用户昵称\r\n\r\n* 【修复】用户扩展资料‘其他技能’多选时不能显示选中\r\n\r\n* 【调整】前台导航个人信息面板\r\n\r\n* 【修复】公告bug修复\r\n\r\n* 【调整】点击范围调整，提高用户体验\r\n\r\n* 【调整】消息系统优化调整\r\n\r\n* 【修复】消息系统刷新bug修复\r\n\r\n* 【修复】当消息内容为json数据时，toast的bug和last_message显示bug\r\n\r\n* 【修复】登录消息提示bug修复\r\n\r\n* 【新增】完成公告消息发送\r\n\r\n* 【调整】图标选择调整优化\r\n\r\n* 【调整】checkbox错位，样式调整\r\n\r\n* 【新增】用户列表搜索增加邮箱和手机号搜索\r\n\r\n* 【修复】图标选择bug，有无时错位\r\n\r\n* 【新增】导航设置增加图标选择\r\n\r\n* 【新增】OS-ICON图标及对应选择icon js插件\r\n\r\n* 【修复】score信息cookie清除\r\n\r\n* 【修复】导航管理修复\r\n\r\n* 【修复】导航管理修复\r\n\r\n* 【调整】优化签到日历刷新方式\r\n\r\n* 【调整】签到版本号升级\r\n\r\n* 【新增】签到绑定多行为\r\n\r\n* 【新增】行为日志导出CSV\r\n\r\n* 【调整】行为日志语言包\r\n\r\n* 【新增】签到日历完成\r\n\r\n* 【调整】活动模块代码调整\r\n\r\n* 【调整】专辑模块代码整理\r\n\r\n* 【调整】资讯模块代码\r\n\r\n* 【调整】身份创建优化\r\n\r\n* 【新增】消息系统完成（发消息没具体修改）\r\n\r\n* 【调整】消息机制调整\r\n\r\n* 【修复】公告链接检测bug修复\r\n\r\n* 【修复】公告删除bug修复\r\n\r\n* 【调整】公告内容类型和公告导航\r\n\r\n* 【调整】调整模板展示\r\n\r\n* 【新增】会话类型和消息列表\r\n\r\n* 【修复】去除误提交的测试代码\r\n\r\n* 【调整】邀请机制优化，注册时系统自动生成邀请码\r\n\r\n* 【调整】行为日志筛选功能去掉打钩\r\n\r\n* 【新增】后台行为日志按时间和行为筛选功能\r\n\r\n* 【调整】微博模块代码调整，主要是css调整\r\n\r\n* 【调整】编译后css同步\r\n\r\n* 【修改】后台登陆页\r\n\r\n* 【新增】会话列表\r\n\r\n* 【调整】编译后css同步\r\n\r\n* 【修改】后台icon 和部分表单控件样式\r\n\r\n* 【修改】后台首页按钮样式，扩展中的云市场错位\r\n\r\n* 【新增】消息前台侧滑块纯手工实现\r\n\r\n* 【新增】发送消息流程实现（以微博部分为例）\r\n\r\n* 【修改】后台字体\r\n\r\n* 【新增】进行消息机制的初始架构\r\n\r\n* 【调整】cookie超时时间去除\r\n\r\n* 【新增】后台管理员可编辑用户扩展信息\r\n\r\n* 【新增】全站公告前台一半（除去消息部分）\r\n\r\n* 【新增】公告后台\r\n\r\n* 【修复】插件adminlist列表顶部导航\r\n\r\n* 【修复】兼容bootstrap的datetimepicker，不用adminlte的时间选择\r\n\r\n* 【修复】兼容chosen，使用adminlte的select2\r\n\r\n* 【修复】修复adminTreeBuilder样式\r\n\r\n* 【新增】左侧导航做成osv3-metronic样式\r\n\r\n* 【修复】 扩展-》模块管理界面样式调整\r\n\r\n* 【调整】调整admin模块css目录结构\r\n\r\n* 【修复】插件列表页和模块列表页样式全丢\r\n\r\n* 【升级】升级系统版本至2.7.8-》2.8.0\r\n\r\n* 【修复】插件列表页tab样式修复\r\n\r\n* 【新增】设置adminlte按钮及面板\r\n\r\n* 【修复】搜索按钮点击下拉失效\r\n\r\n* 【修复】列表、表格样式修复\r\n\r\n* 【新增】adminlte中新增toast插件\r\n\r\n* 【修改】调整bootstrap的目录结构\r\n\r\n* 【修复】tab选项卡修复\r\n\r\n* 【修改】kanban使用metronic的nestable，并兼容进adminlte\r\n\r\n* 【修复】后台adminlte兼容tab选项卡\r\n\r\n* 【修改】修改左侧统一导航\r\n\r\n* 【修改】后台顶部导航用adminlte做成之前metronic的样式\r\n\r\n* 【初始化】创建osv3-adminlte分支', ' http://os.opensns.cn/news/detail_461.html', '20160918', '3.1.0', '0');
INSERT INTO `os_version` VALUES ('3.1.1', '1475031600', '1475031600', '*【修复】无注册方式时无报错bug修复\r\n\r\n*【修复】系统升级过程中bug修复\r\n\r\n*【修复】默认使用会话列表样式3\r\n\r\n*【修复】后台用户搜索没有搜索结果时没有提示的BUG\r\n\r\n*【修复】后台微博基本设置文字错误\r\n\r\n*【修复】修复升级时出现的bug\r\n\r\n*【修复】发布微博字数限制BUG', 'http://os.opensns.cn/news/detail_461.html', '20160922', '3.1.1', '0');
INSERT INTO `os_version` VALUES ('3.2.0', '1476322781', '1476322781', '* 【新增】新增socket。\r\n\r\n* 【修复】后台个人主页展示选项出现两次BUG\r\n\r\n* 【调整】默认分页和微博评论分页美化\r\n\r\n* 【修复】小名片上聊天和个人主页聊天优先使用阿里悟空\r\n\r\n* 【修复】话题页面发动态，无法上传图片bug修复\r\n\r\n* 【修复】找人模块 推荐bug\r\n\r\n* 【新增】模块按身份可访问\r\n\r\n* 【调整】去掉动态评论列表底部多出的一个像素的底线\r\n\r\n* 【调整】修改邮箱后缀后清理缓存\r\n\r\n* 【新增】第三方登录邮箱后缀 配置项\r\n\r\n* 【新增】第三方同步登陆成功后那个个人资料里的邮箱的后缀xxx@xxx.com可以后台设置\r\n\r\n* 【新增】我的社群卡片扩展，当超过4个的时候出现向下箭头，点击展开全部的社群功能\r\n\r\n* 【修复】找人模块好友也关注显示错误\r\n\r\n* 【修复】修复微博列表某些页面没内容bug\r\n\r\n* 【新增】话题关注sql表\r\n\r\n* 【调整】话题消息提示函数调整\r\n\r\n* 【新增】积分日志导出\r\n\r\n* 【新增】自动导出积分和行为日志\r\n…………………………\r\n……………………\r\n………………\r\n…………\r\n……', 'http://os.opensns.cn/news/detail_464.html', '20161013', '3.2.0', '0');
INSERT INTO `os_version` VALUES ('3.2.1', '1476946603', '1476946603', '* 【调整】个人主页的关注按钮风格不统一\r\n\r\n* 【调整】论坛后台使用keyAutoComplete\r\n\r\n* 【新增】新增keyAutoComplete\r\n\r\n* 【调整】调整socket。判断socket是否连接，连接失败则重连。\r\n\r\n* 【修复】修复微博sql的安装丢表操作\r\n\r\n* 【修复】安装文件问题修复\r\n\r\n* 【调整】去除update.sql内容\r\n\r\n* 【新增】新增array_get_by_keys函数\r\n\r\n* 【调整】socket只推动在微博首页~\r\n\r\n* 【调整】查看大图中放大缩小使用中文\r\n\r\n* 【修复】栋栋改导航bug\r\n\r\n* 【调整】群组帖子列表去掉“作者”字样\r\n\r\n* 【修复】发布资讯页面文字错误\r\n\r\n* 【调整】后台自动升级小屏幕时加左右滚动\r\n\r\n* 【调整】后台云市场小屏幕时加左右滚动条\r\n\r\n* 【修复】默认用户组标签和扩展资料给默认值\r\n\r\n* 【修复】网站端虾米音乐不能播放BUG\r\n\r\n* 【修复】修复发布活动后 不能报名的BUG\r\n\r\n* 【修复】聚合首页论坛右侧标题为空\r\n\r\n* 【修复】未读消息过多时，只展示50条，并全部设为已读\r\n\r\n* 【修复】个人主页关注/粉丝和头衔里链接错误\r\n\r\n* 【修复】临时去除四格报告的请求\r\n…………\r\n……', 'http://os.opensns.cn/news/detail_469.html', '20161020', '3.2.1', '0');
INSERT INTO `os_version` VALUES ('3.3.0点我！升级前有额外操作，详情请看资讯~', '1479977580', '1479977580', '* 【修复】认证提醒消息链接地址错误\r\n\r\n* 【新增】后台邮件配置增加验证方式的选择\r\n\r\n* 【调整】微博js提取到公共js里面\r\n\r\n* 【修复】排行榜个人排行加status=1\r\n\r\n* 【修复】个人主页传的uid有误\r\n\r\n* 【修复】修复图片过大加载时间太长的BUG\r\n\r\n* 【修复】修复活动发布模块，进不去后台菜单的BUG\r\n\r\n* 【调整】后台常用操作一行显示9个\r\n\r\n* 【修复】快捷登录界面点立即注册js失效\r\n\r\n* 【调整】不展示分享量\r\n\r\n* 【修复】修复分享量展示bug\r\n\r\n* 【调整】去除无用按钮\r\n\r\n* 【修复】认证类型默认图标不展示\r\n\r\n* 【调整】审核失败有原因并且申请要给相关审核人员发消息\r\n\r\n* 【调整】个人主页传uid的判断调整\r\n\r\n* 【新增】统计用户\r\n\r\n* 【调整】用户导航缓存调整\r\n\r\n* 【调整】个人主页链接里拼uid\r\n\r\n* 【修复】个人主页路径里的uid为0\r\n\r\n* 【新增】申请认证权限节点\r\n\r\n* 【新增】名人堂用户调整为avatar_html128\r\n\r\n* 【新增】新增query_user的avatar_html32等带认证图标的头像\r\n\r\n* 【新增】新增认证相关表\r\n\r\n* 【新增】认证用户列表：名人堂\r\n\r\n* 【新增】认证主干部分完成\r\n\r\n* 【新增】后台列表新增多图查看keyMultiImage\r\n\r\n* 【新增】认证状态\r\n\r\n* 【新增】认证相关代码\r\n\r\n* 【新增】认证代码初始化\r\n\r\n* 【新增】新增认证链接\r\n\r\n* 【调整】调整用户认证相关内容\r\n\r\n* 【新增】认证测试用图\r\n\r\n* 【新增】认证页面及样式\r\n\r\n* 【新建】新建认证分支\r\n\r\n* 【调整】调整路由\r\n\r\n* 【新增】 新增 get_url_with_domain 函数\r\n\r\n* 【调整】调整页面微博布局，并为一块\r\n\r\n* 【修复】修复论坛首页版块的文字错误\r\n\r\n* 【新增】全站置顶右上角改为印章效果\r\n\r\n* 【调整】后台分页使用之前的分页\r\n\r\n* 【修复】个人主页uid为0的BUG\r\n\r\n* 【修复】个人主页uid为0\r\n\r\n* 【调整】插件方法路径去掉execute，暂时这么修改\r\n\r\n* 【修复】修复 socket_check bug\r\n\r\n* 【修复】广告设置无法选择时间BUG\r\n\r\n* 【调整】排行榜缓存放到firstUserRun函数里执行\r\n\r\n* 【调整】修改socket检测。写个缓存。每10分钟检测一次\r\n\r\n* 【调整】排行榜性能优化\r\n\r\n* 【调整】 去掉页面载入时的socket检测，如果遇到socket失效则手动删掉/Conf/ws.lock文件。\r\n\r\n* 【调整】导航icon\r\n\r\n* 【调整】调整云市场扩展代码，满足加密条件\r\n\r\n* 【调整】取消使用builder，统一统计样式\r\n\r\n* 【新增】在线用户列表及下线用户完成\r\n\r\n* 【修复】去除后台登录页无用zui调用\r\n\r\n* 【新增】在线用户列表以及下线用户功能\r\n\r\n* 【修复】资讯站内分享无法生成微博\r\n\r\n* 【修复】去掉 < 转义\r\n\r\n* 【修复】将 < 转义\r\n\r\n* 【修复】还原昨天~今天的版本库改动\r\n\r\n* 【调整】调整云市场扩展内容位置，方便加密该部分\r\n\r\n* 【调整】云市场结构调整\r\n\r\n* 【修复】将  < 转义\r\n\r\n* 【修复】点别人的个人主页跳转到自己主页\r\n\r\n* 【删除】微博里删除解析虾米的代码\r\n\r\n* 【修复】修复UC漏洞\r\n\r\n* 【调整】addons路由调整\r\n\r\n* 【新增】列表中分享到站外\r\n\r\n* 【新增】列表站外分享\r\n\r\n* 【修复】修复个性域名生成\r\n\r\n* 【调整】调整addons路由\r\n\r\n* 【修复】伪静态下无法站内分享\r\n\r\n* 【调整】微博详情页缺少虾米样式\r\n\r\n* 【调整】画廊图标图片名字改回原名\r\n\r\n* 【调整】画廊图标图片名字重命名\r\n\r\n* 【新增】个性域名数据表\r\n\r\n* 【调整】调整群组路由规则\r\n\r\n* 【调整】 调整群组manager页面的tag选中的样式\r\n\r\n* 【调整】 增加路由正则匹配结果为 \'\'的判断，删除为空的参数\r\n\r\n* 【新增】图片微博浏览时增加旋转图标\r\n\r\n* 【调整】消息支持批量转移\r\n\r\n* 【修复】补上论坛模块的伪静态路由\r\n\r\n* 【调整】调整群组模块路由规则，暂时没有支持手机网页版。\r\n\r\n* 【新增】图片微博浏览时增加左转和右转功能\r\n\r\n* 【调整】消息优化，老数据单独存表\r\n\r\n* 【修复】腾讯视频vid获取错误\r\n\r\n* 【调整】注册页面文字改成“已有账号？”\r\n\r\n* 【调整】页脚的公司内容改成后台可配置\r\n\r\n* 【新增】完成用户个性域名\r\n\r\n* 【调整】虾米音乐实时获取播放地址\r\n\r\n* 【修复】后台用户列表“选择用户分组”点不开BUG\r\n\r\n* 【新增】新增论坛模块路由\r\n\r\n* 【调整】作者名称\r\n\r\n* 【新增】群组路由\r\n\r\n* 【新增】新增用户短路径\r\n\r\n* 【新增】默认按钮样式\r\n\r\n* 【修复】修复打包工具bug\r\n\r\n* 【新增】新增 活动模块的路由\r\n\r\n* 【新增】新增忽略模块\r\n\r\n* 【新增】专辑模块 路由规则\r\n\r\n* 【修复】后台群发消息错误提示\r\n\r\n* 【修复】会员展示无用户时，推荐bug\r\n\r\n* 【修复】修复敏感词后台菜单消失bug\r\n\r\n* 【调整】置顶微博html内容加入缓存\r\n\r\n* 【调整】侧边和顶部导航定位优化\r\n\r\n* 【调整】后台去掉广告轮播TouchSlider风格选项\r\n\r\n* 【调整】图片上传样式\r\n\r\n* 【新增】新增路由判断，自动判断访问终端。\r\n\r\n* 【调整】升级部分路由实现代码到TP3.2.3，支持全局路由\r\n\r\n* 【调整】默认分页加大可触发范围\r\n\r\n* 【新增】整合顶部导航链接到产品站，工单的三个按钮到右侧\r\n\r\n* 【修复】登录框导致的页面颜色bug\r\n\r\n* 【调整】登录页样式\r\n', 'http://os.opensns.cn/news/index/detail/id/489.html', '20161124', '3.3.0', '0');
INSERT INTO `os_version` VALUES ('3.3.1', '1482997756', '1482997756', '* 【修复】评论插件路径BUG\r\n\r\n* 【调整】圈子后台方法放到公共function里面\r\n\r\n* 【修复】修改手机文字显示错误\r\n\r\n* 【调整】调整编辑器显示样式\r\n\r\n* 【调整】调整活动编辑器快捷键\r\n\r\n* 【修复】修复语言包出错的bug\r\n\r\n* 【修复】取消论坛跳转路由功能,防止路由出错\r\n\r\n* 【修复】注册页面更改网站标题还是显示os的bug\r\n\r\n* 【修复】微博路由BUG\r\n\r\n* 【修复】修复引用出错,导致报错  不能从字符串的偏移量也不重载对象/引用\r\n\r\n* 【修复】修复消息编码不统一的bug\r\n\r\n* 【调整】同步登录默认密码改为123456\r\n\r\n* 【修复】公众号里微信同步登录也是扫码\r\n\r\n* 【修复】修复文章内容或者其他内容详情过长导致get提交失败的BUG\r\n\r\n* 【修复】修改手机文字错误\r\n\r\n* 【调整】云市场安装模块后自动清除左侧菜单缓存\r\n\r\n* 【修复】修复评论点赞不清微博缓存bug\r\n\r\n* 【修复】修复开启头像上传时，头像没裁剪 导致聚合首页出现圆饼头像\r\n\r\n* 【新增】地区找人参数过滤\r\n\r\n* 【修复】地区找人sql注入漏洞\r\n\r\n* 【调整】调整微博点赞\r\n\r\n* 【调整】微博html缓存改用S()，不存数据库\r\n\r\n* 【修复】修复后台不能更改推荐模块和热门模块的BUG\r\n\r\n* 【调整】根据建议调整\r\n\r\n* 【调整】调整点赞按钮位置\r\n\r\n* 【修复】修复os自带聊天出现nbsp标识\r\n\r\n* 【修复】替换状态bug修复\r\n\r\n* 【调整】调整微博列表评论区域样式\r\n\r\n* 【调整】调整微博详情页以及微博列表页样式\r\n\r\n* 【新增】手机版上传头像\r\n\r\n* 【修复】个人资料修改时提示框错位\r\n\r\n* 【调整】模块安装后自动清除左侧菜单的缓存\r\n\r\n* 【修复】修复语言包错误\r\n\r\n* 【修复】后台广告排期zui日历改adminLTE日历\r\n\r\n* 【修复】按地区找人路由BUG\r\n\r\n* 【修复】修复后台一些语言包BUG\r\n\r\n* 【修复】修复论坛和找人的路由规则BUG\r\n\r\n* 【调整】资讯投稿时发布时间默认为当前时间\r\n\r\n* 【修复】伪静态路由规则缺少活动的路由\r\n\r\n* 【修复】活动编辑页标题错误\r\n\r\n* 【删除】去掉右下角产品站工单三个按钮\r\n\r\n* 【调整】前台分页加大可触面积\r\n\r\n* 【新增】前台个人菜单加入申请认证\r\n\r\n* 【修复】后台自动升级工具BUG\r\n', 'http://os.opensns.cn/news/index/detail/id/511.html', '20161229', '3.3.1', '0');

-- ----------------------------
-- Table structure for os_weibo
-- ----------------------------
DROP TABLE IF EXISTS `os_weibo`;
CREATE TABLE `os_weibo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `comment_count` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_top` tinyint(4) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `repost_count` int(11) NOT NULL,
  `from` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_weibo
-- ----------------------------
INSERT INTO `os_weibo` VALUES ('1', '1', '就是来找个广州的C++服务端开发的，我就不相信找不到！', '1474205179', '3', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('2', '1', '我能抽象出整个世界./br \n但是我不能抽象出你．/br \n因为你在我心中是那么的具体．/br \n所以我的世界并不完整', '1474470116', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('3', '1', '#月饼惨案#最新消息5个人全被炒了。之前有一个幸存者，现在没了', '1474549104', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('4', '1', '#月饼惨案#为什么写JS就可以提交多次订单呢？这明显说明系统本身没做限制。那么要是鼠标是有/nb自定义按键，那岂不是一下子秒提交了很多订单？进一步说，不论是否用代码抢月饼，只要是提交多了几次，就很有几率被上纲上线。还好其他人鼠标单击那天没坏。。。', '1474549138', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('5', '1', '#关于跳槽#大家怎么认为跳槽呢', '1474552614', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('6', '1', '#国庆假期#大家怎么安排呀', '1474552668', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('7', '1', '#thinkphp#大道至简，开发由我', '1474552724', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('8', '1', '当你老了', '1476105090', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('9', '1', '#PHP最大优点是啥#', '1476105249', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('10', '1', '坚持不懈！！！！！！！', '1476105291', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('11', '101', '我和女朋友去见家长，女朋友去厨房帮忙了。/nb简单介绍后她爸说：“小伙子来下盘象棋吧。”/nb我说“行。”/nb摆好棋盘后我找不到车，她爸∶“小伙子你的车呢？”/nb我感觉事情没那么简单！', '1477192478', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('12', '101', '程序员节到了，代码撸起来', '1477194083', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('13', '101', '每次看老罗的相声，总会有被洗脑的感觉，讯飞输入法用起来！', '1477194176', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('14', '101', '这个冬天有点冷呀', '1480555690', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('15', '101', '#公司裁员#最近好多公司都在裁员，互联网冬天真来了嘛？', '1480557973', '1', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('16', '1', '我创建了一个新的群组【javascript教程】：http://thinkox.io/onegroup/6.html', '1483362986', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('17', '1', '管理员通过了@包汉伟/nb的头衔申请：[博客专家]，申请理由：1、热爱技术2、乐于助人&nbsp;&nbsp;3、喜欢结交志同道合4、希望提高技术5、木有啦', '1487050877', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('18', '1', '#合伙创业七年未分股份被踢出局#各位看官，怎么看', '1488092097', '0', '1', '0', 'feed', 'a:0:{}', '0', '');
INSERT INTO `os_weibo` VALUES ('19', '1', '是否我真的一无所有', '1488594988', '0', '1', '0', 'feed', 'a:0:{}', '0', '');

-- ----------------------------
-- Table structure for os_weibo_comment
-- ----------------------------
DROP TABLE IF EXISTS `os_weibo_comment`;
CREATE TABLE `os_weibo_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `weibo_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `to_comment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_weibo_comment
-- ----------------------------
INSERT INTO `os_weibo_comment` VALUES ('1', '1', '1', '换联网寒冬嘛', '1474474399', '1', '0');
INSERT INTO `os_weibo_comment` VALUES ('2', '1', '1', '回复 @admin 换联网寒冬嘛 ：晕死', '1474474447', '1', '0');
INSERT INTO `os_weibo_comment` VALUES ('3', '1', '1', '哈哈', '1474789676', '1', '0');
INSERT INTO `os_weibo_comment` VALUES ('4', '101', '15', '坑爹呀，大过年的', '1480566476', '1', '0');

-- ----------------------------
-- Table structure for os_weibo_top
-- ----------------------------
DROP TABLE IF EXISTS `os_weibo_top`;
CREATE TABLE `os_weibo_top` (
  `weibo_id` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`weibo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='置顶微博表';

-- ----------------------------
-- Records of os_weibo_top
-- ----------------------------

-- ----------------------------
-- Table structure for os_weibo_topic
-- ----------------------------
DROP TABLE IF EXISTS `os_weibo_topic`;
CREATE TABLE `os_weibo_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '话题名',
  `logo` varchar(255) NOT NULL DEFAULT '/topicavatar.jpg' COMMENT '话题logo',
  `intro` varchar(255) NOT NULL COMMENT '导语',
  `qrcode` varchar(255) NOT NULL COMMENT '二维码',
  `uadmin` int(11) NOT NULL DEFAULT '0' COMMENT '话题管理   默认无',
  `read_count` int(11) NOT NULL DEFAULT '0' COMMENT '阅读',
  `is_top` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of os_weibo_topic
-- ----------------------------
INSERT INTO `os_weibo_topic` VALUES ('1', '月饼惨案', '/topicavatar.jpg', '', '', '0', '1', '0');
INSERT INTO `os_weibo_topic` VALUES ('2', '关于跳槽', '/topicavatar.jpg', '', '', '0', '0', '0');
INSERT INTO `os_weibo_topic` VALUES ('3', '国庆假期', '/topicavatar.jpg', '', '', '0', '0', '0');
INSERT INTO `os_weibo_topic` VALUES ('4', 'thinkphp', '/topicavatar.jpg', '', '', '0', '1', '0');
INSERT INTO `os_weibo_topic` VALUES ('5', 'PHP最大优点是啥', '/topicavatar.jpg', '', '', '0', '0', '0');
INSERT INTO `os_weibo_topic` VALUES ('6', '公司裁员', '6', '最近好多公司都在裁员，互联网冬天真来了嘛？', '6', '101', '11', '0');
INSERT INTO `os_weibo_topic` VALUES ('7', '合伙创业七年未分股份被踢出局', '21', '怎么看待《就算老公一毛钱股份都没拿到，在我心里，他依然是最牛逼的创业者》这篇文章？？怎么避免合伙创业未分股份被踢出局', '0', '1', '6', '0');
