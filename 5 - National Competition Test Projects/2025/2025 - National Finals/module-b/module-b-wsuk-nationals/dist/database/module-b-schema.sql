CREATE TABLE
    categories (
        cat_id BIGINT UNSIGNED NOT NULL,
        PRIMARY KEY (cat_id)
    );

CREATE TABLE
    events (
        event_id BIGINT UNSIGNED NOT NULL,
        cat_id BIGINT UNSIGNED NULL REFERENCES categories (cat_id),
        PRIMARY KEY (event_id)
    );

CREATE TABLE
    customers (
        cust_id BIGINT UNSIGNED NOT NULL,
        PRIMARY KEY (cust_id)
    );

CREATE TABLE
    pictures (
        pic_id BIGINT UNSIGNED NOT NULL,
        event_id BIGINT UNSIGNED NOT NULL REFERENCES events (event_id),
        PRIMARY KEY (pic_id)
    );

CREATE TABLE
    event_accesses (
        event_id BIGINT UNSIGNED NOT NULL REFERENCES events (event_id),
        cust_id BIGINT UNSIGNED NOT NULL REFERENCES customers (cust_id)
    );

CREATE TABLE
    picture_sizes (
        pic_size_id BIGINT UNSIGNED NOT NULL,
        PRIMARY KEY (pic_size_id)
    );

CREATE TABLE
    orders (
        order_id BIGINT UNSIGNED NOT NULL,
        cust_id BIGINT UNSIGNED NOT NULL REFERENCES customers (cust_id),
        PRIMARY KEY (order_id)
    );

CREATE TABLE
    order_pictures (
        order_id BIGINT UNSIGNED NOT NULL REFERENCES orders (order_id),
        pic_id BIGINT UNSIGNED NOT NULL REFERENCES pictures (pic_id),
        pic_size_id BIGINT UNSIGNED NOT NULL REFERENCES picture_sizes (pic_size_id)
    );