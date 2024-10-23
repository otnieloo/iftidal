import "../assets/js/custom";
import "../assets/js/switcher-styles";

const testDataTable = async () => {
  const request = await fetch(`http://127.0.0.1:8000/app/orders/get`);

  const response = await request.json();

  console.log(response);
};

// testDataTable();
