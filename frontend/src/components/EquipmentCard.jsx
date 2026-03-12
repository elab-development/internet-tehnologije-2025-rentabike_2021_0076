function EquipmentCard({ item, refreshEquipment }) {

  const typeLabels = {
    bicycle: "Bicikl",
    electric_bike: "Električni bicikl",
    scooter: "Trotinet",
    electric_scooter: "Električni trotinet",
    roller: "Roleri"
  };

  const getIcon = (type) => {
    if (type === "bicycle") return "🚲";
    if (type === "electric_bike") return "⚡🚲";
    if (type === "scooter") return "🛴";
    if (type === "electric_scooter") return "⚡🛴";
    if (type === "roller") return "🛼";
    return "📦";
  };

  const rezervisi = async (equipmentId) => {
    console.log("kliknuto dugme", equipmentId);

    const token = localStorage.getItem("token");

    try {
      const response = await fetch("http://127.0.0.1:8000/api/reservations", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "Authorization": "Bearer " + token
        },
        body: JSON.stringify({
          bike_id: equipmentId,
          start_date: "2026-06-01",
          end_date: "2026-06-02",
          total_price: 1000
        })
      });

      const data = await response.json();

      console.log("STATUS:", response.status);
      console.log("ODGOVOR:", data);

      if (response.ok) {
        alert("Rezervacija poslata!");
        refreshEquipment();
      } else {
        alert(data.message || "Greška pri rezervaciji.");
      }

    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div
      style={{
        border: "1px solid #e5e7eb",
        borderRadius: "14px",
        padding: "20px",
        backgroundColor: "#ffffff",
        boxShadow: "0 4px 12px rgba(0,0,0,0.08)",
        display: "flex",
        flexDirection: "column",
        justifyContent: "space-between"
      }}
    >

      <div>

        <h3 style={{ marginBottom: "10px", fontSize: "20px" }}>
          {getIcon(item.type)} {item.name}
        </h3>

        <p style={{ margin: "6px 0" }}>
          <strong>Proizvođač:</strong> {item.brand}
        </p>

        <p style={{ margin: "6px 0" }}>
          <strong>Tip opreme:</strong> {typeLabels[item.type] || item.type}
        </p>

        <p style={{ margin: "6px 0" }}>
          <strong>Cena po satu:</strong> {item.price_per_hour} RSD / sat
        </p>

        {item.description && (
          <p style={{ marginTop: "10px", color: "#6b7280" }}>
            {item.description}
          </p>
        )}

      </div>

      <button
        onClick={() => rezervisi(item.id)}
        style={{
          marginTop: "15px",
          padding: "10px",
          borderRadius: "8px",
          border: "none",
          backgroundColor: "#2563eb",
          color: "white",
          fontWeight: "bold",
          cursor: "pointer"
        }}
      >
        Rezerviši
      </button>

    </div>
  );
}

export default EquipmentCard;