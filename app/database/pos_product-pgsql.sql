CREATE TABLE brand( 
      id  SERIAL    NOT NULL  , 
      name varchar  (100)   NOT NULL  , 
      provider integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE category( 
      id  SERIAL    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      color varchar  (30)   NOT NULL    DEFAULT '#FD03BE', 
      multiply float   NOT NULL    DEFAULT 1, 
      icon_category varchar  (400)   , 
      cest_ncm_default integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cest( 
      id  SERIAL    NOT NULL  , 
      description varchar  (800)   NOT NULL  , 
      number varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cest_ncm( 
      id  SERIAL    NOT NULL  , 
      cest integer   NOT NULL  , 
      ncm integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cupom( 
      id  SERIAL    NOT NULL  , 
      with_client varchar  (30)   , 
      code varchar  (8)   NOT NULL  , 
      description varchar  (100)   NOT NULL  , 
      value float   NOT NULL  , 
      all_products boolean   NOT NULL    DEFAULT '0', 
      acumulate boolean   NOT NULL    DEFAULT '0', 
      percent boolean   NOT NULL    DEFAULT '0', 
      quantity integer   NOT NULL    DEFAULT 0, 
 PRIMARY KEY (id)) ; 

CREATE TABLE cupom_products( 
      id  SERIAL    NOT NULL  , 
      product integer   NOT NULL  , 
      cupom integer   NOT NULL  , 
      active boolean   NOT NULL    DEFAULT '1', 
 PRIMARY KEY (id)) ; 

CREATE TABLE deposit( 
      id  SERIAL    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      store integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ncm( 
      id  SERIAL    NOT NULL  , 
      description varchar  (800)   NOT NULL  , 
      number varchar  (25)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE price( 
      id  SERIAL    NOT NULL  , 
      sell_price float   NOT NULL  , 
      cost_price float   , 
      product integer   NOT NULL  , 
      price_list integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE price_list( 
      id  SERIAL    NOT NULL  , 
      name varchar  (50)   NOT NULL  , 
      store integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product( 
      id  SERIAL    NOT NULL  , 
      description varchar  (60)   NOT NULL  , 
      sku varchar  (20)   NOT NULL  , 
      unity varchar  (2)   NOT NULL    DEFAULT 'UN', 
      dt_created timestamp   NOT NULL  , 
      dt_modify timestamp   , 
      description_variation varchar  (50)   , 
      reference varchar  (30)   , 
      barcode varchar  (20)   , 
      family_id integer   , 
      obs varchar  (60)   , 
      website varchar  (100)   , 
      origin varchar  (10)   NOT NULL  , 
      cfop integer   NOT NULL    DEFAULT 504, 
      tribute_situation varchar  (20)   NOT NULL  , 
      cest varchar  (20)   , 
      ncm varchar  (20)   NOT NULL  , 
      is_variation boolean   NOT NULL    DEFAULT false, 
      cest_ncm integer   , 
      provider integer   , 
      brand integer   , 
      type integer   NOT NULL    DEFAULT 1, 
      status integer   NOT NULL    DEFAULT 1, 
      category integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_status( 
      id  SERIAL    NOT NULL  , 
      status varchar  (30)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_storage( 
      id  SERIAL    NOT NULL  , 
      quantity integer   NOT NULL  , 
      min_storage integer   , 
      max_storage integer   , 
      deposit integer   NOT NULL  , 
      product integer   NOT NULL  , 
      store integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_transfer( 
      id  SERIAL    NOT NULL  , 
      quantity integer   NOT NULL  , 
      transfer_type varchar  (20)   NOT NULL    DEFAULT 'transferencia', 
      protocol integer   , 
      user integer   , 
      deposit_origin integer   , 
      product_storage_origin integer   , 
      deposit_destiny integer   NOT NULL  , 
      product_storage_destiny integer   NOT NULL  , 
      product integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_type( 
      id  SERIAL    NOT NULL  , 
      description varchar  (200)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_validate_date( 
      id  SERIAL    NOT NULL  , 
      lote varchar  (50)   , 
      dt_validate date   NOT NULL  , 
      product integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE provider( 
      id  SERIAL    NOT NULL  , 
      social_name varchar  (100)   NOT NULL  , 
      cnpj varchar  (20)   NOT NULL  , 
      fantasy_name varchar  (50)   , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE product ADD UNIQUE (sku);
  
 ALTER TABLE brand ADD CONSTRAINT fk_brand_provider FOREIGN KEY (provider) references provider(id); 
ALTER TABLE category ADD CONSTRAINT fk_category_cest_ncm FOREIGN KEY (cest_ncm_default) references cest_ncm(id); 
ALTER TABLE cest_ncm ADD CONSTRAINT fk_cest_ncm_cest FOREIGN KEY (cest) references cest(id); 
ALTER TABLE cest_ncm ADD CONSTRAINT fk_cest_ncm_ncm FOREIGN KEY (ncm) references ncm(id); 
ALTER TABLE cupom_products ADD CONSTRAINT fk_cupom_products FOREIGN KEY (product) references product(id); 
ALTER TABLE cupom_products ADD CONSTRAINT fk_cupom_products_cupom FOREIGN KEY (cupom) references cupom(id); 
ALTER TABLE price ADD CONSTRAINT fk_price_list_price FOREIGN KEY (price_list) references price_list(id); 
ALTER TABLE price ADD CONSTRAINT fk_price_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_category FOREIGN KEY (category) references category(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_brand FOREIGN KEY (brand) references brand(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_provider FOREIGN KEY (provider) references provider(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_ncm_cest FOREIGN KEY (cest_ncm) references cest_ncm(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_status FOREIGN KEY (status) references product_status(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_type FOREIGN KEY (type) references product_type(id); 
ALTER TABLE product_storage ADD CONSTRAINT fk_product_storage_deposit FOREIGN KEY (deposit) references deposit(id); 
ALTER TABLE product_storage ADD CONSTRAINT fk_product_storage_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_deposit_origin FOREIGN KEY (deposit_origin) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_deposit_destiny FOREIGN KEY (deposit_destiny) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product_storage_origin FOREIGN KEY (product_storage_origin) references product_storage(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product_storage_destiny FOREIGN KEY (product_storage_destiny) references product_storage(id); 
ALTER TABLE product_validate_date ADD CONSTRAINT fk_product_validate_date_product FOREIGN KEY (product) references product(id); 

  
