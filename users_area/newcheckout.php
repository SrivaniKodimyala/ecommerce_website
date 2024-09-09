<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website - Products Booking</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary-blue": '#0dcaf0',
                        "grey": "#f7f7f7",
                        "secondary-blue":"#0497e0"
                    },
                    fontFamily:{
                        "roboto":"Roboto, sans-serif"
                    }
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const phoneInput = document.getElementById('phone-email-input');
            const otpInput = document.getElementById('otp-input');
            const loginButton = document.getElementById('login-button');
            const otpContainer = document.getElementById('otp-container');
            const fieldsContainer = document.getElementById('fields-container');
            const termsContainer = document.getElementById('terms-container');
            const registeredCustomerDiv = document.getElementById('registered-customer');
            const sections = document.querySelectorAll('.section');
            let currentSectionIndex = 0;

            // Initially hide OTP container and registered customer div
            otpContainer.style.display = 'none'; 
            registeredCustomerDiv.style.display = 'none'; 

            loginButton.addEventListener('click', function() {
                if (loginButton.textContent === 'Get OTP') {
                    // Show OTP input field if phone input is not empty
                    if (phoneInput.value.trim() !== "") {
                        // Store phone number in local storage
                        localStorage.setItem('phoneNumber', phoneInput.value.trim());

                        otpContainer.style.display = 'flex'; 
                        loginButton.textContent = 'LOGIN';
                    } else {
                        alert('Please enter a phone number.');
                    }
                } else {
                    // Handle login functionality here
                    alert('Login functionality needs to be implemented!');

                    // Update the LOGIN section with the registered phone number
                    const savedPhoneNumber = localStorage.getItem('phoneNumber');
                    if (savedPhoneNumber) {
                        registeredCustomerDiv.textContent = `Registered - ${savedPhoneNumber}`;
                        registeredCustomerDiv.style.display = 'block'; // Show the registered customer text
                    }

                    // Hide input fields and OTP container but keep the section visible
                    phoneInput.style.display = 'none';
                    otpInput.style.display = 'none';
                    otpContainer.style.display = 'none';
                    fieldsContainer.style.display = 'none';
                    termsContainer.style.display = 'none';
                    loginButton.style.display = 'none';

                    // Move to the next section
                    if (currentSectionIndex < sections.length - 1) {
                        currentSectionIndex++;
                        sections[currentSectionIndex].querySelector('.content').style.display = 'flex';
                    }
                }
            });

            // Initially show only the first section
            sections.forEach((section, index) => {
                if (index !== 0) {
                    section.querySelector('.content').style.display = 'none';
                }
            });
        });
    </script>
    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body class="font-roboto bg-grey">
    <nav class="px-20 py-2 bg-primary-blue h-[10%]" >
        <img src="../images/logo.jpg" alt="" class="logo w-16 h-16">
    </nav>

    <div class="flex flex-row items-start gap-10 px-20 py-10 w-full h-[90%]">
        <div class="w-2/3 flex flex-col gap-4">
           <!-- Section 1: LOGIN OR SIGNUP -->
            <section class="section">
                <header class="section-header bg-secondary-blue px-10 py-2 rounded-sm">
                    <p class="text-white font-bold">1. LOGIN OR SIGNUP</p>
                </header>
                <div class="content bg-white rounded-b-lg py-4 px-8 flex flex-row gap-2">
                    <div class="flex w-1/2 flex-col items-start gap-4" id="fields-container">
                        <div class="flex flex-col gap-1 w-full">
                            <label for="phone">Enter Phone number or Email</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="phone" placeholder="+91 93939 39393" id="phone-email-input">
                        </div>
                        <div class="flex flex-col gap-1 w-full" id="otp-container">
                            <label for="otp">Enter the OTP</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="otp" placeholder="OTP" id="otp-input">
                        </div>
                        <button id="login-button" class="bg-secondary-blue text-white hover:bg-primary-blue transition-color font-bold px-10 py-2 rounded-lg">Get OTP</button>
                        <!-- Display the registered phone number here, initially hidden -->
                    </div>
                    <div class="flex w-1/2 flex-col justify-between" id="terms-container">
                        <p class="text-end text-sm">By continuing, you agree to ShopCart's <br/> Terms of Use and <br/> Privacy Policy</p>
                    </div>

                    <p id="registered-customer" class="text-sm text-gray-700" style="display: none;">Registered - </p>
                </div>
            </section>

            <!-- Section 2: DELIVERY ADDRESS -->
            <section class="section">
                <header class="section-header bg-secondary-blue px-10 py-2 rounded-sm">
                    <p class="text-white font-bold">2. DELIVERY ADDRESS</p>
                </header>
                <div class="content bg-white rounded-b-lg py-4 px-8 flex flex-row gap-2">
                    <div class="flex w-1/2 flex-col items-start gap-4">
                        <div class="flex flex-col gap-1 w-full">
                            <label for="phone">Enter Phone number or Email</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="phone" placeholder="+91 93939 39393" id="phone-email-input">
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <label for="phone">Enter the OTP</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="otp" placeholder="OTP" id="otp-input">
                        </div>
                        <button class="bg-secondary-blue text-white hover:bg-primary-blue transition-color font-bold px-10 py-2 rounded-lg">LOGIN</button>
                    </div>
                    <div class="flex w-1/2 flex-col justify-between">
                        <p class="text-end text-sm">By continuing, you agree to ShopCart's <br/> Terms of Use and <br/> Privacy Policy</p>
                    </div>
                </div>
            </section>

            <!-- Section 3: ORDER SUMMARY -->
            <section class="section">
                <header class="section-header bg-secondary-blue px-10 py-2 rounded-sm">
                    <p class="text-white font-bold">3. ORDER SUMMARY</p>
                </header>
                <div class="content bg-white rounded-b-lg py-4 px-8 flex flex-row gap-2">
                    <div class="flex w-1/2 flex-col items-start gap-4">
                        <div class="flex flex-col gap-1 w-full">
                            <label for="phone">Enter Phone number or Email</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="phone" placeholder="+91 93939 39393" id="phone-email-input">
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <label for="phone">Enter the OTP</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="otp" placeholder="OTP" id="otp-input">
                        </div>
                        <button class="bg-secondary-blue text-white hover:bg-primary-blue transition-color font-bold px-10 py-2 rounded-lg">LOGIN</button>
                    </div>
                    <div class="flex w-1/2 flex-col justify-between">
                        <p class="text-end text-sm">By continuing, you agree to ShopCart's <br/> Terms of Use and <br/> Privacy Policy</p>
                    </div>
                </div>
            </section>

            <!-- Section 4: PAYMENT OPTIONS -->
            <section class="section">
                <header class="section-header bg-secondary-blue px-10 py-2 rounded-sm">
                    <p class="text-white font-bold">4. PAYMENT OPTIONS</p>
                </header>
                <div class="content bg-white rounded-b-lg py-4 px-8 flex flex-row gap-2">
                    <div class="flex w-1/2 flex-col items-start gap-4">
                        <div class="flex flex-col gap-1 w-full">
                            <label for="phone">Enter Phone number or Email</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="phone" placeholder="+91 93939 39393" id="phone-email-input">
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <label for="phone">Enter the OTP</label>
                            <input type="text" class="w-full border-b border-gray-500 px-2 py-1 focus:outline-none" name="otp" placeholder="OTP" id="otp-input">
                        </div>
                        <button class="bg-secondary-blue text-white hover:bg-primary-blue transition-color font-bold px-10 py-2 rounded-lg">LOGIN</button>
                    </div>
                    <div class="flex w-1/2 flex-col justify-between">
                        <p class="text-end text-sm">By continuing, you agree to ShopCart's <br/> Terms of Use and <br/> Privacy Policy</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="w-1/3 flex flex-row gap-4">
            <img src="https://seeklogo.com/images/T/twitter-verified-badge-gray-logo-EA3A36D931-seeklogo.com.png" alt="Verified" class="w-14 object-contain">
            <div class="flex flex-col gap-1">
               <p class="text-gray-500 font-bold">Safe and Secure.</p>
               <p class="text-gray-500 font-bold">100% Authentic products</p>
               <p class="text-gray-500 font-bold">Easy Replacement and Returns</p>
            </div>
        </div>
    </div>
</body>
</html>