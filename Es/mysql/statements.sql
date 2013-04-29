

CREATE  DATABASE es;
CONNECT es;

CREATE TABLE `clients` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE = MYISAM;

CREATE TABLE `calls` (
`client_from` int(10) unsigned NOT NULL,
`client_to` int(10) unsigned NOT NULL,
`duration` int(10) unsigned NOT NULL,
`cost` decimal(6,1) unsigned NOT NULL,
`date` timestamp NOT NULL default '0000-00-00 00:00:00'
) ENGINE=MyISAM;


-- 1. Write a SQL statement to only get the « name » of all the company’s client.

ALTER TABLE clients ADD INDEX idx_name ( name ) ; 
SELECT DISTINCT name FROM clients ORDER BY 1;


-- 2. Write a SQL statement adding the « Facebook » client to the « clients »’s table

INSERT INTO clients (name) values ('Facebook');
SELECT ID from clients where name='Facebook';  -- pour avoir l'Id


-- 3. Write a SQL statement to get the name and id of the clients who called at least one time.
-- There must be unique results. Please give two possible answers if possible.

SELECT cl.name, cl.id FROM clients cl INNER JOIN calls ca on cl.id = ca.client_from GROUP BY 1,2 ORDER BY 1;
-- ou bien 
SELECT DISTINCT cl.name, cl.id FROM clients cl INNER JOIN calls ca on cl.id = ca.client_from ORDER BY 1;


-- 4. Write a SQL statement to get the name and id of the clients who received at least one
-- call. There must be unique results. Please give two possible answers if possible.

SELECT cl.name, cl.id FROM clients cl INNER JOIN calls ca on cl.id = ca.client_to GROUP BY 1,2 ORDER BY 1;
-- ou bien 
SELECT DISTINCT cl.name, cl.id FROM clients cl INNER JOIN calls ca on cl.id = ca.client_to ORDER BY 1;



-- 5. Write a SQL statement to get the name and id of the clients who have not received a call
-- yet. There must be unique results.

SELECT cl.name, cl.id FROM clients cl LEFT JOIN calls ca on cl.id = ca.client_to WHERE ca.client_from IS NULL GROUP BY 1,2 ORDER BY 1;
-- ou bien 
SELECT DISTINCT cl.name, cl.id FROM clients cl LEFT JOIN calls ca on cl.id = ca.client_to WHERE ca.client_from IS NULL  ORDER BY 1;



-- 6. Write a SQL statement to get the name and id of the clients who have not called
-- someone yet. There must be unique results.

SELECT cl.name, cl.id FROM clients cl LEFT JOIN calls ca on cl.id = ca.client_from WHERE ca.client_to IS NULL GROUP BY 1,2 ORDER BY 1;
-- ou bien 
SELECT DISTINCT cl.name, cl.id FROM clients cl LEFT JOIN calls ca on cl.id = ca.client_from WHERE ca.client_to IS NULL  ORDER BY 1;



-- 7. Write the most simple SQL statement to get all the calls starting from the 24/01/2011
-- and the 03/03/2011 (start date and end date included).

SELECT * FROM calls WHERE date BETWEEN '2011-01-24 00:00:00' AND '2011-03-03 23:59:59' order by 1;  -- pas tout à fait exact car on omet la dernière seconde

-- ou bien

SELECT * FROM calls WHERE date >= '2011-01-24 00:00:00' AND date <'2011-03-04 00:00:00' order by 1; -- plus juste



-- 8. Write a SQL statement to get the total cost of all calls made by the client « Adams » with
-- the id 42. Only this total cost must be returned and it must be named as « total_cost »

INSERT INTO clients (id, name) values (42, 'Adams');

SELECT SUM(cost) AS total_cost FROM calls where client_from = 42;



-- 9. Write a SQL statement to get the total cost associated to each caller.

SELECT cl.name, cl.id, SUM(ca.cost) AS total_cost FROM clients cl INNER JOIN calls ca ON cl.id = ca.client_from GROUP BY 1,2 ORDER BY 1;

-- c'est le cas idéal ou la table clients est à jour mais par expérience avec SFR, j'ai connu des tables d'appels qui avant consolidation n'avait pas de pendant dans la table clients, il faudrait donc d'abord le vérifier.



-- 10. Write a SQL statement to insert a new call in the « calls » table. This call was made by
-- the client id 42 to the client id 56 and lasted 40 minutes. The communication cost is 0,1
-- euros/minute. The call began at 10pm on the 21/05/2009.

INSERT INTO calls (client_from, client_to, duration, cost, date ) VALUES (42,56, 40, 0.1*40, '2009-05-21 22:00:00');


-- 11. What is not optimized in the structure of the « calls » table regarding the previous
-- statments you wrote (Q. 3, 4, 5, 6) ? Are there something else not optimized for this
-- table ?

ALTER TABLE calls ADD INDEX idx_client_from ( client_from ) ; 
ALTER TABLE calls ADD INDEX idx_client_to   ( client_to ) ; 


