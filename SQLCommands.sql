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