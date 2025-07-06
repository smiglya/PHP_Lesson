-- SQL-запрос для поиска жанра с наибольшим средним рейтингом книг
-- Используются подзапросы для выполнения задачи

SELECT g.name
FROM genres g
WHERE g.id = (
    SELECT genre_id
    FROM books
    GROUP BY genre_id
    ORDER BY AVG(rating) DESC
    LIMIT 1
);

-- SQL-запрос для поиска сотрудника с наибольшей суммой продаж
-- Используются подзапросы для выполнения задачи

SELECT e.name
FROM employees e
JOIN sales s ON e.id = s.employee_id
GROUP BY e.id, e.name
HAVING SUM(s.amount) = (
    SELECT MAX(total_sales)
    FROM (
        SELECT SUM(amount) as total_sales
        FROM sales
        GROUP BY employee_id
    ) as employee_totals
);

-- SQL-запрос для поиска категории с наибольшим общим количеством продаж товаров
-- Используются подзапросы для выполнения задачи

SELECT c.name
FROM categories c
JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name
HAVING SUM(p.sales) = (
    SELECT MAX(total_sales)
    FROM (
        SELECT SUM(sales) as total_sales
        FROM products
        GROUP BY category_id
    ) as category_totals
);

-- SQL-запрос для поиска магазина с наибольшей суммой выручки
-- Используются подзапросы для выполнения задачи

SELECT st.name
FROM stores st
JOIN sales s ON st.id = s.store_id
JOIN products p ON s.product_id = p.id
GROUP BY st.id, st.name
HAVING SUM(p.price * s.quantity) = (
    SELECT MAX(total_revenue)
    FROM (
        SELECT SUM(pr.price * sa.quantity) as total_revenue
        FROM sales sa
        JOIN products pr ON sa.product_id = pr.id
        GROUP BY sa.store_id
    ) as store_revenues
);

-- SQL-запрос для поиска клиента с наибольшим количеством заказов
-- Используются подзапросы для выполнения задачи

SELECT c.name
FROM customers c
JOIN orders o ON c.id = o.customer_id
GROUP BY c.id, c.name
HAVING COUNT(o.id) = (
    SELECT MAX(order_count)
    FROM (
        SELECT COUNT(id) as order_count
        FROM orders
        GROUP BY customer_id
    ) as customer_orders
);

-- SQL-запрос для поиска модели автобуса с наибольшим средним количеством пассажиров
-- Используются подзапросы для выполнения задачи

SELECT b.model
FROM buses b
WHERE b.id = (
    SELECT bus_id
    FROM trips
    GROUP BY bus_id
    ORDER BY AVG(passengers) DESC
    LIMIT 1
);

-- SQL-запрос для поиска игрока с наивысшим средним числом очков за матчи
-- Используются подзапросы для выполнения задачи

SELECT p.name
FROM players p
WHERE p.id = (
    SELECT player_id
    FROM matches
    GROUP BY player_id
    ORDER BY AVG(points) DESC
    LIMIT 1
);

-- SQL-запрос для поиска водоема и рыбака с наибольшим общим весом улова в каждом водоеме
-- Используются подзапросы для выполнения задачи

SELECT l.name as lake_name, f.name as fisherman_name
FROM lakes l
JOIN fishermen f ON f.id = (
    SELECT fisherman_id
    FROM catches c
    WHERE c.lake_id = l.id
    GROUP BY fisherman_id
    ORDER BY SUM(weight) DESC
    LIMIT 1
)
WHERE l.id IN (
    SELECT DISTINCT lake_id
    FROM catches
);
