CREATE TABLE item_cupom( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `value` double   NOT NULL  , 
      `sale_item` int   NOT NULL  , 
      `cupom` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE sale( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `number` varchar  (30)   NOT NULL  , 
      `products_value` double   NOT NULL  , 
      `payments_value` double   NOT NULL  , 
      `discont_value` double   , 
      `total_value` double   NOT NULL  , 
      `employee_sale` boolean   NOT NULL    DEFAULT false, 
      `sale_date` datetime   NOT NULL  , 
      `invoiced` boolean   NOT NULL    DEFAULT false, 
      `invoice_ambient` boolean   NOT NULL    DEFAULT false, 
      `obs` varchar  (400)   , 
      `invoice_number` int   , 
      `invoice_serie` int   , 
      `invoice_coupon` text   , 
      `invoice_xml` text   , 
      `payment_method` int   NOT NULL  , 
      `store` int   NOT NULL  , 
      `employee_cashier` int   NOT NULL  , 
      `cashier` int   NOT NULL  , 
      `customer` int   , 
      `salesman` int   , 
      `status` int   NOT NULL    DEFAULT 2, 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE sale_item( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `discont_value` double   , 
      `quantity` int   NOT NULL  , 
      `unitary_value` double   NOT NULL  , 
      `total_value` double   NOT NULL  , 
      `sale_date` date   NOT NULL  , 
      `sale` int   NOT NULL  , 
      `store` int   NOT NULL  , 
      `deposit` int   NOT NULL  , 
      `product_storage` int   NOT NULL  , 
      `product` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE sale_payment( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `value` double   NOT NULL  , 
      `sale_date` date   NOT NULL  , 
      `store` int   NOT NULL  , 
      `sale` int   NOT NULL  , 
      `payment_method` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE status( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `description` varchar  (50)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
 ALTER TABLE sale ADD UNIQUE (number);
 ALTER TABLE status ADD UNIQUE (description);
  
 ALTER TABLE item_cupom ADD CONSTRAINT fk_item_cupom_Item FOREIGN KEY (sale_item) references sale_item(id); 
ALTER TABLE sale ADD CONSTRAINT fk_sale_status FOREIGN KEY (status) references status(id); 
ALTER TABLE sale_item ADD CONSTRAINT fk_sale_item_sale FOREIGN KEY (sale) references sale(id); 
ALTER TABLE sale_payment ADD CONSTRAINT fk_payment_sale FOREIGN KEY (sale) references sale(id); 

  
