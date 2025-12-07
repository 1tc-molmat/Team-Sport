# Team Sport REST API megvalósítása Laravel környezetben# Team Sport REST API megvalósítása Laravel környezetben



**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`



Az API-t olyan funkciókkal kell ellátni, amelyek lehetővé teszik annak nyilvános elérhetőségét. Ennek a backendnek a fő célja, hogy kiszolgálja a frontendet, amelyet a felhasználók csapatok létrehozására és kezelésére használnak.## Funkciók:



## Funkciók:• Authentikáció (register, login, logout, token kezelés)

• Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel

• Authentikáció (register, login, logout, token kezelés)• Csapatok létrehozása, listázása, módosítása, törlése (CRUD)

• Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel• Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal

• Csapatok létrehozása, listázása, módosítása, törlése (CRUD)• Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)

• Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal• Magyar lokalizáció (időzóna, faker adatok)

• Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)• Átfogó tesztelés (27 automated test)

• Magyar lokalizáció (időzóna, faker adatok)

### A teszteléshez:

### A teszteléshez:◦ 1 igazi user (mate@example.com / Mate123)

◦ 1 igazi user (mate@example.com / Mate123)◦ 10 fake user

◦ 10 fake user◦ 10 fake csapat

◦ 10 fake csapat◦ Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)

◦ Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)

---

Az adatbázis neve: `team_sport`

## Végpontok:

---

A `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

## Végpontok:

Érvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:

A `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

```json

Érvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:Response: 401 Unauthorized

{

```json  "message": "Unauthenticated."

Response: 401 Unauthorized}

{```

  "message": "Unauthenticated."

}### Nem védett végpontok:

```

• GET `/ping` - teszteléshez

### Nem védett végpontok:• POST `/register` - regisztrációhoz

• POST `/login` - belépéshez

• GET `/ping` - teszteléshez

• POST `/register` - regisztrációhoz### Védett végpontok (authentikáció szükséges):

• POST `/login` - belépéshez

> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:

### Védett végpontok (authentikáció szükséges):

```

> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:Authorization: "Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8"

```

```

Authorization: "Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8"• POST `/logout` - kijelentkezés

```• GET `/me` - saját profil lekérése

• GET `/teams` - csapatok listázása

• POST `/logout` - kijelentkezés• POST `/teams` - csapat létrehozása

• GET `/me` - saját profil lekérése• GET `/teams/{id}` - csapat részletei

• GET `/teams` - csapatok listázása• PUT/PATCH `/teams/{id}` - csapat frissítése

• POST `/teams` - csapat létrehozása• PATCH `/teams/{id}/partial` - csapat részleges frissítése

• GET `/teams/{id}` - csapat részletei• DELETE `/teams/{id}` - csapat törlése

• PUT/PATCH `/teams/{id}` - csapat frissítése

• PATCH `/teams/{id}/partial` - csapat részleges frissítése### Hibák:

• DELETE `/teams/{id}` - csapat törlése

• **400 Bad Request:** A kérés hibás formátumú. Ezt a hibát akkor kell visszaadni, ha a kérés hibásan van formázva, vagy ha hiányoznak a szükséges mezők.

### Hibák:• **401 Unauthorized:** A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token vagy hiányzik.

• **404 Not Found:** A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.

• **401 Unauthorized:** A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token.• **422 Unprocessable Entity:** Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).

• **404 Not Found:** A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.

• **422 Unprocessable Entity:** Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).---



---### 4. Adatbázis beállítás



## ÖsszefoglalvaA `.env` fájlban:

```env

| Metódus | Végpont | Hozzáférés | Státusz kódok | Leírás |APP_NAME="Team Sport API"

|---------|---------|------------|---------------|--------|APP_ENV=local

| GET | /ping | Nyilvános | 200 OK | API teszteléshez |APP_DEBUG=true

| POST | /register | Nyilvános | 201 Created, 422 Unprocessable Entity | Új felhasználó regisztrációja |APP_TIMEZONE=Europe/Budapest

| POST | /login | Nyilvános | 200 OK, 422 Unprocessable Entity | Bejelentkezés e-maillel és jelszóval |APP_LOCALE=hu

| POST | /logout | Hitelesített | 200 OK, 401 Unauthorized | Kijelentkezés |APP_FAKER_LOCALE=hu_HU

| GET | /me | Hitelesített | 200 OK, 401 Unauthorized | Saját profil lekérése |

| GET | /teams | Hitelesített | 200 OK, 401 Unauthorized | Csapatok listázása |DB_CONNECTION=sqlite

| GET | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Egy csapat részletei |# DB_DATABASE=/absolute/path/to/database.sqlite

| POST | /teams | Hitelesített | 201 Created, 422 Unprocessable Entity, 401 Unauthorized | Csapat létrehozása |```

| PUT/PATCH | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat frissítése |

| PATCH | /teams/{id}/partial | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat részleges frissítése |### 5. Adatbázis migrálás és seed

| DELETE | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Csapat törlése |```bash

# Adatbázis táblák létrehozása

---php artisan migrate



## Adatbázis terv# Fake adatok feltöltése (11 user + 10 csapat)

php artisan db:seed

``````

┌──────────────────────┐     ┌─────────────────┐       ┌──────────────┐        ┌──────────┐

│personal_access_tokens│     │      users      │       │team_members  │        │  teams   │### 6. Szerver indítás

├──────────────────────┤     ├─────────────────┤       ├──────────────┤        ├──────────┤```bash

│ id (PK)              │  ┌─→│ id (PK)         │1─┐    │ id (PK)      │     ┌─→│ id (PK)  │php artisan serve

│ tokenable_id (FK)    │──┘  │ name            │  └───N│ user_id (FK) │     │  │ name     │```

│ tokenable_type       │     │ email (unique)  │       │ team_id (FK) │N────┘  │ sport_   │

│ name                 │     │ password        │       │ role         │        │  type    │Az API elérhető: `http://localhost:8000/api`

│ token (unique)       │     │ sport_type      │       │ joined_at    │        │ max_mem- │

│ abilities            │     │ skill_level     │       │ created_at   │        │  bers    │---

