create table if not exists shop0926_auth(
   auth_id mediumint unsigned not null auto_increment,
   auth_name varchar(45) not null comment '权限名称',
   module_name varchar(10) not null comment '模块名称',
   controller_name varchar(10) not null comment '控制器名称',
   action_name varchar(10) not null comment '方法名称',
   parent_id mediumint unsigned not null default '0' comment '上级权限id 0: 顶级权限',
   add_time int unsigned not null comment '添加时间',
   primary key (auth_id)
)engine=MyISAM default charset=utf8 comment '权限表';


create table if not exists shop0926_role_auth(
 role_id mediumint unsigned not null comment '角色id',
 auth_id mediumint unsigned not null comment '权限id',
 add_time int unsigned not null comment '添加时间',
 key(role_id),
 key(auth_id)
)engine=MyISAM default charset=utf8 comment '角色权限表';


create table if not exists shop0926_role(
role_id mediumint unsigned not null auto_increment,
role_name varchar(45) not null comment'角色名称',
add_time int unsigned not null comment '添加时间',
primary key (role_id)

)engine=MyISAM default charset=utf8 comment '角色表';

create table if not exists shop0926_admin_role(
  admin_id mediumint unsigned not null comment '管理员id',
  role_id  mediumint unsigned not null comment '角色id',
  add_time int unsigned not null comment '添加时间'
)engine=MyISAM default charset=utf8 comment '管理员角色表';