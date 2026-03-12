import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";

function LocationMap() {
  const center = [44.8176, 20.4633];

  const locations = [
    {
      id: 1,
      name: "Dorćol",
      address: "Cara Dušana, Beograd",
      latitude: 44.8256,
      longitude: 20.4653,
    },
    {
      id: 2,
      name: "Novi Beograd",
      address: "Bulevar Zorana Đinđića, Beograd",
      latitude: 44.8125,
      longitude: 20.4173,
    },
    {
      id: 3,
      name: "Zemun",
      address: "Glavna ulica, Zemun",
      latitude: 44.8433,
      longitude: 20.4019,
    },
  ];

  return (
    <div
      style={{
        height: "400px",
        width: "100%",
        marginTop: "40px",
        borderRadius: "12px",
        overflow: "hidden",
      }}
    >
      <MapContainer
        center={center}
        zoom={12}
        scrollWheelZoom={true}
        style={{ height: "100%", width: "100%" }}
      >
        <TileLayer
          attribution='&copy; OpenStreetMap contributors'
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
        />

        {locations.map((location) => (
          <Marker
            key={location.id}
            position={[location.latitude, location.longitude]}
          >
            <Popup>
              <strong>{location.name}</strong>
              <br />
              {location.address}
            </Popup>
          </Marker>
        ))}
      </MapContainer>
    </div>
  );
}

export default LocationMap;