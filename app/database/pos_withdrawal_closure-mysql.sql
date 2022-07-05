CREATE TABLE adjust_closure( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `justify` varchar  (200)   NOT NULL  , 
      `adjust_value` double   NOT NULL  , 
      `closure` int   NOT NULL  , 
      `cashier_method` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE closure( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `dt_close` datetime   , 
      `number` varchar  (30)   NOT NULL  , 
      `closure_type` boolean   NOT NULL    DEFAULT false, 
      `dt_open` datetime   NOT NULL  , 
      `value_total` double   NOT NULL  , 
      `user` int   NOT NULL  , 
      `cashier` int   NOT NULL  , 
      `store` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE closure_payment_methods( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `closure` int   NOT NULL  , 
      `payment_method` int   NOT NULL  , 
      `value` double   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE withdrawal( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `user` int   NOT NULL  , 
      `store` int   NOT NULL  , 
      `cashier` int   NOT NULL  , 
      `closure` int   NOT NULL  , 
      `withdrawal_account` int   NOT NULL  , 
      `dt_withdrawal` date   NOT NULL  , 
      `value` double   NOT NULL  , 
      `obs` varchar  (200)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE withdrawal_account( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `withdrawal` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
 ALTER TABLE closure ADD UNIQUE (number);
  
 ALTER TABLE adjust_closure ADD CONSTRAINT fk_Adjust_cashier_finish_1 FOREIGN KEY (closure) references closure(id); 
ALTER TABLE adjust_closure ADD CONSTRAINT fk_Adjust_cashier_finish_2 FOREIGN KEY (cashier_method) references closure_payment_methods(id); 
ALTER TABLE closure_payment_methods ADD CONSTRAINT fk_closure_payment_methods_closure FOREIGN KEY (closure) references closure(id); 
ALTER TABLE withdrawal ADD CONSTRAINT fk_withdrawal_closure FOREIGN KEY (closure) references closure(id); 
ALTER TABLE withdrawal ADD CONSTRAINT fk_withdrawal_account FOREIGN KEY (withdrawal_account) references withdrawal_account(id); 

  
