<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Job Application System</h1>

        <!-- Form to create a new nurse -->
        <form id="createForm">
            <h3>Add a New Nurse</h3>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="yearsOfExperience">Years of Experience:</label>
            <input type="number" id="yearsOfExperience" name="yearsOfExperience" required>

            <label for="specialization">Specialization:</label>
            <input type="text" id="specialization" name="specialization" required>

            <label for="licenseNumber">License Number:</label>
            <input type="text" id="licenseNumber" name="licenseNumber" required>

            <label for="preferredShift">Preferred Shift:</label>
            <select id="preferredShift" name="preferredShift" required>
                <option value="Morning">Morning</option>
                <option value="Evening">Evening</option>
                <option value="Night">Night</option>
            </select>

            <button type="submit">Add Nurse</button>
        </form>


        <!-- Search form -->
        <form id="searchForm">
            <h3>Search Nurses</h3>
            <label for="search">Keyword:</label>
            <input type="text" id="search" name="search">
            <button type="submit">Search</button>
        </form>

        <!-- Display results -->
        <div id="results" class="result" style="display: none;"></div>
    </div>

    <script>
        const createForm = document.getElementById('createForm');

        // Handle create form submission
        createForm.addEventListener('submit', async (e) => {
            e.preventDefault(); // Prevent page reload
            const formData = new FormData(createForm);
            formData.append('action', 'create'); // Add action for the controller

            const response = await fetch('controllers/applicantsController.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            alert(data.message); // Show message from the server
            createForm.reset(); // Reset the form after submission
        });
    </script>
</body>
</html>