│ last_used_at         │     │ created_at      │       │ updated_at   │        │ created_ │

│ expires_at           │     │ updated_at      │       └──────────────┘        │  at      │## Adatbázis Struktúra

│ created_at           │     └─────────────────┘                               │ updated_ │

│ updated_at           │                                                        │  at      │### Táblák áttekintése

└──────────────────────┘                                                        └──────────┘

```#### 1. `users` tábla

Felhasználók adatait tárolja.

---

| Mező | Típus | Leírás |

# I. Modul - Struktúra kialakítása|------|-------|--------|

| id | bigint (PK) | Egyedi azonosító |

## 1. Telepítés (projekt létrehozása, .env konfiguráció, sanctum telepítése, tesztútvonal)| name | varchar(255) | Felhasználó neve |

| email | varchar(255) | Email cím (egyedi) |

`célhely>composer create-project laravel/laravel --prefer-dist Team-Sport`| password | varchar(255) | Hash-elt jelszó |

| sport_type | varchar(255) | Preferált sport típus |

`célhely>cd Team-Sport`| skill_level | varchar(255) | Képzettségi szint |

| email_verified_at | timestamp | Email megerősítés ideje |

**.env fájl módosítása:**| remember_token | varchar(100) | Laravel session token |

| created_at | timestamp | Létrehozás időpontja |

```env| updated_at | timestamp | Módosítás időpontja |

DB_CONNECTION=mysql

DB_HOST=127.0.0.1**Kapcsolatok:**

DB_PORT=3306- `hasMany` → `team_members`

DB_DATABASE=team_sport- `belongsToMany` → `teams` (through team_members)

DB_USERNAME=root

DB_PASSWORD=#### 2. `teams` tábla

```Csapatok adatait tárolja.



**config/app.php módosítása:**| Mező | Típus | Leírás |

|------|-------|--------|

```php| id | bigint (PK) | Egyedi azonosító |

'timezone' => 'Europe/Budapest',| name | varchar(255) | Csapat neve |

'locale' => 'hu',| sport_type | varchar(255) | Sport típus |

'faker_locale' => 'hu_HU',| max_members | integer | Maximum tagok száma (default: 10) |

```| created_at | timestamp | Létrehozás |

| updated_at | timestamp | Módosítás |

`Team-Sport>composer require laravel/sanctum`

**Kapcsolatok:**

`Team-Sport>php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`- `hasMany` → `team_members`

- `belongsToMany` → `users` (through team_members)

`Team-Sport>php artisan install:api`

#### 3. `team_members` tábla (pivot)

**routes/api.php:**User és Team közötti kapcsolatot tárolja.



```php| Mező | Típus | Leírás |

use Illuminate\Support\Facades\Route;|------|-------|--------|

| id | bigint (PK) | Egyedi azonosító |

Route::get('/ping', function () {| user_id | bigint (FK) | User azonosító |

    return response()->json([| team_id | bigint (FK) | Csapat azonosító |

        'status' => 'success',| role | varchar(50) | Szerep (member/captain) |

        'message' => 'API is running',| joined_at | timestamp | Csatlakozás időpontja |

        'timestamp' => now()->toDateTimeString(),

        'timezone' => config('app.timezone'),**Foreign Keys:**

    ], 200);- `user_id` → `users.id` (CASCADE delete)

});- `team_id` → `teams.id` (CASCADE delete)

```

#### 4. `personal_access_tokens` tábla

### TesztSanctum Bearer tokenek tárolása.



**serve:**| Mező | Típus | Leírás |

|------|-------|--------|

`Team-Sport>php artisan serve`| id | bigint (PK) | Token azonosító |

| tokenable_type | varchar(255) | Model típus (User) |

> POSTMAN teszt: GET http://127.0.0.1:8000/api/ping| tokenable_id | bigint | User ID |

| name | varchar(255) | Token neve |

**VAGY XAMPP:**| token | varchar(64) | Hash-elt token (egyedi) |

| abilities | text | Token jogosultságok |

> POSTMAN teszt: GET http://127.0.0.1/Team-Sport/public/api/ping| last_used_at | timestamp | Utolsó használat |

| expires_at | timestamp | Lejárat |

---| created_at | timestamp | Létrehozás |

| updated_at | timestamp | Módosítás |

## 2. Modellek és migráció (sémák)

### Adatbázis Diagram

**Ami már megvan (database/migrations):**

```

Ehhez nem is kell nyúlni:┌─────────────┐         ┌──────────────────┐         ┌─────────────┐

│   users     │         │  team_members    │         │    teams    │

```php├─────────────┤         ├──────────────────┤         ├─────────────┤

Schema::create('personal_access_tokens', function (Blueprint $table) {│ id (PK)     │────┐    │ id (PK)          │    ┌────│ id (PK)     │

    $table->id();│ name        │    └───→│ user_id (FK)     │    │    │ name        │

    $table->morphs('tokenable'); // user kapcsolat│ email       │         │ team_id (FK)     │←───┘    │ sport_type  │

    $table->string('name');│ password    │         │ role             │         │ max_members │

    $table->string('token', 64)->unique();│ sport_type  │         │ joined_at        │         │ created_at  │

    $table->text('abilities')->nullable();│ skill_level │         │                  │         │ updated_at  │

    $table->timestamp('last_used_at')->nullable();│ created_at  │         └──────────────────┘         └─────────────┘

    $table->timestamp('expires_at')->nullable();│ updated_at  │

    $table->timestamps();└─────────────┘

});```

```

### Seed Adatok

**Ezt módosítani kell:**

A `php artisan db:seed` parancs fut:

```php

Schema::create('users', function (Blueprint $table) {**Users (11 db):**

    $table->id();- 1 valódi user: Máté (mate@example.com / Mate123)

    $table->string('name');- 10 faker user magyar nevekkel (jelszó: password)

    $table->string('email')->unique();

    $table->timestamp('email_verified_at')->nullable();**Teams (10 db):**

    $table->string('password');- Random generált csapatnevek (pl: "Piros Warriors", "Kék Tigrisek")

    // ezt bele kell írni- Random sport típusok (football, basketball, volleyball, stb)

    $table->string('sport_type')->nullable();

    $table->string('skill_level')->nullable();**Team Members (~38 kapcsolat):**

    // ezeket bele kell írni- Minden csapatban 2-5 tag random

    $table->rememberToken();- Máté 2 csapatban captain

    $table->timestamps();

});---

