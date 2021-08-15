
create function is_utilisateur(text,text) returns integer
as 
'
	declare f_pseudo alias for $1; 
	declare f_mdp alias for $2;
	declare id integer; 
	declare retour integer;
begin 
	select into id idutilisateur from utilisateur where pseudo = f_pseudo and mdp = f_mdp; 
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