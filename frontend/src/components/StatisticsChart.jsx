import { useEffect, useState } from "react";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend,
} from "chart.js";
import { Bar } from "react-chartjs-2";

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Title,
  Tooltip,
  Legend
);

function StatisticsChart() {
  const [stats, setStats] = useState({
    bicycle: 0,
    electric_bike: 0,
    scooter: 0,
    electric_scooter: 0,
    roller: 0,
  });

  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/equipment")
      .then((res) => res.json())
      .then((data) => {
        const counts = {
          bicycle: 0,
          electric_bike: 0,
          scooter: 0,
          electric_scooter: 0,
          roller: 0,
        };

        data.forEach((item) => {
        if (item.is_available && counts[item.type] !== undefined) {
       counts[item.type]++;
       }
       });

        setStats(counts);
      });
  }, []);

  const data = {
    labels: [
      "Bicikli",
      "Električni bicikli",
      "Trotineti",
      "Električni trotineti",
      "Roleri",
    ],
    datasets: [
      {
        label: "Broj dostupne opreme",
        data: [
          stats.bicycle,
          stats.electric_bike,
          stats.scooter,
          stats.electric_scooter,
          stats.roller,
        ],
      },
    ],
  };

  const options = {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: "Statistika opreme po tipu",
      },
    },
  };

  return (
    <div style={{ maxWidth: "900px", margin: "50px auto" }}>
      <Bar data={data} options={options} />
    </div>
  );
}

export default StatisticsChart;