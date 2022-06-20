PRAGMA foreign_keys=OFF; 

CREATE TABLE cashier( 
      id  INTEGER    NOT NULL  , 
      name varchar  (20)   NOT NULL  , 
      cashier_type int   NOT NULL    DEFAULT 1, 
      user_authenticated int   , 
      store int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(store) REFERENCES store(id),
FOREIGN KEY(user_authenticated) REFERENCES user(id)) ; 

CREATE TABLE cashier_log( 
      id  INTEGER    NOT NULL  , 
      dt_login datetime   NOT NULL  , 
      dt_logout datetime   NOT NULL  , 
      user int   NOT NULL  , 
      cashier_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(cashier_id) REFERENCES cashier(id),
FOREIGN KEY(user) REFERENCES user(id)) ; 

CREATE TABLE group_store( 
      id  INTEGER    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      default_theme json   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE method_payment_store( 
      id  INTEGER    NOT NULL  , 
      method_id int   NOT NULL  , 
      store_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(method_id) REFERENCES payment_method(id),
FOREIGN KEY(store_id) REFERENCES store(id)) ; 

CREATE TABLE payment_method( 
      id  INTEGER    NOT NULL  , 
      method varchar  (50)   NOT NULL  , 
      issue text   NOT NULL    DEFAULT 'F', 
 PRIMARY KEY (id)) ; 

CREATE TABLE store( 
      id  INTEGER    NOT NULL  , 
      social_name varchar  (50)   NOT NULL  , 
      abbreviation varchar  (5)   NOT NULL  , 
      cnpj varchar  (20)   NOT NULL  , 
      icon_url varchar  (255)   , 
      fantasy_name varchar  (100)   , 
      obs varchar  (200)   , 
      state_inscription varchar  (30)   , 
      minicipal_inscription varchar  (30)   , 
      icms varchar  (30)   , 
      tax_regime varchar  (5)   , 
      invoice_type int   NOT NULL    DEFAULT 1, 
      invoice_provider_id varchar  (50)   , 
      production_csc_number varchar  (50)   , 
      production_csc_id varchar  (50)   , 
      production_invoice_serie int   , 
      production_invoice_sequence int   , 
      homologation_csc_number varchar  (50)   , 
      homologation_csc_id varchar  (50)   , 
      homologation_invoice_serie int   , 
      homologation_invoice_sequence int   , 
      certificate_password varchar  (50)   , 
      store_group int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(store_group) REFERENCES group_store(id)) ; 

CREATE TABLE user( 
      id  INTEGER    NOT NULL  , 
      obs varchar  (200)   , 
      is_manager text   NOT NULL    DEFAULT 'F', 
      store int   , 
      system_user int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(store) REFERENCES store(id)) ; 

CREATE TABLE user_store_transfer( 
      id  INTEGER    NOT NULL  , 
      dt_transfer date   NOT NULL  , 
      reason varchar  (100)   , 
      user int   NOT NULL  , 
      store_origin int   NOT NULL  , 
      store_destiny int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(user) REFERENCES user(id),
FOREIGN KEY(store_destiny) REFERENCES store(id),
FOREIGN KEY(store_origin) REFERENCES store(id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_cashier_user_authenticated ON cashier(user_authenticated);
 CREATE UNIQUE INDEX unique_idx_payment_method_method ON payment_method(method);
 CREATE UNIQUE INDEX unique_idx_store_abbreviation ON store(abbreviation);
 CREATE UNIQUE INDEX unique_idx_store_cnpj ON store(cnpj);
 CREATE UNIQUE INDEX unique_idx_store_fantasy_name ON store(fantasy_name);
 CREATE UNIQUE INDEX unique_idx_store_state_inscription ON store(state_inscription);
 
  
