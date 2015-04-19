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
	member_id         integer not null,
	points            integer,
	level             integer,
	c_email           varchar(25) not null,
	primary key (member_id),
	foreign key (c_email) references customer(email)
);


CREATE TABLE promotion (
	promotion_id           integer not null,
	type                   varchar(10),  
	start_date             date,
	end_date               date,
	discount_amount        real,
	extra_bonus_point      integer,
	required_stay_duration integer,
	primary key (promotion_id)
);

CREATE TABLE promo_room (
	room_type              varchar(10),
	promotion_id           integer not null,
	primary key (room_type, promotion_id)
);

CREATE TABLE room (
	room_id            integer not null,
	cash_rate          integer,
	point_rate         integer,
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
	functionality      varchar(10),
	area               integer,
	primary key (room_id),
	foreign key (room_id) references room(room_id)
);

CREATE TABLE stay (
	stay_id           integer not null,
	check_in_date     date,
	check_out_date    date,
	point_amount      integer,
	money_amount      integer,
	bonus_point       integer,
	reserve_no        integer,
	c_email           varchar(25) not null,
	room_id           integer not null,
	promotion_id      integer not null,
	invoice_id        integer not null,
	primary key (stay_id),
	foreign key (c_email) references customer(email),
	foreign key (room_id) references room(room_id),
	foreign key (invoice_id) references invoice(invoice_id),
	foreign key (promotion_id) references promotion(promotion_id)
);

CREATE TABLE invoice (
	invoice_id         integer not null,
	point_amount       integer,
	cash_amount        integer,
	credit_card_amount integer,
	mailing_address    varchar(50),
	invoice_date       date,
	primary key (invoice_id)
);

CREATE TABLE service (
	service_id         integer not null,
	service_type       varchar(10),
	price              real,
	stay_id            integer not null,
	service_date       date,
	quantity           integer,
	primary key (service_id),
	foreign key (stay_id) references stay(stay_id)
);

CREATE TABLE event (
	event_id           integer not null,
	event_name         varchar(10),
	type               integer,
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

INSERT INTO room VALUES
(101, 100, 1000, 2, 'Standard'),
(102, 110, 1100, 2, 'Standard'),
(103, 110, 1100, 4, 'Ballroom'),
(201, 110, 1100, 2, 'Standard'),
(202, 110, 1100, 2, 'Standard'),
(203, 110, 1100, 4, 'Ballroom'),
(301, 110, 1100, 2, 'Standard'),
(302, 110, 1100, 2, 'Standard'),
(303, 200, 2000, 4, 'Ballroom');

INSERT INTO guest_room VALUES
(101, 'Single'),
(102, 'Double'),
(201, 'Single'),
(202, 'Double'),
(301, 'Single'),
(302, 'Double');

INSERT INTO ballroom VALUES
(103, 'conference'),
(203, 'conference'),
(303, 'dance');


SET foreign_key_checks = 1;
