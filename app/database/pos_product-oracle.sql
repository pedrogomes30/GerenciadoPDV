CREATE TABLE brand( 
      id number(10)    NOT NULL , 
      name varchar  (100)    NOT NULL , 
      provider number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE category( 
      id number(10)    NOT NULL , 
      name varchar  (50)    NOT NULL , 
      cest_ncm_default number(10)    NOT NULL , 
      icon_category varchar  (400)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cest( 
      id number(10)    NOT NULL , 
      description varchar  (200)    NOT NULL , 
      number varchar  (10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cest_ncm( 
      id number(10)    NOT NULL , 
      cest number(10)    NOT NULL , 
      ncm number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE deposit( 
      id number(10)    NOT NULL , 
      name varchar  (50)    NOT NULL , 
      store number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ncm( 
      id number(10)    NOT NULL , 
      description varchar  (200)    NOT NULL , 
      number varchar  (10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE price( 
      id number(10)    NOT NULL , 
      sell_price binary_double    NOT NULL , 
      cust_price binary_double    NOT NULL , 
      product number(10)    NOT NULL , 
      list_price number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE price_list( 
      id number(10)    NOT NULL , 
      name varchar  (30)   , 
      store number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product( 
      id number(10)    NOT NULL , 
      description varchar  (60)    NOT NULL , 
      sku varchar  (20)    NOT NULL , 
      unity varchar  (2)    DEFAULT 'UN'  NOT NULL , 
      type number(10)    DEFAULT 1  NOT NULL , 
      status varchar  (15)    DEFAULT 'Ok'  NOT NULL , 
      dt_created timestamp(0)    NOT NULL , 
      description_variation varchar  (50)   , 
      reference varchar  (30)   , 
      barcode varchar  (20)   , 
      family_id number(10)   , 
      obs varchar  (60)   , 
      website varchar  (100)   , 
      origin varchar  (100)   , 
      tribute_situation varchar  (20)   , 
      cest varchar  (20)   , 
      ncm varchar  (20)   , 
      is_variation char(1)    DEFAULT false  NOT NULL , 
      cest_ncm number(10)   , 
      provider number(10)   , 
      brand number(10)   , 
      category number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_storage( 
      id number(10)    NOT NULL , 
      quantity number(10)    NOT NULL , 
      min_storage number(10)   , 
      max_storage number(10)   , 
      deposit number(10)    NOT NULL , 
      product number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_transfer( 
      id number(10)    NOT NULL , 
      quantity number(10)    NOT NULL , 
      transfer_type varchar  (20)    DEFAULT 'transferencia'  NOT NULL , 
      protocol number(10)   , 
      user number(10)   , 
      deposit_origin number(10)   , 
      product_storage_origin number(10)   , 
      deposit_destiny number(10)    NOT NULL , 
      product_storage_destiny number(10)    NOT NULL , 
      product number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_validate_date( 
      id number(10)    NOT NULL , 
      lote varchar  (50)   , 
      dt_validate date    NOT NULL , 
      product number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE provider( 
      id number(10)    NOT NULL , 
      social_name varchar  (100)    NOT NULL , 
      cnpj varchar  (20)    NOT NULL , 
      fantasy_name varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE status_produto( 
      id number(10)    NOT NULL , 
      status varchar  (30)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_cadastro( 
      id number(10)    NOT NULL , 
      descricao varchar  (200)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE product ADD UNIQUE (sku);
  
 ALTER TABLE brand ADD CONSTRAINT fk_brand_provider FOREIGN KEY (provider) references provider(id); 
ALTER TABLE category ADD CONSTRAINT fk_category_cest_ncm FOREIGN KEY (cest_ncm_default) references cest_ncm(id); 
ALTER TABLE cest_ncm ADD CONSTRAINT fk_cest_ncm_cest FOREIGN KEY (cest) references cest(id); 
ALTER TABLE cest_ncm ADD CONSTRAINT fk_cest_ncm_ncm FOREIGN KEY (ncm) references ncm(id); 
ALTER TABLE price ADD CONSTRAINT fk_price_list_price FOREIGN KEY (list_price) references price_list(id); 
ALTER TABLE price ADD CONSTRAINT fk_price_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_category FOREIGN KEY (category) references category(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_brand FOREIGN KEY (brand) references brand(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_provider FOREIGN KEY (provider) references provider(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_ncm_cest FOREIGN KEY (cest_ncm) references cest_ncm(id); 
ALTER TABLE product_storage ADD CONSTRAINT fk_product_storage_deposit FOREIGN KEY (deposit) references deposit(id); 
ALTER TABLE product_storage ADD CONSTRAINT fk_product_storage_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_deposit_origin FOREIGN KEY (deposit_origin) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_deposit_destiny FOREIGN KEY (deposit_destiny) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product_storage_origin FOREIGN KEY (product_storage_origin) references product_storage(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product_storage_destiny FOREIGN KEY (product_storage_destiny) references product_storage(id); 
ALTER TABLE product_validate_date ADD CONSTRAINT fk_product_validate_date_product FOREIGN KEY (product) references product(id); 
 CREATE SEQUENCE brand_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER brand_id_seq_tr 

BEFORE INSERT ON brand FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT brand_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE category_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER category_id_seq_tr 

BEFORE INSERT ON category FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT category_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cest_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cest_id_seq_tr 

BEFORE INSERT ON cest FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cest_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE cest_ncm_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER cest_ncm_id_seq_tr 

BEFORE INSERT ON cest_ncm FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT cest_ncm_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE deposit_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER deposit_id_seq_tr 

BEFORE INSERT ON deposit FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT deposit_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE ncm_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER ncm_id_seq_tr 

BEFORE INSERT ON ncm FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT ncm_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE price_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER price_id_seq_tr 

BEFORE INSERT ON price FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT price_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE price_list_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER price_list_id_seq_tr 

BEFORE INSERT ON price_list FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT price_list_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE product_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER product_id_seq_tr 

BEFORE INSERT ON product FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT product_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE product_storage_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER product_storage_id_seq_tr 

BEFORE INSERT ON product_storage FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT product_storage_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE product_transfer_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER product_transfer_id_seq_tr 

BEFORE INSERT ON product_transfer FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT product_transfer_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE product_validate_date_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER product_validate_date_id_seq_tr 

BEFORE INSERT ON product_validate_date FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT product_validate_date_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE provider_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER provider_id_seq_tr 

BEFORE INSERT ON provider FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT provider_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE status_produto_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER status_produto_id_seq_tr 

BEFORE INSERT ON status_produto FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT status_produto_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE tipo_cadastro_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER tipo_cadastro_id_seq_tr 

BEFORE INSERT ON tipo_cadastro FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT tipo_cadastro_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
