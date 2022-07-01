CREATE TABLE sale( 
      id  INT IDENTITY    NOT NULL  , 
      number varchar  (30)   NOT NULL  , 
      products_value float   NOT NULL  , 
      payments_value float   NOT NULL  , 
      discont_value float   , 
      total_value float   NOT NULL  , 
      employee_sale bit   NOT NULL    DEFAULT false, 
      sale_date datetime2   NOT NULL  , 
      invoiced bit   NOT NULL    DEFAULT false, 
      invoice_ambient bit   NOT NULL    DEFAULT false, 
      obs varchar  (400)   , 
      invoice_number int   , 
      invoice_serie int   , 
      invoice_coupon nvarchar(max)   , 
      invoice_xml nvarchar(max)   , 
      payment_method int   NOT NULL  , 
      store int   NOT NULL  , 
      employee_cashier int   NOT NULL  , 
      cashier int   NOT NULL  , 
      customer int   , 
      salesman int   , 
      status int   NOT NULL    DEFAULT 2, 
 PRIMARY KEY (id)) ; 

CREATE TABLE sale_item( 
      id  INT IDENTITY    NOT NULL  , 
      discont_value float   , 
      quantity int   NOT NULL  , 
      unitary_value float   NOT NULL  , 
      total_value float   NOT NULL  , 
      sale_date date   NOT NULL  , 
      sale int   NOT NULL  , 
      store int   NOT NULL  , 
      deposit int   NOT NULL  , 
      product_storage int   NOT NULL  , 
      product int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE sale_payment( 
      id  INT IDENTITY    NOT NULL  , 
      value float   NOT NULL  , 
      sale_date date   NOT NULL  , 
      store int   NOT NULL  , 
      sale int   NOT NULL  , 
      payment_method int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE status( 
      id  INT IDENTITY    NOT NULL  , 
      description varchar  (50)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE status ADD UNIQUE (description);
  
 ALTER TABLE sale ADD CONSTRAINT fk_sale_status FOREIGN KEY (status) references status(id); 
ALTER TABLE sale_item ADD CONSTRAINT fk_sale_item_sale FOREIGN KEY (sale) references sale(id); 
ALTER TABLE sale_payment ADD CONSTRAINT fk_payment_sale FOREIGN KEY (sale) references sale(id); 

  
