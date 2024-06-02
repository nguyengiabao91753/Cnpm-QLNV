
create database cnpm_qlnv;
use cnpm_qlnv;
Alter table departments
ALTER column status SET default 1 ;

INSERT INTO departments (name) VALUES
('Cardiology Department'),
('Gastroenterology Department'),
('Dermatology Department'),
('Pediatrics Department');

INSERT INTO positions (department_id, name) VALUES
(1, 'Cardiologist'),
(1, 'Nurse'),
(1, 'Administrative Staff'),
-- Add more positions as needed
(2, 'Gastroenterologist'),
(2, 'Medical Assistant'),
-- Add more positions as needed
(3, 'Dermatologist'),
(3, 'Dermatology Technician'),
-- Add more positions as needed
(4, 'Pediatrician'),
(4, 'Pediatric Nurse');
INSERT INTO levels ( name, created_at, updated_at)
VALUES ('Super Admin', NOW(), NOW()),
		('Admin', NOW(), NOW()),
        ('User', NOW(), NOW());

INSERT INTO salaries (base, factor, allowance_factor, created_at, updated_at) 
VALUES
    (50000, 1.5, 0.8, NOW(), NOW()),
    (60000, 1.6, 0.9, NOW(), NOW()),
    (55000, 1.4, 0.7, NOW(), NOW()),
    (65000, 1.7, 1.0, NOW(), NOW()),
    (70000, 1.8, 1.1, NOW(), NOW());

-- Thêm dữ liệu vào bảng rooms sao cho mỗi phòng ban có 1 tầng và bắt đầu từ số phòng 1
INSERT INTO rooms (department_id, name, created_at, updated_at)
VALUES
    -- Phòng cho khoa 1 (department_id = 1)
    (1, '101', NOW(), NOW()),
    (1, '102', NOW(), NOW()),
    (1, '103', NOW(), NOW()),
    (1, '104', NOW(), NOW()),
    (1, '105', NOW(), NOW()),

    -- Phòng cho khoa 2 (department_id = 2)
    (2, '201', NOW(), NOW()),
    (2, '202', NOW(), NOW()),
    (2, '203', NOW(), NOW()),
    (2, '204', NOW(), NOW()),
    (2, '205', NOW(), NOW()),

    -- Phòng cho khoa 3 (department_id = 3)
    (3, '301', NOW(), NOW()),
    (3, '302', NOW(), NOW()),
    (3, '303', NOW(), NOW()),
    (3, '304', NOW(), NOW()),
    (3, '305', NOW(), NOW()),

    -- Phòng cho khoa 4 (department_id = 4)
    (4, '401', NOW(), NOW()),
    (4, '402', NOW(), NOW()),
    (4, '403', NOW(), NOW()),
    (4, '404', NOW(), NOW()),
    (4, '405', NOW(), NOW());
INSERT INTO shifts (start, end, created_at, updated_at)
VALUES
    ('08:00:00', '16:00:00', NOW(), NOW()), -- Ca làm việc từ 8:00 AM đến 4:00 PM
    ('09:00:00', '17:00:00', NOW(), NOW()), -- Ca làm việc từ 9:00 AM đến 5:00 PM
    ('10:00:00', '18:00:00', NOW(), NOW()); -- Ca làm việc từ 10:00 AM đến 6:00 PM
-- ALTER TABLE work__schedules
-- ADD COLUMN date date AFTER room_id
-- ADD CONSTRAINT fk_room_department_id
--     FOREIGN KEY (department_id)
--     REFERENCES departments(id);
ALTER TABLE emp__salaries
add COLUMN total decimal(10,2) after emp_id;


SELECT * from employees;
SELECT * FROM users;
SELECT * FROM work__schedules;
SELECT * FROM attendances;
SELECT * FROM emp__salaries;
SELECT * FROM users;
SELECT * FROM levels;

INSERT INTO attendances (work_id, present, created_at, updated_at)
values (3,1,NOW(), NOW() );


