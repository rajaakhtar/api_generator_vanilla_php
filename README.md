# Raja's Little API Generator

This is a simple, no-database RESTful API demo built in **vanilla PHP** using a custom lightweight MVC structure.

---

## 🔧 Features

- No database attached
- Uses **hardcoded credentials** to demonstrate login
- Generates a **secure token** on login
- Requires token as **Bearer Token** for subsequent requests
- Built using a **custom MVC structure**
- Includes a **simple router** (no `.htaccess` needed)
- Tested using **Postman or curl**

---

## 🚀 How to Use

### 1. Get Token

Make a `POST` request to `/api/auth`:

```bash
curl -X POST http://apiproject.test/api/auth \
  -H "Content-Type: application/json" \
  -d '{"username":"admin", "password":"secret"}'
```

Response should be a JSON object containing a token:

```bash
{ "token": "abc123..." }
```


### 2. Use Token

Make a GET request to /api/data using the token:

```bash
curl http://apiproject.test/api/data \
  -H "Authorization: Bearer abc123..."
```

Expected response:

```bash
{
  "message": "This is protected data",
  "data": { "a": 1, "b": 2 }
}
```