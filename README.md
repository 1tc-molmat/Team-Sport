# Team Sport API

## Mi ez?

Ez egy Laravel API amit csináltam, hogy csapatokat lehessen kezelni. REST API, Bearer token authentikációval.

## Gyors start

```bash
# Telepítés
composer install

# .env beállítása
cp .env.example .env
php artisan key:generate

# Adatbázis
php artisan migrate
php artisan db:seed

# Szerver indítás
php artisan serve
```

Ezután a `http://localhost:8000/api`-n fut az API.

## Tesztelés

Postmanben importáld be: `TeamSport_API_READY.postman_collection.json`

Login adatok:
- Email: `mate@example.com`
- Jelszó: `Mate123`

## Végpontok

### Publikus (nem kell token)
- `POST /api/register` - Regisztráció
- `POST /api/login` - Bejelentkezés
- `GET /api/ping` - Health check

### Védett (kell token)
- `GET /api/me` - Saját adatok
- `POST /api/logout` - Kijelentkezés
- `GET /api/teams` - Csapatok listája
- `POST /api/teams` - Új csapat
- `GET /api/teams/{id}` - Egy csapat
- `PUT /api/teams/{id}` - Csapat frissítés (teljes)
- `PATCH /api/teams/{id}` - Csapat frissítés (részleges)
- `DELETE /api/teams/{id}` - Csapat törlés

## Adatbázis

3 fő tábla:
- **users** - Felhasználók (+ sport_type, skill_level)
- **teams** - Csapatok
- **team_members** - Ki melyik csapatban van

## Tesztek futtatása

```bash
php artisan test
```

Jelenleg 27 teszt van, mind zöld. ✅

## Technológiák

- Laravel 11
- Laravel Sanctum (Bearer token auth)
- SQLite adatbázis (átállítható MySQL-re)
- PHPUnit tesztek
- Faker adatgenerálás (magyar locale)

## Fake adatok

A seeder generál:
- 1 igazi user: én (mate@example.com / Mate123)
- 10 faker user (jelszó: `password`)
- 10 faker csapat
- Random kapcsolatok (2-5 tag/csapat)

## Példa használat

### 1. Bejelentkezés
```bash
POST http://localhost:8000/api/login
Content-Type: application/json

{
  "email": "mate@example.com",
  "password": "Mate123"
}
```

Válasz:
```json
{
  "message": "Login successful",
  "user": { ... },
  "access_token": "1|...",
  "token_type": "Bearer"
}
```

### 2. Csapat létrehozás
```bash
POST http://localhost:8000/api/teams
Authorization: Bearer {token}
Content-Type: application/json

{
  "name": "Piros Csapat",
  "sport_type": "football",
  "max_members": 15
}
```

### 3. Csapatok listázása
```bash
GET http://localhost:8000/api/teams
Authorization: Bearer {token}
```

## Konfiguráció

A `.env` fájlban:
```env
APP_TIMEZONE=Europe/Budapest
APP_LOCALE=hu
APP_FAKER_LOCALE=hu_HU
```

## Dokumentáció

További infó:
- `GYORS_ATTEKINTES.md` - Részletes áttekintés
- `TeamSport_API_READY.postman_collection.json` - Postman collection

## Licenc

Ez egy saját projekt, csináld vele amit akarsz.
