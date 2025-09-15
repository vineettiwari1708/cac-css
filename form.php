<?php
//Template Name: vin
?>

<?php get_header(); ?>
<?php wp_head(); ?>
  <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
<div class="master">
	


<button id="bookbutton" onclick="openbookPopup()">Book Now</button>

    <div id="bookpopup-container">
<div class="close-uniqe">
      <button id="close-bookpopup" class="close-button" onclick="closebookPopup()">✕</button>
      </div>

      <div>
        <h2 id="bookheading">Service Request Form</h2>
      </div>

      <form id="bookform" onsubmit="afterSubmit()">

        <div class="formField">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
        </div>

        <div class="formField">
          <label for="mobile">Mobile Number:</label>
          <input type="tel" id="mobile" name="mobile" placeholder="Enter 10 Digit Mobile No." maxlength="10"
            oninput="validatePhoneNumber(this)" required>
        </div>

        <div class="formField">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="abc@xyz.com" required>
        </div>

        <div class="formField">
          <label for="category">Service For:</label>
          <select id="category" name="category" required onchange="showHiddenLabel()">
            <option value="">Select Service </option>
            <option value="Car Detailing">Car Detailing</option>
            <option value="Bike Detailing">Bike Detailing</option>
            <option value="Sofa Cleaning">Sofa Cleaning</option>
          </select>
        </div>

        <div class="hiddenlabel">
        </div>

        <div class="formField">
          <label for="Amount">Amount ₹:</label>
          <input type="text" readonly id="quoteResult">
        </div>

        <div class="formField">
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" placeholder="Enter Full Address" required>
        </div>

        <div class="formField">
          <label for="bookingDate">Date:</label>
          <input type="date" id="bookingDate" name="bookingDate" onclick="setMinimumBookingDate()"
            onchange="generateTimeSlots()" required>
        </div>

        <div class="formField">
          <label for="bookingTime">Time:</label>
          <select id="bookingTime" name="bookingTime" required>
          </select>
        </div>

        <div class="formField">
          <label for="message" class="lablell">Message</label>
          <textarea id="message" placeholder="Write Message Here"></textarea>
        </div>

        <div>
          <button id="submitform" type="submit" onclick="window.location.href ='https://domain.com/after-submit';">Book Now</button>

          <button id="resetform" type="reset" onclick="resetForm()">Reset</button>
        </div>

      </form>

    </div>
	
	</div>
<style>
	/* Styles for Popup Container */
	.master{
		 display: flex;
  justify-content:center;
	flex-direction:row;
	}
#bookpopup-container {
  display: flex;
 
	flex-direction:column;
  top: 25px;

  width: calc(Min(400px, 100vw));
  height: auto;
  background-color: #13F900;
  z-index: 9999;
  
  border: 2px solid black;
  border-radius: 18px;
  padding: 20px;
	margin:10px;
}

.formField {
  display: flex;
  flex-direction: row;
  align-content: center;
  align-items: center;
  padding-bottom: 8px;
}

h2 {
  margin: 5px 0px;
}

/* Style for the form label */
#bookform label {
  display: inline-block;
  width: 100px;
  margin-bottom: 1.5px;
  align-self: center;
  vertical-align: center;
	color:#000;
}

/* Style for the form input elements */
#bookform input,
#bookform select,
#bookform textarea {
  display: inline-block;
  width: 90%;
  padding: 10px;
  margin-bottom: 2px;
  border: 1px solid #ccc;
  border-radius: 5px;
	
}

/* Style for the form button elements */
#bookpopup-form button {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Style for the close button */
.close-button {
  position: relative;
  top: 0px;
  right: 0px;
  font-size: 20px;
  background: white;
  border: 2px solid black;
  transform: translate(2px, -2px);
  border-radius: 50%;
  cursor: pointer;
  outline: none;
}

.hiddenlabel {
  flex-direction: column;
}
	#bookbutton{
		display:none;
	}

</style>

<script>

								   
	// Get references to elements
const bookpopupContainer = document.getElementById('bookpopup-container');
const closebookPopupButton = document.getElementById('close-bookpopup');
const quoteResult = document.getElementById("quoteResult");
const category = document.getElementById("category");

// Function to open the popup
function openbookPopup() {
  resetForm();
  bookpopupContainer.style.display = 'flex';
}

// Function to close the popup
function closebookPopup() {
  bookpopupContainer.style.display = 'none';
  document.querySelector(".hiddenlabel").style.display = "none";
  document.querySelector("#bookingTime").innerHTML = "";

  document.getElementById('bookform').reset();
}

