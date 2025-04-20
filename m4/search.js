document.getElementById("search").addEventListener("input", function() {
    const query = this.value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("results").innerHTML = xhr.responseText;

            const buttons = document.querySelectorAll(".search-button");
            buttons.forEach(button => {
                button.addEventListener("click", function () {
                    ///e.preventDefault();
                    const type = this.dataset.type;
                    const name = this.dataset.name;

                    const xhr2 = new XMLHttpRequest();
                    xhr2.open("GET", `details.php?type=${encodeURIComponent(type)}&name=${encodeURIComponent(name)}`, true);
                    xhr2.onload = function () {
                        if (xhr2.status === 200) {
                            document.getElementById("card-content").innerHTML = xhr2.responseText;
                            document.getElementById("info-card").classList.remove("hidden");
                        }
                    };
                    xhr2.send();
                });
            });
        }
    };
    xhr.send();
});

document.getElementById("close-card").addEventListener("click", function () {
    document.getElementById("info-card").classList.add("hidden");
});