# Team Sport REST API megvalósítása Laravel környezetben# Team Sport REST API megvalósítása Laravel környezetben# Team Sport REST API megvalósítása Laravel környezetben



**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`



Az API-t olyan funkciókkal kell ellátni, amelyek lehetővé teszik annak nyilvános elérhetőségét. Ennek a backendnek a fő célja, hogy kiszolgálja a frontendet, amelyet a felhasználók csapatok létrehozására és kezelésére használnak.**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`



## Funkciók



- Authentikáció (register, login, logout, token kezelés)Az API-t olyan funkciókkal kell ellátni, amelyek lehetővé teszik annak nyilvános elérhetőségét. Ennek a backendnek a fő célja, hogy kiszolgálja a frontendet, amelyet a felhasználók csapatok létrehozására és kezelésére használnak.## Funkciók:

- Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel

- Csapatok létrehozása, listázása, módosítása, törlése (CRUD)

- Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal

- Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)## Funkciók:• Authentikáció (register, login, logout, token kezelés)

- Magyar lokalizáció (időzóna, faker adatok)

• Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel

### A teszteléshez

- 1 igazi user (mate@example.com / Mate123)• Authentikáció (register, login, logout, token kezelés)• Csapatok létrehozása, listázása, módosítása, törlése (CRUD)

- 10 fake user

- 10 fake csapat• Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel• Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal

- Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)

• Csapatok létrehozása, listázása, módosítása, törlése (CRUD)• Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)

Az adatbázis neve: `team_sport`

• Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal• Magyar lokalizáció (időzóna, faker adatok)

---

• Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)• Átfogó tesztelés (27 automated test)

## Végpontok

• Magyar lokalizáció (időzóna, faker adatok)

A `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

### A teszteléshez:

Érvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:

### A teszteléshez:◦ 1 igazi user (mate@example.com / Mate123)

```json

Response: 401 Unauthorized◦ 1 igazi user (mate@example.com / Mate123)◦ 10 fake user

{

  "message": "Unauthenticated."◦ 10 fake user◦ 10 fake csapat

}

```◦ 10 fake csapat◦ Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)



### Nem védett végpontok◦ Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)



- GET `/ping` - teszteléshez---

- POST `/register` - regisztrációhoz

- POST `/login` - belépéshezAz adatbázis neve: `team_sport`



### Védett végpontok (authentikáció szükséges)## Végpontok:



> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:---



```httpA `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

Authorization: Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8

```## Végpontok:



- POST `/logout` - kijelentkezésÉrvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:

- GET `/me` - saját profil lekérése

- GET `/teams` - csapatok listázásaA `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

- POST `/teams` - csapat létrehozása

- GET `/teams/{id}` - csapat részletei```json

- PUT/PATCH `/teams/{id}` - csapat frissítése

- PATCH `/teams/{id}/partial` - csapat részleges frissítéseÉrvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:Response: 401 Unauthorized

- DELETE `/teams/{id}` - csapat törlése

{

### Hibák

```json  "message": "Unauthenticated."

- **401 Unauthorized** - A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token.

- **404 Not Found** - A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.Response: 401 Unauthorized}

- **422 Unprocessable Entity** - Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).

{```

---

  "message": "Unauthenticated."

## Összefoglalva

}### Nem védett végpontok:

| Metódus | Végpont | Hozzáférés | Státusz kódok | Leírás |

|---------|---------|------------|---------------|--------|```

| GET | /ping | Nyilvános | 200 OK | API teszteléshez |

| POST | /register | Nyilvános | 201 Created, 422 Unprocessable Entity | Új felhasználó regisztrációja |• GET `/ping` - teszteléshez

| POST | /login | Nyilvános | 200 OK, 422 Unprocessable Entity | Bejelentkezés e-maillel és jelszóval |

| POST | /logout | Hitelesített | 200 OK, 401 Unauthorized | Kijelentkezés |### Nem védett végpontok:• POST `/register` - regisztrációhoz

| GET | /me | Hitelesített | 200 OK, 401 Unauthorized | Saját profil lekérése |

| GET | /teams | Hitelesített | 200 OK, 401 Unauthorized | Csapatok listázása |• POST `/login` - belépéshez

| GET | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Egy csapat részletei |

| POST | /teams | Hitelesített | 201 Created, 422 Unprocessable Entity, 401 Unauthorized | Csapat létrehozása |• GET `/ping` - teszteléshez

| PUT/PATCH | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat frissítése |

| PATCH | /teams/{id}/partial | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat részleges frissítése |• POST `/register` - regisztrációhoz### Védett végpontok (authentikáció szükséges):

| DELETE | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Csapat törlése |

• POST `/login` - belépéshez

---

> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:

## Adatbázis terv

### Védett végpontok (authentikáció szükséges):

```

┌──────────────────────┐     ┌─────────────────┐       ┌──────────────┐        ┌──────────┐```

│personal_access_tokens│     │      users      │       │team_members  │        │  teams   │

├──────────────────────┤     ├─────────────────┤       ├──────────────┤        ├──────────┤> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:Authorization: "Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8"

│ id (PK)              │  ┌─→│ id (PK)         │1─┐    │ id (PK)      │     ┌─→│ id (PK)  │

│ tokenable_id (FK)    │──┘  │ name            │  └───N│ user_id (FK) │     │  │ name     │```

│ tokenable_type       │     │ email (unique)  │       │ team_id (FK) │N────┘  │ sport_   │

│ name                 │     │ password        │       │ role         │        │  type    │```

│ token (unique)       │     │ sport_type      │       │ joined_at    │        │ max_mem- │

│ abilities            │     │ skill_level     │       │ created_at   │        │  bers    │Authorization: "Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8"• POST `/logout` - kijelentkezés

│ last_used_at         │     │ created_at      │       │ updated_at   │        │ created_ │

│ expires_at           │     │ updated_at      │       └──────────────┘        │  at      │```• GET `/me` - saját profil lekérése

│ created_at           │     └─────────────────┘                               │ updated_ │

│ updated_at           │                                                        │  at      │• GET `/teams` - csapatok listázása

└──────────────────────┘                                                        └──────────┘

```• POST `/logout` - kijelentkezés• POST `/teams` - csapat létrehozása



---• GET `/me` - saját profil lekérése• GET `/teams/{id}` - csapat részletei



# I. Modul - Struktúra kialakítása• GET `/teams` - csapatok listázása• PUT/PATCH `/teams/{id}` - csapat frissítése



## 1. Telepítés• POST `/teams` - csapat létrehozása• PATCH `/teams/{id}/partial` - csapat részleges frissítése



Projekt létrehozása, .env konfiguráció, sanctum telepítése, tesztútvonal• GET `/teams/{id}` - csapat részletei• DELETE `/teams/{id}` - csapat törlése



```bash• PUT/PATCH `/teams/{id}` - csapat frissítése

