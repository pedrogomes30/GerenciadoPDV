CREATE TABLE cashier( 
      id  INT IDENTITY    NOT NULL  , 
      name varchar  (20)   NOT NULL  , 
      cashier_type int   NOT NULL    DEFAULT 1, 
      user_authenticated int   , 
      store int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cashier_log( 
      id  INT IDENTITY    NOT NULL  , 
      dt_login datetime2   NOT NULL  , 
      dt_logout datetime2   NOT NULL  , 
      user int   NOT NULL  , 
      cashier_id int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE payment_method( 
      id  INT IDENTITY    NOT NULL  , 
      method varchar  (50)   NOT NULL  , 
      alias varchar  (50)   NOT NULL  , 
      issue bit   NOT NULL    DEFAULT false, 
 PRIMARY KEY (id)) ; 

CREATE TABLE payment_method_store( 
      id  INT IDENTITY    NOT NULL  , 
      method int   NOT NULL  , 
      store int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE profession( 
      id  INT IDENTITY    NOT NULL  , 
      description varchar  (60)   NOT NULL  , 
      is_manager bit   NOT NULL    DEFAULT '0', 
 PRIMARY KEY (id)) ; 

CREATE TABLE store( 
      id  INT IDENTITY    NOT NULL  , 
      social_name varchar  (50)   NOT NULL  , 
      abbreviation varchar  (5)   NOT NULL  , 
      cnpj varchar  (20)   NOT NULL  , 
      icon_url varchar  (255)   , 
      fantasy_name varchar  (100)   , 
      obs varchar  (200)   , 
      state_inscription varchar  (30)   , 
      municipal_inscription varchar  (30)   , 
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
 PRIMARY KEY (id)) ; 

CREATE TABLE store_group( 
      id  INT IDENTITY    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      default_theme json   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE user( 
      id  INT IDENTITY    NOT NULL  , 
      obs varchar  (200)   , 
      profile_img varchar  (255)   , 
      origin_store int     DEFAULT 1, 
      current_store int   NOT NULL  , 
      profession int   NOT NULL  , 
      system_user int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE user_store_transfer( 
      id  INT IDENTITY    NOT NULL  , 
      dt_transfer date   NOT NULL  , 
      reason varchar  (100)   , 
      user int   NOT NULL  , 
      store_origin int   NOT NULL  , 
      store_destiny int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE cashier ADD UNIQUE (user_authenticated);
 ALTER TABLE payment_method ADD UNIQUE (method);
 ALTER TABLE payment_method ADD UNIQUE (alias);
 ALTER TABLE store ADD UNIQUE (abbreviation);
 ALTER TABLE store ADD UNIQUE (cnpj);
 ALTER TABLE store ADD UNIQUE (fantasy_name);
 ALTER TABLE store ADD UNIQUE (state_inscription);
  
 ALTER TABLE cashier ADD CONSTRAINT fk_cashier_store FOREIGN KEY (store) references store(id); 
ALTER TABLE cashier ADD CONSTRAINT fk_cashier_person FOREIGN KEY (user_authenticated) references user(id); 
ALTER TABLE cashier_log ADD CONSTRAINT fk_cashier_log_cashier FOREIGN KEY (cashier_id) references cashier(id); 
ALTER TABLE cashier_log ADD CONSTRAINT fk_cashier_log_user FOREIGN KEY (user) references user(id); 
ALTER TABLE payment_method_store ADD CONSTRAINT fk_method_payment_store_method FOREIGN KEY (method) references payment_method(id); 
ALTER TABLE payment_method_store ADD CONSTRAINT fk_method_payment_store_store FOREIGN KEY (store) references store(id); 
ALTER TABLE store ADD CONSTRAINT fk_store_group_store FOREIGN KEY (store_group) references store_group(id); 
ALTER TABLE user ADD CONSTRAINT fk_user_profession FOREIGN KEY (profession) references profession(id); 
ALTER TABLE user ADD CONSTRAINT fk_user_store_origin FOREIGN KEY (origin_store) references store(id); 
ALTER TABLE user ADD CONSTRAINT fk_person_current_store FOREIGN KEY (current_store) references store(id); 
ALTER TABLE user_store_transfer ADD CONSTRAINT fk_user_store_transfer_user FOREIGN KEY (user) references user(id); 
ALTER TABLE user_store_transfer ADD CONSTRAINT fk_user_store_transfer_destiny FOREIGN KEY (store_destiny) references store(id); 
ALTER TABLE user_store_transfer ADD CONSTRAINT fk_user_store_transfer_origin FOREIGN KEY (store_origin) references store(id); 

  
