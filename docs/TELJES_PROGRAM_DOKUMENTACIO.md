# Team Sport - Teljes Programdokumentáció

## Tartalomjegyzék
1. [Projekt Áttekintés](#projekt-áttekintés)
2. [Technológiai Stack](#technológiai-stack)
3. [Telepítés és Konfiguráció](#telepítés-és-konfiguráció)
4. [Adatbázis Struktúra](#adatbázis-struktúra)
5. [API Végpontok](#api-végpontok)
6. [Postman Collection](#postman-collection)
7. [Tesztelés](#tesztelés)
8. [Authentikáció](#authentikáció)
9. [Használati Példák](#használati-példák)
10. [Hibaelhárítás](#hibaelhárítás)

---

## Projekt Áttekintés

Ez egy Laravel 11-ben készült REST API projekt, amit csapatok kezelésére csináltam. A rendszer lehetővé teszi felhasználók regisztrációját, bejelentkezését, és csapatok létrehozását/kezelését.

### Főbb funkciók:
- 👤 **User authentikáció** - Regisztráció, bejelentkezés, kijelentkezés
- 🏆 **Csapat kezelés** - CRUD műveletek csapatokra
- 🔐 **Bearer Token** - Laravel Sanctum alapú biztonságos authentikáció
- 🧪 **Tesztek** - 27 automated test teljes lefedettséggel
- 📊 **Adatbázis kapcsolatok** - User-Team many-to-many relationship
- 🌍 **Magyar lokalizáció** - Időzóna, nyelv, faker adatok

---

## Technológiai Stack

### Backend
- **Laravel 11.x** - PHP framework
- **PHP 8.2+** - Programozási nyelv
- **Laravel Sanctum 4.2.1** - API token authentikáció
- **Eloquent ORM** - Adatbázis kezelés

### Adatbázis
- **SQLite** - Alapértelmezett (könnyű fejlesztéshez)
- **MySQL kompatibilis** - Átállítható production környezetre

### Testing
- **PHPUnit** - Unit és Feature tesztek
- **Laravel Testing** - HTTP tesztek, adatbázis tesztek

### Development Tools
- **Composer** - PHP package manager
- **Artisan** - Laravel CLI
- **Faker (hu_HU)** - Magyar fake adatok generálása
- **Postman** - API tesztelés

### További Packages
- **Guzzle** - HTTP client
- **Carbon** - Dátum/idő kezelés
- **Monolog** - Logging

---

## Telepítés és Konfiguráció

### 1. Repository klónozása
```bash
git clone https://github.com/1tc-molmat/Team-Sport.git
cd Team-Sport
```

### 2. Függőségek telepítése
```bash
composer install
```

### 3. Environment konfiguráció
```bash
# .env fájl létrehozása
cp .env.example .env

# Application key generálás
php artisan key:generate
```

### 4. Adatbázis beállítás

A `.env` fájlban:
```env
APP_NAME="Team Sport API"
APP_ENV=local
APP_DEBUG=true
APP_TIMEZONE=Europe/Budapest
APP_LOCALE=hu
APP_FAKER_LOCALE=hu_HU

DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite
```

### 5. Adatbázis migrálás és seed
```bash
# Adatbázis táblák létrehozása
php artisan migrate

# Fake adatok feltöltése (11 user + 10 csapat)
php artisan db:seed
```

### 6. Szerver indítás
```bash
php artisan serve
```

Az API elérhető: `http://localhost:8000/api`

---

## Adatbázis Struktúra

### Táblák áttekintése

#### 1. `users` tábla
Felhasználók adatait tárolja.

| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint (PK) | Egyedi azonosító |
| name | varchar(255) | Felhasználó neve |
| email | varchar(255) | Email cím (egyedi) |
| password | varchar(255) | Hash-elt jelszó |
| sport_type | varchar(255) | Preferált sport típus |
| skill_level | varchar(255) | Képzettségi szint |
| email_verified_at | timestamp | Email megerősítés ideje |
| remember_token | varchar(100) | Laravel session token |
| created_at | timestamp | Létrehozás időpontja |
| updated_at | timestamp | Módosítás időpontja |

**Kapcsolatok:**
- `hasMany` → `team_members`
- `belongsToMany` → `teams` (through team_members)

#### 2. `teams` tábla
Csapatok adatait tárolja.

| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint (PK) | Egyedi azonosító |
| name | varchar(255) | Csapat neve |
| sport_type | varchar(255) | Sport típus |
| max_members | integer | Maximum tagok száma (default: 10) |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Kapcsolatok:**
- `hasMany` → `team_members`
- `belongsToMany` → `users` (through team_members)

#### 3. `team_members` tábla (pivot)
User és Team közötti kapcsolatot tárolja.

| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint (PK) | Egyedi azonosító |
| user_id | bigint (FK) | User azonosító |
| team_id | bigint (FK) | Csapat azonosító |
| role | varchar(50) | Szerep (member/captain) |
| joined_at | timestamp | Csatlakozás időpontja |

**Foreign Keys:**
- `user_id` → `users.id` (CASCADE delete)
- `team_id` → `teams.id` (CASCADE delete)

#### 4. `personal_access_tokens` tábla
Sanctum Bearer tokenek tárolása.

| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint (PK) | Token azonosító |
| tokenable_type | varchar(255) | Model típus (User) |
| tokenable_id | bigint | User ID |
| name | varchar(255) | Token neve |
| token | varchar(64) | Hash-elt token (egyedi) |
| abilities | text | Token jogosultságok |
| last_used_at | timestamp | Utolsó használat |
| expires_at | timestamp | Lejárat |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

### Adatbázis Diagram

```
┌─────────────┐         ┌──────────────────┐         ┌─────────────┐
│   users     │         │  team_members    │         │    teams    │
├─────────────┤         ├──────────────────┤         ├─────────────┤
│ id (PK)     │────┐    │ id (PK)          │    ┌────│ id (PK)     │
│ name        │    └───→│ user_id (FK)     │    │    │ name        │
│ email       │         │ team_id (FK)     │←───┘    │ sport_type  │
│ password    │         │ role             │         │ max_members │
│ sport_type  │         │ joined_at        │         │ created_at  │
│ skill_level │         │                  │         │ updated_at  │
│ created_at  │         └──────────────────┘         └─────────────┘
│ updated_at  │
└─────────────┘
```

### Seed Adatok

A `php artisan db:seed` parancs fut:

**Users (11 db):**
- 1 valódi user: Máté (mate@example.com / Mate123)
- 10 faker user magyar nevekkel (jelszó: password)

**Teams (10 db):**
- Random generált csapatnevek (pl: "Piros Warriors", "Kék Tigrisek")
- Random sport típusok (football, basketball, volleyball, stb)

**Team Members (~38 kapcsolat):**
- Minden csapatban 2-5 tag random
- Máté 2 csapatban captain

---

## API Végpontok

### Base URL
```
http://localhost:8000/api
```

### Végpontok összefoglalása

| Metódus | Végpont | Auth | Leírás |
|---------|---------|------|--------|
| GET | /ping | ❌ | API health check |
| POST | /register | ❌ | Regisztráció |
| POST | /login | ❌ | Bejelentkezés |
| POST | /logout | ✅ | Kijelentkezés |
| GET | /me | ✅ | Saját adatok |
| GET | /teams | ✅ | Csapatok listája |
| POST | /teams | ✅ | Új csapat |
| GET | /teams/{id} | ✅ | Egy csapat |
| PUT | /teams/{id} | ✅ | Teljes frissítés |
| PATCH | /teams/{id} | ✅ | Részleges frissítés |
| DELETE | /teams/{id} | ✅ | Törlés |

---

### 1. Health Check - API státusz ellenőrzés

**Endpoint:**
```http
GET /api/ping
```

**Auth:** Nem kell token

**Válasz (200):**
```json
{
  "status": "success",
  "message": "API is running",
  "timestamp": "2025-12-04 10:30:00",
  "timezone": "Europe/Budapest"
}
```

**Mire jó:** Gyors ellenőrzés, hogy az API működik-e.

---

### 2. Regisztráció - Új felhasználó létrehozása

**Endpoint:**
```http
POST /api/register
```

**Auth:** Nem kell token

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
- `name`: max 255 karakter
- `email`: érvényes email, egyedi
- `password`: min 8 karakter
- `password_confirmation`: egyezzen a password-del

**Opcionális:**
- `sport_type`: sport típus
- `skill_level`: képzettség (beginner/intermediate/advanced/professional)

**Sikeres válasz (201):**
```json
{
  "message": "Registration successful",
  "user": {
    "id": 12,
    "name": "Kiss János",
    "email": "janos@example.com",
    "sport_type": "football",
    "skill_level": "intermediate",
    "created_at": "2025-12-04 10:30:00",
    "updated_at": "2025-12-04 10:30:00"
  },
  "access_token": "12|abc123def456...",
  "token_type": "Bearer"
}
```

**Validációs hiba (422):**
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

### 3. Bejelentkezés - Token megszerzése

**Endpoint:**
```http
POST /api/login
```

**Auth:** Nem kell token

**Request Body:**
```json
{
  "email": "mate@example.com",
  "password": "Mate123"
}
```

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
  "access_token": "1|xyz789abc...",
  "token_type": "Bearer"
}
```

**Hibás bejelentkezés (422):**
```json
{
  "message": "validation.email",
  "errors": {
    "email": ["A megadott bejelentkezési adatok helytelenek."]
  }
}
```

---

### 4. Kijelentkezés - Token törlése

**Endpoint:**
```http
POST /api/logout
```

**Auth:** Bearer Token szükséges

**Headers:**
```
Authorization: Bearer {token}
```

**Válasz (200):**
```json
{
  "message": "Logout successful"
}
```

**Token nélkül (401):**
```json
{
  "message": "Unauthenticated."
}
```

---

### 5. Saját adatok - Bejelentkezett user

**Endpoint:**
```http
GET /api/me
```

**Auth:** Bearer Token szükséges

**Válasz (200):**
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

---

### 6. Csapatok listája - Összes csapat lekérése

**Endpoint:**
```http
GET /api/teams
```

**Auth:** Bearer Token szükséges

**Query paraméterek (opcionális):**
- `page`: oldalszám (default: 1)

**Válasz (200):**
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
          "skill_level": "advanced",
          "joined_at": "2025-12-01 14:30:00",
          "role": "captain"
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
    "last_page": 1,
    "per_page": 15,
    "total": 10
  }
}
```

**Paginálás:** 15 csapat/oldal

---

### 7. Egy csapat lekérése - Részletes adatok

**Endpoint:**
```http
GET /api/teams/{id}
```

**Auth:** Bearer Token szükséges

**URL paraméter:**
- `{id}`: csapat ID (integer)

**Válasz (200):**
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
      }
    ],
    "created_at": "2025-12-01 14:00:00",
    "updated_at": "2025-12-01 14:00:00"
  }
}
```

**Nem létezik (404):**
```json
{
  "message": "No query results for model [App\\Models\\Team] 999"
}
```

---

### 8. Új csapat létrehozása

**Endpoint:**
```http
POST /api/teams
```

**Auth:** Bearer Token szükséges

**Request Body:**
```json
{
  "name": "Kék Tigrisek",
  "sport_type": "basketball",
  "max_members": 12
}
```

**Kötelező mezők:**
- `name`: csapat neve (max 255)
- `sport_type`: sport típus (max 255)

**Opcionális:**
- `max_members`: 1-100 között (default: 10)

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

---

### 9. Csapat frissítése (PUT) - Teljes frissítés

**Endpoint:**
```http
PUT /api/teams/{id}
```

**Auth:** Bearer Token szükséges

**Request Body (minden mező kötelező PUT-nál):**
```json
{
  "name": "Új Név",
  "sport_type": "volleyball",
  "max_members": 15
}
```

**Válasz (200):**
```json
{
  "message": "Team updated successfully",
  "data": {
    "id": 1,
    "name": "Új Név",
    "sport_type": "volleyball",
    "max_members": 15,
    "members_count": 3,
    "members": [...],
    "created_at": "2025-12-01 14:00:00",
    "updated_at": "2025-12-04 11:30:00"
  }
}
```

---

### 10. Csapat részleges frissítése (PATCH)

**Endpoint:**
```http
PATCH /api/teams/{id}
```

**Auth:** Bearer Token szükséges

**Request Body (bármelyik mező opcionális):**
```json
{
  "name": "Módosított Név"
}
```

**Válasz (200):**
```json
{
  "message": "Team updated successfully",
  "data": {
    "id": 1,
    "name": "Módosított Név",
    "sport_type": "volleyball",
    "max_members": 15,
    "members_count": 3,
    "members": [...],
    "created_at": "2025-12-01 14:00:00",
    "updated_at": "2025-12-04 11:45:00"
  }
}
```

**PUT vs PATCH:**
- **PUT**: minden mezőt küldeni kell
- **PATCH**: csak amit módosítani akarsz

---

### 11. Csapat törlése

**Endpoint:**
```http
DELETE /api/teams/{id}
```

**Auth:** Bearer Token szükséges

**Válasz (200):**
```json
{
  "message": "Team deleted successfully"
}
```

**Mit töröl:**
- A csapat rekordot
- Az összes team_members kapcsolatot (CASCADE)

---

## Postman Collection

Készítettem egy kész Postman collection-t, amit azonnal használhatsz!

### Fájl neve:
`TeamSport_API_READY.postman_collection.json`

### Hogyan használd:

1. **Import a Postmanbe**
   - Nyisd meg Postmant
   - File → Import
   - Válaszd ki a `TeamSport_API_READY.postman_collection.json` fájlt

2. **Első lépés: Login**
   - Futtasd a "1. Login (Máté) - START HERE!" kérést
   - A token automatikusan el van mentve (test script)

3. **További végpontok használata**
   - Használd bármelyik Teams végpontot
   - A token automatikusan bekerül a headerbe

### Collection tartalma:

![Postman Collection](./Névtelen.png)

A collection 11 kérést tartalmaz:
- ✅ Health Check (Ping)
- ✅ Register (Random user generálás)
- ✅ Login (Máté bejelentkezés)
- ✅ Get Me (Saját adatok)
- ✅ Logout
- ✅ Get All Teams (Lista)
- ✅ Get Single Team
- ✅ Create Team
- ✅ Update Team (PUT)
- ✅ Partial Update (PATCH)
- ✅ Delete Team

### Beépített funkciók:

**Automatikus token mentés:**
```javascript
// Test script minden login/register után
if (pm.response.code === 200 || pm.response.code === 201) {
    var jsonData = pm.response.json();
    if (jsonData.access_token) {
        pm.environment.set("token", jsonData.access_token);
        console.log("Token saved: " + jsonData.access_token);
    }
}
```

**Random email generálás regisztrációnál:**
```json
{
  "email": "user{{$randomInt}}@example.com"
}
```

**Base URL változó:**
- `{{base_url}}` = `http://localhost:8000/api`
- Egyszerűen változtatható production környezetre

---

## Tesztelés

A projekt teljes tesztelési lefedettséggel rendelkezik. **27 automated test** van implementálva.

### Tesztek futtatása

```bash
php artisan test
```

### Test eredmény:

![Test Results](./test.png)

**Összesítés:**
- ✅ **27 teszt passou**
- ✅ **124 assertion**
- ✅ **~1 másodperc futási idő**
- ✅ **0 failed test**

### Teszt fájlok struktúrája

```
tests/
├── Feature/
│   ├── AuthControllerTest.php       (10 teszt)
│   ├── TeamControllerTest.php       (11 teszt)
│   ├── HealthCheckTest.php          (4 teszt)
│   └── ExampleTest.php              (1 teszt)
└── Unit/
    └── ExampleTest.php               (1 teszt)
```

---

### AuthControllerTest.php (10 teszt)

**Mit tesztel:** Authentikációs végpontok működése

| # | Teszt neve | Mit ellenőriz |
|---|------------|---------------|
| 1 | test_user_can_register_successfully | Sikeres regisztráció, token generálás |
| 2 | test_register_fails_with_missing_fields | Hiányzó mezők validációja |
| 3 | test_register_fails_with_duplicate_email | Duplikált email elutasítása |
| 4 | test_user_can_login_successfully | Sikeres bejelentkezés, token visszaadás |
| 5 | test_login_fails_with_wrong_password | Hibás jelszó elutasítása |
| 6 | test_login_fails_with_nonexistent_user | Nem létező user elutasítása |
| 7 | test_authenticated_user_can_get_own_data | /me endpoint működése tokennel |
| 8 | test_me_endpoint_fails_without_token | /me endpoint 401 token nélkül |
| 9 | test_user_can_logout_successfully | Sikeres logout, token törlése |
| 10 | test_logout_fails_without_token | Logout 401 token nélkül |

**Példa teszt kód:**
```php
public function test_user_can_login_successfully(): void
{
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'user' => ['id', 'name', 'email'],
            'access_token',
            'token_type',
        ])
        ->assertJson([
            'message' => 'Login successful',
            'token_type' => 'Bearer',
        ]);
}
```

---

### TeamControllerTest.php (11 teszt)

**Mit tesztel:** Csapat CRUD műveletek

| # | Teszt neve | Mit ellenőriz |
|---|------------|---------------|
| 1 | test_authenticated_user_can_get_teams_list | Teams lista lekérés tokennel |
| 2 | test_teams_list_fails_without_authentication | Teams lista 401 token nélkül |
| 3 | test_authenticated_user_can_create_team | Új csapat létrehozása |
| 4 | test_create_team_fails_with_missing_fields | Validációs hibák csapatnál |
| 5 | test_authenticated_user_can_get_single_team | Egy csapat lekérése |
| 6 | test_get_single_team_fails_with_nonexistent_id | 404 rossz ID-nál |
| 7 | test_authenticated_user_can_update_team_with_put | PUT teljes frissítés |
| 8 | test_authenticated_user_can_update_team_with_patch | PATCH részleges frissítés |
| 9 | test_authenticated_user_can_delete_team | Csapat törlése |
| 10 | test_delete_team_fails_with_nonexistent_id | 404 nem létező csapatnál |
| 11 | test_all_team_operations_fail_without_authentication | Minden művelet 401 token nélkül |

**Példa teszt kód:**
```php
public function test_authenticated_user_can_create_team(): void
{
    $auth = $this->authenticatedUser();

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $auth['token'],
    ])->postJson('/api/teams', [
        'name' => 'Test Warriors',
        'sport_type' => 'football',
        'max_members' => 15,
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'message' => 'Team created successfully',
            'data' => [
                'name' => 'Test Warriors',
                'sport_type' => 'football',
                'max_members' => 15,
            ],
        ]);

    $this->assertDatabaseHas('teams', [
        'name' => 'Test Warriors',
        'sport_type' => 'football',
    ]);
}
```

---

### HealthCheckTest.php (4 teszt)

**Mit tesztel:** /ping endpoint működése

| # | Teszt neve | Mit ellenőriz |
|---|------------|---------------|
| 1 | test_ping_endpoint_returns_success | Sikeres válasz 200-zal |
| 2 | test_ping_endpoint_returns_valid_timestamp | Timestamp formátum helyes |
| 3 | test_ping_endpoint_returns_correct_timezone | Timezone Europe/Budapest |
| 4 | test_ping_endpoint_accessible_without_authentication | Elérhető token nélkül |

**Példa teszt kód:**
```php
public function test_ping_endpoint_returns_success(): void
{
    $response = $this->getJson('/api/ping');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'timestamp',
            'timezone',
        ])
        ->assertJson([
            'status' => 'success',
            'message' => 'API is running',
            'timezone' => config('app.timezone'),
        ]);
}
```

---

### Teszt lefedettség

**Feature tesztek:** Teljes API végpont lefedettség
- ✅ Minden endpoint tesztelve (11 végpont)
- ✅ Sikeres esetek (happy path)
- ✅ Hibás esetek (validáció, 404, 401)
- ✅ Authentikációs logika
- ✅ Adatbázis műveletek

**RefreshDatabase trait:** Minden teszt tiszta adatbázissal fut
```php
use RefreshDatabase;
```

**Factory használat:** Fake adatok generálása tesztekhez
```php
$user = User::factory()->create();
$team = Team::factory()->create();
```

---

## Authentikáció

### Laravel Sanctum - Bearer Token

A projekt Laravel Sanctum-ot használ API token alapú authentikációra.

### Működési elv:

```
1. User regisztrál vagy bejelentkezik
   ↓
2. API generál egy Bearer tokent
   ↓
3. Token elmentése (LocalStorage, SessionStorage, stb)
   ↓
4. Minden védett kéréshez token küldése headerben
   ↓
5. API ellenőrzi a token érvényességét
   ↓
6. Ha valid → válasz visszaküldése
   Ha invalid → 401 Unauthenticated
```

### Token struktúra:

```
{id}|{plainTextToken}

Példa: 1|abc123def456ghi789...
```

- **{id}**: Token ID az adatbázisban
- **{plainTextToken}**: Hash-elt token string (64 karakter)

### Token tárolás:

**personal_access_tokens tábla:**
```sql
INSERT INTO personal_access_tokens (
    tokenable_type,  -- 'App\Models\User'
    tokenable_id,    -- User ID
    name,            -- 'auth_token'
    token,           -- hash-elt token
    abilities,       -- JSON jogosultságok
    created_at
) VALUES (...);
```

### Token használat:

**Request Header:**
```
Authorization: Bearer 1|abc123def456ghi789...
```

**Laravel middleware:**
```php
Route::middleware('auth:sanctum')->group(function () {
    // Védett végpontok
});
```

### Token élettartam:

- **Alapértelmezett:** végtelen (amíg nem törli a user)
- **Logout:** Token törlése az adatbázisból
- **Egy usernek több tokenje lehet** (több eszköz támogatás)

### Sanctum konfiguráció:

`config/sanctum.php`:
```php
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
    '%s%s',
    'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
    Sanctum::currentApplicationUrlWithPort()
))),

'middleware' => [
    'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
    'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
],
```

---

## Használati Példák

### JavaScript (Fetch API)

#### Login és token mentés
```javascript
async function login(email, password) {
    try {
        const response = await fetch('http://localhost:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });
        
        const data = await response.json();
        
        if (response.ok) {
            // Token mentés LocalStorage-ba
            localStorage.setItem('auth_token', data.access_token);
            localStorage.setItem('user', JSON.stringify(data.user));
            
            console.log('Login sikeres!');
            return data;
        } else {
            console.error('Login hiba:', data.message);
            return null;
        }
    } catch (error) {
        console.error('Fetch hiba:', error);
        return null;
    }
}

// Használat
login('mate@example.com', 'Mate123');
```

#### Csapatok lekérése
```javascript
async function getTeams() {
    const token = localStorage.getItem('auth_token');
    
    if (!token) {
        console.error('Nincs token! Jelentkezz be!');
        return;
    }
    
    try {
        const response = await fetch('http://localhost:8000/api/teams', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (response.ok) {
            console.log('Csapatok:', data.data);
            return data.data;
        } else {
            console.error('Hiba:', data.message);
            return null;
        }
    } catch (error) {
        console.error('Fetch hiba:', error);
        return null;
    }
}

// Használat
getTeams().then(teams => {
    teams.forEach(team => {
        console.log(`${team.name} - ${team.sport_type}`);
    });
});
```

#### Új csapat létrehozás
```javascript
async function createTeam(name, sportType, maxMembers = 10) {
    const token = localStorage.getItem('auth_token');
    
    try {
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
        
        const data = await response.json();
        
        if (response.status === 201) {
            console.log('Csapat létrehozva:', data.data);
            return data.data;
        } else {
            console.error('Hiba:', data.errors);
            return null;
        }
    } catch (error) {
        console.error('Fetch hiba:', error);
        return null;
    }
}

// Használat
createTeam('Zöld Vipers', 'volleyball', 12);
```

---

### PHP (cURL)

#### Login
```php
<?php
function login($email, $password) {
    $ch = curl_init('http://localhost:8000/api/login');
    
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'email' => $email,
        'password' => $password
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        $_SESSION['auth_token'] = $data['access_token'];
        $_SESSION['user'] = $data['user'];
        return $data;
    }
    
    return null;
}

// Használat
session_start();
$result = login('mate@example.com', 'Mate123');
if ($result) {
    echo "Login sikeres! Token: " . $result['access_token'];
}
?>
```

#### Csapatok lekérése
```php
<?php
function getTeams($token) {
    $ch = curl_init('http://localhost:8000/api/teams');
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}

// Használat
$teams = getTeams($_SESSION['auth_token']);
foreach ($teams['data'] as $team) {
    echo $team['name'] . " - " . $team['sport_type'] . "\n";
}
?>
```

---

### Python (requests)

#### Login
```python
import requests

def login(email, password):
    url = 'http://localhost:8000/api/login'
    data = {
        'email': email,
        'password': password
    }
    
    response = requests.post(url, json=data)
    
    if response.status_code == 200:
        result = response.json()
        token = result['access_token']
        
        # Token mentés fájlba vagy session-be
        with open('token.txt', 'w') as f:
            f.write(token)
        
        print(f"Login sikeres! Token: {token}")
        return result
    else:
        print(f"Hiba: {response.json()}")
        return None

# Használat
login('mate@example.com', 'Mate123')
```

#### Csapatok lekérése
```python
import requests

def get_teams(token):
    url = 'http://localhost:8000/api/teams'
    headers = {
        'Authorization': f'Bearer {token}',
        'Content-Type': 'application/json'
    }
    
    response = requests.get(url, headers=headers)
    
    if response.status_code == 200:
        teams = response.json()
        return teams['data']
    else:
        print(f"Hiba: {response.json()}")
        return None

# Használat
with open('token.txt', 'r') as f:
    token = f.read()

teams = get_teams(token)
for team in teams:
    print(f"{team['name']} - {team['sport_type']}")
```

---

### PowerShell

#### Login
```powershell
function Login-API {
    param(
        [string]$Email,
        [string]$Password
    )
    
    $body = @{
        email = $Email
        password = $Password
    } | ConvertTo-Json
    
    $response = Invoke-RestMethod -Uri "http://localhost:8000/api/login" `
        -Method Post `
        -Body $body `
        -ContentType "application/json"
    
    $token = $response.access_token
    
    # Token mentés változóba
    $global:AuthToken = $token
    
    Write-Host "Login sikeres! Token: $token"
    return $response
}

# Használat
Login-API -Email "mate@example.com" -Password "Mate123"
```

#### Csapatok lekérése
```powershell
function Get-Teams {
    $headers = @{
        "Authorization" = "Bearer $global:AuthToken"
        "Content-Type" = "application/json"
    }
    
    $response = Invoke-RestMethod -Uri "http://localhost:8000/api/teams" `
        -Method Get `
        -Headers $headers
    
    return $response.data
}

# Használat
$teams = Get-Teams
$teams | ForEach-Object {
    Write-Host "$($_.name) - $($_.sport_type)"
}
```

---

## Hibaelhárítás

### Gyakori problémák és megoldások

#### 1. "SQLSTATE[HY000]: General error: 1 no such table: users"

**Probléma:** Adatbázis táblák nem léteznek

**Megoldás:**
```bash
php artisan migrate:fresh
```

---

#### 2. "Unauthenticated" (401) minden védett végpontnál

**Probléma:** Token nincs vagy hibás

**Ellenőrzés:**
- Token helyesen van beküldve? `Authorization: Bearer {token}`
- Token érvényes? Nézd meg a `personal_access_tokens` táblát
- Logout után új tokent kell szerezni

**Megoldás:**
```bash
# Új login
POST /api/login
```

---

#### 3. "Class 'Laravel\Sanctum\...' not found"

**Probléma:** Sanctum nincs telepítve

**Megoldás:**
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

---

#### 4. CORS hiba frontend-ből

**Probléma:** Cross-Origin Request Blocked

**Megoldás:**

`config/cors.php`:
```php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000'], // Frontend URL
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];
```

---

#### 5. "Too Many Attempts" (429)

**Probléma:** Rate limit túllépve

**Megoldás:** Várj 1 percet vagy módosítsd a rate limit-et

`app/Http/Kernel.php`:
```php
'api' => [
    'throttle:api', // 60 request / minute default
],
```

---

#### 6. Validációs hibák (422)

**Probléma:** Hibás input adatok

**Ellenőrizd:**
- Email formátum helyes?
- Password min 8 karakter?
- Kötelező mezők meg vannak adva?

**Példa válasz:**
```json
{
  "errors": {
    "email": ["Az email mező kötelező."]
  }
}
```

---

#### 7. "No query results for model" (404)

**Probléma:** Rossz ID-t használsz

**Megoldás:**
- Ellenőrizd hogy létezik-e az ID
- `GET /api/teams` → nézd meg a valid ID-kat

---

#### 8. Server nem indul el

**Probléma:** Port már használatban

**Megoldás:**
```bash
# Másik porton indítás
php artisan serve --port=8080

# Vagy kill-eld a 8000-es portot
netstat -ano | findstr :8000
taskkill /PID {pid} /F
```

---

### Debug mode bekapcsolás

`.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

### Log fájl megtekintése

```bash
# Windows
type storage\logs\laravel.log

# Linux/Mac
tail -f storage/logs/laravel.log
```

---

## Következő lépések

### Production deployment

1. **Environment beállítás**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

2. **Optimalizálás**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

3. **HTTPS beállítás**
```bash
# Force HTTPS
# app/Providers/AppServiceProvider.php
if ($this->app->environment('production')) {
    URL::forceScheme('https');
}
```

---

### További fejlesztési lehetőségek

- 🔐 **Email verification** - Email megerősítés regisztráció után
- 🔑 **Password reset** - Elfelejtett jelszó funkció
- 👥 **Team invitation system** - Csapatba hívás
- 📊 **Advanced filtering** - Csapatok szűrése sport típus/skill szerint
- 🖼️ **File upload** - Profilkép, csapat logó
- 📱 **Real-time notifications** - Laravel Echo + WebSockets
- 🔍 **Full-text search** - Laravel Scout
- 📈 **Statistics** - User/Team statisztikák
- 🌐 **Multi-language** - Több nyelv támogatás
- 🔒 **Rate limiting** - API használat korlátozása
- 📝 **Logging** - Részletes naplózás

---

## Verzió történet

**v1.0** - 2025-12-04
- ✅ Initial release
- ✅ User authentikáció (register, login, logout)
- ✅ Bearer Token (Sanctum)
- ✅ Teams CRUD
- ✅ 27 automated test
- ✅ Postman collection
- ✅ Magyar lokalizáció
- ✅ Seed adatok

---

## Licenc

Ez egy saját projekt, szabadon használható.

---

## Kapcsolat

**Repository:** [https://github.com/1tc-molmat/Team-Sport](https://github.com/1tc-molmat/Team-Sport)

**Készítette:** Máté  
**Email:** mate@example.com  
**Verzió:** 1.0  
**Utolsó frissítés:** 2025-12-04

---

**🎉 Köszönöm, hogy használod a Team Sport API-t!**