célhely> composer create-project laravel/laravel --prefer-dist Team-Sport

célhely> cd Team-Sport• PATCH `/teams/{id}/partial` - csapat részleges frissítése### Hibák:

```

• DELETE `/teams/{id}` - csapat törlése

### .env fájl módosítása

• **400 Bad Request:** A kérés hibás formátumú. Ezt a hibát akkor kell visszaadni, ha a kérés hibásan van formázva, vagy ha hiányoznak a szükséges mezők.

```env

DB_CONNECTION=mysql### Hibák:• **401 Unauthorized:** A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token vagy hiányzik.

DB_HOST=127.0.0.1

DB_PORT=3306• **404 Not Found:** A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.

DB_DATABASE=team_sport

DB_USERNAME=root• **401 Unauthorized:** A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token.• **422 Unprocessable Entity:** Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).

DB_PASSWORD=

```• **404 Not Found:** A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.



### config/app.php módosítása• **422 Unprocessable Entity:** Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).---



```php

'timezone' => 'Europe/Budapest',

'locale' => 'hu',---### 4. Adatbázis beállítás

'faker_locale' => 'hu_HU',

```



### Laravel Sanctum telepítése## ÖsszefoglalvaA `.env` fájlban:



```bash```env

Team-Sport> composer require laravel/sanctum

Team-Sport> php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"| Metódus | Végpont | Hozzáférés | Státusz kódok | Leírás |APP_NAME="Team Sport API"

Team-Sport> php artisan install:api

```|---------|---------|------------|---------------|--------|APP_ENV=local



### routes/api.php| GET | /ping | Nyilvános | 200 OK | API teszteléshez |APP_DEBUG=true



```php| POST | /register | Nyilvános | 201 Created, 422 Unprocessable Entity | Új felhasználó regisztrációja |APP_TIMEZONE=Europe/Budapest

use Illuminate\Support\Facades\Route;

| POST | /login | Nyilvános | 200 OK, 422 Unprocessable Entity | Bejelentkezés e-maillel és jelszóval |APP_LOCALE=hu

Route::get('/ping', function () {

    return response()->json([| POST | /logout | Hitelesített | 200 OK, 401 Unauthorized | Kijelentkezés |APP_FAKER_LOCALE=hu_HU

        'status' => 'success',

        'message' => 'API is running',| GET | /me | Hitelesített | 200 OK, 401 Unauthorized | Saját profil lekérése |

        'timestamp' => now()->toDateTimeString(),

        'timezone' => config('app.timezone'),| GET | /teams | Hitelesített | 200 OK, 401 Unauthorized | Csapatok listázása |DB_CONNECTION=sqlite

    ], 200);

});| GET | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Egy csapat részletei |# DB_DATABASE=/absolute/path/to/database.sqlite

```

| POST | /teams | Hitelesített | 201 Created, 422 Unprocessable Entity, 401 Unauthorized | Csapat létrehozása |```

### Teszt

| PUT/PATCH | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat frissítése |

**Szerver indítás:**

| PATCH | /teams/{id}/partial | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat részleges frissítése |### 5. Adatbázis migrálás és seed

```bash

Team-Sport> php artisan serve| DELETE | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Csapat törlése |```bash

```

# Adatbázis táblák létrehozása

**POSTMAN teszt:**

- GET `http://127.0.0.1:8000/api/ping`---php artisan migrate



**VAGY XAMPP:**

- GET `http://127.0.0.1/Team-Sport/public/api/ping`

## Adatbázis terv# Fake adatok feltöltése (11 user + 10 csapat)

---

php artisan db:seed

## 2. Modellek és migráció

``````

### Ami már megvan

┌──────────────────────┐     ┌─────────────────┐       ┌──────────────┐        ┌──────────┐

Ehhez nem is kell nyúlni

│personal_access_tokens│     │      users      │       │team_members  │        │  teams   │### 6. Szerver indítás

**database/migrations/?_create_personal_access_tokens_table.php:**

├──────────────────────┤     ├─────────────────┤       ├──────────────┤        ├──────────┤```bash

```php

Schema::create('personal_access_tokens', function (Blueprint $table) {│ id (PK)              │  ┌─→│ id (PK)         │1─┐    │ id (PK)      │     ┌─→│ id (PK)  │php artisan serve

    $table->id();

    $table->morphs('tokenable'); // user kapcsolat│ tokenable_id (FK)    │──┘  │ name            │  └───N│ user_id (FK) │     │  │ name     │```

    $table->string('name');

    $table->string('token', 64)->unique();│ tokenable_type       │     │ email (unique)  │       │ team_id (FK) │N────┘  │ sport_   │

    $table->text('abilities')->nullable();

    $table->timestamp('last_used_at')->nullable();│ name                 │     │ password        │       │ role         │        │  type    │Az API elérhető: `http://localhost:8000/api`

    $table->timestamp('expires_at')->nullable();

    $table->timestamps();│ token (unique)       │     │ sport_type      │       │ joined_at    │        │ max_mem- │

});

```│ abilities            │     │ skill_level     │       │ created_at   │        │  bers    │---



### Ezt módosítani kell│ last_used_at         │     │ created_at      │       │ updated_at   │        │ created_ │



**database/migrations/0001_01_01_000000_create_users_table.php:**│ expires_at           │     │ updated_at      │       └──────────────┘        │  at      │## Adatbázis Struktúra



```php│ created_at           │     └─────────────────┘                               │ updated_ │

