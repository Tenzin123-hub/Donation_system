function getDonor(email) {
    if (email.trim() === '') {
        document.getElementById("donor_id").value = '';
        document.getElementById("email").style.borderColor = '';
        return;
    }
    
    fetch("ajax_get_donor.php?email=" + encodeURIComponent(email))
    .then(res => res.json())
    .then(data => {
        if (data && data.id) {
            document.getElementById("donor_id").value = data.id;
            document.getElementById("email").style.borderColor = 'green';
            document.getElementById("email").style.borderWidth = '2px';
            if (data.created) {
                console.log('New donor created: ' + data.message);
            }
        } else {
            document.getElementById("donor_id").value = '';
            document.getElementById("email").style.borderColor = 'red';
            document.getElementById("email").style.borderWidth = '2px';
            console.error('Donor lookup error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("donor_id").value = '';
        document.getElementById("email").style.borderColor = 'red';
        document.getElementById("email").style.borderWidth = '2px';
    });
}

