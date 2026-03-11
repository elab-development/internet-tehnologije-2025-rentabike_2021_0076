\# internet-tehnologije-2025-rentabike_2021_0076

Aplikacija za iznajmljivanje bicikala, trotineta i rolera razvijena u okviru predmeta Internet tehnologije.
Korisnici mogu da pregledaju dostupnu opremu, naprave rezervaciju za određeni vremenski period i upravljaju svojim rezervacijama.

Struktura projekta

projekat/

├── backend/ Laravel API
├── frontend/ React aplikacija
└── README.md

Tehnologije

Backend:

PHP 8

Laravel 11

Laravel Sanctum

MySQL

Frontend:

React

Vite

React Router

DevOps:

Docker

Docker Compose

Dokumentacija:

Swagger (L5 Swagger)

Funkcionalnosti aplikacije

Aplikacija omogućava:

registraciju korisnika

login korisnika

pregled dostupne opreme

rezervaciju opreme

pregled sopstvenih rezervacija

otkazivanje rezervacije

Logika rada aplikacije:

Kada korisnik napravi rezervaciju:

rezervacija se upisuje u bazu

oprema postaje nedostupna (is_available = false)

Kada korisnik otkaže rezervaciju:

rezervacija se briše

oprema ponovo postaje dostupna (is_available = true)

API dokumentacija

API je dokumentovan pomoću Swagger alata.

Swagger dokumentacija dostupna je na:

http://localhost:8000/api/documentation

Dokumentovane rute:

POST /api/login
GET /api/equipment
GET /api/reservations
POST /api/reservations
DELETE /api/reservations/{id}

Pokretanje projekta pomoću Dockera

Za pokretanje projekta potrebno je imati instaliran:

Docker

Docker Compose

Pokretanje aplikacije:

docker compose up --build

Nakon pokretanja aplikacije:

Frontend aplikacija:
http://localhost:5173

Backend API:
http://localhost:8000

Swagger dokumentacija:
http://localhost:8000/api/documentation

Pokretanje projekta bez Dockera

Backend:

cd backend
composer install
php artisan migrate
php artisan serve

Frontend:

cd frontend
npm install
npm run dev

Autor

Student:
Projekat iz predmeta Internet tehnologije