use hotel;

INSERT INTO promotion VALUES
('AAA', '2000-01-01', '2100-01-01', 0.1, 0, 1),
('Government', '2000-01-01', '2100-01-01', 0.15, 0, 1),
('Senior','2000-01-01', '2100-01-01', 0.15, 0, 1),
('Member', '2000-01-01', '2100-01-01', 0.1, 100, 2),
('2015 Member summer promo', '2015-04-15', '2015-08-15', 0, 300, 3),
('2015 Spring promo', '2015-03-01', '2015-04-15', 0.2, 0, 3),
('2015 May promo', '2015-05-01', '2015-05-30', 0.1, 0, 3),
('2015 May Ballroom promo', '2015-05-01', '2015-05-20', 0.1, 0, 3);

INSERT INTO promo_room VALUES
('Standard', 'AAA'),
('Standard', 'Government'),
('Standard', 'Senior'),
('Standard', 'Member'),
('Standard', '2015 Member summer promo'),
('Standard', '2015 Spring promo'),
('Standard', '2015 May promo'),
('Ballroom', '2015 May Ballroom promo'),
('Ballroom', 'AAA');



