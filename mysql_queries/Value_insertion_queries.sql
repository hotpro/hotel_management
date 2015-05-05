use hotel;

INSERT INTO customer VALUES
('carolihuan@gmail.com', 'Huan', 'Li', 'SJSU', '1 Washington Sq, San Jose, CA 95192', '4089241000'),
('chrishou118@gmail.com', 'Yutao', 'Hou', 'SJSU', '1 Washington Sq, San Jose, CA 95192', '4089241001'),
('chienshin1@gmail.com', 'Jianxin', 'Gao', 'SJSU', '1 Washington Sq, San Jose, CA 95192', '4089241002'),
('ambersun1234@gmail.com', 'Chiunghui', 'Tseng', 'SJSU', '1 Washington Sq, San Jose, CA 95192', '4089241003'),
('jackson@hotmail.com', 'Jackson', 'King', 'Ruffle Tech', '475 mission blvd, Houston, TX 74885', '5124587458'),
('norma@star.com', 'Normal', 'Juan', 'Taco Car', '745 1st street, Miami, FL 48571', '9687452541'),
('nan.ding@gmail.com', 'Nan', 'Ding', 'SJSU', '1 Washington Sq, San Jose, CA 95192', '4089241004');

INSERT INTO promotion VALUES
('AAA', '2000-01-01', '2100-01-01', 0.1, 0, 1),
('Government', '2000-01-01', '2100-01-01', 0.15, 0, 1),
('Senior','2000-01-01', '2100-01-01', 0.15, 0, 1),
('Member', '2000-01-01', '2100-01-01', 0.1, 300, 2),
('2015 summer', '2015-04-15', '2015-08-15', 0, 500, 3),
('2015 Spring', '2015-03-01', '2015-04-15', 0.2, 0, 3),
('2015 May', '2015-05-01', '2015-05-30', 0.1, 0, 3),
('2015 May Ballroom', '2015-05-01', '2015-05-20', 0.1, 0, 3);

INSERT INTO promo_room VALUES
('Standard', 'AAA'),
('Standard', 'Government'),
('Standard', 'Senior'),
('Standard', 'Member'),
('Standard', '2015 summer'),
('Standard', '2015 Spring'),
('Standard', '2015 May'),
('Ballroom', '2015 May Ballroom '),
('Ballroom', 'AAA');

INSERT INTO room VALUES
(101, 2, 'Standard'),
(102, 4, 'Standard'),
(103, 68, 'Ballroom'),
(201, 2, 'Standard'),
(202, 4, 'Standard'),
(203, 88, 'Ballroom'),
(301, 2, 'Standard'),
(302, 4, 'Standard'),
(303, 128, 'Ballroom'),
(401, 2, 'Standard'),
(402, 4, 'Standard'),
(403, 2, 'Standard'),
(501, 68, 'Ballroom'),
(502, 88, 'Ballroom'),
(503, 128, 'Ballroom');

INSERT INTO room_price VALUES
('Standard', 2, 100, 1000),
('Standard', 4, 110, 1100),
('Ballroom', 68, 110, 1100),
('Ballroom', 88, 110, 1100),
('Ballroom', 128, 200, 2000);

INSERT INTO guest_room VALUES
(101, 'Single'),
(102, 'Double'),
(201, 'Single'),
(202, 'Double'),
(301, 'Single'),
(302, 'Double'),
(401, 'Single'),
(402, 'Double'),
(403, 'Single');

INSERT INTO ballroom VALUES
(103, 1000),
(203, 2000),
(303, 3000),
(501, 1000),
(502, 2000),
(503, 3000);

INSERT INTO event (event_name, number_of_people) 
VALUES
('Birthday Party',50),
('Wedding',300),
('Company Traning',200),
('Meeting',20),
('Meeting',50);

INSERT INTO event_room VALUES
(1,103),
(2,103),
(3,203),
(4,203),
(5,303);

INSERT INTO service (service_name, price)
values
('Breakfast', 10),
('Lunch', 20),
('Dinner', 30),
('Parking', 25),
('Laundry', 15);

INSERT INTO membership (points, level, c_email)
VALUES
(10000, 1, 'carolihuan@gmail.com'),
(20000, 2, 'chrishou118@gmail.com'),
(12000, 1, 'chienshin1@gmail.com'),
(34000, 3, 'ambersun1234@gmail.com'),
(46000, 4, 'nan.ding@gmail.com'),
(80000, 5, 'jackson@hotmail.com'),
(56000, 4, 'norma@star.com');

INSERT INTO stay (check_in_date, check_out_date, point_amount, money_amount, bonus_point,
c_email, room_id, promo_name)
VALUES
('2015-04-21', '2015-04-22', 0, 120, 0, 'carolihuan@gmail.com', 101, 'AAA'),
('2015-04-25', '2015-04-27', 0, 187, 0, 'chrishou118@gmail.com', 102, 'Government'),
('2015-04-20', '2015-04-22', 0, 198, 300, 'chienshin1@gmail.com', 201, 'Member'),
('2015-05-06', '2015-05-08', 0, 198, 300, 'chienshin1@gmail.com', 202, 'Member'),
('2015-05-01', '2015-05-02', 0, 120, 0, 'carolihuan@gmail.com', 201, 'Member'),
('2015-05-07', '2015-05-09', 0, 187, 0, 'chrishou118@gmail.com', 102, 'Government'),
('2015-05-09', '2015-05-15', 0, 660, 0, 'jackson@hotmail.com', 102, null);

INSERT INTO invoice (point_amount, cash_amount, credit_card_amount, mailing_address, invoice_date, stay_id)
VALUES 
(0, 0, 120, '1 Washington Sq, San Jose, CA 95192', '2015-04-22', 10000),
(0, 187, 0, '1 Washington Sq, San Jose, CA 95192', '2015-04-27', 10001),
(0, 100, 98, '1 Washington Sq, San Jose, CA 95192', '2015-04-22', 10002);

INSERT INTO service_ordered VALUES
(1, 10001, '2015-04-22', 3);
