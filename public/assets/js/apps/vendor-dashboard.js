const Dashboard = {
  chart: false,

  initCalendar() {
    const calendarEl = document.getElementById("calendarEventVendor");
    let calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
      },
      events: async (info, handleSuccessEvent, handleErrorEvent) => {
        try {
          const request = await fetch(`/vendor/dashboard/events?start=${info.startStr}&end=${info.endStr}`);
          const response = await request.json();

          let template = document.querySelector("#cardListMyEvents");

          let html = "";
          response.data.forEach(event => {
            html += `
            <div class="event-item event-default">
              ${event.event_name}
            </div>
            `;
          });
          template.innerHTML = html;

          handleSuccessEvent(response);
        } catch (error) {
          handleErrorEvent(error);
        }
      },
    });

    calendar.render();
  },

  async initGraphs(type = "Monthly") {
    document.querySelector(`#graphTypeFilter`).innerHTML = type;

    const request = await fetch(`/vendor/dashboard/graphs?type=${type}`);
    const response = await request.json();

    const summaryNow = response.data.map((data) => data.now);
    const summaryPrev = response.data.map((data) => data.prev);

    if (!Dashboard.chart) {
      const monthName = response.data.map((data) => data.month_name);

      const ctx = document.getElementById("chartGraphSummary").getContext("2d");
      Dashboard.chart = new Chart(ctx, {
        type: "line",
        data: {
          labels: monthName,
          datasets: [
            {
              label: "This Month",
              data: summaryNow,
              borderColor: "rgba(75, 192, 192, 1)",
              backgroundColor: "rgba(75, 192, 192, 0.2)",
              fill: false,
            },
            {
              label: "Last Month",
              data: summaryPrev,
              borderColor: "rgba(153, 102, 255, 1)",
              backgroundColor: "rgba(153, 102, 255, 0.2)",
              fill: false,
            },
          ],
        },
        options: {
          scales: { y: { beginAtZero: true } }, plugins: { tooltip: { mode: 'index', intersect: false } }, hover: { mode: 'nearest', intersect: false }
        },
      });
    } else {
      let itemName = [];
      if (type == "Monthly") {
        itemName = response.data.map((data) => data.month_name);
      } else {
        itemName = response.data.map((data) => data.day);
      }

      Dashboard.chart.data.labels = itemName;
      Dashboard.chart.data.datasets[0].data = summaryNow;
      Dashboard.chart.data.datasets[0].label = "This Day";

      Dashboard.chart.data.datasets[1].data = summaryPrev;
      Dashboard.chart.data.datasets[1].label = "Last Day";
      Dashboard.chart.update();
    }
  }
};

document.addEventListener("DOMContentLoaded", function () {
  Dashboard.initCalendar();
  Dashboard.initGraphs();
});
