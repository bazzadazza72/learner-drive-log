const date = new Date();
var currentDate = date.toLocaleDateString();

function checkTime() {
    // Retrieves time data from form elements
    var journeyDate = document.getElementById("journeyDate");
    var startTime = document.getElementById("startTime");
    var endTime = document.getElementById("endTime");

    // Displays data in an alert box, commented out for debugging
    // alert(startTime.value);
    // alert(endTime.value);
    // alert(journeyDate.value);
    if (startTime.value=="" && endTime.value=="") {
        console.log("Both boxes were empty so no calculation is required.")
        return false;
    }

    // God I love Stack Overflow.
    // Code credit: https://stackoverflow.com/a/55749464
    let t1 = startTime.value;
    let dateOne = Number(t1.split(':')[0]) * 60 * 60 * 1000 + Number(t1.split(':')[1]) * 60 * 1000;
    let t2 = endTime.value;
    let dateTwo = Number(t2.split(':')[0]) * 60 * 60 * 1000 + Number(t2.split(':')[1]) * 60 * 1000;
    let msDifference =  dateTwo - dateOne;
    let minutes = Math.floor(msDifference/1000/60);
    console.log("Minutes between two times: ", minutes);

    document.getElementById("journeyLength").value = minutes;


    return true;
}

function resetForm() {
    var form = document.getElementById("form1");
    form.reset();
}

// function checkDate() {
//     var journeyDate = document.getElementById("journeyDate");
//     console.log("Date in element: " + journeyDate.value);
//     if (journeyDate.value > currentDate) {
//         console.log("Date in element is after the current date.");
//     }
// }