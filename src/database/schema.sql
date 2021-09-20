
DROP database if exists study_smart_db;

CREATE Database study_smart_db;

use study_smart_db;

CREATE TABLE `user` (
  `id` bigint unsigned not null primary key auto_increment,
  `firstname` varchar(255) ,
  `lastname` varchar(255) ,
  `email` varchar(255) not null,
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


CREATE TABLE `task` (
 `task_id` bigint unsigned not null primary key auto_increment,
 `task_name` varchar(255) ,
 `deadline` date not null ,
 `num_of_question` smallint unsigned default 1,
 `num_done` smallint unsigned default 0,
 `categoryId` bigint unsigned not null,
 `unitId` bigint unsigned not null,
 `userId` bigint unsigned not null,
 `task_status` enum('not_started', 'started', 'completed', 'submitted') default 'not_started',
 `created_on` datetime default current_timestamp,
 `updated_on` datetime default current_timestamp on update current_timestamp,
 FOREIGN KEY (`categoryId`) REFERENCES `category`(`category_id`) on delete cascade,
 FOREIGN KEY (`unitId`) REFERENCES `unit`(`unit_id`) on delete cascade,
 FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
);

CREATE TABLE `unit` (
  `unit_id` bigint unsigned not null primary key auto_increment,
  `unit_name` varchar(255) not null,
  `userId` bigint unsigned not null,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp,
  FOREIGN KEY (`userId`) REFERENCES `user`(`id`) on delete cascade
); 

CREATE TABLE `category` (
  `category_id` bigint unsigned not null primary key auto_increment,
  `category_name` varchar(255) not null,
  `created_on` datetime default current_timestamp,
  `updated_on` datetime default current_timestamp on update current_timestamp
);
