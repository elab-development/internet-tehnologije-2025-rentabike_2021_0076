import { useEffect, useState } from "react";

function Reservations() {
  const [reservations, setReservations] = useState([]);

  const fetchReservations = () => {
    const token = localStorage.getItem("token");

    fetch("http://127.0.0.1:8000/api/reservations", {
      headers: {
        "Accept": "application/json",
        "Authorization": "Bearer " + token
      }
    })
      .then(res => res.json())
      .then(data => {
        if (Array.isArray(data)) {
          setReservations(data);
        } else {
          console.log("API nije vratio niz:", data);
          setReservations([]);
        }
      })
      .catch(error => console.error(error));
  };

  useEffect(() => {
    fetchReservations();
  }, []);

  const otkaziRezervaciju = async (id) => {
    const token = localStorage.getItem("token");

    try {
      const response = await fetch(`http://127.0.0.1:8000/api/reservations/${id}`, {
        method: "DELETE",
        headers: {
          "Accept": "application/json",
          "Authorization": "Bearer " + token
        }
      });

      const data = await response.json();

      if (response.ok) {
        alert("Rezervacija je otkazana.");
        fetchReservations();
      } else {
        alert(data.message || "Greška pri otkazivanju rezervacije.");
      }
    } catch (error) {
      console.error(error);
      alert("Došlo je do greške.");
    }
  };

  return (
    <div style={{ padding: "40px", maxWidth: "900px", margin: "0 auto" }}>
      <h1 style={{ marginBottom: "30px" }}>Moje rezervacije</h1>

      {reservations.length === 0 && <p>Nema rezervacija.</p>}

      {reservations.map((r) => (
        <div
          key={r.id}
          style={{
            border: "1px solid #ddd",
            borderRadius: "12px",
            padding: "20px",
            marginBottom: "15px",
            boxShadow: "0 4px 10px rgba(0,0,0,0.08)",
            backgroundColor: "#fff"
          }}
        >
          <p><strong>ID rezervacije:</strong> {r.id}</p>
          <p><strong>Oprema:</strong> {r.equipment?.name}</p>
          <p><strong>Datum početka:</strong> {r.start_date}</p>
          <p><strong>Datum kraja:</strong> {r.end_date}</p>
          <p><strong>Status:</strong> {r.status}</p>

          <button
            onClick={() => otkaziRezervaciju(r.id)}
            style={{
              marginTop: "15px",
              padding: "10px 16px",
              border: "none",
              borderRadius: "8px",
              backgroundColor: "#dc2626",
              color: "white",
              fontWeight: "bold",
              cursor: "pointer"
            }}
          >
            Otkaži rezervaciju
          </button>
        </div>
      ))}
    </div>
  );
}

export default Reservations;