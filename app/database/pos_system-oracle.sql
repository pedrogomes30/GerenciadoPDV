CREATE TABLE cashier( 
      id number(10)    NOT NULL , 
      name varchar  (20)    NOT NULL , 
      cashier_type number(10)    DEFAULT 1  NOT NULL , 
      user_authenticated number(10)   , 
      store number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cashier_log( 
      id number(10)    NOT NULL , 
      dt_login timestamp(0)    NOT NULL , 
      dt_logout timestamp(0)    NOT NULL , 
      user number(10)    NOT NULL , 
      cashier_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE group_store( 
      id number(10)    NOT NULL , 
      name varchar  (50)    NOT NULL , 
      default_theme json   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE method_payment_store( 
      id number(10)    NOT NULL , 
      method_id number(10)    NOT NULL , 
      store_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE payment_method( 
      id number(10)    NOT NULL , 
      method varchar  (50)    NOT NULL , 
      issue char(1)    DEFAULT false  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE store( 
      id number(10)    NOT NULL , 
      social_name varchar  (50)    NOT NULL , 
      abbreviation varchar  (5)    NOT NULL , 
      cnpj varchar  (20)    NOT NULL , 
      icon_url varchar  (255)   , 
      fantasy_name varchar  (100)   , 
      obs varchar  (200)   , 
      state_inscription varchar  (30)   , 
      minicipal_inscription varchar  (30)   , 
      icms varchar  (30)   , 
      tax_regime varchar  (5)   , 
      invoice_type number(10)    DEFAULT 1  NOT NULL , 
      invoice_provider_id varchar  (50)   , 
      production_csc_number varchar  (50)   , 
      production_csc_id varchar  (50)   , 
      production_invoice_serie number(10)   , 
      production_invoice_sequence number(10)   , 
      homologation_csc_number varchar  (50)   , 
      homologation_csc_id varchar  (50)   , 
      homologation_invoice_serie number(10)   , 
      homologation_invoice_sequence number(10)   , 
      certificate_password varchar  (50)   , 
      store_group number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE user( 
      id number(10)    NOT NULL , 
      obs varchar  (200)   , 
      is_manager char(1)    DEFAULT false  NOT NULL , 
      store number(10)   , 
      system_user number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE user_store_transfer( 
      id number(10)    NOT NULL , 
      dt_transfer date    NOT NULL , 
      reason varchar  (100)   , 
      user number(10)    NOT NULL , 
      store_origin number(10)    NOT NULL , 
      store_destiny number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE cashier ADD UNIQUE (user_authenticated);
 ALTER TABLE payment_method ADD UNIQUE (method);
 ALTER TABLE store ADD UNIQUE (abbreviation);
 ALTER TABLE store ADD UNIQUE (cnpj);
 ALTER TABLE store ADD UNIQUE (fantasy_name);
 ALTER TABLE store ADD UNIQUE (state_inscription);
  
 ALTER TABLE cashier ADD CONSTRAINT fk_cashier_store FOREIGN KEY (store) references store(id); 
ALTER TABLE cashier ADD CONSTRAINT fk_cashier_person FOREIGN KEY (user_authenticated) references user(id); 
ALTER TABLE cashier_log ADD CONSTRAINT fk_cashier_log_cashier FOREIGN KEY (cashier_id) references cashier(id); 
ALTER TABLE cashier_log ADD CONSTRAINT fk_cashier_log_user FOREIGN KEY (user) references user(id); 
ALTER TABLE method_payment_store ADD CONSTRAINT fk_method_payment_store_method FOREIGN KEY (method_id) references payment_method(id); 
ALTER TABLE method_payment_store ADD CONSTRAINT fk_method_payment_store_store FOREIGN KEY (store_id) references store(id); 
ALTER TABLE store ADD CONSTRAINT fk_store_group_store FOREIGN KEY (store_group) references group_store(id); 
ALTER TABLE user ADD CONSTRAINT fk_person_store FOREIGN KEY (store) references store(id); 
ALTER TABLE user_store_transfer ADD CONSTRAINT fk_user_store_transfer_user FOREIGN KEY (user) references user(id); 
ALTER TABLE user_store_transfer ADD CONSTRAINT fk_user_store_transfer_destiny FOREIGN KEY (store_destiny) references store(id); 
ALTER TABLE user_store_transfer ADD CONSTRAINT fk_user_store_transfer_origin FOREIGN KEY (store_origin) references store(id); 
 CREATE SEQUENCE cashier_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cashier_id_seq_tr 

BEFORE INSERT ON cashier FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cashier_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cashier_log_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cashier_log_id_seq_tr 

BEFORE INSERT ON cashier_log FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cashier_log_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE group_store_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER group_store_id_seq_tr 

BEFORE INSERT ON group_store FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT group_store_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE method_payment_store_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER method_payment_store_id_seq_tr 

BEFORE INSERT ON method_payment_store FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT method_payment_store_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE payment_method_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER payment_method_id_seq_tr 

BEFORE INSERT ON payment_method FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT payment_method_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE store_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER store_id_seq_tr 

BEFORE INSERT ON store FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT store_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE user_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER user_id_seq_tr 

BEFORE INSERT ON user FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT user_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE user_store_transfer_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER user_store_transfer_id_seq_tr 

BEFORE INSERT ON user_store_transfer FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT user_store_transfer_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
