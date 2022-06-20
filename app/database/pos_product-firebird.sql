CREATE TABLE brand( 
      id  integer generated by default as identity     NOT NULL , 
      name varchar  (100)    NOT NULL , 
      provider integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE category( 
      id  integer generated by default as identity     NOT NULL , 
      name varchar  (50)    NOT NULL , 
      cest_ncm_default integer    NOT NULL , 
      icon_category varchar  (400)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cest( 
      id  integer generated by default as identity     NOT NULL , 
      description varchar  (200)    NOT NULL , 
      number varchar  (10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cest_ncm( 
      id  integer generated by default as identity     NOT NULL , 
      cest integer    NOT NULL , 
      ncm integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE deposit( 
      id  integer generated by default as identity     NOT NULL , 
      name varchar  (50)    NOT NULL , 
      store integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE ncm( 
      id  integer generated by default as identity     NOT NULL , 
      description varchar  (200)    NOT NULL , 
      number varchar  (10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE price( 
      id  integer generated by default as identity     NOT NULL , 
      sell_price float    NOT NULL , 
      cust_price float    NOT NULL , 
      product integer    NOT NULL , 
      list_price integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE price_list( 
      id  integer generated by default as identity     NOT NULL , 
      name varchar  (30)   , 
      store integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product( 
      id  integer generated by default as identity     NOT NULL , 
      description varchar  (60)    NOT NULL , 
      sku varchar  (20)    NOT NULL , 
      unity varchar  (2)    DEFAULT 'UN'  NOT NULL , 
      type integer    DEFAULT 1  NOT NULL , 
      status varchar  (15)    DEFAULT 'Ok'  NOT NULL , 
      description_variation varchar  (50)   , 
      reference varchar  (30)   , 
      barcode varchar  (20)   , 
      family_id integer   , 
      obs varchar  (60)   , 
      website varchar  (100)   , 
      origin varchar  (100)   , 
      tribute_situation varchar  (20)   , 
      cest varchar  (20)   , 
      ncm varchar  (20)   , 
      is_variation char(1)    DEFAULT false  NOT NULL , 
      cest_ncm integer   , 
      provider integer   , 
      brand integer   , 
      category integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_storage( 
      id  integer generated by default as identity     NOT NULL , 
      quantity integer    NOT NULL , 
      min_storage integer   , 
      max_storage integer   , 
      deposit integer    NOT NULL , 
      product integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_transfer( 
      id  integer generated by default as identity     NOT NULL , 
      quantity integer    NOT NULL , 
      transfer_type varchar  (20)    DEFAULT 'transferencia'  NOT NULL , 
      protocol integer   , 
      user integer   , 
      deposit_origin integer   , 
      product_storage_origin integer   , 
      deposit_destiny integer    NOT NULL , 
      product_storage_destiny integer    NOT NULL , 
      product integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE product_validate_date( 
      id  integer generated by default as identity     NOT NULL , 
      lote varchar  (50)   , 
      dt_validate date    NOT NULL , 
      product integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE provider( 
      id  integer generated by default as identity     NOT NULL , 
      social_name varchar  (100)    NOT NULL , 
      cnpj varchar  (20)    NOT NULL , 
      fantasy_name varchar  (50)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE status_produto( 
      id  integer generated by default as identity     NOT NULL , 
      status varchar  (30)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_cadastro( 
      id  integer generated by default as identity     NOT NULL , 
      descricao varchar  (200)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_product_sku ON product COMPUTED BY (sku);
  
 ALTER TABLE brand ADD CONSTRAINT fk_brand_provider FOREIGN KEY (provider) references provider(id); 
ALTER TABLE category ADD CONSTRAINT fk_category_cest_ncm FOREIGN KEY (cest_ncm_default) references cest_ncm(id); 
ALTER TABLE cest_ncm ADD CONSTRAINT fk_cest_ncm_cest FOREIGN KEY (cest) references cest(id); 
ALTER TABLE cest_ncm ADD CONSTRAINT fk_cest_ncm_ncm FOREIGN KEY (ncm) references ncm(id); 
ALTER TABLE price ADD CONSTRAINT fk_price_list_price FOREIGN KEY (list_price) references price_list(id); 
ALTER TABLE price ADD CONSTRAINT fk_price_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_category FOREIGN KEY (category) references category(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_brand FOREIGN KEY (brand) references brand(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_provider FOREIGN KEY (provider) references provider(id); 
ALTER TABLE product ADD CONSTRAINT fk_product_ncm_cest FOREIGN KEY (cest_ncm) references cest_ncm(id); 
ALTER TABLE product_storage ADD CONSTRAINT fk_product_storage_deposit FOREIGN KEY (deposit) references deposit(id); 
ALTER TABLE product_storage ADD CONSTRAINT fk_product_storage_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product_transfer ADD CONSTRAINT product_transfer_62b0a185e3623 FOREIGN KEY (deposit_origin) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product_transfer ADD CONSTRAINT product_transfer_62b0a185e3647 FOREIGN KEY (deposit_destiny) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT product_transfer_62b0a185e3657 FOREIGN KEY (product_storage_origin) references product_storage(id); 
ALTER TABLE product_transfer ADD CONSTRAINT product_transfer_62b0a185e3667 FOREIGN KEY (product_storage_destiny) references product_storage(id); 
ALTER TABLE product_validate_date ADD CONSTRAINT product_validate_date_62b0a185e3763 FOREIGN KEY (product) references product(id); 

  
