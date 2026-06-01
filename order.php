-- Insertar nuevo pedido
INSERT INTO orders (user_id, dish_id, quantity, status) 
VALUES (1, 1, 2, 'Pending');

-- Actualizar estado (ej. Chef cambiando a 'Ready to serve')
UPDATE orders 
SET status = 'Ready to serve' 
WHERE id = 1;