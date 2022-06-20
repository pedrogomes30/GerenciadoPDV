SELECT setval('adjust_closure_id_seq', coalesce(max(id),0) + 1, false) FROM adjust_closure;
SELECT setval('closure_id_seq', coalesce(max(id),0) + 1, false) FROM closure;
SELECT setval('closure_payment_methods_id_seq', coalesce(max(id),0) + 1, false) FROM closure_payment_methods;
SELECT setval('withdrawal_id_seq', coalesce(max(id),0) + 1, false) FROM withdrawal;
SELECT setval('withdrawal_account_id_seq', coalesce(max(id),0) + 1, false) FROM withdrawal_account;