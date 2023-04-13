const dropdown = document.getElementById("issueSelect");
var selectedOption = document.getElementById("typeValue");
selectedOption.innerHTML = dropdown.value;

const otherLabel = document.getElementById("otherLabel");
const otherTextField = document.getElementById("otherIssue");
const otherReviewVal = document.getElementById("otherValue");
const otherReview = document.getElementById("otherDesTitle");

dropdown.addEventListener("change", function () {
    selectedOption.innerHTML = dropdown.value;

    if (dropdown.value === "Other") {
        otherTextField.style.display = "block";
        otherLabel.style.display = "block";
        otherReview.style.display = "block";

    } else {
        otherTextField.style.display = "none";
        otherLabel.style.display = "none";
        otherReview.style.display = "none";
    }
});