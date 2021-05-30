-- 创建数据库
drop database if exists db_xblog; 
create database if not exists db_xblog
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

use db_xblog;

-- 创建性别列表
drop table if exists tb_sex;
create table if not exists tb_sex(
	id int auto_increment primary key not null,
    name varchar(16) not null,
	unique(name)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into tb_sex(id,name)
select 1 id, '女' name
union all
select 2 id, '男' name;

select * from tb_sex;

-- 创建用户表
drop table if exists tb_user;
create table if not exists tb_user (
	id bigint auto_increment primary key not null,
	name varchar(128) not null,
    password varchar(128),
    id_sex int not null,
    avatar varchar(1024),
    email varchar(128) not null,
    homepage varchar(1024),
    introduction varchar(256),
    unique(name),
    unique(email)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_user(id,name,password,id_sex,avatar,email,homepage,introduction)
select 1 id, 'admin' name, 'admin' password,1 id_sex, 'img/avatar/admin.png' avatar,  'admin@thesct.net' email, 'http://www.thesct.net' homepage, '我是管理员。' introduction
union all
select 2 id, 'writer' name, 'writer' password, 2 id_sex, 'img/avatar/writer.png' avatar,  'writer@thesct.net' email, 'http://www.thesct.net' homepage, '我是个作家咯。' introduction
union all
select 3 id, 'guy' name, 'guy' password, 1 id_sex, 'img/avatar/guy.png' avatar,  'guy@thesct.net' email, 'http://www.thesct.net' homepage, '我就是来打酱油的。' introduction
union all
select 4 id, 'cat' name, 'cat' password, 1 id_sex, 'img/avatar/cat.png' avatar,  'cat@thesct.net' email, 'http://www.thesct.net' homepage, '我是一只猫。' introduction
union all
select 5 id, 'hacker' name, 'hacker' password, 1 id_sex, 'img/avatar/hacker.png' avatar,  'hacker@thesct.net' email, 'http://www.thesct.net' homepage, '我是一名黑客。' introduction;

select * from tb_user;

-- 创建权限表
drop table if exists tb_authority;
create table if not exists tb_authority (
	id bigint auto_increment primary key not null,
    name varchar(128),
    unique(name)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_authority(id, name)
select 1 id, '发布文章' name
union all
select 2 id, '删除文章' name
union all
select 3 id, '修改文章' name
union all
select 4 id, '发布评论' name
union all
select 5 id, '删除评论' name
union all
select 6 id, '修改评论' name
union all
select 7 id, '增加文章分类' name
union all
select 8 id, '删除文章分类' name
union all
select 9 id, '修改文章分类' name;

select * from tb_authority;

-- 创建用户组列表
drop table if exists tb_group;
create table if not exists tb_group (
	id bigint auto_increment primary key not null,
    name varchar(128),
    mask int not null,
    unique(name)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_group(id, name, mask)
select 1 id, '管理员' name, 1 mask
union all
select 2 id, '作家' name, 1 mask
union all
select 3 id, '会员' name, 1 mask
union all
select 13 id, '黑名单' name, 0 mask;

select * from tb_group;

-- 创建组权限分配表
drop table if exists tb_auth_group;
create table if not exists tb_auth_group (
	id_group bigint not null,
    id_authority bigint not null,
    mask int not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_auth_group(id_group, id_authority, mask)
select 1 id_group, 1 id_authority, 1 mask
union all
select 1 id_group, 2 id_authority, 1 mask
union all
select 1 id_group, 3 id_authority, 1 mask
union all
select 1 id_group, 4 id_authority, 1 mask
union all
select 1 id_group, 5 id_authority, 1 mask
union all
select 1 id_group, 6 id_authority, 1 mask
union all
select 1 id_group, 7 id_authority, 1 mask
union all
select 1 id_group, 8 id_authority, 1 mask
union all
select 1 id_group, 9 id_authority, 1 mask
union all
select 2 id_group, 1 id_authority, 1 mask
union all
select 2 id_group, 2 id_authority, 1 mask
union all
select 2 id_group, 3 id_authority, 1 mask
union all
select 2 id_group, 4 id_authority, 1 mask
union all
select 2 id_group, 5 id_authority, 1 mask
union all
select 2 id_group, 6 id_authority, 1 mask
union all
select 3 id_group, 4 id_authority, 1 mask
union all
select 3 id_group, 5 id_authority, 1 mask
union all
select 3 id_group, 6 id_authority, 1 mask;

select * from tb_auth_group;


-- 创建用户权限分配表
drop table if exists tb_auth_user;
create table if not exists tb_auth_user (
	id_user bigint not null,
    id_authority bigint not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_auth_user(id_user, id_authority)
select 4 id_user, 1 id_authority
union all
select 4 id_user, 7 id_authority
union all
select 4 id_user, 8 id_authority
union all
select 4 id_user, 9 id_authority
union all
select 5 id_user, 8 id_authority;

select * from tb_auth_user;

-- 创建组用户分配表
drop table if exists tb_user_group;
create table if not exists tb_user_group (
	id_user bigint not null,
    id_group bigint not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_user_group(id_user, id_group)
select 1 id_user, 1 id_group
union all
select 2 id_user, 2 id_group
union all
select 3 id_user, 3 id_group
union all
select 5 id_user, 13 id_group;

select * from tb_user_group;

-- 创建文章分类列表
drop table if exists tb_category;
create table if not exists tb_category (
	id bigint auto_increment primary key not null,
	name varchar(18) not null,
	dn int not null,
	unique(name)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_category(id, name, dn)
select 1 id, '形而上学' name, 1 dn
union all
select 2 id, '人工智能' name, 2 dn
union all
select 3 id, '文明演进' name, 3 dn
union all
select 4 id, '时事点评' name, 4 dn
union all
select 5 id, '代码生活' name, 5 dn
union all
select 6 id, '读者往来' name, 6 dn;

select * from tb_category;

-- 创建文章列表
drop table if exists tb_article;
create table if not exists tb_article (
	guid varchar(128) not null,
	username varchar(128) not null,
	title varchar(128) not null,
	intro varchar(512),
	content text not null,
	thumb varchar(1024),
	slide varchar(1024),
	id_category bigint not null,
    maketime datetime not null,
	unique(guid)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into tb_article(username,guid,title,intro,content,id_category,maketime)
values('writer','{7342BE66-3762-4ED5-A9E0-8A71427F2EDE}',"Hello, world!",'你好，世界！','你好，世界!我在这里，我是xblog的第一篇文章。^0^',1,now());
select * from tb_article;

-- 创建文章标签对应列表
drop table if exists tb_label_article;
create table if not exists tb_label_article (
	guid_art varchar(128) not null,
	label varchar(128) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into tb_label_article(guid_art,label)
values('{7342BE66-3762-4ED5-A9E0-8A71427F2EDE}',"Hello world");
select * from tb_label_article;


-- 创建编辑推荐文章列表
drop table if exists tb_editor_choice;
create table if not exists tb_editor_choice (
	guid_art varchar(128) not null,
	choice_time timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into tb_editor_choice(guid_art)
select '{7342BE66-3762-4ED5-A9E0-8A71427F2EDE}' guid_art
union all
select '{7342BE66-3762-4ED5-A9E0-8A71427F2EDE}' guid_art;

select * from tb_editor_choice;

-- 创建系统信息表
drop table if exists tb_sys_info;
create table if not exists tb_sys_info (
	id bigint auto_increment primary key not null,
	name varchar(64),
	value varchar(64)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into tb_sys_info(id, name, value)
values(1, 'cur_theme', 'default');
insert into tb_sys_info(id, name, value)
values(2, 'sitename', '符动乾坤');
select * from tb_sys_info;
