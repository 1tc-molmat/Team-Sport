# Team Sport API - Gyors Áttekintés

## 🎯 Mi ez?

Laravel 11 REST API csapatok kezeléséhez. Bearer token authentikáció, CRUD műveletek.

---

## 📊 Adatbázis

### 3 fő tábla:

**users**
- Alap user adatok + `sport_type`, `skill_level`
- Miért kell: Szűrés, hasonló érdeklődésűek

**teams**
- Csapat neve, sport típus, max tagszám
- Miért kell: Csapat létrehozás, keresés

**team_members** (kapcsolótábla)
- `user_id`, `team_id`, `role`, `joined_at`
- Miért kell: 1 user több csapat, 1 csapat több user

---

## 🔐 Authentikáció

**Laravel Sanctum** - Bearer token rendszer

```
Login → Token generálás → Token mentése
Request → Header: Bearer {token} → Token ellenőrzés → Válasz
```

**Védett vs Nyilvános:**
- Nyilvános: `/register`, `/login`, `/ping`
- Védett: `/me`, `/logout`, `/teams/*`

---

## 🎮 API Endpointok (11 db)

### Authentikáció
```
POST   /api/register    → Regisztráció + token
POST   /api/login       → Bejelentkezés + token
GET    /api/me          → User adatai (🔒)
POST   /api/logout      → Token törlése (🔒)
GET    /api/ping        → API működik-e?
```

### Teams CRUD
```
GET    /api/teams       → Összes csapat (🔒)
POST   /api/teams       → Új csapat (🔒)
GET    /api/teams/{id}  → Egy csapat (🔒)
PUT    /api/teams/{id}  → Teljes update (🔒)
PATCH  /api/teams/{id}  → Részleges update (🔒)
DELETE /api/teams/{id}  → Törlés (🔒)
```

---

## 📁 Fájlok (amit én csináltam)

### Adatbázis
```
migrations/
  - create_users_table.php (módosítva: +sport_type, +skill_level)
  - create_teams_table.php (új)
  - create_team_members_table.php (új, foreign keys)

models/
  - User.php (HasApiTokens, kapcsolatok)
  - Team.php (HasFactory, kapcsolatok)
  - TeamMember.php (pivot model)

factories/
  - UserFactory.php (faker magyar adatok)
  - TeamFactory.php (faker csapatnevek)

seeders/
  - TeamSeeder.php (1 igazi user + 10 fake + kapcsolatok)
```

### API
```
controllers/Api/
  - AuthController.php (register, login, logout, me)
  - TeamController.php (index, store, show, update, partialUpdate, destroy)

resources/
  - UserResource.php (JSON formázás, pivot adatok)
  - TeamResource.php (JSON formázás, members_count)

routes/
  - api.php (összes endpoint, middleware)
```

---

## 🚀 Gyors Indítás

```bash
# 1. Adatbázis
php artisan migrate
php artisan db:seed

# 2. Szerver
php artisan serve

# 3. Postman
# Import: TeamSport_API_READY.postman_collection.json
# Első lépés: "1. Login (Máté) - START HERE!"
```

**Login adatok:**
- Email: `mate@example.com`
- Jelszó: `Mate123`

---

## 🔑 Fontos Koncepciók

### 1. Foreign Key Cascade
```php
foreignId('team_id')->constrained()->onDelete('cascade')
```
Ha törlődik a team → törlődnek a team_members is.

### 2. Eager Loading (N+1 probléma ellen)
```php
Team::with('users')->get(); // 2 query
// vs
Team::all(); foreach... ->users; // 1 + N query
```

### 3. API Resource (biztonság)
- Elrejti a password-ot, remember_token-t
- Strukturált JSON válasz
- Testreszabható mezők

### 4. Route Model Binding
```php
public function show(Team $team) // Laravel auto-megkeresi
```

### 5. Mass Assignment Protection
```php
protected $fillable = ['name', 'email']; // Csak ezek módosíthatók
```

