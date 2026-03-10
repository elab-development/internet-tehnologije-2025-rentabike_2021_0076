import { useState } from "react";

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [poruka, setPoruka] = useState("");

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

      console.log(data);

      if (response.ok) {
  localStorage.setItem("token", data.token);
  setPoruka("Uspešna prijava.");
} else {
  setPoruka("Prijava nije uspela.");
}
    } catch (error) {
      console.error(error);
      setPoruka("Došlo je do greške.");
    }
  };

  return (
    <div style={{ padding: "40px" }}>
      <h1>Prijava korisnika</h1>

      <form onSubmit={handleLogin} style={{ marginTop: "20px" }}>
        <div>
          <label>Email:</label>
          <br />
          <input
            type="email"
            placeholder="Unesite email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          />
        </div>

        <br />

        <div>
          <label>Lozinka:</label>
          <br />
          <input
            type="password"
            placeholder="Unesite lozinku"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
        </div>

        <br />

        <button type="submit">Prijavi se</button>
      </form>

      <p>{poruka}</p>
    </div>
  );
}

export default Login;