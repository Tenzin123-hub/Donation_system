function getDonor(email) {
    fetch("ajax_get_donor.php?email=" + email)
    .then(res => res.json())
    .then(data => {
        document.getElementById("donor_id").value = data.id;
    });
}
