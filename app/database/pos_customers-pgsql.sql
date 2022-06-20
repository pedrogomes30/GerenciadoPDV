CREATE TABLE address( 
      id  SERIAL    NOT NULL  , 
      postalCode varchar  (20)   NOT NULL  , 
      customer integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE customer( 
      id  SERIAL    NOT NULL  , 
      name varchar  (100)   NOT NULL  , 
      document varchar  (30)   NOT NULL  , 
      document_type boolean   NOT NULL    DEFAULT false, 
      email varchar  (100)   NOT NULL  , 
      phone_1 varchar  (20)   , 
      phone_2 varchar  (30)   , 
      phone_3 varchar  (30)   , 
      system_user integer   , 
      store_partiner integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE store_partiner( 
      id  SERIAL    NOT NULL  , 
      name varchar  (100)   NOT NULL  , 
      cnpj varchar  (20)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE customer ADD UNIQUE (system_user);
  
 ALTER TABLE address ADD CONSTRAINT fk_address_customer FOREIGN KEY (customer) references customer(id); 
ALTER TABLE customer ADD CONSTRAINT fk_customer_store_partiner FOREIGN KEY (store_partiner) references store_partiner(id); 

  
