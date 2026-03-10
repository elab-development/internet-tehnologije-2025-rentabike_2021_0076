import { Link } from "react-router-dom";

function Navbar() {
  return (
    <nav style={{
      background: "#222",
      padding: "15px",
      display: "flex",
      gap: "20px"
    }}>
      <Link to="/" style={{ color: "white" }}>Početna</Link>
      <Link to="/login" style={{ color: "white" }}>Prijava</Link>
      <Link to="/reservations" style={{ color: "white" }}>Moje rezervacije</Link>
    </nav>
  );
}

export default Navbar;