```

## API Végpontok

**app/Models/User.php (módosítani kell):**

### Base URL

```php```

namespace App\Models;http://localhost:8000/api

```

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;### Végpontok összefoglalása

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;| Metódus | Végpont | Auth | Leírás |

use Illuminate\Database\Eloquent\Relations\BelongsToMany;|---------|---------|------|--------|

use Laravel\Sanctum\HasApiTokens;| GET | /ping | Nem | API health check |

| POST | /register | Nem | Regisztráció |

class User extends Authenticatable| POST | /login | Nem | Bejelentkezés |

{| POST | /logout | Igen | Kijelentkezés |

    use HasFactory, Notifiable, HasApiTokens;| GET | /me | Igen | Saját adatok |

| GET | /teams | Igen | Csapatok listája |

    protected $fillable = [| POST | /teams | Igen | Új csapat |

        'name',| GET | /teams/{id} | Igen | Egy csapat |

        'email',| PUT | /teams/{id} | Igen | Teljes frissítés |

        'password',| PATCH | /teams/{id} | Igen | Részleges frissítés |

        'sport_type',| DELETE | /teams/{id} | Igen | Törlés |

        'skill_level',

    ];---



    // amikor a modellt JSON formátumban adod vissza ne jelenjenek meg a következő mezők:### 1. Health Check - API státusz ellenőrzés

