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

