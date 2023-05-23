window.initMap = initMap;
var markersArray = [];
let userLat;
let userLng;
let currentUserID = null;

var map;
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 51.8999977, lng:-2.0738122 },
    zoom: 13,
  });
}

document.addEventListener("DOMContentLoaded", () => {
    // Get the scroll container element
    scrollContainer = document.getElementById("viewReportsContainer");
    filterContainer = document.getElementById("filterContainer");
    
    if (scrollContainer) {
        renderReports("");

        // If user location is available
        if (window.navigator.geolocation) {
            window.navigator.geolocation.getCurrentPosition(successCallback, failureCallback);
        }
    }
    getCurrentUserId(function(userId) {
        if (userId !== "none") {
            document.getElementById("favouriteFilter").classList.remove("hidden");
            currentUserID = userId;
        }
    }
    );
    const commentBtn = document.getElementById("addComment")
    commentBtn.addEventListener("click", function(event) {
        event.preventDefault();
        createComment(reportId);
    });
});

const successCallback = (position) => {
    userLat = position.coords.latitude;
    userLng = position.coords.longitude;
    document.getElementById("distance").classList.remove("hidden");
}

const failureCallback = (error) => {
    console.log(error);
}

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
        favouriteFilter = null;
        const element = filterElements[i];
        if (element.name !== "favourited") {
            if (element.checked) {
                if (filterString == "") {
                    filterString = "'" + element.value + "'";
                } else {
                    filterString = filterString + ", '" + element.value + "'";
                }
            }
        } else {
            favouriteFilter = element;
        }
    
    }
    for (let i = 0; i < statusElements.length; i++) {
        const element = statusElements[i];
        if (element.checked) {
            filterString = filterString + "*'" + element.value + "'";
        }
    }
    if (favouriteFilter !== null && favouriteFilter.checked) {
        filterString = filterString + "@true";
    }
    renderReports(filterString);
}

function displayComments(reportId){
    const commentsContainerDiv = document.getElementById("commentsContainerDiv");
    commentsContainerDiv.innerHTML = "";
    const container = document.getElementById("commentsContainer");
    const formCreateComments = document.getElementById("formCreateComments");
    
    if (reportId !== "" && reportId !== undefined && reportId !== null) {
        container.classList.remove("hidden");
    }
    if (currentUserID !== null) {
        formCreateComments.classList.remove("hidden");
    }
    $.ajax({
        type: "POST",
        url: "../PHP/getComments.php",
        data:"report_id="+reportId,
        datatype: "json",
        success: function(msg){
            console.log("MSG:");
            console.log(msg);
            if (msg == "none") {
                console.log("No comments");
                if (currentUserID === null) {
                    const commentsHeader = document.getElementById("commentsSection");
                    commentsHeader.classList.add("hidden");
                }
            } else {
                document.getElementById("commentsSection").textContent = "Comments:";

                jsonComments = JSON.parse(msg);

                // For every comment
                for (let i = 0; i < jsonComments.length; i++) {
                    const commentObj = jsonComments[i];
                
                    const commentPanel = document.createElement("div");

                    commentID = commentObj["comment_id"];
                    userName = commentObj["first_name"];
                    commentDate = commentObj["comment_date"];
                    commentText = commentObj["comment_text"];

                    // Create an element for the commenter name
                    commenterElement = document.createElement("p");
                    commenterElement.textContent = "Commenter: " + userName;
                    // Append the element to the panel so it's displayed
                    commentPanel.appendChild(commenterElement);

                    // Create an element for the comment date
                    commentDateElement = document.createElement("p");
                    commentDateElement.textContent = commentDate;
                    // Append the element to the panel so it's displayed
                    commentPanel.appendChild(commentDateElement);

                    // Create an element for the commenter
                    commentTextElement = document.createElement("p");
                    commentTextElement.textContent = commentText;
                    // Append the element to the panel so it's displayed
                    commentPanel.appendChild(commentTextElement);

                    commentPanel.classList.add("comment-panel");

                    // Append the panel to the comments section
                    commentsContainerDiv.appendChild(commentPanel);
                }
            }
        }
    })
}

function createComment(reportId){
    const addCommentElement = document.getElementById("addCommentsField");
    const commentText = addCommentElement.value;
    const commentDate = new Date().toISOString().slice(0, 10);

    $.ajax({
        type: "POST",
        url: "../PHP/createComment.php",
        data: "comment_text="+commentText+"&report_id="+reportId+"&user_id="+currentUserID+"&comment_date="+commentDate,
        datatype: "json",
        success: function(msg) {
            $("#divMessage").html(msg);	
            alert(msg);
            console.log("SUCCESS");
        },
        error: function(msg){ 
            console.log("ERROR:");
            console.log(msg);
        }
    });
    const inputField = document.getElementById("addCommentsField");
    inputField.value = "";
    console.log("CREATE COMMENT END");
}
function showEmployeeControlls(){
    $.ajax({
        type: "POST",
        url: "../PHP/Common.php",
        data: "phpFunction=checkLogin",
        success: function(msg){
                  // dependend on user role page contents are modified
            if (msg == "Employee"){
                // Get the buttons-container element
                var buttonsContainer = document.getElementById("buttons-container");

                // Create buttons
                var reportButton = document.createElement("button");
                reportButton.innerText = "Report as fake";

                var assignButton = document.createElement("button");
                assignButton.innerText = "Assign to contractor";

                // Append buttons to the container
                buttonsContainer.appendChild(reportButton);
                buttonsContainer.appendChild(assignButton);
            }
        },
        error: function(msg){
          console.log(msg);
        }
      });
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
  

                showEmployeeControlls();
                document.getElementById("reportTitle").textContent = reportType;
                document.getElementById("reportDate").textContent = "Reported: " + reportDate;
                document.getElementById("reportStatus").textContent = "Status: " + reportStatus;
                document.getElementById("reportDescription").textContent = reportDesc;


                
                displayComments(reportId);
                

                map.setCenter({ lat: lat, lng: lng });
                
                // clearMarkers();
                // // var markerURL = ("../Images/",reportType,"Pin.png")
                // map.setCenter({ lat: lat, lng: lng });
                // var marker = new google.maps.Marker({
                //     position: { lat: lat, lng: lng },
                //     map: map,
                //     // icon: {markerURL},
                // });
                // markersArray.push(marker);
            }        
        },
        error: function(error) {
            console.error(error);
        }
    })
}

