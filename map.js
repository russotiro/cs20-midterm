var costPerKM = 2;
var flatRate = 600;
var busTypeMultiplier = [1.4, 1.1, 1.8, 0.9, 1];

function initMap() {
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: { lat: 42.42, lng: -71.11 },
    });
    console.log("wa");


}

function calculateAndDisplayRoute(form, directionsService, directionsRenderer, start, dest) {
    directionsService
        .route({
            origin: {
                query: start,
            },
            destination: {
                query: dest,
            },
            travelMode: google.maps.TravelMode.DRIVING,
        })
        .then((response) => {
            directionsRenderer.setDirections(response);
            var dist = computeTotalDistance(response);
            calcAndDisplayCost(form, dist);
            loadPurchaseForm();
        })
        .catch((e) => window.alert("Directions request failed due to " + status));
}

function handleForm(form) {

    document.getElementById("map").setAttribute("style", "margin:2vw;height:60%;");

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: { lat: 42.42, lng: -71.11 },
    });

    directionsRenderer.setMap(map);
    calculateAndDisplayRoute(form, directionsService, directionsRenderer, form.start.value, form.end.value);

}

function computeTotalDistance(result) {

    let total = 0;
    const myRoute = result.routes[0];

    if (!myRoute) {
        return;
    }

    for (let i = 0; i < myRoute.legs.length; i++) {
        total += myRoute.legs[i].distance.value;

    }

    total = total / 1000;
    return total;
}

function calcAndDisplayCost(form, dist) {
    var mult = 1;
    if (form.roundtrip[0].checked) {
        mult = 2;
    }

    var e = document.getElementById("buses");
    var bus = e.options[e.selectedIndex].value;
    mult = mult * busTypeMultiplier[parseInt(bus)];

    var cost = flatRate + mult * costPerKM * dist;

    cost = Math.round(cost);
    document.getElementById("cost").innerHTML = "<p>Estimated Cost: $" + cost + "</p>";

}

function loadPurchaseForm() {
    document.getElementById("purchasetxt").innerHTML = "Enter your name and email to purchase your tickets!"
    document.getElementById("buy").innerHTML = "<form action=\"\"> <label for=\"fname\">First name:</label><br> <input type=\"text\" id=\"fname\" name=\"fname\" value=\"\"><br> <label for=\"lname\">Last name:</label><br> <input type=\"text\" id=\"lname\" name=\"lname\" value=\"\"><br> <label for=\"email\">Enter your email:</label><br> <input type=\"email\" id=\"email\" name=\"email\"><br><br> <input type=\"button\" value=\"Purchase\"> </form>"
}