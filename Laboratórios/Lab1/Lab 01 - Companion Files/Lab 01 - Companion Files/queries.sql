drop function add_me

CREATE FUNCTION	add_me(
x	NUMERIC,		
y	NUMERIC)		
RETURNS NUMERIC AS
$$	
BEGIN	
		RETURN	x	+	y;	
END	
$$	LANGUAGE	plpgsql;

select add_me(2,4);