function resetForm() {
  document.querySelector(".hiddenlabel").style.display = "none";
  document.querySelector("#bookingTime").innerHTML = "";
  document.getElementById('bookform').reset();
}

// function to validate 10 digit mobile number
function validatePhoneNumber(input) {
  input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
}

function showHiddenLabel() {
  document.querySelector("#quoteResult").value = "";
  document.querySelector(".hiddenlabel").style.display = "flex";

  if (category.value === "Car Detailing") {
    document.querySelector(".hiddenlabel").innerHTML = `<div class="formField">
  <label for="carService">Service:</label>
  <select id="carService" name="carService1" required onchange="calculateQuote()">
    <option value="">Select Service</option>
    <option value="Car - Basic Cleaning">Basic Cleaning</option>
    <option value="Car - Interior Cleaning">Deep Cleaning</option>
    <option value="Car - Paint Restoration">Paint Restoration</option>
    <option value="Car - Interior Cleaning & Paint Restoration">Deep Cleaning & Paint Restoration</option>
  </select>
</div>

<div class="formField">
  <label for="carType">Type:</label>
  <select id="carType" name="carType" required onchange="calculateQuote()">
    <option value="">Select Type</option>
    <option class="cars" value="Hatchback">Hatchback</option>
    <option class="cars" value="Compact Sedan">Compact Sedan</option>
    <option class="cars" value="Sedan/ Sub Compact SUV">Sedan/ Sub Compact SUV</option>
    <option class="cars" value="Compact SUV">Compact SUV</option>
    <option class="cars" value="SUV/Premium">SUV/Premium</option>
  </select>
</div>`;
  } else if (category.value === "Bike Detailing") {
    document.querySelector(".hiddenlabel").innerHTML = `<div style= "display : none">
  <label for="carService">Service:</label>
  <select id="carService" name="carService1" required>
    <option value="Bike Detailing">Bike Detailing</option>
  </select>
</div>

<div class="formField">
  <label for="carType">Type:</label>
  <select id="carType" name="carType" required onchange="calculateQuote()">
    <option value="">Select Type</option>
    <option class="bikes" value="Category1">Activa, Vespa, Honda Shine, Passion, </option>
    <option class="bikes" value="Category1a">RX 100/135, Shogan,Passion, RX 100/135, Shogan, Shaolin</option>
    <option class="bikes" value="Category2">Gixxer 150, R25, Duke 200/250/390</option>
    <option class="bikes" value="Category2a">Java RE Bullet/Classic/ThunderBird, Mojo, G310R, Z250, TNT 250/300</option>
    <option class="bikes" value="Category2b">Mojo, G310R, Z250, TNT 250/300</option>
    <option class="bikes" value="Category3">CBR150/250, R15/R3,RC200/390, Intruder</option>
    <option class="bikes" value="Category3a"> Apache 310R,Speed/Street Triple, Ninja 300/600, Z800</option>
    <option class="bikes" value="Category3b">Versus 300, TNT 600, RE Interceptor, Harley Street </option>
    <option class="bikes" value="Category3c">Iron 883, Triumph Bobber, Bonneville, Street twin, S1000R</option>
    <option class="bikes" value="Category4">Harley Fatboy, Superglide, Tiger, </option>
    <option class="bikes" value="Category4a">MultiStrada, Scout, Indian Bobber</option>
    <option class="bikes" value="Category4b">Scout Sixty, Hayabusa, Pannigale, S1000RR, Ninja H2</option>
    <option class="bikes" value="Category5">Other Bikes</option>
  </select>
</div>`;
  } else if (category.value === "Sofa Cleaning") {
    document.querySelector(".hiddenlabel").innerHTML = `<div style= "display : none">
  <label for="carService">Service:</label>
  <select id="carService" name="carService1" required>
    <option value="Sofa Cleaning">Sofa Cleaning</option>
  </select>
</div>

<div class="formField">
  <label for="carType">Type:</label>
  <select id="carType" name="carType" required onchange="calculateQuote()">
    <option value="">Select Type</option>
    <option class="sofas" value="sofaCategory1">Leather and Artificial Leather</option>
    <option class="sofas" value="sofaCategory2">Any type of Fabric and other materials</option>
  </select>
</div>`;
  }
}

