PRAGMA foreign_keys=OFF; 

CREATE TABLE adjust_closure( 
      id  INTEGER    NOT NULL  , 
      justify varchar  (200)   NOT NULL  , 
      adjust_value double   NOT NULL  , 
      closure int   NOT NULL  , 
      cashier_method int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(closure) REFERENCES closure(id),
FOREIGN KEY(cashier_method) REFERENCES closure_payment_methods(id)) ; 

CREATE TABLE closure( 
      id  INTEGER    NOT NULL  , 
      dt_close datetime   , 
      number varchar  (30)   NOT NULL  , 
      closure_type text   NOT NULL    DEFAULT 'F', 
      dt_open datetime   NOT NULL  , 
      value_total double   NOT NULL  , 
      user int   NOT NULL  , 
      cashier int   NOT NULL  , 
      store int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE closure_payment_methods( 
      id  INTEGER    NOT NULL  , 
      closure int   NOT NULL  , 
      payment_method int   NOT NULL  , 
      value double   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(closure) REFERENCES closure(id)) ; 

CREATE TABLE withdrawal( 
      id  INTEGER    NOT NULL  , 
      user int   NOT NULL  , 
      store int   NOT NULL  , 
      cashier int   NOT NULL  , 
      closure int   NOT NULL  , 
      withdrawal_account int   NOT NULL  , 
      dt_withdrawal date   NOT NULL  , 
      value double   NOT NULL  , 
      obs varchar  (200)   , 
 PRIMARY KEY (id),
FOREIGN KEY(closure) REFERENCES closure(id),
FOREIGN KEY(withdrawal_account) REFERENCES withdrawal_account(id)) ; 

CREATE TABLE withdrawal_account( 
      id  INTEGER    NOT NULL  , 
      withdrawal int   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 CREATE UNIQUE INDEX unique_idx_closure_number ON closure(number);
 
  
