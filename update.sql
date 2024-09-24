ALTER TABLE `product_categories`
	CHANGE COLUMN `parent_category` `parent_category_id` INT(11) NULL DEFAULT NULL AFTER `id`,
	ADD INDEX `parent_category_id` (`parent_category_id`);

ALTER TABLE `products`
	CHANGE COLUMN `product_subcategory_id` `product_subcategory_id` BIGINT NOT NULL DEFAULT 0 AFTER `product_category_id`,
	ADD INDEX `product_subcategory_id` (`product_subcategory_id`);
