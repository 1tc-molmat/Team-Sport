# Team Sport API

## Miről szól ez?

Csináltam egy REST API-t Laravel 11-ben, ahol csapatokat lehet kezelni. Bearer token-es bejelentkezéssel megy, és minden alapvető művelet (CRUD) megvan benne.

---

## Az adatbázis felépítése

Három fő táblát csináltam:

**users tábla**
- A szokásos user adatok + `sport_type` és `skill_level`
- Azért kellett, hogy később lehessen szűrni, hogy ki milyen sportot csinál, meg mennyire ügyes

**teams tábla**
- Csapat neve, milyen sportról van szó, max hány tag lehet benne
- Ez nyilván kell a csapatok létrehozásához meg kereséshez

**team_members tábla** (ez köti össze a user-eket meg a teameket)
- `user_id`, `team_id`, `role`, `joined_at`
- Így egy user lehet több csapatban is, és egy csapatnak is több tagja lehet

---

## Hogy működik a bejelentkezés?

Laravel Sanctum-ot használtam, Bearer token rendszerrel. Szóval:

Bejelentkezel → kapsz egy tokent → azt elmented → minden kérésnél beküldöd a headerben → az API megnézi hogy valid-e → ha igen, visszaküldi az adatokat.

Van pár dolog ami publikus (nem kell token):
- `/register`, `/login`, `/ping`

A többi meg védett (kell token):
- `/me`, `/logout`, `/teams/*`

---

## Az API végpontok

Összesen 11 végpont van:

### Bejelentkezés/Regisztráció
```
POST   /api/register    → Regisztrálsz, kapsz egy tokent
POST   /api/login       → Bejelentkezel, kapsz egy tokent
GET    /api/me          → Lekéred a saját adataidat (kell token)
POST   /api/logout      → Kijelentkezel, törlődik a token (kell token)
GET    /api/ping        → Megnézed, hogy él-e az API
```

### Csapat műveletek
```
GET    /api/teams       → Az összes csapat listája (kell token)
POST   /api/teams       → Új csapat létrehozása (kell token)
GET    /api/teams/{id}  → Egy konkrét csapat adatai (kell token)
PUT    /api/teams/{id}  → Csapat teljes frissítése (kell token)
PATCH  /api/teams/{id}  → Csapat részleges frissítése (kell token)
DELETE /api/teams/{id}  → Csapat törlése (kell token)
```

---

## Milyen fájlokat csináltam?

### Adatbázis dolgok
```
migrations/
  - create_users_table.php - módosítottam, beletettém a sport_type-ot meg skill_level-t
  - create_teams_table.php - új, a csapatok táblája
  - create_team_members_table.php - új, ez köti össze a usereket a csapatokkal

models/
  - User.php - hozzáadtam a HasApiTokens-t meg a kapcsolatokat
  - Team.php - új model a csapatokhoz
  - TeamMember.php - pivot model, hogy könnyebb legyen kezelni a kapcsolatokat

factories/
  - UserFactory.php - fake user-ek generálása, magyar nevekkel
  - TeamFactory.php - fake csapatnevek generálása

seeders/
  - TeamSeeder.php - feltölti az adatbázist: 1 igazi user (én) + 10 faker user + csapatok
```

### API fájlok
```
controllers/Api/
  - AuthController.php - register, login, logout, me végpontok
  - TeamController.php - összes csapat művelet (CRUD)

resources/
  - UserResource.php - JSON válasz formázás user-ekhez
  - TeamResource.php - JSON válasz formázás csapatokhoz

routes/
  - api.php - az összes végpont itt van definiálva
```

---

## Hogy indítom el?

```bash
# 1. Először az adatbázis
php artisan migrate
php artisan db:seed

# 2. Aztán a szerver
php artisan serve

# 3. Postmanben importálod be:
# TeamSport_API_READY.postman_collection.json
# Első lépés: "1. Login (Máté) - START HERE!"
```

**Bejelentkezési adatok:**
- Email: `mate@example.com`
- Jelszó: `Mate123`

---

## Pár technikai dolog amit használtam

### Foreign Key Cascade
```php
foreignId('team_id')->constrained()->onDelete('cascade')
```
Ha törlök egy csapatot, automatikusan törlődnek a hozzá tartozó tagok is a team_members táblából.

### Eager Loading
```php
Team::with('users')->get(); // 2 query összesen
// vs
Team::all(); foreach... ->users; // 1 + N query (lassú)
```
Ez azért kell, mert különben minden csapatnál külön lekérné a tagjait, az meg lassú lenne.

