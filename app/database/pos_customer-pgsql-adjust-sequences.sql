SELECT setval('customer_id_seq', coalesce(max(id),0) + 1, false) FROM customer;
SELECT setval('store_partiner_id_seq', coalesce(max(id),0) + 1, false) FROM store_partiner;