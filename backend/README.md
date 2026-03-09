# Rent-a-Bike Backend

Ovo je backend deo aplikacije za iznajmljivanje opreme razvijen u Laravel framework-u. Sistem omogućava registraciju i prijavu korisnika, pregled dostupne opreme i kreiranje rezervacija.

## Tehnologije
- Laravel
- PHP
- MySQL
- Laravel Sanctum
- Thunder Client

## Modeli
- User
- Equipment
- Reservation
- Payment
- Location
- Document

## API rute

### Auth
- POST `/api/register`
- POST `/api/login`
- POST `/api/logout`

### Equipment
- GET `/api/equipment`
- GET `/api/equipment/{id}`
- POST `/api/equipment`
- PUT `/api/equipment/{id}`
- DELETE `/api/equipment/{id}`

### Reservations
- GET `/api/reservations`
- POST `/api/reservations`

## Autentifikacija
Za autentifikaciju je korišćen Laravel Sanctum. Za pristup zaštićenim rutama koristi se Bearer token.

## Funkcionalnosti
- registracija korisnika
- prijava korisnika
- odjava korisnika
- pregled opreme
- dodavanje opreme
- izmena opreme
- brisanje opreme
- kreiranje rezervacije
- pregled rezervacija