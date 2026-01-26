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
