//FULL CALENDAR

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar2");

  const inputHiddenEvent = document.getElementById("incoming-event");

  const incomingEvents = JSON.parse(inputHiddenEvent.value);

  const events = [];

  if (incomingEvents.length) {
    incomingEvents.forEach((e) => {
      events.push({
        title: e.event_name,
        start: `${e.event_date} ${e.event_start_time}`,
      });
    });
  }

  var calendar = new FullCalendar.Calendar(calendarEl, {
        // defaultView: 'month',
    navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: false,
    selectable: false,
    selectMirror: true,
    eventClick: function (arg) {
      alert("TEST");
    },
    dayMaxEvents: true, // allow "more" link when too many events
    events: events,
  });

  calendar.render();
});
