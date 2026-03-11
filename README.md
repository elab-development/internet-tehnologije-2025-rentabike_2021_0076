# internet-tehnologije-2025-rentabike_2021_0076

## Opis projekta

Ovo je web aplikacija za iznajmljivanje opreme za rekreaciju kao što su:

* bicikli
* električni bicikli
* trotineti
* električni trotineti
* roleri

Aplikacija omogućava pregled dostupne opreme, rezervaciju opreme i upravljanje opremom od strane administratora ili zaposlenih.

Projekat je razvijen kao seminarski rad iz predmeta **Internet tehnologije**.

---

# Arhitektura sistema

Projekat je podeljen na dva dela:

**Backend**

* Laravel REST API

**Frontend**

* React aplikacija

Komunikacija između frontend i backend dela se vrši putem **REST API-ja**.

---

# Tehnologije

## Backend

* PHP 8
* Laravel 11
* MySQL
* Laravel Sanctum (autentifikacija)
* Swagger (API dokumentacija)

## Frontend

* React
* Vite
* Chart.js (vizualizacija statistike)
* Leaflet / OpenStreetMap (mapa)

## DevOps

* Docker
* Git
* GitHub Actions (CI/CD)
* Render (cloud deployment)

---

# Struktura projekta

```
projekat/
│
├── backend/        # Laravel API
│
├── frontend/       # React aplikacija
│
├── docker-compose.yml
│
└── README.md
```

---

# Pokretanje aplikacije lokalno

## Backend (Laravel)

```
cd backend
composer install
php artisan migrate
php artisan serve
```

Backend će biti dostupan na:

```
http://127.0.0.1:8000
```

---

## Frontend (React)

```
cd frontend
npm install
npm run dev
```

Frontend će biti dostupan na:

```
http://localhost:5173
```

---

# Funkcionalnosti aplikacije

* pregled dostupne opreme
* filtriranje opreme po tipu
* rezervacija opreme
* pregled korisničkih rezervacija
* otkazivanje rezervacije
* administracija opreme (admin/employee)

---

# Eksterni API servisi

Projekat koristi dva eksterna API-ja:

1. **Leaflet / OpenStreetMap API**
   koristi se za prikaz mape i lokacije opreme.

2. **Chart.js API**
   koristi se za grafički prikaz statistike rezervacija.

---

# Vizualizacija podataka

U aplikaciji je implementirana vizualizacija podataka koja prikazuje:

* broj dostupne opreme
* broj rezervacija
* grafički prikaz statistike

Za prikaz se koristi **Chart.js** biblioteka.

---

# Bezbednost aplikacije

Implementirane su sledeće bezbednosne zaštite:

* **Autentifikacija** korišćenjem Laravel Sanctum
* **Autorizacija** pomoću role middleware-a (customer, admin, employee)
* **Validacija zahteva** putem Laravel request validation
* **CORS zaštita** za kontrolu pristupa API-ju

---

# Automatizovani testovi

Projekat sadrži automatizovane testove za proveru API funkcionalnosti.

Primer testova:

* Equipment API test
* Reservation API test

Pokretanje testova:

```
php artisan test
```

---

# CI/CD Pipeline

Projekat koristi **GitHub Actions** za automatsko pokretanje testova.

Pipeline se pokreće prilikom:

* push događaja
* pull request-a

Pipeline izvršava:

1. instalaciju dependencies
2. pokretanje migracija
3. pokretanje automatizovanih testova

---

# Cloud deployment

Frontend aplikacija je postavljena na cloud platformu **Render**.

Aplikaciji se može pristupiti na sledećem linku:

https://rentabike-frontend.onrender.com

Deploy je povezan sa GitHub repozitorijumom i omogućava automatsko ažuriranje aplikacije nakon novih izmena u kodu.

---

# Git workflow

Projekat koristi sledeće grane:

* **main** – stabilna verzija aplikacije
* **develop** – integraciona grana
* **feature/api** – razvoj API funkcionalnosti

---

# Autor

Projekat je razvijen u okviru kursa **Internet tehnologije**.
