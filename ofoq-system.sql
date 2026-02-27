-- 1. إضافة أمر عمل (Assignment)
INSERT INTO assignments (work_order_no, consultant_office, receive_date, branch_id, current_stage)
VALUES 
('WO-2026-001', 'مكتب الرياض للهندسة', '2026-02-01', 3, 'أعمال الكهرباء'),
('WO-2026-002', 'مكتب الفهد للاستشارات', '2026-02-15', 5, 'الإسناد');

-- 2. إضافة سجلات مستودع (Warehouse Logs)
-- سنضيف عجزاً في المواد لنرى كيف يظهر في لوحة التحكم
INSERT INTO warehouse_logs (work_order_id, material_code, qty_from_electricity, qty_from_company)
VALUES 
(1, 'CABLE-50MM', 100.00, 90.00), -- العجز هنا 10
(1, 'TRANS-01', 5.00, 4.00);    -- العجز هنا 1

-- 3. إضافة رخصة حفر أوشكت على الانتهاء (لاختبار التنبيهات)
-- سنفترض وجود سجل في field_works أولاً
INSERT INTO field_works (work_order_id, digging_start_date) VALUES (1, '2026-02-05');

INSERT INTO digging_licenses (field_work_id, license_no, license_type, start_date, end_date)
VALUES (1, 'LIC-999', 'رخصة', '2026-02-01', '2026-03-05'); -- ستنتهي قريباً