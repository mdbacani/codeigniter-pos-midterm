-- Step 1: Create and select the database
CREATE DATABASE IF NOT EXISTS pos_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pos_system;

-- Step 2: Create the Products table[cite: 1, 2]
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock_quantity INT NOT NULL DEFAULT 0,
  image VARCHAR(255),
  created_at DATETIME NOT NULL
) ENGINE=InnoDB;

-- Step 3: Create the Customers table[cite: 1, 2]
CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20),
  created_at DATETIME NOT NULL
) ENGINE=InnoDB;

-- Step 4: Create the Users (Staff) table[cite: 1, 2]
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  avatar VARCHAR(255),
  created_at DATETIME NOT NULL
) ENGINE=InnoDB;

-- Step 5: Create the Sales table (Must be created last because of foreign keys)[cite: 1, 2]
CREATE TABLE sales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT NOT NULL,
  customer_id INT DEFAULT NULL,
  sold_by INT NOT NULL,
  quantity INT NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  created_at DATETIME NOT NULL,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
  FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
  FOREIGN KEY (sold_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
