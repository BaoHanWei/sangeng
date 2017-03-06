-- -----------------------------
-- 表结构 `ocenter_book`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_book` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='教程表';


-- -----------------------------
-- 表结构 `ocenter_book_category`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_book_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `sort` int(6) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='文章分类';


-- -----------------------------
-- 表结构 `ocenter_book_detail`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_book_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `section_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章内容表';


-- -----------------------------
-- 表结构 `ocenter_book_section`
-- -----------------------------
CREATE TABLE IF NOT EXISTS `ocenter_book_section` (
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

-- -----------------------------
-- 表内记录 `ocenter_book`
-- -----------------------------
INSERT INTO `ocenter_book` VALUES ('1', '测试教程', '100', '', '就的撒伐大尽快答复后健康大事放假扩大是啊付款的撒复合接口萨芬的撒开发深咖啡都是', '10', '1', '1', '1438824046', '2', '4', '29', '[1]');
-- -----------------------------
-- 表内记录 `ocenter_book_category`
-- -----------------------------
INSERT INTO `ocenter_book_category` VALUES ('1', '默认分类', '0', '1', '0');
INSERT INTO `ocenter_book_category` VALUES ('3', '测试', '0', '1', '0');

-- -----------------------------
-- 表内记录 `ocenter_book_section`
-- -----------------------------
INSERT INTO `ocenter_book_section` VALUES ('1', '章节1', '是打符号，大师傅，第三方回家', '1', '0', 'hfdjsgkj电话放假回家放得开是过客发的好几十个hi开发的事老公', '1', '1', '1438840849', '3', '0', '1', '0', '1', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('2', '章节2', '', '1', '0', '', '1', '1', '1438840849', '1', '0', '1', '0', '1', '#cc0033', '0');
INSERT INTO `ocenter_book_section` VALUES ('3', '文章3', '', '1', '1', '', '1', '1', '1438840849', '2', '0', '1', '0', '1', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('4', '子章节1', '', '1', '0', '', '1', '1', '1438841147', '0', '0', '1', '1', '1', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('5', '子文章2', '', '1', '1', '', '1', '1', '1438841147', '0', '0', '1', '1', '1', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('6', '子章节3', '', '1', '0', '', '1', '1', '1438841147', '0', '0', '1', '1', '1', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('7', '发动机开始个', '', '1', '0', '', '1', '1', '1438841595', '0', '0', '1', '4', '0', '', '4');
INSERT INTO `ocenter_book_section` VALUES ('8', '发多少功夫是的', '富贵花分公司地方，法的规定发生个', '1', '1', '的撒伐好激动撒放假扩大是饭店喝酒撒福克斯大家发觉好多撒放寒假快乐的撒谎覅大事飞机很快的撒开发尽快回答说发卡上的符合健康大事发大水佛挡杀佛就看到萨哈夫就看到萨哈夫可就大师傅款式大方好看啊圣诞节快发货道具卡收费空间大会尽快发货四大皆空复合接口啊速度发货爱的色放扣篮大赛好付款就爱上对话框浪费好多健身房扩大双方哈电视看发的哈就开始发打开萨哈夫健康的萨福克打算咖啡壶的撒健康防护会计师大黄蜂啊收到回复啊的撒开', '1', '1', '1438841595', '0', '0', '1', '4', '0', '', '4');
INSERT INTO `ocenter_book_section` VALUES ('9', '佛塑股份', '', '1', '0', '', '1', '1', '1438841595', '0', '0', '1', '4', '0', '', '1');
INSERT INTO `ocenter_book_section` VALUES ('10', '发多少功夫大广东佛山', '', '1', '0', '', '1', '1', '1438938238', '0', '0', '1', '7', '0', '', '2');
INSERT INTO `ocenter_book_section` VALUES ('11', '放到', '', '1', '0', '', '1', '1', '1438938423', '0', '0', '1', '7', '0', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('12', '发多少功夫大事', '', '1', '0', '', '1', '1', '1438938423', '0', '0', '1', '7', '0', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('13', '风格的风格的', '', '1', '0', '', '1', '1', '1438938423', '0', '0', '1', '7', '0', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('14', '的萨芬撒', '', '1', '0', '', '-1', '1', '1438938423', '0', '0', '1', '7', '0', '', '0');
INSERT INTO `ocenter_book_section` VALUES ('15', 'vc下班vc下地方', '', '1', '0', '', '-1', '1', '1438938437', '0', '0', '1', '7', '0', '', '0');
