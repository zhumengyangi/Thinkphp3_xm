USE shop0926;#使用哪个数据库  use user
SET NAMES utf8;	#设置数据库的字符集 SET NAMES utf8;
#create 创建
#table 表
#exists 存在
#engine 数据库引擎分类：MyISAM 和innodb
#default 默认
#utf8:只有数据设置编码格式：utf和8之间没有中横线，
#php:header('content-type:text/html;charset=utf-8');
#html:<meta charset="utf-8"/>
#comment :注释 用于说明表的作用
#unsigned ：非负
#auto_increment 自增
#primary key(id)设置id为主键，一个表里只能有一个主键，一般为自增的值

create table if not exists info(
	id mediumint unsigned not null auto_increment,
	name varchar(30) not null comment '姓名',
	sex tinyint unsigned not null comment '性别：0女 1男 3保密',
	birthday int unsigned not null comment '生日',
	age varchar(3) not null comment "年龄",
	primary key(id)
)engine=MyISAM default charset=utf8 comment '用户信息表';

#tinyint : 0-255
#smallint ：0-65535
#mediumint : 0-1千6百多万
#int : 0-40多亿

#char    :0-255字符
#varchar :0-65535字节 字节是一个物理单位，存汉字，utf8:存2万多  gbk：存3万多
#text	:0-65535字符，字符是一个逻辑单位，无论保存中文或英文，一个汉字（字母）就是一个字符，
#longtext:


#表尺寸的限制？
#一个表中所有字段的大小之和不能超过65535个字节
#mediumint 占3个字节
#varchar 45*3
#decimal 10
#tinyint 2
#text/longtext 不存在该表中
DROP TABLE IF EXISTS shop0926_goods;
CREATE TABLE IF NOT EXISTS shop0926_goods
(
	goods_id mediumint unsigned not null auto_increment,
	goods_name varchar(45) not null comment '商品名称',
	cat_id mediumint unsigned not null comment '商品主分类id',
	brand_id mediumint unsigned not null comment '商品品牌id',
	market_price decimal(10,2) not null default '0.00' comment '商品市场价格',
	shop_price decimal(10,2) not null default '0.00' comment '商品本店价格',
	-- level_id mediumint unsigned not null comment '级别id',
	jifen int unsigned not null comment '赠送积分',
	jyz int unsigned not null comment '赠送经验值',
	promote_price decimal(10,2) not null default '0.00' comment '促销价格',
	promote_start_time int unsigned not null default 0 comment '促销开始时间',
	promote_end_time int unsigned not null default 0 comment '促销结束时间',
	goods_logo varchar(150) not null default '' comment '商品logo',
	goods_sm_logo varchar(150) not null default '' comment '商品缩略图logo',	
	goods_desc longtext not null default '' comment '商品描述',
	is_hot tinyint unsigned not null default '0' comment '是否热卖 1：热卖 ',
	is_new tinyint unsigned not null default '0' comment '是否新品 1：新品 0：非新品',
	is_best tinyint unsigned not null default '0' comment '是否精品 1：精品 0：非精品',
	is_on_sale tinyint unsigned not null default '1' comment '是否上架 1：上架 0：下架',
	seo_keyword varchar(150) not null default '' comment 'seo_关键字',
	seo_description text not null default '' comment 'seo_描述',
	type_id mediumint unsigned not null default 0 comment '商品类型id',
	sort_num tinyint unsigned not null default 100 comment '商品排序',
	is_delete tinyint unsigned not null default '0' comment '是否删除 1：删除 0：未删除',
	addtime int unsigned not null comment '添加时间',
	primary key (goods_id),
	key shop_price(shop_price),
	key cat_id(cat_id),
	key brand_id(brand_id),
	key is_on_sale(is_on_sale),
	key is_hot(is_hot),
	key is_new(is_new),
	key is_best(is_best),
	key is_delete(is_delete),
	key sort_num(sort_num),
	key promote_start_time(promote_start_time),
	key promote_end_time(promote_end_time),
	key addtime(addtime)
)engine=MyISAM default charset=utf8 comment '商品表';

