CREATE TABLE PERMISSION (
    permission_id INT NOT NULL,
    permission_title VARCHAR(50),

    PRIMARY KEY(permission_id)
);

CREATE TABLE USERS (
    user_id VARCHAR(20) NOT NULL,
    user_password VARCHAR(50) NOT NULL,
    user_name VARCHAR(50) NOT NULL,
    user_surname VARCHAR(50) NOT NULL,
    permission_id INT,

    PRIMARY KEY(user_id),
    FOREIGN KEY(permission_id) REFERENCES PERMISSION(permission_id)
);

CREATE TABLE PROJECT (
    project_id INT NOT NULL AUTO_INCREMENT,

    project_title varchar(200),
    book_no varchar(200),
    date_at VARCHAR(20),

    check_budget VARCHAR(20),
    budget VARCHAR(20),

    principle_allow VARCHAR(20),
    buy_accept VARCHAR(20),
    
    check_form VARCHAR(20),
    
    order_no VARCHAR(20),
    order_date VARCHAR(20),
    order_deadline VARCHAR(20),

    promise_no VARCHAR(20),
    promise_date VARCHAR(20),
    promise_deadline VARCHAR(20),

    binding_statement VARCHAR(20),

    check_accept VARCHAR(20),

    send_withdraw VARCHAR(20),

    project_success BOOLEAN,
    
    PRIMARY KEY(project_id)
);

INSERT INTO 
    `permission` (
        `permission_id`, 
        `permission_title`
    ) 
VALUES 
    ('1', 'admin'), 
    ('2', 'user'), 
    ('3', 'superuser');


