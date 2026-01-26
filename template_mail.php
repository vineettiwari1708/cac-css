<?php
//Template Name: Vineet 26.01.2026 final
?>

<?php get_header(); ?> <?php wp_head(); ?>

<div class="master">
	<button
		id="bookbutton"
		onclick="openbookPopup()"
	>
		Book Now
	</button>

	<div id="bookpopup-container">
		<div class="close-uniqe">
			<button
				id="close-bookpopup"
				class="close-button"
				onclick="closebookPopup()"
			>
				✕
			</button>
		</div>

		<div>
			<h2 id="bookheading">Service Request Form</h2>
		</div>

		<form
			id="bookform"
		>
			<div class="formField">
				<label for="name">Name:</label>
				<input
					type="text"
					id="name"
					name="name"
					placeholder="Enter Your Name"
					required
				/>
			</div>

			<div class="formField">
				<label for="mobile">Mobile Number:</label>
				<input
					type="tel"
					id="mobile"
					name="mobile"
					placeholder="Enter 10 Digit Mobile No."
					maxlength="10"
					oninput="validatePhoneNumber(this)"
					required
				/>
			</div>

			<div class="formField">
				<label for="email">Email</label>
				<input
					type="email"
					id="email"
					name="email"
					placeholder="abc@xyz.com"
					required
				/>
			</div>

			<div class="formField">
				<label for="category">Service For:</label>
				<select
					id="category"
					name="category"
					required
					onchange="showHiddenLabel()"
				>
					<option value="">Select Service</option>
					<option value="Car Detailing">Car Detailing</option>
					<option value="Bike Detailing">Bike Detailing</option>
					<option value="Sofa Cleaning">Sofa Cleaning</option>
				</select>
			</div>

			<div class="hiddenlabel"></div>

			<div class="formField">
				<label for="Amount">Amount ₹:</label>
				<input
					type="text"
					readonly
					id="quoteResult"
				/>
			</div>

			<div class="formField">
				<label for="address">Address:</label>
				<input
					type="text"
					id="address"
					name="address"
					placeholder="Enter Full Address"
					required
				/>
			</div>

			<div class="formField">
				<label for="bookingDate">Date:</label>
				<input
					type="date"
					id="bookingDate"
					name="bookingDate"
					onclick="setMinimumBookingDate()"
					onchange="generateTimeSlots()"
					required
				/>
			</div>

			<div class="formField">
				<label for="bookingTime">Time:</label>
				<select
					id="bookingTime"
					name="bookingTime"
					required
				></select>
			</div>

			<div class="formField">
				<label
					for="message"
					class="lablell"
					>Message</label
				>
				<textarea
					id="message"
					placeholder="Write Message Here"
				></textarea>
			</div>

			<div>
				<button
					id="submitform"
					type="submit"
					onclick="
						window.location.href = 'https://crazeautocare.com/after-submit'
					"
				>
					Book Now
				</button>

				<button
					id="resetform"
					type="reset"
					onclick="resetForm()"
				>
					Reset
				</button>
			</div>
		</form>
	</div>
</div>
<style>
	/* Styles for Popup Container */
	.master {
		display: flex;
		justify-content: center;
		flex-direction: row;
	}
	#bookpopup-container {
		display: flex;

		flex-direction: column;
		top: 25px;

		width: calc(Min(500px, 100vw));
		height: auto;
		background-color: #13f900;
		z-index: 9999;

		border: 2px solid black;
		border-radius: 18px;
		padding: 20px;
		margin: 10px;
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
		color: #000;
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
	#bookbutton {
		display: none;
	}
</style>