// Calculate if a location is within the radius of another location
// using the Haversine formula
function isWithinRadius(lat1, lng1, lat2, lng2, radius) {
    const earthRadiusKM = 6371;

    const lat1Radians = toRadians(lat1);
    const lat2Radians = toRadians(lat2);
    const lng1Radians = toRadians(lng1);
    const lng2Radians = toRadians(lng2);

    const deltaLat = lat2Radians - lat1Radians;
    const deltaLng = lng2Radians - lng1Radians;

    const a = Math.sin(deltaLat / 2) * Math.sin(deltaLat / 2) +
              Math.cos(lat1Radians) * Math.cos(lat2Radians) *
              Math.sin(deltaLng / 2) * Math.sin(deltaLng / 2);
    
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    const distance = earthRadiusKM * c;

    return distance <= radius;
}

function toRadians(value) {
    return value * Math.PI / 180;
}   

function renderReports(filters) {
    clearMarkers();
    scrollContainer.innerHTML = "";
    container = document.getElementById("fullReportContainer");
    favouriteFilter = "false";
    if (filters.includes("@true") && currentUserID !== null && currentUserID !== "none") {
        filters = filters.replace("@true", "");
        favouriteFilter = "true";
    }
    $.ajax({
        type: "POST",
        url: "../PHP/getreports.php",
        data: "filters="+filters+"&favourites="+favouriteFilter+"&user_id="+currentUserID,
        datatype: "json",
        success: function(msg){
            console.log("MSG:");
            console.log(msg);
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
                    reportLat = reportObj["latitude"];
                    reportLng = reportObj["longitude"];

                    const distanceFilter = document.getElementById("distance");
                    const selectedRadius = distanceFilter.options[distanceFilter.selectedIndex].value;

                    if (!distanceFilter.classList.contains("hidden") && selectedRadius !== "" && selectedRadius !== "Any") {
                        const kilometerRadius = parseFloat(selectedRadius);
                        if (isWithinRadius(userLat, userLng, reportLat, reportLng, kilometerRadius)) {
                            displayReportPanel(scrollContainer, reportDate, reportId, reportType, reportAddress, reportStatus);
                        }
                    } else {
                        displayReportPanel(scrollContainer, reportDate, reportId, reportType, reportAddress, reportStatus);
                    }

                    lat =  parseFloat(reportObj["latitude"]);
                    lng =  parseFloat(reportObj["longitude"]);

                    // COMMENTED THIS OUT BECAUSE REPORT PANEL IS BEING RENDERED IN ELSE STATEMENT ABOVE - THIS MEANS ONLY REPORTS IN USER RADIUS ARE RENDERED WHEN FILTER IS APPLIED
                    // NOT SURE WHETHER THIS IS INTENDED OR NOT SO COMMENTED RATHER THAN DELETED
                    //displayReportPanel(scrollContainer, reportDate, reportId, reportType, reportAddress, reportStatus);

                    //moved marker addition to here
                    //creates a marker with a pin title and colour corosponding to the problem reportType
                    //potential to do: can click on the pin to select a problem/ when problem is selected the map recenters to its pin

                    // map.setCenter({ lat: lat, lng: lng });
                    var marker = new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        icon: "../Images/"+reportType+"Pin.png",
                        title: reportType,
                    });
                    markersArray.push(marker);
                    

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

    getCurrentUserId(function(userId) {
        // If a user ID is returned then add the ability to favourite reports
        if (userId !== "none") {
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
    // TEMPORARY - for testing, MUST CHANGE THIS TO CHECK THE ACTUAL CURRENTLY LOGGED IN USER
    // userId = 1;

    // isFavourited(id, userId, function(result) {
    //     if (result) {
    //         heartElement.classList.add("active");
    //     }
    // });

    // heartElement.addEventListener('click', function() {

    //     this.classList.toggle('active');
    //     if (this.classList.contains('active')) {
    //         favourite(id, userId);
        } else {
            console.log("Something has gone wrong - could not get the currently logged in user ID");
        }
    });

    scrollContainer.appendChild(newPanel)
}

function getCurrentUserId(callback) {
    // Make an AJAX request to the getUserId PHP file to get the user ID
    $.ajax({
        url: "../PHP/getUserId.php",
        datatype: "json",
        success: function(userId) {
          // Call the callback function with the user ID
          callback(userId);
        }
    });
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
