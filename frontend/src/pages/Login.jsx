import { useState } from "react";
import { useNavigate } from "react-router-dom";

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [poruka, setPoruka] = useState("");

  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify({
          email: email,
          password: password,
        }),
      });

      const data = await response.json();

      if (response.ok) {
        localStorage.setItem("token", data.token);
        setPoruka("Uspešna prijava.");
        navigate("/");
      } else {
        setPoruka("Prijava nije uspela.");
      }
    } catch (error) {
      console.error(error);
      setPoruka("Došlo je do greške.");
    }
  };

  return (
    <div
      style={{
        maxWidth: "1800px",
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
        Prijava korisnika
      </h1>

      <p
        style={{
          textAlign: "center",
          color: "#6b7280",
          marginBottom: "30px"
        }}
      >
        Unesi svoje podatke za pristup aplikaciji
      </p>

    <div
  style={{
    width: "100%",
    backgroundColor: "#ffffff",
    border: "1px solid #e5e7eb",
    borderRadius: "14px",
    padding: "30px",
    boxShadow: "0 4px 12px rgba(0,0,0,0.08)",
    boxSizing: "border-box"
  }}
>
        <form onSubmit={handleLogin}>
          <div style={{ marginBottom: "20px" }}>
            <label style={{ fontWeight: "bold" }}>Email:</label>
            <br />
            <input
              type="email"
              placeholder="Unesite email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              style={{
                width: "100%",
                marginTop: "8px",
                padding: "12px",
                borderRadius: "8px",
                border: "1px solid #d1d5db",
                boxSizing: "border-box"
              }}
            />
          </div>

          <div style={{ marginBottom: "20px" }}>
            <label style={{ fontWeight: "bold" }}>Lozinka:</label>
            <br />
            <input
              type="password"
              placeholder="Unesite lozinku"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              style={{
                width: "100%",
                marginTop: "8px",
                padding: "12px",
                borderRadius: "8px",
                border: "1px solid #d1d5db",
                boxSizing: "border-box"
              }}
            />
          </div>

          <button
            type="submit"
            style={{
              width: "100%",
              padding: "12px",
              borderRadius: "8px",
              border: "none",
              backgroundColor: "#2563eb",
              color: "white",
              fontWeight: "bold",
              cursor: "pointer"
            }}
          >
            Prijavi se
          </button>
        </form>

        {poruka && (
          <p
            style={{
              marginTop: "20px",
              textAlign: "center",
              color: poruka === "Uspešna prijava." ? "green" : "#dc2626"
            }}
          >
            {poruka}
          </p>
        )}
      </div>
    </div>
  );
}

export default Login;