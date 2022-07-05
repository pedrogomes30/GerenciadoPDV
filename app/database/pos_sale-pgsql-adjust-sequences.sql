SELECT setval('item_cupom_id_seq', coalesce(max(id),0) + 1, false) FROM item_cupom;
SELECT setval('sale_id_seq', coalesce(max(id),0) + 1, false) FROM sale;
SELECT setval('sale_item_id_seq', coalesce(max(id),0) + 1, false) FROM sale_item;
SELECT setval('sale_payment_id_seq', coalesce(max(id),0) + 1, false) FROM sale_payment;
SELECT setval('status_id_seq', coalesce(max(id),0) + 1, false) FROM status;