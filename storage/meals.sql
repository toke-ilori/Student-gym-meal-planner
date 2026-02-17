CREATE TABLE meals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    planned_date DATE NOT NULL,
    meal_type VARCHAR(50),
    title VARCHAR(150) NOT NULL,
    calories INT,
    protein_g INT,
    carbs_g INT,
    fats_g INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);