create table `auth_type` (
`id` int unsigned PRIMARY KEY auto_increment,
`auth_name` varchar(50) not null DEFAULT ''
)

create table `site` (
`id` INT unsigned PRIMARY KEY auto_increment,
`auth_id` varchar(200) not NULL DEFAULT '',
`site_name` VARCHAR(50) NOT NULL DEFAULT ''
)

CREATE TABLE `config` (
`id` INT unsigned PRIMARY KEY auto_increment,
`site_id` INT unsigned NOT NULL DEFAULT 0,
`auth_id` INT unsigned NOT NULL DEFAULT 0,
`content` text not NULL DEFAULT ''
)