CREATE TABLE adjust_closure( 
      id  integer generated by default as identity     NOT NULL , 
      justify varchar  (200)    NOT NULL , 
      adjust_value float    NOT NULL , 
      closure integer    NOT NULL , 
      cashier_method integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE closure( 
      id  integer generated by default as identity     NOT NULL , 
      user integer    NOT NULL , 
      store integer    NOT NULL , 
      cashier integer    NOT NULL , 
      closure_type char(1)    DEFAULT false  NOT NULL , 
      dt_open timestamp    NOT NULL , 
      dt_close timestamp   , 
      value_total float    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE closure_payment_methods( 
      id  integer generated by default as identity     NOT NULL , 
      closure integer    NOT NULL , 
      payment_method integer    NOT NULL , 
      value float    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE withdrawal( 
      id  integer generated by default as identity     NOT NULL , 
      user integer    NOT NULL , 
      store integer    NOT NULL , 
      cashier integer    NOT NULL , 
      closure integer    NOT NULL , 
      withdrawal_account integer    NOT NULL , 
      dt_withdrawal date   , 
      value float    NOT NULL , 
      obs varchar  (200)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE withdrawal_account( 
      id  integer generated by default as identity     NOT NULL , 
      withdrawal integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

 
  
 ALTER TABLE adjust_closure ADD CONSTRAINT fk_Adjust_cashier_finish_1 FOREIGN KEY (closure) references closure(id); 
ALTER TABLE adjust_closure ADD CONSTRAINT fk_Adjust_cashier_finish_2 FOREIGN KEY (cashier_method) references closure_payment_methods(id); 
ALTER TABLE closure_payment_methods ADD CONSTRAINT closure_payment_methods_62b0a56ea1258 FOREIGN KEY (closure) references closure(id); 
ALTER TABLE withdrawal ADD CONSTRAINT fk_withdrawal_closure FOREIGN KEY (closure) references closure(id); 
ALTER TABLE withdrawal ADD CONSTRAINT fk_withdrawal_account FOREIGN KEY (withdrawal_account) references withdrawal_account(id); 

  
