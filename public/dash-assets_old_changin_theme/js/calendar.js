var start_date = document.getElementById("event-start-date"),
    timepicker1 = document.getElementById("timepicker1"),
    timepicker2 = document.getElementById("timepicker2"),
    date_range = null,
    T_check = null;

function flatPickrInit() {
    var timePickerOptions = {
        enableTime: true,
        noCalendar: true
    };

    flatpickr(start_date, {
        enableTime: false,
        mode: "range",
        minDate: "today",
        onChange: function (selectedDates, dateStr, instance) {
            if (dateStr.split("to").length > 1) {
                document.getElementById("event-time").setAttribute("hidden", true);
            } else {
                document.getElementById("timepicker1").parentNode.classList.remove("d-none");
                document.getElementById("timepicker1").classList.replace("d-none", "d-block");
                document.getElementById("timepicker2").parentNode.classList.remove("d-none");
                document.getElementById("timepicker2").classList.replace("d-none", "d-block");
                document.getElementById("event-time").removeAttribute("hidden");
            }
        }
    });

    flatpickr(timepicker1, timePickerOptions);
    flatpickr(timepicker2, timePickerOptions);
}

function flatpickrValueClear() {
    start_date.flatpickr().clear();
    timepicker1.flatpickr().clear();
    timepicker2.flatpickr().clear();
}

function eventClicked() {
    document.getElementById("form-event").classList.add("view-event");
    document.getElementById("event-title").classList.replace("d-block", "d-none");
    document.getElementById("event-category").classList.replace("d-block", "d-none");
    document.getElementById("event-start-date").parentNode.classList.add("d-none");
    document.getElementById("event-start-date").classList.replace("d-block", "d-none");
    document.getElementById("event-time").setAttribute("hidden", true);
    document.getElementById("timepicker1").parentNode.classList.add("d-none");
    document.getElementById("timepicker1").classList.replace("d-block", "d-none");
    document.getElementById("timepicker2").parentNode.classList.add("d-none");
    document.getElementById("timepicker2").classList.replace("d-block", "d-none");
    document.getElementById("event-location").classList.replace("d-block", "d-none");
    document.getElementById("event-description").classList.replace("d-block", "d-none");
    document.getElementById("event-start-date-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-timepicker1-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-timepicker2-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-location-tag").classList.replace("d-none", "d-block");
    document.getElementById("event-description-tag").classList.replace("d-none", "d-block");
    document.getElementById("btn-save-event").setAttribute("hidden", true);
}

function editEvent(button) {
    var id = button.getAttribute("data-id");
    if (id == "new-event") {
        document.getElementById("modal-title").innerText = "Add Event";
        document.getElementById("btn-save-event").innerText = "Add Event";
        eventTyped();
    } else if (id == "edit-event") {
        button.innerText = "Cancel";
        button.setAttribute("data-id", "cancel-event");
        document.getElementById("btn-save-event").innerText = "Update";
        button.removeAttribute("hidden");
        eventTyped();
    } else {
        button.innerText = "Edit";
        button.setAttribute("data-id", "edit-event");
        eventClicked();
    }
}

function eventTyped() {
    document.getElementById("form-event").classList.remove("view-event");
    document.getElementById("event-title").classList.replace("d-none", "d-block");
    document.getElementById("event-category").classList.replace("d-none", "d-block");
    document.getElementById("event-start-date").parentNode.classList.remove("d-none");
    document.getElementById("event-start-date").classList.replace("d-none", "d-block");
    document.getElementById("timepicker1").parentNode.classList.remove("d-none");
    document.getElementById("timepicker1").classList.replace("d-none", "d-block");
    document.getElementById("timepicker2").parentNode.classList.remove("d-none");
    document.getElementById("timepicker2").classList.replace("d-none", "d-block");
    document.getElementById("event-location").classList.replace("d-none", "d-block");
    document.getElementById("event-description").classList.replace("d-none", "d-block");
    document.getElementById("event-start-date-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-timepicker1-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-timepicker2-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-location-tag").classList.replace("d-block", "d-none");
    document.getElementById("event-description-tag").classList.replace("d-block", "d-none");
    document.getElementById("btn-save-event").removeAttribute("hidden");
}

function upcomingEvent(events) {
    events.sort(function (a, b) {
        return new Date(a.start) - new Date(b.start);
    });

    document.getElementById("upcoming-event-list").innerHTML = null;
    events.forEach(function (event) {
        var endDate = event.end ? new Date(event.end).setDate(new Date(event.end).getDate() - 1) : null;
        var endFormatted = endDate ? new Date(endDate).toLocaleDateString("en-GB", { day: "numeric", month: "short", year: "numeric" }).split(" ").join(" ") : null;
        var startFormatted = new Date(event.start).toLocaleDateString("en-GB", { day: "numeric", month: "short", year: "numeric" }).split(" ").join(" ");
        var dateRange = startFormatted + (endFormatted ? " to " + endFormatted : "");
        var className = event.className.split("-");
        var description = event.description || "";
        var startTime = tConvert(getTime(event.start));
        var endTime = tConvert(getTime(event.end));
        if (startTime === endTime) {
            startTime = "Full day event";
            endTime = null;
        }
        var timeRange = endTime ? " to " + endTime : "";
        var eventHtml = `
            <div class='card mb-3'>
                <div class='card-body'>
                    <div class='d-flex mb-3'>
                        <div class='flex-grow-1'>
                            <i class='mdi mdi-checkbox-blank-circle me-2 text-${className[1]}'></i>
                            <span class='fw-medium'>${dateRange}</span>
                        </div>
                        <div class='flex-shrink-0'>
                            <small class='badge bg-primary-subtle text-primary ms-auto'>${startTime}${timeRange}</small>
                        </div>
                    </div>
                    <h6 class='card-title fs-16'>${event.title}</h6>
                    <p class='text-muted text-truncate-two-lines mb-0'>${description}</p>
                </div>
            </div>`;
        document.getElementById("upcoming-event-list").innerHTML += eventHtml;
    });
}

