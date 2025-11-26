// Load user profile data when page loads
document.addEventListener('DOMContentLoaded', async () => {
  try {
    const response = await fetch('../backend/get_profile.php');
    const result = await response.json();

    if (result.success) {
      // Update pet name and breed
      document.getElementById('petName').textContent = result.data.pet_name;
      document.getElementById('petBreed').textContent = result.data.breed;
    } else {
      window.location.href = 'login.php';
    }
  } catch (error) {
    console.error('Error loading profile:', error);
    window.location.href = 'login.php';
  }
});