CREATE TABLE IF NOT EXISTS shop0926_youhui_price
(
	goods_id mediumint unsigned not null comment '商品id',
	youhui_num int unsigned not null comment '优惠数量',
	youhui_price decimal(10,2) not null default '0.00' comment '商品优惠价格',
	key(goods_id)
)engine=MyISAM default charset=utf8 comment '商品优惠价格表';

#商品扩展分类
CREATE TABLE IF NOT EXISTS shop0926_goods_cat
(
	goods_id mediumint unsigned not null comment '商品id',
	cat_id mediumint unsigned not null comment '分类id',
	key(goods_id),
	key(cat_id)
)engine=MyISAM default charset=utf8 comment '商品扩展分类表';

CREATE TABLE IF NOT EXISTS shop0926_category
(
	cat_id mediumint unsigned not null auto_increment,
	cat_name varchar(45) not null comment '分类名称',
	parent_id mediumint unsigned not null default '0' comment '上级分类id,0顶级',
	primary key(cat_id)
)engine=MyISAM default charset=utf8 comment '商品分类表';

CREATE TABLE IF NOT EXISTS shop0926_brand
(
	brand_id mediumint unsigned not null auto_increment,
	brand_name varchar(45) not null comment '品牌名称',
	brand_url varchar(200) not null default '' comment '品牌官网',
	brand_logo varchar(200) not null default '' comment '品牌logo',
	primary key(brand_id)
)engine=MyISAM default charset=utf8 comment '商品品牌表';

################RBAC#####################
#DROP TABLE IF EXISTS shop0926_auth;
CREATE TABLE IF NOT EXISTS shop0926_auth
(
	auth_id mediumint unsigned not null auto_increment,
	auth_name varchar(45) not null comment '权限名称',
	module_name varchar(10) not null comment '模块名称',
	controller_name varchar(10) not null comment '控制器名称',
	action_name varchar(20) not null comment '方法名称',
	parent_id mediumint unsigned not null default '0' comment '上级权限id 0：顶级权限',
	add_time int unsigned not null comment '添加时间',
	primary key (auth_id)
)engine=MyISAM default charset=utf8 comment '权限表';


#DROP TABLE IF EXISTS shop0926_role_auth;
CREATE TABLE IF NOT EXISTS shop0926_role_auth
(
	role_id mediumint unsigned not null comment '角色id',
	auth_id mediumint unsigned not null comment '权限id',
	add_time int unsigned not null comment '添加时间',
	key(role_id),
	key(auth_id)
)engine=MyISAM default charset=utf8 comment '角色权限表';


-- DROP TABLE IF EXISTS shop0926_role;
CREATE TABLE IF NOT EXISTS shop0926_role
(
	role_id mediumint unsigned not null auto_increment,
	role_name varchar(45) not null comment '角色名称',
	add_time int unsigned not null comment '添加时间',
	primary key (role_id)
)engine=MyISAM default charset=utf8 comment '角色表';


-- DROP TABLE IF EXISTS shop0926_admin_role;
CREATE TABLE IF NOT EXISTS shop0926_admin_role
(
	admin_id mediumint unsigned not null comment '管理员id',
	role_id mediumint unsigned not null comment '角色id',
	add_time int unsigned not null comment '添加时间',
	key (admin_id),
	key (role_id)
)engine=MyISAM default charset=utf8 comment '管理员角色表';

-- DROP TABLE IF EXISTS shop0926_admin;
CREATE TABLE IF NOT EXISTS shop0926_admin
(
	admin_id mediumint unsigned not null auto_increment,
	admin_name varchar(45) not null comment '账号',
	admin_pwd char(32) not null comment '管理员密码',
	is_use tinyint unsigned not null default '1' comment '是否启用 1启用 0禁用',
	add_time int unsigned not null comment '添加时间',
	primary key (admin_id)
)engine=MyISAM default charset=utf8 comment '管理员表';


#创建以上5张表之后，取出管理员id为3的管理员所拥有的所有权限信息
#流程：1.先取出id为3的管理员所在的角色id---shop0926_admin_role
#select role_id from shop0926_admin_role where admin_id = 3;
#2.再取出这些角色所拥有的权限id
#select auth_id from shop0926_role_auth where role_id in (1的结果);
#3.根据权限id取出这些权限的信息
#select * from shop0926_auth where auth_id in (2的结果);

