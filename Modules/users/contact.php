<div id="contact" class="container">
    <!-- <h2><i class="fas fa-envelope-open-text text-danger"></i> Contact Us</h2> -->
    <div class="col-md-10 col-lg-8 mx-auto">
        <div class="header-section">
            <h2 class="title ">Contact <span class='px-2'>Us</span></h2>
            <p class="description">Reach out to us through our contact section for any inquiries, feedback, or support.
                We're here to assist you promptly and ensure a seamless communication experience.</p>
        </div>
    </div>

    <form id="feedbackForm">
        <div class="form-group">
            <label for="username"><i class="fas fa-user text-danger"></i> Name:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter name" name="username" required>
        </div>
        <div class="form-group">
            <label for="email"><i class="fas fa-envelope text-danger"></i> Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone"><i class="fas fa-phone text-danger"></i> Phone:</label>
            <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" name="phone" required>
        </div>
        <div class="form-group">
            <label for="message"><i class="fas fa-comment-dots text-danger"></i> Message:</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
    </form>
</div>

<script>
    const feedbackForm = document.getElementById('feedbackForm');
    console.log(feedbackForm);
    feedbackForm.addEventListener('submit', submitForm);


    function validateBloodForm() {
        const usernameInput = document.getElementById('username');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const messageInput = document.getElementById('message');

        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const phone = phoneInput.value.trim();
        const message = messageInput.value.trim();

        // Validation rules
        const usernameRegex = /^[A-Za-z\s]+$/;
        const emailRegex = /^\S+@\S+\.\S+$/;
        const phoneRegex = /^\d{11}$/;

        // Validate username
        if (!usernameRegex.test(username)) {
            alert('Invalid username. Username must contain only alphabetic characters and spaces.');
            usernameInput.focus();
            return false;
        }

        // Validate email
        if (!emailRegex.test(email)) {
            alert('Invalid email address.');
            emailInput.focus();
            return false;
        }

        // Validate phone number
        if (!phoneRegex.test(phone)) {
            alert('Invalid phone number. Phone number must contain 11 digits.');
            phoneInput.focus();
            return false;
        }

        // Validate message
        if (message.length === 0) {
            alert('Please enter a message.');
            messageInput.focus();
            return false;
        }

        return true;
    }

    function submitForm(event) {
        event.preventDefault();

        if (!validateBloodForm()) {
            return;
        }

        const formValues = new FormData(event.target);
        console.log(formValues);

        fetch('Model/handleFeedback.php', {
            method: 'POST',
            body: formValues
        })
            .then(response => response.text())
            .then(data => {
                console.log('Success:', data);
                location.reload();

            })
            .catch((error) => {
                console.error('Error:', error);
                location.reload();
            });
    }
</script>