<div class="history-container">
    <h3 class="py-4 text-center font-weight-bold">Donor Health History</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Donor Name</th>
                    <th>Age</th>
                    <th>Location</th>
                    <th>Blood Group</th>
                    <th>Medical History</th>
                </tr>
            </thead>
            <tbody id="donationTableBody">
                <!-- Donation records will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-xxx"
    crossorigin="anonymous"></script> -->
<script>
    document.addEventListener('DOMContentLoaded', loadDonationData);

    function loadDonationData() {
        fetch('Model/donorHealth.php')
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
            <td>${record.location}</td>
            <td>${record.blood_group}</td>
            <td>${record.medical_history}</td> 
             
            `;
            donationTableBody.appendChild(row);
        });
    }
</script>