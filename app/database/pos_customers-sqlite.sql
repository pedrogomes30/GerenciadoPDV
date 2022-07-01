PRAGMA foreign_keys=OFF; 

CREATE TABLE address( 
      id  INTEGER    NOT NULL  , 
      postalCode varchar  (20)   NOT NULL  , 
      customer int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(customer) REFERENCES customer(id)) ; 

CREATE TABLE customer( 
      id  INTEGER    NOT NULL  , 
      name varchar  (100)   NOT NULL  , 
      document varchar  (30)   NOT NULL  , 
      document_type text   NOT NULL    DEFAULT 'F', 
      email varchar  (100)   NOT NULL  , 
      phone_1 varchar  (20)   , 
      phone_2 varchar  (30)   , 
      phone_3 varchar  (30)   , 
      system_user int   , 
      store_partiner int   , 
 PRIMARY KEY (id),
FOREIGN KEY(store_partiner) REFERENCES store_partiner(id)) ; 

CREATE TABLE store_partiner( 
      id  INTEGER    NOT NULL  , 
      name varchar  (100)   NOT NULL  , 
      cnpj varchar  (20)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_customer_system_user ON customer(system_user);
 
  
