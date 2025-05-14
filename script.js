let events = [];

async function fetchEvents() {
  try {
    const res = await fetch("fetch_events.php");
    if (!res.ok) throw new Error('Failed to fetch events');
    events = await res.json();
    displayEvents(events);
  } catch (error) {
    console.error('Error:', error);
    showError('Failed to load events. Please try again.');
  }
}

function displayEvents(filteredEvents = events) {
  const list = document.getElementById("eventsList");
  
  if (filteredEvents.length === 0) {
    list.innerHTML = `
      <div class="empty-state">
        <p>No events found. Try adjusting your filters or add a new event!</p>
      </div>
    `;
    return;
  }

  list.innerHTML = filteredEvents.map(event => `
    <div class="event-card">
      <strong>${event.title}</strong>
      <div class="date">${formatDate(event.date)}</div>
      <div class="location">${event.location}</div>
    </div>
  `).join("");
}

function formatDate(dateString) {
  const options = { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' };
  return new Date(dateString).toLocaleDateString('en-US', options);
}

function filterEvents() {
  const start = document.getElementById("startDate").value;
  const end = document.getElementById("endDate").value;

  if (!start || !end) {
    showError('Please select both start and end dates');
    return;
  }

  const filtered = events.filter(e => {
    const eventDate = new Date(e.date);
    const startDate = new Date(start);
    const endDate = new Date(end);
    return eventDate >= startDate && eventDate <= endDate;
  });
  
  displayEvents(filtered);
}

function resetFilter() {
  document.getElementById("startDate").value = "";
  document.getElementById("endDate").value = "";
  displayEvents(events);
}

function showError(message) {
  const list = document.getElementById("eventsList");
  list.innerHTML = `
    <div class="empty-state" style="color: var(--danger);">
      <p>${message}</p>
    </div>
  `;
}

// Initialize date pickers
document.addEventListener('DOMContentLoaded', () => {
  flatpickr("#eventDate", {
    dateFormat: "Y-m-d",
    minDate: "today"
  });
  
  flatpickr("#startDate", {
    dateFormat: "Y-m-d",
    minDate: "today"
  });
  
  flatpickr("#endDate", {
    dateFormat: "Y-m-d",
    minDate: "today"
  });

  fetchEvents();
});