CREATE TABLE employees (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    gender CHAR(1) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL UNIQUE,
    address VARCHAR(200) NULL,
    department VARCHAR(200) NOT NULL,
    position VARCHAR(200) NOT NULL,
    working CHAR(1) NOT NULL,
    start_working_date_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(100) NULL
);

CREATE TABLE accounts (
    user_name VARCHAR(255) NOT NULL PRIMARY KEY REFERENCES employees(email),
    password VARCHAR(255) NOT NULL,
    role VARCHAR(1) NOT NULL,
    working CHAR(1) REFERENCES employees(working)
);

CREATE TABLE mails (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fr VARCHAR(200) NOT NULL,
    sending_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    subject TEXT NOT NULL,
    content TEXT NOT NULL,
    response_status VARCHAR(1) NOT NULL DEFAULT 'N',
    response_date DATETIME,
    response TEXT
);

DELIMITER //
CREATE TRIGGER insert_employee_trigger
AFTER INSERT ON employees
FOR EACH ROW
BEGIN
    DECLARE new_role VARCHAR(1);
    IF NEW.department = 'Human Resources' THEN
        SET new_role = 'M';
    ELSE
        SET new_role = 'E';
    END IF;

    INSERT INTO accounts (user_name, password, role, working)
    VALUES (NEW.email, '123', new_role, NEW.working);
END//
DELIMITER ;

INSERT INTO employees (name, gender, email, phone, address, department, position, working)
VALUES 
    ('John Doe', "M", 'johndoe@example.com', '1234567890', '123 Main St, City', 'Sales', 'Sales Manager', "1"),
    ('Jane Smith', "F", 'janesmith@example.com', '9876543210', '456 Oak St, Town', 'Human Resources', 'HR Manager', "1"),
    ('Michael Johnson', "M", 'michaeljohnson@example.com', '5555555555', '789 Elm St, Village', 'IT', 'Developer', "1"),
    ('Emily Williams', "F", 'emilywilliams@example.com', '1111111111', '111 Pine St, County', 'Marketing', 'Marketing Specialist', "0"),
    ('David Brown', "M", 'davidbrown@example.com', '9999999999', '222 Cedar St, Borough', 'Finance', 'Accountant', "1"),
    ('Sarah Davis', "F", 'sarahdavis@example.com', '7777777777', NULL, 'Operations', 'Operations Manager', "1"),
    ('Robert Wilson', "M", 'robertwilson@example.com', '8888888888', '333 Oak St, City', 'Sales', 'Sales Representative', "1");
