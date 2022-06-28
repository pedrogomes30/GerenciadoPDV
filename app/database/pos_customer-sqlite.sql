PRAGMA foreign_keys=OFF; 

CREATE TABLE customer( 
      id  INTEGER    NOT NULL  , 
      name varchar  (100)   NOT NULL  , 
      document varchar  (30)   NOT NULL  , 
      document_type text   NOT NULL    DEFAULT '0', 
      email varchar  (100)   , 
      city varchar  (60)   , 
      uf varchar  (60)   , 
      postal_code varchar  (20)   , 
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

 
 CREATE UNIQUE INDEX unique_idx_customer_document ON customer(document);
 CREATE UNIQUE INDEX unique_idx_customer_system_user ON customer(system_user);
 CREATE UNIQUE INDEX unique_idx_store_partiner_name ON store_partiner(name);
 CREATE UNIQUE INDEX unique_idx_store_partiner_cnpj ON store_partiner(cnpj);
 
  
