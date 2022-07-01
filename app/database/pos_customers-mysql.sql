CREATE TABLE address( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `postalCode` varchar  (20)   NOT NULL  , 
      `customer` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE customer( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `name` varchar  (100)   NOT NULL  , 
      `document` varchar  (30)   NOT NULL  , 
      `document_type` boolean   NOT NULL    DEFAULT false, 
      `email` varchar  (100)   NOT NULL  , 
      `phone_1` varchar  (20)   , 
      `phone_2` varchar  (30)   , 
      `phone_3` varchar  (30)   , 
      `system_user` int   , 
      `store_partiner` int   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE store_partiner( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `name` varchar  (100)   NOT NULL  , 
      `cnpj` varchar  (20)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
 ALTER TABLE customer ADD UNIQUE (system_user);
  
 ALTER TABLE address ADD CONSTRAINT fk_address_customer FOREIGN KEY (customer) references customer(id); 
ALTER TABLE customer ADD CONSTRAINT fk_customer_store_partiner FOREIGN KEY (store_partiner) references store_partiner(id); 

  
