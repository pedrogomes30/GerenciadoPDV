CREATE TABLE brand( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `name` varchar  (100)   NOT NULL  , 
      `provider` int   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE category( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `name` varchar  (50)   NOT NULL  , 
      `cest_ncm_default` int   NOT NULL  , 
      `icon_category` varchar  (400)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE cest( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `description` varchar  (200)   NOT NULL  , 
      `number` varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE cest_ncm( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `cest` int   NOT NULL  , 
      `ncm` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE deposit( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `name` varchar  (50)   NOT NULL  , 
      `store` int   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE ncm( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `description` varchar  (200)   NOT NULL  , 
      `number` varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE price( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `sell_price` double   NOT NULL  , 
      `cust_price` double   NOT NULL  , 
      `product` int   NOT NULL  , 
      `list_price` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE price_list( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `name` varchar  (30)   , 
      `store` int   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE product( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `description` varchar  (60)   NOT NULL  , 
      `sku` varchar  (20)   NOT NULL  , 
      `unity` varchar  (2)   NOT NULL    DEFAULT 'UN', 
      `type` int   NOT NULL    DEFAULT 1, 
      `status` varchar  (15)   NOT NULL    DEFAULT 'Ok', 
      `description_variation` varchar  (50)   , 
      `reference` varchar  (30)   , 
      `barcode` varchar  (20)   , 
      `family_id` int   , 
      `obs` varchar  (60)   , 
      `website` varchar  (100)   , 
      `origin` varchar  (100)   , 
      `tribute_situation` varchar  (20)   , 
      `cest` varchar  (20)   , 
      `ncm` varchar  (20)   , 
      `is_variation` boolean   NOT NULL    DEFAULT false, 
      `cest_ncm` int   , 
      `provider` int   , 
      `brand` int   , 
      `category` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE product_storage( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `quantity` int   NOT NULL  , 
      `min_storage` int   , 
      `max_storage` int   , 
      `deposit` int   NOT NULL  , 
      `product` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE product_transfer( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `quantity` int   NOT NULL  , 
      `transfer_type` varchar  (20)   NOT NULL    DEFAULT 'transferencia', 
      `protocol` int   , 
      `user` int   , 
      `deposit_origin` int   , 
      `product_storage_origin` int   , 
      `deposit_destiny` int   NOT NULL  , 
      `product_storage_destiny` int   NOT NULL  , 
      `product` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE product_validate_date( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `lote` varchar  (50)   , 
      `dt_validate` date   NOT NULL  , 
      `product` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE provider( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `social_name` varchar  (100)   NOT NULL  , 
      `cnpj` varchar  (20)   NOT NULL  , 
      `fantasy_name` varchar  (50)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE status_produto( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `status` varchar  (30)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_cadastro( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `descricao` varchar  (200)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
 ALTER TABLE product ADD UNIQUE (sku);
  
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
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_deposit_origin FOREIGN KEY (deposit_origin) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product FOREIGN KEY (product) references product(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_deposit_destiny FOREIGN KEY (deposit_destiny) references deposit(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product_storage_origin FOREIGN KEY (product_storage_origin) references product_storage(id); 
ALTER TABLE product_transfer ADD CONSTRAINT fk_product_transfer_product_storage_destiny FOREIGN KEY (product_storage_destiny) references product_storage(id); 
ALTER TABLE product_validate_date ADD CONSTRAINT fk_product_validate_date_product FOREIGN KEY (product) references product(id); 

  
