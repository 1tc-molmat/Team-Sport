# Team Sport REST API megvalósítása Laravel környezetben# Team Sport REST API megvalósítása Laravel környezetben# Team Sport REST API megvalósítása Laravel környezetben# Team Sport REST API megvalósítása Laravel környezetben



**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`



Az API-t olyan funkciókkal kell ellátni, amelyek lehetővé teszik annak nyilvános elérhetőségét. Ennek a backendnek a fő célja, hogy kiszolgálja a frontendet, amelyet a felhasználók csapatok létrehozására és kezelésére használnak.**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`



## Funkciók



- Authentikáció (register, login, logout, token kezelés)Az API-t olyan funkciókkal kell ellátni, amelyek lehetővé teszik annak nyilvános elérhetőségét. Ennek a backendnek a fő célja, hogy kiszolgálja a frontendet, amelyet a felhasználók csapatok létrehozására és kezelésére használnak.**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`**base_url:** `http://127.0.0.1:8000/api` vagy `http://127.0.0.1/Team-Sport/public/api`

- Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel

- Csapatok létrehozása, listázása, módosítása, törlése (CRUD)

- Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal

- Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)## Funkciók

- Magyar lokalizáció (időzóna, faker adatok)



### A teszteléshez

- Authentikáció (register, login, logout, token kezelés)Az API-t olyan funkciókkal kell ellátni, amelyek lehetővé teszik annak nyilvános elérhetőségét. Ennek a backendnek a fő célja, hogy kiszolgálja a frontendet, amelyet a felhasználók csapatok létrehozására és kezelésére használnak.## Funkciók:

- 1 igazi user (mate@example.com / Mate123)

- 10 fake user- Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel

- 10 fake csapat

- Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)- Csapatok létrehozása, listázása, módosítása, törlése (CRUD)



Az adatbázis neve: `team_sport`- Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal



---- Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)## Funkciók:• Authentikáció (register, login, logout, token kezelés)



## Végpontok- Magyar lokalizáció (időzóna, faker adatok)



A `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.• Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel



Érvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:### A teszteléshez



```json- 1 igazi user (mate@example.com / Mate123)• Authentikáció (register, login, logout, token kezelés)• Csapatok létrehozása, listázása, módosítása, törlése (CRUD)

Response: 401 Unauthorized

{- 10 fake user

  "message": "Unauthenticated."

}- 10 fake csapat• Felhasználók regisztrálhatnak sportágukkal és tudásszintjükkel• Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal

```

- Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)

### Nem védett végpontok

• Csapatok létrehozása, listázása, módosítása, törlése (CRUD)• Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)

- GET `/ping` - teszteléshez

- POST `/register` - regisztrációhozAz adatbázis neve: `team_sport`

- POST `/login` - belépéshez

• Bearer Token alapú biztonságos API védelem Laravel Sanctum-mal• Magyar lokalizáció (időzóna, faker adatok)

### Védett végpontok (authentikáció szükséges)

---

> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:

• Many-to-many kapcsolat users és teams között (team_members kapcsolótáblán keresztül)• Átfogó tesztelés (27 automated test)

```

Authorization: Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8## Végpontok

```

• Magyar lokalizáció (időzóna, faker adatok)

- POST `/logout` - kijelentkezés

- GET `/me` - saját profil lekéréseA `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

- GET `/teams` - csapatok listázása

- POST `/teams` - csapat létrehozása### A teszteléshez:

- GET `/teams/{id}` - csapat részletei

- PUT/PATCH `/teams/{id}` - csapat frissítéseÉrvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:

- PATCH `/teams/{id}/partial` - csapat részleges frissítése

- DELETE `/teams/{id}` - csapat törlése### A teszteléshez:◦ 1 igazi user (mate@example.com / Mate123)



### Hibák```json



- **401 Unauthorized** - A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token.Response: 401 Unauthorized◦ 1 igazi user (mate@example.com / Mate123)◦ 10 fake user

- **404 Not Found** - A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.

- **422 Unprocessable Entity** - Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).{



---  "message": "Unauthenticated."◦ 10 fake user◦ 10 fake csapat



## Összefoglalva}



| Metódus | Végpont | Hozzáférés | Státusz kódok | Leírás |```◦ 10 fake csapat◦ Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)

|---------|---------|------------|---------------|--------|

| GET | /ping | Nyilvános | 200 OK | API teszteléshez |

| POST | /register | Nyilvános | 201 Created, 422 Unprocessable Entity | Új felhasználó regisztrációja |

| POST | /login | Nyilvános | 200 OK, 422 Unprocessable Entity | Bejelentkezés e-maillel és jelszóval |### Nem védett végpontok◦ Random tagságok csapatokban (captain, member, vice-captain szerepkörökkel)

| POST | /logout | Hitelesített | 200 OK, 401 Unauthorized | Kijelentkezés |

| GET | /me | Hitelesített | 200 OK, 401 Unauthorized | Saját profil lekérése |

| GET | /teams | Hitelesített | 200 OK, 401 Unauthorized | Csapatok listázása |

| GET | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Egy csapat részletei |- GET `/ping` - teszteléshez---

| POST | /teams | Hitelesített | 201 Created, 422 Unprocessable Entity, 401 Unauthorized | Csapat létrehozása |

| PUT/PATCH | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat frissítése |- POST `/register` - regisztrációhoz

| PATCH | /teams/{id}/partial | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat részleges frissítése |

| DELETE | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Csapat törlése |- POST `/login` - belépéshezAz adatbázis neve: `team_sport`



---



## Adatbázis terv### Védett végpontok (authentikáció szükséges)## Végpontok:



```

┌──────────────────────┐     ┌─────────────────┐       ┌──────────────┐        ┌──────────┐

│personal_access_tokens│     │      users      │       │team_members  │        │  teams   │> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:---

├──────────────────────┤     ├─────────────────┤       ├──────────────┤        ├──────────┤

│ id (PK)              │  ┌─→│ id (PK)         │1─┐    │ id (PK)      │     ┌─→│ id (PK)  │

│ tokenable_id (FK)    │──┘  │ name            │  └───N│ user_id (FK) │     │  │ name     │

│ tokenable_type       │     │ email (unique)  │       │ team_id (FK) │N────┘  │ sport_   │```httpA `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

│ name                 │     │ password        │       │ role         │        │  type    │

│ token (unique)       │     │ sport_type      │       │ joined_at    │        │ max_mem- │Authorization: Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8

│ abilities            │     │ skill_level     │       │ created_at   │        │  bers    │

│ last_used_at         │     │ created_at      │       │ updated_at   │        │ created_ │```## Végpontok:

│ expires_at           │     │ updated_at      │       └──────────────┘        │  at      │

│ created_at           │     └─────────────────┘                               │ updated_ │

│ updated_at           │                                                        │  at      │

└──────────────────────┘                                                        └──────────┘- POST `/logout` - kijelentkezésÉrvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:

```

- GET `/me` - saját profil lekérése

---

- GET `/teams` - csapatok listázásaA `Content-Type` és az `Accept` header kulcsok mindig `application/json` formátumúak legyenek.

# I. Modul - Struktúra kialakítása

- POST `/teams` - csapat létrehozása

## 1. Telepítés

- GET `/teams/{id}` - csapat részletei```json

Projekt létrehozása, .env konfiguráció, sanctum telepítése, tesztútvonal

- PUT/PATCH `/teams/{id}` - csapat frissítése

```powershell

composer create-project laravel/laravel --prefer-dist Team-Sport- PATCH `/teams/{id}/partial` - csapat részleges frissítéseÉrvénytelen vagy hiányzó token esetén a backendnek `401 Unauthorized` választ kell visszaadnia:Response: 401 Unauthorized

cd Team-Sport

```- DELETE `/teams/{id}` - csapat törlése



### .env fájl módosítása{



```properties### Hibák

DB_CONNECTION=mysql

DB_HOST=127.0.0.1```json  "message": "Unauthenticated."

DB_PORT=3306

DB_DATABASE=team_sport- **401 Unauthorized** - A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token.

DB_USERNAME=root

DB_PASSWORD=- **404 Not Found** - A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.Response: 401 Unauthorized}

```

- **422 Unprocessable Entity** - Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).

