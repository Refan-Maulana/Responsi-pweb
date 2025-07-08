document.getElementById("tempForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const inputValue = parseFloat(document.getElementById("inputValue").value);
    const fromUnit = document.getElementById("fromUnit").value;
    const toUnit = document.getElementById("toUnit").value;

    if (isNaN(inputValue)) {
        document.getElementById("result").innerHTML = "Masukkan angka yang valid.";
        return;
    }

    fetch('rumus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ value: inputValue, from: fromUnit, to: toUnit })
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("result").innerHTML = data;
    });
});