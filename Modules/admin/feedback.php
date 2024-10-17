<div class="feedback-container">
    <h3 class="py-4 text-center font-weight-bold">User Feedback</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Feedback Text</th>
                    <th>Feedback Date</th>
                </tr>
            </thead>
            <tbody id="feedbackTableBody">
                <!-- Feedback records will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-xxx"
    crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', loadFeedbackData);

    function loadFeedbackData() {
        fetch('Model/userFeedback.php')
            .then(response => response.json())
            .then(data => populateFeedbackTable(data))
            .catch(error => console.error('Error fetching feedback data:', error));
    }

    function populateFeedbackTable(data) {
        const feedbackTableBody = document.getElementById('feedbackTableBody');
        feedbackTableBody.innerHTML = '';

        data.forEach(record => {
            const row = document.createElement('tr');
            row.innerHTML = `
        <td>${record.FeedbackID}</td>
        <td>${record.email}</td>
        <td>${record.username || '-'}</td>
        <td>${record.phone}</td>
        <td>${record.FeedbackText}</td>
        <td>${record.FeedbackDate}</td>
      `;
            feedbackTableBody.appendChild(row);
        });
    }
</script>