### API Resource
- Elrejtem a password-öt meg a remember_token-t
- Szép, strukturált JSON válasz
- Könnyen testreszabhatom, hogy mi menjen vissza

### Route Model Binding
```php
public function show(Team $team) // Laravel automatikusan megkeresi az ID alapján
```
Nem kell kézzel lekérdezni, Laravel megcsinálja helyettem.

### Mass Assignment védelem
```php
protected $fillable = ['name', 'email']; // Csak ezeket lehet módosítani
```
Biztonsági okokból nem minden mezőt lehet módosítani egyszerre.

---

## A fake adatokról

A seeder generál nekem tesztelési adatokat:
- 1 igazi user: én vagyok (mate@example.com / Mate123)
- 10 faker user (jelszavuk: `password`)
- 10 faker csapat
- Kb 38 kapcsolat random (minden csapatban 2-5 tag van)

Azért csináltam így, mert teszteléshez kellenek adatok, és nem akartam kézzel beírni mindent. Magyar neveket generál, mert átállítottam a faker locale-t `hu_HU`-ra.

---

## Beállítások

A `.env` fájlban ezeket állítottam be:
```env
APP_TIMEZONE=Europe/Budapest  # Magyar időzóna
APP_LOCALE=hu                 # Magyar nyelv
APP_FAKER_LOCALE=hu_HU        # Faker magyar neveket generál
```

---

## Biztonság

Mit csináltam biztonsági szempontból:
- Jelszavak hashelve vannak (bcrypt)
- Bearer token authentikáció
- Minden input validálva van
- Foreign key constraints az adatbázisban
- Mass assignment védelem (csak meghatározott mezők módosíthatók)
- SQL injection védelem (Eloquent használata miatt)

---

## Egy tipikus használat menete

Így néz ki, ha használod:

```
1. Bejelentkezel
   POST /api/login
   Body: { email, password }
   Válasz: { user, access_token }

2. Elmented a tokent (Postmanben ez automatikus)

3. Csinálsz egy csapatot
   POST /api/teams
   Header: Authorization: Bearer {token}
   Body: { name, sport_type, max_members }
   Válasz: { message, data: {...} }

4. Lekéred a csapatokat
   GET /api/teams
   Header: Authorization: Bearer {token}
   Válasz: { data: [...] }
```

---

## Validációk

Mit ellenőrzök a bemeneti adatoknál:

**Regisztrációnál:**
- email: kötelező, email formátum, egyedi legyen
- password: kötelező, min 8 karakter, megerősítés kell

**Csapat létrehozásnál:**
- name: kötelező, max 255 karakter
- sport_type: kötelező, max 255 karakter
- max_members: opcionális, 1-100 között lehet

**PUT vs PATCH különbség:**
- PUT: minden mezőt kötelező küldeni
- PATCH: csak amit módosítani akarsz

---

## Postman használat

Csináltam egy kész Postman collection-t: `TeamSport_API_READY.postman_collection.json`

Hogy működik:
1. Importálod be a fájlt Postmanbe
2. Futtatod a "1. Login (Máté) - START HERE!" kérést
3. A token automatikusan el van mentve
4. Használod bármelyik Teams végpontot

Amit már beállítottam:
- `base_url`: `http://localhost:8000/api`
- Token automatikus mentés (test script)
- Random email/név generálás regisztrációhoz: `{{$randomInt}}`

---

## Mi van meg ebben?

**Adatbázis:** 4 tábla, kapcsolatok, foreign key-k  
**API:** 11 végpont (2 publikus + 9 védett)  
**Authentikáció:** Sanctum Bearer token  
**CRUD:** Create, Read, Update (PUT/PATCH), Delete  
**Seeders:** 11 user + 10 csapat + kapcsolatok  
**Postman:** Kész collection, azonnal használható  
**Tesztek:** 27 automated test (mind zöld)

---

## Összefoglalva

Szóval ez egy működő Laravel REST API:
- Bearer token bejelentkezés ✅
- Összes CRUD művelet ✅
- Minden validálva ✅
- Fake adatokkal feltöltve ✅
- Postman collection kész ✅
- Tesztek megvannak ✅

Használat:
1. `php artisan serve`
2. Postman megnyitása
3. Login → Token → Csapat műveletek

Ennyi, kész! 🚀