    protected $hidden = [

        'password',**Endpoint:**

        'remember_token',```http

    ];GET /api/ping

```

    protected function casts(): array

    {**Auth:** Nem kell token

        return [

            'email_verified_at' => 'datetime',**Válasz (200):**

            'password' => 'hashed',```json

        ];{

    }  "status": "success",

  "message": "API is running",

    public function teamMembers(): HasMany  "timestamp": "2025-12-04 10:30:00",

    {  "timezone": "Europe/Budapest"

        return $this->hasMany(TeamMember::class);}

    }```



    public function teams(): BelongsToMany**Mire jó:** Gyors ellenőrzés, hogy az API működik-e.

    {

        return $this->belongsToMany(Team::class, 'team_members')---

            ->withPivot('joined_at', 'role')

            ->withTimestamps();### 2. Regisztráció - Új felhasználó létrehozása

    }

}**Endpoint:**

``````http

POST /api/register

`Team-Sport>php artisan make:model Team -m````



**database/migrations/?_create_teams_table.php (módosítani kell):****Auth:** Nem kell token



```php**Request Body:**

Schema::create('teams', function (Blueprint $table) {```json

    $table->id();{

    $table->string('name');  "name": "Kiss János",

    $table->string('sport_type');  "email": "janos@example.com",

    $table->integer('max_members')->default(10);  "password": "titkos123",

    $table->timestamps();  "password_confirmation": "titkos123",

});  "sport_type": "football",

```  "skill_level": "intermediate"

}

**app/Models/Team.php (módosítani kell):**```



```php**Kötelező mezők:**

namespace App\Models;- `name`: max 255 karakter

- `email`: érvényes email, egyedi

use Illuminate\Database\Eloquent\Factories\HasFactory;- `password`: min 8 karakter

use Illuminate\Database\Eloquent\Model;- `password_confirmation`: egyezzen a password-del

use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;**Opcionális:**

- `sport_type`: sport típus

class Team extends Model- `skill_level`: képzettség (beginner/intermediate/advanced/professional)

{

    use HasFactory;**Sikeres válasz (201):**

    ```json

    protected $fillable = [{

        'name',  "message": "Registration successful",

        'sport_type',  "user": {

        'max_members',    "id": 12,

    ];    "name": "Kiss János",

    "email": "janos@example.com",

    public function teamMembers(): HasMany    "sport_type": "football",

    {    "skill_level": "intermediate",

        return $this->hasMany(TeamMember::class);    "created_at": "2025-12-04 10:30:00",

    }    "updated_at": "2025-12-04 10:30:00"

  },

    public function users(): BelongsToMany  "access_token": "12|abc123def456...",

    {  "token_type": "Bearer"

        return $this->belongsToMany(User::class, 'team_members')}

            ->withPivot('joined_at', 'role')```

            ->withTimestamps();

    }**Validációs hiba (422):**

}```json

```{

  "message": "validation.required (and 2 more errors)",

`Team-Sport>php artisan make:model TeamMember -m`  "errors": {

    "email": ["Az email mező kötelező."],

**database/migrations/?_create_team_members_table.php (módosítani kell):**    "password": ["A jelszó mező kötelező."]

  }

```php}

Schema::create('team_members', function (Blueprint $table) {```

    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');---

    // a user_id mező a users tábla id oszlopára fog hivatkozni

    $table->foreignId('team_id')->constrained()->onDelete('cascade');### 3. Bejelentkezés - Token megszerzése

    $table->timestamp('joined_at')->useCurrent();

    $table->string('role')->default('member'); // captain, member, vice-captain**Endpoint:**

    $table->timestamps();```http

});POST /api/login

``````



**app/Models/TeamMember.php (módosítani kell):****Auth:** Nem kell token



```php**Request Body:**

namespace App\Models;```json

{

use Illuminate\Database\Eloquent\Model;  "email": "mate@example.com",

use Illuminate\Database\Eloquent\Relations\BelongsTo;  "password": "Mate123"

}

class TeamMember extends Model```

{

    protected $fillable = [**Sikeres válasz (200):**

        'user_id',```json

        'team_id',{

        'joined_at',  "message": "Login successful",

        'role',  "user": {

    ];    "id": 1,

    "name": "Máté",

    protected $casts = [    "email": "mate@example.com",

        'joined_at' => 'datetime',    "sport_type": "football",

    ];    "skill_level": "advanced",

    "created_at": "2025-12-01 12:00:00",

    public function user(): BelongsTo    "updated_at": "2025-12-01 12:00:00"

    {  },

        return $this->belongsTo(User::class);  "access_token": "1|xyz789abc...",

    }  "token_type": "Bearer"

}

    public function team(): BelongsTo```

    {

        return $this->belongsTo(Team::class);**Hibás bejelentkezés (422):**

    }```json

}{

```  "message": "validation.email",

  "errors": {

`Team-Sport>php artisan migrate`    "email": ["A megadott bejelentkezési adatok helytelenek."]

  }

---}

```

## 3. Seeding (Factory és seederek)

---

**database/factories/UserFactory.php (módosítása):**

### 4. Kijelentkezés - Token törlése

```php

namespace Database\Factories;**Endpoint:**

```http

use Illuminate\Database\Eloquent\Factories\Factory;POST /api/logout

use Illuminate\Support\Facades\Hash;```

use App\Models\User;

**Auth:** Bearer Token szükséges

class UserFactory extends Factory

{**Headers:**

    protected $model = User::class;```

Authorization: Bearer {token}

    public function definition()```

    {

        $this->faker = \Faker\Factory::create('hu_HU'); // magyar nevekhez**Válasz (200):**

```json

        return [{

            'name' => $this->faker->firstName . ' ' . $this->faker->lastName, // magyaros teljes név  "message": "Logout successful"

            'email' => $this->faker->unique()->safeEmail(),}

            'password' => Hash::make('password'), // minden user jelszava: password```

            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),

            'skill_level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),**Token nélkül (401):**

        ];```json

    }{

}  "message": "Unauthenticated."

```}

```

`Team-Sport>php artisan make:factory TeamFactory`

---

**database/factories/TeamFactory.php (módosítása):**

### 5. Saját adatok - Bejelentkezett user

```php

namespace Database\Factories;**Endpoint:**

```http

use Illuminate\Database\Eloquent\Factories\Factory;GET /api/me

use App\Models\Team;```



class TeamFactory extends Factory**Auth:** Bearer Token szükséges

{

    protected $model = Team::class;**Válasz (200):**

```json

    public function definition(): array{

    {  "user": {

        $this->faker = \Faker\Factory::create('hu_HU');    "id": 1,

            "name": "Máté",

        $colors = ['Piros', 'Kék', 'Zöld', 'Sárga', 'Fekete', 'Fehér'];    "email": "mate@example.com",

        $animals = ['Tigrisek', 'Warriors', 'Dragons', 'Eagles', 'Lions', 'Sharks'];    "sport_type": "football",

            "skill_level": "advanced",

        return [    "email_verified_at": null,

            'name' => $this->faker->randomElement($colors) . ' ' . $this->faker->randomElement($animals),    "created_at": "2025-12-01 12:00:00",

            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),    "updated_at": "2025-12-01 12:00:00"

            'max_members' => $this->faker->numberBetween(8, 20),  }

        ];}

    }```

}

```---



`Team-Sport>php artisan make:seeder TeamSeeder`### 6. Csapatok listája - Összes csapat lekérése



**database/seeders/TeamSeeder.php (módosítása):****Endpoint:**

```http

```phpGET /api/teams

namespace Database\Seeders;```



use Illuminate\Database\Console\Seeds\WithoutModelEvents;**Auth:** Bearer Token szükséges

use Illuminate\Database\Seeder;

use App\Models\Team;**Query paraméterek (opcionális):**

use App\Models\User;- `page`: oldalszám (default: 1)

use Illuminate\Support\Facades\Hash;

**Válasz (200):**

class TeamSeeder extends Seeder```json

{{

    public function run(): void  "data": [

    {    {

        // 1. Igazi user létrehozása: mate / Mate123      "id": 1,

        $mate = User::create([      "name": "Piros Warriors",

            'name' => 'Máté',      "sport_type": "football",

            'email' => 'mate@example.com',      "max_members": 10,

            'password' => Hash::make('Mate123'),      "members_count": 3,

            'sport_type' => 'football',      "members": [

            'skill_level' => 'expert',        {

        ]);          "id": 1,

          "name": "Máté",

        // 2. 10 fake user létrehozása Factory-val          "email": "mate@example.com",

        $fakeUsers = User::factory()->count(10)->create();          "sport_type": "football",

          "skill_level": "advanced",

        // 3. Összes user (mate + 10 fake = 11 user)          "joined_at": "2025-12-01 14:30:00",

        $allUsers = collect([$mate])->merge($fakeUsers);          "role": "captain"

        }

        // 4. 10 fake team létrehozása Factory-val      ],

        $teams = Team::factory()->count(10)->create();      "created_at": "2025-12-01 14:00:00",

      "updated_at": "2025-12-01 14:00:00"

        // 5. Random kapcsolatok létrehozása users és teams között    }

        $roles = ['captain', 'member', 'vice-captain'];  ],

          "links": {

        $teams->each(function ($team) use ($allUsers, $roles) {    "first": "http://localhost:8000/api/teams?page=1",

            // Minden csapathoz random 2-5 tag    "last": "http://localhost:8000/api/teams?page=1",

            $membersCount = rand(2, 5);    "prev": null,

            $selectedUsers = $allUsers->random(min($membersCount, $allUsers->count()));    "next": null

              },

            $selectedUsers->each(function ($user, $index) use ($team, $roles) {  "meta": {

                $team->users()->attach($user->id, [    "current_page": 1,

                    'role' => $index === 0 ? 'captain' : fake()->randomElement($roles),    "last_page": 1,

                    'joined_at' => now()->subDays(rand(1, 365)),    "per_page": 15,

                ]);    "total": 10

            });  }

        });}

```

        // 6. Mate-t berakjuk legalább 2 csapatba captain-ként

        $mateTeams = $teams->random(2);**Paginálás:** 15 csapat/oldal

        foreach ($mateTeams as $team) {

            if (!$team->users->contains($mate->id)) {---

                $team->users()->attach($mate->id, [

                    'role' => 'captain',### 7. Egy csapat lekérése - Részletes adatok

                    'joined_at' => now()->subDays(rand(30, 90)),

                ]);**Endpoint:**

            }```http

        }GET /api/teams/{id}

```

        $this->command->info('✅ Seeding befejezve: 1 igazi user (mate) + 10 fake user + 10 fake team + kapcsolatok!');

    }**Auth:** Bearer Token szükséges

}

```**URL paraméter:**

- `{id}`: csapat ID (integer)

**database/seeders/DatabaseSeeder.php (módosítása):**

**Válasz (200):**

```php```json

namespace Database\Seeders;{

  "data": {

use Illuminate\Database\Console\Seeds\WithoutModelEvents;    "id": 1,

use Illuminate\Database\Seeder;    "name": "Piros Warriors",

    "sport_type": "football",

class DatabaseSeeder extends Seeder    "max_members": 10,

{    "members_count": 3,

    use WithoutModelEvents;    "members": [

      {

    public function run(): void        "id": 1,

    {        "name": "Máté",

        $this->call([        "email": "mate@example.com",

            TeamSeeder::class,        "sport_type": "football",

        ]);        "skill_level": "advanced",

    }        "joined_at": "2025-12-01 14:30:00",

}        "role": "captain"

```      }

    ],

`Team-Sport>php artisan db:seed`    "created_at": "2025-12-01 14:00:00",