Schema::create('users', function (Blueprint $table) {

    $table->id();│ updated_at           │                                                        │  at      │### Táblák áttekintése

    $table->string('name');

    $table->string('email')->unique();└──────────────────────┘                                                        └──────────┘

    $table->timestamp('email_verified_at')->nullable();

    $table->string('password');```#### 1. `users` tábla

    // ezt bele kell írni

    $table->string('sport_type')->nullable();Felhasználók adatait tárolja.

    $table->string('skill_level')->nullable();

    // ezeket bele kell írni---

    $table->rememberToken();

    $table->timestamps();| Mező | Típus | Leírás |

});

```# I. Modul - Struktúra kialakítása|------|-------|--------|



### app/Models/User.php (módosítani kell)| id | bigint (PK) | Egyedi azonosító |



```php## 1. Telepítés (projekt létrehozása, .env konfiguráció, sanctum telepítése, tesztútvonal)| name | varchar(255) | Felhasználó neve |

<?php

| email | varchar(255) | Email cím (egyedi) |

namespace App\Models;

`célhely>composer create-project laravel/laravel --prefer-dist Team-Sport`| password | varchar(255) | Hash-elt jelszó |

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;| sport_type | varchar(255) | Preferált sport típus |

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;`célhely>cd Team-Sport`| skill_level | varchar(255) | Képzettségi szint |

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Laravel\Sanctum\HasApiTokens;| email_verified_at | timestamp | Email megerősítés ideje |



class User extends Authenticatable**.env fájl módosítása:**| remember_token | varchar(100) | Laravel session token |

{

    use HasFactory, Notifiable, HasApiTokens;| created_at | timestamp | Létrehozás időpontja |



    protected $fillable = [```env| updated_at | timestamp | Módosítás időpontja |

        'name',

        'email',DB_CONNECTION=mysql

        'password',

        'sport_type',DB_HOST=127.0.0.1**Kapcsolatok:**

        'skill_level',

    ];DB_PORT=3306- `hasMany` → `team_members`



    // amikor a modellt JSON formátumban adod vissza ne jelenjenek meg a következő mezők:DB_DATABASE=team_sport- `belongsToMany` → `teams` (through team_members)

    protected $hidden = [

        'password',DB_USERNAME=root

        'remember_token',

    ];DB_PASSWORD=#### 2. `teams` tábla



    protected function casts(): array```Csapatok adatait tárolja.

    {

        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',**config/app.php módosítása:**| Mező | Típus | Leírás |

        ];

    }|------|-------|--------|



    public function teamMembers(): HasMany```php| id | bigint (PK) | Egyedi azonosító |

    {

        return $this->hasMany(TeamMember::class);'timezone' => 'Europe/Budapest',| name | varchar(255) | Csapat neve |

    }

'locale' => 'hu',| sport_type | varchar(255) | Sport típus |

    public function teams(): BelongsToMany

    {'faker_locale' => 'hu_HU',| max_members | integer | Maximum tagok száma (default: 10) |

        return $this->belongsToMany(Team::class, 'team_members')

            ->withPivot('joined_at', 'role')```| created_at | timestamp | Létrehozás |

            ->withTimestamps();

    }| updated_at | timestamp | Módosítás |

}

````Team-Sport>composer require laravel/sanctum`



### Team model létrehozása**Kapcsolatok:**



```bash`Team-Sport>php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`- `hasMany` → `team_members`

Team-Sport> php artisan make:model Team -m

```- `belongsToMany` → `users` (through team_members)



**database/migrations/?_create_teams_table.php (módosítani kell):**`Team-Sport>php artisan install:api`



```php#### 3. `team_members` tábla (pivot)

<?php

**routes/api.php:**User és Team közötti kapcsolatot tárolja.

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

```php| Mező | Típus | Leírás |

return new class extends Migration

{use Illuminate\Support\Facades\Route;|------|-------|--------|

    public function up(): void

    {| id | bigint (PK) | Egyedi azonosító |

        Schema::create('teams', function (Blueprint $table) {

            $table->id();Route::get('/ping', function () {| user_id | bigint (FK) | User azonosító |

            $table->string('name');

            $table->string('sport_type');    return response()->json([| team_id | bigint (FK) | Csapat azonosító |

            $table->integer('max_members')->default(10);

            $table->timestamps();        'status' => 'success',| role | varchar(50) | Szerep (member/captain) |

        });

    }        'message' => 'API is running',| joined_at | timestamp | Csatlakozás időpontja |



    public function down(): void        'timestamp' => now()->toDateTimeString(),

    {

        Schema::dropIfExists('teams');        'timezone' => config('app.timezone'),**Foreign Keys:**

    }

};    ], 200);- `user_id` → `users.id` (CASCADE delete)

```

});- `team_id` → `teams.id` (CASCADE delete)

**app/Models/Team.php (módosítani kell):**

```

```php

<?php#### 4. `personal_access_tokens` tábla



namespace App\Models;### TesztSanctum Bearer tokenek tárolása.



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;**serve:**| Mező | Típus | Leírás |

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

|------|-------|--------|

class Team extends Model

{`Team-Sport>php artisan serve`| id | bigint (PK) | Token azonosító |

    use HasFactory;

    | tokenable_type | varchar(255) | Model típus (User) |

    protected $fillable = [

        'name',> POSTMAN teszt: GET http://127.0.0.1:8000/api/ping| tokenable_id | bigint | User ID |

        'sport_type',

        'max_members',| name | varchar(255) | Token neve |

    ];

**VAGY XAMPP:**| token | varchar(64) | Hash-elt token (egyedi) |

    public function teamMembers(): HasMany

    {| abilities | text | Token jogosultságok |

        return $this->hasMany(TeamMember::class);

    }> POSTMAN teszt: GET http://127.0.0.1/Team-Sport/public/api/ping| last_used_at | timestamp | Utolsó használat |



    public function users(): BelongsToMany| expires_at | timestamp | Lejárat |

    {

        return $this->belongsToMany(User::class, 'team_members')---| created_at | timestamp | Létrehozás |

            ->withPivot('joined_at', 'role')

            ->withTimestamps();| updated_at | timestamp | Módosítás |

    }

}## 2. Modellek és migráció (sémák)

```

### Adatbázis Diagram

### TeamMember model létrehozása

**Ami már megvan (database/migrations):**

```bash

Team-Sport> php artisan make:model TeamMember -m```

```

Ehhez nem is kell nyúlni:┌─────────────┐         ┌──────────────────┐         ┌─────────────┐

**database/migrations/?_create_team_members_table.php (módosítani kell):**

│   users     │         │  team_members    │         │    teams    │

```php

<?php```php├─────────────┤         ├──────────────────┤         ├─────────────┤



use Illuminate\Database\Migrations\Migration;Schema::create('personal_access_tokens', function (Blueprint $table) {│ id (PK)     │────┐    │ id (PK)          │    ┌────│ id (PK)     │

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;    $table->id();│ name        │    └───→│ user_id (FK)     │    │    │ name        │



return new class extends Migration    $table->morphs('tokenable'); // user kapcsolat│ email       │         │ team_id (FK)     │←───┘    │ sport_type  │

{

    public function up(): void    $table->string('name');│ password    │         │ role             │         │ max_members │

    {

        Schema::create('team_members', function (Blueprint $table) {    $table->string('token', 64)->unique();│ sport_type  │         │ joined_at        │         │ created_at  │

            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');    $table->text('abilities')->nullable();│ skill_level │         │                  │         │ updated_at  │

            // a user_id mező a users tábla id oszlopára fog hivatkozni

            $table->foreignId('team_id')->constrained()->onDelete('cascade');    $table->timestamp('last_used_at')->nullable();│ created_at  │         └──────────────────┘         └─────────────┘

            $table->timestamp('joined_at')->useCurrent();

            $table->string('role')->default('member'); // captain, member, vice-captain    $table->timestamp('expires_at')->nullable();│ updated_at  │

            $table->timestamps();

        });    $table->timestamps();└─────────────┘

    }

});```

    public function down(): void

    {```

        Schema::dropIfExists('team_members');

    }### Seed Adatok

};

```**Ezt módosítani kell:**



**app/Models/TeamMember.php (módosítani kell):**A `php artisan db:seed` parancs fut:



```php```php

<?php

Schema::create('users', function (Blueprint $table) {**Users (11 db):**

namespace App\Models;

    $table->id();- 1 valódi user: Máté (mate@example.com / Mate123)

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;    $table->string('name');- 10 faker user magyar nevekkel (jelszó: password)



class TeamMember extends Model    $table->string('email')->unique();

{

    protected $fillable = [    $table->timestamp('email_verified_at')->nullable();**Teams (10 db):**

        'user_id',

        'team_id',    $table->string('password');- Random generált csapatnevek (pl: "Piros Warriors", "Kék Tigrisek")

        'joined_at',

        'role',    // ezt bele kell írni- Random sport típusok (football, basketball, volleyball, stb)

    ];

    $table->string('sport_type')->nullable();

    protected $casts = [

        'joined_at' => 'datetime',    $table->string('skill_level')->nullable();**Team Members (~38 kapcsolat):**

    ];

    // ezeket bele kell írni- Minden csapatban 2-5 tag random

    public function user(): BelongsTo

    {    $table->rememberToken();- Máté 2 csapatban captain

        return $this->belongsTo(User::class);

    }    $table->timestamps();



    public function team(): BelongsTo});---

    {

        return $this->belongsTo(Team::class);```

    }

}## API Végpontok

```

**app/Models/User.php (módosítani kell):**

### Migráció futtatása

### Base URL

```bash

Team-Sport> php artisan migrate```php```

```

namespace App\Models;http://localhost:8000/api

---

```

## 3. Seeding

use Illuminate\Database\Eloquent\Factories\HasFactory;

Factory és seederek létrehozása

use Illuminate\Foundation\Auth\User as Authenticatable;### Végpontok összefoglalása

### database/factories/UserFactory.php (módosítása)

use Illuminate\Notifications\Notifiable;

```php

<?phpuse Illuminate\Database\Eloquent\Relations\HasMany;| Metódus | Végpont | Auth | Leírás |



namespace Database\Factories;use Illuminate\Database\Eloquent\Relations\BelongsToMany;|---------|---------|------|--------|



use Illuminate\Database\Eloquent\Factories\Factory;use Laravel\Sanctum\HasApiTokens;| GET | /ping | Nem | API health check |

use Illuminate\Support\Facades\Hash;

use App\Models\User;| POST | /register | Nem | Regisztráció |



class UserFactory extends Factoryclass User extends Authenticatable| POST | /login | Nem | Bejelentkezés |

{

    protected $model = User::class;{| POST | /logout | Igen | Kijelentkezés |



    public function definition()    use HasFactory, Notifiable, HasApiTokens;| GET | /me | Igen | Saját adatok |

    {

        $this->faker = \Faker\Factory::create('hu_HU'); // magyar nevekhez| GET | /teams | Igen | Csapatok listája |



        return [    protected $fillable = [| POST | /teams | Igen | Új csapat |

            'name' => $this->faker->firstName . ' ' . $this->faker->lastName, // magyaros teljes név

            'email' => $this->faker->unique()->safeEmail(),        'name',| GET | /teams/{id} | Igen | Egy csapat |

            'password' => Hash::make('password'), // minden user jelszava: password

            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),        'email',| PUT | /teams/{id} | Igen | Teljes frissítés |

            'skill_level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),

        ];        'password',| PATCH | /teams/{id} | Igen | Részleges frissítés |

    }

}        'sport_type',| DELETE | /teams/{id} | Igen | Törlés |

```

        'skill_level',

### TeamFactory létrehozása

    ];---

```bash

Team-Sport> php artisan make:factory TeamFactory

```

    // amikor a modellt JSON formátumban adod vissza ne jelenjenek meg a következő mezők:### 1. Health Check - API státusz ellenőrzés

**database/factories/TeamFactory.php (módosítása):**

    protected $hidden = [

```php

<?php        'password',**Endpoint:**



namespace Database\Factories;        'remember_token',```http



use Illuminate\Database\Eloquent\Factories\Factory;    ];GET /api/ping

use App\Models\Team;

```

class TeamFactory extends Factory

{    protected function casts(): array

    protected $model = Team::class;

    {**Auth:** Nem kell token

    public function definition(): array

    {        return [

        $this->faker = \Faker\Factory::create('hu_HU');

                    'email_verified_at' => 'datetime',**Válasz (200):**

        $colors = ['Piros', 'Kék', 'Zöld', 'Sárga', 'Fekete', 'Fehér'];

        $animals = ['Tigrisek', 'Warriors', 'Dragons', 'Eagles', 'Lions', 'Sharks'];            'password' => 'hashed',```json

        

        return [        ];{

            'name' => $this->faker->randomElement($colors) . ' ' . $this->faker->randomElement($animals),

            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),    }  "status": "success",

            'max_members' => $this->faker->numberBetween(8, 20),

        ];  "message": "API is running",

    }

}    public function teamMembers(): HasMany  "timestamp": "2025-12-04 10:30:00",

```

    {  "timezone": "Europe/Budapest"

### TeamSeeder létrehozása

        return $this->hasMany(TeamMember::class);}

```bash

Team-Sport> php artisan make:seeder TeamSeeder    }```

```



**database/seeders/TeamSeeder.php (módosítása):**

    public function teams(): BelongsToMany**Mire jó:** Gyors ellenőrzés, hogy az API működik-e.

```php

<?php    {



namespace Database\Seeders;        return $this->belongsToMany(Team::class, 'team_members')---



use Illuminate\Database\Console\Seeds\WithoutModelEvents;            ->withPivot('joined_at', 'role')

use Illuminate\Database\Seeder;

use App\Models\Team;            ->withTimestamps();### 2. Regisztráció - Új felhasználó létrehozása

use App\Models\User;

use Illuminate\Support\Facades\Hash;    }



class TeamSeeder extends Seeder}**Endpoint:**

{

    public function run(): void``````http

    {

        // 1. Igazi user létrehozása: mate / Mate123POST /api/register

        $mate = User::create([

            'name' => 'Máté',`Team-Sport>php artisan make:model Team -m````

            'email' => 'mate@example.com',

            'password' => Hash::make('Mate123'),

            'sport_type' => 'football',

            'skill_level' => 'expert',**database/migrations/?_create_teams_table.php (módosítani kell):****Auth:** Nem kell token

        ]);



        // 2. 10 fake user létrehozása Factory-val

        $fakeUsers = User::factory()->count(10)->create();```php**Request Body:**



        // 3. Összes user (mate + 10 fake = 11 user)Schema::create('teams', function (Blueprint $table) {```json

        $allUsers = collect([$mate])->merge($fakeUsers);

    $table->id();{

        // 4. 10 fake team létrehozása Factory-val

        $teams = Team::factory()->count(10)->create();    $table->string('name');  "name": "Kiss János",



        // 5. Random kapcsolatok létrehozása users és teams között    $table->string('sport_type');  "email": "janos@example.com",

        $roles = ['captain', 'member', 'vice-captain'];

            $table->integer('max_members')->default(10);  "password": "titkos123",

        $teams->each(function ($team) use ($allUsers, $roles) {

            // Minden csapathoz random 2-5 tag    $table->timestamps();  "password_confirmation": "titkos123",

            $membersCount = rand(2, 5);

            $selectedUsers = $allUsers->random(min($membersCount, $allUsers->count()));});  "sport_type": "football",

            

            $selectedUsers->each(function ($user, $index) use ($team, $roles) {```  "skill_level": "intermediate"

                $team->users()->attach($user->id, [

                    'role' => $index === 0 ? 'captain' : fake()->randomElement($roles),}

                    'joined_at' => now()->subDays(rand(1, 365)),

                ]);**app/Models/Team.php (módosítani kell):**```

            });

        });



        // 6. Mate-t berakjuk legalább 2 csapatba captain-ként```php**Kötelező mezők:**

        $mateTeams = $teams->random(2);

        foreach ($mateTeams as $team) {namespace App\Models;- `name`: max 255 karakter

            if (!$team->users->contains($mate->id)) {

                $team->users()->attach($mate->id, [- `email`: érvényes email, egyedi

                    'role' => 'captain',

                    'joined_at' => now()->subDays(rand(30, 90)),use Illuminate\Database\Eloquent\Factories\HasFactory;- `password`: min 8 karakter

                ]);

            }use Illuminate\Database\Eloquent\Model;- `password_confirmation`: egyezzen a password-del

        }

use Illuminate\Database\Eloquent\Relations\HasMany;

        $this->command->info('✅ Seeding befejezve: 1 igazi user (mate) + 10 fake user + 10 fake team + kapcsolatok!');

    }use Illuminate\Database\Eloquent\Relations\BelongsToMany;**Opcionális:**

}

```- `sport_type`: sport típus



### database/seeders/DatabaseSeeder.php (módosítása)class Team extends Model- `skill_level`: képzettség (beginner/intermediate/advanced/professional)



```php{

<?php

    use HasFactory;**Sikeres válasz (201):**

namespace Database\Seeders;

    ```json

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;    protected $fillable = [{



class DatabaseSeeder extends Seeder        'name',  "message": "Registration successful",

{

    use WithoutModelEvents;        'sport_type',  "user": {



    public function run(): void        'max_members',    "id": 12,

    {

        $this->call([    ];    "name": "Kiss János",

            TeamSeeder::class,

        ]);    "email": "janos@example.com",

    }

}    public function teamMembers(): HasMany    "sport_type": "football",

```

    {    "skill_level": "intermediate",

### Seeding futtatása

        return $this->hasMany(TeamMember::class);    "created_at": "2025-12-04 10:30:00",

```bash

Team-Sport> php artisan db:seed    }    "updated_at": "2025-12-04 10:30:00"

```

  },

---

    public function users(): BelongsToMany  "access_token": "12|abc123def456...",

# II. Modul - Controller-ek és endpoint-ok

    {  "token_type": "Bearer"

## AuthController létrehozása

        return $this->belongsToMany(User::class, 'team_members')}

```bash

Team-Sport> php artisan make:controller Api/AuthController            ->withPivot('joined_at', 'role')```

```

            ->withTimestamps();

### app/Http/Controllers/Api/AuthController.php

    }**Validációs hiba (422):**

```php

<?php}```json



namespace App\Http\Controllers\Api;```{



use App\Http\Controllers\Controller;  "message": "validation.required (and 2 more errors)",

use App\Models\User;

use Illuminate\Http\Request;`Team-Sport>php artisan make:model TeamMember -m`  "errors": {

use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;    "email": ["Az email mező kötelező."],



class AuthController extends Controller**database/migrations/?_create_team_members_table.php (módosítani kell):**    "password": ["A jelszó mező kötelező."]

{

    /**  }

     * Register a new user

     */```php}

    public function register(Request $request)

    {Schema::create('team_members', function (Blueprint $table) {```

        $request->validate([

            'name' => 'required|string|max:255',    $table->id();

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:8|confirmed',    $table->foreignId('user_id')->constrained()->onDelete('cascade');---

            'sport_type' => 'nullable|string|max:255',

            'skill_level' => 'nullable|string|max:255',    // a user_id mező a users tábla id oszlopára fog hivatkozni

        ]);

    $table->foreignId('team_id')->constrained()->onDelete('cascade');### 3. Bejelentkezés - Token megszerzése

        $user = User::create([

            'name' => $request->name,    $table->timestamp('joined_at')->useCurrent();

            'email' => $request->email,

            'password' => Hash::make($request->password),    $table->string('role')->default('member'); // captain, member, vice-captain**Endpoint:**

            'sport_type' => $request->sport_type,

            'skill_level' => $request->skill_level,    $table->timestamps();```http

        ]);

});POST /api/login

        $token = $user->createToken('auth_token')->plainTextToken;

``````

        return response()->json([

            'message' => 'Registration successful',

            'user' => [

                'id' => $user->id,**app/Models/TeamMember.php (módosítani kell):****Auth:** Nem kell token

                'name' => $user->name,

                'email' => $user->email,

                'sport_type' => $user->sport_type,

                'skill_level' => $user->skill_level,```php**Request Body:**

            ],

            'access_token' => $token,namespace App\Models;```json

            'token_type' => 'Bearer',

        ], 201);{

    }

use Illuminate\Database\Eloquent\Model;  "email": "mate@example.com",

    /**

     * Login useruse Illuminate\Database\Eloquent\Relations\BelongsTo;  "password": "Mate123"

     */

    public function login(Request $request)}

    {

        $request->validate([class TeamMember extends Model```

            'email' => 'required|email',

            'password' => 'required',{

        ]);

    protected $fillable = [**Sikeres válasz (200):**

        $user = User::where('email', $request->email)->first();

        'user_id',```json

        if (!$user || !Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([        'team_id',{

                'email' => ['The provided credentials are incorrect.'],

            ]);        'joined_at',  "message": "Login successful",

        }

        'role',  "user": {

        $token = $user->createToken('auth_token')->plainTextToken;

    ];    "id": 1,

        return response()->json([

            'message' => 'Login successful',    "name": "Máté",

            'user' => [

                'id' => $user->id,    protected $casts = [    "email": "mate@example.com",

                'name' => $user->name,

                'email' => $user->email,        'joined_at' => 'datetime',    "sport_type": "football",

                'sport_type' => $user->sport_type,

                'skill_level' => $user->skill_level,    ];    "skill_level": "advanced",

            ],

            'access_token' => $token,    "created_at": "2025-12-01 12:00:00",

            'token_type' => 'Bearer',

        ]);    public function user(): BelongsTo    "updated_at": "2025-12-01 12:00:00"

    }

    {  },

    /**

     * Logout user (revoke token)        return $this->belongsTo(User::class);  "access_token": "1|xyz789abc...",

     */

    public function logout(Request $request)    }  "token_type": "Bearer"

    {

        $request->user()->currentAccessToken()->delete();}



        return response()->json([    public function team(): BelongsTo```

            'message' => 'Logout successful',

        ]);    {

    }

        return $this->belongsTo(Team::class);**Hibás bejelentkezés (422):**

    /**

     * Get authenticated user    }```json

     */

    public function me(Request $request)}{

    {

        return response()->json([```  "message": "validation.email",

            'user' => $request->user(),

        ]);  "errors": {

    }

}`Team-Sport>php artisan migrate`    "email": ["A megadott bejelentkezési adatok helytelenek."]

```

  }

## TeamController létrehozása

---}

```bash

Team-Sport> php artisan make:controller Api/TeamController```

```

## 3. Seeding (Factory és seederek)

### app/Http/Controllers/Api/TeamController.php

---

```php

<?php**database/factories/UserFactory.php (módosítása):**



namespace App\Http\Controllers\Api;### 4. Kijelentkezés - Token törlése



use App\Http\Controllers\Controller;```php

use App\Models\Team;

use Illuminate\Http\Request;namespace Database\Factories;**Endpoint:**

use Illuminate\Support\Facades\Auth;

```http

class TeamController extends Controller

{use Illuminate\Database\Eloquent\Factories\Factory;POST /api/logout

    /**

     * Display a listing of all teams.use Illuminate\Support\Facades\Hash;```

     */

    public function index()use App\Models\User;

    {

        $teams = Team::with('users')->paginate(15);**Auth:** Bearer Token szükséges



        return \App\Http\Resources\TeamResource::collection($teams);class UserFactory extends Factory

    }

{**Headers:**

    /**

     * Store a newly created team.    protected $model = User::class;```

     */

    public function store(Request $request)Authorization: Bearer {token}

    {

        $validated = $request->validate([    public function definition()```

            'name' => 'required|string|max:255',

            'sport_type' => 'required|string|max:255',    {

            'max_members' => 'nullable|integer|min:1|max:100',

        ]);        $this->faker = \Faker\Factory::create('hu_HU'); // magyar nevekhez**Válasz (200):**



        $team = Team::create([```json

            'name' => $validated['name'],

            'sport_type' => $validated['sport_type'],        return [{

            'max_members' => $validated['max_members'] ?? 10,

        ]);            'name' => $this->faker->firstName . ' ' . $this->faker->lastName, // magyaros teljes név  "message": "Logout successful"



        return response()->json([            'email' => $this->faker->unique()->safeEmail(),}

            'message' => 'Team created successfully',

            'data' => $team->load('users'),            'password' => Hash::make('password'), // minden user jelszava: password```

        ], 201);

    }            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),



    /**            'skill_level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),**Token nélkül (401):**

     * Display the specified team.

     */        ];```json

    public function show(Team $team)

    {    }{

        return new \App\Http\Resources\TeamResource($team->load('users'));

    }}  "message": "Unauthenticated."



    /**```}

     * Update the specified team (PUT or PATCH).

     */```

    public function update(Request $request, Team $team)

    {`Team-Sport>php artisan make:factory TeamFactory`

        // PATCH részleges frissítés támogatása

        $validated = $request->validate([---

            'name' => 'sometimes|string|max:255',

            'sport_type' => 'sometimes|string|max:255',**database/factories/TeamFactory.php (módosítása):**

            'max_members' => 'sometimes|integer|min:1|max:100',

        ]);### 5. Saját adatok - Bejelentkezett user



        $team->update($validated);```php



        return response()->json([namespace Database\Factories;**Endpoint:**

            'message' => 'Team updated successfully',

            'data' => $team->load('users'),```http

        ]);

    }use Illuminate\Database\Eloquent\Factories\Factory;GET /api/me



    /**use App\Models\Team;```

     * Partially update the specified team (PATCH - partial update).

     */

    public function partialUpdate(Request $request, Team $team)

    {class TeamFactory extends Factory**Auth:** Bearer Token szükséges

        $validated = $request->validate([

            'name' => 'sometimes|string|max:255',{

            'sport_type' => 'sometimes|string|max:255',

            'max_members' => 'sometimes|integer|min:1|max:100',    protected $model = Team::class;**Válasz (200):**

        ]);

```json

        $team->update($validated);

    public function definition(): array{

        return response()->json([

            'message' => 'Team partially updated successfully',    {  "user": {

            'data' => $team->load('users'),

        ]);        $this->faker = \Faker\Factory::create('hu_HU');    "id": 1,

    }

            "name": "Máté",

    /**

     * Remove the specified team.        $colors = ['Piros', 'Kék', 'Zöld', 'Sárga', 'Fekete', 'Fehér'];    "email": "mate@example.com",

     */

    public function destroy(Team $team)        $animals = ['Tigrisek', 'Warriors', 'Dragons', 'Eagles', 'Lions', 'Sharks'];    "sport_type": "football",

    {

        $team->delete();            "skill_level": "advanced",



        return response()->json([        return [    "email_verified_at": null,

            'message' => 'Team deleted successfully',

        ]);            'name' => $this->faker->randomElement($colors) . ' ' . $this->faker->randomElement($animals),    "created_at": "2025-12-01 12:00:00",

    }

}            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),    "updated_at": "2025-12-01 12:00:00"

```

            'max_members' => $this->faker->numberBetween(8, 20),  }

## TeamResource létrehozása

        ];}

```bash

Team-Sport> php artisan make:resource TeamResource    }```

```

}

### app/Http/Resources/TeamResource.php

```---

```php

<?php



namespace App\Http\Resources;`Team-Sport>php artisan make:seeder TeamSeeder`### 6. Csapatok listája - Összes csapat lekérése



use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

**database/seeders/TeamSeeder.php (módosítása):****Endpoint:**

class TeamResource extends JsonResource

{```http

    public function toArray(Request $request): array

    {```phpGET /api/teams

        return [

            'id' => $this->id,namespace Database\Seeders;```

            'name' => $this->name,

            'sport_type' => $this->sport_type,

            'max_members' => $this->max_members,

            'members_count' => $this->users->count(),use Illuminate\Database\Console\Seeds\WithoutModelEvents;**Auth:** Bearer Token szükséges

            'members' => $this->users->map(function ($user) {

                return [use Illuminate\Database\Seeder;

                    'id' => $user->id,

                    'name' => $user->name,use App\Models\Team;**Query paraméterek (opcionális):**

                    'email' => $user->email,

                    'sport_type' => $user->sport_type,use App\Models\User;- `page`: oldalszám (default: 1)

                    'skill_level' => $user->skill_level,

                    'joined_at' => $user->pivot->joined_at,use Illuminate\Support\Facades\Hash;

                    'role' => $user->pivot->role,

                ];**Válasz (200):**

            }),

            'created_at' => $this->created_at,class TeamSeeder extends Seeder```json

            'updated_at' => $this->updated_at,

        ];{{

    }

}    public function run(): void  "data": [

```

    {    {

## routes/api.php frissítése

        // 1. Igazi user létrehozása: mate / Mate123      "id": 1,

```php

<?php        $mate = User::create([      "name": "Piros Warriors",



use Illuminate\Support\Facades\Route;            'name' => 'Máté',      "sport_type": "football",

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\TeamController;            'email' => 'mate@example.com',      "max_members": 10,



// Health check endpoint            'password' => Hash::make('Mate123'),      "members_count": 3,

Route::get('/ping', function () {

    return response()->json([            'sport_type' => 'football',      "members": [

        'status' => 'success',

        'message' => 'API is running',            'skill_level' => 'expert',        {

        'timestamp' => now()->toDateTimeString(),

        'timezone' => config('app.timezone'),        ]);          "id": 1,

    ]);

});          "name": "Máté",



// Public routes (no authentication required)        // 2. 10 fake user létrehozása Factory-val          "email": "mate@example.com",

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);        $fakeUsers = User::factory()->count(10)->create();          "sport_type": "football",



// Protected routes (authentication required with Sanctum)          "skill_level": "advanced",

Route::middleware('auth:sanctum')->group(function () {

    // Auth routes        // 3. Összes user (mate + 10 fake = 11 user)          "joined_at": "2025-12-01 14:30:00",

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', [AuthController::class, 'me']);        $allUsers = collect([$mate])->merge($fakeUsers);          "role": "captain"

    

    // Team CRUD routes        }

    Route::apiResource('teams', TeamController::class);

            // 4. 10 fake team létrehozása Factory-val      ],

    // Additional route for PATCH (partial update)

    Route::patch('/teams/{team}/partial', [TeamController::class, 'partialUpdate']);        $teams = Team::factory()->count(10)->create();      "created_at": "2025-12-01 14:00:00",

});

```      "updated_at": "2025-12-01 14:00:00"



---        // 5. Random kapcsolatok létrehozása users és teams között    }



# III. Modul - Tesztelés        $roles = ['captain', 'member', 'vice-captain'];  ],



Feature teszt ideális az HTTP kérések szimulálására, mert több komponens (Controller, Middleware, Auth) együttműködését vizsgáljuk.          "links": {



## AuthControllerTest létrehozása        $teams->each(function ($team) use ($allUsers, $roles) {    "first": "http://localhost:8000/api/teams?page=1",



```bash            // Minden csapathoz random 2-5 tag    "last": "http://localhost:8000/api/teams?page=1",

Team-Sport> php artisan make:test AuthControllerTest

```            $membersCount = rand(2, 5);    "prev": null,



### tests/Feature/AuthControllerTest.php            $selectedUsers = $allUsers->random(min($membersCount, $allUsers->count()));    "next": null



```php              },

<?php

            $selectedUsers->each(function ($user, $index) use ($team, $roles) {  "meta": {

namespace Tests\Feature;

                $team->users()->attach($user->id, [    "current_page": 1,

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;                    'role' => $index === 0 ? 'captain' : fake()->randomElement($roles),    "last_page": 1,

use App\Models\User;

use Illuminate\Support\Facades\Hash;                    'joined_at' => now()->subDays(rand(1, 365)),    "per_page": 15,



class AuthControllerTest extends TestCase                ]);    "total": 10

{

    use RefreshDatabase;            });  }



    public function test_user_can_register_successfully(): void        });}

    {

        $response = $this->postJson('/api/register', [```

            'name' => 'Test User',

            'email' => 'test@example.com',        // 6. Mate-t berakjuk legalább 2 csapatba captain-ként

            'password' => 'password123',

            'password_confirmation' => 'password123',        $mateTeams = $teams->random(2);**Paginálás:** 15 csapat/oldal

            'sport_type' => 'football',

            'skill_level' => 'intermediate',        foreach ($mateTeams as $team) {

        ]);

            if (!$team->users->contains($mate->id)) {---

        $response->assertStatus(201)

            ->assertJsonStructure([                $team->users()->attach($mate->id, [

                'message',

                'user' => ['id', 'name', 'email', 'sport_type', 'skill_level'],                    'role' => 'captain',### 7. Egy csapat lekérése - Részletes adatok

                'access_token',

                'token_type',                    'joined_at' => now()->subDays(rand(30, 90)),

            ]);

                ]);**Endpoint:**

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);

    }            }```http



    public function test_register_fails_with_missing_fields(): void        }GET /api/teams/{id}

    {

        $response = $this->postJson('/api/register', ['name' => 'Test User']);```

        $response->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);

    }        $this->command->info('✅ Seeding befejezve: 1 igazi user (mate) + 10 fake user + 10 fake team + kapcsolatok!');



    public function test_register_fails_with_duplicate_email(): void    }**Auth:** Bearer Token szükséges

    {

        User::factory()->create(['email' => 'test@example.com']);}

        $response = $this->postJson('/api/register', [

            'name' => 'Test User',```**URL paraméter:**

            'email' => 'test@example.com',

            'password' => 'password123',- `{id}`: csapat ID (integer)

            'password_confirmation' => 'password123',

        ]);**database/seeders/DatabaseSeeder.php (módosítása):**

        $response->assertStatus(422)->assertJsonValidationErrors(['email']);

    }**Válasz (200):**



    public function test_user_can_login_successfully(): void```php```json

    {

        User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);namespace Database\Seeders;{

        $response = $this->postJson('/api/login', ['email' => 'test@example.com', 'password' => 'password123']);

        $response->assertStatus(200)->assertJsonStructure(['message', 'user', 'access_token', 'token_type']);  "data": {

    }

use Illuminate\Database\Console\Seeds\WithoutModelEvents;    "id": 1,

    public function test_login_fails_with_wrong_password(): void

    {use Illuminate\Database\Seeder;    "name": "Piros Warriors",

        User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);

        $response = $this->postJson('/api/login', ['email' => 'test@example.com', 'password' => 'wrongpassword']);    "sport_type": "football",

        $response->assertStatus(422);

    }class DatabaseSeeder extends Seeder    "max_members": 10,



    public function test_authenticated_user_can_get_own_data(): void{    "members_count": 3,

    {

        $user = User::factory()->create();    use WithoutModelEvents;    "members": [

        $token = $user->createToken('test_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson('/api/me');      {

        $response->assertStatus(200)->assertJsonStructure(['user']);

    }    public function run(): void        "id": 1,



    public function test_user_can_logout_successfully(): void    {        "name": "Máté",

    {

        $user = User::factory()->create();        $this->call([        "email": "mate@example.com",

        $token = $user->createToken('test_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson('/api/logout');            TeamSeeder::class,        "sport_type": "football",

        $response->assertStatus(200)->assertJson(['message' => 'Logout successful']);

    }        ]);        "skill_level": "advanced",

}

```    }        "joined_at": "2025-12-01 14:30:00",



## TeamControllerTest létrehozása}        "role": "captain"



```bash```      }

Team-Sport> php artisan make:test TeamControllerTest

```    ],



### tests/Feature/TeamControllerTest.php`Team-Sport>php artisan db:seed`    "created_at": "2025-12-01 14:00:00",



```php    "updated_at": "2025-12-01 14:00:00"

<?php

---  }

namespace Tests\Feature;

}

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;# II. Modul - Controller-ek és endpoint-ok```

use App\Models\User;

use App\Models\Team;



class TeamControllerTest extends TestCase`Team-Sport>php artisan make:controller Api/AuthController`**Nem létezik (404):**

{

    use RefreshDatabase;```json



    private function authenticatedUser()**app/Http/Controllers/Api/AuthController.php szerkesztése:**{

    {

        $user = User::factory()->create();  "message": "No query results for model [App\\Models\\Team] 999"

        $token = $user->createToken('test_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];```php}

    }

namespace App\Http\Controllers\Api;```

    public function test_authenticated_user_can_get_teams_list(): void

    {

        $auth = $this->authenticatedUser();

        Team::factory()->count(3)->create();use App\Http\Controllers\Controller;---

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])->getJson('/api/teams');

        $response->assertStatus(200);use App\Models\User;

    }

use Illuminate\Http\Request;### 8. Új csapat létrehozása

    public function test_teams_list_fails_without_authentication(): void

    {use Illuminate\Support\Facades\Hash;

        $response = $this->getJson('/api/teams');

        $response->assertStatus(401);use Illuminate\Validation\ValidationException;**Endpoint:**

    }

```http

    public function test_authenticated_user_can_create_team(): void

    {class AuthController extends ControllerPOST /api/teams

        $auth = $this->authenticatedUser();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']]){```

            ->postJson('/api/teams', ['name' => 'Test Warriors', 'sport_type' => 'football', 'max_members' => 15]);

        $response->assertStatus(201)->assertJson(['message' => 'Team created successfully']);    /**

        $this->assertDatabaseHas('teams', ['name' => 'Test Warriors']);

    }     * Register a new user**Auth:** Bearer Token szükséges



    public function test_authenticated_user_can_delete_team(): void     */

    {

        $auth = $this->authenticatedUser();    public function register(Request $request)**Request Body:**

        $team = Team::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])->deleteJson("/api/teams/{$team->id}");    {```json

        $response->assertStatus(200)->assertJson(['message' => 'Team deleted successfully']);

        $this->assertDatabaseMissing('teams', ['id' => $team->id]);        $request->validate([{

    }

}            'name' => 'required|string|max:255',  "name": "Kék Tigrisek",

```

            'email' => 'required|string|email|max:255|unique:users',  "sport_type": "basketball",

## Tesztek futtatása

            'password' => 'required|string|min:8|confirmed',  "max_members": 12

```bash

Team-Sport> php artisan test            'sport_type' => 'nullable|string|max:255',}

```

            'skill_level' => 'nullable|string|max:255',```

---

        ]);

## Dokumentálás

**Kötelező mezők:**

- **Markdown dokumentáció** - Projektleírás/fejlesztői dokumentáció

- **POSTMAN collection** - Kész API tesztek (`TeamSport_API_READY.postman_collection.json`)        $user = User::create([- `name`: csapat neve (max 255)



---            'name' => $request->name,- `sport_type`: sport típus (max 255)



**Repository:** https://github.com/1tc-molmat/Team-Sport            'email' => $request->email,



**Készítette:** Máté              'password' => Hash::make($request->password),**Opcionális:**

**Verzió:** 1.0  

**Utolsó frissítés:** 2025-12-07            'sport_type' => $request->sport_type,- `max_members`: 1-100 között (default: 10)


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
