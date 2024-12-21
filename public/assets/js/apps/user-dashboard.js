const Dashboard = {
  chart: false,

  initCalendar() {
    const calendarEl = document.getElementById("calendarEventUser");
    let calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
      },
      events: async (info, handleSuccessEvent, handleErrorEvent) => {
        try {
          const request = await fetch(
            `/user/dashboard/events?start=${info.startStr}&end=${info.endStr}`
          );
          const response = await request.json();

          let template = document.querySelector("#cardListMyEvents");

          let html = "";
          let events = [];
          response.data.forEach((event) => {
            html += `
            <div class="event-item event-default">
              ${event.event_name}
            </div>
            `;

            let eventData = {
              title: event.event_name,
              start: event.event_date + " " + event.event_start_time,
            };

            events.push(eventData);
          });
          template.innerHTML = html;

          handleSuccessEvent(events);
        } catch (error) {
          handleErrorEvent(error);
        }
      },
    });

    calendar.render();
  },

  async initGraphs(type = "Monthly") {
    document.querySelector(`#graphTypeFilter`).innerHTML = type;

    const request = await fetch(`/user/dashboard/graphs?type=${type}`);
    const response = await request.json();

    const summaryNow = response.data.map((data) => parseFloat(data.now));
    const summaryPrev = response.data.map((data) => parseFloat(data.prev));

    if (!Dashboard.chart) {
      const monthName = response.data.map((data) => data.month_name);
      // console.log(summaryNow);

      const ctx = document.querySelector("#chartGraphSummary");
      const option = {
        chart: {
          height: 400,
          type: "line",
        },
        series: [
          {
            name: "This Month",
            type: "column",
            data: summaryNow,
          },
          {
            name: "Last Month",
            type: "line",
            data: summaryPrev,
          },
        ],
        xaxis: {
          categories: monthName,
          title: {
            text: "Months",
          },
        },
        yaxis: {
          title: {
            text: "Values",
          },
        },
        colors: ["#00A6B4", "#FFCB00"], // Warna sesuai keinginan
        stroke: {
          width: [0, 3], // Lebar garis: 0 buat bar chart, 3 buat line chart
        },
        plotOptions: {
          bar: {
            columnWidth: "50%", // Lebar kolom bar
          },
        },
        dataLabels: {
          enabled: false,
        },
        legend: {
          position: "top",
        },
      };

      Dashboard.chart = new ApexCharts(ctx, option);
      Dashboard.chart.render();
    } else {
      let itemName = [];
      let newSeries = [];
      if (type == "Monthly") {
        itemName = response.data.map((data) => data.month_name);
        newSeries = [
          {
            name: "This Month",
            type: "column",
            data: summaryNow,
          },
          {
            name: "Last Month",
            type: "line",
            data: summaryPrev,
          },
        ];
      } else {
        itemName = response.data.map((data) => data.day);
        newSeries = [
          {
            name: "This Day",
            type: "column",
            data: summaryNow,
          },
          {
            name: "Last Day",
            type: "line",
            data: summaryPrev,
          },
        ];
      }

      Dashboard.chart.updateOptions({
        series: newSeries,
        xaxis: {
          categories: itemName,
        },
      });
    }
  },
};

document.addEventListener("DOMContentLoaded", function () {
  Dashboard.initCalendar();
  Dashboard.initGraphs();
});
