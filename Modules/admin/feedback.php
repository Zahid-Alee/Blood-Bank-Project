<div class="history-container">
    <h3 class="py-4 text-center font-weight-bold">Blood Donation History</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Donor Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Location</th>
                    <th>Blood Group</th>
                    <th>Quantity (ml)</th>
                    <th>Donation Date</th>

                </tr>
            </thead>
            <tbody id="donationTableBody">
                <!-- Donation records will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-xxx"
    crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', loadDonationData);

    function loadDonationData() {
        fetch('Model/donationHistory.php')
            .then(response => response.json())
            .then(data => populateDonationTable(data))
            .catch(error => console.error('Error fetching donation data:', error));
    }

    function populateDonationTable(data) {
        const donationTableBody = document.getElementById('donationTableBody');
        donationTableBody.innerHTML = '';

        data.forEach(record => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${record.donor_name}</td>
            <td>${record.age}</td>
            <td>${record.email}</td>
            <td>${record.contact_no}</td>
            <td>${record.location}</td>
            <td>${record.blood_group}</td>
            <td>${record.quantity}</td>
            <td>${record.donation_date}</td>
               
             
            `;
            donationTableBody.appendChild(row);
        });
    }
</script>