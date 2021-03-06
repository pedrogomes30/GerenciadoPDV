PRAGMA foreign_keys=OFF; 

CREATE TABLE sale( 
      id  INTEGER    NOT NULL  , 
      number varchar  (30)   NOT NULL  , 
      products_value double   NOT NULL  , 
      payments_value double   NOT NULL  , 
      total_value double   NOT NULL  , 
      sale_date datetime   NOT NULL  , 
      invoiced text   NOT NULL    DEFAULT 'F', 
      invoice_ambient text   NOT NULL    DEFAULT 'F', 
      discont_value double   , 
      obs varchar  (400)   , 
      invoice_number int   , 
      invoice_serie int   , 
      invoice_coupon text   , 
      invoice_xml text   , 
      payment_method int   NOT NULL  , 
      store int   NOT NULL  , 
      employee_cashier int   NOT NULL  , 
      cashier int   NOT NULL  , 
      client int   , 
      salesman int   , 
      status int   NOT NULL    DEFAULT 2, 
 PRIMARY KEY (id),
FOREIGN KEY(status) REFERENCES status(id)) ; 

CREATE TABLE sale_item( 
      id  INTEGER    NOT NULL  , 
      discont_value double   , 
      quantity int   NOT NULL  , 
      unitary_value double   NOT NULL  , 
      total_value double   NOT NULL  , 
      sale_date date   NOT NULL  , 
      sale int   NOT NULL  , 
      store int   NOT NULL  , 
      deposit int   NOT NULL  , 
      product_storage int   NOT NULL  , 
      product int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(sale) REFERENCES sale(id)) ; 

CREATE TABLE sale_payment( 
      id  INTEGER    NOT NULL  , 
      value double   NOT NULL  , 
      sale_date date   NOT NULL  , 
      store int   NOT NULL  , 
      sale int   NOT NULL  , 
      payment_method int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(sale) REFERENCES sale(id)) ; 

CREATE TABLE status( 
      id  INTEGER    NOT NULL  , 
      description varchar  (50)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_status_description ON status(description);
 
  