    "updated_at": "2025-12-01 14:00:00"

---  }

}

# II. Modul - Controller-ek és endpoint-ok```



`Team-Sport>php artisan make:controller Api/AuthController`**Nem létezik (404):**

```json

**app/Http/Controllers/Api/AuthController.php szerkesztése:**{

  "message": "No query results for model [App\\Models\\Team] 999"

```php}

namespace App\Http\Controllers\Api;```



use App\Http\Controllers\Controller;---

use App\Models\User;

use Illuminate\Http\Request;### 8. Új csapat létrehozása

use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;**Endpoint:**

```http

class AuthController extends ControllerPOST /api/teams

{```

    /**

     * Register a new user**Auth:** Bearer Token szükséges

     */

    public function register(Request $request)**Request Body:**

    {```json

        $request->validate([{

            'name' => 'required|string|max:255',  "name": "Kék Tigrisek",

            'email' => 'required|string|email|max:255|unique:users',  "sport_type": "basketball",

            'password' => 'required|string|min:8|confirmed',  "max_members": 12

            'sport_type' => 'nullable|string|max:255',}

            'skill_level' => 'nullable|string|max:255',```

        ]);

**Kötelező mezők:**

        $user = User::create([- `name`: csapat neve (max 255)

            'name' => $request->name,- `sport_type`: sport típus (max 255)

            'email' => $request->email,

            'password' => Hash::make($request->password),**Opcionális:**

            'sport_type' => $request->sport_type,- `max_members`: 1-100 között (default: 10)

            'skill_level' => $request->skill_level,

        ]);**Sikeres válasz (201):**

```json

        $token = $user->createToken('auth_token')->plainTextToken;{

  "message": "Team created successfully",

        return response()->json([  "data": {

            'message' => 'Registration successful',    "id": 11,

            'user' => [    "name": "Kék Tigrisek",

                'id' => $user->id,    "sport_type": "basketball",

                'name' => $user->name,    "max_members": 12,

                'email' => $user->email,    "members_count": 0,

                'sport_type' => $user->sport_type,    "members": [],

                'skill_level' => $user->skill_level,    "created_at": "2025-12-04 11:00:00",

            ],    "updated_at": "2025-12-04 11:00:00"

            'access_token' => $token,  }

            'token_type' => 'Bearer',}

        ], 201);```

    }

---

    /**

     * Login user### 9. Csapat frissítése (PUT) - Teljes frissítés

     */

    public function login(Request $request)**Endpoint:**

    {```http

        $request->validate([PUT /api/teams/{id}

            'email' => 'required|email',```

            'password' => 'required',

        ]);**Auth:** Bearer Token szükséges



        $user = User::where('email', $request->email)->first();**Request Body (minden mező kötelező PUT-nál):**

```json

        if (!$user || !Hash::check($request->password, $user->password)) {{

            throw ValidationException::withMessages([  "name": "Új Név",

                'email' => ['The provided credentials are incorrect.'],  "sport_type": "volleyball",

            ]);  "max_members": 15

        }}

```

        $token = $user->createToken('auth_token')->plainTextToken;

**Válasz (200):**

        return response()->json([```json

            'message' => 'Login successful',{

            'user' => [  "message": "Team updated successfully",

                'id' => $user->id,  "data": {

                'name' => $user->name,    "id": 1,

                'email' => $user->email,    "name": "Új Név",

                'sport_type' => $user->sport_type,    "sport_type": "volleyball",

                'skill_level' => $user->skill_level,    "max_members": 15,

            ],    "members_count": 3,

            'access_token' => $token,    "members": [...],

            'token_type' => 'Bearer',    "created_at": "2025-12-01 14:00:00",

        ]);    "updated_at": "2025-12-04 11:30:00"

    }  }

}

    /**```

     * Logout user (revoke token)

     */---

    public function logout(Request $request)

    {### 10. Csapat részleges frissítése (PATCH)

        $request->user()->currentAccessToken()->delete();

**Endpoint:**

        return response()->json([```http

            'message' => 'Logout successful',PATCH /api/teams/{id}

        ]);```

    }

**Auth:** Bearer Token szükséges

    /**

     * Get authenticated user**Request Body (bármelyik mező opcionális):**

     */```json

    public function me(Request $request){

    {  "name": "Módosított Név"

        return response()->json([}

            'user' => $request->user(),```

        ]);

    }**Válasz (200):**

}```json

```{

  "message": "Team updated successfully",

`Team-Sport>php artisan make:controller Api/TeamController`  "data": {

    "id": 1,

**app/Http/Controllers/Api/TeamController.php szerkesztése:**    "name": "Módosított Név",

    "sport_type": "volleyball",

```php    "max_members": 15,

namespace App\Http\Controllers\Api;    "members_count": 3,

    "members": [...],

use App\Http\Controllers\Controller;    "created_at": "2025-12-01 14:00:00",

use App\Models\Team;    "updated_at": "2025-12-04 11:45:00"

use Illuminate\Http\Request;  }

use Illuminate\Support\Facades\Auth;}

```

class TeamController extends Controller

{**PUT vs PATCH:**

    /**- **PUT**: minden mezőt küldeni kell

     * Display a listing of all teams.- **PATCH**: csak amit módosítani akarsz

     */

    public function index()---

    {

        $teams = Team::with('users')->paginate(15);### 11. Csapat törlése



        return \App\Http\Resources\TeamResource::collection($teams);**Endpoint:**

    }```http

DELETE /api/teams/{id}

    /**```

     * Store a newly created team.

     */**Auth:** Bearer Token szükséges

    public function store(Request $request)

    {**Válasz (200):**

        $validated = $request->validate([```json

            'name' => 'required|string|max:255',{

            'sport_type' => 'required|string|max:255',  "message": "Team deleted successfully"

            'max_members' => 'nullable|integer|min:1|max:100',}

        ]);```



        $team = Team::create([**Mit töröl:**

            'name' => $validated['name'],- A csapat rekordot

            'sport_type' => $validated['sport_type'],- Az összes team_members kapcsolatot (CASCADE)

            'max_members' => $validated['max_members'] ?? 10,

        ]);---



        return response()->json([## Postman Collection

            'message' => 'Team created successfully',

            'data' => $team->load('users'),Készítettem egy kész Postman collection-t, amit azonnal használhatsz!

        ], 201);

    }### Fájl neve:

`TeamSport_API_READY.postman_collection.json`

    /**

     * Display the specified team.### Hogyan használd:

     */

    public function show(Team $team)1. **Import a Postmanbe**

    {   - Nyisd meg Postmant

        return new \App\Http\Resources\TeamResource($team->load('users'));   - File → Import

    }   - Válaszd ki a `TeamSport_API_READY.postman_collection.json` fájlt



    /**2. **Első lépés: Login**

     * Update the specified team (PUT or PATCH).   - Futtasd a "1. Login (Máté) - START HERE!" kérést

     */   - A token automatikusan el van mentve (test script)

    public function update(Request $request, Team $team)

    {3. **További végpontok használata**

        // PATCH részleges frissítés támogatása   - Használd bármelyik Teams végpontot

        $validated = $request->validate([   - A token automatikusan bekerül a headerbe

            'name' => 'sometimes|string|max:255',

            'sport_type' => 'sometimes|string|max:255',### Collection tartalma:

            'max_members' => 'sometimes|integer|min:1|max:100',

        ]);![Postman Collection](./Névtelen.png)



        $team->update($validated);A collection 11 kérést tartalmaz:

- Health Check (Ping)

        return response()->json([- Register (Random user generálás)

            'message' => 'Team updated successfully',- Login (Máté bejelentkezés)

            'data' => $team->load('users'),- Get Me (Saját adatok)

        ]);- Logout

    }- Get All Teams (Lista)

- Get Single Team

    /**- Create Team

     * Partially update the specified team (PATCH - partial update).- Update Team (PUT)

     */- Partial Update (PATCH)

    public function partialUpdate(Request $request, Team $team)- Delete Team

    {

        $validated = $request->validate([### Beépített funkciók:

            'name' => 'sometimes|string|max:255',

            'sport_type' => 'sometimes|string|max:255',**Automatikus token mentés:**

            'max_members' => 'sometimes|integer|min:1|max:100',```javascript

        ]);// Test script minden login/register után

if (pm.response.code === 200 || pm.response.code === 201) {

        $team->update($validated);    var jsonData = pm.response.json();

    if (jsonData.access_token) {

        return response()->json([        pm.environment.set("token", jsonData.access_token);

            'message' => 'Team partially updated successfully',        console.log("Token saved: " + jsonData.access_token);

            'data' => $team->load('users'),    }

        ]);}

    }```



    /****Random email generálás regisztrációnál:**

     * Remove the specified team.```json

     */{

    public function destroy(Team $team)  "email": "user{{$randomInt}}@example.com"

    {}

        $team->delete();```



        return response()->json([**Base URL változó:**

            'message' => 'Team deleted successfully',- `{{base_url}}` = `http://localhost:8000/api`

        ]);- Egyszerűen változtatható production környezetre

    }

}---

```

## Tesztelés

`Team-Sport>php artisan make:resource TeamResource`

A projekt teljes tesztelési lefedettséggel rendelkezik. **27 automated test** van implementálva.

**app/Http/Resources/TeamResource.php:**

### Tesztek futtatása

```php

namespace App\Http\Resources;```bash

php artisan test

use Illuminate\Http\Request;```

use Illuminate\Http\Resources\Json\JsonResource;

### Test eredmény:

class TeamResource extends JsonResource

{![Test Results](./test.png)

    public function toArray(Request $request): array

    {**Összesítés:**

        return [- **27 teszt passou**

            'id' => $this->id,- **124 assertion**

            'name' => $this->name,- **~1 másodperc futási idő**

            'sport_type' => $this->sport_type,- **0 failed test**

            'max_members' => $this->max_members,

            'members_count' => $this->users->count(),### Teszt fájlok struktúrája

            'members' => $this->users->map(function ($user) {

                return [```

                    'id' => $user->id,tests/

                    'name' => $user->name,├── Feature/

                    'email' => $user->email,│   ├── AuthControllerTest.php       (10 teszt)

                    'sport_type' => $user->sport_type,│   ├── TeamControllerTest.php       (11 teszt)

                    'skill_level' => $user->skill_level,│   ├── HealthCheckTest.php          (4 teszt)

                    'joined_at' => $user->pivot->joined_at,│   └── ExampleTest.php              (1 teszt)

                    'role' => $user->pivot->role,└── Unit/

                ];    └── ExampleTest.php               (1 teszt)

            }),```

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,---

        ];

    }### AuthControllerTest.php (10 teszt)

}

```**Mit tesztel:** Authentikációs végpontok működése



**routes/api.php frissítése:**| # | Teszt neve | Mit ellenőriz |

|---|------------|---------------|

```php| 1 | test_user_can_register_successfully | Sikeres regisztráció, token generálás |

use Illuminate\Support\Facades\Route;| 2 | test_register_fails_with_missing_fields | Hiányzó mezők validációja |

use App\Http\Controllers\Api\AuthController;| 3 | test_register_fails_with_duplicate_email | Duplikált email elutasítása |

use App\Http\Controllers\Api\TeamController;| 4 | test_user_can_login_successfully | Sikeres bejelentkezés, token visszaadás |

| 5 | test_login_fails_with_wrong_password | Hibás jelszó elutasítása |

// Health check endpoint| 6 | test_login_fails_with_nonexistent_user | Nem létező user elutasítása |

Route::get('/ping', function () {| 7 | test_authenticated_user_can_get_own_data | /me endpoint működése tokennel |

    return response()->json([| 8 | test_me_endpoint_fails_without_token | /me endpoint 401 token nélkül |

        'status' => 'success',| 9 | test_user_can_logout_successfully | Sikeres logout, token törlése |

        'message' => 'API is running',| 10 | test_logout_fails_without_token | Logout 401 token nélkül |

        'timestamp' => now()->toDateTimeString(),

        'timezone' => config('app.timezone'),**Példa teszt kód:**

    ]);```php

});public function test_user_can_login_successfully(): void

{

// Public routes (no authentication required)    $user = User::factory()->create([

Route::post('/register', [AuthController::class, 'register']);        'email' => 'test@example.com',

Route::post('/login', [AuthController::class, 'login']);        'password' => Hash::make('password123'),

    ]);

// Protected routes (authentication required with Sanctum)

Route::middleware('auth:sanctum')->group(function () {    $response = $this->postJson('/api/login', [

    // Auth routes        'email' => 'test@example.com',

    Route::post('/logout', [AuthController::class, 'logout']);        'password' => 'password123',

    Route::get('/me', [AuthController::class, 'me']);    ]);

    

    // Team CRUD routes    $response->assertStatus(200)

    Route::apiResource('teams', TeamController::class);        ->assertJsonStructure([

                'message',

    // Additional route for PATCH (partial update)            'user' => ['id', 'name', 'email'],

    Route::patch('/teams/{team}/partial', [TeamController::class, 'partialUpdate']);            'access_token',

});            'token_type',

```        ])

        ->assertJson([

---            'message' => 'Login successful',

            'token_type' => 'Bearer',

# III. Modul - Tesztelés        ]);

}

Feature teszt ideális az HTTP kérések szimulálására, mert több komponens (Controller, Middleware, Auth) együttműködését vizsgáljuk.```



`Team-Sport>php artisan make:test AuthControllerTest`---



**tests/Feature/AuthControllerTest.php:**### TeamControllerTest.php (11 teszt)



```php**Mit tesztel:** Csapat CRUD műveletek

namespace Tests\Feature;

| # | Teszt neve | Mit ellenőriz |

use Illuminate\Foundation\Testing\RefreshDatabase;|---|------------|---------------|

use Tests\TestCase;| 1 | test_authenticated_user_can_get_teams_list | Teams lista lekérés tokennel |

use App\Models\User;| 2 | test_teams_list_fails_without_authentication | Teams lista 401 token nélkül |

use Illuminate\Support\Facades\Hash;| 3 | test_authenticated_user_can_create_team | Új csapat létrehozása |

| 4 | test_create_team_fails_with_missing_fields | Validációs hibák csapatnál |

class AuthControllerTest extends TestCase| 5 | test_authenticated_user_can_get_single_team | Egy csapat lekérése |

{| 6 | test_get_single_team_fails_with_nonexistent_id | 404 rossz ID-nál |

    use RefreshDatabase;| 7 | test_authenticated_user_can_update_team_with_put | PUT teljes frissítés |

| 8 | test_authenticated_user_can_update_team_with_patch | PATCH részleges frissítés |

    public function test_user_can_register_successfully(): void| 9 | test_authenticated_user_can_delete_team | Csapat törlése |

    {| 10 | test_delete_team_fails_with_nonexistent_id | 404 nem létező csapatnál |

        $response = $this->postJson('/api/register', [| 11 | test_all_team_operations_fail_without_authentication | Minden művelet 401 token nélkül |

            'name' => 'Test User',

            'email' => 'test@example.com',**Példa teszt kód:**

            'password' => 'password123',```php

            'password_confirmation' => 'password123',public function test_authenticated_user_can_create_team(): void

            'sport_type' => 'football',{

            'skill_level' => 'intermediate',    $auth = $this->authenticatedUser();

        ]);

    $response = $this->withHeaders([

        $response->assertStatus(201)        'Authorization' => 'Bearer ' . $auth['token'],

            ->assertJsonStructure([    ])->postJson('/api/teams', [

                'message',        'name' => 'Test Warriors',

                'user' => ['id', 'name', 'email', 'sport_type', 'skill_level'],        'sport_type' => 'football',

                'access_token',        'max_members' => 15,

                'token_type',    ]);

            ]);

    $response->assertStatus(201)

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);        ->assertJson([

    }            'message' => 'Team created successfully',

            'data' => [

    public function test_register_fails_with_missing_fields(): void                'name' => 'Test Warriors',

    {                'sport_type' => 'football',

        $response = $this->postJson('/api/register', ['name' => 'Test User']);                'max_members' => 15,

        $response->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);            ],

    }        ]);



    public function test_register_fails_with_duplicate_email(): void    $this->assertDatabaseHas('teams', [

    {        'name' => 'Test Warriors',

        User::factory()->create(['email' => 'test@example.com']);        'sport_type' => 'football',

        $response = $this->postJson('/api/register', [    ]);

            'name' => 'Test User',}

            'email' => 'test@example.com',```

            'password' => 'password123',

            'password_confirmation' => 'password123',---

        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['email']);### HealthCheckTest.php (4 teszt)

    }

**Mit tesztel:** /ping endpoint működése

    public function test_user_can_login_successfully(): void

    {| # | Teszt neve | Mit ellenőriz |

        User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);|---|------------|---------------|

        $response = $this->postJson('/api/login', ['email' => 'test@example.com', 'password' => 'password123']);| 1 | test_ping_endpoint_returns_success | Sikeres válasz 200-zal |

        $response->assertStatus(200)->assertJsonStructure(['message', 'user', 'access_token', 'token_type']);| 2 | test_ping_endpoint_returns_valid_timestamp | Timestamp formátum helyes |

    }| 3 | test_ping_endpoint_returns_correct_timezone | Timezone Europe/Budapest |

| 4 | test_ping_endpoint_accessible_without_authentication | Elérhető token nélkül |

    public function test_login_fails_with_wrong_password(): void

    {**Példa teszt kód:**

        User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);```php

        $response = $this->postJson('/api/login', ['email' => 'test@example.com', 'password' => 'wrongpassword']);public function test_ping_endpoint_returns_success(): void

        $response->assertStatus(422);{

    }    $response = $this->getJson('/api/ping');



    public function test_authenticated_user_can_get_own_data(): void    $response->assertStatus(200)

    {        ->assertJsonStructure([

        $user = User::factory()->create();            'status',

        $token = $user->createToken('test_token')->plainTextToken;            'message',

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson('/api/me');            'timestamp',

        $response->assertStatus(200)->assertJsonStructure(['user']);            'timezone',

    }        ])

        ->assertJson([

    public function test_user_can_logout_successfully(): void            'status' => 'success',

    {            'message' => 'API is running',

        $user = User::factory()->create();            'timezone' => config('app.timezone'),

        $token = $user->createToken('test_token')->plainTextToken;        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson('/api/logout');}

        $response->assertStatus(200)->assertJson(['message' => 'Logout successful']);```

    }

}---

```

### Teszt lefedettség

`Team-Sport>php artisan make:test TeamControllerTest`

**Feature tesztek:** Teljes API végpont lefedettség

**tests/Feature/TeamControllerTest.php:**- Minden endpoint tesztelve (11 végpont)

- Sikeres esetek (happy path)

```php- Hibás esetek (validáció, 404, 401)

namespace Tests\Feature;- Authentikációs logika

- Adatbázis műveletek

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;**RefreshDatabase trait:** Minden teszt tiszta adatbázissal fut

use App\Models\User;```php

use App\Models\Team;use RefreshDatabase;

```

class TeamControllerTest extends TestCase

{**Factory használat:** Fake adatok generálása tesztekhez

    use RefreshDatabase;```php

$user = User::factory()->create();

    private function authenticatedUser()$team = Team::factory()->create();

    {```

        $user = User::factory()->create();

        $token = $user->createToken('test_token')->plainTextToken;---

        return ['user' => $user, 'token' => $token];

    }## Authentikáció



    public function test_authenticated_user_can_get_teams_list(): void### Laravel Sanctum - Bearer Token

    {

        $auth = $this->authenticatedUser();A projekt Laravel Sanctum-ot használ API token alapú authentikációra.

        Team::factory()->count(3)->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])->getJson('/api/teams');### Működési elv:

        $response->assertStatus(200);

    }```

1. User regisztrál vagy bejelentkezik

    public function test_teams_list_fails_without_authentication(): void   ↓

    {2. API generál egy Bearer tokent

        $response = $this->getJson('/api/teams');   ↓

        $response->assertStatus(401);3. Token elmentése (LocalStorage, SessionStorage, stb)

    }   ↓

4. Minden védett kéréshez token küldése headerben

    public function test_authenticated_user_can_create_team(): void   ↓

    {5. API ellenőrzi a token érvényességét

        $auth = $this->authenticatedUser();   ↓

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])6. Ha valid → válasz visszaküldése

            ->postJson('/api/teams', ['name' => 'Test Warriors', 'sport_type' => 'football', 'max_members' => 15]);   Ha invalid → 401 Unauthenticated

        $response->assertStatus(201)->assertJson(['message' => 'Team created successfully']);```

        $this->assertDatabaseHas('teams', ['name' => 'Test Warriors']);

    }### Token struktúra:



    public function test_authenticated_user_can_delete_team(): void```

    {{id}|{plainTextToken}

        $auth = $this->authenticatedUser();

        $team = Team::factory()->create();Példa: 1|abc123def456ghi789...

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])->deleteJson("/api/teams/{$team->id}");```

        $response->assertStatus(200)->assertJson(['message' => 'Team deleted successfully']);

        $this->assertDatabaseMissing('teams', ['id' => $team->id]);- **{id}**: Token ID az adatbázisban

    }- **{plainTextToken}**: Hash-elt token string (64 karakter)

}

```### Token tárolás:



`Team-Sport>php artisan test`**personal_access_tokens tábla:**

```sql

---INSERT INTO personal_access_tokens (

    tokenable_type,  -- 'App\Models\User'

## Dokumentálás    tokenable_id,    -- User ID

    name,            -- 'auth_token'

• Markdown dokumentáció: projektleírás/fejlesztői dokumentáció    token,           -- hash-elt token

• POSTMAN collection: kész API tesztek    abilities,       -- JSON jogosultságok

    created_at

---) VALUES (...);

```

**Repository:** https://github.com/1tc-molmat/Team-Sport

### Token használat:

**Készítette:** Máté  

**Verzió:** 1.0  **Request Header:**

**Utolsó frissítés:** 2025-12-07```

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

- **Email verification** - Email megerősítés regisztráció után
- **Password reset** - Elfelejtett jelszó funkció
- **Team invitation system** - Csapatba hívás
- **Advanced filtering** - Csapatok szűrése sport típus/skill szerint
- **File upload** - Profilkép, csapat logó
- **Real-time notifications** - Laravel Echo + WebSockets
- **Full-text search** - Laravel Scout
- **Statistics** - User/Team statisztikák
- **Multi-language** - Több nyelv támogatás
- **Rate limiting** - API használat korlátozása
- **Logging** - Részletes naplózás

---

## Verzió történet

**v1.0** - 2025-12-04
- Initial release
- User authentikáció (register, login, logout)
- Bearer Token (Sanctum)
- Teams CRUD
- 27 automated test
- Postman collection
- Magyar lokalizáció
- Seed adatok

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

**Köszönöm, hogy használod a Team Sport API-t!**
