PRAGMA foreign_keys=OFF; 

CREATE TABLE cashier( 
      id  INTEGER    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      cashier_type text   NOT NULL    DEFAULT '0', 
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

CREATE TABLE payment_method( 
      id  INTEGER    NOT NULL  , 
      method varchar  (50)   NOT NULL  , 
      alias varchar  (50)   NOT NULL  , 
      issue text   NOT NULL    DEFAULT 'F', 
 PRIMARY KEY (id)) ; 

CREATE TABLE payment_method_store( 
      id  INTEGER    NOT NULL  , 
      method int   NOT NULL  , 
      store int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(method) REFERENCES payment_method(id),
FOREIGN KEY(store) REFERENCES store(id)) ; 

CREATE TABLE profession( 
      id  INTEGER    NOT NULL  , 
      description varchar  (60)   NOT NULL  , 
      is_manager text   NOT NULL    DEFAULT '0', 
 PRIMARY KEY (id)) ; 

CREATE TABLE store( 
      id  INTEGER    NOT NULL  , 
      social_name varchar  (50)   NOT NULL  , 
      abbreviation varchar  (5)   NOT NULL  , 
      cnpj varchar  (20)   NOT NULL  , 
      dt_create date   NOT NULL  , 
      fantasy_name varchar  (100)   , 
      icon_url varchar  (255)   , 
      email varchar  (80)   , 
      fone varchar  (15)   , 
      cep varchar  (10)   NOT NULL  , 
      city varchar  (60)   , 
      address_complement varchar  (60)   , 
      address_number varchar  (20)   , 
      neighborhood varchar  (60)   , 
      street varchar  (150)   , 
      obs varchar  (200)   , 
      invoice_type int   NOT NULL    DEFAULT 1, 
      state_inscription varchar  (30)   , 
      municipal_inscription varchar  (30)   , 
      icms varchar  (30)   , 
      tax_regime varchar  (5)   , 
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
      certificate_validate date   , 
      store_group int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(store_group) REFERENCES store_group(id)) ; 

CREATE TABLE store_group( 
      id  INTEGER    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      default_theme json   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE user( 
      id  INTEGER    NOT NULL  , 
      obs varchar  (200)   , 
      profile_img varchar  (255)   , 
      origin_store int     DEFAULT 1, 
      current_store int   NOT NULL  , 
      profession int   NOT NULL  , 
      system_user int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(profession) REFERENCES profession(id),
FOREIGN KEY(origin_store) REFERENCES store(id),
FOREIGN KEY(current_store) REFERENCES store(id)) ; 

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
 CREATE UNIQUE INDEX unique_idx_payment_method_alias ON payment_method(alias);
 CREATE UNIQUE INDEX unique_idx_store_abbreviation ON store(abbreviation);
 CREATE UNIQUE INDEX unique_idx_store_cnpj ON store(cnpj);
 CREATE UNIQUE INDEX unique_idx_store_fantasy_name ON store(fantasy_name);
 CREATE UNIQUE INDEX unique_idx_store_state_inscription ON store(state_inscription);
 
  