INSERT INTO work__schedules (emp_id, shift_id, room_id, date, created_at, updated_at)
VALUES
(2, 1, 3, '2024-04-01', NOW(), NOW()),
(2, 1, 3, '2024-04-02', NOW(), NOW()),
(2, 1, 3, '2024-04-03', NOW(), NOW()),
(2, 1, 3, '2024-04-04', NOW(), NOW()),
(2, 1, 3, '2024-04-05', NOW(), NOW()),
(2, 1, 3, '2024-04-06', NOW(), NOW()),
(2, 1, 3, '2024-04-07', NOW(), NOW()),
(2, 1, 3, '2024-04-08', NOW(), NOW()),
(2, 1, 3, '2024-04-09', NOW(), NOW()),
(2, 1, 3, '2024-04-10', NOW(), NOW()),
(2, 1, 3, '2024-04-11', NOW(), NOW()),
(2, 1, 3, '2024-04-12', NOW(), NOW()),
(2, 1, 3, '2024-04-13', NOW(), NOW()),
(2, 1, 3, '2024-04-14', NOW(), NOW()),
(2, 1, 3, '2024-04-15', NOW(), NOW()),
(2, 1, 3, '2024-04-16', NOW(), NOW()),
(2, 1, 3, '2024-04-17', NOW(), NOW()),
(2, 1, 3, '2024-04-18', NOW(), NOW()),
(2, 1, 3, '2024-04-19', NOW(), NOW()),
(2, 1, 3, '2024-04-20', NOW(), NOW()),
(2, 1, 3, '2024-04-21', NOW(), NOW()),
(2, 1, 3, '2024-04-22', NOW(), NOW()),
(2, 1, 3, '2024-04-23', NOW(), NOW()),
(2, 1, 3, '2024-04-24', NOW(), NOW()),
(2, 1, 3, '2024-04-25', NOW(), NOW()),
(2, 1, 3, '2024-04-26', NOW(), NOW()),
(2, 1, 3, '2024-04-27', NOW(), NOW()),
(2, 1, 3, '2024-04-28', NOW(), NOW()),
(2, 1, 3, '2024-04-29', NOW(), NOW()),
(2, 1, 3, '2024-04-30', NOW(), NOW());
-- (2, 1, 3, '2024-04-31', NOW(), NOW());





INSERT INTO attendances (work_id, present, status, clock_in, clock_out, description, created_at, updated_at)
VALUES 
    (583, 1, 1, '08:05:00', '16:00:00', 'Late 5m-Leave on time', NOW(), NOW()),
    (584, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (585, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (586, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (587, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (588, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (589, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (590, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (591, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (592, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (593, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (594, 1, 1, '08:05:00', '16:00:00', 'Late 5m-Leave on time', NOW(), NOW()),
    (595, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (596, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (597, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (598, 1, 1, '08:00:00', '17:00:00', 'On Time-Overtime 1h', NOW(), NOW()),
    (599, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (600, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (601, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (602, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (603, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (604, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (605, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (606, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (607, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (608, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (609, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (610, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (611, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW()),
    (612, 1, 1, '08:00:00', '16:00:00', 'On Time-Leave on time', NOW(), NOW());


DELIMITER $$

CREATE EVENT IF NOT EXISTS check_attendance_event
ON SCHEDULE EVERY 1 DAY
STARTS TIMESTAMP(CURRENT_DATE) + INTERVAL 23 HOUR + INTERVAL 58 MINUTE
DO BEGIN
    DECLARE current_date1 date ;
    DECLARE filtered_ids VARCHAR(255);
    
    SET current_date1 = CURDATE();
    
    -- Tạo chuỗi các ID thỏa điều kiện
    SET filtered_ids = (
        SELECT GROUP_CONCAT(id SEPARATOR ',') 
        FROM work_schedules 
        WHERE date = current_date1
    );
    
    -- Kiểm tra nếu không có ID nào thỏa điều kiện
    IF filtered_ids IS NOT NULL THEN
        -- Kiểm tra xem ID đã có trong attendances chưa
        SET filtered_ids = CONCAT('(', filtered_ids, ')');
        
        -- Chèn các ID không có trong bảng attendances
        INSERT INTO attendances (work_id, present, leave_approved, created_at, updated_at)
        SELECT w.id, 0, 0, NOW(), NOW()
        FROM work_schedules w
        LEFT JOIN attendances a ON w.id = a.work_id
        WHERE w.date = current_date1 AND a.work_id IS NULL;
    END IF;
END$$

DELIMITER ;

