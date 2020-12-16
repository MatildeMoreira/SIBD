-- A func%on that, given the name of a depositor,
-- returns how many accounts that depositor has

CREATE OR REPLACE FUNCTION account_counter(d_name VARCHAR(40))
RETURNS INTEGER AS
$$
    DECLARE total_count INTEGER;
    BEGIN
        SELECT COUNT(*) INTO total_count
        FROM depositor
        WHERE customer_name = d_name;


    END;
    $$ LANGUAGE plpgsql;

--Get the name, street and city of customers with more than one account

SELECT customer_name,customer_city,customer_street
FROM customer
WHERE account_counter(customer_name)> 1;


--A func%on that, given the name of the customer, returns all customer accounts
CREATE FUNCTION accounts_of(name VARCHAR(80))
RETURNS SETOF account
AS
$$
    SELECT a.account_number,branch_name,balance
    FROM account as a, depositor as d
    WHERE a.account_number = d.account_number and d.customer_name = name;
    $$ LANGUAGE sql;




