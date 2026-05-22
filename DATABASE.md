DB = classly;

create table user (
    -> username
    -> password
    -> tipe
)

create table attendance (
    -> id int auto_increment primary key,
    -> username varchar(50) not null,
    -> date date not null,
    -> time time not null,
    -> status enum('Present', 'Permit', 'Sick', 'Absent') not null,
    -> foreign key (username) references user(username) on delete cascade on update cascade
    -> );

create table active_qr (
    -> id int auto_increment primary key,
    -> qr_code varchar(100) not null unique,
    -> create_at timestamp default current_timestamp
    -> );

 

