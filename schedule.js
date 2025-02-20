document.addEventListener("DOMContentLoaded", function () {
    loadEvents();
});

document.getElementById("addEventBtn").addEventListener("click", function () {
    addEvent();
});

function addEvent() {
    let name = document.getElementById("eventName").value.trim();
    let date = document.getElementById("eventDate").value;
    let time = document.getElementById("eventTime").value;
    let venue = document.getElementById("eventVenue").value.trim();
    let role = document.getElementById("eventRole").value;

    if (!name || !date || !time || !venue || !role) {
        alert("Please fill in all fields.");
        return;
    }

    let formData = new FormData();
    formData.append("name", name);
    formData.append("date", date);
    formData.append("time", time);
    formData.append("venue", venue);
    formData.append("role", role);

    fetch("add_event.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("success")) {
            alert("Event added successfully!");
            document.querySelector(".btn-close").click();
            loadEvents();
            clearForm();
        } else {
            alert("Error adding event: " + data);
        }
    })
    .catch(error => console.error("Error:", error));
}

function loadEvents() {
    fetch("schedule_fetch_events.php")
    .then(response => response.json())
    .then(events => {
        let eventContainer = document.getElementById("eventContainer");
        eventContainer.innerHTML = "";

        if (events.length === 0) {
            eventContainer.innerHTML = `<p class="text-yellow-300">No events found.</p>`;
        } else {
            events.forEach(event => {
                eventContainer.innerHTML += `
                    <div class="col-md-4">
                        <div class="event-card mb-4">
                            <h3>${event.name}</h3>
                            <p>Date: ${event.date} | Time: ${event.time}</p>
                            <p>Venue: ${event.venue}</p>
                            <p>Role: ${event.role}</p>
                            <div class="mt-3">
                                <button class="btn btn-warning btn-sm edit-btn" 
                                    data-id="${event.id}" 
                                    data-name="${event.name}"
                                    data-date="${event.date}"
                                    data-time="${event.time}"
                                    data-venue="${event.venue}"
                                    data-role="${event.role}"
                                    onclick="openEditModal(this)">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteEvent(${event.id})">Delete</button>
                            </div>
                        </div>
                    </div>`;
            });
        }
    })
    .catch(error => console.error("Error fetching events:", error));
}

function openEditModal(button) {
    // Populate the edit modal with event data
    document.getElementById("editEventId").value = button.getAttribute("data-id");
    document.getElementById("editEventName").value = button.getAttribute("data-name");
    document.getElementById("editEventDate").value = button.getAttribute("data-date");
    document.getElementById("editEventTime").value = button.getAttribute("data-time");
    document.getElementById("editEventVenue").value = button.getAttribute("data-venue");
    document.getElementById("editEventRole").value = button.getAttribute("data-role");
    
    // Open the modal
    let editModal = new bootstrap.Modal(document.getElementById('editEventModal'));
    editModal.show();
}

function updateEvent() {
    let id = document.getElementById("editEventId").value;
    let name = document.getElementById("editEventName").value.trim();
    let date = document.getElementById("editEventDate").value;
    let time = document.getElementById("editEventTime").value;
    let venue = document.getElementById("editEventVenue").value.trim();
    let role = document.getElementById("editEventRole").value;

    if (!name || !date || !time || !venue || !role) {
        alert("Please fill in all fields.");
        return;
    }

    let formData = new FormData();
    formData.append("id", id);
    formData.append("name", name);
    formData.append("date", date);
    formData.append("time", time);
    formData.append("venue", venue);
    formData.append("role", role);

    fetch("update_event.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("success")) {
            alert("Event updated successfully!");
            document.querySelector("#editEventModal .btn-close").click();
            loadEvents();
        } else {
            alert("Error updating event: " + data);
        }
    })
    .catch(error => console.error("Error:", error));
}

function deleteEvent(id) {
    if (confirm("Are you sure you want to delete this event?")) {
        let formData = new FormData();
        formData.append("id", id);

        fetch("delete_event.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Event deleted successfully!");
                loadEvents();
            } else {
                alert("Error deleting event: " + (data.error || "Unknown error"));
            }
        })
        .catch(error => console.error("Error:", error));
    }
}

function searchEvents() {
    let input = document.getElementById("search").value.toLowerCase();
    let eventCards = document.querySelectorAll(".event-card");
    let noResults = document.getElementById("noResults");
    let found = false;

    eventCards.forEach(card => {
        let text = card.textContent.toLowerCase();
        if (text.includes(input)) {
            card.parentElement.style.display = "";
            found = true;
        } else {
            card.parentElement.style.display = "none";
        }
    });

    noResults.style.display = found ? "none" : "block";
}

function clearForm() {
    document.getElementById("eventName").value = "";
    document.getElementById("eventDate").value = "";
    document.getElementById("eventTime").value = "";
    document.getElementById("eventVenue").value = "";
    document.getElementById("eventRole").value = "Teacher";
}