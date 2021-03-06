CREATE TABLE customer( 
      id  integer generated by default as identity     NOT NULL , 
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
      system_user integer   , 
      store_partiner integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE store_partiner( 
      id  integer generated by default as identity     NOT NULL , 
      name varchar  (100)    NOT NULL , 
      cnpj varchar  (20)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_customer_document ON customer COMPUTED BY (document);
 CREATE UNIQUE INDEX unique_idx_customer_system_user ON customer COMPUTED BY (system_user);
 CREATE UNIQUE INDEX unique_idx_store_partiner_name ON store_partiner COMPUTED BY (name);
 CREATE UNIQUE INDEX unique_idx_store_partiner_cnpj ON store_partiner COMPUTED BY (cnpj);
  
 ALTER TABLE customer ADD CONSTRAINT fk_customer_store_partiner FOREIGN KEY (store_partiner) references store_partiner(id); 

  