### config/app.php módosítása

{```

```php

'timezone' => 'Europe/Budapest',---

'locale' => 'hu',

'faker_locale' => 'hu_HU',  "message": "Unauthenticated."

```

## Összefoglalva

### Laravel Sanctum telepítése

}### Nem védett végpontok:

```powershell

composer require laravel/sanctum| Metódus | Végpont | Hozzáférés | Státusz kódok | Leírás |

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

php artisan install:api|---------|---------|------------|---------------|--------|```

```

| GET | /ping | Nyilvános | 200 OK | API teszteléshez |

### routes/api.php

| POST | /register | Nyilvános | 201 Created, 422 Unprocessable Entity | Új felhasználó regisztrációja |• GET `/ping` - teszteléshez

```php

use Illuminate\Support\Facades\Route;| POST | /login | Nyilvános | 200 OK, 422 Unprocessable Entity | Bejelentkezés e-maillel és jelszóval |



Route::get('/ping', function () {| POST | /logout | Hitelesített | 200 OK, 401 Unauthorized | Kijelentkezés |### Nem védett végpontok:• POST `/register` - regisztrációhoz

    return response()->json([

        'status' => 'success',| GET | /me | Hitelesített | 200 OK, 401 Unauthorized | Saját profil lekérése |

        'message' => 'API is running',

        'timestamp' => now()->toDateTimeString(),| GET | /teams | Hitelesített | 200 OK, 401 Unauthorized | Csapatok listázása |• POST `/login` - belépéshez

        'timezone' => config('app.timezone'),

    ], 200);| GET | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Egy csapat részletei |

});

```| POST | /teams | Hitelesített | 201 Created, 422 Unprocessable Entity, 401 Unauthorized | Csapat létrehozása |• GET `/ping` - teszteléshez



### Teszt| PUT/PATCH | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat frissítése |



**Szerver indítás:**| PATCH | /teams/{id}/partial | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat részleges frissítése |• POST `/register` - regisztrációhoz### Védett végpontok (authentikáció szükséges):



```powershell| DELETE | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Csapat törlése |

php artisan serve

```• POST `/login` - belépéshez



**POSTMAN teszt:**---

- GET `http://127.0.0.1:8000/api/ping`

> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:

**VAGY XAMPP:**

- GET `http://127.0.0.1/Team-Sport/public/api/ping`## Adatbázis terv



---### Védett végpontok (authentikáció szükséges):



## 2. Modellek és migráció```



### Ami már megvan┌──────────────────────┐     ┌─────────────────┐       ┌──────────────┐        ┌──────────┐```



Ehhez nem is kell nyúlni│personal_access_tokens│     │      users      │       │team_members  │        │  teams   │



**database/migrations/?_create_personal_access_tokens_table.php:**├──────────────────────┤     ├─────────────────┤       ├──────────────┤        ├──────────┤> Az innen következő végpontok autentikáltak, tehát a kérés headerében meg kell adni a tokent is:Authorization: "Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8"



```php│ id (PK)              │  ┌─→│ id (PK)         │1─┐    │ id (PK)      │     ┌─→│ id (PK)  │

Schema::create('personal_access_tokens', function (Blueprint $table) {

    $table->id();│ tokenable_id (FK)    │──┘  │ name            │  └───N│ user_id (FK) │     │  │ name     │```

    $table->morphs('tokenable'); // user kapcsolat

    $table->string('name');│ tokenable_type       │     │ email (unique)  │       │ team_id (FK) │N────┘  │ sport_   │

    $table->string('token', 64)->unique();

    $table->text('abilities')->nullable();│ name                 │     │ password        │       │ role         │        │  type    │```

    $table->timestamp('last_used_at')->nullable();

    $table->timestamp('expires_at')->nullable();│ token (unique)       │     │ sport_type      │       │ joined_at    │        │ max_mem- │

    $table->timestamps();

});│ abilities            │     │ skill_level     │       │ created_at   │        │  bers    │Authorization: "Bearer 2|7Fbr79b5zn8RxMfOqfdzZ31SnGWvgDidjahbdRfL2a98cfd8"• POST `/logout` - kijelentkezés

```

│ last_used_at         │     │ created_at      │       │ updated_at   │        │ created_ │

### Ezt módosítani kell

│ expires_at           │     │ updated_at      │       └──────────────┘        │  at      │```• GET `/me` - saját profil lekérése

**database/migrations/0001_01_01_000000_create_users_table.php:**

│ created_at           │     └─────────────────┘                               │ updated_ │

```php

Schema::create('users', function (Blueprint $table) {│ updated_at           │                                                        │  at      │• GET `/teams` - csapatok listázása

    $table->id();

    $table->string('name');└──────────────────────┘                                                        └──────────┘

    $table->string('email')->unique();

    $table->timestamp('email_verified_at')->nullable();```• POST `/logout` - kijelentkezés• POST `/teams` - csapat létrehozása

    $table->string('password');

    // ezt bele kell írni

    $table->string('sport_type')->nullable();

    $table->string('skill_level')->nullable();---• GET `/me` - saját profil lekérése• GET `/teams/{id}` - csapat részletei

    // ezeket bele kell írni

    $table->rememberToken();

    $table->timestamps();

});# I. Modul - Struktúra kialakítása• GET `/teams` - csapatok listázása• PUT/PATCH `/teams/{id}` - csapat frissítése

```



### app/Models/User.php (módosítani kell)

## 1. Telepítés• POST `/teams` - csapat létrehozása• PATCH `/teams/{id}/partial` - csapat részleges frissítése

```php

<?php



namespace App\Models;Projekt létrehozása, .env konfiguráció, sanctum telepítése, tesztútvonal• GET `/teams/{id}` - csapat részletei• DELETE `/teams/{id}` - csapat törlése



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;```bash• PUT/PATCH `/teams/{id}` - csapat frissítése

use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;célhely> composer create-project laravel/laravel --prefer-dist Team-Sport

use Laravel\Sanctum\HasApiTokens;

célhely> cd Team-Sport• PATCH `/teams/{id}/partial` - csapat részleges frissítése### Hibák:

class User extends Authenticatable

{```

    use HasFactory, Notifiable, HasApiTokens;

• DELETE `/teams/{id}` - csapat törlése

    protected $fillable = [

        'name',### .env fájl módosítása

        'email',

        'password',• **400 Bad Request:** A kérés hibás formátumú. Ezt a hibát akkor kell visszaadni, ha a kérés hibásan van formázva, vagy ha hiányoznak a szükséges mezők.

        'sport_type',

        'skill_level',```env

    ];

DB_CONNECTION=mysql### Hibák:• **401 Unauthorized:** A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token vagy hiányzik.

    // amikor a modellt JSON formátumban adod vissza ne jelenjenek meg a következő mezők:

    protected $hidden = [DB_HOST=127.0.0.1

        'password',

        'remember_token',DB_PORT=3306• **404 Not Found:** A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.

    ];

DB_DATABASE=team_sport

    protected function casts(): array

    {DB_USERNAME=root• **401 Unauthorized:** A felhasználó nem jogosult a kérés végrehajtására. Ezt a hibát akkor kell visszaadni, ha érvénytelen a token.• **422 Unprocessable Entity:** Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).

        return [

            'email_verified_at' => 'datetime',DB_PASSWORD=

            'password' => 'hashed',

        ];```• **404 Not Found:** A kért erőforrás nem található. Ezt a hibát akkor kell visszaadni, ha a kért csapat nem található.

    }



    public function teamMembers(): HasMany

    {### config/app.php módosítása• **422 Unprocessable Entity:** Validációs hibák esetén (pl. hiányzó vagy helytelen mezők).---

        return $this->hasMany(TeamMember::class);

    }



    public function teams(): BelongsToMany```php

    {

        return $this->belongsToMany(Team::class, 'team_members')'timezone' => 'Europe/Budapest',

            ->withPivot('joined_at', 'role')

            ->withTimestamps();'locale' => 'hu',---### 4. Adatbázis beállítás

    }

}'faker_locale' => 'hu_HU',

```

```

### Team model létrehozása



```powershell

php artisan make:model Team -m### Laravel Sanctum telepítése## ÖsszefoglalvaA `.env` fájlban:

```



**database/migrations/?_create_teams_table.php (módosítani kell):**

```bash```env

```php

<?phpTeam-Sport> composer require laravel/sanctum



use Illuminate\Database\Migrations\Migration;Team-Sport> php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"| Metódus | Végpont | Hozzáférés | Státusz kódok | Leírás |APP_NAME="Team Sport API"

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;Team-Sport> php artisan install:api



return new class extends Migration```|---------|---------|------------|---------------|--------|APP_ENV=local

{

    public function up(): void

    {

        Schema::create('teams', function (Blueprint $table) {### routes/api.php| GET | /ping | Nyilvános | 200 OK | API teszteléshez |APP_DEBUG=true

            $table->id();

            $table->string('name');

            $table->string('sport_type');

            $table->integer('max_members')->default(10);```php| POST | /register | Nyilvános | 201 Created, 422 Unprocessable Entity | Új felhasználó regisztrációja |APP_TIMEZONE=Europe/Budapest

            $table->timestamps();

        });use Illuminate\Support\Facades\Route;

    }

| POST | /login | Nyilvános | 200 OK, 422 Unprocessable Entity | Bejelentkezés e-maillel és jelszóval |APP_LOCALE=hu

    public function down(): void

    {Route::get('/ping', function () {

        Schema::dropIfExists('teams');

    }    return response()->json([| POST | /logout | Hitelesített | 200 OK, 401 Unauthorized | Kijelentkezés |APP_FAKER_LOCALE=hu_HU

};

```        'status' => 'success',



**app/Models/Team.php (módosítani kell):**        'message' => 'API is running',| GET | /me | Hitelesített | 200 OK, 401 Unauthorized | Saját profil lekérése |



```php        'timestamp' => now()->toDateTimeString(),

<?php

        'timezone' => config('app.timezone'),| GET | /teams | Hitelesített | 200 OK, 401 Unauthorized | Csapatok listázása |DB_CONNECTION=sqlite

namespace App\Models;

    ], 200);

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;});| GET | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Egy csapat részletei |# DB_DATABASE=/absolute/path/to/database.sqlite

use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;```



class Team extends Model| POST | /teams | Hitelesített | 201 Created, 422 Unprocessable Entity, 401 Unauthorized | Csapat létrehozása |```

{

    use HasFactory;### Teszt

    

    protected $fillable = [| PUT/PATCH | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat frissítése |

        'name',

        'sport_type',**Szerver indítás:**

        'max_members',

    ];| PATCH | /teams/{id}/partial | Hitelesített | 200 OK, 404 Not Found, 422 Unprocessable Entity, 401 Unauthorized | Csapat részleges frissítése |### 5. Adatbázis migrálás és seed



    public function teamMembers(): HasMany```bash

    {

        return $this->hasMany(TeamMember::class);Team-Sport> php artisan serve| DELETE | /teams/{id} | Hitelesített | 200 OK, 404 Not Found, 401 Unauthorized | Csapat törlése |```bash

    }

```

    public function users(): BelongsToMany

    {# Adatbázis táblák létrehozása

        return $this->belongsToMany(User::class, 'team_members')

            ->withPivot('joined_at', 'role')**POSTMAN teszt:**

            ->withTimestamps();

    }- GET `http://127.0.0.1:8000/api/ping`---php artisan migrate

}

```



### TeamMember model létrehozása**VAGY XAMPP:**



```powershell- GET `http://127.0.0.1/Team-Sport/public/api/ping`

php artisan make:model TeamMember -m

```## Adatbázis terv# Fake adatok feltöltése (11 user + 10 csapat)



**database/migrations/?_create_team_members_table.php (módosítani kell):**---



```phpphp artisan db:seed

<?php

## 2. Modellek és migráció

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;``````

use Illuminate\Support\Facades\Schema;

### Ami már megvan

return new class extends Migration

{┌──────────────────────┐     ┌─────────────────┐       ┌──────────────┐        ┌──────────┐

    public function up(): void

    {Ehhez nem is kell nyúlni

        Schema::create('team_members', function (Blueprint $table) {

            $table->id();│personal_access_tokens│     │      users      │       │team_members  │        │  teams   │### 6. Szerver indítás

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // a user_id mező a users tábla id oszlopára fog hivatkozni**database/migrations/?_create_personal_access_tokens_table.php:**

            $table->foreignId('team_id')->constrained()->onDelete('cascade');

            $table->timestamp('joined_at')->useCurrent();├──────────────────────┤     ├─────────────────┤       ├──────────────┤        ├──────────┤```bash

            $table->string('role')->default('member'); // captain, member, vice-captain

            $table->timestamps();```php

        });

    }Schema::create('personal_access_tokens', function (Blueprint $table) {│ id (PK)              │  ┌─→│ id (PK)         │1─┐    │ id (PK)      │     ┌─→│ id (PK)  │php artisan serve



    public function down(): void    $table->id();

    {

        Schema::dropIfExists('team_members');    $table->morphs('tokenable'); // user kapcsolat│ tokenable_id (FK)    │──┘  │ name            │  └───N│ user_id (FK) │     │  │ name     │```

    }

};    $table->string('name');

```

    $table->string('token', 64)->unique();│ tokenable_type       │     │ email (unique)  │       │ team_id (FK) │N────┘  │ sport_   │

**app/Models/TeamMember.php (módosítani kell):**

    $table->text('abilities')->nullable();

```php

<?php    $table->timestamp('last_used_at')->nullable();│ name                 │     │ password        │       │ role         │        │  type    │Az API elérhető: `http://localhost:8000/api`



namespace App\Models;    $table->timestamp('expires_at')->nullable();



use Illuminate\Database\Eloquent\Model;    $table->timestamps();│ token (unique)       │     │ sport_type      │       │ joined_at    │        │ max_mem- │

use Illuminate\Database\Eloquent\Relations\BelongsTo;

});

class TeamMember extends Model

{```│ abilities            │     │ skill_level     │       │ created_at   │        │  bers    │---

    protected $fillable = [

        'user_id',

        'team_id',

        'joined_at',### Ezt módosítani kell│ last_used_at         │     │ created_at      │       │ updated_at   │        │ created_ │

        'role',

    ];



    protected $casts = [**database/migrations/0001_01_01_000000_create_users_table.php:**│ expires_at           │     │ updated_at      │       └──────────────┘        │  at      │## Adatbázis Struktúra

        'joined_at' => 'datetime',

    ];



    public function user(): BelongsTo```php│ created_at           │     └─────────────────┘                               │ updated_ │

    {

        return $this->belongsTo(User::class);Schema::create('users', function (Blueprint $table) {

    }

    $table->id();│ updated_at           │                                                        │  at      │### Táblák áttekintése

    public function team(): BelongsTo

    {    $table->string('name');

        return $this->belongsTo(Team::class);

    }    $table->string('email')->unique();└──────────────────────┘                                                        └──────────┘

}

```    $table->timestamp('email_verified_at')->nullable();



### Migráció futtatása    $table->string('password');```#### 1. `users` tábla



```powershell    // ezt bele kell írni

php artisan migrate

```    $table->string('sport_type')->nullable();Felhasználók adatait tárolja.



---    $table->string('skill_level')->nullable();



## 3. Seeding    // ezeket bele kell írni---



Factory és seederek létrehozása    $table->rememberToken();



### database/factories/UserFactory.php (módosítása)    $table->timestamps();| Mező | Típus | Leírás |



```php});

<?php

```# I. Modul - Struktúra kialakítása|------|-------|--------|

namespace Database\Factories;



use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;### app/Models/User.php (módosítani kell)| id | bigint (PK) | Egyedi azonosító |

use App\Models\User;



class UserFactory extends Factory

{```php## 1. Telepítés (projekt létrehozása, .env konfiguráció, sanctum telepítése, tesztútvonal)| name | varchar(255) | Felhasználó neve |

    protected $model = User::class;

<?php

    public function definition()

    {| email | varchar(255) | Email cím (egyedi) |

        $this->faker = \Faker\Factory::create('hu_HU'); // magyar nevekhez

namespace App\Models;

        return [

            'name' => $this->faker->firstName . ' ' . $this->faker->lastName, // magyaros teljes név`célhely>composer create-project laravel/laravel --prefer-dist Team-Sport`| password | varchar(255) | Hash-elt jelszó |

            'email' => $this->faker->unique()->safeEmail(),

            'password' => Hash::make('password'), // minden user jelszava: passworduse Illuminate\Database\Eloquent\Factories\HasFactory;

            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),

            'skill_level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),use Illuminate\Foundation\Auth\User as Authenticatable;| sport_type | varchar(255) | Preferált sport típus |

        ];

    }use Illuminate\Notifications\Notifiable;

}

```use Illuminate\Database\Eloquent\Relations\HasMany;`célhely>cd Team-Sport`| skill_level | varchar(255) | Képzettségi szint |



### TeamFactory létrehozásause Illuminate\Database\Eloquent\Relations\BelongsToMany;



```powershelluse Laravel\Sanctum\HasApiTokens;| email_verified_at | timestamp | Email megerősítés ideje |

php artisan make:factory TeamFactory

```



**database/factories/TeamFactory.php (módosítása):**class User extends Authenticatable**.env fájl módosítása:**| remember_token | varchar(100) | Laravel session token |



```php{

<?php

    use HasFactory, Notifiable, HasApiTokens;| created_at | timestamp | Létrehozás időpontja |

namespace Database\Factories;



use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Team;    protected $fillable = [```env| updated_at | timestamp | Módosítás időpontja |



class TeamFactory extends Factory        'name',

{

    protected $model = Team::class;        'email',DB_CONNECTION=mysql



    public function definition(): array        'password',

    {

        $this->faker = \Faker\Factory::create('hu_HU');        'sport_type',DB_HOST=127.0.0.1**Kapcsolatok:**

        

        $colors = ['Piros', 'Kék', 'Zöld', 'Sárga', 'Fekete', 'Fehér'];        'skill_level',

        $animals = ['Tigrisek', 'Warriors', 'Dragons', 'Eagles', 'Lions', 'Sharks'];

            ];DB_PORT=3306- `hasMany` → `team_members`

        return [

            'name' => $this->faker->randomElement($colors) . ' ' . $this->faker->randomElement($animals),

            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),

            'max_members' => $this->faker->numberBetween(8, 20),    // amikor a modellt JSON formátumban adod vissza ne jelenjenek meg a következő mezők:DB_DATABASE=team_sport- `belongsToMany` → `teams` (through team_members)

        ];

    }    protected $hidden = [

}

```        'password',DB_USERNAME=root



### TeamSeeder létrehozása        'remember_token',



```powershell    ];DB_PASSWORD=#### 2. `teams` tábla

php artisan make:seeder TeamSeeder

```



**database/seeders/TeamSeeder.php (módosítása):**    protected function casts(): array```Csapatok adatait tárolja.



```php    {

<?php

        return [

namespace Database\Seeders;

            'email_verified_at' => 'datetime',

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;            'password' => 'hashed',**config/app.php módosítása:**| Mező | Típus | Leírás |

use App\Models\Team;

use App\Models\User;        ];

use Illuminate\Support\Facades\Hash;

    }|------|-------|--------|

class TeamSeeder extends Seeder

{

    public function run(): void

    {    public function teamMembers(): HasMany```php| id | bigint (PK) | Egyedi azonosító |

        // 1. Igazi user létrehozása: mate / Mate123

        $mate = User::create([    {

            'name' => 'Máté',

            'email' => 'mate@example.com',        return $this->hasMany(TeamMember::class);'timezone' => 'Europe/Budapest',| name | varchar(255) | Csapat neve |

            'password' => Hash::make('Mate123'),

            'sport_type' => 'football',    }

            'skill_level' => 'expert',

        ]);'locale' => 'hu',| sport_type | varchar(255) | Sport típus |



        // 2. 10 fake user létrehozása Factory-val    public function teams(): BelongsToMany

        $fakeUsers = User::factory()->count(10)->create();

    {'faker_locale' => 'hu_HU',| max_members | integer | Maximum tagok száma (default: 10) |

        // 3. Összes user (mate + 10 fake = 11 user)

        $allUsers = collect([$mate])->merge($fakeUsers);        return $this->belongsToMany(Team::class, 'team_members')



        // 4. 10 fake team létrehozása Factory-val            ->withPivot('joined_at', 'role')```| created_at | timestamp | Létrehozás |

        $teams = Team::factory()->count(10)->create();

            ->withTimestamps();

        // 5. Random kapcsolatok létrehozása users és teams között

        $roles = ['captain', 'member', 'vice-captain'];    }| updated_at | timestamp | Módosítás |

        

        $teams->each(function ($team) use ($allUsers, $roles) {}

            // Minden csapathoz random 2-5 tag

            $membersCount = rand(2, 5);````Team-Sport>composer require laravel/sanctum`

            $selectedUsers = $allUsers->random(min($membersCount, $allUsers->count()));

            

            $selectedUsers->each(function ($user, $index) use ($team, $roles) {

                $team->users()->attach($user->id, [### Team model létrehozása**Kapcsolatok:**

                    'role' => $index === 0 ? 'captain' : fake()->randomElement($roles),

                    'joined_at' => now()->subDays(rand(1, 365)),

                ]);

            });```bash`Team-Sport>php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`- `hasMany` → `team_members`

        });

Team-Sport> php artisan make:model Team -m

        // 6. Mate-t berakjuk legalább 2 csapatba captain-ként

        $mateTeams = $teams->random(2);```- `belongsToMany` → `users` (through team_members)

        foreach ($mateTeams as $team) {

            if (!$team->users->contains($mate->id)) {

                $team->users()->attach($mate->id, [

                    'role' => 'captain',**database/migrations/?_create_teams_table.php (módosítani kell):**`Team-Sport>php artisan install:api`

                    'joined_at' => now()->subDays(rand(30, 90)),

                ]);

            }

        }```php#### 3. `team_members` tábla (pivot)



        $this->command->info('✅ Seeding befejezve: 1 igazi user (mate) + 10 fake user + 10 fake team + kapcsolatok!');<?php

    }

}**routes/api.php:**User és Team közötti kapcsolatot tárolja.

```

use Illuminate\Database\Migrations\Migration;

### database/seeders/DatabaseSeeder.php (módosítása)

use Illuminate\Database\Schema\Blueprint;

```php

<?phpuse Illuminate\Support\Facades\Schema;



namespace Database\Seeders;```php| Mező | Típus | Leírás |



use Illuminate\Database\Console\Seeds\WithoutModelEvents;return new class extends Migration

use Illuminate\Database\Seeder;

{use Illuminate\Support\Facades\Route;|------|-------|--------|

class DatabaseSeeder extends Seeder

{    public function up(): void

    use WithoutModelEvents;

    {| id | bigint (PK) | Egyedi azonosító |

    public function run(): void

    {        Schema::create('teams', function (Blueprint $table) {

        $this->call([

            TeamSeeder::class,            $table->id();Route::get('/ping', function () {| user_id | bigint (FK) | User azonosító |

        ]);

    }            $table->string('name');

}

```            $table->string('sport_type');    return response()->json([| team_id | bigint (FK) | Csapat azonosító |



### Seeding futtatása            $table->integer('max_members')->default(10);



```powershell            $table->timestamps();        'status' => 'success',| role | varchar(50) | Szerep (member/captain) |

php artisan db:seed

```        });



---    }        'message' => 'API is running',| joined_at | timestamp | Csatlakozás időpontja |



# II. Modul - Controller-ek és endpoint-ok



## AuthController létrehozása    public function down(): void        'timestamp' => now()->toDateTimeString(),



```powershell    {

php artisan make:controller Api/AuthController

```        Schema::dropIfExists('teams');        'timezone' => config('app.timezone'),**Foreign Keys:**



### app/Http/Controllers/Api/AuthController.php    }



```php};    ], 200);- `user_id` → `users.id` (CASCADE delete)

<?php

```

namespace App\Http\Controllers\Api;

});- `team_id` → `teams.id` (CASCADE delete)

use App\Http\Controllers\Controller;

use App\Models\User;**app/Models/Team.php (módosítani kell):**

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;```

use Illuminate\Validation\ValidationException;

```php

class AuthController extends Controller

{<?php#### 4. `personal_access_tokens` tábla

    /**

     * Register a new user

     */

    public function register(Request $request)namespace App\Models;### TesztSanctum Bearer tokenek tárolása.

    {

        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users',use Illuminate\Database\Eloquent\Factories\HasFactory;

            'password' => 'required|string|min:8|confirmed',

            'sport_type' => 'nullable|string|max:255',use Illuminate\Database\Eloquent\Model;

            'skill_level' => 'nullable|string|max:255',

        ]);use Illuminate\Database\Eloquent\Relations\HasMany;**serve:**| Mező | Típus | Leírás |



        $user = User::create([use Illuminate\Database\Eloquent\Relations\BelongsToMany;

            'name' => $request->name,

            'email' => $request->email,|------|-------|--------|

            'password' => Hash::make($request->password),

            'sport_type' => $request->sport_type,class Team extends Model

            'skill_level' => $request->skill_level,

        ]);{`Team-Sport>php artisan serve`| id | bigint (PK) | Token azonosító |



        $token = $user->createToken('auth_token')->plainTextToken;    use HasFactory;



        return response()->json([    | tokenable_type | varchar(255) | Model típus (User) |

            'message' => 'Registration successful',

            'user' => [    protected $fillable = [

                'id' => $user->id,

                'name' => $user->name,        'name',> POSTMAN teszt: GET http://127.0.0.1:8000/api/ping| tokenable_id | bigint | User ID |

                'email' => $user->email,

                'sport_type' => $user->sport_type,        'sport_type',

                'skill_level' => $user->skill_level,

            ],        'max_members',| name | varchar(255) | Token neve |

            'access_token' => $token,

            'token_type' => 'Bearer',    ];

        ], 201);

    }**VAGY XAMPP:**| token | varchar(64) | Hash-elt token (egyedi) |



    /**    public function teamMembers(): HasMany

     * Login user

     */    {| abilities | text | Token jogosultságok |

    public function login(Request $request)

    {        return $this->hasMany(TeamMember::class);

        $request->validate([

            'email' => 'required|email',    }> POSTMAN teszt: GET http://127.0.0.1/Team-Sport/public/api/ping| last_used_at | timestamp | Utolsó használat |

            'password' => 'required',

        ]);



        $user = User::where('email', $request->email)->first();    public function users(): BelongsToMany| expires_at | timestamp | Lejárat |



        if (!$user || !Hash::check($request->password, $user->password)) {    {

            throw ValidationException::withMessages([

                'email' => ['The provided credentials are incorrect.'],        return $this->belongsToMany(User::class, 'team_members')---| created_at | timestamp | Létrehozás |

            ]);

        }            ->withPivot('joined_at', 'role')



        $token = $user->createToken('auth_token')->plainTextToken;            ->withTimestamps();| updated_at | timestamp | Módosítás |



        return response()->json([    }

            'message' => 'Login successful',

            'user' => [}## 2. Modellek és migráció (sémák)

                'id' => $user->id,

                'name' => $user->name,```

                'email' => $user->email,

                'sport_type' => $user->sport_type,### Adatbázis Diagram

                'skill_level' => $user->skill_level,

            ],### TeamMember model létrehozása

            'access_token' => $token,

            'token_type' => 'Bearer',**Ami már megvan (database/migrations):**

        ]);

    }```bash



    /**Team-Sport> php artisan make:model TeamMember -m```

     * Logout user (revoke token)

     */```

    public function logout(Request $request)

    {Ehhez nem is kell nyúlni:┌─────────────┐         ┌──────────────────┐         ┌─────────────┐

        $request->user()->currentAccessToken()->delete();

**database/migrations/?_create_team_members_table.php (módosítani kell):**

        return response()->json([

            'message' => 'Logout successful',│   users     │         │  team_members    │         │    teams    │

        ]);

    }```php



    /**<?php```php├─────────────┤         ├──────────────────┤         ├─────────────┤

     * Get authenticated user

     */

    public function me(Request $request)

    {use Illuminate\Database\Migrations\Migration;Schema::create('personal_access_tokens', function (Blueprint $table) {│ id (PK)     │────┐    │ id (PK)          │    ┌────│ id (PK)     │

        return response()->json([

            'user' => $request->user(),use Illuminate\Database\Schema\Blueprint;

        ]);

    }use Illuminate\Support\Facades\Schema;    $table->id();│ name        │    └───→│ user_id (FK)     │    │    │ name        │

}

```



## TeamController létrehozásareturn new class extends Migration    $table->morphs('tokenable'); // user kapcsolat│ email       │         │ team_id (FK)     │←───┘    │ sport_type  │



```powershell{

php artisan make:controller Api/TeamController

```    public function up(): void    $table->string('name');│ password    │         │ role             │         │ max_members │



### app/Http/Controllers/Api/TeamController.php    {



```php        Schema::create('team_members', function (Blueprint $table) {    $table->string('token', 64)->unique();│ sport_type  │         │ joined_at        │         │ created_at  │

<?php

            $table->id();

namespace App\Http\Controllers\Api;

            $table->foreignId('user_id')->constrained()->onDelete('cascade');    $table->text('abilities')->nullable();│ skill_level │         │                  │         │ updated_at  │

use App\Http\Controllers\Controller;

use App\Models\Team;            // a user_id mező a users tábla id oszlopára fog hivatkozni

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;            $table->foreignId('team_id')->constrained()->onDelete('cascade');    $table->timestamp('last_used_at')->nullable();│ created_at  │         └──────────────────┘         └─────────────┘



class TeamController extends Controller            $table->timestamp('joined_at')->useCurrent();

{

    /**            $table->string('role')->default('member'); // captain, member, vice-captain    $table->timestamp('expires_at')->nullable();│ updated_at  │

     * Display a listing of all teams.

     */            $table->timestamps();

    public function index()

    {        });    $table->timestamps();└─────────────┘

        $teams = Team::with('users')->paginate(15);

    }

        return \App\Http\Resources\TeamResource::collection($teams);

    }});```



    /**    public function down(): void

     * Store a newly created team.

     */    {```

    public function store(Request $request)

    {        Schema::dropIfExists('team_members');

        $validated = $request->validate([

            'name' => 'required|string|max:255',    }### Seed Adatok

            'sport_type' => 'required|string|max:255',

            'max_members' => 'nullable|integer|min:1|max:100',};

        ]);

```**Ezt módosítani kell:**

        $team = Team::create([

            'name' => $validated['name'],

            'sport_type' => $validated['sport_type'],

            'max_members' => $validated['max_members'] ?? 10,**app/Models/TeamMember.php (módosítani kell):**A `php artisan db:seed` parancs fut:

        ]);



        return response()->json([

            'message' => 'Team created successfully',```php```php

            'data' => $team->load('users'),

        ], 201);<?php

    }

Schema::create('users', function (Blueprint $table) {**Users (11 db):**

    /**

     * Display the specified team.namespace App\Models;

     */

    public function show(Team $team)    $table->id();- 1 valódi user: Máté (mate@example.com / Mate123)

    {

        return new \App\Http\Resources\TeamResource($team->load('users'));use Illuminate\Database\Eloquent\Model;

    }

use Illuminate\Database\Eloquent\Relations\BelongsTo;    $table->string('name');- 10 faker user magyar nevekkel (jelszó: password)

    /**

     * Update the specified team (PUT or PATCH).

     */

    public function update(Request $request, Team $team)class TeamMember extends Model    $table->string('email')->unique();

    {

        // PATCH részleges frissítés támogatása{

        $validated = $request->validate([

            'name' => 'sometimes|string|max:255',    protected $fillable = [    $table->timestamp('email_verified_at')->nullable();**Teams (10 db):**

            'sport_type' => 'sometimes|string|max:255',

            'max_members' => 'sometimes|integer|min:1|max:100',        'user_id',

        ]);

        'team_id',    $table->string('password');- Random generált csapatnevek (pl: "Piros Warriors", "Kék Tigrisek")

        $team->update($validated);

        'joined_at',

        return response()->json([

            'message' => 'Team updated successfully',        'role',    // ezt bele kell írni- Random sport típusok (football, basketball, volleyball, stb)

            'data' => $team->load('users'),

        ]);    ];

    }

    $table->string('sport_type')->nullable();

    /**

     * Partially update the specified team (PATCH - partial update).    protected $casts = [

     */

    public function partialUpdate(Request $request, Team $team)        'joined_at' => 'datetime',    $table->string('skill_level')->nullable();**Team Members (~38 kapcsolat):**

    {

        $validated = $request->validate([    ];

            'name' => 'sometimes|string|max:255',

            'sport_type' => 'sometimes|string|max:255',    // ezeket bele kell írni- Minden csapatban 2-5 tag random

            'max_members' => 'sometimes|integer|min:1|max:100',

        ]);    public function user(): BelongsTo



        $team->update($validated);    {    $table->rememberToken();- Máté 2 csapatban captain



        return response()->json([        return $this->belongsTo(User::class);

            'message' => 'Team partially updated successfully',

            'data' => $team->load('users'),    }    $table->timestamps();

        ]);

    }



    /**    public function team(): BelongsTo});---

     * Remove the specified team.

     */    {

    public function destroy(Team $team)

    {        return $this->belongsTo(Team::class);```

        $team->delete();

    }

        return response()->json([

            'message' => 'Team deleted successfully',}## API Végpontok

        ]);

    }```

}

```**app/Models/User.php (módosítani kell):**



