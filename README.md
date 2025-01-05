# Laravel Scope Test

## Link Utili
- https://www.geeksforgeeks.org/program-distance-two-points-earth/
- https://dev.mysql.com/doc/refman/8.4/en/spatial-convenience-functions.html
- https://laracasts.com/discuss/channels/eloquent/implementing-query-scope-selects
- https://laravel-news.com/query-scopes
- https://laravel.com/docs/11.x/eloquent#query-scopes
- https://stackoverflow.com/questions/20864872/how-to-bind-parameters-to-a-raw-db-query-in-laravel-thats-used-on-a-model

## Codice utile
```sql
SELECT ST_Distance_Sphere(point(latitude, longitude), point(0,0)) FROM `shops` WHERE 1;
```