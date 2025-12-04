# Team Sport API - Teljes Dokumentáció

## Tartalomjegyzék
- [Általános infók](#általános-infók)
- [Authentikáció](#authentikáció)
- [API végpontok](#api-végpontok)
- [Adatmodellek](#adatmodellek)
- [Hibakezelés](#hibakezelés)
- [Példakódok](#példakódok)

---

## Általános infók

### Base URL
```
http://localhost:8000/api
```

### Content-Type
Minden kérés és válasz JSON formátumú:
```
Content-Type: application/json
```

### Authentikáció típusa
Bearer Token (Laravel Sanctum)

### Időzóna
`Europe/Budapest` - Magyar idő

### Válasz formátum
Az API mindig JSON formátumban válaszol:
```json
{
  "message": "Művelet sikeres/sikertelen",
  "data": { ... },
  "errors": { ... }
}
```

---

## Authentikáció

### Hogyan működik?

1. **Regisztrálsz** vagy **bejelentkezel**
2. Kapsz egy **access_token**-t
3. Ezt a tokent küldöd minden védett végponthoz a headerben:
```
Authorization: Bearer {token}
```

### Token élettartama
- A token addig él, amíg ki nem jelentkezel
- Logout törli a tokent
- Egy usernek több aktív tokenje is lehet (több eszköz)

### Publikus végpontok (nem kell token)
- `POST /api/register`
- `POST /api/login`
- `GET /api/ping`

### Védett végpontok (kell token)
- Minden más endpoint (`/api/me`, `/api/teams/*`, `/api/logout`)

---

## API végpontok

### 1. Health Check

#### Ping - API működés ellenőrzés
```http
GET /api/ping
```

**Válasz:**
```json
{
  "status": "success",
  "message": "API is running",
  "timestamp": "2025-12-04 10:30:00",
  "timezone": "Europe/Budapest"
}
```

**Mit ad vissza:**
- `status`: mindig "success" ha él az API
- `message`: státusz üzenet
- `timestamp`: aktuális idő
- `timezone`: szerver időzónája

---

### 2. Regisztráció

#### Új felhasználó létrehozása
```http
POST /api/register
```

**Request Body:**
```json
{
  "name": "Kiss János",
  "email": "janos@example.com",
  "password": "titkos123",
  "password_confirmation": "titkos123",
  "sport_type": "football",
  "skill_level": "intermediate"
}
```

**Kötelező mezők:**
- `name`: string, max 255 karakter
- `email`: érvényes email formátum, egyedi
- `password`: min 8 karakter
- `password_confirmation`: meg kell egyezzen a password-del

**Opcionális mezők:**
- `sport_type`: string (pl: football, basketball, volleyball)
- `skill_level`: string (pl: beginner, intermediate, advanced, professional)

**Sikeres válasz (201):**
```json
{
  "message": "Registration successful",
  "user": {
    "id": 1,
    "name": "Kiss János",
    "email": "janos@example.com",
    "sport_type": "football",
    "skill_level": "intermediate",
    "created_at": "2025-12-04 10:30:00",
    "updated_at": "2025-12-04 10:30:00"
  },
  "access_token": "1|abc123def456...",
  "token_type": "Bearer"
}
```

**Hibás válasz (422):**
```json
{
  "message": "validation.required (and 2 more errors)",
  "errors": {
    "email": ["Az email mező kötelező."],
    "password": ["A jelszó mező kötelező."]
  }
}
```

---

### 3. Bejelentkezés

#### Login - Token megszerzése
```http
POST /api/login
```

**Request Body:**
```json
{
  "email": "mate@example.com",
  "password": "Mate123"
}
```

**Kötelező mezők:**
- `email`: érvényes email
- `password`: jelszó

**Sikeres válasz (200):**
```json
{
  "message": "Login successful",
  "user": {
    "id": 1,
    "name": "Máté",
    "email": "mate@example.com",
    "sport_type": "football",
    "skill_level": "advanced",
    "created_at": "2025-12-01 12:00:00",
    "updated_at": "2025-12-01 12:00:00"
  },
  "access_token": "2|xyz789abc...",
  "token_type": "Bearer"
}
```

**Hibás válasz (422):**
```json
{
  "message": "validation.email",
  "errors": {
    "email": ["A megadott bejelentkezési adatok helytelenek."]
  }
}
```

---

### 4. Kijelentkezés

#### Logout - Token törlése
```http
POST /api/logout
Authorization: Bearer {token}
```

**Request Body:** üres

**Sikeres válasz (200):**
```json
{
  "message": "Logout successful"
}
```

**Hibás válasz (401):**
```json
{
  "message": "Unauthenticated."
}
```

---

### 5. Saját adatok lekérése

#### Me - Bejelentkezett user adatai
```http
GET /api/me
Authorization: Bearer {token}
```

**Sikeres válasz (200):**
```json
{
  "user": {
    "id": 1,
    "name": "Máté",
    "email": "mate@example.com",
    "sport_type": "football",
    "skill_level": "advanced",
    "email_verified_at": null,
    "created_at": "2025-12-01 12:00:00",
    "updated_at": "2025-12-01 12:00:00"
  }
}
```

**Hibás válasz (401):**
```json
{
  "message": "Unauthenticated."
}
```

---

### 6. Csapatok listázása

#### Teams Index - Összes csapat
```http
GET /api/teams
Authorization: Bearer {token}
```

**Query paraméterek (opcionális):**
- `page`: oldalszám (alapértelmezett: 1)
- Laravel automatikus paginálás, 15 elem/oldal

**Sikeres válasz (200):**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Piros Warriors",
      "sport_type": "football",
      "max_members": 10,
      "members_count": 3,
      "members": [
        {
          "id": 1,
          "name": "Máté",
          "email": "mate@example.com",
          "sport_type": "football",
          "skill_level": "advanced"
        }
      ],
      "created_at": "2025-12-01 14:00:00",
      "updated_at": "2025-12-01 14:00:00"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/teams?page=1",
    "last": "http://localhost:8000/api/teams?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "path": "http://localhost:8000/api/teams",
    "per_page": 15,
    "to": 10,
    "total": 10
  }
}
```

---

### 7. Egy csapat lekérése

#### Teams Show - Konkrét csapat adatai
```http
GET /api/teams/{id}
Authorization: Bearer {token}
```

**URL paraméter:**
- `{id}`: csapat ID (integer)

**Sikeres válasz (200):**
```json
{
  "data": {
    "id": 1,
    "name": "Piros Warriors",
    "sport_type": "football",
    "max_members": 10,
    "members_count": 3,
    "members": [
      {
        "id": 1,
        "name": "Máté",
        "email": "mate@example.com",
        "sport_type": "football",
        "skill_level": "advanced",
        "joined_at": "2025-12-01 14:30:00",
        "role": "captain"
      },
      {
        "id": 2,
        "name": "Kiss Péter",
        "email": "peter@example.com",
        "sport_type": "football",
        "skill_level": "intermediate",
        "joined_at": "2025-12-02 10:15:00",
        "role": "member"
      }
    ],
    "created_at": "2025-12-01 14:00:00",
    "updated_at": "2025-12-01 14:00:00"
  }
}
```

**Hibás válasz (404):**
```json
{
  "message": "No query results for model [App\\Models\\Team] {id}"
}
```

---

### 8. Új csapat létrehozása

#### Teams Store - Csapat létrehozás
```http
POST /api/teams
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "name": "Kék Tigrisek",
  "sport_type": "basketball",
  "max_members": 12
}
```

**Kötelező mezők:**
- `name`: string, max 255 karakter
- `sport_type`: string, max 255 karakter

**Opcionális mezők:**
- `max_members`: integer, 1-100 között (alapértelmezett: 10)

**Sikeres válasz (201):**
```json
{
  "message": "Team created successfully",
  "data": {
    "id": 11,
    "name": "Kék Tigrisek",
    "sport_type": "basketball",
    "max_members": 12,
    "members_count": 0,
    "members": [],
    "created_at": "2025-12-04 11:00:00",
    "updated_at": "2025-12-04 11:00:00"
  }
}
```

**Hibás válasz (422):**
```json
{
  "message": "validation.required (and 1 more error)",
  "errors": {
    "name": ["A csapat neve kötelező."],
    "sport_type": ["A sport típus kötelező."]
  }
}
```

---

### 9. Csapat frissítése (PUT)

#### Teams Update - Teljes frissítés
```http
PUT /api/teams/{id}
Authorization: Bearer {token}
```

**URL paraméter:**
- `{id}`: csapat ID

**Request Body (minden mező kötelező PUT-nál):**
```json
{
  "name": "Új Név",
  "sport_type": "volleyball",
  "max_members": 15
}
```

**Sikeres válasz (200):**
```json
{
  "message": "Team updated successfully",
  "data": {
    "id": 1,
    "name": "Új Név",
    "sport_type": "volleyball",
    "max_members": 15,
    "members_count": 3,
    "members": [ ... ],
    "created_at": "2025-12-01 14:00:00",
    "updated_at": "2025-12-04 11:30:00"
  }
}
```

---

### 10. Csapat részleges frissítése (PATCH)

#### Teams Partial Update - Részleges frissítés
```http
PATCH /api/teams/{id}
Authorization: Bearer {token}
```

**URL paraméter:**
- `{id}`: csapat ID

**Request Body (bármely mező küldése opcionális):**
```json
{
  "name": "Módosított Név"
}
```

**Sikeres válasz (200):**
```json
{
  "message": "Team updated successfully",
  "data": {
    "id": 1,
    "name": "Módosított Név",
    "sport_type": "volleyball",
    "max_members": 15,
    "members_count": 3,
    "members": [ ... ],
    "created_at": "2025-12-01 14:00:00",
    "updated_at": "2025-12-04 11:45:00"
  }
}
```

**PATCH vs PUT különbség:**
- **PUT**: minden mezőt küldeni kell (teljes csere)
- **PATCH**: csak amit módosítani akarsz (részleges frissítés)

---

### 11. Csapat törlése

#### Teams Destroy - Csapat törlés
```http
DELETE /api/teams/{id}
Authorization: Bearer {token}
```

**URL paraméter:**
- `{id}`: csapat ID

**Sikeres válasz (200):**
```json
{
  "message": "Team deleted successfully"
}
```

**Hibás válasz (404):**
```json
{
  "message": "No query results for model [App\\Models\\Team] {id}"
}
```

**Mit töröl:**
- A csapat rekordot
- Az összes team_members kapcsolatot (cascade delete miatt)

---

## Adatmodellek

### User Model

```json
{
  "id": 1,
  "name": "Máté",
  "email": "mate@example.com",
  "sport_type": "football",
  "skill_level": "advanced",
  "email_verified_at": null,
  "created_at": "2025-12-01 12:00:00",
  "updated_at": "2025-12-01 12:00:00"
}
```

**Mezők:**
- `id`: egyedi azonosító (auto increment)
- `name`: felhasználó neve
- `email`: email cím (egyedi)
- `sport_type`: preferált sport típus (nullable)
- `skill_level`: képzettségi szint (nullable)
- `email_verified_at`: email megerősítés ideje (nullable)
- `created_at`: létrehozás időpontja
- `updated_at`: utolsó módosítás időpontja

**Rejtett mezők (nem küldöm vissza):**
- `password`: hash-elt jelszó
- `remember_token`: Laravel token

### Team Model

```json
{
  "id": 1,
  "name": "Piros Warriors",
  "sport_type": "football",
  "max_members": 10,
  "members_count": 3,
  "members": [ ... ],
  "created_at": "2025-12-01 14:00:00",
  "updated_at": "2025-12-01 14:00:00"
}
```

**Mezők:**
- `id`: egyedi azonosító
- `name`: csapat neve
- `sport_type`: sport típus
- `max_members`: maximum tagok száma (alapértelmezett: 10)
- `members_count`: aktuális tagok száma (számított mező)
- `members`: csapat tagjainak tömbje (UserResource)
- `created_at`: létrehozás
- `updated_at`: módosítás

### TeamMember Model (pivot)

```json
{
  "id": 1,
  "user_id": 1,
  "team_id": 1,
  "role": "captain",
  "joined_at": "2025-12-01 14:30:00"
}
```

**Mezők:**
- `id`: kapcsolat azonosító
- `user_id`: user ID (foreign key)
- `team_id`: csapat ID (foreign key)
- `role`: szerep a csapatban (member/captain)
- `joined_at`: csatlakozás időpontja

**Szerepek:**
- `member`: sima tag
- `captain`: csapatkapitány

---

## Hibakezelés

### HTTP státuszkódok

| Kód | Jelentés | Mikor jön |
|-----|----------|-----------|
| 200 | OK | Sikeres GET, PUT, PATCH, DELETE |
| 201 | Created | Sikeres POST (új resource létrehozva) |
| 401 | Unauthorized | Hiányzó vagy érvénytelen token |
| 404 | Not Found | Resource nem található (pl rossz ID) |
| 422 | Unprocessable Entity | Validációs hiba |
| 500 | Internal Server Error | Szerver hiba |

### Validációs hibák (422)

Amikor a bemeneti adatok hibásak:
```json
{
  "message": "validation.required (and 2 more errors)",
  "errors": {
    "email": [
      "Az email mező kötelező.",
      "Az email már létezik."
    ],
    "password": [
      "A jelszó mező kötelező."
    ]
  }
}
```

### Authentikációs hibák (401)

Amikor nincs vagy hibás a token:
```json
{
  "message": "Unauthenticated."
}
```

### Not Found hibák (404)

Amikor az ID nem létezik:
```json
{
  "message": "No query results for model [App\\Models\\Team] 999"
}
```

---

## Példakódok

### JavaScript (Fetch API)

#### Login
```javascript
async function login() {
  const response = await fetch('http://localhost:8000/api/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      email: 'mate@example.com',
      password: 'Mate123'
    })
  });
  
  const data = await response.json();
  const token = data.access_token;
  
  // Token mentése
  localStorage.setItem('token', token);
  
  return data;
}
```

#### Csapatok lekérése
```javascript
async function getTeams() {
  const token = localStorage.getItem('token');
  
  const response = await fetch('http://localhost:8000/api/teams', {
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  });
  
  return await response.json();
}
```

#### Új csapat létrehozása
```javascript
async function createTeam(name, sportType, maxMembers) {
  const token = localStorage.getItem('token');
  
  const response = await fetch('http://localhost:8000/api/teams', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: name,
      sport_type: sportType,
      max_members: maxMembers
    })
  });
  
  return await response.json();
}
```

### PHP (cURL)

#### Login
```php
<?php
$ch = curl_init('http://localhost:8000/api/login');

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'email' => 'mate@example.com',
    'password' => 'Mate123'
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$data = json_decode($response, true);
$token = $data['access_token'];

