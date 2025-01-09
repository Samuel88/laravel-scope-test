# Laravel Scope Test

## Link Utili
- https://www.geeksforgeeks.org/program-distance-two-points-earth/
- https://dev.mysql.com/doc/refman/8.4/en/spatial-convenience-functions.html
- https://laracasts.com/discuss/channels/eloquent/implementing-query-scope-selects
- https://laravel-news.com/query-scopes
- https://laravel.com/docs/11.x/eloquent#query-scopes
- https://stackoverflow.com/questions/20864872/how-to-bind-parameters-to-a-raw-db-query-in-laravel-thats-used-on-a-model
- https://www.raymondcamden.com/2019/09/01/using-geolocation-with-vuejs

## Codice utile
```sql
SELECT ST_Distance_Sphere(point(latitude, longitude), point(0,0)) FROM `shops` WHERE 1;
```

## Codice per la lista dei prodotti con il rivenditore alla distanza minima
```sql
-- mysql Top-1-per-group
-- https://stackoverflow.com/questions/2739474/how-to-select-the-first-row-for-each-group-in-mysql

WITH product_shop_nearest AS (
    SELECT
        `t`.*
    FROM (
        SELECT
            `product_shop`.`product_id`,
            `product_shop`.`qty` AS `shop_qty`,
            `shops`.`id` AS `shop_id`,
            `shops`.`name` AS `shop_name`,
            `shops`.`address` AS `shop_address`,
            `shops`.`city` AS `shop_city`,
            `shops`.`phone` AS `shop_phone`,
            `shops`.`latitude` AS `shop_latitude`,
            `shops`.`longitude` AS `shop_longitude`,
            ROW_NUMBER() OVER(
                PARTITION BY `product_shop`.`product_id`
                ORDER BY ST_Distance_Sphere(
                    Point(`shops`.`latitude`, `shops`.`longitude`),
                    Point(43.6636831, 10.6282204)
                )
            ) AS `counter`
        FROM `product_shop`
            JOIN `shops`
                ON `shops`.`id` = `product_shop`.`shop_id`
    ) AS `t`
    WHERE
        `t`.`counter` = 1
)
SELECT
    *
FROM `products`
    JOIN `product_shop_nearest`
        ON `products`.`id` = `product_shop_nearest`.`product_id`;
```

```sql
SELECT *
FROM `products`
    JOIN (
        SELECT p.id as product_id, (
            SELECT `shops`.`id`
            FROM `shops`
                JOIN `product_shop`
                    ON `product_shop`.`shop_id` = shops.id AND product_shop.product_id = p.id
            ORDER BY ST_Distance_Sphere(
                    Point(`shops`.`latitude`, `shops`.`longitude`),
                    Point(43.6636831, 10.6282204)
            )
            LIMIT 1
        ) as shop_id
        FROM `products` p
    ) as `pivot`
        ON `products`.`id` = `pivot`.`product_id`
    JOIN `shops`
        ON `shops`.`id` = `pivot`.`shop_id`;
```