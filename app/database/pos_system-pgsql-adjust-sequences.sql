SELECT setval('cashier_id_seq', coalesce(max(id),0) + 1, false) FROM cashier;
SELECT setval('cashier_log_id_seq', coalesce(max(id),0) + 1, false) FROM cashier_log;
SELECT setval('group_store_id_seq', coalesce(max(id),0) + 1, false) FROM group_store;
SELECT setval('method_payment_store_id_seq', coalesce(max(id),0) + 1, false) FROM method_payment_store;
SELECT setval('payment_method_id_seq', coalesce(max(id),0) + 1, false) FROM payment_method;
SELECT setval('store_id_seq', coalesce(max(id),0) + 1, false) FROM store;
SELECT setval('user_id_seq', coalesce(max(id),0) + 1, false) FROM user;
SELECT setval('user_store_transfer_id_seq', coalesce(max(id),0) + 1, false) FROM user_store_transfer;