function getTime(date) {
    date = new Date(date);
    if (date.getHours() !== null) {
        return date.getHours() + ":" + (date.getMinutes() ? date.getMinutes() : "00");
    }
}

function tConvert(time) {
    var [hour, minute] = time.split(":");
    var period = hour >= 12 ? "PM" : "AM";
    hour = (hour % 12) || 12;
    return `${hour}:${minute.padStart(2, "0")} ${period}`;
}

document.addEventListener("DOMContentLoaded", function () {
    flatPickrInit();

    var modal = new bootstrap.Modal(document.getElementById("event-modal"), {
        keyboard: false
    });
    var modalTitle = document.getElementById("modal-title");
    var form = document.getElementById("form-event");
    var currentEvent = null;
    var validationForms = document.getElementsByClassName("needs-validation");

    // Date and time variables
    var today = new Date();
    var date = today.getDate();
    var month = today.getMonth();
    var year = today.getFullYear();

    var draggable = new FullCalendar.Draggable(document.getElementById("external-events"), {
        itemSelector: ".external-event",
        eventData: function (eventEl) {
            return {
                title: eventEl.innerText,
                className: eventEl.getAttribute("data-class")
            };
        }
    });

    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        selectable: true,
        droppable: true,
        editable: true,
        initialView: "dayGridMonth",
        themeSystem: "bootstrap",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,dayGridWeek,dayGridDay"
        },
        windowResize: function () {
            calendar.changeView(window.innerWidth >= 768 ? "dayGridMonth" : "listWeek");
        },
        eventClick: function (info) {
            eventClicked();
            modal.show();
            var eventObj = info.event;
            var extendedProps = eventObj.extendedProps;

            var date = new Date(eventObj.start).toLocaleDateString("en-GB", {
                day: "numeric",
                month: "short",
                year: "numeric"
            }).split(" ").join(" ");
            var startTime = tConvert(getTime(eventObj.start));
            var endTime = tConvert(getTime(eventObj.end));

            modalTitle.innerText = eventObj.title;
            document.getElementById("event-title-tag").innerText = eventObj.title;
            document.getElementById("event-start-date-tag").innerText = date;
            document.getElementById("event-timepicker1-tag").innerText = startTime;
            document.getElementById("event-timepicker2-tag").innerText = endTime;
            document.getElementById("event-location-tag").innerText = extendedProps.location;
            document.getElementById("event-description-tag").innerText = extendedProps.description;
            document.getElementById("edit-event").setAttribute("data-id", "edit-event");
        },
        dateClick: function (info) {
            eventTyped();
            modal.show();
            flatpickrValueClear();
            modalTitle.innerText = "Add Event";
            document.getElementById("btn-save-event").innerText = "Add Event";
        },
        events: []
    });

    calendar.render();

    Array.prototype.slice.call(validationForms).forEach(function (form) {
        form.addEventListener("submit", function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                event.preventDefault();
                event.stopPropagation();
                var eventName = document.getElementById("event-title").value;
                var dateValue = start_date.value;
                var timeValue1 = timepicker1.value;
                var timeValue2 = timepicker2.value;
                var locationValue = document.getElementById("event-location").value;
                var descriptionValue = document.getElementById("event-description").value;
                var categoryValue = document.getElementById("event-category").value;
                var className = "bg-soft-" + categoryValue.split(" ").join("-").toLowerCase();

                var events = {
                    id: Date.now(),
                    title: eventName,
                    start: timeValue1 ? dateValue.split(" to ")[0] + " " + timeValue1 : dateValue.split(" to ")[0],
                    end: timeValue2 ? dateValue.split(" to ")[1] + " " + timeValue2 : dateValue.split(" to ")[1],
                    className: className,
                    location: locationValue,
                    description: descriptionValue
                };

                calendar.addEvent(events);
                upcomingEvent(calendar.getEvents());
                modal.hide();
            }

            form.classList.add("was-validated");
        }, false);
    });

    document.getElementById("btn-new-event").addEventListener("click", function () {
        modal.show();
        modalTitle.innerText = "Add Event";
        document.getElementById("btn-save-event").innerText = "Add Event";
        flatpickrValueClear();
        eventTyped();
    });

    document.getElementById("form-event").addEventListener("submit", function () {
        modal.hide();
    });

    document.getElementById("btn-delete-event").addEventListener("click", function () {
        if (currentEvent) {
            currentEvent.remove();
            currentEvent = null;
            upcomingEvent(calendar.getEvents());
            modal.hide();
        }
    });

    document.getElementById("upcoming-event").addEventListener("click", function () {
        upcomingEvent(calendar.getEvents());
    });
});

document.addEventListener("click", function (event) {
    if (!document.getElementById("event-modal").contains(event.target)) {
        var editEventButton = document.getElementById("edit-event");
        if (editEventButton.getAttribute("data-id") === "cancel-event") {
            editEventButton.innerText = "Edit";
            editEventButton.setAttribute("data-id", "edit-event");
            eventClicked();
        }
    }
});
