CREATE TABLE IF NOT EXISTS items (
   item_id serial PRIMARY KEY,
   description VARCHAR NOT NULL,
   value INTEGER DEFAULT 1,
   orbicular bool NOT NULL DEFAULT TRUE
);

INSERT INTO items (item_id, description, value, orbicular) VALUES (1, 'Item 001', 10, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (2, 'Item 002', 9, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (3, 'Item 003', 8, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (4, 'Item 004', 7, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (5, 'Item 005', 6, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (6, 'Item 006', 5, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (7, 'Item 007', 4, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (8, 'Item 008', 3, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (9, 'Item 008', 2, true) ON CONFLICT (item_id) DO NOTHING;
INSERT INTO items (item_id, description, value, orbicular) VALUES (10, 'Item 010', 1, true) ON CONFLICT (item_id) DO NOTHING;