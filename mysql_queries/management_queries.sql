-- Update price/type/max person of the room
update	room
set		cash_rate=120
where	room_id=202;

-- List all the rooms with details such as room number, price and type
select	*
from	room;

-- List all available rooms in a certain day
select	*
from	room
where	room.room_id not in 
		(select	room_id
        from	stay
        where	check_in_date<='2015-04-21' and check_out_date>='2015-04-21');
        
-- List all stays in a certain day
select	*
from	stay
where	check_in_date<='2015-04-21' and check_out_date>='2015-04-21';
        
-- Check the schedule of a certain guest room / ball room
select	R.room_id, S.stay_id, S.check_in_date, S.check_out_date
from	room R, stay S
where	R.room_id = S.room_id;

-- List the stay history of a certain guest
select	*
from 	stay
where	c_email='carolihuan@gmail.com';