<script>
document.getElementById("bookform").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    // Dynamically add the relevant service-specific fields
    formData.append("quoteResult", document.getElementById("quoteResult").value);
    formData.append("carService", document.getElementById("carService") ? document.getElementById("carService").value : '');
    formData.append("carType", document.getElementById("carType") ? document.getElementById("carType").value : '');
    formData.append("bikeType", document.getElementById("bikeType") ? document.getElementById("bikeType").value : '');
    formData.append("sofaType", document.getElementById("sofaType") ? document.getElementById("sofaType").value : '');
    formData.append("message", document.getElementById("message").value);

    formData.append("action", "send_booking_email");

    fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if(res.success){
            alert("Your Booking has been Confirmed");
            window.location.href = "https://crazeautocare.com/thank-you";
        } else {
            alert("Email failed. Please try again.");
        }
    });
});

</script>


<script>
	function afterSubmit() {
		window.alert('Your Booking has been Confirmed');
	}
</script>




<!-- function.php -->

function send_booking_email() {
    // Ensure the necessary fields exist
    if ( isset($_POST['name'], $_POST['mobile'], $_POST['email'], $_POST['category'], $_POST['address'], $_POST['bookingDate'], $_POST['bookingTime']) ) {

        // Define the recipient email
        $to = "vineettiwari1708@gmail.com"; // Change this to your email address

        // Define the subject
        $subject = "New Service Booking";

        // Initialize the service-specific fields
        $carService = isset($_POST['carService']) ? $_POST['carService'] : '';
        $carType = isset($_POST['carType']) ? $_POST['carType'] : '';
        $bikeType = isset($_POST['bikeType']) ? $_POST['bikeType'] : '';
        $sofaType = isset($_POST['sofaType']) ? $_POST['sofaType'] : '';
        $quoteResult = isset($_POST['quoteResult']) ? $_POST['quoteResult'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';

        // Build the message based on the service type
        $message_body = "
        <h2>New Service Booking</h2>
        <p><strong>Name:</strong> {$_POST['name']}</p>
        <p><strong>Mobile:</strong> {$_POST['mobile']}</p>
        <p><strong>Email:</strong> {$_POST['email']}</p>
        <p><strong>Service:</strong> {$_POST['category']}</p> <!-- Dynamic Category -->
        <p><strong>Amount:</strong> {$quoteResult}</p> <!-- Dynamic Amount -->
        <p><strong>Address:</strong> {$_POST['address']}</p>
        <p><strong>Booking Date:</strong> {$_POST['bookingDate']}</p>
        <p><strong>Booking Time:</strong> {$_POST['bookingTime']}</p>

        <!-- Add dynamic service-specific fields based on the selected service -->
        ";

        if ($_POST['category'] === 'Car Detailing') {
            $message_body .= "
            <p><strong>Car Service:</strong> {$carService}</p>
            <p><strong>Car Type:</strong> {$carType}</p>
            ";
        } elseif ($_POST['category'] === 'Bike Detailing') {
            $message_body .= "
            <p><strong>Bike Type:</strong> {$bikeType}</p>
            ";
        } elseif ($_POST['category'] === 'Sofa Cleaning') {
            $message_body .= "
            <p><strong>Sofa Type:</strong> {$sofaType}</p>
            ";
        }

        // Add the message field
        $message_body .= "<p><strong>Message:</strong> {$message}</p>";

        // Headers for sending HTML email
        $headers = ['Content-Type: text/html; charset=UTF-8'];

        // Send the email
        if ( wp_mail($to, $subject, $message_body, $headers) ) {
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    } else {
        wp_send_json_error(['message' => 'Missing required fields.']);
    }

    die(); // Make sure to stop further execution
}

// Hook the function to handle the AJAX requests
add_action('wp_ajax_send_booking_email', 'send_booking_email');
add_action('wp_ajax_nopriv_send_booking_email', 'send_booking_email');


function add_custom_script_for_page_template() {
    if (is_page_template('template-page-booking.php')) { // Check if the current page uses the custom template
        ?>
        <script type="text/javascript">
             // Get references to elements
    const bookpopupContainer = document.getElementById('bookpopup-container');
    const closebookPopupButton = document.getElementById('close-bookpopup');
    const quoteResult = document.getElementById('quoteResult');
    const category = document.getElementById('category');
    const bookingDate = document.getElementById('bookingDate');
    const bookingTime = document.getElementById('bookingTime');
    const bookForm = document.getElementById('bookform');
    const hiddenLabel = document.querySelector('.hiddenlabel');

    // Function to open the popup
    function openbookPopup() {
        resetForm();
        bookpopupContainer.style.display = 'flex';
    }

    // Function to close the popup
    function closebookPopup() {
        bookpopupContainer.style.display = 'none';
        hiddenLabel.style.display = 'none';
        bookingTime.innerHTML = ''; // Clear booking time options
        bookForm.reset(); // Reset the entire form
    }

    // Function to reset form and hidden fields
    function resetForm() {
        hiddenLabel.style.display = 'none';
        bookingTime.innerHTML = '';
        bookForm.reset();
        quoteResult.value = ''; // Clear quote
    }

    // Function to validate mobile number (ensures only digits are entered)
    function validatePhoneNumber(input) {
        input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
    }

    // Show or hide fields based on selected category
    function showHiddenLabel() {
        quoteResult.value = ''; // Reset quote value
        hiddenLabel.style.display = 'flex'; // Show hidden label section

        // Clear current hidden fields
        hiddenLabel.innerHTML = '';

        // Check selected category and inject corresponding fields
        if (category.value === 'Car Detailing') {
            hiddenLabel.innerHTML = `
                <div class="formField">
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
                        <option value="Hatchback">Hatchback</option>
                        <option value="Compact Sedan">Compact Sedan</option>
                        <option value="Sedan/ Sub Compact SUV">Sedan/ Sub Compact SUV</option>
                        <option value="Compact SUV">Compact SUV</option>
                        <option value="SUV/Premium">SUV/Premium</option>
                    </select>
                </div>`;
        } else if (category.value === 'Bike Detailing') {
            hiddenLabel.innerHTML = `
                <div class="formField">
                    <label for="bikeService">Service:</label>
                    <select id="bikeService" name="bikeService" required onchange="calculateQuote()">
                        <option value="Bike Detailing">Bike Detailing</option>
                    </select>
                </div>
                <div class="formField">
                    <label for="bikeType">Type:</label>
                    <select id="bikeType" name="bikeType" required onchange="calculateQuote()">
                         <option value="">Select Type</option>
    <option class="bikes" value="Activa, Vespa, Honda Shine, Passion">Activa, Vespa, Honda Shine, Passion </option>
    <option class="bikes" value="RX 100/135, Shogan,Passion, RX 100/135, Shogan, Shaolin">RX 100/135, Shogan,Passion, RX 100/135, Shogan, Shaolin</option>
    <option class="bikes" value="Gixxer 150, R25, Duke 200/250/390">Gixxer 150, R25, Duke 200/250/390</option>
    <option class="bikes" value="Java RE Bullet/Classic/ThunderBird">Java RE Bullet/Classic/ThunderBird</option>
    <option class="bikes" value="Mojo, G310R, Z250">Mojo, G310R, Z250</option>
    <option class="bikes" value="TNT 250/300">TNT 250/300</option>
    <option class="bikes" value="CBR150/250, R15/R3,RC200/390, Intruder">CBR150/250, R15/R3,RC200/390, Intruder</option>
    <option class="bikes" value="Apache 310R,Speed/Street Triple, Ninja 300/600, Z800"> Apache 310R,Speed/Street Triple, Ninja 300/600, Z800</option>
    <option class="bikes" value="Versus 300, TNT 600, RE Interceptor, Harley Street">Versus 300, TNT 600, RE Interceptor, Harley Street </option>
    <option class="bikes" value="Iron 883, Triumph Bobber, Bonneville, Street twin, S1000R">Iron 883, Triumph Bobber, Bonneville, Street twin, S1000R</option>
    <option class="bikes" value="Harley Fatboy, Superglide, Tiger">Harley Fatboy, Superglide, Tiger</option>
    <option class="bikes" value="MultiStrada, Scout, Indian Bobber">MultiStrada, Scout, Indian Bobber</option>
    <option class="bikes" value="Scout Sixty, Hayabusa, Pannigale, S1000RR, Ninja H2">Scout Sixty, Hayabusa, Pannigale, S1000RR, Ninja H2</option>
    <option class="bikes" value="Other Bikes">Other Bikes</option>
                    </select>
                </div>`;
        } else if (category.value === 'Sofa Cleaning') {
            hiddenLabel.innerHTML = `
                <div class="formField">
                    <label for="sofaService">Service:</label>
                    <select id="sofaService" name="sofaService" required>
                        <option value="Sofa Cleaning">Sofa Cleaning</option>
                    </select>
                </div>
                <div class="formField">
                    <label for="sofaType">Type:</label>
                    <select id="sofaType" name="sofaType" required onchange="calculateQuote()">
                        <option value="">Select Type</option>
                        <option value="Leather and Artificial Leather">Leather and Artificial Leather</option>
                        <option value="Any type of Fabric and other materials">Any type of Fabric and other materials</option>
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
      "Activa, Vespa, Honda Shine, Passion": 1600,
      "RX 100/135, Shogan,Passion, RX 100/135, Shogan, Shaolin": 1600,
      "Gixxer 150, R25, Duke 200/250/390": 2300,
      "Java RE Bullet/Classic/ThunderBird": 2300,
      "Mojo, G310R, Z250": 2300,
      "TNT 250/300": 2300,
      "CBR150/250, R15/R3,RC200/390, Intruder": 3000,
      "Apache 310R,Speed/Street Triple, Ninja 300/600, Z800": 3000,
      "Versus 300, TNT 600, RE Interceptor, Harley Street": 3000,
      "Iron 883, Triumph Bobber, Bonneville, Street twin, S1000R": 3000,
      "Harley Fatboy, Superglide, Tiger": 4000,
      "MultiStrada, Scout, Indian Bobber": 4000,
      "Scout Sixty, Hayabusa, Pannigale, S1000RR, Ninja H2": 4000,
      "Other Bikes": "Price will be decided on mutual discussion",
    },
    "Sofa Cleaning": {
      "Leather and Artificial Leather": "₹250/seat",
      "Any type of Fabric and other materials": "₹300/seat",
    },
  };

        let serviceType = document.querySelector(`#${category.value === 'Car Detailing' ? 'carService' : category.value === 'Bike Detailing' ? 'bikeService' : 'sofaService'}`);
        let selectedType = document.querySelector(`#${category.value === 'Car Detailing' ? 'carType' : category.value === 'Bike Detailing' ? 'bikeType' : 'sofaType'}`);

        if (serviceType.value && selectedType.value) {
            const quotePrice = carServicePrices[serviceType.value][selectedType.value];
            quoteResult.value = quotePrice;
        } else {
            quoteResult.value = '';
        }
    }

    // Function to set minimum date for booking
    function setMinimumBookingDate() {
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const yyyy = today.getFullYear();
        const minDate = `${yyyy}-${mm}-${dd}`;
        bookingDate.setAttribute('min', minDate);
    }

    // Function to generate time slots based on the booking date
    function generateTimeSlots() {
        const startTime = 9; // 9 AM
        const endTime = 19; // 7 PM
        bookingTime.innerHTML = ''; // Clear existing options

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
            let newStartTime = Math.max(hournow + 2, 9); // Ensure starting from 2 hours ahead of the current time
            for (let hour = newStartTime; hour <= endTime; hour++) {
                const option = document.createElement('option');
                option.value = `${hour}:00`;
                option.textContent = `${hour}:00`;
                bookingTime.appendChild(option);
            }
        }
    }
        </script>
        <?php
    }
}
add_action('wp_footer', 'add_custom_script_for_page_template');

<?php wp_footer(); ?> <?php get_footer(); ?>
