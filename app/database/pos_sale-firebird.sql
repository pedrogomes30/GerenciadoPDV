CREATE TABLE item_cupom( 
      id  integer generated by default as identity     NOT NULL , 
      value float    NOT NULL , 
      sale_item integer    NOT NULL , 
      cupom integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE sale( 
      id  integer generated by default as identity     NOT NULL , 
      number varchar  (30)    NOT NULL , 
      products_value float    NOT NULL , 
      payments_value float    NOT NULL , 
      discont_value float   , 
      total_value float    NOT NULL , 
      employee_sale char(1)    DEFAULT false  NOT NULL , 
      sale_date timestamp    NOT NULL , 
      invoiced char(1)    DEFAULT false  NOT NULL , 
      invoice_ambient char(1)    DEFAULT false  NOT NULL , 
      obs varchar  (400)   , 
      invoice_number integer   , 
      invoice_serie integer   , 
      invoice_coupon blob sub_type 1   , 
      invoice_xml blob sub_type 1   , 
      payment_method integer    NOT NULL , 
      store integer    NOT NULL , 
      employee_cashier integer    NOT NULL , 
      cashier integer    NOT NULL , 
      customer integer   , 
      salesman integer   , 
      status integer    DEFAULT 2  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE sale_item( 
      id  integer generated by default as identity     NOT NULL , 
      discont_value float   , 
      quantity integer    NOT NULL , 
      unitary_value float    NOT NULL , 
      total_value float    NOT NULL , 
      sale_date date    NOT NULL , 
      sale integer    NOT NULL , 
      store integer    NOT NULL , 
      deposit integer    NOT NULL , 
      product_storage integer    NOT NULL , 
      product integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE sale_payment( 
      id  integer generated by default as identity     NOT NULL , 
      value float    NOT NULL , 
      sale_date date    NOT NULL , 
      store integer    NOT NULL , 
      sale integer    NOT NULL , 
      payment_method integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE status( 
      id  integer generated by default as identity     NOT NULL , 
      description varchar  (50)    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_sale_number ON sale COMPUTED BY (number);
 CREATE UNIQUE INDEX unique_idx_status_description ON status COMPUTED BY (description);
  
 ALTER TABLE item_cupom ADD CONSTRAINT fk_item_cupom_Item FOREIGN KEY (sale_item) references sale_item(id); 
ALTER TABLE sale ADD CONSTRAINT fk_sale_status FOREIGN KEY (status) references status(id); 
ALTER TABLE sale_item ADD CONSTRAINT fk_sale_item_sale FOREIGN KEY (sale) references sale(id); 
ALTER TABLE sale_payment ADD CONSTRAINT fk_payment_sale FOREIGN KEY (sale) references sale(id); 

  
