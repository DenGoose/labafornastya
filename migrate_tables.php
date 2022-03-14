<?php
$_SERVER["DOCUMENT_ROOT"] = __DIR__;
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

$tables = [
	'create table if not exists clients(
    id   int auto_increment primary key,
    name varchar(50) null
);',
	'create table if not exists loans(
    id              int auto_increment primary key,
    photo           varchar(100) null,
    loan_purpose    varchar(100) null,
    manager_comment varchar(100) null,
    loan_amount     int          null,
    id_client       int          null,
    constraint loans_clients_id_fk
        foreign key (id_client) references clients (id)
            on delete cascade
);'
];

foreach ($tables as $table)
{
	\Lib\DataBase\DB::getInstance()->getConnection()->query($table);
}