CREATE TABLE customer( 
      id number(10)    NOT NULL , 
      name varchar  (100)    NOT NULL , 
      document varchar  (30)    NOT NULL , 
      document_type char(1)    DEFAULT '0'  NOT NULL , 
      email varchar  (100)   , 
      city varchar  (60)   , 
      uf varchar  (60)   , 
      postal_code varchar  (20)   , 
      phone_1 varchar  (20)   , 
      phone_2 varchar  (30)   , 
      phone_3 varchar  (30)   , 
      system_user number(10)   , 
      store_partiner number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE store_partiner( 
      id number(10)    NOT NULL , 
      name varchar  (100)    NOT NULL , 
      cnpj varchar  (20)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE customer ADD UNIQUE (document);
 ALTER TABLE customer ADD UNIQUE (system_user);
 ALTER TABLE store_partiner ADD UNIQUE (name);
 ALTER TABLE store_partiner ADD UNIQUE (cnpj);
  
 ALTER TABLE customer ADD CONSTRAINT fk_customer_store_partiner FOREIGN KEY (store_partiner) references store_partiner(id); 
 CREATE SEQUENCE customer_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER customer_id_seq_tr 

BEFORE INSERT ON customer FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT customer_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE store_partiner_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER store_partiner_id_seq_tr 

BEFORE INSERT ON store_partiner FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT store_partiner_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
