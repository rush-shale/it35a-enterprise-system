<!-- patient_form.php -->
<h3>📝 Register New Patient</h3>
<form method="POST" action="patient_register.php" id="patient-registration">
    <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" required>

    <label for="birth_date">Birth Date:</label>
    <input type="date" id="birth_date" name="birth_date" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="">Select</option>
        <option>Male</option>
        <option>Female</option>
    </select>

    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <button type="submit">Register Patient</button>
</form>
