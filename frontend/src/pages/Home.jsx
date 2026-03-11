import { useEffect, useState } from "react";
import EquipmentCard from "../components/EquipmentCard";

function Home() {
  const [equipment, setEquipment] = useState([]);
  const [selectedType, setSelectedType] = useState("all");

  const fetchEquipment = () => {
    fetch("http://127.0.0.1:8000/api/equipment")
      .then((res) => res.json())
      .then((data) => setEquipment(data))
      .catch((error) => console.error(error));
  };

  useEffect(() => {
    fetchEquipment();
  }, []);

  const filteredEquipment =
    selectedType === "all"
      ? equipment
      : equipment.filter((item) => item.type === selectedType);

  return (
    <div
      style={{
        maxWidth: "1200px",
        margin: "0 auto",
        padding: "40px 20px"
      }}
    >
      <h1
        style={{
          textAlign: "center",
          marginBottom: "10px",
          fontSize: "36px"
        }}
      >
        Iznajmljivanje opreme
      </h1>

      <p
        style={{
          textAlign: "center",
          color: "#6b7280",
          marginBottom: "30px"
        }}
      >
        Izaberi opremu koju želiš da rezervišeš
      </p>

      <div
        style={{
          display: "flex",
          justifyContent: "center",
          flexWrap: "wrap",
          gap: "10px",
          marginBottom: "30px"
        }}
      >
        <button onClick={() => setSelectedType("all")}>Sve</button>
        <button onClick={() => setSelectedType("bicycle")}>Bicikli</button>
        <button onClick={() => setSelectedType("electric_bike")}>Električni bicikli</button>
        <button onClick={() => setSelectedType("scooter")}>Trotineti</button>
        <button onClick={() => setSelectedType("electric_scooter")}>Električni trotineti</button>
        <button onClick={() => setSelectedType("roller")}>Roleri</button>
      </div>

      <div
        style={{
          display: "grid",
          gridTemplateColumns: "repeat(3, 1fr)",
          gap: "20px",
          marginTop: "30px",
          alignItems: "stretch"
        }}
      >
       {filteredEquipment.length === 0 ? (
  <p style={{ gridColumn: "1 / -1", textAlign: "center" }}>
    Trenutno nema dostupne opreme za ovaj tip.
  </p>
) : (
  filteredEquipment.map((item) => (
    <EquipmentCard
      key={item.id}
      item={item}
      refreshEquipment={fetchEquipment}
    />
  ))
)}
      </div>
    </div>
  );
}

export default Home;