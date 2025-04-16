
document.getElementById("search").addEventListener("input", function() {
    const query = this.value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("results").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});
