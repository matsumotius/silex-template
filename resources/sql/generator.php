<?php
function write_sql($name, $str, $path = "./") {
  $fp = fopen("{$path}{$name}.sql", "w");
  @fwrite($fp, $str, strlen($str));
  fclose($fp);
}

$users = <<<SQL
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id                INT(10) UNSIGNED AUTO_INCREMENT NOT NULL,
  user_id           VARCHAR(255)     NOT NULL,
  password          VARCHAR(255)     NOT NULL,
  created_at        TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  UNIQUE user_id(user_id)
) engine=InnoDB CHARACTER SET 'utf8';
SQL;
write_sql("users", $users);

write_sql(
  "schema", 
  $users
);
