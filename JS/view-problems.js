window.initMap = initMap;
var markersArray = [];

document.addEventListener("DOMContentLoaded", () => {
    // Get the scroll container element
    scrollContainer = document.getElementById("viewReportsContainer");
    filterContainer = document.getElementById("filterContainer");
    if (scrollContainer) {
        renderReports("");
    }
});

function clearMarkers() {
    for (var i = 0; i < markersArray.length; i++ ) {
        markersArray[i].setMap(null);
      }
      markersArray.length = 0;
}

function filtersChanged() {
    filterString = "";
    filterElements = filterContainer.querySelectorAll("input[type='checkbox']");
    statusElements = filterContainer.querySelectorAll("input[type='radio']");
    for (let i = 0; i < filterElements.length; i++) {
        const element = filterElements[i];
        if (element.checked) {
            if (filterString == "") {
                filterString = "'" + element.value + "'";
            } else {
                filterString = filterString + ", '" + element.value + "'";
            }
        }
    }
    for (let i = 0; i < statusElements.length; i++) {
        const element = statusElements[i];
        if (element.checked) {
            filterString = filterString + "*'" + element.value + "'";
        }
    }
    renderReports(filterString);
}

function displayFullReport(reportId) {
    container = document.getElementById("fullReportContainer");

    $.ajax({
        type: "POST",
        url: "../PHP/getreport.php",
        data:"report_id="+reportId,
        datatype: "json",
        success: function(msg){
            if (msg == "none") {
                // Add a message saying no reported reports could be found
            } else {
                reportObj = JSON.parse(msg);

                // container.classList.remove("hidden");

                reportId = reportObj["report_id"];
                reportType = reportObj["type"];
                reportAddress = reportObj["address"];
                reportStatus = reportObj["report_status"];
                reportDate = reportObj["date_reported"];
                reportDesc = reportObj["description"];
                lat = parseFloat(reportObj["latitude"]);
                lng = parseFloat(reportObj["longitude"]);

                document.getElementById("reportTitle").textContent = reportType + " at " + reportAddress;
                document.getElementById("reportDate").textContent = "Reported: " + reportDate;
                document.getElementById("reportStatus").textContent = "Status: " + reportStatus;
                document.getElementById("reportDescription").textContent = reportDesc;

                clearMarkers();
                // var markerURL = ("../Images/",reportType,"Pin.png")
                map.setCenter({ lat: lat, lng: lng });
                var marker = new google.maps.Marker({
                    position: { lat: lat, lng: lng },
                    map: map,
                    // icon: {markerURL},
                });
                markersArray.push(marker);
            }
        }
    })
}


function renderReports(filters) {
    scrollContainer.innerHTML = "";
    $.ajax({
        type: "POST",
        url: "../PHP/getreports.php",
        data: "filters="+filters,
        datatype: "json",
        success: function(msg){
            if (msg == "none") {
                // Add a message saying no reported reports could be found
            } else {
                dataJson = JSON.parse(msg);

                for(var i = 0; i < dataJson.length; i++) {
                    var reportObj = dataJson[i];
                    imageSrc = "";
                    reportId = reportObj["report_id"];
                    reportType = reportObj["type"];
                    reportAddress = reportObj["address"];
                    reportStatus = reportObj["report_status"];
                    reportDate = reportObj["date_reported"];

                    displayReportPanel(scrollContainer, reportDate, reportId, reportType, reportAddress, reportStatus);
                }
            }
        }
    })
}

function displayReportPanel(scrollContainer, dateReported, id, type, address, status) {
    // Create a div element to be the panel containing the image and details
    const newPanel = document.createElement("div");
    newPanel.addEventListener("click", function(){displayFullReport(id)});
    newPanel.id = id;
    newPanel.classList.add("report-panel");

    topRow = document.createElement("div");
    topRow.classList.add("row");
    newPanel.appendChild(topRow);

    // Create an element for the report title
    reportTitle = document.createElement("p");
    reportTitle.classList.add("col-lg-6");
    reportTitle.textContent = type;
    // Append the element to the panel so it's displayed
    topRow.appendChild(reportTitle);

    // Create an element for the report's status
    reportStatus = document.createElement("p");
    reportStatus.classList.add("col-lg-6");
    reportStatus.id = "Status";
    reportStatus.textContent = "Status: " + status;
    // Append the element to the panel so it's displayed
    topRow.appendChild(reportStatus);

    bottomRow = document.createElement("div");
    bottomRow.classList.add("row");
    newPanel.appendChild(bottomRow);

    // Create an element for the report's address
    reportAddress = document.createElement("p");
    reportAddress.classList.add("col-lg-6");
    reportAddress.textContent = address;
    // Append the element to the panel so it's displayed
    bottomRow.appendChild(reportAddress);

    // Create an element for the date the report was submitted / resovled
    reportDate = document.createElement("p");
    reportDate.classList.add("col-lg-6");

    // Need to check whether the report has been fixed to know whether to display
    // "Fixed: " or "Reported: "

    //Temporary fix
    dateResolved = "Unknown";

    let dateString = "Reported: " + dateReported;
    if (status == "Fixed") {
        dateString = "Fixed: " + dateResolved;
    }
    reportDate.textContent = dateString;
    // Append the element to the panel so it's displayed
    bottomRow.appendChild(reportDate);

    const heartElement = document.createElement("span");
    heartElement.classList.add("heart");
    heartElement.innerHTML = "&#10084;";

    // TEMPORARY - for testing, MUST CHANGE THIS TO CHECK THE ACTUAL CURRENTLY LOGGED IN USER
    userId = 1;

    isFavourited(id, userId, function(result) {
        if (result) {
            heartElement.classList.add("active");
        }
    });

    heartElement.addEventListener('click', function() {

        this.classList.toggle('active');
        if (this.classList.contains('active')) {
            favourite(id, userId);
        } else {
            unfavourite(id, userId);
        }

    });
    newPanel.append(heartElement);

    scrollContainer.appendChild(newPanel)
}

function favourite(reportId, currentUserId) {
    //Call PHP code to add report ID and currentUserID to the favourites table
    $.ajax({
        type: "POST",
        url: "../PHP/addremovefavourites.php",
        data: "user_id="+currentUserId+"&report_id="+reportId+"&command=Favourite",
        datatype: "json",
        success: function(msg){
            if (msg == "none") {
                return false;
            } else {
                return true;
            }
        }
    });
    return false;
}

function unfavourite(reportId, currentUserId) {
    //Same as favourite but pass the command variable as "Unfavourite" to show that it should be removed
    $.ajax({
        type: "POST",
        url: "../PHP/addremovefavourites.php",
        data: "user_id="+currentUserId+"&report_id="+reportId+"&command=Unfavourite",
        datatype: "json",
        success: function(msg){
            if (msg == "none") {
                return false;
            } else {
                return true;
            }
        }
    });
    return false;
}

function isFavourited(reportId, currentUserId, callback) {
    //Call PHP getFavourites, if result is "none" then return false, otherwise return true
    $.ajax({
        type: "POST",
        url: "../PHP/getfavourite.php",
        data: "user_id="+currentUserId+"&report_id="+reportId,
        datatype: "json",
        success: function(msg){
            if (msg == "none") {
                callback(false);
            } else {
                callback(true);
            }
        }
    });
    return false;
}
