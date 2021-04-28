CREATE TABLE `class_reminder`
(
    `id`                int  AUTO_INCREMENT ,
    `lessen_name`                 tinytext  ,
    `students_id`                 text  ,
    `time`                 bigint  ,
    `place`                 tinytext  ,
    `times`                 smallint  ,
    `modified_date`         bigint  ,
    PRIMARY KEY (`id`)
);

CREATE TABLE `anti_spam`
(
    `id`                int  AUTO_INCREMENT ,
    `sender_id`                 tinytext  ,
    `chat_id`                 tinytext  ,
    `massage_id`                 tinytext  ,
    `send_time`                 bigint,
    `command`                 text,
    `modified_date`         bigint  ,
    PRIMARY KEY (`id`)
);

CREATE TABLE `blocked_users`
(
    `id`                int  AUTO_INCREMENT ,
    `user_id`                 tinytext  ,
    `chat_id`                 tinytext  ,
    `blocked_time`            bigint,
    `command`                 text,
    `reason`           tinytext,
    `modified_date`         bigint  ,
    PRIMARY KEY (`id`)
);