## TeamResource létrehozása### Migráció futtatása



```powershell### Base URL

php artisan make:resource TeamResource

``````bash



### app/Http/Resources/TeamResource.phpTeam-Sport> php artisan migrate```php```



```php```

<?php

namespace App\Models;http://localhost:8000/api

namespace App\Http\Resources;

---

use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;```



class TeamResource extends JsonResource## 3. Seeding

{

    public function toArray(Request $request): arrayuse Illuminate\Database\Eloquent\Factories\HasFactory;

    {

        return [Factory és seederek létrehozása

            'id' => $this->id,

            'name' => $this->name,use Illuminate\Foundation\Auth\User as Authenticatable;### Végpontok összefoglalása

            'sport_type' => $this->sport_type,

            'max_members' => $this->max_members,### database/factories/UserFactory.php (módosítása)

            'members_count' => $this->users->count(),

            'members' => $this->users->map(function ($user) {use Illuminate\Notifications\Notifiable;

                return [

                    'id' => $user->id,```php

                    'name' => $user->name,

                    'email' => $user->email,<?phpuse Illuminate\Database\Eloquent\Relations\HasMany;| Metódus | Végpont | Auth | Leírás |

                    'sport_type' => $user->sport_type,

                    'skill_level' => $user->skill_level,

                    'joined_at' => $user->pivot->joined_at,

                    'role' => $user->pivot->role,namespace Database\Factories;use Illuminate\Database\Eloquent\Relations\BelongsToMany;|---------|---------|------|--------|

                ];

            }),

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,use Illuminate\Database\Eloquent\Factories\Factory;use Laravel\Sanctum\HasApiTokens;| GET | /ping | Nem | API health check |

        ];

    }use Illuminate\Support\Facades\Hash;

}

```use App\Models\User;| POST | /register | Nem | Regisztráció |



## routes/api.php frissítése



```phpclass UserFactory extends Factoryclass User extends Authenticatable| POST | /login | Nem | Bejelentkezés |

<?php

{

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;    protected $model = User::class;{| POST | /logout | Igen | Kijelentkezés |

use App\Http\Controllers\Api\TeamController;



// Health check endpoint

Route::get('/ping', function () {    public function definition()    use HasFactory, Notifiable, HasApiTokens;| GET | /me | Igen | Saját adatok |

    return response()->json([

        'status' => 'success',    {

        'message' => 'API is running',

        'timestamp' => now()->toDateTimeString(),        $this->faker = \Faker\Factory::create('hu_HU'); // magyar nevekhez| GET | /teams | Igen | Csapatok listája |

        'timezone' => config('app.timezone'),

    ]);

});

        return [    protected $fillable = [| POST | /teams | Igen | Új csapat |

// Public routes (no authentication required)

Route::post('/register', [AuthController::class, 'register']);            'name' => $this->faker->firstName . ' ' . $this->faker->lastName, // magyaros teljes név

Route::post('/login', [AuthController::class, 'login']);

            'email' => $this->faker->unique()->safeEmail(),        'name',| GET | /teams/{id} | Igen | Egy csapat |

// Protected routes (authentication required with Sanctum)

Route::middleware('auth:sanctum')->group(function () {            'password' => Hash::make('password'), // minden user jelszava: password

    // Auth routes

    Route::post('/logout', [AuthController::class, 'logout']);            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),        'email',| PUT | /teams/{id} | Igen | Teljes frissítés |

    Route::get('/me', [AuthController::class, 'me']);

                'skill_level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced', 'expert']),

    // Team CRUD routes

    Route::apiResource('teams', TeamController::class);        ];        'password',| PATCH | /teams/{id} | Igen | Részleges frissítés |

    

    // Additional route for PATCH (partial update)    }

    Route::patch('/teams/{team}/partial', [TeamController::class, 'partialUpdate']);

});}        'sport_type',| DELETE | /teams/{id} | Igen | Törlés |

```

```

---

        'skill_level',

# III. Modul - Tesztelés

### TeamFactory létrehozása

Feature teszt ideális az HTTP kérések szimulálására, mert több komponens (Controller, Middleware, Auth) együttműködését vizsgáljuk.

    ];---

## AuthControllerTest létrehozása

```bash

```powershell

php artisan make:test AuthControllerTestTeam-Sport> php artisan make:factory TeamFactory

```

```

### tests/Feature/AuthControllerTest.php

    // amikor a modellt JSON formátumban adod vissza ne jelenjenek meg a következő mezők:### 1. Health Check - API státusz ellenőrzés

```php

<?php**database/factories/TeamFactory.php (módosítása):**



namespace Tests\Feature;    protected $hidden = [



use Illuminate\Foundation\Testing\RefreshDatabase;```php

use Tests\TestCase;

use App\Models\User;<?php        'password',**Endpoint:**

use Illuminate\Support\Facades\Hash;



class AuthControllerTest extends TestCase

{namespace Database\Factories;        'remember_token',```http

    use RefreshDatabase;



    public function test_user_can_register_successfully(): void

    {use Illuminate\Database\Eloquent\Factories\Factory;    ];GET /api/ping

        $response = $this->postJson('/api/register', [

            'name' => 'Test User',use App\Models\Team;

            'email' => 'test@example.com',

            'password' => 'password123',```

            'password_confirmation' => 'password123',

            'sport_type' => 'football',class TeamFactory extends Factory

            'skill_level' => 'intermediate',

        ]);{    protected function casts(): array



        $response->assertStatus(201)    protected $model = Team::class;

            ->assertJsonStructure([

                'message',    {**Auth:** Nem kell token

                'user' => ['id', 'name', 'email', 'sport_type', 'skill_level'],

                'access_token',    public function definition(): array

                'token_type',

            ]);    {        return [



        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);        $this->faker = \Faker\Factory::create('hu_HU');

    }

                    'email_verified_at' => 'datetime',**Válasz (200):**

    public function test_register_fails_with_missing_fields(): void

    {        $colors = ['Piros', 'Kék', 'Zöld', 'Sárga', 'Fekete', 'Fehér'];

        $response = $this->postJson('/api/register', ['name' => 'Test User']);

        $response->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);        $animals = ['Tigrisek', 'Warriors', 'Dragons', 'Eagles', 'Lions', 'Sharks'];            'password' => 'hashed',```json

    }

        

    public function test_register_fails_with_duplicate_email(): void

    {        return [        ];{

        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->postJson('/api/register', [            'name' => $this->faker->randomElement($colors) . ' ' . $this->faker->randomElement($animals),

            'name' => 'Test User',

            'email' => 'test@example.com',            'sport_type' => $this->faker->randomElement(['football', 'basketball', 'volleyball', 'tennis']),    }  "status": "success",

            'password' => 'password123',

            'password_confirmation' => 'password123',            'max_members' => $this->faker->numberBetween(8, 20),

        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['email']);        ];  "message": "API is running",

    }

    }

    public function test_user_can_login_successfully(): void

    {}    public function teamMembers(): HasMany  "timestamp": "2025-12-04 10:30:00",

        User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);

        $response = $this->postJson('/api/login', ['email' => 'test@example.com', 'password' => 'password123']);```

        $response->assertStatus(200)->assertJsonStructure(['message', 'user', 'access_token', 'token_type']);

    }    {  "timezone": "Europe/Budapest"



    public function test_login_fails_with_wrong_password(): void### TeamSeeder létrehozása

    {

        User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('password123')]);        return $this->hasMany(TeamMember::class);}

        $response = $this->postJson('/api/login', ['email' => 'test@example.com', 'password' => 'wrongpassword']);

        $response->assertStatus(422);```bash

    }

Team-Sport> php artisan make:seeder TeamSeeder    }```

    public function test_authenticated_user_can_get_own_data(): void

    {```

        $user = User::factory()->create();

        $token = $user->createToken('test_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson('/api/me');

        $response->assertStatus(200)->assertJsonStructure(['user']);**database/seeders/TeamSeeder.php (módosítása):**

    }

    public function teams(): BelongsToMany**Mire jó:** Gyors ellenőrzés, hogy az API működik-e.

    public function test_user_can_logout_successfully(): void

    {```php

        $user = User::factory()->create();

        $token = $user->createToken('test_token')->plainTextToken;<?php    {

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson('/api/logout');

        $response->assertStatus(200)->assertJson(['message' => 'Logout successful']);

    }

}namespace Database\Seeders;        return $this->belongsToMany(Team::class, 'team_members')---

```



## TeamControllerTest létrehozása

use Illuminate\Database\Console\Seeds\WithoutModelEvents;            ->withPivot('joined_at', 'role')

```powershell

php artisan make:test TeamControllerTestuse Illuminate\Database\Seeder;

```

use App\Models\Team;            ->withTimestamps();### 2. Regisztráció - Új felhasználó létrehozása

### tests/Feature/TeamControllerTest.php

use App\Models\User;

```php

<?phpuse Illuminate\Support\Facades\Hash;    }



namespace Tests\Feature;



use Illuminate\Foundation\Testing\RefreshDatabase;class TeamSeeder extends Seeder}**Endpoint:**

use Tests\TestCase;

use App\Models\User;{

use App\Models\Team;

    public function run(): void``````http

class TeamControllerTest extends TestCase

{    {

    use RefreshDatabase;

        // 1. Igazi user létrehozása: mate / Mate123POST /api/register

    private function authenticatedUser()

    {        $mate = User::create([

        $user = User::factory()->create();

        $token = $user->createToken('test_token')->plainTextToken;            'name' => 'Máté',`Team-Sport>php artisan make:model Team -m````

        return ['user' => $user, 'token' => $token];

    }            'email' => 'mate@example.com',



    public function test_authenticated_user_can_get_teams_list(): void            'password' => Hash::make('Mate123'),

    {

        $auth = $this->authenticatedUser();            'sport_type' => 'football',

        Team::factory()->count(3)->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])->getJson('/api/teams');            'skill_level' => 'expert',**database/migrations/?_create_teams_table.php (módosítani kell):****Auth:** Nem kell token

        $response->assertStatus(200);

    }        ]);



    public function test_teams_list_fails_without_authentication(): void

    {

        $response = $this->getJson('/api/teams');        // 2. 10 fake user létrehozása Factory-val

        $response->assertStatus(401);

    }        $fakeUsers = User::factory()->count(10)->create();```php**Request Body:**



    public function test_authenticated_user_can_create_team(): void

    {

        $auth = $this->authenticatedUser();        // 3. Összes user (mate + 10 fake = 11 user)Schema::create('teams', function (Blueprint $table) {```json

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])

            ->postJson('/api/teams', ['name' => 'Test Warriors', 'sport_type' => 'football', 'max_members' => 15]);        $allUsers = collect([$mate])->merge($fakeUsers);

        $response->assertStatus(201)->assertJson(['message' => 'Team created successfully']);

        $this->assertDatabaseHas('teams', ['name' => 'Test Warriors']);    $table->id();{

    }

        // 4. 10 fake team létrehozása Factory-val

    public function test_authenticated_user_can_delete_team(): void

    {        $teams = Team::factory()->count(10)->create();    $table->string('name');  "name": "Kiss János",

        $auth = $this->authenticatedUser();

        $team = Team::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $auth['token']])->deleteJson("/api/teams/{$team->id}");

        $response->assertStatus(200)->assertJson(['message' => 'Team deleted successfully']);        // 5. Random kapcsolatok létrehozása users és teams között    $table->string('sport_type');  "email": "janos@example.com",

        $this->assertDatabaseMissing('teams', ['id' => $team->id]);

    }        $roles = ['captain', 'member', 'vice-captain'];

}

```            $table->integer('max_members')->default(10);  "password": "titkos123",



## Tesztek futtatása        $teams->each(function ($team) use ($allUsers, $roles) {



```powershell            // Minden csapathoz random 2-5 tag    $table->timestamps();  "password_confirmation": "titkos123",

php artisan test

```            $membersCount = rand(2, 5);



---            $selectedUsers = $allUsers->random(min($membersCount, $allUsers->count()));});  "sport_type": "football",



## Dokumentálás            



- **Markdown dokumentáció** - Projektleírás/fejlesztői dokumentáció            $selectedUsers->each(function ($user, $index) use ($team, $roles) {```  "skill_level": "intermediate"

- **POSTMAN collection** - Kész API tesztek (`TeamSport_API_READY.postman_collection.json`)

                $team->users()->attach($user->id, [

---

                    'role' => $index === 0 ? 'captain' : fake()->randomElement($roles),}

**Repository:** https://github.com/1tc-molmat/Team-Sport

                    'joined_at' => now()->subDays(rand(1, 365)),

**Készítette:** Máté  

**Verzió:** 1.0                  ]);**app/Models/Team.php (módosítani kell):**```

**Utolsó frissítés:** 2025-12-07

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
