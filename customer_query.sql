-- Find the available guest room types and prices for a certain date
select	*
from	guest_room
where	room_id not in
		(select	room_id
        from	stay
        where	check_in_date<='2015-04-21' and check_out_date>='2015-04-21');
        

-- Get the list of the invoices in the past
select	*
from 	invoice, stay
where	invoice.invoice_id=stay.invoice_id and stay.c_email='carolihuan@gmail.com';

-- Check available promotions in a certain day
select	*
from	promotion
where	start_date<='2015-04-20' and end_date>='2015-04-20';