
DROP database if exists study_smart_db;

CREATE Database study_smart_db;

use study_smart_db;

CREATE TABLE `user` (
  `id` bigint unsigned not null primary key auto_increment,
  `firstname` varchar(255) ,
  `lastname` varchar(255) ,
  `email` varchar(255) not null,
  `phone` varchar(20),
  `account_status` enum("enabled", "disabled") not null,
  `profile_image` varchar(255),
  `user_type` enum ("rider", "driver", "admin"),
  `ev_code` int default 0,
  `user_password` varchar(256) not null,
  `email_verified` tinyint(1) default 0,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp   
);

CREATE TABLE `reset_password` (
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `token` varchar(256) ,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp  ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `session` (
  `session_id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `session_token` varchar(1000) ,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp  ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);


CREATE TABLE `temporary_email` (
  `id` bigint unsigned not null primary key auto_increment,
  `userId` bigint unsigned not null,
  `email` varchar(256) ,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp  ,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

