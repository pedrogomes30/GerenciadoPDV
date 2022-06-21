INSERT INTO cashier (id,name,cashier_type,user_authenticated,store) VALUES (1,'EXEM CAIXA1',1,null,1); 

INSERT INTO cashier (id,name,cashier_type,user_authenticated,store) VALUES (2,'EXEM CAIXA2',1,null,1); 

INSERT INTO cashier (id,name,cashier_type,user_authenticated,store) VALUES (3,'EXEM CAIXA3',1,null,1); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (1,'pix','PagamentoInstantaneoPix',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (2,'credit card ','CartaoDeCredito',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (3,'debit card','CartaoDeDebito',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (4,'store credit','CreditoLoja',true); 

INSERT INTO payment_method (id,method,alias,issue) VALUES (5,'money','Dinheiro',false); 

INSERT INTO payment_method_store (id,method,store) VALUES (1,1,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (2,2,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (3,3,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (4,4,1); 

INSERT INTO payment_method_store (id,method,store) VALUES (5,5,1); 

INSERT INTO profession (id,description,is_manager) VALUES (1,'Gerente',true); 

INSERT INTO profession (id,description,is_manager) VALUES (2,'Operador de Caixa',false); 

INSERT INTO profession (id,description,is_manager) VALUES (3,'Estoquista',false); 

INSERT INTO profession (id,description,is_manager) VALUES (4,'Aux. Administrativo',false); 

INSERT INTO profession (id,description,is_manager) VALUES (5,'Administrador',true); 

INSERT INTO store (id,social_name,abbreviation,cnpj,icon_url,fantasy_name,obs,state_inscription,municipal_inscription,icms,tax_regime,invoice_type,invoice_provider_id,production_csc_number,production_csc_id,production_invoice_serie,production_invoice_sequence,homologation_csc_number,homologation_csc_id,homologation_invoice_serie,homologation_invoice_sequence,certificate_password,store_group) VALUES (1,'social Example','EXEM','0000000000','','fantasy example','','','','','',1,'','','',null,null,'','',null,null,'',1); 

INSERT INTO store_group (id,name,default_theme) VALUES (1,'Fashion Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (2,'Jade Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (3,'Tj Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (4,'Flor Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (5,'Mimos Biju',null); 

INSERT INTO store_group (id,name,default_theme) VALUES (6,'Divvina Biju',null); 

INSERT INTO user (id,obs,profile_img,origin_store,current_store,profession,system_user) VALUES (1,'','',1,1,1,1); 
