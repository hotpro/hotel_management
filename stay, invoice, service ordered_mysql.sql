INSERT INTO stay VALUES
(10001, '2015-04-21', '2015-04-22', 0, 120, 0, 500001, 'carolihuan@gmail.com', 101, 'AAA', 200001),
(10002, '2015-04-25', '2015-04-27', 0, 187, 0, 500002, 'chrishou118@gmail.com', 102, 'Government', 200002),
(10003, '2015-04-20', '2015-04-22', 0, 198, 300, 500003, 'chienshin1@gmail.com', 201, 'Member', 200003);

INSERT INTO invoice VALUES
(200001, 0, 0, 120, '1 Washington Sq, San Jose, CA 95192', '2015-04-22'),
(200002, 0, 187, 0, '1 Washington Sq, San Jose, CA 95192', '2015-04-27'),
(200003, 0, 100, 98, '1 Washington Sq, San Jose, CA 95192', '2015-04-22');

INSERT INTO service_ordered VALUES
(1, 10001, '2015-04-22', 3);