create table photo (
    id bigserial primary key,
    path varchar(255) not null,
    name varchar(255) not null
);

create table account (
    id bigserial primary key,
    last_name varchar(255) not null,
    first_name varchar(255) not null,
    patronymic varchar(255),
    email varchar(255) not null unique,
    phone varchar(20) not null,
    password varchar(255) not null,
    photo_id int references photo(id)
);

create table post (
    id bigserial primary key,
    title varchar(255) not null,
    description varchar(5000) not null,
    create_date timestamp with time zone default current_timestamp,
    account_id int references account(id) not null,
    photo_id int references photo(id) not null
);

create table score (
    id bigserial primary key,
    value int not null,
    post_id int references post(id) not null,
    account_id int references account(id) not null
);