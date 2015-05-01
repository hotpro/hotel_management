SET foreign_key_checks = 0;
drop database if exists hotel;
create database hotel;
use hotel;

CREATE TABLE customer (
	email             varchar(25) not null,
	first_name        varchar(15) not null,
	last_name         varchar(15) not null,
	company_name      varchar(15) not null,
	address           varchar(50),
	phone_no          char(11),
	primary key (email)
);

CREATE TABLE membership (
	member_id         integer not null AUTO_INCREMENT,
	points            integer,
	level             integer,
	c_email           varchar(25) not null,
	primary key (member_id),
	foreign key (c_email) references customer(email)
);

ALTER TABLE membership AUTO_INCREMENT=10000;

CREATE TABLE promotion (
	promo_name       	   varchar(30) not null,
	start_date             date,
	end_date               date,
	discount_amount        real,
	extra_bonus_point      integer,
	required_stay_duration integer,
	primary key (promo_name)
);

CREATE TABLE promo_room (
	room_type              varchar(10),
	promo_name	           varchar(30) not null,
	primary key (room_type, promo_name),
	foreign key (promo_name) references promotion(promo_name)
		ON DELETE CASCADE	ON UPDATE CASCADE
    -- foreign key (room_type) references room(type)
		-- ON DELETE CASCADE	ON UPDATE CASCADE
);

CREATE TABLE room (
	room_id            integer not null,
	max_capacity       integer,
	type               varchar(10),
	primary key (room_id)
);

CREATE TABLE guest_room (
	room_id            integer not null,
	room_level         varchar(10),
	primary key (room_id),
	foreign key (room_id) references room(room_id)
);

CREATE TABLE ballroom (
	room_id            integer not null,
	area               integer,
	primary key (room_id),
	foreign key (room_id) references room(room_id)
);


-- add room_price table --yutao
CREATE TABLE room_price (
	room_type			varchar(10),
    max_capacity		integer,
    cash_rate			integer,
    point_rate			integer,
    primary key (room_type, max_capacity)
);

CREATE TABLE stay (
	stay_id           integer not null AUTO_INCREMENT,
	check_in_date     date,
	check_out_date    date,
	point_amount      integer,
	money_amount      integer,
	bonus_point       integer,
	c_email           varchar(25) not null,
	room_id           integer not null,
	promo_name	      varchar(30),
	primary key (stay_id),
	foreign key (c_email) references customer(email),
	foreign key (room_id) references room(room_id),
	foreign key (promo_name) references promotion(promo_name)
);
ALTER TABLE stay AUTO_INCREMENT=10000;

CREATE TABLE invoice (
	invoice_id         integer not null AUTO_INCREMENT,
	point_amount       integer,
	cash_amount        integer,
	credit_card_amount integer,
	mailing_address    varchar(50),
	invoice_date       date,
    stay_id			   integer not null,
	primary key (invoice_id),
    foreign key (stay_id) references stay(stay_id)
);
ALTER TABLE invoice AUTO_INCREMENT=10000;

CREATE TABLE service_ordered (
	service_id         integer not null,
	stay_id            integer not null,
	service_date       date,
	quantity           integer,
	primary key (stay_id, service_id, service_date),
	foreign key (service_id) references service(service_id)
);

CREATE TABLE service (
	service_id         integer not null AUTO_INCREMENT,
	service_name       varchar(10),
	price              real,
	primary key (service_id)
);

CREATE TABLE event (
	event_id           integer not null AUTO_INCREMENT,
	event_name         varchar(25),
	number_of_people   integer,
	primary key (event_id)
);

CREATE TABLE event_room (
	event_id           integer not null,
	room_id            integer not null,
	primary key (event_id, room_id),
	foreign key (event_id) references event(event_id),
	foreign key (room_id) references ballroom(room_id)
);


SET foreign_key_checks = 1;
