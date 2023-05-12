** Query Builder **
===================
```php
$queryBuilder = new QueryBuilder();

$query = $queryBuilder->select('id', 'name')
->from('users')
->where('age', '>', 18)
->join('orders', 'users.id', '=', 'orders.user_id')
->groupBy('age')
->orderBy('name', 'ASC')
->build();

echo $query;
```

Output:

```sql

SELECT id, name FROM users JOIN orders ON users.id = orders.user_id WHERE age > 18 GROUP BY age ORDER BY name ASC
```

```php
// Récupère la méthode HTTP utilisée pour la requête

$method = Request::getMethod();

// Récupère le chemin de l'URL de la requête
$path = Request::getPath();

// Récupère les paramètres de requête GET
$queryParams = Request::getQueryParams();

// Récupère les données postées dans la requête
$postData = Request::getPostData();

// Récupère les en-têtes de la requête
$headers = Request::getHeaders();

// Récupère les cookies de la requête
$cookies = Request::getCookies();
```