curl_close($ch);
?>
```

#### Csapatok lekérése
```php
<?php
$token = 'your_token_here';

$ch = curl_init('http://localhost:8000/api/teams');

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$teams = json_decode($response, true);

curl_close($ch);
?>
```

### Python (requests)

#### Login
```python
import requests

url = 'http://localhost:8000/api/login'
data = {
    'email': 'mate@example.com',
    'password': 'Mate123'
}

response = requests.post(url, json=data)
result = response.json()
token = result['access_token']

print(f"Token: {token}")
```

#### Csapatok lekérése
```python
import requests

token = 'your_token_here'
url = 'http://localhost:8000/api/teams'

headers = {
    'Authorization': f'Bearer {token}',
    'Content-Type': 'application/json'
}

response = requests.get(url, headers=headers)
teams = response.json()

print(teams)
```

### PowerShell

#### Login
```powershell
$body = @{
    email = "mate@example.com"
    password = "Mate123"
} | ConvertTo-Json

$response = Invoke-RestMethod -Uri "http://localhost:8000/api/login" `
    -Method Post `
    -Body $body `
    -ContentType "application/json"

$token = $response.access_token
Write-Host "Token: $token"
```

#### Csapatok lekérése
```powershell
$token = "your_token_here"

$headers = @{
    "Authorization" = "Bearer $token"
    "Content-Type" = "application/json"
}

$response = Invoke-RestMethod -Uri "http://localhost:8000/api/teams" `
    -Method Get `
    -Headers $headers

$response.data
```

