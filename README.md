
# api_jobs

simple project for apply Job



## API Reference

#### register user

```http
  post /api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required** |
| `email` | `string` | **Required** | ** unique **
| `password` | `string` | **Required** |
| `password_confirmation` | `string` | **Required** |

#### login user

```http
  post /api/login
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email` | `string` | **Required** |
| `password` | `string` | **Required** |

#### logout user

```http
  get /api/logout
```

#### dashboard user

```http
  get /api/dashboard
```

#### edit profile user

```http
  post /api/edit_profile
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name` | `string` | **optional** |
| `email` | `string` | **optional** |
| `password` | `string` | **optional** |
| `address` | `string` | **optional** |
| `phone` | `string` | **optional** |
| `age` | `string` | **optional** |
| `image` | `string` | **optional** |
| `cv` | `string` | **optional** |

#### apply job

```http
  get /api/apply/{job_id}
```

#### send details apply

```http
  post /api/details/{job_id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `expected_salary` | `string` | **optional** |
| `current_salary` | `string` | **optional** |







