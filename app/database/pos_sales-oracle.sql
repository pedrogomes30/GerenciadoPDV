CREATE TABLE sale( 
      id number(10)    NOT NULL , 
      number varchar  (30)    NOT NULL , 
      products_value binary_double    NOT NULL , 
      payments_value binary_double    NOT NULL , 
      total_value binary_double    NOT NULL , 
      sale_date timestamp(0)    NOT NULL , 
      invoiced char(1)    DEFAULT false  NOT NULL , 
      invoice_ambient char(1)    DEFAULT false  NOT NULL , 
      discont_value binary_double   , 
      obs varchar  (400)   , 
      invoice_number number(10)   , 
      invoice_serie number(10)   , 
      invoice_coupon varchar(3000)   , 
      invoice_xml varchar(3000)   , 
      payment_method number(10)    NOT NULL , 
      store number(10)    NOT NULL , 
      employee_cashier number(10)    NOT NULL , 
      cashier number(10)    NOT NULL , 
      client number(10)   , 
      salesman number(10)   , 
      status number(10)    DEFAULT 2  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE sale_item( 
      id number(10)    NOT NULL , 
      discont_value binary_double   , 
      quantity number(10)    NOT NULL , 
      unitary_value binary_double    NOT NULL , 
      total_value binary_double    NOT NULL , 
      sale_date date    NOT NULL , 
      sale number(10)    NOT NULL , 
      store number(10)    NOT NULL , 
      deposit number(10)    NOT NULL , 
      product_storage number(10)    NOT NULL , 
      product number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE sale_payment( 
      id number(10)    NOT NULL , 
      value binary_double    NOT NULL , 
      sale_date date    NOT NULL , 
      store number(10)    NOT NULL , 
      sale number(10)    NOT NULL , 
      payment_method number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE status( 
      id number(10)    NOT NULL , 
      description varchar  (50)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE status ADD UNIQUE (description);
  
 ALTER TABLE sale ADD CONSTRAINT fk_sale_status FOREIGN KEY (status) references status(id); 
ALTER TABLE sale_item ADD CONSTRAINT fk_sale_item_sale FOREIGN KEY (sale) references sale(id); 
ALTER TABLE sale_payment ADD CONSTRAINT fk_payment_sale FOREIGN KEY (sale) references sale(id); 
 CREATE SEQUENCE sale_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER sale_id_seq_tr 

BEFORE INSERT ON sale FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT sale_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE sale_item_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER sale_item_id_seq_tr 

BEFORE INSERT ON sale_item FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT sale_item_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE sale_payment_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER sale_payment_id_seq_tr 

BEFORE INSERT ON sale_payment FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT sale_payment_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE status_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER status_id_seq_tr 

BEFORE INSERT ON status FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT status_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