---

## Rate Limiting

Jelenleg nincs rate limiting beállítva, de Laravel alapértelmezetten 60 kérés/perc limit van API-kra.

Ha túllépnéd:
```json
{
  "message": "Too Many Attempts."
}
```

HTTP 429 státuszkóddal.

---

## CORS

Ha frontend-ből hívod más domain-ről, akkor CORS beállítás kell a Laravel config-ban (`config/cors.php`).

Jelenlegi beállítás: localhost-ról minden működik.

---

## Következő lépések

### Ha tesztelni szeretnéd:
1. Postman collection import: `TeamSport_API_READY.postman_collection.json`
2. Futtatd a login kérést
3. Token automatikusan mentve
4. Használd a többi endpointot

### Ha fejleszteni szeretnéd:
- Új végpontok hozzáadása: `routes/api.php`
- Új validációk: Controller-ekben
- Új mezők: Migration készítés + Model fillable frissítés
- Új kapcsolatok: Model relationship metódusok

---

## Support

Ha bármi nem világos vagy hiba van:
1. Nézd meg a Laravel log-ot: `storage/logs/laravel.log`
2. Debug mode: `.env` fájlban `APP_DEBUG=true`
3. Postman response megtekintése

---

**Verzió:** 1.0  
**Utolsó frissítés:** 2025-12-04  
**Laravel verzió:** 11.x  
**PHP verzió:** 8.2+