---

## 🎲 Fake Adatok

**Mit generált a seeder:**
- 1 valódi user: Máté (mate@example.com / Mate123)
- 10 faker user (jelszó: `password`)
- 10 faker csapat
- ~38 kapcsolat (random 2-5 tag/csapat)

**Miért:**
- Teszteléshez kell adat
- Magyar nevek (faker `hu_HU`)
- Nem kell kézzel írni

---

## 🌍 Beállítások

**.env:**
```env
APP_TIMEZONE=Europe/Budapest  # Magyar idő
APP_LOCALE=hu                 # Magyar nyelv
APP_FAKER_LOCALE=hu_HU        # Magyar faker adatok
```

---

## 🔒 Biztonság

✅ Password hashing (bcrypt)  
✅ Bearer token auth  
✅ Validációk minden inputra  
✅ Foreign key constraints  
✅ Mass assignment védelem  
✅ SQL injection védelem (Eloquent)

---

## 📝 Workflow Példa

```
1. POST /api/login
   Body: { email, password }
   → Válasz: { user, access_token }

2. Token mentése

3. POST /api/teams
   Header: Authorization: Bearer {token}
   Body: { name, sport_type, max_members }
   → Válasz: { message, data: {...} }

4. GET /api/teams
   Header: Authorization: Bearer {token}
   → Válasz: { data: [...] }
```

---

## 🎯 Validációk

**Register:**
- email: kötelező, email formátum, egyedi
- password: kötelező, min 8 karakter, megerősítés

**Create Team:**
- name: kötelező, max 255
- sport_type: kötelező, max 255
- max_members: opcionális, 1-100 között

**PUT vs PATCH:**
- PUT: MINDEN mező kötelező
- PATCH: csak a küldött mezők kötelezők

---

## 📦 Postman Használat

**Fájl:** `TeamSport_API_READY.postman_collection.json`

**Lépések:**
1. Import a fájlt Postmanba
2. Futtasd: "1. Login (Máté) - START HERE!"
3. Token automatikusan mentve
4. Használd bármelyik Teams endpoint-ot

**Fontos:**
- `base_url` már be van állítva: `http://localhost:8000/api`
- Token auto-save van (test script)
- Random email/név generálás: `{{$randomInt}}`

---

## 🛠️ Laravel Best Practices

✅ RESTful API design  
✅ API Resources  
✅ Eager Loading  
✅ Route Model Binding  
✅ Factory Pattern  
✅ Middleware  
✅ Token Authentication (Sanctum)

---

## 📚 Dokumentációs Fájlok

- `POSTMAN_REQUESTS.md` - Csak az adatok, semmi extra
- `TELJES_MAGYARAZAT.md` - Részletes (6000+ sor)
- `FAKER_DATA_INFO.md` - Fake adatok infó
- `QUICK_START.md` - Gyors indítás
- `TeamSport_API_READY.postman_collection.json` - Kész collection

---

## ✅ Mi van kész?

**Adatbázis:** 4 tábla, kapcsolatok, foreign keys  
**API:** 11 endpoint (2 public + 9 protected)  
**Authentikáció:** Sanctum Bearer token  
**CRUD:** Create, Read, Update (PUT/PATCH), Delete  
**Seeders:** 11 user + 10 team + kapcsolatok  
**Postman:** Kész collection, működik azonnal  
**Dokumentáció:** 5 MD fájl  

---

## 🎓 Összefoglalás

Ez egy **production-ready Laravel REST API**:
- Bearer token auth ✅
- CRUD műveletek ✅
- Validációk ✅
- Fake adatok ✅
- Postman collection ✅
- Dokumentáció ✅

**Működik, biztonságos, tesztelhető.**

**Használd:**
1. Indítsd a szervert (`php artisan serve`)
2. Nyisd a Postman-t
3. Login → Token → Teams műveletek

**Kész! 🚀**