#最终
#select * from shop0926_auth where auth_id in (
#	select auth_id from shop0926_role_auth where role_id in (
#		select role_id from shop0926_admin_role where admin_id = 3
#	)
#);

#方式二
#select a.*
#  from shop0926_auth a,shop0926_role_auth b,shop0926_admin_role c
#    where c.admin_id = 3 and c.role_id = b.role_id and b.auth_id = a.auth_id
#
#方式三
#select b.*
#	from shop0926_role_auth a
#	 left join shop0926_auth b on a.auth_id=b.auth_id
#	 left join shop0926_admin_role c on a.role_id=c.role_id
#		where c.admin_id = 3

DROP TABLE IF EXISTS shop0926_type;
CREATE TABLE IF NOT EXISTS shop0926_type
(
	type_id tinyint unsigned not null auto_increment,
	type_name varchar(45) not null comment '类型名称',
	primary key (type_id)
)engine=MyISAM default charset=utf8 comment '商品类型';


DROP TABLE IF EXISTS shop0926_attribute;
CREATE TABLE IF NOT EXISTS shop0926_attribute
(
	attr_id mediumint unsigned not null auto_increment,
	attr_name varchar(45) not null comment '属性名称',
	attr_type tinyint unsigned not null default '0' comment '属性的类型 0唯一 1可选',
	attr_option_values varchar(150) not null default '' comment '属性可选值 多个可选值用逗号隔开',	
	type_id tinyint unsigned not null comment '商品类型',
	primary key (attr_id),
	key(type_id)
)engine=MyISAM default charset=utf8 comment '商品属性';


DROP TABLE IF EXISTS shop0926_member_level;
CREATE TABLE IF NOT EXISTS shop0926_member_level
(
	level_id mediumint unsigned not null auto_increment,
	level_name varchar(45) not null comment '级别名称',
	bottom_num int unsigned not null comment '积分下限',
	top_num int unsigned not null comment '积分上限',
	primary key (level_id)
)engine=MyISAM default charset=utf8 comment '会员级别';

DROP TABLE IF EXISTS shop0926_member_price;
CREATE TABLE IF NOT EXISTS shop0926_member_price
(
	goods_id mediumint unsigned not null comment '商品id',
	level_id mediumint unsigned not null comment '级别id',
	member_price decimal(10,2) not null comment '级别的价格',
	key (goods_id),
	key (level_id)
)engine=MyISAM default charset=utf8 comment '会员价格';


-- DROP TABLE IF EXISTS shop0926_goods;
-- CREATE TABLE IF NOT EXISTS shop0926_goods
-- (
-- 	goods_id mediumint unsigned not null auto_increment,
-- 	goods_name varchar(200) not null default '' comment '商品名称',
-- 	level_id mediumint unsigned not null comment '级别id',
-- 	primary key (goods_id)
-- )engine=MyISAM default charset=utf8 comment '商品';



CREATE TABLE IF NOT EXISTS shop0926_goods_pics
(
	pics_id mediumint unsigned not null auto_increment,
	goods_id mediumint unsigned not null comment '商品id',
	big_pic varchar(150) not null comment '大图',
	small_pic varchar(150) not null comment '小图',
	primary key(pics_id),
	key(goods_id)
)engine=MyISAM default charset=utf8 comment '商品图片';


CREATE TABLE IF NOT EXISTS shop0926_goods_attr
(
	goods_attr_id int unsigned not null auto_increment,
	goods_id mediumint unsigned not null comment '商品id',
	attr_id mediumint unsigned not null comment '属性id',
	attr_value varchar(200) not null default '' comment '属性的值',
	attr_price decimal(10,2) not null default '0.00' comment '属性的价格',
	primary key (goods_attr_id),
	key(goods_id),
	key(attr_id)
)engine=MyISAM default charset=utf8 comment '商品属性';

