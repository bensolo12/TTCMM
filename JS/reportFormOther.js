const dropdown = document.getElementById("issueSelect");
var selectedOption = document.getElementById("typeValue");
selectedOption.innerHTML = dropdown.value;

const otherLabel = document.getElementById("otherLabel");
const otherTextField = document.getElementById("otherIssue");
const otherReview = document.getElementById("otherDesTitle");
const otherReviewVal = document.getElementById("otherValue");

dropdown.addEventListener("change", function () {
    selectedOption.innerHTML = dropdown.value;

    if (dropdown.value === "Other") {
        otherTextField.style.display = "block";
        otherLabel.style.display = "block";
        otherReview.style.display = "block";
        otherReviewVal.style.display = "block";

    } else {
        otherTextField.style.display = "none";
        otherLabel.style.display = "none";
        otherReview.style.display = "none";
        otherReviewVal.style.display = "none";
    }
});