function verifyHuman(e) {
    e.preventDefault();
    document.getElementById('loginSubmit').disabled = false;
    document.getElementById('registerSubmit').disabled = false;
    document.getElementById('verifyHumanButton').disabled = true;
}