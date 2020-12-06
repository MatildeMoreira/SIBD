1. a)   DELIMITER //

        CREATE FUNCTION SaldoAbsoluto (c varchar(255))
                RETURNS decimal(20, 2)
        BEGIN
                DECLARE saldo decimal(20, 2);
                DECLARE divida decimal(20, 2);
                SELECT SUM(balance) INTO saldo
                FROM depositor NATURAL JOIN account
                WHERE customer_name = c;
                
                IF saldo IS NULL THEN SET saldo=0;
                END IF;
                
                SELECT SUM(amount) INTO divida
                FROM borrower NATURAL JOIN loan
                WHERE customer_name=c;
                
                IF divida IS NULL THEN SET divida=0;
                END IF;
                
                RETURN saldo-divida;
        END //
        DELIMITER ;


1. b)   DELIMITER //
        
        CREATE FUNCTION avg_balance (b1 varchar(255), b2 varchar(255))
                RETURNS decimal(20,2)
        BEGIN
                DECLARE media1 decimal(20,2);
                DECLARE media2 decimal(20,2);
                SELECT AVG(balance) INTO media1
                FROM account
                WHERE branch_name=b1;
                
                SELECT AVG(balance) INTO media2
                FROM account
                WHERE branch_name=b2;
                
                IF media1 IS NULL THEN SET media1=0;
                END IF;
                IF media2 IS NULL THEN SET media1=0;
                END IF;
                
                RETURN media1-media2;
        END //
        DELIMITER ;
     
        
1. c)   SELECT b1.branch_name
        FROM branch b1, branch b2
        GROUP BY b1.branch_name
        HAVING min(avg_balance(b1.branch_name, b2.branch_name))=0;
        
        
2. a)   DELIMITER //
        CREATE TRIGGER update_loan AFTER UPDATE ON loan
        FOR EACH ROW
        BEGIN
                IF NEW amount <= 0 THEN
                UPDATE branch
                SET assets = assets + NEW.amount*(-1)
                WHERE branchname = NEW.branchname;
                
                DELETE FROM borrower
                WHERE loan_number = NEW.branch_number;
                
                END IF;
         DELIMITER ;
         
b)      DELIMTER //
        CREATE TRIGGER verifica_conta BEFORE INSERT ON borrower
        FOR EACH ROW
        BEGIN
                SET @cliente = (SELECT NEW.costumer_name);
                SET @mensagem = concat('O cliente ', @cliente, 'não tem conta neste banco.');
                IF NEW.costumer_name NOT IN (SELECT costumer_name FROM depositior) THEN
                CALL error;
                END IF;
        END
                
        DELIMITER ;