CREATE TABLE IF NOT EXISTS shop0926_goods_number
(
	goods_num_id int unsigned not null auto_increment,
	goods_id mediumint unsigned not null comment '商品id',
	goods_number int unsigned not null comment '库存量',
	goods_attr_id varchar(150) not null comment '商品属性id组成的字符串',
	#--这里的id保存的是shop0926_goods_attr表中的id，
	#通过这个id就可以获取属性以及相应的属性值，如果多个属性id组合，就用逗号隔开，
	#并且存时要按照id的升序，为将来前台查询库存量时也要先把属性id组拼成字符串，然后查询数据库
	primary key (goods_num_id),
	key(goods_id)
)engine=MyISAM default charset=utf8 comment '商品库存量';



DROP TABLE IF EXISTS shop0926_member;
CREATE TABLE IF NOT EXISTS shop0926_member
(
	member_id mediumint unsigned not null auto_increment,
	member_email varchar(60) not null comment '会员账号',
	email_code char(32) not null default '' comment '保存邮箱验证码,当会员通过邮箱验证码验证，清空该字段，为空时表示该邮箱通过验证',
	member_pwd char(32) not null comment '密码',
	member_face varchar(150) not null comment '会员头像',
	add_time int unsigned not null comment '注册时间',
	primary key (member_id)
)engine=MyISAM default charset=utf8 comment '会员表';


/***********评论模块***************/
DROP TABLE IF EXISTS shop0926_comment;
CREATE TABLE IF NOT EXISTS shop0926_comment
(
	comment_id mediumint unsigned not null auto_increment,
	comment_content varchar(2000) not null comment '评论内容',
	comment_star tinyint unsigned not null default "3" comment '评论分数',
	used_num smallint unsigned not null comment '点击有用的数量',
	member_id mediumint unsigned not null comment '会员id',
	goods_id mediumint unsigned not null comment '商品id',
	add_time int unsigned not null comment '评论时间',
	primary key (comment_id),
	key(goods_id)
)engine=MyISAM default charset=utf8 comment '评论表';

DROP TABLE IF EXISTS shop0926_reply;
CREATE TABLE IF NOT EXISTS shop0926_reply
(
	reply_id mediumint unsigned not null auto_increment,
	reply_content varchar(2000) not null comment '回复内容',
	comment_id mediumint unsigned not null comment '回复的id',
	member_id mediumint unsigned not null comment '会员id',
	add_time int unsigned not null comment '回复的时间',
	primary key (reply_id),
	key(comment_id)
)engine=MyISAM default charset=utf8 comment '回复表';

DROP TABLE IF EXISTS shop0926_clicked_use;
CREATE TABLE IF NOT EXISTS shop0926_clicked_use
(
	comment_id mediumint unsigned not null comment '回复的id',
	member_id mediumint unsigned not null comment '会员id',
	add_time int unsigned not null comment '回复的时间',
	primary key(member_id,comment_id)
)engine=MyISAM default charset=utf8 comment '记录用户点击过有用的评论';
#之后用该表判断member_id=1的会员是否点击过commit_id=3这个评论，
#select count(*) from shop0926_clicked_use  where member_id=1 and commit_id=3;
#因为这两个字段一起查询，所有使用联合索引，比独立索引查询速度快
DROP TABLE IF EXISTS shop0926_impression;
CREATE TABLE IF NOT EXISTS shop0926_impression
(
	imp_id mediumint unsigned not null auto_increment,
	imp_name varchar(50) not null comment '印象的标题',
	imp_num smallint unsigned not null default '1' comment '印象的数量',
	goods_id mediumint unsigned not null comment '商品id'
	primary key (imp_id),
	key(goods_id)
)engine=MyISAM default charset=utf8 comment '印象表';



-- DROP TABLE IF EXISTS shop0926_cart;
CREATE TABLE IF NOT EXISTS shop0926_cart
(
	cart_id mediumint unsigned not null auto_increment,
	goods_id mediumint unsigned not null comment '商品id',
	goods_attr_id varchar(50) not null default '' comment '商品属性id,多个值用逗号隔开',
	goods_number int unsigned not null comment '购买的数量',
	member_id mediumint unsigned not null comment '会员id',
	primary key (cart_id),
	key(member_id)
)engine=MyISAM default charset=utf8 comment '购物车';