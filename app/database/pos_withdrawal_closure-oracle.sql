CREATE TABLE adjust_closure( 
      id number(10)    NOT NULL , 
      justify varchar  (200)    NOT NULL , 
      adjust_value binary_double    NOT NULL , 
      closure number(10)    NOT NULL , 
      cashier_method number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE closure( 
      id number(10)    NOT NULL , 
      dt_close timestamp(0)   , 
      number varchar  (30)    NOT NULL , 
      closure_type char(1)    DEFAULT false  NOT NULL , 
      dt_open timestamp(0)    NOT NULL , 
      value_total binary_double    NOT NULL , 
      user number(10)    NOT NULL , 
      cashier number(10)    NOT NULL , 
      store number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE closure_payment_methods( 
      id number(10)    NOT NULL , 
      closure number(10)    NOT NULL , 
      payment_method number(10)    NOT NULL , 
      value binary_double    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE withdrawal( 
      id number(10)    NOT NULL , 
      user number(10)    NOT NULL , 
      store number(10)    NOT NULL , 
      cashier number(10)    NOT NULL , 
      closure number(10)    NOT NULL , 
      withdrawal_account number(10)    NOT NULL , 
      dt_withdrawal date    NOT NULL , 
      value binary_double    NOT NULL , 
      obs varchar  (200)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE withdrawal_account( 
      id number(10)    NOT NULL , 
      withdrawal number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE closure ADD UNIQUE (number);
  
 ALTER TABLE adjust_closure ADD CONSTRAINT fk_Adjust_cashier_finish_1 FOREIGN KEY (closure) references closure(id); 
ALTER TABLE adjust_closure ADD CONSTRAINT fk_Adjust_cashier_finish_2 FOREIGN KEY (cashier_method) references closure_payment_methods(id); 
ALTER TABLE closure_payment_methods ADD CONSTRAINT fk_closure_payment_methods_closure FOREIGN KEY (closure) references closure(id); 
ALTER TABLE withdrawal ADD CONSTRAINT fk_withdrawal_closure FOREIGN KEY (closure) references closure(id); 
ALTER TABLE withdrawal ADD CONSTRAINT fk_withdrawal_account FOREIGN KEY (withdrawal_account) references withdrawal_account(id); 
 CREATE SEQUENCE adjust_closure_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER adjust_closure_id_seq_tr 

BEFORE INSERT ON adjust_closure FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT adjust_closure_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE closure_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER closure_id_seq_tr 

BEFORE INSERT ON closure FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT closure_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE closure_payment_methods_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER closure_payment_methods_id_seq_tr 

BEFORE INSERT ON closure_payment_methods FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT closure_payment_methods_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE withdrawal_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER withdrawal_id_seq_tr 

BEFORE INSERT ON withdrawal FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT withdrawal_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE withdrawal_account_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER withdrawal_account_id_seq_tr 

BEFORE INSERT ON withdrawal_account FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT withdrawal_account_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
