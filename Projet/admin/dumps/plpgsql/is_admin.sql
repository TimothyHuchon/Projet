create or replace function is_admin(text,text) returns integer
as 
'
	declare f_login alias for $1; 
	declare f_password alias for $2;
	declare id integer; 
	declare retour integer; 

begin 
	select into id idutilisateur from bp_admin where login = f_login and password = f_password and grade="admin"; 
	if not found 
	then 
	retour = 0; 
	else 
	retour = 1; 
	end if; 
	return retour; 
	end;
	
'
language plpgsql; 