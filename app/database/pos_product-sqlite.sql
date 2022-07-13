PRAGMA foreign_keys=OFF; 

CREATE TABLE brand( 
      id  INTEGER    NOT NULL  , 
      name varchar  (100)   NOT NULL  , 
      provider int   , 
 PRIMARY KEY (id),
FOREIGN KEY(provider) REFERENCES provider(id)) ; 

CREATE TABLE category( 
      id  INTEGER    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      color varchar  (30)   NOT NULL    DEFAULT '#FD03BE', 
      multiply double   NOT NULL    DEFAULT 1, 
      icon_category varchar  (400)   , 
      cest_ncm_default int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(cest_ncm_default) REFERENCES cest_ncm(id)) ; 

CREATE TABLE cest( 
      id  INTEGER    NOT NULL  , 
      description varchar  (800)   NOT NULL  , 
      number varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cest_ncm( 
      id  INTEGER    NOT NULL  , 
      cest int   NOT NULL  , 
      ncm int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(cest) REFERENCES cest(id),
FOREIGN KEY(ncm) REFERENCES ncm(id)) ; 

CREATE TABLE cupom( 
      id  INTEGER    NOT NULL  , 
      with_client varchar  (30)   , 
      code varchar  (8)   NOT NULL  , 
      value double   NOT NULL  , 
      description varchar  (100)   NOT NULL  , 
      all_products text   NOT NULL    DEFAULT '0', 
      acumulate text   NOT NULL    DEFAULT '0', 
      percent text   NOT NULL    DEFAULT '0', 
      quantity int   NOT NULL    DEFAULT 0, 
      default text   NOT NULL    DEFAULT '0', 
 PRIMARY KEY (id)) ; 

CREATE TABLE cupom_products( 
      id  INTEGER    NOT NULL  , 
      product int   NOT NULL  , 
      cupom int   NOT NULL  , 
      active text   NOT NULL    DEFAULT '1', 
 PRIMARY KEY (id),
FOREIGN KEY(product) REFERENCES product(id),
FOREIGN KEY(cupom) REFERENCES cupom(id)) ; 

CREATE TABLE deposit( 
      id  INTEGER    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      store int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ncm( 
      id  INTEGER    NOT NULL  , 
      description varchar  (800)   NOT NULL  , 
      number varchar  (25)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE price( 
      id  INTEGER    NOT NULL  , 
      sell_price double   NOT NULL  , 
      cost_price double   , 
      product int   NOT NULL  , 
      price_list int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(price_list) REFERENCES price_list(id),
FOREIGN KEY(product) REFERENCES product(id)) ; 

CREATE TABLE price_list( 
      id  INTEGER    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      store int   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product( 
      id  INTEGER    NOT NULL  , 
      description varchar  (60)   NOT NULL  , 
      sku varchar  (20)   NOT NULL  , 
      unity varchar  (2)   NOT NULL    DEFAULT 'UN', 
      dt_created datetime   NOT NULL  , 
      dt_modify datetime   , 
      description_variation varchar  (50)   , 
      reference varchar  (30)   , 
      barcode varchar  (20)   , 
      family_id int   , 
      obs varchar  (60)   , 
      website varchar  (100)   , 
      origin varchar  (10)   NOT NULL  , 
      cfop int   NOT NULL    DEFAULT 504, 
      tribute_situation varchar  (20)   NOT NULL  , 
      cest varchar  (20)   , 
      ncm varchar  (20)   NOT NULL  , 
      is_variation text   NOT NULL    DEFAULT 'F', 
      cest_ncm int   , 
      provider int   , 
      brand int   , 
      type int   NOT NULL    DEFAULT 1, 
      status int   NOT NULL    DEFAULT 1, 
      category int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(category) REFERENCES category(id),
FOREIGN KEY(brand) REFERENCES brand(id),
FOREIGN KEY(provider) REFERENCES provider(id),
FOREIGN KEY(cest_ncm) REFERENCES cest_ncm(id),
FOREIGN KEY(status) REFERENCES product_status(id),
FOREIGN KEY(type) REFERENCES product_type(id)) ; 

CREATE TABLE product_status( 
      id  INTEGER    NOT NULL  , 
      status varchar  (30)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_storage( 
      id  INTEGER    NOT NULL  , 
      quantity int   NOT NULL  , 
      min_storage int   , 
      max_storage int   , 
      deposit int   NOT NULL  , 
      product int   NOT NULL  , 
      store int   , 
 PRIMARY KEY (id),
FOREIGN KEY(deposit) REFERENCES deposit(id),
FOREIGN KEY(product) REFERENCES product(id)) ; 

CREATE TABLE product_transfer( 
      id  INTEGER    NOT NULL  , 
      quantity int   NOT NULL  , 
      transfer_type varchar  (20)   NOT NULL    DEFAULT 'transferencia', 
      protocol int   , 
      user int   , 
      deposit_origin int   , 
      product_storage_origin int   , 
      deposit_destiny int   NOT NULL  , 
      product_storage_destiny int   NOT NULL  , 
      product int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(deposit_origin) REFERENCES deposit(id),
FOREIGN KEY(product) REFERENCES product(id),
FOREIGN KEY(deposit_destiny) REFERENCES deposit(id),
FOREIGN KEY(product_storage_origin) REFERENCES product_storage(id),
FOREIGN KEY(product_storage_destiny) REFERENCES product_storage(id)) ; 

CREATE TABLE product_type( 
      id  INTEGER    NOT NULL  , 
      description varchar  (200)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_validate_date( 
      id  INTEGER    NOT NULL  , 
      lote varchar  (50)   , 
      dt_validate date   NOT NULL  , 
      product int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(product) REFERENCES product(id)) ; 

CREATE TABLE provider( 
      id  INTEGER    NOT NULL  , 
      social_name varchar  (100)   NOT NULL  , 
      cnpj varchar  (20)   NOT NULL  , 
      fantasy_name varchar  (50)   , 
 PRIMARY KEY (id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_product_sku ON product(sku);
 
  
