# Module C Frontend Development - API Documentation

You are going to use a pre-developed API. A separate [api.yaml](api.yaml) has been provided to you, which contains detailed request structure, and example responses, as well as live try-out feature. To open that, please use the provided vscode swagger preview extension (`CTRL+SHIFT+P -> Preview Swagger`).

For quick reference, you can find details about the endpoints as well.

**Note:** All endpoints are prefixed with `api/v1`. So an example full endpoint is `<API_URL>/api/v1/events`.

# No DB

At any point the server cannot connect to the database, it will return a `503` response.

## Authentication

Upon `login` or `register`, the server returns a token. Any time you need to access an endpoint that only a logged-in user can, you need to provide this token in the `Authorization` header as a bearer scheme. Example: `Authorization: Bearer 2j35j236nhlj23hl21j5l1j`. If a token is invalid, missing or expired, the server will return a `401` response (only if trying to access protected route), expection to this is `GET /events/{id}`.\
The endpoints that requires a logged-in user:

- `POST /logout`
- `GET /events/{id}` - only if event is private
- any route prefixed with `my`
- any route prefixed with `orders`

## Authentication endpoints

`POST /login`: logs in customer, returns bearer token and customer details. Returns `200` on success, `401` on invalid credentials, and `422` if email and/or password field is empty.
`POST /register`: registers a new customer, and returns token with customer details. Returns `201` on success, `422` on validation error.
`POST /logout`: logs out currently logged in customer

## Events

`GET /events`: returns a paginated list of events, with pagination controls. Accepts filters. If `pictures` parameter query is not provided, it will NOT return pictures.
`GET /events/{id}`: returns a single event. If event is not found (invalid id), or it is private and the customer doesn't have access to it, it returns `404`. If `pictures` parameter query is not provided, it will not return pictures.

## Categories

`GET /categories`: list of categories
`GET /categories/{id}`: single category. If not found, returns `404`.

## Picture sizes

`GET /picture-sizes`: list of available picture sizes
`GET /picture-sizes/{id}`: single picture size. If not found, returns `404`.

## Orders

`POST /orders`: creates a new order, on success returns `201`, on validation fail `422`.
`GET /orders/{id}`: returns a single order. If not found, returns `404`. If order doesn't belong to customer, returns `403`.
`PATCH /orders/{id}`: cancels (only) a confirmed order. If the order has already been cancelled, returns `204`. If tries to cancel a paid order, returns `409`. On success returns `200`.

## Customer specific (my)

`GET /my/profile`: returns customer data
`PUT /my/profile`: update customer details, except email and password
`GET /my/events`: returns private events of customer. If `pictures` parameter query is not provided, it will not return pictures.
`GET /my/orders`: returns customer orders

## Other

`GET /status`: check if API is running
`POST /db/reset`: reset database data to default state

## [if API is not running locally, ignore]

You are using a Laravel-based API. It has already been fully installed on your machine, including a dedicated local database. To run the API, navigate to its folder, open cmd and run the `php artisan serve` command. By default, it will run on `http://127.0.0.1:8000`.\
If you need to reseed the database, run `php artisan migrate:fresh --seed`. Alternatively, you can use the reset endpoint.
