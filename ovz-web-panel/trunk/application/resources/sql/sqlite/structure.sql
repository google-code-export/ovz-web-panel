BEGIN TRANSACTION;
CREATE TABLE user (id integer primary key autoincrement, userName varchar(255), userPassword  char(32), roleId int);
DELETE FROM sqlite_sequence;
COMMIT;