// Function to calculate the quote and display the result
function calculateQuote() {
  const carServicePrices = {
    "Car - Basic Cleaning": {
      "Hatchback": `500 (min 3 jobs)`,
      "Compact Sedan": `600 (min 2 jobs)`,
      "Sedan/ Sub Compact SUV": `700 (min 2 jobs)`,
      "Compact SUV": `850 (min 2 jobs)`,
      "SUV/Premium": `1100 (min 1 job)`,
    },
    "Car - Interior Cleaning": {
      "Hatchback": 1600,
      "Compact Sedan": 1800,
      "Sedan/ Sub Compact SUV": 2200,
      "Compact SUV":2500,
      "SUV/Premium": 3000,
    },
    "Car - Paint Restoration": {
      "Hatchback": 4000,
      "Compact Sedan": 4500,
      "Sedan/ Sub Compact SUV": 5000,
      "Compact SUV": 5600,
      "SUV/Premium": 6500,
    },
    "Car - Interior Cleaning & Paint Restoration": {
      "Hatchback": 5100,
      "Compact Sedan": 5600,
      "Sedan/ Sub Compact SUV": 6500,
      "Compact SUV": 7300,
      "SUV/Premium": 8500,
    },
    "Bike Detailing": {
      "Category1": 1600,
      "Category1a": 1600,
      "Category2": 2300,
      "Category2a": 2300,
      "Category2b": 2300,
      "Category2c": 2300,
      "Category3": 3000,
      "Category3a": 3000,
      "Category3b": 3000,
      "Category3c": 3000,
      "Category4": 4000,
      "Category4a": 4000,
      "Category4b": 4000,
      "Category4c": 4000,
      "Category5": "Price will be decided on mutual discussion",
    },
    "Sofa Cleaning": {
      "sofaCategory1": "₹250/seat",
      "sofaCategory2": "₹300/seat",
    },
  };

  let carType = document.getElementById("carType");
  let carService = document.getElementById("carService");

  if (carType.value && carService.value) {
    const quotePrice = carServicePrices[carService.value][carType.value];
    quoteResult.value = quotePrice;
  } else {
    document.getElementById("quoteResult").value = "";
  }
}

// Function to set the minimum date for bookingDate input to today's date
function setMinimumBookingDate() {
  const today = new Date();
  const dd = String(today.getDate()).padStart(2, '0');
  const mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
  const yyyy = today.getFullYear();
  const minDate = `${yyyy}-${mm}-${dd}`;
  document.getElementById("bookingDate").setAttribute("min", minDate);
}

// Function to generate time slots for booking
function generateTimeSlots() {
  // Get the references to the date and time elements
  const bookingDate = document.getElementById('bookingDate');
  const bookingTime = document.getElementById('bookingTime');
  const startTime = 9; // 9 AM
  const endTime = 19; // 7 PM

  bookingTime.innerHTML = ''; // Clear any existing options

  const today = new Date();

  if (today < bookingDate.valueAsDate) {

    for (let hour = startTime; hour <= endTime; hour++) {
      const option = document.createElement('option');
      option.value = `${hour}:00`;
      option.textContent = `${hour}:00`;
      bookingTime.appendChild(option);
    }
  } else {
    const hournow = new Date().getHours();
    let newstartTime = Math.max(hournow + 2, 9)

    for (let hour = newstartTime; hour <= endTime; hour++) {
      const option = document.createElement('option');
      option.value = `${hour}:00`;
      option.textContent = `${hour}:00`;
      bookingTime.appendChild(option);
    }
  }
}

emailjs.init("fKwDbjGmisikvsltv");

function sendEmail() {
  var carTypeSelect = document.getElementById("carType");
  var selectedOption = carTypeSelect.options[carTypeSelect.selectedIndex];

  var templateParams = {
    name: document.getElementById("name").value,
    mobile: document.getElementById("mobile").value,
    email: document.getElementById("email").value,
    service: document.getElementById("carService").value,
    service_type: selectedOption.text,
    amount: document.getElementById("quoteResult").value,
    address: document.getElementById("address").value,
    service_date: document.getElementById("bookingDate").value,
    service_time: document.getElementById("bookingTime").value,
    message: document.getElementById("message").value,
    your_name: "Craze Car Care",
  };

  emailjs.send("service_17u6cap", "template_2nqmyp9", templateParams)
    .then(function (response) {
      console.log('Email sent successfully:', response);
    }, function (error) {
      console.log('Failed to send email:', error);
    });
};

document.getElementById('bookform').addEventListener('submit', function (event) {
  event.preventDefault();

  sendEmail();
  closebookPopup();
});
	
																		 
</script>
	
<script>
	function afterSubmit(){
  	window.alert("Your Booking has been Confirmed");													
</script>													

													

<?php wp_footer(); ?>
<?php get_footer(); ?>
