import { useEffect, useState } from "react";
import EquipmentCard from "../components/EquipmentCard";

function Home() {
  const [equipment, setEquipment] = useState([]);

  const fetchEquipment = () => {
    fetch("http://127.0.0.1:8000/api/equipment")
      .then((res) => res.json())
      .then((data) => setEquipment(data))
      .catch((error) => console.error(error));
  };

  useEffect(() => {
    fetchEquipment();
  }, []);

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
          display: "grid",
          gridTemplateColumns: "repeat(auto-fit, minmax(250px, 1fr))",
          gap: "20px",
          marginTop: "30px"
        }}
      >
        {equipment.map((item) => (
          <EquipmentCard
            key={item.id}
            item={item}
            refreshEquipment={fetchEquipment}
          />
        ))}
      </div>
    </div>
  );
}

export default Home;