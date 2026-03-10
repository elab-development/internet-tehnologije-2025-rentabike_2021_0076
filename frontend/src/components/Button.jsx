function Button({ text, onClick }) {
  return (
    <button
      onClick={onClick}
      style={{
        padding: "8px 15px",
        background: "#4CAF50",
        color: "white",
        border: "none",
        cursor: "pointer",
        borderRadius: "4px"
      }}
    >
      {text}
    </button>
  );
}

export default Button;